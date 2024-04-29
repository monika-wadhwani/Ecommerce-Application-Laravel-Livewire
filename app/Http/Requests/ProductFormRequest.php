<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductFormRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'category_id'=>'required|integer',
            'name'=>'required|string',
            'slug'=>'required|string|max:255',
            'brand'=>'required|string|max:255',
            'small_description'=>'required|string|max:255',
            'long_description'=>'required|string',
            'original_price'=>'required|integer',
            'selling_price'=>'required|integer',
            'trending'=>'nullable',
            'status'=>'nullable',
            'quantity'=>'required|integer',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif',
            'meta_title'=>'required|string',
            'meta_keyword'=>'required|string',
            'meta_description'=>'required|string',

        ];
    }
}
