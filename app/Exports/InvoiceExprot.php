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
           ' القسم' , 'الخصم',
           ' نسبة الضريبة' , 'قيمة الضريبة',
           ' الاجمالي' , 'الحالة',
        ];
    }
    public function styles(Worksheet $sheet)
    {
        return[
            1 => ['font' => ['bold' => true]],
        ];
    }
    /* End implementing methods */


    public function collection()
    {
       $invoices = Invoices::all();
       $invoices->makeHidden(['id' , 'note']);
       return $invoices;
    }
}//End Class
