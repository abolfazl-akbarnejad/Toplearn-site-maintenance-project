<?php

namespace App\Http\Requests\Admin\User;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
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

        $route = Route::current();
        if ($route->getName() == 'admin.user.role.store') {
            // dd('sd');
            return [
                'name' => 'required|string|min:2|max:200',
                'desctiption' => 'required|string|min:2|max:270',
                'permisions.*' => 'exists:permissions,id'
            ];
        }
    }
    public function attributes()
    {
        return [
            'desctiption' => 'توضیحات نقش',
            'name' => 'عنوان نقش',
            'permissions.*' => 'دسترسی ها'
        ];
    }
}
