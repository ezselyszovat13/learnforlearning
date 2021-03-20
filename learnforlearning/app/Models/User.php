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
