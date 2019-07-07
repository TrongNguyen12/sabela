<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Custommer;
use File;

class CustomerController extends Controller
{
    public function getList()
    {
        $customers = Custommer::where('type','cm-customer')
            ->orderBy('id','desc')
            ->get();
        return view('backend.customer.list',compact('customers'));
    }
    public function getAdd()
    {
        return view('backend.customer.add');
    }
    public function postAdd(Request $request)
    {
        $this->validate($request,
            [
                'name' => 'required',
                'fImage' => 'required',
                'content_main' => 'required',
                'job' => 'required',
            ],
            [
                'name.required' => 'Bạn chưa nhập tiêu đề !',
                'fImage.required' => 'Bạn chưa hình ảnh !',
                'content_main.required' => 'Bạn chưa nhập nội dung !',
                'job.required' => 'Bạn chưa nhập nghê nghiệp !',
            ]
        );
 		$type = 'cm-customer'; 
        $customer = new Custommer;
        $customer->name = $request->name;
        $customer->job = $request->job;
        $customer->content = $request->content_main;
        $customer->type = $type;
        $customer->status = $request->status;
        $path = 'uploads/custommer';
        $fImage = $request->file('fImage');
        if(!empty($fImage)){
            $file_name = time() . '_' . $fImage->getClientOriginalName();
            $fImage->move($path, $file_name);
            $customer->image = $file_name;
        }
        $customer->save();
        return redirect()->route('backend.config.customer')->with([
            'flash_level' => 'success',
            'flash_message' => 'Thêm thành công !'
        ]);

    }
    public function getEdit($id)
    {
        $data = Custommer::find($id);
        if(isset($data)){
            return view('backend.customer.edit',compact('data'));
        }
        return redirect()->route('backend.config.customer')->with([
            'flash_level' => 'success',
            'flash_message' => 'Không tìm thấy dịch vụ !'
        ]);


    }
    public function postEdit(Request $request, $id)
    {
        $this->validate($request,
            [
                'name' => 'required',
                'content_main' => 'required',
                'job' => 'required',
            ],
            [
                'name.required' => 'Bạn chưa nhập tiêu đề !',
                'content_main.required' => 'Bạn chưa nhập nội dung !',
                'job.required' => 'Bạn chưa nhập nghê nghiệp !',
            ]
        );
        $type = 'cm-customer'; 
        $customer = Custommer::find($id);
        $image = $customer->image;
       	$customer->name = $request->name;
        $customer->job = $request->job;
        $customer->content = $request->content_main;
        $customer->type = $type;
        $customer->status = $request->status;
        $path = 'uploads/custommer/';
        $fImage = $request->file('fImage');
        if(!empty($fImage)){
            $file_name = time() . '_' . $fImage->getClientOriginalName();
            $fImage->move($path, $file_name);
            $customer->image = $file_name;
            if(File::exists($path.$image)){
                File::delete($path.$image);   
            }
        }
        $customer->save();
        return redirect()->route('backend.config.customer')->with([
            'flash_level' => 'success',
            'flash_message' => 'Sửa thành công !'
        ]);


    }
    public function getDelete($id)
    {
        $customer = Custommer::find($id);
        if(isset($customer)){
           	$image = $customer->image;
			$image_path = 'uploads/custommer/';
            if (isset($customer)) {
                if(File::exists($image_path.$image)){
                    File::delete($image_path.$image);
                }
                $customer::destroy($id);
            }
            return redirect()->route('backend.config.customer')->with([
                'flash_level' => 'success',
                'flash_message' => 'Đã xóa dịch vụ !'
            ]);
        }


        return redirect()->route('backend.config.customer')->with([
            'flash_level' => 'danger',
            'flash_message' => 'Không tìm thấy dịch vụ !'
        ]);

    }

    public function postMultiDel(Request $request)
    {
        if ($request->has('chkItem')) {
            foreach ($request->chkItem as $id) {
                $customer = Custommer::find($id);
                if(isset($customer)){
                    $image = $customer->image;
	                $image_path = 'uploads/custommer/';
	                if (isset($customer)) {
	                    if(File::exists($image_path.$image)){
	                        File::delete($image_path.$image);
	                    }
	                    $customer::destroy($id);
	                }
                }
            }
            return redirect()->back()->with([
                'flash_level' => 'success',
                'flash_message' => 'Xóa thành công !'
            ]);
        } else {
            return redirect()->back()->with([
                'flash_level' => 'danger',
                'flash_message' => 'Bạn chưa chọn dữ liệu cần xóa !'
            ]);
        }
    }
}
