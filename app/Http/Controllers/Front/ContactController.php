<?php

namespace App\Http\Controllers\Front;
use App\Http\Controllers\Controller;
use App\Models\Front\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    //
    public function contactpage()
    {
        return view('front.pages.contact');
    }
    public function postcontact(Request $request)
    {
        $request->validate([
            'name' => 'required|max:40',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required',
        ]);

        $Contact = new Contact();
        $Contact->name = $request['name'];
        $Contact->email = $request['email'];
        $Contact->subject = $request['subject'];
        $Contact->message = $request['message'];
        $Contact->save();

        if ($Contact) {
                return redirect()->route('front.contactpage')->with('message', 'Your message has been sent. Thank you!..');
        } else {
            return redirect()->back()->with('error', 'Somthing Went Wrong..');
        }
    }
}
