<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = ['code', 'name', 'photo','status'];

    public function courses()
    {
        return $this->belongsToMany(Course::class);
    }
}
