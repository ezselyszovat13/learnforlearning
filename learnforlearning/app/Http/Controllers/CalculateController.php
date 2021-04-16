<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Subject;
use App\Http\Requests\DoCalculationFormRequest;
use Auth;

class CalculateController extends Controller
{
    private function getGoodSelectorInformations(){
        //decides, whether a person has chosen great optionals or not
        //all user will get a true or a false value
        $users = User::all();
        $good_selector = [];

        foreach ($users as $user) {
            $average = $user->getGradesAverage();
            $opt_average = $user->getOptionalGradesAverage();
            //if there is no optional subjects yet, the user is not included in the calculation
            if($average === null || $opt_average === null)
                continue;
            //he/she is a good selector if his/her average is better because of these subjects
            $good_selector[$user->id] = ($average <= $opt_average);
        }

        return $good_selector;
    }

    private function getGiniImpurity($subject_code, &$optional_data){
        $correct_on_good = $optional_data[$subject_code]['correctOnGoodSelection'];
        $incorrect_on_good = $optional_data[$subject_code]['incorrectOnGoodSelection'];
        $correct_on_bad = $optional_data[$subject_code]['correctOnBadSelection'];
        $incorrect_on_bad = $optional_data[$subject_code]['incorrectOnBadSelection'];
        $total_good = $correct_on_good + $incorrect_on_good;
        $total_bad = $correct_on_bad + $incorrect_on_bad;
        $total = $total_good + $total_bad;

        //var_dump($correct_on_good . " " . $incorrect_on_good . " " . $correct_on_bad . " " . $incorrect_on_bad . " -----------------------");

        $correct_left = $correct_on_good>0 ? pow(($correct_on_good / (double)$total_good),2) : 0;
        $incorrect_left = $incorrect_on_good>0 ? pow(($incorrect_on_good / (double)$total_good),2) : 0;
        $correct_right = $correct_on_bad ? pow(($correct_on_bad / (double)$total_bad),2) : 0;
        $incorrect_right = $incorrect_on_bad ? pow(($incorrect_on_bad / (double)$total_bad),2) : 0;

        $left_gini = 1 - $correct_left - $incorrect_left;
        $right_gini = 1 - $correct_right - $incorrect_right;

        //weighted sum
        return ($total_good/$total)*$left_gini + ($total_bad/$total)*$right_gini;
    }

    private function getMinimalGini(&$optional_data,&$gini_impurities){
        $min_gini = null;
        $min_gini_value = null;
        $occurrence = 0;

        foreach ($gini_impurities as $key => $data){
            if($min_gini === null){
                $min_gini = $key;
                $min_gini_value = $data;
                $occurrence = $optional_data[$key]['correctOnGoodSelection'] + 
                    $optional_data[$key]['incorrectOnGoodSelection'] + $optional_data[$key]['correctOnBadSelection'] + 
                    $optional_data[$key]['incorrectOnBadSelection'];
            }
            else{
                if($data < $min_gini_value){
                    $min_gini = $key;
                    $min_gini_value = $data;
                    $occurrence = $optional_data[$key]['correctOnGoodSelection'] + 
                        $optional_data[$key]['incorrectOnGoodSelection'] + $optional_data[$key]['correctOnBadSelection'] + 
                        $optional_data[$key]['incorrectOnBadSelection'];
                }
                else if($data === $min_gini_value){
                    $act_occurrence = $optional_data[$key]['correctOnGoodSelection'] + 
                        $optional_data[$key]['incorrectOnGoodSelection'] + $optional_data[$key]['correctOnBadSelection'] + 
                        $optional_data[$key]['incorrectOnBadSelection'];
                    if($act_occurrence > $occurrence){
                        $min_gini = $key;
                        $min_gini_value = $data;
                        $occurrence = $act_occurrence;
                    }
                }
            }
        }
        if($min_gini === null){
            return null;
        }
        return $min_gini;
    } 

    private function calculateMaximalError(&$optional_data, $best_choice, $sample_count, &$reached_maximum_error_limit){
        $maximal_error = ($optional_data[$best_choice]['incorrectOnGoodSelection'] + $optional_data[$best_choice]['incorrectOnBadSelection'])*$optional_data[$best_choice]['weight'];

        //we need to define cases for extreme values
        if($maximal_error > 1){
            $maximal_error = 1 - 1/(double)($sample_count*10); 
            $reached_maximum_error_limit = true;
        }
        if($maximal_error == 0) 
            $maximal_error += 1/(double)($sample_count*10);
        else if($maximal_error == 1)
            $maximal_error -= 1/(double)($sample_count*10);

        return $maximal_error;
    }

    public function calculateOptional(DoCalculationFormRequest $request){
        $data = $request->all();

        //we need to get the semester we are in
        $is_even_semester = null;
        if($data['semester'] == "1"){
            $is_even_semester = false;
        }
        else if($data['semester'] == "2"){
            $is_even_semester = true;
        }

        $good_selector = $this->getGoodSelectorInformations();

        //we will count for all the optional whether they were good or not when user was a good selector or not
        $logon_user = Auth::User();
        //we need these, because these are the only subjects the user can choose
        $available_optionals = $logon_user->getAvailableOptionalSubjects();

        //we need to filter the options depends on the semester
        $filtered_available = [];
        foreach($available_optionals as $available_opt){
            if($available_opt->even_semester == $is_even_semester){
                array_push($filtered_available,$available_opt);
            }
        }
        $available_optionals = $filtered_available;

        $optional_data = [];
        $available_codes = [];
        
        $users = User::all();
        $user_count = User::count();

        //create the initial samples in (user-subject-weight-correct) form
        $samples = [];
        foreach ($users as $user){
            $subjects = $user->getOptionalSubjects();
            if($subjects === null)
                continue;

            foreach($subjects as $subject){
                $sample = [
                    'user' => $user,
                    'subject' => $subject,
                    'weight' => 0,
                    'correct' => null
                ];
                array_push($samples,$sample);
            }
        }

        $stumps = [];
        $reached_maximum_error_limit = false;
        $sample_count = count($samples);

        //we continue our tasks until 6 round (because the result are usually same after that) or until we reach the error limit
        while(count($stumps) < 6 && !$reached_maximum_error_limit){

            //all the sample will get the same weight
            foreach($samples as &$sample){
                $sample['weight'] = 1/(double)($sample_count);
            }

            $available_codes = [];
            //we need to reset the occurrence of the subjects
            foreach ($available_optionals as $optional) {
                $optional_data[$optional->code] = [
                    'correctOnGoodSelection' => 0,
                    'incorrectOnGoodSelection' => 0,
                    'correctOnBadSelection' => 0,
                    'incorrectOnBadSelection' => 0,
                    'weight' => 0,
                ];
                array_push($available_codes,$optional->code);
            }

            //we will decide whether a sample was a correct choice or not
            foreach ($samples as &$sample){
                $user = $sample['user'];
                $subject = $sample['subject'];
                $subjects = $user->getOptionalSubjects();
                $average = $user->getGradesAverage();
                $opt_average = $user->getOptionalGradesAverage();
                $is_good_selector = $good_selector[$user->id];

                //the subject was not completed by logonUser
                if(in_array($subject->code,$available_codes)){
                    if($is_good_selector){
                        if($subject->pivot->grade >= $average){
                            $optional_data[$subject->code]['correctOnGoodSelection'] += 1;
                            $sample['correct'] = true;
                        }
                        else{
                            $optional_data[$subject->code]['incorrectOnGoodSelection'] += 1;
                            $optional_data[$subject->code]['weight'] += $sample['weight'];
                            $sample['correct'] = false;
                        }
                    }
                    else{
                        if($subject->pivot->grade < $average){
                            $optional_data[$subject->code]['correctOnBadSelection'] += 1;
                            $sample['correct'] = true;
                        }
                        else{
                            $optional_data[$subject->code]['incorrectOnBadSelection'] += 1;
                            $optional_data[$subject->code]['weight'] += $sample['weight'];
                            $sample['correct'] = false;
                        }
                    }
                }
            }

            //filter all the subjects that were not touched
            $filtered_data = [];
            foreach ($optional_data as $key => $data){
                if($data['correctOnGoodSelection']>0 || $data['incorrectOnGoodSelection']>0 || $data['correctOnBadSelection']>0 || $data['incorrectOnBadSelection']>0){
                    $filtered_data[$key] = $data;
                }
            }
            $optional_data = $filtered_data;
            
            //get giniImpurity for all the remaining subjects
            $gini_impurities = [];
            foreach ($optional_data as $key => $data){
                $gini_impurities[$key] = $this->getGiniImpurity($key,$optional_data);
            }

            //this will be the chosen stump
            $best_choice = $this->getMinimalGini($optional_data,$gini_impurities);
            if($best_choice === null){
                $reached_maximum_error_limit = true;
                break;
            }

            //maximalError will be all the wrong choice our stump made
            $maximal_error = $this->calculateMaximalError($optional_data, $best_choice, $sample_count, $reached_maximum_error_limit);

            //this will be the power of the chosen stump
            $stump_power = 0.5 * log((1-$maximal_error)/$maximal_error);

            //add the stump to the results
            $stump = [
                'subject' => $best_choice,
                'power' => $stump_power,
            ];

            array_push($stumps,$stump);

            //for later normalization we need to sum the weights
            $sum_of_weights = 0;
            
            //we decrease the weight of successful samples and increase the weight of failed samples
            foreach($samples as &$sample){
                if($sample['subject']->code == $best_choice && $sample['correct']){
                    $sample['weight'] *= pow(exp(1.0),-1*$stump_power);
                }
                else if ($sample['subject']->code == $best_choice && !$sample['correct']) {
                    $sample['weight'] *= pow(exp(1.0),$stump_power);
                }
                $sum_of_weights += $sample['weight'];
            }

            //normalization
            foreach($samples as &$sample){
                $sample['weight'] /= (double)$sum_of_weights;
            }

            //we will get a random number
            //we go through the samples, and when we reach the proper weight we will choose the sample
            //the count of the samples will be exactly the same as it was before
            $new_samples = [];
            for($index = 0; $index < $sample_count ; $index++){
                $random_number = mt_rand() / mt_getrandmax();
                $actual_weight_border = 0;
                foreach($samples as $sample){
                    $actual_weight_border += $sample['weight'];
                    if($actual_weight_border > $random_number){ 
                        array_push($new_samples,$sample);
                        break;
                    }
                }
            }
            $samples = $new_samples;
        }


        //-------------------------------------------------------------------------------------------------------
        //-------------------------------------------------------------------------------------------------------
        //-------------------------------------------------------------------------------------------------------
        //------------------------------------EVALUATION WILL STARTS HERE----------------------------------------
        //-------------------------------------------------------------------------------------------------------
        //-------------------------------------------------------------------------------------------------------

        //check which subjects had at least one stump
        $stump_subjects = [];
        foreach ($stumps as $stump){
            if(!in_array($stump['subject'],$stump_subjects)){
                array_push($stump_subjects,$stump['subject']);
            }
        }

        //all remaining subjects counter will be initialzed to 0
        $stump_counter = [];
        foreach ($stump_subjects as $stump) {
            $stump_counter[$stump] = 0;
        }

        //when a user has a grade from one of the remaining subjects
        //we will look whether it was a good choice or not 
        //if not --> we will decrease its value
        //otherwise --> increase its value
        foreach ($users as $user){
            $subjects = $user->getOptionalSubjects();
            $average = $user->getGradesAverage();
            if($subjects === null)
                continue;
            
            foreach($subjects as $subject){
                if(in_array($subject->code,$stump_subjects)){
                    foreach($stumps as &$stump){
                        if($stump['subject'] === $subject->code){
                            if($subject->pivot->grade >= $average){
                                $stump_counter[$subject->code] += (double)$stump['power'];
                            }
                            else{
                                $stump_counter[$subject->code] -= (double)$stump['power'];
                            }
                        }
                    }
                }
            }
        }

        //choosing the best option
        $max_sub_code = null;
        $max_value = null;

        foreach ($stump_counter as $key => $value) {
            if($max_sub_code === null){
                $max_sub_code = $key;
                $max_value = $value;
            }
            else{
                if($value > $max_value){
                    $max_sub_code = $key;
                    $max_value = $value;
                }
            }
        }

        //return the subject
        $advisable_subject = Subject::where('code',$max_sub_code)->first();
        if($advisable_subject == null){
            return redirect()->route('findsubject')->with('calculate_failed',true);
        }
        $logon_user->addCalculation($advisable_subject->code);
        return redirect()->route('findsubject')->with('calculated_subject',$advisable_subject);
    }
}
