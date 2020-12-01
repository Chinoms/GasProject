<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\Sale;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

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
        $rate = $settings->value;
        //return $settings->value;
        return view('pos', ['rate' => $rate]);
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
            'phone' => 'max:11'
        ]);
        //return $request;
        $salesInfo = new Sale();
        $salesInfo->cost = $request['cost'];
        $salesInfo->quantity = $request['quantity'];
        if ($request['refcode'] == "" || $request['refcode'] == null) {
            $salesInfo->coupon_code = "NULL";
        } else {
            $salesInfo->coupon_code = $request['refcode'];
        }
        //$salesInfo->discount = $request['discount'];
        if ($request['comments'] == "" || $request['comments'] == null) {
            $salesInfo->comments = "NULL";
        } else {
            $salesInfo->comments = $request['comments'];
        }
        $salesInfo->cashier_id = Auth::user()->id;
        if($request['refcode'] == "" || $request['refcode'] == null){
            $couponCode = "NA";
        } else {
            $couponCode = $request['refcode'];
        }
        $salesInfo->save();

        //fetch gas level from 'settings' table
        $gasLevel = DB::table('settings')
        ->where('name', 'gas_level')
        ->first();
        //query above returns an object. Value of 'gas_level' is stored in $gasLevel->value
        $newGasLevel = $gasLevel->value - $request['cost'];
        Setting::where('name', 'gas_level')
        ->update(['value' => $newGasLevel]);
        //return $salesInfo->comments;
        return view('receipt', [
            'cost' => $request['cost'],
            'coupon' => $couponCode,
            'quantity' => $request['quantity']."kg",
            'cashier' => Auth::user()->fname. " ". Auth::user()->lname,
            'rate' => $request['rate']
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
