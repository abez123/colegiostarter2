<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\Materia;
use App\Grupo;
use App\Departamento;
use App\Http\Requests\Admin\MateriaRequest;
use App\Http\Requests\Admin\ReorderRequest;
use App\Http\Requests\Admin\DeleteRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Datatables;

class MateriaController extends AdminController {

    /*
   * Display a listing of the resource.
   *
   * @return Response
   */
    public function index()
    {
        // Show the page
        return view('admin.materia.index');
    }

    /**
     * Show a list of all the grupo posts.
     *
     * @return View
     */
    public function itemsForDepartamento($id) {

        $departamento = Departamento::find($id);
        // Show the page
        return view('admin.materia.index', compact('departamento'));
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
        return view('admin.materia.create_edit', compact('departamentos','departamento'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function postCreate(MateriaRequest $request)
    {
        $materia = new Materia();
        $materia -> user_id = Auth::id();
        $materia -> name = $request->name;
        $materia -> departamento_id = $request->departamento_id;
        $materia -> clave = $request->clave;
        $materia -> plan = $request->plan;



        $materia -> save();


    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function getEdit($id)
    {
        $materia = Materia::find($id);

        $departamentos = Departamento::all();
        $departamento = $materia->departamento_id;
        $materia -> name;
        $materia -> clave;
        $materia -> plan;
        

        return view('admin.materia.create_edit',compact('materia','departamentos','departamento'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function postEdit(MateriaRequest $request, $id)
    {
        $materia = Materia::find($id);
        $materia -> user_id = Auth::id();
        $materia -> name = $request->name;
        $materia -> departamento_id = $request->departamento_id;
        $materia -> clave = $request->clave;
        $materia -> plan= $request->plan;

        $materia -> save();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return Response
     */

    public function getDelete($id)
    {
        $materia =Materia::find($id);
        // Show the page
        return view('admin.materia.delete', compact('materia'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return Response
     */
    public function postDelete(DeleteRequest $request,$id)
    {
        $materia = Materia::find($id);
        $materia->delete();
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

        $materia = DB::table('departamentos')
            ->orderBy('nombre', 'asc')
            ->lists('nombre', 'id');



        return view('admin.materia.create_edit', compact('materia'));

    }


    /**
     * Show a list of all the languages posts formatted for Datatables.
     *
     * @return Datatables JSON
     */
    public function data() {
        $materiadepa = Materia::join('departamentos', 'departamentos.id', '=', 'materias.departamento_id')
            ->select(array('materias.id','materias.name','departamentos.descripcion as depaname','materias.clave','materias.plan'))
            ->orderBy('materias.position', 'ASC');

        return Datatables::of($materiadepa)
            -> edit_column('position', '{{ DB::table(\'materias\')->where(\'departamento_id\', \'=\', $id)->count() }}</a>')
            ->add_column('actions', '
                    <a href="{{{ URL::to(\'admin/materia/\' . $id . \'/edit\' ) }}}" class="btn btn-success btn-sm iframe" ><span class="glyphicon glyphicon-pencil"></span>  {{ trans("admin/modal.edit") }}</a>
                    <a href="{{{ URL::to(\'admin/materia/\' . $id . \'/delete\' ) }}}" class="btn btn-sm btn-danger iframe"><span class="glyphicon glyphicon-trash"></span> {{ trans("admin/modal.delete") }}</a>
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
