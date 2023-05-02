<?php

namespace Database\Seeders\Helpers;

use App\Models\Classroom;
use App\Models\Client;
use App\Models\Family;
use Database\Populators\ClientPopulator;
use Database\Populators\StudentPopulator;
use Database\Populators\StudentRegistrationPopulator;
use ElaborateCode\AlgerianProvinces\Models\Wilaya;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;

class MakeFamilies
{
    public ClientPopulator $clientPopulator;

    public StudentPopulator $studentPopulator;

    public StudentRegistrationPopulator $studentRegistrationPopulator;

    public function __construct(
        ClientPopulator $clientPopulator,
        StudentPopulator $studentPopulator,
        StudentRegistrationPopulator $studentRegistrationPopulator

    ) {
        $this->clientPopulator = $clientPopulator;
        $this->studentPopulator = $studentPopulator;
        $this->studentRegistrationPopulator = $studentRegistrationPopulator;
    }

    public function __invoke(
        int $fams_count = 100,
        int $max_students_per_fam = 4,
        array $possible_parents = ['both', 'father', 'mother']
    ): EloquentCollection {
        $fams = new EloquentCollection;

        $classrooms = Classroom::all();

        $wilayas = Wilaya::all();

        for ($i = 0; $i < $fams_count; $i++) {
            $has_parents = collect($possible_parents)->random();

            $fam = Family::factory()->create();

            match ($has_parents) {
                'both' => $this->createBothParents($fam),
                'father' => $this->createFather($fam),
                'mother' => $this->createMother($fam),
            };

            if (! $max_students_per_fam) {
                $fams->push($fam);

                continue;
            }

            for ($j = 0, $students_count = random_int(1, $max_students_per_fam); $j < $students_count; $j++) {
                /** @var Wilaya $wilaya */
                $wilaya = $wilayas->random();

                $student = $this->studentPopulator->populate($fam, $wilaya);

                if ($classrooms->count()) {
                    /** @var ?Classroom $classroom */
                    $classroom = $classrooms->random();

                    /** @var Wilaya $wilaya */
                    $wilaya = $wilayas->random();

                    $this->studentRegistrationPopulator->populate($student, $classroom, $wilaya);
                }
            }

            $fams->push($fam);
        }

        return $fams;
    }

    public function createBothParents(Family $fam): EloquentCollection
    {
        $parents = new EloquentCollection;

        $parents->push($this->clientPopulator->populate('father', $fam));
        $parents->push($this->clientPopulator->populate('mother', $fam));

        return $parents;
    }

    private function createFather(Family $fam): Client
    {
        return $this->clientPopulator->populate('father', $fam);
    }

    private function createMother(Family $fam): Client
    {
        return $this->clientPopulator->populate('mother', $fam);
    }
}
