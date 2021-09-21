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
        $users = User::all();
        return view('list-users');
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
        $staffInfo->ref_code = $request->ref_code;
        $staffInfo->basic_salary = $request->salary;
        $staffInfo->staff_type = $request->staff_type;

        //dd($staffInfo);
        $staffInfo->save();
        return back()->with('message', 'Staff registered successfully!');
    }


    public function fetchIncentive(Request $request)
    {
        $startDate = $request->start;
        $endDate = $request->end;
        $user_id = $request->user_id;

        $data['users'] = DB::table('users')->get();
        $data['all_sales'] = DB::table('sales')
            ->join('users', 'users.ref_code', '=', 'sales.coupon_code')
            ->where('users.id', '=', $user_id)
            ->whereBetween('sales.created_at', [$startDate, $endDate])
            ->paginate(3);
        // dd($data);
        return view('view-incentive')->with($data);
        // dd($users);
        return view('view-incentive')->with($data);
    }

    public function viewIncentives(Request $request)
    {
        $startDate = $request->start;
        $endDate = $request->end;
        $user_id = $request->user_id;
        $data['user_id'] = $user_id;
        $data['staff_type'] = DB::table('users')->where('id', $data['user_id'])->value('staff_type');
        $data['users'] = DB::table('users')->get();

        $data['total_sales'] = DB::table('sales')
            ->join('users', 'users.ref_code', '=', 'sales.coupon_code')
            ->where('users.id', '=', $user_id)
            ->whereBetween('sales.created_at', [$startDate, $endDate])
            ->select(DB::raw('SUM(cost) as total_cost'))
            ->first();

        $data['all_sales'] = DB::table('sales')
            ->join('users', 'users.ref_code', '=', 'sales.coupon_code')
            ->where('users.id', '=', $user_id)
            ->whereBetween('sales.created_at', [$startDate, $endDate])
            ->get();

        if ($data['staff_type'] == 1) {
            $per = DB::table('settings')->where('name', 'sales_percentage_one')->value('value');
            $data['percentage'] = ($per / 100) * $data['total_sales']->total_cost;
        } elseif ($data['staff_type'] == 2) {
            $per = DB::table('settings')->where('name', 'sales_percentage_two')->value('value');
            $data['percentage'] = ($per / 100) * $data['total_sales']->total_cost;
        } elseif ($data['staff_type'] == 3) {
            $per = DB::table('settings')->where('name', 'sales_percentage_three')->value('value');
            $data['percentage'] = ($per / 100) * $data['total_sales']->total_cost;
        } else {
            $per = DB::table('settings')->where('name', 'sales_percentage_four')->value('value');
            $data['percentage'] = ($per / 100) * $data['total_sales']->total_cost;
        }

        $data['from'] = $request->start;
        $data['to'] = $request->end;
        //$data['incentive'] = DB::table('settings')
        //dd($data);
        return view('view-incentive')->with($data);
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
