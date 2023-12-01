<?php

namespace App\Http\Requests\Admin\Market;

use Illuminate\Foundation\Http\FormRequest;

class CategoryAttributeValueRequest extends FormRequest
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

                'product_id' => 'required|exists:products,id',
                'type' => 'required|in:0,1',
                'value' => 'required|min:2|max:150|regex:/^[آ-یا-ی0-9]+$/u',
                'price_increase' => 'required|min:2'
            ];
        } else {
            return [
                'product_id' => 'required|exists:products,id',
                'type' => 'required|in:0,1',
                'value' => 'required|min:2|max:150|regex:/^[آ-یا-ی0-9]+$/u',
                'price_increase' => 'required|min:2'
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
