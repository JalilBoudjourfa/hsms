<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\StudentInterview;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StudentInterviewControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function store(): void
    {
        $this->authenticate();

        $student = $this->makeStudent();

        $interview = StudentInterview::factory()
            ->for($student->latestRegistration)
            ->make();

        $interview_data = collect($interview->toArray())->only(['participants', 'interrogators', 'title', 'note', 'student_registration_id'])->toArray() + ['schedule' => $interview->schedule->toDateTimeString()];

        $this->post(route('student-interviews.store'), $interview_data)
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('students.board', ['student' => $student->id]));

        $this->assertDatabaseHas('student_interviews', $interview_data);
    }
}
