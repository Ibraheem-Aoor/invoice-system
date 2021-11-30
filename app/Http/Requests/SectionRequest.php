<?php

namespace App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class SectionRequest extends FormRequest
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
            'section_name' => 'string|required|max:225|unique:sections,user_id,'.Auth::id(),
        ];
    }

    public function messages()
    {
        return [
            'section_name.required' => 'اسم القسم مطلوب',
            'section_name.max' => 'اسم القسم طويل جدا',
            'section_name.string' => 'اسم القسم غير مقبول',
            'section_name.unique' => 'اسم القسم موجود مسبقا',
        ];
    }
}
