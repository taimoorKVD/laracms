<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckPostRequest extends FormRequest
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
        switch ($this->method())
        {
            case 'POST';
                return [
                    'title' => 'required|unique:posts|min:3',
                    'description' => 'required',
                    'content' => 'required',
                    'category_id' => 'required',
                    'published_at' => 'required',
                    'image' => 'required|image',
                ];

            case 'PUT';
            case 'PATCH';
                return [
                    'title' => 'required|min:3|unique:posts,title,'.$this->post->id,
                    'description' => 'required',
                    'content' => 'required',
                    'category_id' => 'required',
                    'published_at' => 'required',
                    'image' => 'required|image',
                ];

            case 'GET';
            case 'DELETE';
            default:
                return [];

        }
    }
}
