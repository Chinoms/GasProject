<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GasPurchase;
use Illuminate\Support\Facades\DB;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //display purchase history
        $purchaseHistory = DB::table('gas_purchases')
        ->orderBy('id', 'DESC')
        ->paginate(10);
        return view('purchase-history', compact('purchaseHistory'));
    }

    /**
     * Display the form for recording gas purchase
     * 
     */
    public function gasPurchaseForm()
    {
        return view('record-purchase');
    }



    /**
     * Save the gas purchase to the database
     */

    public function recordGasPurchase(Request $request)
    {
        //return "jkkm";
        $request->validate([
            'cost' => 'required|numeric|min:0',
            'quantity' => 'required|numeric|min:1'
        ]);
        //return $request;
        $purchaseInfo = new GasPurchase();
        $purchaseInfo->cost = $request->cost;
        $purchaseInfo->quantity = $request->quantity;
        $purchaseInfo->save();
        return redirect()->back()->with('message', 'Purchase recorded!');
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
}
