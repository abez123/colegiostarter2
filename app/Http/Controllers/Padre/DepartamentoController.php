<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Input;
use App\Departamento;
use App\Http\Requests\Admin\DepartamentoRequest;
use App\Http\Requests\Admin\DeleteRequest;
use App\Http\Requests\Admin\ReorderRequest;
use Illuminate\Support\Facades\Auth;
use Datatables;

class DepartamentoController extends AdminController {
    /**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        // Show the page
        return view('admin.departamento.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function getCreate()
	{
       // Show the page
        return view('admin/departamento/create_edit');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function postCreate(DepartamentoRequest $request)
	{
        $departamento = new Departamento();
        $departamento -> user_id = Auth::id();
        $departamento -> depa_code = $request->depa_code;
        $departamento -> nombre = $request->nombre;
        $departamento -> descripcion = $request->descripcion;

        $icon = "";
        if(Input::hasFile('icon'))
        {
            $file = Input::file('icon');
            $filename = $file->getClientOriginalName();
            $extension = $file -> getClientOriginalExtension();
            $icon = sha1($filename . time()) . '.' . $extension;
        }
        $departamento -> icon = $icon;
        $departamento -> save();

        if(Input::hasFile('icon'))
        {
            $destinationPath = public_path() . '/images/departamento/'.$departamento->id.'/';
            Input::file('icon')->move($destinationPath, $icon);
        }
	}
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getEdit($id)
	{
        $departamento = Departamento::find($id);

        return view('admin/departamento/create_edit',compact('departamento'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function postEdit(DepartamentoRequest $request, $id)
	{
        $departamento = Departamento::find($id);
        $departamento -> user_id_edited = Auth::id();
        $departamento -> depa_code = $request->depa_code;
        $departamento -> nombre = $request->nombre;
        $departamento -> descripcion = $request->descripcion;
        $icon = "";

        if(Input::hasFile('icon'))
        {
            $file = Input::file('icon');
            $filename = $file->getClientOriginalName();
            $extension = $file -> getClientOriginalExtension();
            $icon = sha1($filename . time()) . '.' . $extension;
        }
        $departamento -> icon = $icon;
        $departamento -> save();

        if(Input::hasFile('icon'))
        {
            $destinationPath = public_path() . '/images/departamento/'.$departamento->id.'/';
            Input::file('icon')->move($destinationPath, $icon);
        }
	}

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return Response
     */

    public function getDelete($id)
    {
        $departamento = $id;
        // Show the page
        return view('admin/departamento/delete', compact('departamento'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return Response
     */
    public function postDelete(DeleteRequest $request,$id)
    {
        $departamento = Departamento::find($id);
        $departamento->delete();
    }

    /**
     * Show a list of all the languages posts formatted for Datatables.
     *
     * @return Datatables JSON
     */
    public function data()
    {
        $departamento = Departamento::whereNull('departamentos.deleted_at')
            ->orderBy('departamentos.position', 'ASC')
            ->select(array('departamentos.id', 'departamentos.nombre', 'departamentos.depa_code','departamentos.descripcion',
            'departamentos.id as grupo_count'));

        return Datatables::of($departamento)
            ->edit_column('grupo_count', '<a class="btn btn-primary btn-sm" >{{ DB::table(\'grupos\')->where(\'departamento_id\', \'=\', $id)->count() }}</a>')

            ->add_column('actions', '<a href="{{{ URL::to(\'admin/grupo/\' . $id . \'/itemsfordepa\' ) }}}" class="btn btn-info btn-sm" ><span class="glyphicon glyphicon-open"></span>  Grupos</a>
<a href="{{{ URL::to(\'admin/departamento/\' . $id . \'/edit\' ) }}}" class="btn btn-success btn-sm iframe" ><span class="glyphicon glyphicon-pencil"></span> {{ trans("admin/modal.edit") }}</a>
                    <a href="{{{ URL::to(\'admin/departamento/\' . $id . \'/delete\' ) }}}" class="btn btn-sm btn-danger iframe"><span class="glyphicon glyphicon-trash"></span> {{ trans("admin/modal.delete") }}</a>
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
