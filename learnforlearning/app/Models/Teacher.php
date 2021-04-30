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

    public function isActive(){
        return $this->is_accepted;
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

    public function setActivity($subject_id,$is_active){
        $subject = Subject::where('id',$subject_id)->first();
        if($subject === null) return null;
        return $this->subjects()->syncWithoutDetaching([
            $subject->id => [
                'is_active' => $is_active,
                'going_against' => 0
            ]
        ]);
    }

    public function getActivity($subject_id){
        $subject = Subject::where('id',$subject_id)->first();
        if($subject === null) return null;
        return $this->subjects()->where('subject_id', $subject_id)->first()->pivot->is_active;
    }

    public function getGoingAgainst($subject_id){
        $subject = Subject::where('id',$subject_id)->first();
        if($subject === null) return null;
        return $this->subjects()->where('subject_id', $subject_id)->first()->pivot->going_against;
    }

    public function resetGoingAgainst($subject_id){
        $subject = Subject::where('id',$subject_id)->first();
        if($subject === null) return null;
        return $this->subjects()->syncWithoutDetaching([
            $subject->id => [
                'going_against' => 0
            ]
        ]);
    }

    public function increaseGoingAgainst($subject_id,$is_act){
        $subject = Subject::where('id',$subject_id)->first();
        if($subject === null) return null;

        $subject = $this->subjects()->where('subject_id',$subject_id)->first();
        if($subject === null) return null;

        $is_opposite = ($subject->pivot->is_active != $is_act);
        if($is_opposite){
            $going_against_value = $subject->pivot->going_against;
            return $this->subjects()->syncWithoutDetaching([
                $subject->id => [
                    'going_against' => $going_against_value + 1,
                ]
            ]);
        }
    }

    public function setAccepted() {
        $this->update(['is_accepted' => true]);
    }
}
