<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
            return [
                'product_name' => 'string|required|max:225|',
                'section_id' => 'required',
            ];
    }


    public function messages()
    {
        return [
            'product_name.required' => 'اسم القسم مطلوب',
            'product_name.max' => 'اسم القسم طويل جدا',
            'product_name.string' => 'اسم القسم غير مقبول',
            'description.required' => 'الوصف  مطلوب',
            'description.max' => ' الوصف كبير جدا',
            'description.string' => ' الوصف  غير مقبول',
        ];
    }


}
