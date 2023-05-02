<?php

namespace App\View\Components\Forms;

use App\Models\Classroom;
use Illuminate\View\Component;

class SelectActiveClassrooms extends Component
{
    // To show the choices of possible classrooms and where
    public $active_classrooms = null;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $grouped_active_classrooms = Classroom::withIfrastructureDetails()
            ->isActiveYear()
            ->isActive()
            ->get()
            ->groupBy(['year_id', 'establishment_id', 'cycle_id']);

        // I NEED a 1 level of nesting with this grouping hierarchy
        // Maybe do not do the groupBy at the fisrt place

        foreach ($grouped_active_classrooms as $year => $establishments) {
            foreach ($establishments as $establishment => $cycles) {
                foreach ($cycles as $cycle => $classrooms) {
                    $this->active_classrooms["$year $establishment $cycle"] = $classrooms;
                }
            }
        }
    }

    /**
     * @author medilies
     */
    public function render(): \Illuminate\Contracts\View\View|\Closure|string
    {
        return view('components.forms.select-active-classrooms');
    }
}
