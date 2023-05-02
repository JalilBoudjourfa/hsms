<?php

namespace App\View\Components\Nav;

use Illuminate\Support\Facades\DB;
use Illuminate\View\Component;

class ActiveYears extends Component
{
    public $active_years;

    /**
     * @return void
     */
    public function __construct()
    {
        $this->active_years = DB::table('establishment_years')
            ->join('years', 'years.id', '=', 'establishment_years.year_id')
            ->select(['establishment_years.id', 'establishment_years.year_id', 'establishment_years.establishment_id'])
            ->where('years.state', '!=', 'archived')
            ->get();
    }

    /**
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.nav.active-years');
    }
}
