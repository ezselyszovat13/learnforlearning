<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = ['name','code','credit_points','even_semester','existsOnA','existsOnB','existsOnC','optionalOnA','optionalOnB','optionalOnC','url'];

    public function users() {
        return $this->belongsToMany(User::class)->withPivot('grade')->withTimestamps();
    }
}
