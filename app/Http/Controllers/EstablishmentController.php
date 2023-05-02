<?php

namespace App\Http\Controllers;

class EstablishmentController extends Controller
{
    /**
     * @return \Illuminate\Http\Response
     *
     * @author medilies
     */
    public function index()
    {
        return view('establishments.index');
    }
}
