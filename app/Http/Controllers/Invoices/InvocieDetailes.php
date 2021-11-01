<?php

namespace App\Http\Controllers\Invoices;

use App\Exports\InvoiceExprot;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\InvoiceAttachments;
use App\Models\InvoiceDetails;
use App\Models\Invoices;
use Maatwebsite\Excel\Facades\Excel;

/*
    -IMPORTANT NOTE:
        ==> when a model is softDeleted --> the find(id) method will fail because it's consderd as if it's not exists.
        ==> In General, softDeletes is used to archive records.
*/
class InvocieDetailes extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $invoice = Invoices::with('detailes' , 'attachments' , 'section')->findOrFail($id);
        $invoice->section->makeHidden(['description' , 'updated_at' , 'created_at'  , 'id']);
        return view('invoices.invoice_detailles'  , compact('invoice'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    //Redirect to payment-status-change page
    public function payment($id)
    {
        $invoice = Invoices::with('section')->findOrFail($id);
        return view('invoices.payment-status-change' , compact('invoice'));
    }

    //Redirect to print-invoice page
    public function print($id)
    {
        /*
            *** i didn't used the section relationship with this object but it's working on BLADE
        */

        $invoice = Invoices::findOrFail($id);
        return view('invoices.invoice-print' , compact('invoice'));
    }

    public function InvoicesNotPaid()
    {
         $invoices = Invoices::where('Status' , 2)->get();
         return view('invoices.invoices-paid-2' , compact('invoices'));
    }
    public function InvoicestFullyPaid()
    {
         $invoices = Invoices::where('Status' , 0)->get();
         return view('invoices.invoices-paid-0' , compact('invoices'));
    }

    public function getExcel()
    {
        return Excel::download(new InvoiceExprot(), 'Invoices.xlsx');
    }
}
