<?php

namespace App\Http\Controllers;

class SpaController extends Controller
{
    /**
     * Genera vista de SPA
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('spa');
    }
}
