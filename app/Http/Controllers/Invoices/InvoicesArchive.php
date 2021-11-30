<?php

namespace App\Http\Controllers\Invoices;

use App\Http\Controllers\Controller;
use App\Models\Invoices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvoicesArchive extends Controller
{//Start Class

    public function index()
    {
        $invoices = Invoices::onlyTrashed()->with('section')->get();
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

    public function archiveAll()
    {
        Invoices::where('user_id',Auth::id())->delete(); //soft
        session()->flash('allArchived' ,'تم ارشفة الفواتير بنجاح');
        return redirect()->back();
    }

}//End Class
