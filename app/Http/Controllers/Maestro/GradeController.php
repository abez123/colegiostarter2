<?php namespace App\Http\Controllers\Maestro;

use App\Http\Controllers\MaestroController;
use Illuminate\Support\Facades\Input;
use App\Clase;
use App\User;
use App\Maestro;
use App\Exam;
use App\Grupo;
use App\Grade;
use App\Http\Requests\Maestro\GradeRequest;
use App\Http\Requests\Admin\DeleteRequest;
use App\Http\Requests\Admin\ReorderRequest;
use Illuminate\Support\Facades\Auth;
use Datatables;

class GradeController extends MaestroController {
    /**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        // Show the page
        return view('maestro.grade.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
    public function getCreate()

    
        {

        $exams = Exam::where('exams.maestro_id','=',Auth::id() )

->get();
        $exam = "";
        $alumnos = Grupo::join('clases','clases.grupo_id','=','grupos.id')->join('users','users.grupo_id','=','grupos.id')->where('clases.maestro_id','=',Auth::id() )
->get();
        $alumno = "";

       
        // Show the page
        return view('maestro.grade.create_edit', compact('exams','exam','alumnos','alumno'));
    }
	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function postCreate(GradeRequest $request)
	{
        $grade = new Grade();
        $grade -> maestro_id = Auth::id();
        $grade -> exam_id = $request->exam_id;
        $grade -> alumno_id = $request->alumno_id;
        $grade -> score = $request->score;

        $grade -> save();

       
	}
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getEdit($id)
	{
        $grade = Grade::find($id);

       $exams = Exam::where('exams.maestro_id','=',Auth::id() )

->get();
        $exam = $grade->exam_id;
         $alumnos = Grupo::join('clases','clases.grupo_id','=','grupos.id')->join('users','users.id','=','grupos.user_id')->where('clases.maestro_id','=',Auth::id() )
->get();
        $alumno = $grade->alumno_id;
        $grade -> score;
      
         return view('maestro.grade.create_edit',compact('grade','exams','exam','alumnos','alumno'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function postEdit(GradeRequest $request, $id)
	{
        $grade = Grade::find($id);
        $grade -> maestro_id = Auth::id();
        $grade -> score = $request->score;
        $grade-> exam_id =$request->exam_id;
        $grade-> alumno_id =$request->alumno_id;

       
        $grade -> save();

	}

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return Response
     */

    public function getDelete($id)
    {
        $grade = $id;
        // Show the page
        return view('maestro/grade/delete', compact('grade'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return Response
     */
    public function postDelete(DeleteRequest $request,$id)
    {
        $grade = Grade::find($id);
        $grade->delete();
    }

    /**
     * Show a list of all the languages posts formatted for Datatables.
     *
     * @return Datatables JSON
     */
    public function data()
    {
        $grade = Grade::join('users','users.id','=','grades.alumno_id')->join('exams','exams.id','=','grades.exam_id')->where('grades.maestro_id','=',Auth::id())
        ->select(array('grades.id', 'grades.score','grades.score','exams.mes','exams.bimestre','users.name'))
            ->orderBy('grades.score', 'ASC');
            

        return Datatables::of($grade)


            ->add_column('actions', '<a href="{{{ URL::to(\'maestro/grade/\' . $id . \'/edit\' ) }}}" class="btn btn-success btn-sm iframe" ><span class="glyphicon glyphicon-pencil"></span> {{ trans("admin/modal.edit") }}</a>
                    <a href="{{{ URL::to(\'maestro/grade/\' . $id . \'/delete\' ) }}}" class="btn btn-sm btn-danger iframe"><span class="glyphicon glyphicon-trash"></span> {{ trans("admin/modal.delete") }}</a>
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
