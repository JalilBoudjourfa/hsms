<?php

namespace Tests\Feature\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StudentCommentControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function store(): void
    {
        $user = $this->authenticate();

        $student = $this->makeStudent();

        $student_comment_data = [
            'student_id' => $student->id,
            'content' => $this->faker->words(rand(3, 10), asText: true),
        ];

        $this->post(route('student-comments.store'), $student_comment_data)
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('students.board', ['student' => $student->id]));

        $this->assertDatabaseHas(
            'comments',
            [
                'user_id' => $user->id,
                'commentable_id' => $student->id,
                'commentable_type' => get_class($student),
                'content' => $student_comment_data['content'],
            ]
        );
    }
}
