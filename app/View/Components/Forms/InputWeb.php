<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class InputWeb extends Component
{
    /**
     * @author medilies
     */
    public function __construct()
    {
        //
    }

    /**
     * @author medilies
     */
    public function render(): \Illuminate\Contracts\View\View|\Closure|string
    {
        return view('components..forms.input-web');
    }
}
