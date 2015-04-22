<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\Maestro;
use App\Http\Requests\Admin\MaestroRequest;
use App\Http\Requests\Admin\MaestroEditRequest;
use App\Http\Requests\Admin\DeleteRequest;
use yajra\Datatables\Datatables;



class MaestroController extends AdminController {

    /*
    * Display a listing of the resource.
    *
    * @return Response
    */
    public function index()
    {
        // Show the page
        return view('admin.maestros.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function getCreate() {
        return view('admin.maestros.create_edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function postCreate(MaestroRequest $request) {

        $maestro = new Maestro ();
        $maestro -> nombre = $request->nombre;
        $maestro -> apellido_p = $request->apellido_p;
        $maestro -> apellido_m = $request->apellido_m;
        $maestro -> sexo = $request->sexo;
        $maestro -> direccion = $request->direccion;
        $maestro -> colonia = $request->colonia;
        $maestro -> cp = $request->cp;
        $maestro -> telefonos = $request->telefonos;
        $maestro -> profesion = $request->profesion;
        $maestro -> mision = $request->mision;
        $maestro -> cursos = $request->cursos;
        $maestro -> username = $request->username;
        $maestro -> email = $request->email;
        $maestro -> password = bcrypt($request->password);
        $maestro -> confirmation_code = str_random(32);
        $maestro -> confirmed = $request->confirmed;
        $maestro -> save();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $maestro
     * @return Response
     */
    public function getEdit($id) {

        $maestro = Maestro::find($id);
        return view('admin.maestros.create_edit', compact('maestro'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param $maestro
     * @return Response
     */
    public function postEdit(MaestroEditRequest $request, $id) {

        $maestro = Maestro::find($id);
        $maestro -> nombre = $request->nombre;
        $maestro -> confirmed = $request->confirmed;

        $password = $request->password;
        $passwordConfirmation = $request->password_confirmation;

        if (!empty($password)) {
            if ($password === $passwordConfirmation) {
                $maestro -> password = bcrypt($password);
            }
        }
        $maestro -> save();
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param $maestro
     * @return Response
     */

    public function getDelete($id)
    {
        $maestro = Maestro::find($id);
        // Show the page
        return view('admin.maestros.delete', compact('maestro'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $maestro
     * @return Response
     */
    public function postDelete(DeleteRequest $request,$id)
    {
        $maestro= Maestro::find($id);
        $maestro->delete();
    }

    /**
     * Show a list of all the languages posts formatted for Datatables.
     *
     * @return Datatables JSON
     */
    public function data()
    {
        $maestros = Maestro::select(array('maestros.id','maestros.nombre','maestros.email','maestros.confirmed', 'maestros.created_at'));

        return Datatables::of($maestros)
            ->edit_column('confirmed', '@if ($confirmed=="1") <span class="glyphicon glyphicon-ok"></span> @else <span class=\'glyphicon glyphicon-remove\'></span> @endif')
            ->add_column('actions', '@if ($id!="1")<a href="{{{ URL::to(\'admin/maestros/\' . $id . \'/edit\' ) }}}" class="btn btn-success btn-sm iframe" ><span class="glyphicon glyphicon-pencil"></span>  {{ trans("admin/modal.edit") }}</a>
                    <a href="{{{ URL::to(\'admin/maestros/\' . $id . \'/delete\' ) }}}" class="btn btn-sm btn-danger iframe"><span class="glyphicon glyphicon-trash"></span> {{ trans("admin/modal.delete") }}</a>
                @endif')
            ->remove_column('id')

            ->make();
    }

}