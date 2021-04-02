<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function subjects() {
        return $this->belongsToMany(Subject::class);
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
}
