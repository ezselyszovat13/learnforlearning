<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'spec'
    ];

    public function subjects() {
        return $this->belongsToMany(Subject::class)->withPivot('grade')->withTimestamps();
    }

    public function getGrades() {
        $subjects = $this->subjects()->select('code')->get();
        $grades = [];
        foreach ($subjects as $subject) {
            $grades[$subject->code] = $subject->pivot->grade;
        }
        return $grades;
    }

    public function getGradesCount(){
        return count($this->getGrades());
    }

    public function getGradesAverage() {
        if($this->getGradesCount()==0)
            return null;
        
        return $this->subjects()->pluck('grade')->avg();
    }

    public function getAcquiredCredits(){
        if($this->getGradesCount()==0)
            return 0;
        
        return $this->subjects()->pluck('credit_points')->sum();
    }

    public function getGrade($code) {
        $subject = $this->subjects()->where('code', $code)->select('code')->first();
        if (!$subject) return null;
        return (int) $subject->pivot->grade;
    }

    public function setGrade($code, $grade) {
        $subject = Subject::where('code', $code)->get('id')->first();
        if (!$subject) return null;
        return $this->subjects()->syncWithoutDetaching([
            $subject->id => [
                'grade' => $grade,
            ]
        ]);
    }

    public function hasSpecialization(){
        return $this['spec'] !== "NOTHING";
    }

    public function getAvailableOptionalSubjects(){
        $spec = null;
        if(!$this->hasSpecialization())
            return null;
        else
            $spec = $this['spec'];

        $subjects = Subject::all();
        $userSubjects = $this->subjects()->pluck('code')->toArray();
        $optSubjects = [];
        foreach ($subjects as $subject) {
            if(!in_array($subject->code,$userSubjects)){
                if($spec == 'A'){
                    if($subject['existsOnA'] && $subject['optionalOnA']){
                        array_push($optSubjects,$subject);
                    }
                }
                else if($spec == 'B'){
                    if($subject['existsOnB'] && $subject['optionalOnB']){
                        array_push($optSubjects,$subject);
                    }
                }
                else if($spec == 'C'){
                    if($subject['existsOnC'] && $subject['optionalOnC']){
                        array_push($optSubjects,$subject);
                    }
                }
            }
        }
        return $optSubjects;
    }

    public function getOptionalSubjects(){
        $spec = null;
        if(!$this->hasSpecialization())
            return null;
        else
            $spec = $this['spec'];

        $subjects = $this->subjects()->get();
        $optSubjects = [];
        foreach ($subjects as $subject) {
            if($spec == 'A'){
                if($subject['existsOnA'] && $subject['optionalOnA']){
                    array_push($optSubjects,$subject);
                }
            }
            else if($spec == 'B'){
                if($subject['existsOnB'] && $subject['optionalOnB']){
                    array_push($optSubjects,$subject);
                }
            }
            else if($spec == 'C'){
                if($subject['existsOnC'] && $subject['optionalOnC']){
                    array_push($optSubjects,$subject);
                }
            }
        }
        return $optSubjects;
    }

    public function getOptionalGradesCount(){
        return count($this->getOptionalSubjects());
    }

    public function getOptionalGradesAverage(){
        $optCount = $this->getOptionalGradesCount();
        if($optCount==0)
            return null;
        
        $subjects = $this->getOptionalSubjects();
        $sum = 0.0;

        foreach ($subjects as $subject) {
            $sum = $sum + $subject->pivot->grade;
        }
        return $sum/$optCount;
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
