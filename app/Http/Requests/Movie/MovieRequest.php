<?php

namespace App\Http\Requests\Movie;

use Illuminate\Foundation\Http\FormRequest;

class MovieRequest extends FormRequest
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
            'title' => 'required|string|min:3|max:100',
            'description' => 'required|string|min:20',
            'rate' => 'required|numeric|min:0|max:5',
            'image' => 'required|mimes:jpeg,png,jpg',
            'category_id' => 'required|exists:categories,id',
        ];
        if($this->isMethod("PUT")){
            $rules['image'] = 'sometimes|nullable|mimes:jpeg,png,jpg';
        }
        return $rules;
    }
}
