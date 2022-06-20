<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\BankDetails;
use Illuminate\Http\Request;

class BankDetailsContaroller extends Controller
{
    //
    public function get_bankdetails(Request $request)
    {
        $BankDetails = BankDetails::where('static_id', 1)->where('status', 1)->first();
        return view('admin.emi_optins.bankdetails.bankdetails', ['BankDetails' => $BankDetails]);
    }
    public function post_bankdetails(Request $request)
    {
        $request->validate([
            'bank_name' => 'required',
            'branch_name' => 'required',
            'branch_code' => 'required',
            'ifsc_code' => 'required',
            'bank_aaccount_no' => 'required',
            'bank_aaccount_holder_name' => 'required',
        ]);

        $BankDetails = BankDetails::find($request->id);
        $BankDetails->bank_name = $request['bank_name'];
        $BankDetails->branch_name = $request['branch_name'];
        $BankDetails->branch_code = $request['branch_code'];
        $BankDetails->ifsc_code = $request['ifsc_code'];
        $BankDetails->bank_aaccount_no = $request['bank_aaccount_no'];
        $BankDetails->bank_aaccount_holder_name = $request['bank_aaccount_holder_name'];
        $BankDetails->update();

        if ($BankDetails) {
            return redirect()->route('admin.get.bankdetails')->with('message', 'BankDetails Saved Sucssesfully..');
        } else {
            return redirect()->back()->with('error', 'Somthing Went Wrong..');
        }
    }
}
