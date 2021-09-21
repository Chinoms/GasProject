<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DateTime;
use Carbon\Carbon;
use App\Models\Setting;


class SalesController extends Controller
{
    //

    public function dashboard(){
        $today = date("Y-m-d")." 00:00:00";
        $evening = date("Y-m-d")." 23:59:00";
        $data['salesToday'] = DB::table('sales')->whereBetween('created_at', [$today, $evening])->where('is_paid', '=', 1)->get();
        $data['totalToday'] = DB::table('sales')->whereBetween('created_at', [$today, $evening])->where('is_paid', '=', 1)->sum('cost');

        $data['all_sales'] = DB::table('sales')->orderBy('id', 'desc')->paginate(20);

        // $thirtyDaysAgo = date("Y-m-d")." 00:00:00";
        // $oldDate = DateTime::createFromFormat('Y-m-d', $thirtyDaysAgo);
        // $newDate = $oldDate->modify('-30 day');


        $todaysDate = Carbon::now();
        $thirtyDaysAgo = $todaysDate->subDays(30);
        //return $thirtyDaysAgo;
        //return $newDate;
        $data['totalThisMonth'] = DB::table('sales')->whereBetween('created_at', [$thirtyDaysAgo, $today])->sum('cost');
        //return $data['totalThisMonth'];


        $data['allTimeSales'] = DB::table('sales')->sum('cost');

        $data['totalStaff'] = DB::table('users')->count();

        $data['gas_level'] = Setting::where('name', 'gas_level')->value('value');

        $data['pettyCashBalance'] = DB::table('settings')->where('name', '=', 'petty_cash')->value('value');
        //return $data['totalStaff'];
        return view('admin.index')->with($data);
    }
}
