<?php

namespace App\View\Components\Cards;

use Illuminate\View\Component;

class Year extends Component
{
    public $establishment;

    public $composed_key;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($establishment, $composedKey)
    {
        $this->establishment = $establishment;
        $this->composed_key = $composedKey;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.cards.year');
    }
}
