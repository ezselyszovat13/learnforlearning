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
        $goodSelector = [];

        foreach ($users as $user) {
            $average = $user->getGradesAverage();
            $optAverage = $user->getOptionalGradesAverage();
            //if there is no optional subjects yet, the user is not included in the calculation
            if($average === null || $optAverage === null)
                continue;
            //he/she is a good selector if his/her average is better because of these subjects
            $goodSelector[$user->id] = ($average <= $optAverage);
        }

        return $goodSelector;
    }

    private function getGiniImpurity($subject_code, &$optionalData){
        $correctOnGood = $optionalData[$subject_code]['correctOnGoodSelection'];
        $incorrectOnGood = $optionalData[$subject_code]['incorrectOnGoodSelection'];
        $correctOnBad = $optionalData[$subject_code]['correctOnBadSelection'];
        $incorrectOnBad = $optionalData[$subject_code]['incorrectOnBadSelection'];
        $totalGood = $correctOnGood + $incorrectOnGood;
        $totalBad = $correctOnBad + $incorrectOnBad;
        $total = $totalGood + $totalBad;

        //var_dump($correctOnGood . " " . $incorrectOnGood . " " . $correctOnBad . " " . $incorrectOnBad . " -----------------------");

        $correctLeft = $correctOnGood>0 ? pow(($correctOnGood / (double)$totalGood),2) : 0;
        $incorrectLeft = $incorrectOnGood>0 ? pow(($incorrectOnGood / (double)$totalGood),2) : 0;
        $correctRight = $correctOnBad ? pow(($correctOnBad / (double)$totalBad),2) : 0;
        $incorrectRight = $incorrectOnBad ? pow(($incorrectOnBad / (double)$totalBad),2) : 0;

        $leftGini = 1 - $correctLeft - $incorrectLeft;
        $rightGini = 1 - $correctRight - $incorrectRight;

        //weighted sum
        return ($totalGood/$total)*$leftGini + ($totalBad/$total)*$rightGini;
    }

    private function getMinimalGini(&$optionalData,&$giniImpurities){
        $minGini = null;
        $minGiniValue = null;
        $occurrence = 0;

        foreach ($giniImpurities as $key => $data){
            if($minGini === null){
                $minGini = $key;
                $minGiniValue = $data;
                $occurrence = $optionalData[$key]['correctOnGoodSelection'] + 
                    $optionalData[$key]['incorrectOnGoodSelection'] + $optionalData[$key]['correctOnBadSelection'] + 
                    $optionalData[$key]['incorrectOnBadSelection'];
            }
            else{
                if($data < $minGiniValue){
                    $minGini = $key;
                    $minGiniValue = $data;
                    $occurrence = $optionalData[$key]['correctOnGoodSelection'] + 
                        $optionalData[$key]['incorrectOnGoodSelection'] + $optionalData[$key]['correctOnBadSelection'] + 
                        $optionalData[$key]['incorrectOnBadSelection'];
                }
                else if($data === $minGiniValue){
                    $actOccurrence = $optionalData[$key]['correctOnGoodSelection'] + 
                        $optionalData[$key]['incorrectOnGoodSelection'] + $optionalData[$key]['correctOnBadSelection'] + 
                        $optionalData[$key]['incorrectOnBadSelection'];
                    if($actOccurrence > $occurrence){
                        $minGini = $key;
                        $minGiniValue = $data;
                        $occurrence = $actOccurrence;
                    }
                }
            }
        }
        if($minGini === null){
            return null;
        }
        return $minGini;
    } 

    private function calculateMaximalError(&$optionalData, $bestChoice, $sampleCount){
        $maximalError = ($optionalData[$bestChoice]['incorrectOnGoodSelection'] + $optionalData[$bestChoice]['incorrectOnBadSelection'])*$optionalData[$bestChoice]['weight'];

        //we need to define cases for extreme values
        if($maximalError > 1){
            $maximalError = 1 - 1/(double)($sampleCount*10); 
            $reachedMaximumErrorLimit = true;
        }
        if($maximalError == 0) 
            $maximalError += 1/(double)($sampleCount*10);
        else if($maximalError == 1)
            $maximalError -= 1/(double)($sampleCount*10);

        return $maximalError;
    }

    public function calculateOptional(DoCalculationFormRequest $request){
        $data = $request->all();

        //we need to get the semester we are in
        $isEvenSemester = null;
        if($data['semester'] == "1"){
            $isEvenSemester = false;
        }
        else if($data['semester'] == "2"){
            $isEvenSemester = true;
        }

        $goodSelector = $this->getGoodSelectorInformations();

        //we will count for all the optional whether they were good or not when user was a good selector or not
        $logonUser = Auth::User();
        //we need these, because these are the only subjects the user can choose
        $availableOptionals = $logonUser->getAvailableOptionalSubjects();

        //we need to filter the options depends on the semester
        $filteredAvailable = [];
        foreach($availableOptionals as $availableOpt){
            if($availableOpt->even_semester == $isEvenSemester){
                array_push($filteredAvailable,$availableOpt);
            }
        }
        $availableOptionals = $filteredAvailable;

        $optionalData = [];
        $availableCodes = [];
        
        $users = User::all();
        $userCount = User::count();

        //create the initial samples in (user-subject-weight-correct) form
        $samples = [];
        foreach ($users as $user){
            $subjects = $user->getOptionalSubjects();
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
        $reachedMaximumErrorLimit = false;
        $sampleCount = count($samples);

        //we continue our tasks until 6 round (because the result are usually same after that) or until we reach the error limit
        while(count($stumps) < 6 && !$reachedMaximumErrorLimit){

            //all the sample will get the same weight
            foreach($samples as &$sample){
                $sample['weight'] = 1/(double)($sampleCount);
            }

            $availableCodes = [];
            //we need to reset the occurrence of the subjects
            foreach ($availableOptionals as $optional) {
                $optionalData[$optional->code] = [
                    'correctOnGoodSelection' => 0,
                    'incorrectOnGoodSelection' => 0,
                    'correctOnBadSelection' => 0,
                    'incorrectOnBadSelection' => 0,
                    'weight' => 0,
                ];
                array_push($availableCodes,$optional->code);
            }

            //we will decide whether a sample was a correct choice or not
            foreach ($samples as &$sample){
                $user = $sample['user'];
                $subject = $sample['subject'];
                $subjects = $user->getOptionalSubjects();
                $average = $user->getGradesAverage();
                $optAverage = $user->getOptionalGradesAverage();
                $isGoodSelector = $goodSelector[$user->id];

                //the subject was not completed by logonUser
                if(in_array($subject->code,$availableCodes)){
                    if($isGoodSelector){
                        if($subject->pivot->grade >= $average){
                            $optionalData[$subject->code]['correctOnGoodSelection'] += 1;
                            $sample['correct'] = true;
                        }
                        else{
                            $optionalData[$subject->code]['incorrectOnGoodSelection'] += 1;
                            $optionalData[$subject->code]['weight'] += $sample['weight'];
                            $sample['correct'] = false;
                        }
                    }
                    else{
                        if($subject->pivot->grade < $average){
                            $optionalData[$subject->code]['correctOnBadSelection'] += 1;
                            $sample['correct'] = true;
                        }
                        else{
                            $optionalData[$subject->code]['incorrectOnBadSelection'] += 1;
                            $optionalData[$subject->code]['weight'] += $sample['weight'];
                            $sample['correct'] = false;
                        }
                    }
                }
            }

            //filter all the subjects that were not touched
            $filteredData = [];
            foreach ($optionalData as $key => $data){
                if($data['correctOnGoodSelection']>0 || $data['incorrectOnGoodSelection']>0 || $data['correctOnBadSelection']>0 || $data['incorrectOnBadSelection']>0){
                    $filteredData[$key] = $data;
                }
            }
            $optionalData = $filteredData;
            
            //get giniImpurity for all the remaining subjects
            $giniImpurities = [];
            foreach ($optionalData as $key => $data){
                $giniImpurities[$key] = $this->getGiniImpurity($key,$optionalData);
            }

            //this will be the chosen stump
            $bestChoice = $this->getMinimalGini($optionalData,$giniImpurities);
            if($bestChoice === null){
                $reachedMaximumErrorLimit = true;
                break;
            }

            //maximalError will be all the wrong choice our stump made
            $maximalError = $this->calculateMaximalError($optionalData,$bestChoice, $sampleCount);

            //this will be the power of the chosen stump
            $stumpPower = 0.5 * log((1-$maximalError)/$maximalError);

            //add the stump to the results
            $stump = [
                'subject' => $bestChoice,
                'power' => $stumpPower,
            ];

            array_push($stumps,$stump);

            //for later normalization we need to sum the weights
            $sumOfWeights = 0;
            
            //we decrease the weight of successful samples and increase the weight of failed samples
            foreach($samples as &$sample){
                if($sample['subject']->code == $bestChoice && $sample['correct']){
                    $sample['weight'] *= pow(exp(1.0),-1*$stumpPower);
                }
                else if ($sample['subject']->code == $bestChoice && !$sample['correct']) {
                    $sample['weight'] *= pow(exp(1.0),$stumpPower);
                }
                $sumOfWeights += $sample['weight'];
            }

            //normalization
            foreach($samples as &$sample){
                $sample['weight'] /= (double)$sumOfWeights;
            }

            //we will get a random number
            //we go through the samples, and when we reach the proper weight we will choose the sample
            //the count of the samples will be exactly the same as it was before
            $newSamples = [];
            for($index = 0; $index < $sampleCount ; $index++){
                $randomNumber = mt_rand() / mt_getrandmax();
                $actualWeightBorder = 0;
                foreach($samples as $sample){
                    $actualWeightBorder += $sample['weight'];
                    if($actualWeightBorder > $randomNumber){ 
                        array_push($newSamples,$sample);
                        break;
                    }
                }
            }
            $samples = $newSamples;
        }


        //-------------------------------------------------------------------------------------------------------
        //-------------------------------------------------------------------------------------------------------
        //-------------------------------------------------------------------------------------------------------
        //------------------------------------EVALUATION WILL STARTS HERE----------------------------------------
        //-------------------------------------------------------------------------------------------------------
        //-------------------------------------------------------------------------------------------------------

        //check which subjects had at least one stump
        $stumpSubjects = [];
        foreach ($stumps as $stump){
            if(!in_array($stump['subject'],$stumpSubjects)){
                array_push($stumpSubjects,$stump['subject']);
            }
        }

        //all remaining subjects counter will be initialzed to 0
        $stumpCounter = [];
        foreach ($stumpSubjects as $stump) {
            $stumpCounter[$stump] = 0;
        }

        //when a user has a grade from one of the remaining subjects
        //we will look whether it was a good choice or not 
        //if not --> we will decrease its value
        //otherwise --> increase its value
        foreach ($users as $user){
            $subjects = $user->getOptionalSubjects();
            $average = $user->getGradesAverage();
            foreach($subjects as $subject){
                if(in_array($subject->code,$stumpSubjects)){
                    foreach($stumps as &$stump){
                        if($stump['subject'] === $subject->code){
                            if($subject->pivot->grade >= $average){
                                $stumpCounter[$subject->code] += (double)$stump['power'];
                            }
                            else{
                                $stumpCounter[$subject->code] -= (double)$stump['power'];
                            }
                        }
                    }
                }
            }
        }

        //choosing the best option
        $maxSubCode = null;
        $maxValue = null;

        foreach ($stumpCounter as $key => $value) {
            if($maxSubCode === null){
                $maxSubCode = $key;
                $maxValue = $value;
            }
            else{
                if($value > $maxValue){
                    $maxSubCode = $key;
                    $maxValue = $value;
                }
            }
        }

        //return the subject
        $advisableSubject = Subject::where('code',$maxSubCode)->first();
        if($advisableSubject == null){
            return redirect()->route('findsubject')->with('calculate_failed',true);
        }
        $user->addCalculation($advisableSubject->code);
        return redirect()->route('findsubject')->with('calculated_subject',$advisableSubject);
    }
}
