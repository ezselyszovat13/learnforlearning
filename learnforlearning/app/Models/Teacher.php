<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable = ['name','is_accepted'];

    public function subjects() {
        return $this->belongsToMany(Subject::class)->withPivot('is_active','going_against')->withTimestamps();
    }

    public function voters() {
        return $this->belongsToMany(User::class)->withPivot('is_positive_vote','comment')->withTimestamps();
    }

    public function comments() {
        $votes = $this->voters()->get();
        $comments = [];
        foreach ($votes as $vote) {
            $user = User::where('id',$vote->pivot->user_id)->first();
            $comments[$user->name] = [
                'comment' => $vote->pivot->comment,
                'is_positive_vote' => $vote->pivot->is_positive_vote
            ];
        }
        return $comments;
    }

    public function setActivity($subjectId,$isActive){
        $subject = Subject::where('id',$subjectId)->first();
        if($subject === null) return null;
        return $this->subjects()->syncWithoutDetaching([
            $subject->id => [
                'is_active' => $isActive,
                'going_against' => 0
            ]
        ]);
    }

    public function resetGoingAgainst($subjectId){
        $subject = Subject::where('id',$subjectId)->first();
        if($subject === null) return null;
        return $this->subjects()->syncWithoutDetaching([
            $subject->id => [
                'going_against' => 0
            ]
        ]);
    }

    public function increaseGoingAgainst($subjectId,$isActive){
        $subject = Subject::where('id',$subjectId)->first();
        if($subject === null) return null;

        $subject = $this->subjects()->where('subject_id',$subjectId)->first();
        if($subject === null) return null;

        $isOpposite = ($subject->pivot->is_active != $isActive);
        if($isOpposite){
            $goingAgainstValue = $subject->pivot->going_against;
            return $this->subjects()->syncWithoutDetaching([
                $subject->id => [
                    'going_against' => $goingAgainstValue + 1,
                ]
            ]);
        }
    }

    public function setAccepted($acceptValue) {
        $this->update(['is_accepted' => true]);
    }
}
