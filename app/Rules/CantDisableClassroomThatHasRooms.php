<?php

namespace App\Rules;

use App\Models\Room;
use Illuminate\Contracts\Validation\Rule;

class CantDisableClassroomThatHasRooms implements Rule
{
    /**
     * @var mixed
     * @var string
     *
     * @return bool
     *
     * @author medilies
     */
    public function passes($attribute, $value)
    {
        if ($value !== '0') {
            return true;
        }

        return Room::where('classroom_id', str_replace('state.', '', $attribute))->count() ? false : true;
    }

    /**
     * @author medilies
     */
    public function message(): string
    {
        return 'Une classe avec des salles ne peut pas etre désactiver';
    }
}
