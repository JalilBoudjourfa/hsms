<?php

namespace App\Http\Controllers;

use App\Mail\Payment;
use App\Models\StudentRegistration;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SendPaymentEmailController extends Controller
{
    /**
     * @author medilies
     */
    public function __invoke(Request $request): RedirectResponse
    {
        $reg = StudentRegistration::findOrFail($request->student_registration_id);

        $reg->load([
            'classroom' => [
                'classType',
                'establishmentYear',
            ],
            'student' => [
                'user',
                'clients.user',
            ],
        ]);

        $parents = $reg->student->clients->reduce(function ($parents, $client) {
            if (! empty($client->user->email)) {
                return $parents->push($client->user);
            }

            return $parents;
        }, collect([]));

        Mail::to($parents)
            ->send(new Payment($reg));

        return to_route('students.board', ['student' => $reg->student->id]);
    }
}
