<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\Front\ForgotPassword;
use App\Mail\Front\OTPVerification;


class AuthController extends Controller
{
    //
    public function login()
    {
        if (!Auth::check()) {
            return view('front.auth.login');
        } else {
            return redirect()->route('front.homepage')->with('message', 'User Login Successfully');
        }
    }
    public function register()
    {
        if (!Auth::check()) {
            return view('front.auth.register');
        } else {
            return redirect()->route('front.homepage')->with('message', 'User Login Successfully');
        }
    }
    public function postregister(Request $request)
    {
        // $ValidatedData = Validator::make($request->all(), [
        $request->validate([
            'name' => 'required|max:40',
            'email' => 'required|unique:users',
            'phone' => 'required |unique:users',
            'username' => 'required |unique:users',
            'address' => 'required',
            'dateofbirth' => 'required',
            'accept_t_c' => 'required',
        ]);

        $user = new User();
        $user->name = $request['name'];
        $user->username = $request['username'];
        $user->email = $request['email'];
        $user->phone = $request['phone'];
        $user->address = $request['address'];
        $user->dateofbirth = $request['dateofbirth'];
        $random_pass = rand(100000, 999999);
        $user->password = Hash::make($random_pass);
        $user->otp = $random_pass;
        $user->save();

        if ($user) {
            $data = [
                'otp' => $random_pass
            ];
            $user_id=encrypt($user->id);
            Mail::to($request->email)->send(new OTPVerification($data));
            // return view('front.auth.otp_verification', ['email' => $request->email, 'user_id' => $user->id])->with('message', 'Please Enter OTP To Verify Your Account..');
            return redirect()->route('front.otp_verification.get',['id'=>$user_id])->with('message', 'Otp Send To Your Email. Please Enter OTP To Verify Your Account..');
        } else {
            return redirect()->back()->with('error', 'Somthing Went Wrong..');
        }
    }
    public function showotp_verificationFormget($id)
    {
        $id = decrypt($id);
        if($id){
            return view('front.auth.otp_verification', ['user_id' => $id])->with('message', 'Please Enter OTP To Verify Your Account..');
        }
        else{
            return redirect()->back()->with('error', 'Somthing Went Wrong..');
        }
    }
    public function postotp_verification(Request $request)
    {
        $ValidatedData = Validator::make($request->all(), [
            'user_id' => 'required',
            'otp' => 'required',
        ]);
        if ($ValidatedData->fails()) {
            return redirect()->back()->with('error', 'All Filed Require..!');
        } else {
            $user_email_check  = User::where([['email', '=', $request->email]])->first();
            if ($user_email_check) {

                $user  = User::where([['id', '=', $request->user_id], ['otp', '=', $request->otp], ['email', '=', $request->email]])->first();
                if ($user) {
                    User::where('id', '=', $request->user_id)->where('email', '=', $request->email)->update(['otp' => null]);
                    User::where('id', '=', $request->user_id)->where('email', '=', $request->email)->update(['email_verified_at' =>  Carbon::now()]);
                    if (Auth::attempt(['email' => $request->email, 'password' => $request->otp])) {
                        return redirect()->route('front.first_paymentpage')->with('message', 'Account Created Sucssesfully..');
                    } else {
                        return redirect()->back()->with('error', 'Somthing Went Wrong11..');
                    }
                } else {
                    return redirect()->back()->with('error', 'User Not Found..');
                }
            } else {
                return redirect()->back()->with('error', 'User Not Found...!');
            }
        }
    }

    public function postlogin(Request $request)
    {
        $ValidatedData = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
            'accept_t_c' => 'required',
        ]);
        if ($ValidatedData->fails()) {
            return redirect()->back()->with('error', 'All Filed Require..!');
        } else {
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'is_verified' => 1, 'status' => 1])) {
                if (Auth::user()->email_verified_at != null && Auth::user()->otp == null) {
                    return redirect()->route('front.homepage')->with('message', 'User Login Successfully');
                } else {
                    Auth::logout();
                    $request->session()->flush();
                    return redirect()->back()->with('error', 'User Not Verified...');
                }
            } else {
                return redirect()->back()->with('error', 'Invalid Credantials');
            }
        }
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->flush();
        return redirect()->route('front.homepage')->with('message', 'User Logout Successfully');;
    }


    public function forgotpasswordget()
    {
        return view('front.auth.forget_password');
    }

    public function postforgotpassword(Request $request)
    {
        $ValidatedData = Validator::make($request->all(), [
            'email' => 'required|email|exists:users'
        ]);
        if ($ValidatedData->fails()) {
            return redirect()->back()->with('error', $ValidatedData->errors());
        } else {
            $user = User::where('email', $request->email)->where('status', 1)->where('is_verified', 1)->first();
            if ($user) {

                $token = Str::random(64);
                DB::table('password_resets')->insert([
                    'email' => $request->email,
                    'token' => $token,
                    'created_at' => Carbon::now(),
                ]);
                $data = [
                    'token' => $token
                ];
                Mail::to($request->email)->send(new ForgotPassword($data));
                return redirect()->route('front.login')->with('message', 'Mail send  Successfully Please Chacek MAil..');
            } else {
                return redirect()->back()->with('error', 'User Not Found..!');
            }
        }
    }

    public function showResetPasswordFormget($token)
    {
        return view('front.auth.showresetpasswordform', ['token' => $token]);
    }

    public function submitResetPasswordFormpost(Request $request)
    {
        $ValidatedData = Validator::make($request->all(), [
            'newpassword' => 'min:6',
            'confirmnewpasswod' => 'required_with:newpassword|same:newpassword|min:6'
        ]);
        if ($ValidatedData->fails()) {
            return redirect()->back()->with('error', $ValidatedData->errors());
        } else {
            $updatePassword = DB::table('password_resets')->where('token', $request->token)->first();
            if (!$updatePassword) {
                return back()->withInput()->with('error', 'Invalid token!');
            }
            $user = User::where('email', $updatePassword->email)
                ->update(['password' => Hash::make($request->newpassword)]);
            DB::table('password_resets')->where(['email' => $updatePassword->email])->delete();
            if ($user) {
                return redirect()->route('front.login')->with('message', 'Your password has been changed!');
            } else {
                return redirect()->route('front.login')->with('error', 'Somthing Went Wrong..!');
            }
        }
    }
}
