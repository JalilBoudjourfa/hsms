<?php

namespace Database\Populators;

use App\Models\Classroom;
use App\Models\ExRegistration;
use App\Models\Student;
use App\Models\StudentInterview;
use App\Models\StudentRegistration;
use ElaborateCode\AlgerianProvinces\Models\Wilaya;

class StudentRegistrationPopulator
{
    public function populate(Student $student, Classroom $classroom, Wilaya $wilaya): StudentRegistration
    {
        // TODO add nullables
        $reg = StudentRegistration::factory()->for($classroom)->for($student)->create();

        $ex_registration = ExRegistration::factory()->for($wilaya)->for($reg)->create();
        $ex_registration->setRelation('registration', $reg);
        $reg->setRelation('exRegistration', $ex_registration);

        $student_interview = StudentInterview::factory()->for($reg)->create();
        $student->setRelation('studentRegistration', $reg);
        $reg->setRelation('studentInterview', $student_interview);

        return $reg;
    }
}
