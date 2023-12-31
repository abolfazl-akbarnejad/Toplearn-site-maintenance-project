<?php

namespace App\Http\Requests\Admin\Notify;

use Illuminate\Foundation\Http\FormRequest;

class EmailFileRequest extends FormRequest
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
                'file' => 'required|file|max:50906206|mimes:png,jpg,jpeg,pdf,zip',

            ];
        } else {
            return [
                'file' => 'required|file|size:50906206|mimes:png,jpg,jpeg,pdf,zip',
            ];
        };
    }
}
