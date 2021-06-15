<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckTagRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch ($this->method()) {

            case 'POST':
                return [
                    'name' => 'required|min:3|unique:tags',
                ];

            case 'PUT':
            case 'PATCH':

                return [
                    'name' => 'required|min:3,unique:tags,name,'.$this->tag->id
                ];

            case 'GET':
            case 'DELETE':
            default:
                return [];

        }
    }
}
