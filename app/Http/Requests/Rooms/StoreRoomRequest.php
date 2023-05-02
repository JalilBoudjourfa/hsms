<?php

namespace App\Http\Requests\Rooms;

use Illuminate\Foundation\Http\FormRequest;

class StoreRoomRequest extends FormRequest
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
        return [
            'name' => ['required', 'max:32'],
            'capacity_min' => ['required', 'integer', 'min:0'],
            'capacity_max' => ['required', 'integer', 'gte:capacity_min'],
            //
            'classroom_id' => ['nullable', 'integer'],
            //
            'year_id' => ['required', 'integer'],
            'establishment_id' => ['required'],
        ];
    }
}
