<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Front\Contact;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\AssignOp\Concat;

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
}
