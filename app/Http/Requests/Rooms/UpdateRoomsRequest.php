<?php

namespace App\Http\Requests\Rooms;

use App\Models\EstablishmentYear;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRoomsRequest extends FormRequest
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

        $classrooms_ids = $establishment_year->classrooms()->pluck('id')->push(0)->toArray();
        $rooms_ids = $establishment_year->rooms()->pluck('id')->toArray();

        return [
            'year_id' => ['required', 'integer'],
            'establishment_id' => ['required'],
            //
            'room.*' => ['required', 'integer', Rule::in($rooms_ids)],
            'classroom.*' => ['required', 'integer', Rule::in($classrooms_ids)],
            'capacity_min.*' => ['required', 'integer', 'min:0'],
            'capacity_max.*' => ['required', 'integer', 'gte:capacity_min.*'],
        ];
    }
}
