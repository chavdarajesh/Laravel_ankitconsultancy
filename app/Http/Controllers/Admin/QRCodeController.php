<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\QRCode;
use Illuminate\Support\Facades\Validator;

class QRCodeController extends Controller
{
    public function get_qr_code(Request $request)
    {
        $QRCodes = QRCode::all();
        return view('admin.emi_optins.qrcode.qr_code', ['QRCodes' => $QRCodes]);
    }

    public function qr_code_post(Request $request)
    {
        $request->validate([
            'adminupiid' => 'required|regex:/^\w.+@\w+$/',
            'adminqrcodeimage' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);
            $QRCode = new QRCode();
            $QRCode->upiid = $request['adminupiid'];
            $QRCode->status = 1;

            if ($request->adminqrcodeimage) {
                $folderPath = public_path('assets/admin/img/qrcodes/');
                if (!file_exists($folderPath)) {
                    mkdir($folderPath, 0777, true);
                }
                $file = $request->file('adminqrcodeimage');
                $imageoriginalname = str_replace(" ", "-", $file->getClientOriginalName());
                $imageName = time() . $imageoriginalname;
                $file->move($folderPath, $imageName);
                $QRCode->qrcodeimage = 'assets/admin/img/qrcodes/' . $imageName;
            }
            $QRCode = $QRCode->save();
            if ($QRCode) {
                return redirect()->route('admin.get.qr_code')->with('message', 'QRCode ADD  Sucssesfully..');
            } else {
                return redirect()->back()->with('error', 'Somthing Went Wrong..');
            }
    }
    public function qr_code_delete(Request $request, $id)
    {
        if ($id) {
            $QRCode = QRCode::find($id);
            $QRCode = $QRCode->delete();
            if ($QRCode) {
                return redirect()->route('admin.get.qr_code')->with('message', 'QRCode Delete  Sucssesfully..');
            } else {
                return redirect()->back()->with('error', 'Somthing Went Wrong..!');
            }
        } else {
            return redirect()->back()->with('error', 'QRCode Not Found..!');
        }
    }
    public function qr_code_edit(Request $request, $id)
    {
        $QRCode = QRCode::find($id);
        if ($QRCode) {
            return view('admin.emi_optins.qrcode.qr_code_edit', ['QRCode' => $QRCode]);
        } else {
            return redirect()->back()->with('error', 'QRCode Not Found..!');
        }
    }
    public function qr_code_update(Request $request)
    {
        $request->validate([
            'adminupiid' => 'required|regex:/^\w.+@\w+$/',
        ]);
            $QRCode = QRCode::find($request->id);
            $QRCode->upiid = $request['adminupiid'];
            $QRCode->status = 1;

            if ($request->adminqrcodeimage) {
                $folderPath = public_path('assets/admin/img/qrcodes/');
                if (!file_exists($folderPath)) {
                    mkdir($folderPath, 0777, true);
                }
                $file = $request->file('adminqrcodeimage');
                $imageoriginalname = str_replace(" ", "-", $file->getClientOriginalName());
                $imageName = time() . $imageoriginalname;
                $file->move($folderPath, $imageName);
                $QRCode->qrcodeimage = 'assets/admin/img/qrcodes/' . $imageName;
            }
            $QRCode = $QRCode->save();
            if ($QRCode) {
                return redirect()->route('admin.get.qr_code')->with('message', 'QRCode Update  Sucssesfully..');
            } else {
                return redirect()->back()->with('error', 'Somthing Went Wrong..');
            }
    }
    public function qr_code_status_update(Request $request)
    {
        if ($request->id) {
            $QRCode = QRCode::find($request->id);
            $QRCode->status = $request->status;
            $QRCode = $QRCode->update();
            if ($QRCode) {
                return response()->json(['success' => 'Status change successfully.']);
            } else {
                return response()->json(['error' => 'Somthing Went Wrong..!']);
            }
        } else {
            return response()->json(['error' => 'QR Code Not Found..!']);
        }
    }
}
