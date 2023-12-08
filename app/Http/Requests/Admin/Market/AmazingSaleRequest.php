<?php

namespace App\Http\Requests\Admin\Market;

use Illuminate\Foundation\Http\FormRequest;

class AmazingSaleRequest extends FormRequest
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

                'product_id' => 'required|numeric|exists:products,id',
                'percentage' => 'required|numeric|max:100',
                'status' => 'required|numeric|in:0,1',

            ];
        } else {
            return [
                'product_id' => 'required|numeric|exists:products,id',
                'percentage' => 'required|numeric|max:100',
                'status' => 'required|numeric|in:0,1',

            ];
        }
    }
    public function attributes()
    {
        return [
            'product_id' => 'محصول',
            'percentage' => 'درصد',
        ];
    }
}
