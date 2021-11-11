<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */

    // DataFields for the request

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
        return  [
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'يجب  وضع اسم الصلاحية',
                'name.unique' => 'اسم الصلاحية موجود مسبقا',
                'permission.required' => 'يجب تعيين الاذون',
        ];
    }
}
