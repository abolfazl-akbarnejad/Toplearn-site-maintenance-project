<?php

namespace App\Http\Requests\Admin\Market;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
                'transferee' => 'required|max:120|min:2',
                'delivery' => 'required|max:120|min:2',
                'description' => 'required|max:120|min:2',
                'marketable_number' => 'required|numeric',
            ];
        } else {
            return [
                'marketable_number' => 'required|numeric',
                'frozen_number' => 'required|numeric',
                'sold_number' => 'required|numeric',
            ];
        }
    }
    public function attributes()
    {
        return [
            'transferee' => 'نام تحویل گیرنده',
            'delivery' => 'نام تحویل دهنده',
            'description' => 'توضیحات',
            'marketable_number' => 'تعداد ',
            'frozen_number' => 'رزرو شده',
            'sold_number' => 'فروخته شده',
        ];
    }
}
