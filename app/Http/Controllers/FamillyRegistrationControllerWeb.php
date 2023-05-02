<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Clients\StoreClientRequest;
use App\Http\Requests\Students\StoreStudentRequest;
use App\Models\Classroom;
use App\Models\ClassType;
use App\Models\Family;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class FamillyRegistrationControllerWeb extends Controller
{
    public function index()
    {
        return view('web.index');
    }

    public function store(Request $request)
    {
        $fname_max = config('rules.fname.max');
        $lname_max = config('rules.lname.max');
        $number_max = config('rules.number.max');
        $number_regex = config('rules.number.regex');
        $cni_max = config('rules.cni.max');
        $address_max = config('rules.address.max');
        $profession_max = config('rules.profession.max');
        $family_title_max = config('rules.family_title.max');
        $family_title_in = config('rules.family_title.in');

        $request->validate([

            'fnamefather' => ['required', "max:$fname_max"],
            'lnamefather' => ['required', "max:$lname_max"],
            'numberfather' => ['required', "max:$number_max", "regex:$number_regex", 'unique:phones,number'],
            'home' => ['nullable', 'unique:clients,home'],
            'whatsapp' => ['nullable', 'unique:clients,whatsapp'],
            'emailfather' => ['nullable', 'email'],
            'cnifather' => ['nullable', "max:$cni_max"],
            'addressfather' => ['required', "max:$address_max"],
            'professionfather' => ['required', "max:$profession_max"],

            'fnamemother' => ['required', "max:$fname_max"],
            'lnamemother' => ['required', "max:$lname_max"],
            'numbermother' => ['required', "max:$number_max", "regex:$number_regex", 'unique:phones,number'],
            'home' => ['nullable', 'unique:clients,home'],
            'whatsapp' => ['nullable', 'unique:clients,whatsapp'],
            'emailmother' => ['nullable', 'email'],
            'cnimother' => ['nullable', "max:$cni_max"],
            'addressmother' => ['required', "max:$address_max"],
            'professionmother' => ['required', "max:$profession_max"],

        ]);

        $family = Family::create();

        $father = $family->clients()->create([
            'phone' => $request->phonefather,
            'cni' => $request->cnifather,
            'address' => $request->addressfather,
            'profession' => $request->professionfather,
            'family_title' => 'father',
            'home_num' => $request->home_numfather,
            'whatsapp' => $request->whatsappfather,


        ]);

        $userFather = $father->user()->create(
            [
                'fname' => $request->fnamefather,
                'lname' => $request->lnamefather,
                'email' => $request->emailfather,
            ]

        );

        if (!empty($request->numberfather)) {
            $userFather->primaryPhone()->create(
                [
                    'number' => $request->numberfather,
                    'primary' => true,
                ]
            );
        }


        $mother  = $family->clients()->create([
            'phone' => $request->phonemother,
            'cni' => $request->cnimother,
            'address' => $request->addressmother,
            'profession' => $request->professionmother,
            'family_title' => 'mother',
            'home_num' => $request->home_nummother,
            'whatsapp' => $request->whatsappmother,
        ]);

        $userMother = $mother->user()->create(
            [
                'fname' => $request->fnamemother,
                'lname' => $request->lnamemother,
                'email' => $request->emailmother,
            ]

        );

        if (!empty($request->numbermother) && $request->numbermother != $request->numberfather) {
            $userMother->primaryPhone()->create(
                [
                    'number' => $request->numbermother,
                    'primary' => true,
                ]
            );
        }

        return to_route('web.index.student', [$family]);
    }



    public function indexStudent(Family $family)
    {
        return view('web.registration-student')->with('family', $family);
    }



    public function storeStudent(StoreStudentRequest $request, Family $family)
    {

        $classroom = Classroom::findOrFail($request->classroom_id);

        $classroom->load('establishmentYear');

        DB::transaction(function () use ($family, $classroom, $request) {
            $student = $family->students()->create(
                $request->safe(['ar_fname', 'ar_lname', 'bday', 'bplace', 'sex', 'nationality'])
            );

            $user = $student->user()->create(
                $request->safe(['fname', 'lname', 'email'])
            );

            $student_registrations = $classroom->studentRegistrations()->create(
                $request->safe(['deposition_date']) + ['student_id' => $student->id]
            );

            // ! completely nullable
            if ($request->ex_registration_class_type_id != null) {

                $reg = $student_registrations->exRegistration()->create(
                    $request->safe(['establishment_name', 'establishment_type', 'ex_est_wilaya', 'class_type_id'])
                );
            }
        });

        switch ($request->input('action')) {
            case 'submit':
                // return to_route('web.index');
                return back()->with('success', 'Merci.');
                break;

            case 'submit_and_refresh':
                return to_route('web.index.student', [$family]);
                break;
        }
    }
}
