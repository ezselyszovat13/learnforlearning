<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Carbon\Carbon;

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
        'spec',
        'is_admin'
    ];

    public function subjects() {
        return $this->belongsToMany(Subject::class)->withPivot('grade')->withTimestamps();
    }

    public function votes(){
        return $this->belongsToMany(Teacher::class)->withPivot('is_positive_vote','comment')->withTimestamps();
    }

    public function calculations()
    {
        return $this->hasMany(Calculation::class);
    }

    public function vote($teacher_id, $is_positive){
        $teacher = Teacher::where('id', $teacher_id)->get('id')->first();
        if (!$teacher) return null;
        $vote = $this->votes()->where('teacher_id', $teacher_id)->first();
        if($vote !== null && $vote->pivot->is_positive_vote === $is_positive){
            if($vote->pivot->comment !== null){
                return $this->votes()->syncWithoutDetaching([
                    $teacher->id => [
                        'is_positive_vote' => null,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now()
                    ]
                ]);
            }
            $this->votes()->detach($teacher);
        }
        else{
            return $this->votes()->syncWithoutDetaching([
                $teacher->id => [
                    'is_positive_vote' => $is_positive,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]
            ]);
        }
    }

    public function deleteComment($teacher_id){
        $teacher = Teacher::where('id', $teacher_id)->get('id')->first();
        if (!$teacher) return null;
        $vote = $this->votes()->where('teacher_id', $teacher_id)->first();
        if($vote !== null && $vote->pivot->is_positive_vote !== null){
            return $this->votes()->syncWithoutDetaching([
                $teacher->id => [
                    'comment' => null,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]
            ]);
        }
        else if ($vote->pivot->is_positive_vote === null){
            return $this->votes()->detach($teacher);
        }
        else return null;
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

    public function addCalculation($subject_code){
       $this->calculations()->create(['subject_code' => $subject_code]);
    }

    public function deleteOldCalculations(){
        $this->calculations()->delete();
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
        $user_subjects = $this->subjects()->pluck('code')->toArray();
        $opt_subjects = [];
        foreach ($subjects as $subject) {
            if(!in_array($subject->code,$user_subjects)){
                if($spec == 'A'){
                    if($subject['existsOnA'] && $subject['optionalOnA']){
                        array_push($opt_subjects,$subject);
                    }
                }
                else if($spec == 'B'){
                    if($subject['existsOnB'] && $subject['optionalOnB']){
                        array_push($opt_subjects,$subject);
                    }
                }
                else if($spec == 'C'){
                    if($subject['existsOnC'] && $subject['optionalOnC']){
                        array_push($opt_subjects,$subject);
                    }
                }
            }
        }
        return $opt_subjects;
    }

    public function getOptionalSubjects(){
        $spec = null;
        if(!$this->hasSpecialization())
            return null;
        else
            $spec = $this['spec'];

        $subjects = $this->subjects()->get();
        $opt_subjects = [];
        foreach ($subjects as $subject) {
            if($spec == 'A'){
                if($subject['existsOnA'] && $subject['optionalOnA']){
                    array_push($opt_subjects,$subject);
                }
            }
            else if($spec == 'B'){
                if($subject['existsOnB'] && $subject['optionalOnB']){
                    array_push($opt_subjects,$subject);
                }
            }
            else if($spec == 'C'){
                if($subject['existsOnC'] && $subject['optionalOnC']){
                    array_push($opt_subjects,$subject);
                }
            }
        }
        return $opt_subjects;
    }

    public function getOptionalGradesCount(){
        $optionals = $this->getOptionalSubjects();
        if($optionals === null)
            return 0;
        return count($optionals);
    }

    public function getOptionalGradesAverage(){
        $opt_count = $this->getOptionalGradesCount();
        if($opt_count==0)
            return null;
        
        $subjects = $this->getOptionalSubjects();
        $sum = 0.0;

        foreach ($subjects as $subject) {
            $sum = $sum + $subject->pivot->grade;
        }
        return $sum/$opt_count;
    }

    public function addComment($teacher_id, $comment){
        $teacher = Teacher::where('id', $teacher_id)->get('id')->first();
        if (!$teacher) return null;
        return $this->votes()->syncWithoutDetaching([
            $teacher_id => [
                'comment' => $comment,
            ]
        ]);
    }

    public function comments() {
        $votes = $this->votes()->get();
        $comments = [];
        foreach ($votes as $vote) {
            $teacher = Teacher::where('id',$vote->pivot->teacher_id)->first();
            $comments[$teacher->id] = [
                'teacher_name' => $teacher->name,
                'comment' => $vote->pivot->comment,
                'is_positive_vote' => $vote->pivot->is_positive_vote
            ];
        }
        return $comments;
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
