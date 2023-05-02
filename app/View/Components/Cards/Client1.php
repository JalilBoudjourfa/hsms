<?php

namespace App\View\Components\Cards;

use Illuminate\View\Component;

class Client1 extends Component
{
    public $client_data;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($clientData)
    {
        $this->client_data = $clientData;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.cards.client1');
    }
}
