<?php

namespace App\Http\Controllers\Users;

use App\Http\Requests\Students\StoreStudentRequest;
use App\Http\Requests\Students\UpdateStudentRequest;
use App\Models\Classroom;
use App\Models\Family;
use App\Models\Student;
use Illuminate\Support\Facades\DB;

class StudentController extends \App\Http\Controllers\Controller
{
    /**
     * @return \Illuminate\Http\Response
     *
     * @author medilies
     */
    public function index()
    {
        return view('students.index');
    }

    /**
     * @return \Illuminate\Http\Response
     *
     */
    public function store(StoreStudentRequest $request)
    {
        $family = Family::findOrFail($request->family_id);
        $classroom = Classroom::findOrFail($request->classroom_id);

        $classroom->load('establishmentYear');

        // if (!$classroom->capacity > 0 || $classroom->year->is_locked) {
        //     throw new \Exception("La capacity de la classe doit etre superieur à 0 et l'année doit etre modifiable", 1);
        // }

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

            $reg = $student_registrations->exRegistration()->create(
                $request->safe(['establishment_name', 'establishment_type', 'ex_est_wilaya', 'class_type_id', 'grade_1', 'grade_2', 'grade_3'])
            );

            if ($request->hasfile('bultin_1')) {

                $reg->bultin_1 = $request->file('bultin_1')->storeAs('bultins/' . str_replace(' ', '_', $user->name) . $request->deposition_date, 'bultin_1' . '.' . $request->file('bultin_1')->guessExtension(), 'public');
                $reg->save();
            }

            if ($request->hasfile('bultin_2')) {
                $reg->bultin_2 = $request->file('bultin_2')->storeAs('bultins/' . str_replace(' ', '_', $user->name) . $request->deposition_date, 'bultin_2' . '.' . $request->file('bultin_2')->guessExtension(), 'public');
                $reg->save();
            }

            if ($request->hasfile('bultin_3')) {
                $reg->bultin_3 = $request->file('bultin_3')->storeAs('bultins/' . str_replace(' ', '_', $user->name) . $request->deposition_date, 'bultin_3' . '.' . $request->file('bultin_3')->guessExtension(), 'public');
                $reg->save();
            }
        });

        return to_route('families.board', ['family' => $family->id]);
    }

    /**
     * @return \Illuminate\Http\Response
     *
     * @author medilies
     */
    public function edit(Student $student)
    {
        $student->load('user');

        return view('students.edit')
            ->with('student', $student);
    }

    /**
     * @return \Illuminate\Http\Response
     *
     * @author medilies
     */
    public function update(UpdateStudentRequest $request, Student $student)
    {

        DB::transaction(function () use ($request, $student) {
            $student->update($request->safe(['ar_fname', 'ar_lname', 'bday', 'bwilaya', 'bplace', 'sex', 'nationality']));
            $student->user->update($request->safe(['fname', 'lname', 'email']));
            // $student->studentRegistrations->classroom->update($request->safe(['classType']));
        });

        return to_route('students.board', ['student' => $student->id]);
    }
}
