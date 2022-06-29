<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Front\Payment;
use Illuminate\Http\Request;
use App\Mail\Front\PasswordSend;
use Mail;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Mail\Admin\PaymentFailed;


class PaymentController extends Controller
{
    //
    public function get_first_payment()
    {
        $Payments = Payment::where('first_payment', 1)->get();
        return view('admin.payment.first_payment', ['Payments' => $Payments]);
    }

    public function first_payment_delete($id)
    {
        if ($id) {
            $Payment = Payment::find($id);
            $Payment = $Payment->delete();
            if ($Payment) {
                return redirect()->route('admin.get.first_payment')->with('message', 'Payment Delete  Sucssesfully..');
            } else {
                return redirect()->back()->with('error', 'Somthing Went Wrong..!');
            }
        } else {
            return redirect()->back()->with('error', 'Payment Not Found..!');
        }
    }

    public function first_payment_status_update(Request $request)
    {
        if ($request->id) {
            $Payment = Payment::find($request->id);
            $Payment->status = $request->status;
            $Payment = $Payment->update();
            if ($Payment) {
                return response()->json(['success' => 'Status change successfully.']);
            } else {
                return response()->json(['error' => 'Somthing Went Wrong..!']);
            }
        } else {
            return response()->json(['error' => 'Payment Not Found..!']);
        }
    }

    public function first_payment_is_verified_update(Request $request)
    {
        if ($request->id) {
            $Payment = Payment::find($request->id);
            $Payment->is_verified = $request->is_verified;
            $Payment->is_not_verified = 0;
            $Payment_save = $Payment->update();
            if ($Payment_save) {
                $user = User::find($Payment->user_id);
                if ($user) {
                    $length = 8;
                    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                    $charactersLength = strlen($characters);
                    $randomString = '';
                    for ($i = 0; $i < $length; $i++) {
                        $randomString .= $characters[rand(0, $charactersLength - 1)];
                    }
                    $data = [
                        'password' => $randomString,
                    ];
                    $user->password = Hash::make($randomString);
                    $user->is_verified = 1;
                    $user->update();
                    Mail::to($user->email)->send(new PasswordSend($data));
                    return response()->json(['success' => 'Verified Status change successfully.Password Send to User Email successfully ']);
                } else {
                    return response()->json(['success' => 'Verified Status change successfully. Mail Not SEnd']);
                }
            } else {
                return response()->json(['error' => 'Somthing Went Wrong..!']);
            }
        } else {
            return response()->json(['error' => 'Payment Not Found..!']);
        }
    }


    public function first_payment_is_not_verified_update(Request $request)
    {
        if ($request->id) {
            $Payment = Payment::find($request->id);
            $Payment->is_not_verified = $request->is_verified;
            $Payment_save = $Payment->update();
            if ($Payment_save) {
                $user = User::find($Payment->user_id);
                if ($user) {
                    $data = [
                        'username' => $user->name,
                        'payment_date' => $Payment->created_at,
                        'payment_amount' => $Payment->emi_amount,
                        'reference_id' => $Payment->id,
                    ];

                    Mail::to($user->email)->send(new PaymentFailed($data));
                    return response()->json(['success' => 'Payment Failed Email Sent To User Successfully..!']);
                } else {
                    return response()->json(['success' => 'Verified Status change successfully. Mail Not SEnd']);
                }
            } else {
                return response()->json(['error' => 'Somthing Went Wrong..!']);
            }
        } else {
            return response()->json(['error' => 'Payment Not Found..!']);
        }
    }
    public function get_all_payment()
    {
        $Payments = Payment::all();
        return view('admin.payment.all_payment', ['Payments' => $Payments]);
    }

    public function all_payment_delete($id)
    {
        if ($id) {
            $Payment = Payment::find($id);
            $Payment = $Payment->delete();
            if ($Payment) {
                return redirect()->route('admin.get.all_payment')->with('message', 'Payment Delete  Sucssesfully..');
            } else {
                return redirect()->back()->with('error', 'Somthing Went Wrong..!');
            }
        } else {
            return redirect()->back()->with('error', 'Payment Not Found..!');
        }
    }

    public function all_payment_status_update(Request $request)
    {
        if ($request->id) {
            $Payment = Payment::find($request->id);
            $Payment->status = $request->status;
            $Payment = $Payment->update();
            if ($Payment) {
                return response()->json(['success' => 'Status change successfully.']);
            } else {
                return response()->json(['error' => 'Somthing Went Wrong..!']);
            }
        } else {
            return response()->json(['error' => 'Payment Not Found..!']);
        }
    }

    public function all_payment_is_verified_update(Request $request)
    {
        if ($request->id) {
            $Payment = Payment::find($request->id);
            $Payment->is_verified = $request->is_verified;
            $Payment_save = $Payment->update();
            if ($Payment_save) {
                return response()->json(['success' => 'Verified Status change successfully.']);
            } else {
                return response()->json(['error' => 'Somthing Went Wrong..!']);
            }
        } else {
            return response()->json(['error' => 'Payment Not Found..!']);
        }
    }


    public function get_not_verified_payment()
    {
        $Payments = Payment::where('is_verified',0)->get();
        return view('admin.payment.not_verified', ['Payments' => $Payments]);
    }

    public function not_verified_payment_delete($id)
    {
        if ($id) {
            $Payment = Payment::find($id);
            $Payment = $Payment->delete();
            if ($Payment) {
                return redirect()->route('admin.get.not_verified_payment')->with('message', 'Payment Delete  Sucssesfully..');
            } else {
                return redirect()->back()->with('error', 'Somthing Went Wrong..!');
            }
        } else {
            return redirect()->back()->with('error', 'Payment Not Found..!');
        }
    }

    public function not_verified_payment_status_update(Request $request)
    {
        if ($request->id) {
            $Payment = Payment::find($request->id);
            $Payment->status = $request->status;
            $Payment = $Payment->update();
            if ($Payment) {
                return response()->json(['success' => 'Status change successfully.']);
            } else {
                return response()->json(['error' => 'Somthing Went Wrong..!']);
            }
        } else {
            return response()->json(['error' => 'Payment Not Found..!']);
        }
    }

    public function not_verified_payment_is_verified_update(Request $request)
    {
        if ($request->id) {
            $Payment = Payment::find($request->id);
            $Payment->is_verified = $request->is_verified;
            $Payment_save = $Payment->update();
            if ($Payment_save) {
                return response()->json(['success' => 'Verified Status change successfully.']);
            } else {
                return response()->json(['error' => 'Somthing Went Wrong..!']);
            }
        } else {
            return response()->json(['error' => 'Payment Not Found..!']);
        }
    }


    public function get_user_payment($id=null)
    {
        if($id){
            $Payments=Payment::where('user_id',$id)->get();
            return view('admin.payment.all_payment', ['Payments' => $Payments]);
        }
        else{
            return redirect()->back()->with('error', 'User Not Found..!');
        }
    }
}
