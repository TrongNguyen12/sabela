<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Reviews;
use File;

class ReviewsController extends Controller
{
    public function getList()
    {
    	$data = Reviews::all();
    	return view('backend.review.list', compact('data'));
    }
    public function getAdd()
    {
    	return view('backend.review.add');
    }
    public function postAdd(Request $request)
    {
    	$this->validate($request,
            [
                'name' => 'required',
                'position' => 'required',
                'fImage' => 'required',
                'content' => 'required'
            ],
            [
                'name.required' => 'Bạn chưa nhập tên.',
                'fImage.required' => 'Bạn chưa chọn ảnh.',
                'position.required' => 'Bạn chưa nhập vị trí. ',
                'content.required' => 'Bạn chưa nhập nội dung. '
            ]
        );
    	$review = new Reviews;
    	$review->name = $request->name;
    	$review->position = $request->position;
    	$review->content = $request->content;
    	$review->status = $request->status == 1 ? 1 :  null;
    	$path = 'uploads/config/reviews';
        $fImage = $request->file('fImage');
        if(!empty($fImage)){
            $file_name = time() . '_' . $fImage->getClientOriginalName();
            $fImage->move($path, $file_name);
            $review->image = $file_name;
        }
        $review->save();
        return redirect()->route('backend.config.reviews')->with([
            'flash_level'   => 'success',
            'flash_message' => 'Thêm mới thành công.'
        ]);
    	
    }
    public function getEdit($id)
    {
    	$data = Reviews::find($id);
        if ($data) {
            return view('backend.review.edit', compact('data'));
        }
        return redirect()->route('backend.config.reviews')->with([
            'flash_level'   => 'danger',
            'flash_message' => 'Không tìm thấy. '
        ]);
    }
    public function postEdit($id, Request $request)
    {
    	$this->validate($request,
            [
                'name' => 'required',
                'position' => 'required',
                'content' => 'required'
            ],
            [
                'name.required' => 'Bạn chưa nhập tên.',
                'position.required' => 'Bạn chưa nhập vị trí. ',
                'content.required' => 'Bạn chưa nhập nội dung. '
            ]
        );
        $review = Reviews::find($id);
        $review->name = $request->name;
        $review->position = $request->position;
        $review->content = $request->content;
        $review->status = $request->status == 1 ? 1 :  null;
        $path = 'uploads/config/reviews';
        $fImage = $request->file('fImage');
        if(!empty($fImage)){
            $image = $review->image;
            $image_path = 'uploads/config/reviews/';
            if(File::exists($image_path.$image)){
                File::delete($image_path.$image);
            }
            $file_name = time() . '_' . $fImage->getClientOriginalName();
            $fImage->move($path, $file_name);
            $review->image = $file_name;
        }
        $review->save();
        return redirect()->route('backend.config.reviews')->with([
            'flash_level'   => 'success',
            'flash_message' => 'Sửa thành công.'
        ]);
    }
    public function getDelete($id)
    {
    	$review = Reviews::find($id);
        if($review){
            $image = $review->image;
            $image_path = 'uploads/config/reviews/';
            if(File::exists($image_path.$image)){
                File::delete($image_path.$image);
            }
            $review->delete();
            return redirect()->route('backend.config.reviews')->with([
                'flash_level'   => 'success',
                'flash_message' => 'Xóa thành công.'
            ]);
        }
        return redirect()->route('backend.config.reviews')->with([
            'flash_level'   => 'danger',
            'flash_message' => 'Không tìm thấy. '
        ]);
    }
    public function getDeleteMuti(Request $request)
    {
    	if ($request->has('chkItem')) {
            foreach ($request->chkItem as $id) {
                $review = Reviews::find($id);
                $image = $review->image;
                $image_path = 'uploads/config/reviews/';
                if (isset($review)) {
                    if(File::exists($image_path.$image)){
                        File::delete($image_path.$image);
                    }
                    $review::destroy($id);
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
