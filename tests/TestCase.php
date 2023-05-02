<?php

namespace Tests;

use App\Models\Classroom;
use App\Models\ClassType;
use App\Models\Establishment;
use App\Models\EstablishmentYear;
use App\Models\ExRegistration;
use App\Models\Family;
use App\Models\Student;
use App\Models\StudentInterview;
use App\Models\StudentRegistration;
use App\Models\User;
use App\Models\Year;
use Carbon\Carbon;
use ElaborateCode\AlgerianEducationSystem\Database\Seeders\AlgerianEducationSystemSeeder;
use ElaborateCode\AlgerianEducationSystem\Database\Seeders\MergePrescolaireIntoPrimaireCycleSeeder;
use ElaborateCode\AlgerianProvinces\Database\Seeders\WilayaSeeder;
use ElaborateCode\AlgerianProvinces\Models\Wilaya;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\DB;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /** @var \Illuminate\Support\Collection */
    public $establishments = [
        'sabah',
        'maraval',
        'gambetta',
    ];

    public $upcomingYear = '2022';

    public function setUp(): void
    {
        parent::setUp();

        $this->establishments = collect($this->establishments);

        $this->seed(AlgerianEducationSystemSeeder::class);
        $this->seed(MergePrescolaireIntoPrimaireCycleSeeder::class);
        $this->seed(WilayaSeeder::class);

        foreach ($this->establishments as $establishment) {
            DB::table('establishments')->insert([
                [
                    'id' => $establishment,
                    'created_at' => Carbon::now()->toDateTimeString(),
                    'updated_at' => Carbon::now()->toDateTimeString(),
                ],
            ]);
        }

        DB::table('years')->insert([
            [
                'id' => $this->upcomingYear,
                'state' => 'upcoming',
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
        ]);
    }

    protected function authenticate(): User
    {
        /** @var \Illuminate\Contracts\Auth\Authenticatable */
        $user = User::factory()->create();
        $this->actingAs($user);

        return $user;
    }

    public function makeClassroom(): Classroom
    {
        $est = Establishment::latest()->first();
        $y = Year::latest()->first();
        $class_type = ClassType::all()->random();

        $esty = EstablishmentYear::factory()
            ->for($est)
            ->for($y)
            ->create();

        $classroom = Classroom::factory()
            ->isActive()
            ->for($esty)
            ->for($class_type)
            ->create();

        $esty->setRelation('establishment', $est);
        $esty->setRelation('year', $y);
        $classroom->setRelation('establishmentYear', $esty);
        $classroom->setRelation('classType', $class_type);

        return $classroom;
    }

    public function makeStudent(array $depenencies = [], bool $has_interview = false): Student
    {
        $fam = $depenencies['fam'] ?? Family::factory()->create();

        $wilaya = Wilaya::all()->random();

        $student = Student::factory()
            ->for($fam)
            ->for($wilaya, 'birthWilaya')
            ->create();
        $student->setRelation('family', $fam);
        $student->setRelation('birthWilaya', $wilaya);

        $user = User::factory()->for($student, 'profilable')->create();
        $student->setRelation('user', $user);

        $classroom = $this->makeClassroom();

        $reg = StudentRegistration::factory()
            ->for($student)
            ->for($classroom)
            ->create();
        $reg->setRelation('classroom', $classroom);

        $ex_reg = ExRegistration::factory()
            ->for($reg)
            ->for($wilaya)
            ->create();
        $reg->setRelation('exRegistration', $ex_reg);

        if ($has_interview) {
            $interview = StudentInterview::factory()
                ->for($reg)
                ->create();
            $reg->setRelation('studentInterview', $interview);
        }

        $student->setRelation('latestRegistration', $reg);

        return $student;
    }

    public function assertOneFullClientOnDb($user_data, $client_data, $number)
    {
        $this
            ->assertDatabaseCount('families', 1)
            ->assertDatabaseCount('clients', 1)
            ->assertDatabaseCount('Users', 2)
            ->assertDatabaseCount('phones', 1)
            ->assertDatabaseHas('Users', $user_data)
            ->assertDatabaseHas('clients', $client_data)
            ->assertDatabaseHas('phones', compact('number'));
    }
}
