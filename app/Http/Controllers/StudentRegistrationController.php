<?php

namespace App\Http\Controllers;

use App\Http\Requests\Students\StoreStudentRequest;
use App\Models\Student;
use App\Models\StudentRegistration;
use Illuminate\Http\Request;

class StudentRegistrationController extends Controller
{
    /**
     * @return \Illuminate\Http\Response
     *
     * @author medilies
     */
    public function index()
    {
        return StudentRegistration::all();
    }

    /**
     * @return \Illuminate\Http\Response
     *
     * @author medilies
     */
    public function create()
    {

    }

    /**
     * @return \Illuminate\Http\Response
     *
     * @author medilies
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * @return \Illuminate\Http\Response
     *
     * @author medilies
     */
    public function show(StudentRegistration $studentRegistration)
    {
        return view('students.registration')->with('studentRegistration', $studentRegistration);
    }

    /**
     * @return \Illuminate\Http\Response
     *
     * @author medilies
     */
    public function edit(StudentRegistration $studentRegistration)
    {
        //
    }

    /**
     * @return \Illuminate\Http\Response
     *
     * @author medilies
     */
    public function update(Request $request, StudentRegistration $studentRegistration)
    {
        switch ($request->input('action')) {
            case 'accept':
                $studentRegistration->status = "accepted";
                $studentRegistration->save();
                break;
            case 'reject':
                $studentRegistration->status = "rejected";
                $studentRegistration->save();
                break;
            case 'wait':
                $studentRegistration->status = "pending";
                $studentRegistration->save();
                break;
        }

        return back();
    }

    /**
     * @return \Illuminate\Http\Response
     *
     * @author medilies
     */
    public function destroy(StudentRegistration $studentRegistration)
    {
        //
    }
}
