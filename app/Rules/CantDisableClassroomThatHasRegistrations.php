<?php

namespace App\Rules;

use App\Models\StudentRegistration;
use Illuminate\Contracts\Validation\Rule;

class CantDisableClassroomThatHasRegistrations implements Rule
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

        return StudentRegistration::where('classroom_id', str_replace('state.', '', $attribute))
            ->where('status', '!=', 'rejected')
            ->count() ? false : true;
    }

    /**
     * @author medilies
     */
    public function message(): string
    {
        return 'Une classe avec des inscriptions ne peut pas etre désactiver';
    }
}
