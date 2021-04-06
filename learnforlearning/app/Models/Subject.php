<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = ['name','code','credit_points','even_semester','existsOnA','existsOnB','existsOnC','optionalOnA','optionalOnB','optionalOnC','url','is_accepted'];

    public function users() {
        return $this->belongsToMany(User::class)->withPivot('grade')->withTimestamps();
    }

    public function teachers() {
        return $this->belongsToMany(Teacher::class)->withPivot('is_active','going_against')->withTimestamps();
    }

    public function setAccepted($acceptValue){
        $this->update(['is_accepted' => true]);
    }
}
