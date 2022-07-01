<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Front\Contact;
use Illuminate\Http\Request;
use App\Models\Admin\ContactSetting;

class ContactController extends Controller
{
    //
    public function get_contact_msg()
    {
        $Contacts=Contact::all();
        return view('admin.contact.contact_msg',['Contacts'=>$Contacts]);
    }

    public function contact_msg_delete($id)
    {
        if ($id) {
            $Contact = Contact::find($id);
            $Contact = $Contact->delete();
            if ($Contact) {
                return redirect()->route('admin.get.contact_msg')->with('message', 'Contact Delete  Sucssesfully..');
            } else {
                return redirect()->back()->with('error', 'Somthing Went Wrong..!');
            }
        } else {
            return redirect()->back()->with('error', 'Contact Not Found..!');
        }
    }

    public function contcat_msg_view($id)
    {
        $Contact = Contact::find($id);
        if ($Contact) {
            return view('admin.contact.contcat_view', ['Contact' => $Contact]);
        } else {
            return redirect()->back()->with('error', 'Concat Not Found..!');
        }
    }

    public function get_contact_settings()
    {
        $ContactSetting = ContactSetting::where('static_id', 1)->where('status', 1)->first();
        return view('admin.contact.contact_setting',['ContactSetting'=>$ContactSetting]);
    }
    public function post_contact_settings(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'phone' => 'required',
            'location' => 'required',
            // 'map_iframe' => 'required',
        ]);

        $ContactSetting = ContactSetting::find($request->id);
        $ContactSetting->email = $request['email'];
        $ContactSetting->phone = $request['phone'];
        $ContactSetting->location = $request['location'];
        $ContactSetting->map_iframe = $request['map_iframe'];
        $ContactSetting->update();
        if ($ContactSetting) {
            return redirect()->route('admin.get.contact_settings')->with('message', 'ContactSetting Saved Sucssesfully..');
        } else {
            return redirect()->back()->with('error', 'Somthing Went Wrong..');
        }
    }

    public function get_home_settings()
    {
        $ContactSetting = ContactSetting::where('static_id', 1)->where('status', 1)->first();
        return view('admin.contact.home_setting',['ContactSetting'=>$ContactSetting]);
    }

    public function post_home_settings(Request $request)
    {
        $request->validate([
            'home_page_video'=>'required',
        ]);
        $ContactSetting = ContactSetting::find($request->id);
        if ($request->home_page_video) {
            $folderPath = public_path('assets/front/videos/homepage/');
            if (!file_exists($folderPath)) {
                mkdir($folderPath, 0777, true);
            }
            $file = $request->file('home_page_video');
            $imageoriginalname = str_replace(" ", "-", $file->getClientOriginalName());
            $imageName = time() . $imageoriginalname;
            $file->move($folderPath, $imageName);
            $ContactSetting->home_page_video = 'assets/front/videos/homepage/' . $imageName;
        }
        // $ContactSetting->home_page_video = $request['home_page_video'];
        $ContactSetting->update();
        if ($ContactSetting) {
            return redirect()->route('admin.get.home_settings')->with('message', 'Home Setting Saved Sucssesfully..');
        } else {
            return redirect()->back()->with('error', 'Somthing Went Wrong..');
        }
    }
}
