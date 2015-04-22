<?php namespace App\Http\Controllers;

class MaestroController extends Controller {

    /**
     * Initializer.
     *
     * @return \AdminController
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('maestro');
    }

}