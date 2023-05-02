<?php

namespace Tests\Feature\Http\Controllers\Users;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StudentBoardControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function invoke(): void
    {
        $this->authenticate();

        $student = $this->makeStudent();

        $see = [
            $student->family->id,

            $student->id,
            $student->user->name,
            $student->user->email,
            $student->ar_fname,
            $student->ar_lname,
            $student->bday->format('Y-m-d'),
            strtoupper($student->bwilaya),
            $student->bplace,

            __(ucfirst($student->latestRegistration->status)),
            $student->latestRegistration->classroom->classType->name,

            $student->latestRegistration->exRegistration->classType->alias,
            $student->latestRegistration->exRegistration->establishment_name,
        ];

        $this->get(route('students.board', ['student' => $student->id]))
            ->assertOk()
            ->assertSeeText($see);
    }
}
