<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SettingsController extends Controller
{
    //

    public function edit(Request $request)
    {
        $settings['rate'] = Setting::select('value')->where('name', '=', 'rate')->first();
        $settings['coupon_active'] = Setting::select('value')->where('name', '=', 'coupon_active')->first();
        $settings['sales_percentage_one'] = Setting::select('value')->where('name', '=', 'sales_percentage_one')->first(); //pump attendant
        $settings['sales_percentage_two'] = Setting::select('value')->where('name', '=', 'sales_percentage_two')->first();
        $settings['sales_percentage_three'] = Setting::select('value')->where('name', '=', 'sales_percentage_three')->first();
        $settings['sales_percentage_four'] = Setting::select('value')->where('name', '=', 'sales_percentage_four')->first();
        //dd($data);
        return view('settings')->with($settings);
    }


    public function update(Request $request)
    {
        DB::table('settings')->where('name', 'rate')->update(['value' => $request->rate]);
        DB::table('settings')->where('name', 'sales_percentage_one')->update(['value' => $request->sales_percentage_one]);
        DB::table('settings')->where('name', 'sales_percentage_two')->update(['value' => $request->sales_percentage_two]);
        DB::table('settings')->where('name', 'sales_percentage_three')->update(['value' => $request->sales_percentage_three]);
        DB::table('settings')->where('name', 'sales_percentage_four')->update(['value' => $request->sales_percentage_four]);

        return back()->with('message', 'Settings successfully updated!');
    }
}
