<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\User;
use App\Maestro;
use App\Http\Requests\Admin\UserRequest;
use App\Http\Requests\Admin\UserEditRequest;
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
    public function postCreate(UserRequest $request) {

        $user = new User ();
        $user -> name = $request->name;
        $user -> apellidop = $request->apellidop;
        $user -> apellidom = $request->apellidom;
        $user -> sexo = $request->sexo;
        $user -> direccion = $request->direccion;
        $user -> colonia = $request->colonia;
        $user -> cp = $request->cp;
        $user -> telefonos = $request->telefonos;
        $user-> profesion = $request->profesion;
        $user-> mision = $request->mision;
        $user-> cursos = $request->cursos;
        $user -> username = $request->username;
        $user -> email = $request->email;
        $user -> admin = $request->admin;
        $user -> password = bcrypt($request->password);
        $user -> remember_token = csrf_token();
        $user -> confirmation_code = str_random(32);
        $user -> confirmed = $request->confirmed;
        $user -> save();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $user
     * @return Response
     */
    public function getEdit($id) {

        $user = User::find($id);
        return view('admin.maestros.create_edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param $user
     * @return Response
     */
    public function postEdit(UserEditRequest $request, $id) {

        $user = User::find($id);
        $user -> name = $request->name;
        $user -> confirmed = $request->confirmed;

        $password = $request->password;
        $passwordConfirmation = $request->password_confirmation;

        if (!empty($password)) {
            if ($password === $passwordConfirmation) {
                $user -> password = bcrypt($password);
            }
        }
        $user -> save();
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param $user
     * @return Response
     */

    public function getDelete($id)
    {
        $user = User::find($id);
        // Show the page
        return view('admin.maestros.delete', compact('user'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $user
     * @return Response
     */
    public function postDelete(DeleteRequest $request,$id)
    {
        $user= User::find($id);
        $user->delete();
    }

    /**
     * Show a list of all the languages posts formatted for Datatables.
     *
     * @return Datatables JSON
     */
    public function data()
    {
        $users = User::where('admin','=','maestro')->select(array('users.id','users.name','users.admin','users.email','users.confirmed'));

        return Datatables::of($users)
            ->edit_column('confirmed', '@if ($confirmed=="1") <span class="glyphicon glyphicon-ok"></span> @else <span class=\'glyphicon glyphicon-remove\'></span> @endif')
            ->add_column('actions', '@if ($id!="1")<a href="{{{ URL::to(\'admin/maestros/\' . $id . \'/edit\' ) }}}" class="btn btn-success btn-sm iframe" ><span class="glyphicon glyphicon-pencil"></span>  {{ trans("admin/modal.edit") }}</a>
                    <a href="{{{ URL::to(\'admin/maestros/\' . $id . \'/delete\' ) }}}" class="btn btn-sm btn-danger iframe"><span class="glyphicon glyphicon-trash"></span> {{ trans("admin/modal.delete") }}</a>
                @endif')
            ->remove_column('id')

            ->make();
    }

}
