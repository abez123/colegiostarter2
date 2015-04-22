<?php namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class DepartamentoRequest extends FormRequest {

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
            'nombre' => 'required|min:3',
            'depa_code' => 'required|min:1',
            'descripcion'=>'required',
		];
	}

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

}