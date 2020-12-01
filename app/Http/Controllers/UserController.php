<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
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
        $ref_code = chr(rand(65, 90)) . chr(rand(65, 90)) . mt_rand(1111, 9999);
        $usersType = DB::table('staff_types')->get();
        return view('new-user')->with([
            'ref_code' => $ref_code,
            'usersType' => $usersType,
        ]);
    }

    public function savestaff(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:25',
            'lname' => 'required|string|max:25',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'staff_type' => 'required',
            'ref_code' => 'unique:users',
        ]);

        $staffInfo = new User();
        $staffInfo->name = $request->name;
        $staffInfo->lname = $request->lname;
        $staffInfo->email = $request->email;
        $staffInfo->password = Hash::make($request->password);
        $staffInfo->ref_code = $request->refcode;
        $staffInfo->basic_salary = $request->salary;
        $staffInfo->staff_type = $request->staff_type;
        $staffInfo->save();
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
