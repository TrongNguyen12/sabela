<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Contact;
use Excel;

class ContactController extends Controller
{
    public function getList()
    {
        $data = Contact::orderBy('id', 'DESC')->get();
        return view('backend.contact.list', compact('data'));
    }
    public function getAdd()
    {
        return view('backend.contact.add');
    }

    public function getEdit($id)
    {
        $data = Contact::where('id', $id)->first();
        if (isset($data)) {
            return view('backend.contact.edit', compact('data'));
        }
        return redirect()->route('backend.contact')->with([
            'flash_level' => 'danger',
            'flash_message' => 'Không tìm thấy liên hệ !'
        ]);


    }

    public function postEdit(Request $request, $id)
    {
        $contact = Contact::where('id', $id)->first();
        if (isset($contact)) {
            $contact->status = 1;
            $contact->save();
            return redirect('backend/contact')->with([
                'flash_level' => 'success',
                'flash_message' => 'Cập nhật thành công !'
            ]);
        }

        return redirect()->route('backend.contact')->with([
            'flash_level' => 'danger',
            'flash_message' => 'Không tìm thấy liên hệ !'
        ]);


    }

    public function getDelete($id)
    {
        $contact = Contact::where('id', $id)->first();
        if (isset($contact)) {

            $contact->delete();

            return redirect()->route('backend.contact')->with([
                'flash_level' => 'success',
                'flash_message' => 'Đã xóa liên hệ !'
            ]);
        }
        return redirect()->route('backend.contact')->with([
            'flash_level' => 'danger',
            'flash_message' => 'Không tìm thấy liên hệ !'
        ]);

    }

    public function postMultiDel(Request $request)
    {
        if (!empty($request->chkItem)) {
            foreach ($request->chkItem as $id) {
                $contact = Contact::where('id', $id)->first();
                if (isset($contact)) {
                    $contact->delete();
                }
            }
            return redirect()->back()->with([
                'flash_level' => 'success',
                'flash_message' => 'Xóa thành công !'
            ]);
        }
        return redirect()->back()->with([
            'flash_level' => 'danger',
            'flash_message' => 'Bạn chưa chọn dữ liệu cần xóa !'
        ]);
    }
    public function getExport()
    {
        $data = Contact::orderBy('id', 'DESC')->get();
        Excel::create('ContactListExport', function($excel) use($data){            
            $excel->sheet('ContactList', function($sheet) use($data) {
                $sheet->loadView('backend.export.contact', ['key' => $data ]);
                $sheet->setStyle(array(
                    'font' => array(
                        'name'      =>  'Time new roman',
                        'size'      =>  12,
                    )
                ));
            });
        })->export('xlsx');
    }
}
