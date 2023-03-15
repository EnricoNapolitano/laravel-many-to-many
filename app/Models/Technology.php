<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Technology extends Model
{
    use HasFactory;

    //allow to fill 
    protected $fillable = ['label', 'class_icon'];

    //relation with Project model
    public function projects(){
        return $this->belongsToMany(Project::class);
    }
}
