<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Slider;
use File;

class SilderController extends Controller
{
    public function getListSlider()
    {
    	$data = Slider::get();
    	return view('backend.slider.list', compact('data'));
    }
    public function getAdd()
    {
    	return view('backend.slider.add');
    }
    public function postAdd(Request $request)
    {
		$regex = '/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/';
		$this->validate($request,
			[
				'link' => 'required|regex:' . $regex,
                'name' => 'required',
                'content' => 'required'
			],
			[
				'link.required' 	=> 'Bạn nhập Đường Link Không đúng định dạng !',
                'link.regex'        => 'Bạn nhập đường link không đúng định dạng',
                'name.required'     => 'Bạn chưa nhập tên slider',
                'content.required'     => 'Bạn chưa nhập tên nội dung',
			]
		);
    	$slider = new Slider;
    	$slider->name = $request->name;
        $slider->link = $request->link;
        $slider->content = $request->content;
        $slider->status = $request->status;
        $path = 'uploads/slider';
        $fImage = $request->file('fImage');
        if(!empty($fImage)){
            $file_name = time() . '_' . $fImage->getClientOriginalName();
            $fImage->move($path, $file_name);
            $slider->image = $file_name;
        }
        $slider->save();
        return redirect('/backend/config/slider')->with([
            'flash_level' => 'success',
            'flash_message' => 'Thêm Thành Công !'
        ]); 
    }
    public function getEdit(Request $request, $id)
    {
    	$data = Slider::find($id);
    	return view('backend.slider.edit', compact('data'));
    }
    public function postEdit(Request $request, $id)
    {
		$regex = '/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/';
		$this->validate($request,
            [

                'link' => 'required|regex:' . $regex,
                'name' => 'required',
                'content' => 'required'
            ],
            [
                'link.required'     => 'Bạn nhập Đường Link Không đúng định dạng !',
                'link.regex'        => 'Bạn nhập đường link không đúng định dạng',
                'name.required'     => 'Bạn chưa nhập tên slider',
                'content.required'     => 'Bạn chưa nhập tên nội dung',
                
            ]
        );
    	$slider = Slider::find($id);
        $image = $slider->image;
        $slider->name = $request->name;
        $slider->link = $request->link;
        $slider->content = $request->content;
        $slider->status = $request->status;
        $path = 'uploads/slider';
        $fImage = $request->file('fImage');
        if(!empty($fImage)){
            $file_name = time() . '_' . $fImage->getClientOriginalName();
            $fImage->move($path, $file_name);
            $slider->image = $file_name;
            if(File::exists($path.$image)){
                File::delete($path.$image);   
            }
        }
        $slider->save();
        return redirect('/backend/config/slider')->with([
            'flash_level' => 'success',
            'flash_message' => 'Sửa thành công !'
        ]);
    }
    public function getDelete(Request $request, $id)
    {
    	$slider = Slider::find($id);
        if (isset($slider)) {
            $image = $slider->image;
            $image_path = 'uploads/slider/';
            if(File::exists($image_path.$image)){
                File::delete($image_path.$image);
            }
            $slider::destroy($id);
            return redirect('/backend/config/slider')->with([
                'flash_level' => 'success',
                'flash_message' => 'Xóa thành công !'
            ]);
        }
    }
    public function getDeleteMuti(Request $request)
    {
    	if ($request->has('chkItem')) {
             foreach ($request->chkItem as $id) {
                $slider = Slider::find($id);
                $image = $slider->image;
                $image_path = 'uploads/slider/';
                if (isset($slider)) {
                    if(File::exists($image_path.$image)){
                        File::delete($image_path.$image);
                    }
                    $slider::destroy($id);
                }
            }
            return redirect()->back()->with([
                'flash_level' => 'success',
                'flash_message' => 'Xóa thành công !'
            ]);
        }else{
			return redirect()->back()->with([
                'flash_level' => 'danger',
                'flash_message' => 'Ban chưa chọn dữ liệu cần xóa !'
            ]);
		}
    }
}
