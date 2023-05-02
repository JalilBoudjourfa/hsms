<?php

namespace Tests\Feature\Http\Controllers;

use App\Mail\Payment;
use App\Models\Client;
use App\Models\Family;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class SendPaymentEmailControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function invoke(): void
    {
        $this->authenticate();

        Mail::fake();

        $fam = Family::factory()->create();

        $father = Client::factory()->isFather()
            ->for($fam)
            ->create();
        $father_user = User::factory()
            ->for($father, 'profilable')
            ->create();

        $mother = Client::factory()->isMother()
            ->for($fam)
            ->create();

        $mother_user = User::factory()
            ->for($mother, 'profilable')
            ->create();

        $student = $this->makeStudent(['fam' => $fam]);

        $this->post(route('send_email.payment'), ['student_registration_id' => $student->latestRegistration->id])
            ->assertRedirect(route('students.board', ['student' => $student->id]));

        Mail::assertSent(Payment::class, 1);
        Mail::assertSent(Payment::class, function ($mail) use ($father_user, $mother_user) {
            return $mail->hasTo($father_user->email) && $mail->hasTo($mother_user->email);
        });
    }
}
