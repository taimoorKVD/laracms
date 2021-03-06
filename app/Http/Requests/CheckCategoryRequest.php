<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckCategoryRequest extends FormRequest
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
                    'name' => 'required|min:3|unique:categories',
                ];

            case 'PUT':
            case 'PATCH':

                return [
                    'name' => 'required|min:3,unique:categories,name,'.$this->category->id,
                    'about' => 'min:3|about,'.$this->category->id
                ];

            case 'GET':
            case 'DELETE':
            default:
                return [];

        }
    }
}
