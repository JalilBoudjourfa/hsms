<?php

namespace App\Models;

use ElaborateCode\AlgerianEducationSystem\Models\ClassType as ModelsClassType;
use ElaborateCode\EloquentLogs\Concerns\HasLogs;

class ClassType extends ModelsClassType
{
    use HasLogs;

    /*
    |-------------------------------------
    | Relationships
    |-------------------------------------
    */

    public function classrooms()
    {
        return $this->hasMany(Classroom::class);
    }

    public function studentRegistrations()
    {
        return $this->hasManyThrough(StudentRegistration::class, Classroom::class);
    }
}
