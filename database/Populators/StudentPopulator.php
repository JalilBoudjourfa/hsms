<?php

namespace Database\Populators;

use App\Models\Family;
use App\Models\Student;
use App\Models\User;
use ElaborateCode\AlgerianProvinces\Models\Wilaya;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;

class StudentPopulator
{
    public function populate(?Family $fam = null, ?Wilaya $wilaya = null, bool $createParentRelatioships = false): Student
    {
        if ((! isset($fam) || ! isset($wilaya)) && ! $createParentRelatioships) {
            throw new \Exception('You must provide Family model and Wilaya model to create a student', 1);
        }

        $fam ??= Family::factory()->create();

        $wilaya ??= Wilaya::find(random_int(1, 58));

        $student = Student::factory()->for($fam)->for($wilaya, 'birthWilaya')->create();

        $user = User::factory()->for($student, 'profilable')->create();

        $student->setRelation('family', $fam);
        $student->setRelation('birthWilaya', $wilaya);
        $student->setRelation('user', $user);

        if (! isset($fam->students)) {
            $fam->setRelation('students', new EloquentCollection);
        }

        $fam->students->push($student);

        return $student;
    }
}
