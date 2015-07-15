<?php namespace App\Http\Requests\Maestro;

use Illuminate\Foundation\Http\FormRequest;

class ExamRequest extends FormRequest {

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'clase_id' => 'required|integer',

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
