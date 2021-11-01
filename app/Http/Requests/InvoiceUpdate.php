<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InvoiceUpdate extends FormRequest
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

    /*
     * In the update of the inovice there will be no attachments.
     */
    public function rules()
    {
            return [
                 'invoice_number' => 'required|numeric|digits_between:1,6|',
                 'invoice_Date' => 'required|date',
                 'Due_date' => 'required|date',
                 'Section' => 'required|string',
                 'product' => 'required|string|',
                 'Amount_collection' => 'required|numeric',
                 'Amount_Commission' => 'required|numeric',
                 'Discount' => 'required|numeric',
                 'Rate_VAT' => 'required',
                 'Value_VAT' => 'required|numeric',
                 'Total' => 'required|numeric',
                 'note' => 'string|nullable',
             ];

    }


    public function messages()
    {
        return [
            'invoice_number.required'=>'رقم الفاتورة مطلوب',
            'invoice_number.numeric'=>'رقم الفاتورة غير صالح',
            'invoice_number.digits_between'=>'رقم الفاتورة يتكون من 6 ارقام على الاكثر',
            'invoice_Date.required'=>'تاريخ الفاتورة مطلوب',
            'invoice_Date.date'=>'تاريخ الفاتورة غير صالح',
            'Due_date.required'=>'تاريخ الاستحقاق مطلوب',
            'Due_date.date'=>'تاريخ الاستحقاق غير صالح',
            'Section.required' => 'القسم مطلوب',
            'Section.string' => 'القسم غير صالح',
            'product.required' => 'المنتج مطلوب',
            'product.string' => 'القسم غير صالح',
            'Amount_collection.required' => 'مبلغ التحصيل مطلوب',
            'Amount_collection.numeric' => 'مبلغ التحصيل غير صالح',
            'Amount_Commission.required' => 'مبلغ العمولة مطلوب',
            'Amount_Commission.numeric' => 'مبلغ العمولة غير صالح',
            'Discount.required' => 'مبلغ الخصم مطلوب',
            'Discount.numeric' => 'مبلغ الخصم غير صالح',
            'Rate_VAT.required' => 'نسبة الضريبة مطلوبة',
            'Value_VAT.required' => 'قيمة الضريبة مطلوبة',
            'Total.required' => 'المبلغ الاجمالي مطلوب',
            'Total.numeric' => 'المبلغ الاجمالي غير صالح',
            'note' => 'الملاحظات غير صالحة',
        ];
    }

}
