<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
        $rules = [
            'title' => 'required',
            'body' => 'required',
            'category_id' => 'required',
        ];

        return $rules;
    }

    public function messages()
    {
        return [
            'title.required' => 'Post title is required',
            'body.required' => 'Post body is required',
            'category_id.required' => 'Post category is required',
        ];
    }
}
