<?php

namespace App\Http\Requests\Admin\Market;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
                'name' => 'required|max:120|min:2|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي., ]+$/u',
                'interoduction' => 'required|max:1000|min:5',
                'image' => 'required|image|mimes:png,jpg,jpeg,gif',
                'status' => 'required|numeric|in:0,1',
                'tags' => 'required',
                'marketable' => 'required|numeric|in:0,1',
                'weght' => 'required|min:5|integer',
                'lenght' => 'required|min:5|integer',
                'width' => 'required|min:5|integer',
                'height' => 'required|min:5|regex:/^[0-9.]+$/u',
                'price' => 'required|min:1',
                'category_id' => 'required|min:1|regex:/^[0-9]+$/u|exists:product_categories,id',
                'brand_id' => 'required|min:1|regex:/^[0-9]+$/u|exists:brands,id',
                'published_at' => 'required',

            ];
        } else {
            return [
                'name' => 'required|max:120|min:2|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي., ]+$/u',
                'interoduction' => 'required|max:1000|min:5',
                'image' => 'nullable|image|mimes:png,jpg,jpeg,gif',
                'status' => 'required|numeric|in:0,1',
                'tags' => 'required|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي., ]+$/u',
                'marketable' => 'required|numeric|in:0,1',
                'weght' => 'required|min:5',
                'lenght' => 'required|min:5',
                'width' => 'required|min:5',
                'height' => 'required|min:5|regex:/^[0-9.]+$/u',
                'price' => 'required|min:1',
                'category_id' => 'required|min:1|regex:/^[0-9]+$/u|exists:product_categories,id',
                'brand_id' => 'required|min:1|regex:/^[0-9]+$/u|exists:brands,id',
                'published_at' => 'required',
            ];
        }
    }
    public function attributes()
    {
        return [
            'interoduction'=> 'توضیحات',
            'marketable'=> 'قابل فروش',
            'weight'=> 'وزن',
            'lenght'=> 'طول',
            'width'=> 'عرض',
            'height'=> 'ارتفاع',
            'price'=> 'قیمت',
        ];
    }
}
