<?php

namespace App\Http\Controllers\Invoices;
use App\Http\Controllers\Controller;
use App\Http\Requests\InvoiceUpdate;
use App\Models\Invoices;
use App\Models\Section;
use Illuminate\Http\Request;
use App\Http\Requests\InvoiceRequest;
use Illuminate\Support\Facades\DB;
use App\Models\InvoiceDetails;
use Illuminate\Support\Facades\Auth;
use App\Models\InvoiceAttachments;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Notification;
use App\Notifications\IncvoiceAdded;
use Illuminate\Support\Facades\Schema;

class InvoicesController extends Controller
{//start Class
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {

        $invoices = Invoices::where('user_id' , Auth::id())->with('section')->get();
        foreach ($invoices as $i)
            $i->section->makeHidden(['id', 'description', 'created_at', 'updated_at']);
        return view('invoices.invoices-list', compact('invoices'));

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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(InvoiceRequest $request)
    {
        $this->insertInvoice($request);
        $invoice_id = Invoices::latest()->first()->id;
        $this->insertInvoiceDetails($request, $invoice_id);
        if ($request->pic != null)
            $this->insertInvoiceAttachments($request, $invoice_id);
        session()->flash('Add', 'تمت إضافة الفاتورة بنجاح');
        // Notification::send(Auth::user() ,  new IncvoiceAdded($invoice_id));
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Invoices $invoices
     * @return \Illuminate\Http\Response
     */
    public function show()
    {

        $sections = Section::where('user_id' , Auth::id())->get();
        return view('invoices.add-invoice', compact('sections'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Invoices $invoices
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $invoice = Invoices::with('section')->find($id);
        $invoice->section->makeHidden(['description', 'created_at', 'updated_at']);
        $sections = Section::all();
        return view('invoices.invoice-edit', compact('invoice', 'sections'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Invoices $invoices
     * @return \Illuminate\Http\Response
     */
    public function update(InvoiceUpdate $request, $id)
    {
        $invoice = Invoices::find($id);//inovice Table
        if($request->exists('status'))
        {
            if($request->status == 1)
                if($request->paidAmount == 0 || $request->paidAmount == null)
                    return redirect()->back()->with(['emptyPaidAmount' => 'الرجاء ادخال المبلغ المحصل']);
            $this->updateInvoiceTable($request , $invoice , $request->status);
            $this->createNewDetailsRecord($request , $id);
            session()->flash('Add', 'تم تغيير حالة الدفع بنجاح');
            return redirect()->back();
        }
        $this->updateInvoiceTable($request , $invoice , 2);
        $invoiceDeatilesArray = InvoiceDetails::where('id_Invoice' , $id)->get();//the invoice might have multiple detailes recoreds
        $this->updateInvoiceDetailesTable($request , $invoiceDeatilesArray , $request->old_invoice_number);
        session()->flash('Add', 'تم تعديل الفاتورة بنجاح');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Invoices $invoices
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $target = Invoices::find($id);
        $target->forcedelete();
         //When deleting the invoice It's attachments directory will be deleted
        Storage::disk('public_uploads')->getDriver()->deleteDir('/'.$target->invoice_number);
        session()->flash('delete' , 'تم حذف الفاتورة بنجاح');
        return redirect()->back();
    }

    /* Start insert Methods */
    public function insertInvoice(Request $request)
    {

        Invoices::create([
            'invoice_number' => $request->invoice_number,
            'invoice_Date' => $request->invoice_Date,
            'Due_date' => $request->Due_date,
            'section_id' => $request->Section,
            'product' => $request->product,
            'Amount_collection' => $request->Amount_collection,
            'Amount_Commission' => $request->Amount_Commission,
            'Discount' => $request->Discount,
            'Value_VAT' => $request->Value_VAT,
            'Rate_VAT' => $request->Rate_VAT,
            'Total' => $request->Total,
            'note' => $request->note,
            'Status' => 2,
            'user_id' => Auth::id(),
        ]);
    }

    public function insertInvoiceDetails(Request $request, $inv_id)
    {
        InvoiceDetails::create([
            'id_Invoice' => $inv_id,
            'invoice_number' => $request->invoice_number,
            'product' => $request->product,
            'Section' => $request->Section,
            'note' => $request->note,
            'user' => Auth::user()->name,
            'Status' => 2,
        ]);
    }

    public function insertInvoiceAttachments(Request $request, $inv_id)
    {
        $file_name = $request->pic->getClientOriginalName();
        $request->pic->move(public_path('Attachments/' . $request->invoice_number), $file_name);
        InvoiceAttachments::create([
            'invoice_id' => $inv_id,
            'file_name' => $file_name,
            'invoice_number' => $request->invoice_number,
            'Created_by' => Auth::user()->name,
        ]);
    }
    /* End insert Methods */

//--------------------------------------------------------------------------------

    /* Start Update Methods */
    public function updateInvoiceTable(Request $request , Invoices $invoice , $status)
    {

        $total = $request->Total - $request->paidAmount;
        $date = now();
        if($request->status == 2)
            $date = null;
        $invoice->update([
            'invoice_number' => $request->invoice_number,
            'invoice_Date' => $request->invoice_Date,
            'Due_date' => $request->Due_date,
            'section_id' => $request->Section,
            'product' => $request->product,
            'Amount_collection' => $request->Amount_collection,
            'Amount_Commission' => $request->Amount_Commission,
            'Discount' => $request->Discount,
            'Value_VAT' => $request->Value_VAT,
            'Rate_VAT' => $request->Rate_VAT,
            'Total' => $total,
            'Payment_Date' => $date ,  //Updating the payment date.
            'note' => $request->note,
            'Status'=>$status,
        ]);
    }

    public function updateInvoiceDetailesTable(Request $request ,  $invoiceDeatilesArray ,$old_invoice_number)
    {
        foreach($invoiceDeatilesArray as $i)
        {
            $i->update([
                'invoice_number' => $request->invoice_number,
                'product' => $request->product,
                'Section' => $request->Section,
                'Status'=>2,
                'note' => $request->note,
                'user' => Auth::user()->name,
            ]);
        }
        $this->updaeInvoiceAttachmentfileName($request->invoice_number , $old_invoice_number  , true);
    }


    public function createNewDetailsRecord(Request $request , $id)
    {
        $date = now();
        if($request->status == 2)
            $date = null;
            InvoiceDetails::create([
                    'invoice_number' => $request->invoice_number,
                    'id_Invoice' => $id,
                    'product' => $request->product,
                    'Section' => $request->Section,
                    'Payment_Date' => $date,
                    'Status'=>$request->status,
                    'note' => $request->note,
                    'user' => Auth::user()->name,
            ]);
    }




    public function updaeInvoiceAttachmentfileName($newInvoiceNumber , $old_invoice_number)
    {
        $targetInvoice = InvoiceAttachments::where('invoice_number'  , $old_invoice_number)->update([
            'invoice_number' => $newInvoiceNumber,
        ]);
        Storage::disk('public_uploads')->move($old_invoice_number , $newInvoiceNumber);
    }

    /* End Update Methods */

//for ajax request
    public function getproducts($id)
    {
        $products = DB::table("products")->where("section_id", $id)->pluck("product_name", "id");
        return json_encode($products);
    }

    /* Deleting All*/
    public function deleteAll()
    {
        Schema::disableForeignKeyConstraints();
        Invoices::where('user_id', Auth::id())->truncate();
        session()->flash('allDeleted' ,'تم حذف الفواتير بنجاح');
        Schema::enableForeignKeyConstraints();
        return redirect()->back();
    }

}//End Class
