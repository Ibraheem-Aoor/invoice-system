<?php

namespace App\Http\Controllers;

use App\Models\Invoices;
use Illuminate\Http\Request;
use App\Notifications\NewUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class HomeController extends Controller
{//satart class
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {
        $numberOfInvoices = Invoices::count();
        $numberOfPaidInvoices = Invoices::where('Status' , 0)->count();
        $paidRate = $numberOfPaidInvoices/$numberOfInvoices * 100;

        $numberOfInPaidInvoices = Invoices::where('Status' , 2)->count();
        $inpaidRate = $numberOfInPaidInvoices/$numberOfInvoices * 100;

        $numberOfPartlyPaidInvoices = Invoices::where('Status' , 1)->count();
        $partPaidRate = $numberOfPartlyPaidInvoices/$numberOfInvoices * 100;
        return view('index');

    }



}//End Class
