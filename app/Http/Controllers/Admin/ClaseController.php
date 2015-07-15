<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\Grupo;
use App\Departamento;
use App\Clase;
use App\Maestro;
use App\Materia;
Use App\User;
use App\Http\Requests\Admin\ClaseRequest;
use App\Http\Requests\Admin\ReorderRequest;
use App\Http\Requests\Admin\DeleteRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Datatables;

class ClaseController extends AdminController {

    /*
   * Display a listing of the resource.
   *
   * @return Response
   */
    public function index()
    {
        // Show the page
        return view('admin.clases.index');
    }

     public function itemsForHorario($id) {

      
        $clase = Clase::find($id);
        // Show the page
        return view('admin.clases.horario', compact('clase'));
    }

    /**
     * Show a list of all the grupo posts.
     *
     * @return View
     */
    

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function getCreate()
    {
        $grupos =  Grupo::all();



        $grupo = "";

        $maestros = User::all()->where('admin', 'maestro');

        $materias= Materia::all();
        $materia = "";
        
        // Show the page
        return view('admin.clases.create_edit', compact('grupos','grupo','maestros','maestro','materias','materia'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function postCreate(ClaseRequest $request)
    {
        $clase = new Clase();
        $clase -> name = $request->name;

        $clase -> lunesi = $request->lunesi;
        $clase -> lunesf = $request->lunesf;
        $clase -> martesi = $request->martesi;
        $clase -> martesf = $request->martesf;
        $clase -> miercolesi = $request->miercolesi;
        $clase -> miercolesf = $request->miercolesf;
        $clase -> juevesi = $request->juevesi;
        $clase -> juevesf = $request->juevesf;
        $clase -> viernesi = $request->vienresi;
        $clase -> viernesf = $request->vienresf;
        $clase -> sabadoi = $request->sabadoi;
        $clase -> sabadof = $request->sabadof;
        $clase -> grupo_id = $request->grupo_id;
        $clase -> maestro_id = $request->maestro_id;
        $clase -> materia_id = $request->materia_id;
        $clase -> confirmed = $request->confirmed;



        $clase -> save();


    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function getEdit($id)
    {
        $clase = Clase::find($id);

        $grupos = Grupo::all();
        $grupo = $clase->grupo_id;
        $maestros = Maestro::all();
        $maestro = $clase->maestro_id;
        $materias = Materia::all();
        $materia = $clase->materia_id;
        $clase -> name;
        $clase -> lunesi;
        $clase -> lunesf;
        $clase -> martesi;
        $clase -> martesf;
        $clase -> miercolesi;
        $clase -> miercolesf;
        $clase -> juevesi;
        $clase -> juevesf;
        $clase -> viernesi;
        $clase -> viernesf;
        $clase -> sabadoi;
        $clase -> sabadof;
        $clase -> confirmed;

        return view('admin.clases.create_edit', compact('clase','grupos','grupo','maestros','maestro','materias','materia'));
    }
    

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function postEdit(ClaseRequest $request, $id)
    {
        $clase = Clase::find($id);
        $clase -> name = $request->name;

        $clase -> lunesi = $request->lunesi;
        $clase -> lunesf = $request->lunesf;
        $clase -> martesi = $request->martesi;
        $clase -> martesf = $request->martesf;
        $clase -> miercolesi = $request->miercolesi;
        $clase -> miercolesf = $request->miercolesf;
        $clase -> juevesi = $request->juevesi;
        $clase -> juevesf = $request->juevesf;
        $clase -> viernesi = $request->viernesi;
        $clase -> viernesf = $request->viernesf;
        $clase -> sabadoi = $request->sabadoi;
        $clase -> sabadof = $request->sabadof;
        $clase -> grupo_id = $request->grupo_id;
        $clase -> maestro_id = $request->maestro_id;
        $clase -> materia_id = $request->materia_id;
       
        $clase -> confirmed = $request->confirmed;



        $clase -> save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return Response
     */

    public function getDelete($id)
    {
        $clase = Clase::find($id);
        // Show the page
        return view('admin.clases.delete', compact('clase'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return Response
     */
    public function postDelete(DeleteRequest $request,$id)
    {
        $clase = Clase::find($id);
        $clase->delete();
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
  /*  public function getItemsForHorario($id)
    {



        $horario=Clase::find($id);
        $horarios = Clase::select(array('clases.id','clases.lunesi', 'clases.lunesf','clases.martesi','clases.martesf','clases.miercolesi','clases.miercolesf','clases.juevesi','clases.juevesf','clases.viernesi','clases.viernesf','clases.sabadoi','clases.sabadof'))
        ->where('id','=',$id);

        // Show the page




      return Datatables::of($horarios,$horario)


          ->make();

      //return view('admin.clases.horario', compact('horarios','horario2','horario'));
    }

*/
    /**
     * Show a list of all the languages posts formatted for Datatables.
     *
     * @return Datatables JSON
     */
    public function data() {

        $clase = Clase::
            join('grupos', 'grupos.id', '=', 'clases.grupo_id')
            ->join('users', 'users.id', '=', 'clases.maestro_id')
            ->join('materias', 'materias.id', '=', 'clases.materia_id')



        ->select(array('clases.id', 'clases.name', 'grupos.name as grupo', 'materias.name as materia', 'users.name as maestro','clases.confirmed'))
            ->orderBy('clases.name', 'ASC');

        return Datatables::of($clase)
            ->edit_column('confirmed', '@if ($confirmed=="1") <span class="glyphicon glyphicon-ok"></span> @else <span class=\'glyphicon glyphicon-remove\'></span> @endif')
            ->add_column('actions','<a href="{{{ URL::to(\'admin/clases/\' . $id . \'/itemsforhorario\' ) }}}" class="btn btn-info btn-sm" ><span class="glyphicon glyphicon-open"></span> Horario</a>
                    <a href="{{{ URL::to(\'admin/clases/\' . $id . \'/edit\' ) }}}" class="btn btn-success btn-sm iframe" ><span class="glyphicon glyphicon-pencil"></span>  {{ trans("admin/modal.edit") }}</a>
                    <a href="{{{ URL::to(\'admin/clases/\' . $id . \'/delete\' ) }}}" class="btn btn-sm btn-danger iframe"><span class="glyphicon glyphicon-trash"></span> {{ trans("admin/modal.delete") }}</a>
                    <input type="hidden" name="row" value="{{$id}}" id="row">')
            ->remove_column('id')

            ->make();
    }
    public function data2($horaid=0) {
        $condition =(intval($horaid)==0)?">":"=";
        $clase2 = Clase::where('clases.id',$condition,$horaid)
        ->select(array('clases.name', 'clases.lunesi', 'clases.lunesf', 'clases.martesi', 'clases.martesf','clases.miercolesi','clases.miercolesf','clases.juevesi','clases.juevesf','clases.viernesi','clases.viernesf','clases.sabadoi','clases.sabadof'))
        ->orderBy('clases.id', 'ASC');



        return Datatables::of($clase2)->make();
    }

      /* public function data3($id) {
        
        $clase3 = Clase::find($id)->select(array('clases.name', 'clases.lunesi', 'clases.lunesf', 'clases.martesi', 'clases.martesf','clases.miercolesi','clases.miercolesf','clases.juevesi','clases.juevesf','clases.viernesi','clases.viernesf','clases.sabadoi','clases.sabadof'))
       ;



        return Datatables::of($clase3)->make();
    }
    /**
     * Reorder items
     *
     * @param items list
     * @return items from @param
     */
   /*public function getReorder(ReorderRequest $request) {
        $list = $request->list;
        $items = explode(",", $list);
        $order = 1;
        foreach ($items as $value) {
            if ($value != '') {
                Grupo::where('id', '=', $value) -> update(array('name' => $order));
                $order++;
            }
        }
        return $list;
    }
*/
}
