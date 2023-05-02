<?php

namespace App\View\Components;

use App\Models\StudentRegistration;
use Illuminate\View\Component;
use Illuminate\Database\Eloquent\Builder;

class NewRegistrationsSabahCounter extends Component
{
    public $sum;
    /**
     * @author islam
     */
    public function __construct()
    {
        $this->sum = StudentRegistration::query()
            ->where('status', 'pending')
            ->whereHas('classroom.establishmentYear', function (Builder $query) {
                $query->where('establishment_id', 'Sabah');
            })
            ->whereHas('classroom.EstablishmentYear.Year', function (Builder $query) {
                $query->where('state', 'current');
            })
            ->with([
                'classroom' => [
                    'classType',
                    'establishmentYear',
                ],
            ])->count();
    }

    /**
     * @author islam
     */
    public function render(): \Illuminate\Contracts\View\View|\Closure|string
    {
        return view('components.new-registrations-sabah-counter');
    }
}
