<?php

namespace App\Http\Controllers\Invoices;

use App\Http\Controllers\Controller;
use App\Models\InvoiceAttachments as ModelsInvoiceAttachments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class InvoiceAttachments extends Controller
{//start class

    /* Start Inserting the attachments */
    public function store(Request $request)
    {
        $request->validate(
            [
                'file' => 'file|nullable|mimes:jpeg,bmp,png,jpg,pdf,doc,xlsx|',
            ] , [
                'file.mimes' => 'صيغة الملف غير صالحة'
            ]
        );
        $this->storeFileData($request);
        session()->flash('Add' , 'تمت اضافة المرفق بنجاح');
        return redirect()->back();
    }


    public function storeFileData(Request $request)
    {
        $file_name = $request->file->getClientOriginalName();
            \App\Models\InvoiceAttachments::create([
             'file_name' => $file_name,
             'invoice_number' => $request->invoice_number,
             'Created_by' => Auth::user()->name,
             'invoice_id' => $request->invoice_id
            ]);
            $request->file->move(public_path('Attachments/'.$request->invoice_number) , $file_name);
    }
    /* End Inserting the attachments */


    public function openFile($invoice_number , $file_name)
    {
        $files = Storage::disk('public_uploads')->getDriver()->getAdapter()->applyPathPrefix($invoice_number.'/'.$file_name);
        return response()->file($files);
    }

    public function downloadFile($invoice_number , $file_name)
    {
        $file = Storage::disk('public_uploads')->getDriver()->getAdapter()->applyPathPrefix($invoice_number,$file_name);
    }

    public function delete(Request $request)
    {
            $target = ModelsInvoiceAttachments::find($request->id_file);
            $invoice_id = $target->invoice_id;
            $target->delete();
            Storage::disk('public_uploads')->getDriver()->delete('/'.$request->invoice_number.'/'.$request->file_name);
            session()->flash('delete' , 'تم حذف المرفق بنجاح');
            return redirect(route('invoices.detailes.show' , $invoice_id));
    }

}//End class
