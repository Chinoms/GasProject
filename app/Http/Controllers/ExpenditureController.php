<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PettyCash;
use Illuminate\Support\Facades\DB;
use App\Models\Setting;
use App\Models\PettyCashIn;
use Illuminate\Support\Facades\Auth;

class ExpenditureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $data['pettyCash'] = PettyCashIn::paginate(20);
        return view('petty-cash-history')->with($data);
    }

    public function expenditureHistory(){
        
        $data['pettyCash'] = PettyCash::paginate(20);
        return view('expenditure-history')->with($data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
        return view('new-expenditure');
    }


    public function newPettyCash(){
        
        return view('new-petty-cash');
    }

    public function savePettyCash(Request $request){
        $request->validate([
            'amount' => 'required | numeric',
            'description' => 'required',
        ]);

        $pettyCash = new PettyCashIn();
        $pettyCash->amount = $request->amount;
        $pettyCash->description = $request->description;

        $oldPettyCash = Setting::where('name', '=', 'petty_cash')->value('value');
        $newPettyCash = $oldPettyCash + $request->amount;
        
        Setting::where('name', 'petty_cash')->update(['value' => $newPettyCash]);

        $pettyCash->save();
        return back()->with('message', 'Transaction recorded successfully.');


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
            'amount' => 'required | numeric',
            'description' => 'required'
        ]);

        $expenditure = new PettyCash;

        $expenditure->amount =  $request->amount;
        $expenditure->description = $request->description;

        $pettyCashBalance = DB::table('settings')->where('name', 'petty_cash')->value('value');
        $newBalance = $pettyCashBalance - $request->amount;
        //return $newBalance;
        // Setting::update(['value' => $newBalance])
        // ->where('name', 'petty_cash');
        Setting::where('name', 'petty_cash')->update(['value' => $newBalance]);
        $expenditure->save();
        return back()->with('message', 'Transaction recorded succesfully');
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
