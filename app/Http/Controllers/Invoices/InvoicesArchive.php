<?php

namespace App\Http\Controllers\Invoices;

use App\Http\Controllers\Controller;
use App\Models\Invoices;
use Illuminate\Http\Request;

class InvoicesArchive extends Controller
{//Start Class

    public function index()
    {
        $invoices = Invoices::onlyTrashed()->get();
        return view('invoices.Invoice-Archive' , compact('invoices'));
    }

    public function invoiceArchive($id)
    {
        $target = Invoices::find($id);
        $target->delete();//softDelete here
        session()->flash('Archived');
        return redirect()->back();
    }

    public function InvoiceRestore($id)
    {
        $target = Invoices::withTrashed()->find($id);
        $target->restore();
        return redirect()->back();

    }

}//End Class
