<?php

namespace App\Http\Requests\Admin\Market;

use Illuminate\Foundation\Http\FormRequest;

class BrandRequest extends FormRequest
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

                'persian_name' => 'required|min:2|max:150|regex:/^[آ-یا-ی0-9]+$/u',
                'orginal_name' => 'required|min:5|max:100|regex:/^[a-zA-Z0-9,.]+$/u',
                'logo' => 'required|image',
                'tags' => 'required|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي., ]+$/u',
                'status' => 'required|numeric|in:0,1',
            ];
        } else {
            return [
                'persian_name' => 'required|min:2|max:150|regex:/^[آ-یا-ی0-9]+$/u',
                'orginal_name' => 'required|min:5|max:100|regex:/^[a-zA-Z0-9,.]+$/u',
                'logo' => 'nullable|image',
                'tags' => 'required|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي., ]+$/u',
                'status' => 'required|numeric|in:0,1',
            ];
        }

        
    }
    public function attributes()
        {
            return[
                'persian_name' => 'نام کالا به فارسی',
                'orginal_name' => 'نام کالا به زبان اصلی',
                'logo' => 'لوگو',
            ];
        }
}
