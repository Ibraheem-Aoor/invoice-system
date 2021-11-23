<?php

namespace App\Exports;

use App\Models\Invoices;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;
use Maatwebsite\Excel\Concerns\WithFormatData;
use Illuminate\Support\Facades\Auth;
use App\Models\Section;
class InvoiceExprot implements FromCollection , WithHeadings ,ShouldAutoSize ,
    WithStyles , WithStrictNullComparison , WithFormatData
{//start class
    /**
    * @return \Illuminate\Support\Collection
    */

    /* Start implementing methods */
    public function headings():array
    {
        return [
           'رقم الفاتورة' , 'تاريخ الفاتورة',
           'تاريخ الاستحقاق' , 'المنتج',
           ' القسم' , 'مبلغ التحصيل','مبلغ العمولة' , 'الخصم' , 'قيمة الضريبة' , 'نسبة الضريبة' , 'الاجمالي' , '' ,'تاريخ الدفع'
        ];
    }
    public function styles(Worksheet $sheet)
    {
        return[
            1 => ['font' => ['bold' => true],
        ],
        ];
    }
    /* End implementing methods */


    public function collection()
    {
        $invoices = Invoices::where('user_id', Auth::id())->get();
        $invoices->makeHidden(['id' , 'created_at' , 'deleted_at' , 'updated_at' ,'user_id' , 'Status']);
        return $invoices;
    }
}//End Class
