<?php namespace App\Http\Controllers\Maestro;

use App\Http\Controllers\MaestroController;
use Illuminate\Support\Facades\Input;
use App\Clase;
use App\User;
use App\Maestro;
use App\Exam;
use App\Http\Requests\Maestro\ExamRequest;
use App\Http\Requests\Admin\DeleteRequest;
use App\Http\Requests\Admin\ReorderRequest;
use Illuminate\Support\Facades\Auth;
use Datatables;

class ExamController extends MaestroController {
    /**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        // Show the page
        return view('maestro.exam.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
    public function getCreate()

    
        {

        $clases = Clase::where('clases.maestro_id','=',Auth::id() )

->get();
        $clase = "";
        // Show the page
        return view('maestro.exam.create_edit', compact('clases','clase'));
    }
	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function postCreate(ExamRequest $request)
	{
        $exam = new Exam();
        $exam -> maestro_id = Auth::id();
        $exam -> clase_id = $request->clase_id;
        $exam -> name = $request->name;
        $exam -> mes = $request->mes;
        $exam -> bimestre = $request->bimestre;

       
        $exam -> save();

       
	}
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getEdit($id)
	{
        $exam = Exam::find($id);

        $clases = Clase::all();
        $clase = $exam->clase_id;
        $exam -> name;
        $exam -> mes;
         $exam -> bimestre;
         return view('maestro.exam.create_edit',compact('exam','clases','clase'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function postEdit(ExamRequest $request, $id)
	{
        $exam = Exam::find($id);
        $exam -> maestro_id = Auth::id();
        $exam -> name = $request->name;
        $exam -> mes= $request->mes;
        $exam -> bimestre = $request->bimestre;
        $exam-> clase_id=$request->clase_id;

       
        $exam -> save();

	}

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return Response
     */

    public function getDelete($id)
    {
        $exam = $id;
        // Show the page
        return view('maestro/exam/delete', compact('exam'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return Response
     */
    public function postDelete(DeleteRequest $request,$id)
    {
        $exam = Exam::find($id);
        $exam->delete();
    }

    /**
     * Show a list of all the languages posts formatted for Datatables.
     *
     * @return Datatables JSON
     */
    public function data()
    {
        $exam = Exam::join('clases','clases.id','=','exams.clase_id')->select(array('exams.id', 'clases.id =exams.clase_id as clases.id','exams.name', 'exams.mes','exams.bimestre'))
            ->orderBy('exams.name', 'ASC');
            

        return Datatables::of($exam)


            ->add_column('actions', '<a href="{{{ URL::to(\'maestro/exam/\' . $id . \'/edit\' ) }}}" class="btn btn-success btn-sm iframe" ><span class="glyphicon glyphicon-pencil"></span> {{ trans("admin/modal.edit") }}</a>
                    <a href="{{{ URL::to(\'maestro/exam/\' . $id . \'/delete\' ) }}}" class="btn btn-sm btn-danger iframe"><span class="glyphicon glyphicon-trash"></span> {{ trans("admin/modal.delete") }}</a>
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
                Departamento::where('id', '=', $value) -> update(array('position' => $order));
                $order++;
            }
        }
        return $list;
    }

}
