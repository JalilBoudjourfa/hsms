<?php

namespace Tests\Feature\Mail;

use App\Mail\Payment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PaymentTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function paymentEmailContent(): void
    {
        $student = $this->makeStudent();

        $mailable = new Payment($student->latestRegistration);

        $mailable->assertSeeInText($student->user->name);
        $mailable->assertSeeInText($student->latestRegistration->classroom->establishmentYear->year_id);
        $mailable->assertSeeInText($student->latestRegistration->classroom->establishmentYear->establishment_id);
        $mailable->assertSeeInText($student->latestRegistration->classroom->classType->cycle_id);
        $mailable->assertSeeInText($student->latestRegistration->classroom->classType->name);
    }
}
