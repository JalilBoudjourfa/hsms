<?php

namespace App\Mail;

use App\Models\StudentRegistration;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Payment extends Mailable
{
    use Queueable, SerializesModels;

    protected $reg;

    /**
     * @author medilies
     */
    public function __construct(StudentRegistration $reg)
    {
        $this->reg = $reg;
    }

    /**
     * @author medilies
     */
    public function build(): self
    {
        $this->markdown('emails.payments.payment', [
            'student' => $this->reg->student,
            'class_type' => $this->reg->classroom->classType,
            'est_y' => $this->reg->classroom->establishmentYear,
        ])
            ->locale(config('app.locale'))
            ->tag('')
            ->from('ghs.medilies@gmail.com', 'Mohamed Ilies BOUDOUMA')
            ->replyTo('ghs.medilies@gmail.com', 'Mohamed Ilies BOUDOUMA');

        return $this;
    }
}
