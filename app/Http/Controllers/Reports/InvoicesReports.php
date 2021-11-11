<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Invoices;

class InvoicesReports extends Controller
{//start class

    public function index()
    {
        return view('reports.invoices-reports');
    }

    public function search(Request $request)
    {
        $type = $request->type;
        if($type == 2)
            $type = 'الفواتير الغير مدفوعة';
        elseif($type == 0)
            $type = 'الفواتير  مدفوعة';
        elseif($type == 1)
            $type = 'الفواتير المدفوعة جزيئا';

        $invoices = $request->radio == 2 ? $this->searchByNumber($request) : $this->searchByDate($request);
        if($invoices->count() == 0 || $invoices == null)
        {
            session()->flash('empty' , 'لم يتم العثور على نتائج');
            return view('reports.invoices-reports' );
        }
        return view('reports.invoices-reports' ,compact('invoices' , 'type'));
        }

    public function searchByNumber($request)
    {
        return Invoices::where('invoice_number' , $request->invoice_number)->with('section')->get();
    }

    public function searchByDate($request)
    {
        $startAt = date($request->start_at);
        $endAt = date($request->end_at);
        $type = $request->type;//numeric
        if($startAt == null && $endAt != null)
            return Invoices::where(['Due_date' => $endAt , 'Status' =>$type])->with('section')->get();
        elseif($startAt != null && $endAt == null)
            return Invoices::where(['invoice_Date' => $startAt , 'Status' =>$type])->with('section')->get();
        elseif($startAt == null && $endAt == null)
            return Invoices::where('Status' , $type)->with('section')->get();
        elseif($startAt != null && $endAt != null && $type == null)
            return Invoices::whereBetween('invoice_Date' , [$startAt , $endAt])->with('section')->get();

        return Invoices::whereBetween('invoice_Date' , [$startAt , $endAt])->with('section')->where('Status' , $request->type)->get();
    }

}//End Class
