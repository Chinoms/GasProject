<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function store(Request $request){
        $request->validate([
            'name' => 'required|max:50',
            'phone' => 'required|numeric|unique:customers,phone_number'
        ]);

        $customers = new Customer;
        $customers->phone_number = $request->phone;
        $customers->name = $request->name;
        $customers->save();
        return back()->with('message', 'Customer created');
    }
}
