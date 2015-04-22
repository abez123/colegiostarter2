<?php namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class MaestroRequest extends FormRequest {

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nombre' => 'required|min:3',
            'email' => 'required|email|unique:mestros',
            'password' => 'required|confirmed|min:5',
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
