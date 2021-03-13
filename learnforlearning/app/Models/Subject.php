<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = ['name','even_semester','existsOnA','existsOnB','existsOnC','optionalOnA','optionalOnB','optionalOnC','url'];

    public function users() {
        return $this->belongsToMany(User::class);
    }
}
