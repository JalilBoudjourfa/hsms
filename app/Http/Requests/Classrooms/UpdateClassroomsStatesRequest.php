<?php

namespace App\Http\Requests\Classrooms;

use App\Models\EstablishmentYear;
use App\Rules\CantDisableClassroomThatHasRegistrations;
use App\Rules\CantDisableClassroomThatHasRooms;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateClassroomsStatesRequest extends FormRequest
{
    /**
     * @author medilies
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @author medilies
     */
    public function rules(): array
    {
        $establishment_year = EstablishmentYear::where('year_id', $this->year_id)->where('establishment_id', $this->establishment_id)
            ->firstOrFail();
        $classrooms_ids = $establishment_year->classrooms()->pluck('id')->toArray();

        return [
            'classroom.*' => ['required', 'integer', Rule::in($classrooms_ids)],
            'state.*' => ['required', 'boolean', new CantDisableClassroomThatHasRooms, new CantDisableClassroomThatHasRegistrations],
        ];
    }
}
