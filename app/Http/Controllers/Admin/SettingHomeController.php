<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SettingHome;
use App\Models\Category;
use File;

class SettingHomeController extends Controller
{
    public function getList()
    {
        $SettingHome = SettingHome::all();
        return view('backend.settinghome.list', compact('SettingHome'));
    }
    public function getAdd()
    {
    	$cate = Category::where('type', 'product_category')->get();

        return view('backend.settinghome.add', compact('cate'));
    }
    public function postAdd(Request $request)
    {
    	$this->validate($request,
            [
                'name' => 'required|max:100',
                'nameeg' => 'required|max:100',
            ],
            [
                'name.required' => 'Bạn chưa nhập tiêu đề !',
                'nameeg.required' => 'Bạn chưa nhập tiêu đề tiếng anh !',
                'nameeg.max' => 'Tiêu đề tiếng anh phải nhỏ hơn 100 ký tự !',
                'name.max' => 'Tiêu đề tiếng việt phải nhỏ hơn 100 ký tự !',
                
            ]
        );
        
    	$settingHome = new SettingHome;
    	$settingHome->name =  $request->name;
    	$settingHome->nameeg =  $request->nameeg;
    	$settingHome->type = $request->type;
    	if($request->type == 2){
    		$settingHome->link = $request->link;
    	}elseif ($request->type == 4) {
    		$settingHome->value = $request->cate;
    	}elseif ($request->type == 3) {
    		$settingHome->value = $request->sale;
    	}
    	$path = 'uploads/home/config';
    	$fImage = $request->file('fImage');
    	if(!empty($fImage)){
            $file_name = time() . '_' . $fImage->getClientOriginalName();
            $fImage->move($path, $file_name);
            $settingHome->image = $file_name;
        }
    	$settingHome->save();
        return redirect()->route('backend.homesetting')->with([
            'flash_level' => 'success',
            'flash_message' => 'Thêm thành công !'
        ]);
    }
    public function getEdit($id)
    {
        $data = SettingHome::find($id);
        $cate = Category::where('type', 'product_category')->get();
        if (isset($data)) {
            return view('backend.settinghome.edit', compact('data','cate'));
        }
        return redirect()->route('backend.homesetting')->with([
            'flash_level' => 'danger',
            'flash_message' => 'Không tìm thấy thông tin !'
        ]);
    }

    public function postEdit(Request $request, $id)
    {
        $this->validate($request,
            [
                'name' => 'required|max:100',
                'nameeg' => 'required|max:100',
            ],
            [
                'name.required' => 'Bạn chưa nhập tiêu đề !',
                'nameeg.required' => 'Bạn chưa nhập tiêu đề tiếng anh !',
                'nameeg.max' => 'Tiêu đề tiếng anh phải nhỏ hơn 100 ký tự !',
                'name.max' => 'Tiêu đề tiếng việt phải nhỏ hơn 100 ký tự !',
            ]
        );
        
        $settingHome = SettingHome::find($id);
        $settingHome->name =  $request->name;
        $settingHome->nameeg =  $request->nameeg;
        $settingHome->type = $request->type;
        if($request->type == 2){
            $settingHome->link = $request->link;
        }elseif ($request->type == 4) {
            $settingHome->value = $request->cate;
        }elseif ($request->type == 3) {
            $settingHome->value = $request->sale;
        }
        $path = 'uploads/home/config';
        $fImage = $request->file('fImage');
        if(!empty($fImage)){
            $file_name = time() . '_' . $fImage->getClientOriginalName();
            $fImage->move($path, $file_name);
            $settingHome->image = $file_name;
        }
        $settingHome->save();
        return redirect()->route('backend.homesetting')->with([
            'flash_level' => 'success',
            'flash_message' => 'Sửa thành công !'
        ]);
    }

    public function getDelete($id)
    {
        $settingHome = SettingHome::find($id);
        if (isset($settingHome)) {
            $image = $settingHome->image;
            $image_path = 'uploads/home/config/';
            if(File::exists($image_path.$image)){
                File::delete($image_path.$image);
            }
            $settingHome::destroy($id);
            return redirect()->route('backend.homesetting')->with([
                'flash_level' => 'success',
                'flash_message' => 'Xóa thành công !'
            ]);
        }
        return redirect()->route('backend.homesetting')->with([
            'flash_level' => 'danger',
            'flash_message' => 'Không tìm thấy nội dung'
        ]);
    }
    public function postMultiDel(Request $request)
    {
        if ($request->has('chkItem')) {
            foreach ($request->chkItem as $id) {

                $settingHome = SettingHome::find($id);
                $image = $settingHome->image;
                $image_path = 'uploads/home/config/';
                if (isset($settingHome)) {
                    if(File::exists($image_path.$image)){
                        File::delete($image_path.$image);
                    }
                    $settingHome::destroy($id);
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
