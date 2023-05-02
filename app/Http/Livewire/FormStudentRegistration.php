<?php

namespace App\Http\Livewire;

use App\Models\ClassType;
use App\Models\Student;
use Livewire\Component;
use Livewire\WithFileUploads;

class FormStudentRegistration extends Component
{
    use WithFileUploads;

    public $student;
    public $class_types = null;
    public $deposition_date;
    public $establishment_name;
    public $establishment_type;
    public $ex_est_wilaya;
    public $ex_registration_class_type_id;
    public $classroom_id;
    public $grade_1, $grade_2, $grade_3;
    public $bultin_1, $bultin_2, $bultin_3;


    public function store()
    {
        // dd($this->bultin_1);

        $student_registrations = $this->student->studentRegistrations()->create(
            [
                'student_id' => $this->student->id,
                'classroom_id' => $this->ex_registration_class_type_id,
                'deposition_date' => $this->deposition_date,
            ]
        );

        // ! completely nullable

        $reg = $student_registrations->exRegistration()->create(
            [
                'establishment_name' => $this->establishment_name,
                'establishment_type' => $this->establishment_type,
                'ex_est_wilaya' => $this->ex_est_wilaya,
                'class_type_id' => $this->classroom_id,
                'grade_1' => $this->grade_1,
                'grade_2' => $this->grade_2,
                'grade_3' => $this->grade_3,

            ]
        );

        if ($this->bultin_1 != null) {

            $reg->bultin_1 = $this->bultin_1->storeAs('bultins/' . str_replace(' ', '_', $this->student->user->name) . $this->deposition_date, 'bultin_1' . '.' . $this->bultin_1->guessExtension(), 'public');
            $reg->save();
        }

        if ($this->bultin_2 != null) {
            $reg->bultin_2 = $this->bultin_2->storeAs('bultins/' . str_replace(' ', '_', $this->student->user->name) . $this->deposition_date, 'bultin_2' . '.' . $this->bultin_2->guessExtension(), 'public');
            $reg->save();
        }

        if ($this->bultin_3 != null) {
            $reg->bultin_3 =  $this->bultin_3->storeAs('bultins/' . str_replace(' ', '_', $this->student->user->name) . $this->deposition_date, 'bultin_3' . '.' . $this->bultin_3->guessExtension(), 'public');
            $reg->save();
        }

        return back();
    }

    public function render()
    {

        return view('livewire.form-student-registration', [
            'class_types' => $this->class_types = ClassType::all()

        ]);
    }
}
