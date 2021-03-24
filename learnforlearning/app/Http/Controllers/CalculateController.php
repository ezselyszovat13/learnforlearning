<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Subject;
use Auth;

class CalculateController extends Controller
{
    private function getGoodSelectorInformations(){
        //decides, whether a person has chosen great optionals or not
        $users = User::all();
        $goodSelector = [];

        foreach ($users as $user) {
            $average = $user->getGradesAverage();
            $optAverage = $user->getOptionalGradesAverage();
            //if there is no optional subjects yet, the user is not included in the calculation
            if($average === null || $optAverage === null)
                continue;
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

        var_dump("EZVOLTAMÉRET:" . count($giniImpurities));

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
            throw new Exception('IMPOSSIBLE.');
        }
        return $minGini;
    } 

    public function calculateOptional(){
        $goodSelector = $this->getGoodSelectorInformations();

        //we will count for all the optional whether they were good or not when user was a good selector or not
        $logonUser = Auth::User();
        $availableOptionals = $logonUser->getAvailableOptionalSubjects();
        $optionalData = [];
        $availableCodes = [];
        
        $users = User::all();
        $userCount = User::count();


        //create the samples
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
        //repeat it until we get 5 stump

        $reachedMaximumErrorLimit = false;
        $sampleCount = count($samples);

        while(count($stumps) < 6 && !$reachedMaximumErrorLimit){
        
        echo '<pre>';
            var_dump(count($stumps)+1 . "kör");
        echo '</pre>';

        //add initial weights

        var_dump("SZEMPKÁNT:" . $sampleCount);
        foreach($samples as &$sample){
            $sample['weight'] = 1/(double)($sampleCount);
        }

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

        $WEIGHTSUM = 0;

        foreach ($samples as &$sample){
            echo '<pre>';
                //var_dump($sample['weight']);
                $WEIGHTSUM += $sample["weight"];
            echo '</pre>';
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
    
        var_dump("SZUMM:" . $WEIGHTSUM);

        var_dump("OPTIONALCOUNT: " . count($optionalData));

        //filter all the subjects that were not touched
        $filteredData = [];
        foreach ($optionalData as $key => $data){
            if($data['correctOnGoodSelection']>0 || $data['incorrectOnGoodSelection']>0 || $data['correctOnBadSelection']>0 || $data['incorrectOnBadSelection']>0){
                $filteredData[$key] = $data;
            }
        }
        $optionalData = $filteredData;
        
        var_dump("OPTIONALCOUNT: " . count($optionalData));

        //get giniImpurity for all the remaining subjects
        $giniImpurities = [];

        foreach ($optionalData as $key => $data){
            $giniImpurities[$key] = $this->getGiniImpurity($key,$optionalData);
        }
        //this will be the chosen stump
        $bestChoice = $this->getMinimalGini($optionalData,$giniImpurities);

        var_dump($optionalData[$bestChoice]['incorrectOnGoodSelection']);
        var_dump($optionalData[$bestChoice]['incorrectOnBadSelection']);
        var_dump($optionalData[$bestChoice]['weight']);

        $maximalError = ($optionalData[$bestChoice]['incorrectOnGoodSelection'] + $optionalData[$bestChoice]['incorrectOnBadSelection'])*$optionalData[$bestChoice]['weight'];
        if($maximalError > 1){
            $maximalError = 1 - 1/(double)($sampleCount*10); 
            $reachedMaximumErrorLimit = true;
        }
        if($maximalError == 0) 
            $maximalError += 1/(double)($sampleCount*10);
        else if($maximalError == 1)
            $maximalError -= 1/(double)($sampleCount*10);

        //this will be the power of the chosen stump
        var_dump("MAXERROR:" . $maximalError);
        $stumpPower = 0.5 * log((1-$maximalError)/$maximalError);
        var_dump("STUMPPOW: " . $stumpPower);

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
                //var_dump("HELPER".-1*$stumpPower);
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

        $newSamples = [];
        for($index = 0; $index < $sampleCount ; $index++){
            $randomNumber = mt_rand() / mt_getrandmax();
            $actualWeightBorder = 0;
            foreach($samples as $sample){
                //var_dump("ACT1: ".$actualWeightBorder);
                $actualWeightBorder += $sample['weight'];
                //var_dump("ACT2: ".$actualWeightBorder);
                //var_dump("RAND: ".$randomNumber);
                //var_dump("SW: ".$sample['weight']);
                if($actualWeightBorder > $randomNumber){ 
                    array_push($newSamples,$sample);
                    break;
                }
            }
        }
        var_dump(count($newSamples));
        $samples = $newSamples;
        }


        //-------------------------------------------------------------------------------------------------------
        //-------------------------------------------------------------------------------------------------------
        //-------------------------------------------------------------------------------------------------------
        //------------------------------------EVALUATION WILL STARTS HERE----------------------------------------
        //-------------------------------------------------------------------------------------------------------
        //-------------------------------------------------------------------------------------------------------

        //csinálunk minden tárgynak egy összegzőt
        //végigmegyünk a user-ek jegyein a kialakított stump-oknak megfelelően
        //ha valakinél megtalálunk egyet és neki jó választás volt ez --> hozzáadjuk az értéket az addigihez
        //ha valakinél ez rossza választás volt --> kivonjuk az értéket az addigiből
        //a legmagasabb pontot elérő lesz a javaslat

        //var_dump($stumps);

        //$subject = Subject::where('id',1)->first();
        //return redirect()->route('findsubject')->with('calculated_subject_name',$subject->name);
    }
}
