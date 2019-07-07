<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Bank; 
use Illuminate\Support\Facades\Storage;
use File;

class BankController extends Controller
{
    public function getList()
    {
        $banks = Bank::orderBy('id', 'desc')->get();
        return view('backend.bank.list', compact('banks'));
    }
    public function getAdd()
    {
        return view('backend.bank.add');
    }
    public function postAdd(Request $request)
    {
        $this->validate($request,
            [
                'name' => 'required',
                'account_name' => 'required',
                'account_number' => 'required|numeric',
                'account_branch' => 'required',
            ],
            [
                'name.required' => 'Bạn chưa nhập tên ngân hàng !',
                'account_name.required' => 'Bạn chưa nhập tên chủ khoản !',
                'account_number.required' => 'Bạn chưa nhập số tài khoản !',
                'account_number.numeric' => 'Số tài khoản phải là dãy số !',
                'account_branch.required' => 'Bạn chưa nhập chi nhánh !',

            ]
        );
        $bank = new Bank;
        $bank->name = $request->name;
        $bank->account_name = $request->account_name;
        $bank->account_number = $request->account_number;
        $bank->account_branch = $request->account_branch;
        $bank->status = $request->status;
        $path = 'uploads/bank';
        $fImage = $request->file('fImage');
        if(!empty($fImage)){
            $file_name = time() . '_' . $fImage->getClientOriginalName();
            $fImage->move($path, $file_name);
            $bank->image = $file_name;
        }
        $bank->save();
        return redirect()->route('backend.config.bank')->with([
            'flash_level' => 'success',
            'flash_message' => 'Thêm thành công !'
        ]);
    }
    public function getEdit($id)
    {
        $data = Bank::find($id);
        if (isset($data)) {
            return view('backend.bank.edit', compact('data'));
        }
        return redirect()->route('backend.config.bank')->with([
            'flash_level' => 'danger',
            'flash_message' => 'Không tìm thấy bài viết !'
        ]);
    }

    public function postEdit(Request $request, $id)
    {
        $this->validate($request,
            [
                'name' => 'required',
                'account_name' => 'required',
                'account_number' => 'required|numeric',
                'account_branch' => 'required',
            ],
            [
                'name.required' => 'Bạn chưa nhập tên ngân hàng !',
                'account_name.required' => 'Bạn chưa nhập tên chủ khoản !',
                'account_number.required' => 'Bạn chưa nhập số tài khoản !',
                'account_number.numeric' => 'Số tài khoản phải là dãy số !',
                'account_branch.required' => 'Bạn chưa nhập chi nhánh !',

            ]
        );
        //$bank = Bank::bannk_save($request, $id);
        $bank = Bank::find($id);
        $image = $bank->image;
        $bank->name = $request->name;
        $bank->account_name = $request->account_name;
        $bank->account_number = $request->account_number;
        $bank->account_branch = $request->account_branch;
        $bank->status = $request->status;
        $path = 'uploads/bank/';
        $fImage = $request->file('fImage');
        if(!empty($fImage)){
            $file_name = time() . '_' . $fImage->getClientOriginalName();
            $fImage->move($path, $file_name);
            $bank->image = $file_name;
            if(File::exists($path.$image)){
                File::delete($path.$image);   
            }
        }
        $bank->save();
        return redirect()->route('backend.config.bank')->with([
            'flash_level' => 'success',
            'flash_message' => 'Sửa thành công !'
        ]);
    }

    public function getDelete($id)
    {
        $bank = Bank::find($id);
        if (isset($bank)) {
            $image = $bank->image;
            $image_path = 'uploads/bank/';
            if(File::exists($image_path.$image)){
                File::delete($image_path.$image);
            }
            $bank::destroy($id);
            return redirect()->route('backend.config.bank')->with([
                'flash_level' => 'success',
                'flash_message' => 'Xóa thành công !'
            ]);
        }
        return redirect()->route('backend.config.bank')->with([
            'flash_level' => 'danger',
            'flash_message' => 'Không tìm thấy bài viết'
        ]);
    }
    public function postMultiDel(Request $request)
    {
        if ($request->has('chkItem')) {
            foreach ($request->chkItem as $id) {

                $bank = Bank::find($id);
                $image = $bank->image;
                $image_path = 'uploads/bank/';
                if (isset($bank)) {
                    if(File::exists($image_path.$image)){
                        File::delete($image_path.$image);
                    }
                    $bank::destroy($id);
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
}
