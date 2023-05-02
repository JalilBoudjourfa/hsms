<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePaymentRequest;
use App\Http\Requests\UpdatePaymentRequest;
use App\Models\Expense;
use App\Models\Payment;
use App\Models\StudentRegistration;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\View as FacadesView;
use Illuminate\Support\Str;
use Mpdf\HTMLParserMode;
use Mpdf\Mpdf;
use Mpdf\Output\Destination;

class PaymentController extends Controller
{
    public function create(StudentRegistration $reg, Expense $expense): View|Factory
    {
        $reg->load([
            'student.user',
            'classroom.establishmentYear',
        ]);

        return view('payments.create')
            ->with('reg', $reg)
            ->with('expense', $expense);
    }

    public function store(StorePaymentRequest $request, StudentRegistration $reg, Expense $expense): RedirectResponse
    {
        if (!$this->validTransaction($request, $expense)) {
            return back()->withInput();
        }

        $reg->payments()->create($request->validated() + ['expense_id' => $expense->id]);

        return to_route('students.board', ['student' => $reg->student_id]);
    }

    public function edit(Payment $payment): View|Factory
    {
        $payment->load([
            'expense',
            'studentRegistration' => [
                'student' => [
                    'user',
                ],
                'classroom' => [
                    'establishmentYear',
                ],
            ],
        ]);

        return view('payments.edit')
            ->with('payment', $payment);
    }

    public function update(UpdatePaymentRequest $request, Payment $payment)
    {
        if (!$this->validTransaction($request, $payment->expense)) {
            return to_route('payments.edit', ['payment' => $payment->id]);
        }

        foreach ($request->validated() as $prop_name => $value) {
            if ($payment->$prop_name != $value) {
                $payment->$prop_name = $value;
            }
        }

        $payment->save();

        return to_route('payments.edit', ['payment' => $payment->id]);
    }

    public function receipt(Payment $payment)
    {
        $payment->load([
            'expense',
            'studentRegistration' => [
                'student' => [
                    'user',
                ],
                'classroom' => [
                    'establishmentYear',
                    'expenses' => function ($q) use ($payment) {
                        $q->where('expense_type', $payment->expense->expense_type);
                    },
                ],
            ],
        ]);

        $file_name = Str::ascii("{$payment->expense->year_id} {$payment->expense->name} {$payment->studentRegistration->student->user->name}.pdf");

        $pdf = new Mpdf([
            'mode' => 'utf-8',
            'format' => 'A5',
            'default_font_size' => '10',
            'default_font' => 'sans-serif',
            'margin_left' => 5,
            'margin_right' => 5,
            'margin_top' => 5,
            'margin_bottom' => 5,
            'margin_header' => 0,
            'margin_footer' => 0,
            'orientation' => 'P',
            'subject' => 'Receipt',
            'author' => config('app.CLIENT_NAME'),
            'display_mode' => 'fullpage',
            'image' => true,
        ]);

        $pdf->SetTitle(config('app.CLIENT_NAME'));
        $pdf->SetAuthor(auth()->user()->name);
        $pdf->SetCreator(base64_decode('aHR0cHM6Ly9naXRodWIuY29tL21lZGlsaWVz'));
        $pdf->SetSubject('Scholarship payment receipt');
        $pdf->SetKeywords('elaborate code,medilies');

        $headers = [
            'Content-Type' => 'application/pdf',
        ];

        $stylesheet = file_get_contents(base_path('public/pdf.css'));

        $pdf->WriteHTML($stylesheet, HTMLParserMode::HEADER_CSS);

        $pdf->WriteHTML(FacadesView::make('pdf.payment-receipt', compact('payment'))->render());

        return response()->streamDownload(function () use ($pdf, $file_name) {
            $pdf->output($file_name, Destination::INLINE);
        }, headers: $headers);
    }

    /*
    |-------------------------------------
    | Helpers
    |-------------------------------------
    */

    private function validTransaction(StorePaymentRequest|UpdatePaymentRequest $request, Expense $expense): bool
    {
        if (!$this->validReduction($request->reduction, $request->paid, $expense->value)) {
            return false;
        }

        if ($this->fullPayment($request->paid, $expense->value)) {
            return true;
        }

        if ($request->ez_mode) {
            return true;
        }

        if ($this->matchedReduction($request->reduction, $request->paid, $expense->value)) {
            return true;
        }

        return false;
    }

    private function validReduction(int|null $reduction, int $paid, int $fee): bool
    {
        if (empty($reduction)) {
            return true;
        }

        return ($fee - $reduction) >= intval($paid);
    }

    private function fullPayment(int $paid, int $fee): bool
    {
        return intval($paid) === intval($fee);
    }

    private function matchedReduction(int|null $reduction, int $paid, int $fee): bool
    {
        return $reduction && intval($paid) === ($fee - $reduction);
    }
}
