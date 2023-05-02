<?php

namespace App\View\Components\Forms;

use App\Models\ClassType;
use Illuminate\View\Component;

class SelectOldClassrooms extends Component
{
    public $class_types;
    /**
     * @author medilies
     */
    public function __construct()
    {
        $this->class_types = ClassType::all();
    }

    /**
     * @author medilies
     */
    public function render(): \Illuminate\Contracts\View\View|\Closure|string
    {
        return view('components..forms.select-old-classrooms');
    }
}
