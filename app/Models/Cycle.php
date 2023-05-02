<?php

namespace App\Models;

use ElaborateCode\AlgerianEducationSystem\Models\Cycle as ModelsCycle;

class Cycle extends ModelsCycle
{
    /*
    |-------------------------------------
    | Relationships
    |-------------------------------------
    */

    public function classrooms()
    {
        return $this->hasManyThrough(Classroom::class, ClassType::class);
    }
}
