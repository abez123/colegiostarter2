<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\Grupo;
use App\Departamento;
use App\Http\Requests\Admin\GrupoRequest;
use App\Http\Requests\Admin\ReorderRequest;
use App\Http\Requests\Admin\DeleteRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Datatables;

class GrupoController extends AdminController {

    /*
   * Display a listing of the resource.
   *
   * @return Response
   */
    public function index()
    {
        // Show the page
        return view('admin.grupo.index');
    }

    /**
     * Show a list of all the grupo posts.
     *
     * @return View
     */
    public function itemsForDepartamento($id) {

        $departamento = Departamento::find($id);
        // Show the page
        return view('admin.grupo.index', compact('departamento'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function getCreate()
    {
        
        $departamentos = Departamento::all();
        $departamento = "";
        // Show the page
        return view('admin.grupo.create_edit', compact('departamentos','departamento'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function postCreate(GrupoRequest $request)
    {
        $grupo = new Grupo();
        $grupo -> user_id = Auth::id();
        $grupo -> name = $request->name;
        $grupo -> departamento_id = $request->departamento_id;
        $grupo -> schoolyear = $request->schoolyear;



        $grupo -> save();


    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function getEdit($id)
    {
        $grupo = Grupo::find($id);

        $departamentos = Departamento::all();
        $departamento = $grupo->departamento_id;
        $grupo -> name;
        $grupo -> schoolyear;

        return view('admin.grupo.create_edit',compact('grupo','departamentos','departamento'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function postEdit(GrupoRequest $request, $id)
    {
        $grupo = Grupo::find($id);
        $grupo -> user_id = Auth::id();
        $grupo -> name = $request->name;
        $grupo -> departamento_id = $request->departamento_id;
        $grupo -> schoolyear = $request->schoolyear;

        $grupo -> save();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return Response
     */

    public function getDelete($id)
    {
        $grupo = Grupo::find($id);
        // Show the page
        return view('admin.grupo.delete', compact('grupo'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return Response
     */
    public function postDelete(DeleteRequest $request,$id)
    {
        $grupo = Grupo::find($id);
        $grupo->delete();
    }

    /**
     * Set a Album cover.
     *
     * @param $id
     * @return Response
     */
  /*  public function getDepartamento($id)
    {
        $grupo = Grupo::find($id);
        $departamentos = Grupo::where('departamentos_id',$grupo->departamento_id)->get();
        foreach($departamentos as $item)
        {
            $item -> departamento;
            $item -> save();
        }
        $grupo -> departamento;
        $grupo -> save();
        // Show the page
        return redirect( (($deprtamento)?'/admin/grupo':'/admin/grupo/'.$grupo.'/itemsforgruo'));
 }
 */
    public function getDepartamento()
    {
        //	//crear notas para alumnos y padres

        $grupo = DB::table('departamentos')
            ->orderBy('nombre', 'asc')
           ->lists('nombre', 'id');



        return view('admin.grupo.create_edit', compact('grupo'));

    }


    /**
     * Show a list of all the languages posts formatted for Datatables.
     *
     * @return Datatables JSON
     */
    public function data() {

        $grupodepa = Grupo::join('departamentos', 'departamentos.id', '=', 'grupos.departamento_id')

            ->select(array('grupos.id', 'grupos.name','departamentos.descripcion as depaname','grupos.schoolyear'))
            ->orderBy('grupos.position', 'ASC');

        return Datatables::of($grupodepa)
            -> edit_column('position', '{{ DB::table(\'grupos\')->where(\'departamento_id\', \'=\', $id)->count() }}</a>')
            ->add_column('actions', '<a href="{{{ URL::to(\'admin/grupo/\' . $id . \'/alumno\' ) }}}" class="btn btn-info btn-sm" ><span class="glyphicon glyphicon-open"></span> Alumnos</a>
                    <a href="{{{ URL::to(\'admin/grupo/\' . $id . \'/edit\' ) }}}" class="btn btn-success btn-sm iframe" ><span class="glyphicon glyphicon-pencil"></span>  {{ trans("admin/modal.edit") }}</a>
                    <a href="{{{ URL::to(\'admin/grupo/\' . $id . \'/delete\' ) }}}" class="btn btn-sm btn-danger iframe"><span class="glyphicon glyphicon-trash"></span> {{ trans("admin/modal.delete") }}</a>
                    <input type="hidden" name="row" value="{{$id}}" id="row">')
            ->remove_column('id')

            ->make();
    }


    /**
     * Reorder items
     *
     * @param items list
     * @return items from @param
     */
    public function getReorder(ReorderRequest $request) {
        $list = $request->list;
        $items = explode(",", $list);
        $order = 1;
        foreach ($items as $value) {
            if ($value != '') {
                Grupo::where('id', '=', $value) -> update(array('position' => $order));
                $order++;
            }
        }
        return $list;
    }
}
