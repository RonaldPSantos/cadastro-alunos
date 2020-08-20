<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseStudent extends Model
{
    protected $fillable = ['main'];

    public function students()
    {
        return $this->belongsToMany(Student::class);
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class);
    }
}
