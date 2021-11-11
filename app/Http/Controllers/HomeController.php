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

        // total invoices
        $invoicesCount  = Invoices::where('user_id' , Auth::id())->count();
        $invoicesTotal  = Invoices::where('user_id' , Auth::id())->sum('Total');
        $invoicesCount = $invoicesCount == 0 ? 1: $invoicesCount;

        // paid
        $numOfPaid = Invoices::where(['Status' => 0 , 'user_id' => Auth::id()])->count();
        $rateOfPaid = $numOfPaid/$invoicesCount;
        $totalPaid = Invoices::where(['Status' => 0 , 'user_id' => Auth::id()])->sum('Total');

        // inapid
        $numOfInPaid = Invoices::where(['Status' => 2 , 'user_id' => Auth::id()])->count();
        $rateOfInPaid = $numOfInPaid/$invoicesCount;
        $totalOfInPaid = Invoices::where(['Status' => 2 , 'user_id' => Auth::id()])->sum('Total');

        // partPaid
        $numOfPartPaid = Invoices::where(['Status' => 1 , 'user_id' => Auth::id()])->count();
        $rateOfPartPaid = $numOfPartPaid/$invoicesCount;
        $totalOfPartPaid = Invoices::where(['Status' => 1 , 'user_id' => Auth::id()])->sum('Total');

        $data = [
                'invoicesCount'=> $invoicesCount ,
                'invoicesTotal' => $invoicesTotal ,
                'numOfPaid' => $numOfPaid ,
                '$rateOfPaid' => $rateOfPaid,
                 'totalPaid' => $totalPaid ,
                'numOfInPaid' => $numOfInPaid ,
                'rateOfInPaid' => $rateOfInPaid ,
                'totalOfInPaid' => $totalOfInPaid ,
                'numOfPartPaid' => $numOfPartPaid ,
                'rateOfPartPaid'=>$rateOfPartPaid ,
                'totalOfPartPaid' => $totalOfPartPaid
            ];
        // return dd($data);
        return view('index' , compact('data'));
    }

    public function login()
    {
        return view('auth.login');
    }



}//End Class
