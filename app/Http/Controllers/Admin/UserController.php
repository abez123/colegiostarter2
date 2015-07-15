<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\User;

use App\Padre;
use App\Madre;
use App\Grupo;
use App\Departamento;
use App\Http\Requests\Admin\UserRequest;
use App\Http\Requests\Admin\UserEditRequest;
use App\Http\Requests\Admin\DeleteRequest;
use Illuminate\Support\Facades\DB;
use yajra\Datatables\Datatables;
use Illuminate\Database\Eloquent\Model;



class UserController extends AdminController {

    /*
    * Display a listing of the resource.
    *
    * @return Response
    */
    public function index()
    {
        // Show the page
        return view('admin.users.index');
    }

   public function itemsForAlumno($id) {

      
        $alumno=Grupo::find($id);
        // Show the page
        return view('admin.users.index', compact('alumno'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function getCreate() {

          {
              $grupos=  \DB::table('departamentos')
        ->join('grupos', function($join)
        {
            $join->on('departamentos.id', '=', 'grupos.departamento_id')
                 ;
        })
        ->get();

        $grupo= "";


                $padres = User::where('admin','=','padre')->get();
              $padre= "";
              $madres = User::where('admin','=','madre')->get();
              $madre= "";
        // Show the page


    }
        return view('admin.users.create_edit', compact('grupos','grupo','padres','padre','madres','madre'));
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
        $user -> fecha_nacimiento = $request->fecha_nacimiento;
        $user -> historial_medico = $request->historial_medico;
        $user -> padre_id = $request->padre_id;
        $user -> madre_id = $request->madre_id;
        $user -> grupo_id = $request->grupo_id;
        $user -> username = $request->username;
        $user -> email = $request->email;
        $user -> admin = $request->admin;
        $user -> password = bcrypt($request->password);
        $user -> confirmation_code = str_random(32);
        $user -> remember_token = csrf_token();
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
         $grupos=  \DB::table('departamentos')
        ->join('grupos', function($join)
        {
            $join->on('departamentos.id', '=', 'grupos.departamento_id')
                 ;
        })
        ->get();

        $grupo= "";
          $padres = User::where('admin','=','padre')->get();
              $padre= "";
              $madres = User::where('admin','=','madre')->get();
              $madre= "";
       
        return view('admin.users.create_edit', compact('user','grupos','grupo','padres','padre','madres','madre'));
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
        return view('admin.users.delete', compact('user'));
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
    public function data($alumnoid=0)
    {
 $condition =(intval($alumnoid)==0)?">":"=";


        $users = User::join('grupos', 'grupos.id', '=', 'users.grupo_id')
            ->where('users.grupo_id',$condition,$alumnoid)

      ->select(array('users.id','users.name','users.apellidop','users.apellidom','users.email','users.confirmed', 'users.created_at'));

        return Datatables::of($users)
            ->edit_column('confirmed', '@if ($confirmed=="1") <span class="glyphicon glyphicon-ok"></span> @else <span class=\'glyphicon glyphicon-remove\'></span> @endif')
            ->add_column('actions', '@if ($id!="1")<a href="{{{ URL::to(\'admin/users/\' . $id . \'/edit\' ) }}}" class="btn btn-success btn-sm iframe" ><span class="glyphicon glyphicon-pencil"></span>  {{ trans("admin/modal.edit") }}</a>
                    <a href="{{{ URL::to(\'admin/users/\' . $id . \'/delete\' ) }}}" class="btn btn-sm btn-danger iframe"><span class="glyphicon glyphicon-trash"></span> {{ trans("admin/modal.delete") }}</a>
                @endif')
            ->remove_column('id')

            ->make();
    }

}
