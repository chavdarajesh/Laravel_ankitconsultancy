<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\EMIAmount;
use App\Models\Admin\QRCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EMIController extends Controller
{
    //
    public function get_emi_option(Request $request)
    {
        $EMIAmounts = EMIAmount::all();
        return view('admin.emi_optins.emi_amount.emi_amount', ['EMIAmounts' => $EMIAmounts]);
    }
    public function get_emi_amount(Request $request)
    {
        $EMIAmounts = EMIAmount::all();
        return view('admin.emi_optins.emi_amount.emi_amount', ['EMIAmounts' => $EMIAmounts]);
    }
    public function emi_amount_post(Request $request)
    {
        $request->validate([
            'emi_amount' => 'required',
        ]);

            $EMIAmount = new EMIAmount();
            $EMIAmount->emi_amount = $request['emi_amount'];
            $EMIAmount->status = 1;

            $EMIAmount = $EMIAmount->save();
            if ($EMIAmount) {
                return redirect()->route('admin.get.emi_amount')->with('message', 'EMIAmount ADD  Sucssesfully..');
            } else {
                return redirect()->back()->with('error', 'Somthing Went Wrong..');
            }

    }
    public function emi_amount_delete(Request $request, $id)
    {
        if ($id) {
            $EMIAmount = EMIAmount::find($id);
            $EMIAmount = $EMIAmount->delete();
            if ($EMIAmount) {
                return redirect()->route('admin.get.emi_amount')->with('message', 'EMIAmount Delete  Sucssesfully..');
            } else {
                return redirect()->back()->with('error', 'Somthing Went Wrong..!');
            }
        } else {
            return redirect()->back()->with('error', 'QRCode Not Found..!');
        }
    }
    public function emi_amount_edit(Request $request, $id)
    {
        $EMIAmount = EMIAmount::find($id);
        if ($EMIAmount) {
            return view('admin.emi_optins.emi_amount.emi_amount_edit', ['EMIAmount' => $EMIAmount]);
        } else {
            return redirect()->back()->with('error', 'EMIAmount Not Found..!');
        }
    }
    public function emi_amount_update(Request $request)
    {
        $request->validate([
            'emi_amount' => 'required',
        ]);

            $EMIAmount = EMIAmount::find($request->id);
            $EMIAmount->emi_amount = $request['emi_amount'];
            $EMIAmount->status = 1;

            $EMIAmount = $EMIAmount->save();
            if ($EMIAmount) {
                return redirect()->route('admin.get.emi_amount')->with('message', 'EMIAmount Update  Sucssesfully..');
            } else {
                return redirect()->back()->with('error', 'Somthing Went Wrong..');
            }

    }
    public function emi_amount_status_update(Request $request)
    {
        if ($request->id) {
            $EMIAmount = EMIAmount::find($request->id);
            $EMIAmount->status = $request->status;
            $EMIAmount = $EMIAmount->update();
            if ($EMIAmount) {
                return response()->json(['success' => 'Status change successfully.']);
            } else {
                return response()->json(['error' => 'Somthing Went Wrong..!']);
            }
        } else {
            return response()->json(['error' => 'EMIAmount Not Found..!']);
        }
    }
}
