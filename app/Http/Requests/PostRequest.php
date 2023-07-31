<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {

        $post = $this->route()->parameter('post');

        /* campos a validar en caso de que el campo status mandemos el valor de 1*/
        $rules = [
            'name' => 'required',
            'slug' => 'required|unique:posts',
            'status' => 'required|in:1,2',
            'images' => 'required|array|max:10',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ];

        if ($post) {
            $rules['slug'] = 'required|unique:posts,slug,'.$post->id;
        }
        /* campos a validar en caso de que el campo status mandemos el valor de 2*/
        if ($this->status == 2) {
            $rules = array_merge($rules,[
                'category_id' => 'required',
                'extract' => 'required',
                'body' => 'required',
            ]);
        }
        return $rules;
    }
}
