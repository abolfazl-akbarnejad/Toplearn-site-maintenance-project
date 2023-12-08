<?php

namespace App\Http\Requests\Admin\Market;

use Illuminate\Foundation\Http\FormRequest;

class CopanRequest extends FormRequest
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

                'code' => 'required|min:3|max:150',
                'amount' => 'required|numeric',
                'amount_type' => 'required|numeric|in:0,1',
                'type' => 'required|numeric|in:0,1',
                'diccount_ceiling' => 'required|numeric',
                'status' => 'required|numeric|in:0,1',
                'user_id' => 'required|numeric|exists:users,id'

            ];
        } else {
            return [
                'code' => 'required|min:3|max:150',
                'amount' => 'required|numeric',
                'amount_type' => 'required|numeric|in:0,1',
                'type' => 'required|numeric|in:0,1',
                'diccount_ceiling' => 'required|numeric',
                'status' => 'required|numeric|in:0,1',
                'user_id' => 'required|numeric|exists:users,id'

            ];
        }
    }
    public function attributes()
    {
        return [
            'code' => 'کد تخفیف',
            'amount' => 'میزان تخفیف',
            'amount_type' => 'نوع',
            'type' => 'نوع تخفیف',
            'amount_type' => 'روش تخفیف',
            'user_id' => 'کاربر',
            'discount_celing' => 'حداکثر تخفیف',
        ];
    }
}
