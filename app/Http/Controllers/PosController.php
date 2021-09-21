<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\Sale;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Price;

class PosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //fetch gas sales rate (cost/kg) from settings table
        $settings = Setting::where('name', '=', 'rate')->first();
        $data['prices'] = Price::all();
        $data['customers'] = Customer::all();

        //$rate = $settings->value;
        //return $settings->value;
        //return view('pos', ['rate' => $rate]);
        return view('pos')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'cost' => 'required|numeric',
            'quantity' => 'required|numeric',
            //'phone' => 'max:11',
            'moneypaid' => 'required'
        ]);
        //return $request;
        $salesInfo = new Sale();
        $salesInfo->cost = $request['cost'];
        $salesInfo->quantity = $request['quantity'];
        $trans_id = chr(rand(65, 90)) . chr(rand(65, 90)) . mt_rand(1111, 9999);
        $salesInfo->trans_id = $trans_id;

        if ($request->discount == "") {
            $salesInfo->discount = 0;
        } else {
            $salesInfo->discount = $request->discount;
        }

        //$salesInfo->discount = $request['discount'];
        if ($request['comments'] == "" || $request['comments'] == null) {
            $salesInfo->comments = "NULL";
        } else {
            $salesInfo->comments = $request['comments'];
        }
        $salesInfo->cashier_id = Auth::user()->id;
        if ($request['refcode'] == "" || $request['refcode'] == null) {
            $couponCode = "NA";
        } else {
            //return $request['refcode'];
            $customer = Customer::where('phone_number', $request->phone)->first();
            // return $customer->has_bought;
            if (!empty($customer)) {
                if ($customer->has_bought !== 1) {
                    //return $customer->has_bought;
                    Customer::where('phone_number', $request->phone)
                        ->update(['has_bought' => 1]);
                    if ($request['refcode'] == "" || $request['refcode'] == null) {
                        $couponCode = $request->refcode;
                    } else {
                        $couponCode = "NA";
                    }
                } else {
                    $couponCode = "NA";
                    //return $couponCode;
                }
            } else{
                $couponCode = "NA";
            }
        }
        $salesInfo->payment_method = "NA";
        //return $couponCode;
        $salesInfo->save();


        //return $salesInfo->comments;
        return view('receipt', [
            'cost' => $request['cost'],
            'coupon' => $couponCode,
            'quantity' => $request['quantity'],
            'cashier' => Auth::user()->fname . " " . Auth::user()->lname,
            'rate' => $request['rate'],
            'trans_id' => $trans_id,
            'discount' => $request->discount,
            'status' => "UNPAID"
        ]);
    }


    public function listTransactions()
    {
        $allTransactions = Sale::orderBy('id', 'desc')->paginate(20);
        return view('list-transactions')->with('allTransactions', $allTransactions);
    }


    public function markAsPaid($id, $method)
    {
        #return $id;
        Sale::where('id', $id)->update(['is_paid' => 1, 'payment_method' => $method]);
        $saleInfo = Sale::where('id', $id)->first();

        //fetch gas level from 'settings' table
        $gasLevel = DB::table('settings')
            ->where('name', 'gas_level')
            ->first();

        //query above returns an object. Value of 'gas_level' is stored in $gasLevel->value
        $newGasLevel = $gasLevel->value - $saleInfo->quantity;
        Setting::where('name', 'gas_level')
            ->update(['value' => $newGasLevel]);
        $rateInfo = Setting::where('name', '=', 'rate')->first();


        return view('receipt', [
            'cost' => $saleInfo->cost,
            'coupon' => $saleInfo->coupon_code,
            'quantity' => $saleInfo->quantity,
            'cashier' => Auth::user()->name . " " . Auth::user()->lname,
            'rate' => $rateInfo->value,
            'trans_id' => $saleInfo->trans_id,
            'discount' => $saleInfo->discount,
            'status' => "PAID",
            'method' => $saleInfo->payment_method
        ]);
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
}
