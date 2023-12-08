<?php

namespace App\Http\Requests\Admin\Market;

use Illuminate\Foundation\Http\FormRequest;

class CommonDiscountRequest extends FormRequest
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

                'title' => 'required|min:3|max:150',
                'percentage' => 'required|numeric',
                'discount_celing' => 'required|numeric',
                'minimal_order_amount' => 'required|numeric',
                'status' => 'required|numeric|in:0,1',

            ];
        } else {
            return [
                'title' => 'required|min:3|max:150',
                'percentage' => 'required|numeric',
                'discount_celing' => 'required|numeric',
                'minimal_order_amount' => 'required|numeric',
                'status' => 'required|numeric|in:0,1',

            ];
        }
    }
    public function attributes()
    {
        return [
            'category_id' => 'فرم والد',
            'percentage' => 'درصد',
            'discount_celing' => 'حداکثر تخفیف',
            'minimal_order_amount' => 'حداقل پول سبد خرید',
        ];
    }
}
