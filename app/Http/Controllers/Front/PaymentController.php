<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Admin\BankDetails;
use App\Models\Admin\EMIAmount;
use App\Models\Admin\QRCode;
use App\Models\Front\Payment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;


class PaymentController extends Controller
{
    //
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    public function first_paymentpage()
    {
        $EMIAmounts = EMIAmount::where('status', 1)->get();
        $BankDetails = BankDetails::where('status', 1)->where('static_id', 1)->first();
        $QRCodes = QRCode::where('status', 1)->get();
        return view('front.payment.first_payment', ['EMIAmounts' => $EMIAmounts, 'BankDetails' => $BankDetails, 'QRCodes' => $QRCodes]);
    }

    public function postfirst_payment(Request $request)
    {
        $ValidatedData = Validator::make($request->all(), [
            'emi_amount' => 'required',
            'emi_amount_id' => 'required',
            'user_id' => 'required',
            'payment_screenshot' => 'required',
        ]);
        if ($ValidatedData->fails()) {
            return redirect()->back()->with('error', 'All Fileds are Required..');
        } else {
            $Payment = new Payment();
            $Payment->emi_amount = $request['emi_amount'];
            $Payment->emi_amount_id = $request['emi_amount_id'];
            $Payment->user_id = $request['user_id'];
            $Payment->first_payment = 1;
            if ($request->payment_screenshot) {
                $folderPath = public_path('assets/front/first_payment/' . $request['user_id'] . '/');
                if (!file_exists($folderPath)) {
                    mkdir($folderPath, 0777, true);
                }
                $file = $request->file('payment_screenshot');
                $imageoriginalname = str_replace(" ", "-", $file->getClientOriginalName());
                $imageName = time() . $imageoriginalname;
                $file->move($folderPath, $imageName);
                $Payment->payment_screenshot = 'assets/front/first_payment/' . $request['user_id'] . '/' . $imageName;
            }
            $Payment = $Payment->save();
            if ($Payment) {
                Auth::logout();
                $request->session()->flush();
                return redirect()->route('front.homepage')->with('message', 'After Verfiy Your Pyament Screenshot Paasword will send to your email address.');
            } else {
                return redirect()->back()->with('error', 'Somthing Went Wrong..');
            }
        }
    }

    public function next_paymentpage()
    {
        $user_id=Auth::user()->id;
        $qrcode=Auth::user()->qrcode;
        $EMIAmount = Payment::where('status', 1)->where('is_verified',1)->where('first_payment',1)->where('user_id',$user_id)->first();
        $BankDetails = BankDetails::where('status', 1)->where('static_id', 1)->first();
        $QRCode = QRCode::where('status', 1)->where('id',$qrcode)->first();
        $QRCodes= QRCode::where('status','1')->get();
        if($EMIAmount){
            return view('front.payment.next_payment', ['EMIAmount' => $EMIAmount, 'BankDetails' => $BankDetails, 'QRCodes' => $QRCodes,'QRCode'=>$QRCode]);
        }
        else{
            return redirect()->back()->with('error','Your First Payment is Not Done Yet..!');
        }
    }

    public function postnext_paymentpage(Request $request)
    {
        $ValidatedData = Validator::make($request->all(), [
            'emi_amount' => 'required',
            'emi_amount_id' => 'required',
            'user_id' => 'required',
            'payment_screenshot' => 'required',
        ]);
        if ($ValidatedData->fails()) {
            return redirect()->back()->with('error', 'All Fileds are Required..');
        } else {
            $Payment = new Payment();
            $Payment->emi_amount = $request['emi_amount'];
            $Payment->emi_amount_id = $request['emi_amount_id'];
            $Payment->user_id = $request['user_id'];
            $Payment->first_payment = 0;
            if ($request->payment_screenshot) {
                $folderPath = public_path('assets/front/next_payment/' . $request['user_id'] . '/');
                if (!file_exists($folderPath)) {
                    mkdir($folderPath, 0777, true);
                }
                $file = $request->file('payment_screenshot');
                $imageoriginalname = str_replace(" ", "-", $file->getClientOriginalName());
                $imageName = time() . $imageoriginalname;
                $file->move($folderPath, $imageName);
                $Payment->payment_screenshot = 'assets/front/next_payment/' . $request['user_id'] . '/' . $imageName;
            }
            $Payment = $Payment->save();
            if ($Payment) {
                return redirect()->route('front.homepage')->with('message', 'Payment Sucsses Fully Done');
            } else {
                return redirect()->back()->with('error', 'Somthing Went Wrong..');
            }
        }
    }

    public function all_emipage()
    {
        $user_id=Auth::user()->id;
        $Payments=Payment::where('status',1)->where('is_verified',1)->where('user_id',$user_id)->get();
        if($Payments){
            return view('front.payment.all_emi',['Payments'=>$Payments]);
        }
        else{
            return redirect()->route('front.homepage')->with('error','You Not Done Payment Yet..!');
        }
    }
}
