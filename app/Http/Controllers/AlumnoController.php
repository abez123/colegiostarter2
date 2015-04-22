<?php namespace App\Http\Controllers;

class AlumnoController extends Controller {

    /**
     * Initializer.
     *
     * @return \AdminController
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('alumno');
    }

}