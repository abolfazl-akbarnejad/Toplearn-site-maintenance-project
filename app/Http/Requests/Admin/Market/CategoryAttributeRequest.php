<?php

namespace App\Http\Requests\Admin\Market;

use Illuminate\Foundation\Http\FormRequest;

class CategoryAttributeRequest extends FormRequest
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
        if ($this->isMethod('post')) {
            return [

                'name' => 'required|min:2|max:150|regex:/^[آ-یا-ی0-9]+$/u',
                'type' => 'nullable',
                'unit' => 'required|min:3|max:100|regex:/^[a-zA-Zآ-یا-ی0-9,.]+$/u',
                'category_id' => 'required|numeric|exists:product_categories,id',
            ];
        } else {
            return [
                'name' => 'required|min:2|max:150|regex:/^[آ-یا-ی0-9]+$/u',
                'type' => 'nullable',
                'unit' => 'required|min:3|max:100|regex:/^[a-zA-Zآ-یا-ی0-9,.]+$/u',
                'category_id' => 'required|numeric|exists:product_categories,id',
            ];
        }
    }
    public function attributes()
    {
        return [
            'unit' => 'واحد اندازه گیری',
            'category_id' => 'فرم والد',
        ];
    }
}
