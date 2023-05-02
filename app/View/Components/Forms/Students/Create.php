<?php

namespace App\View\Components\Forms\Students;

use App\Models\ClassType;
use Illuminate\View\Component;

class Create extends Component
{
    // To set previous classeroom
    public $class_types = null;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->class_types = ClassType::all();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.forms.students.create');
    }
}
