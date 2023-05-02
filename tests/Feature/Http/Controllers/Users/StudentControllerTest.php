<?php

namespace Tests\Feature\Http\Controllers\Users;

use App\Models\ExRegistration;
use App\Models\Family;
use App\Models\Student;
use App\Models\StudentRegistration;
use App\Models\User;
use Database\Seeders\Helpers\MakeFamilies;
use ElaborateCode\AlgerianProvinces\Models\Wilaya;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StudentControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function index(): void
    {
        $this->authenticate();

        $this->makeClassroom();
        $fams = app()->make(MakeFamilies::class)(10, 1);

        $response = $this->get(route('students.index'))
            ->assertOk();

        foreach ($fams as $fam) {
            $response->assertSeeText([
                $fam->students->first()->user->name,
                $fam->students->first()->arabic_full_name,
                $fam->students->first()->bday->format('Y-m-d'),
                $fam->students->first()->bplace,
                $fam->students->first()->id,
                $fam->students->first()->family_id,
                // ? Not displayed:
                // $fam->students->first()->user->email,
                // $fam->students->first()->sex,
            ]);
        }
    }

    /** @test */
    public function store(): void
    {
        $this->authenticate();

        $wilaya = Wilaya::find(random_int(1, 58));

        /** @var Family */
        $fam = Family::factory()->create();

        /** @var Student */
        $student = Student::factory()
            ->for($fam)
            ->for($wilaya, 'birthWilaya')
            ->make();

        /** @var User */
        $user = User::factory()
            ->for($student, 'profilable')
            ->make();

        $classroom = $this->makeClassroom();

        $registration = StudentRegistration::factory()
            ->for($student)
            ->for($classroom)
            ->make();

        $ex_reg = ExRegistration::factory()
            ->for($registration)
            ->for($wilaya)
            ->make();

        $user_data = collect($user->toArray())->only(['fname', 'lname', 'email'])->toArray();

        $student_data = $student->toArray();
        $student_data['bday'] = $student->bday->toDateTimeString();

        $registration_data = collect($registration->toArray())->only(['classroom_id', 'deposition_date'])->toArray();

        $ex_reg_data = collect($ex_reg->toArray())->only(['establishment_name', 'establishment_type', 'class_type_id', 'ex_est_wilaya', 'grade_1', 'grade_2', 'grade_3'])->toArray();

        $this->post(
            route('students.store'),
            $student_data + $user_data + $registration_data + $ex_reg_data + ['ex_registration_class_type_id' => $ex_reg_data['class_type_id']]
        )
            ->assertRedirect(route('families.board', ['family' => $fam->id]));

        $this
            ->assertDatabaseCount('families', 1)
            ->assertDatabaseCount('students', 1)
            ->assertDatabaseCount('users', 2)
            ->assertDatabaseHas('users', $user_data)
            ->assertDatabaseHas('students', $student_data)
            ->assertDatabaseHas('student_registrations', $registration_data)
            ->assertDatabaseHas('ex_registrations', $ex_reg_data);
    }

    /** @test */
    public function edit(): void
    {
        $this->authenticate();

        $student = $this->makeStudent();

        $see = [
            $student->user->name,
            $student->user->email,
            $student->ar_fname,
            $student->ar_lname,
            $student->nationality,
            $student->sex,
            $student->id,
            $student->family_id,
        ];

        $this->get(route('students.edit', ['student' => $student->id]))
            ->assertOk()
            ->assertSee($see);
    }

    /** @test */
    public function update(): void
    {
        $this->authenticate();

        $student = $this->makeStudent();

        $user = User::factory()->make();
        $student2 = Student::factory()->make();

        $user_update_data = collect($user->toArray())->only(['fname', 'lname', 'email'])->toArray();
        $student_update_data = $student2->toArray();
        $student_update_data['bday'] = $student2->bday->toDateTimeString();

        $this->put(
            route('students.update', ['student' => $student->id]),
            $student_update_data + $user_update_data
        )
            ->assertRedirect(route('students.board', ['student' => $student->id]));

        $this->get(route('students.board', ['student' => $student->id]))
            ->assertOk()
            ->assertSeeText([
                $user_update_data['fname'],
                $user_update_data['lname'],
                $user_update_data['email'],
                $student_update_data['ar_fname'],
                $student_update_data['ar_lname'],
                $student2->bday->format('Y-m-d'),
                $student_update_data['bplace'],
                ucfirst($student_update_data['sex']),
                $student_update_data['nationality'],
            ]);

        $this
            ->assertDatabaseCount('families', 1)
            ->assertDatabaseCount('students', 1)
            ->assertDatabaseCount('users', 2)
            ->assertDatabaseHas('users', $user_update_data)
            ->assertDatabaseHas('students', $student_update_data);
    }
}
