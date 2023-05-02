<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SideBar extends Component
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
        return view('layouts.side-bar');
    }
}
