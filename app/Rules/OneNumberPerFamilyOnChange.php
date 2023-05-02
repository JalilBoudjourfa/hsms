<?php

namespace App\Rules;

use App\Models\Family;
use Illuminate\Contracts\Validation\ImplicitRule;

// Change means: phone delete
class OneNumberPerFamilyOnChange implements ImplicitRule
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
        $request = app('request');

        // not empty
        if ($value) {
            return true;
        }

        $client = $request->route('client');
        $fam = Family::withCount('phones')->find($client->family_id);

        // Not new family + Has phones
        if ($fam && $fam->phones_count > 1) {
            return true;
        }

        // Family with no phones
        return false;
    }

    /**
     * @author medilies
     */
    public function message(): string
    {
        return 'At least one family member should have a phone number';
    }
}
