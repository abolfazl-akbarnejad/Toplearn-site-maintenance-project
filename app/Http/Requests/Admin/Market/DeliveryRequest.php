<?php

namespace App\Http\Requests\Admin\Market;

use Illuminate\Foundation\Http\FormRequest;

class DeliveryRequest extends FormRequest
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
                'name' => 'required|string|min:2|max:150',
                'amount' => 'required|min:5|max:100',
                'delivery_time' => 'required|integer|min:3|max:20',
                'delivery_time_unit' => 'required|string|min:2|max:100',
                // 'status' => 'required|numeric|in:0,1',
            ];
        } else {
            return [
                'name' => 'required|string|min:2|max:150',
                'amount' => 'required|min:5|max:100',
                'delivery_time' => 'required|integer|min:3|max:20',
                'delivery_time_unit' => 'required|string|min:2|max:100',
                // 'status' => 'required|numeric|in:0,1',
            ];
        }
    }
    public function attributes()
    {
        return [
            'amount' => 'هزینه',
            'name' => 'عنوان نقش',
            'delivery_time' => 'زمان',
            'delivery_time_unit' => 'واحد زمان',
        ];
    }
}
