<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use App\Models\Invoices;
use App\Models\Section;
use Illuminate\Http\Request;

class ClientsReports extends Controller
{//start class
    public function index()
    {
        $sections = Section::all();
        return view('reports.client-reports' , compact('sections'));
    }

    public function search(Request $request)
    {
        // return $request;
        $startAt = $request->start_at;
        $end_at = $request->end_at;
        $section_id = $request->Section;
        $product = $request->product;
        $sections = Section::all();
        $old_section = Section::where('id' , $request->Section)->first();
        if($startAt == null && $end_at == null && $section_id == null )
            return redirect(url('cleints-reoprts'))->with(['empty' => 'يجب اختيار القسم على الاقل']);
        $details = $this->searchClient($startAt  , $end_at  , $section_id , $product);
        return view('reports.client-reports' , compact('details' , 'sections' ,'old_section'));

    }


    public  function searchClient($startAt , $end_at  , $section_id , $product)
    {
        if($startAt == null && $end_at == null && $section_id != null )
            return Invoices::where('section_id' , $section_id)->get();
        if($startAt == null && $end_at == null && $section_id != null && $product != null)
            return Invoices::where('section_id' , $section_id)->where('product' , $product)->get();
    }
}//End class
