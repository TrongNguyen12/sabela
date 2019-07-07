<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Post;
use File;

class DealController extends Controller
{
    public function getList()
    {
    	$data = Post::where('type', 'deal')->get();
        return view('backend.deal.list', compact('data'));
    }
    public function getAdd()
    {
    	return view('backend.deal.add');
    }
    public function postAdd(Request $request)
    {
    	$this->validate($request,
            [
                'name' => 'required',
                'slug' => 'required',
                'fImage' => 'required'
            ],
            [
                'name.required' => 'Bạn chưa nhập tiêu đề !',
                'slug.required' => 'Bạn chưa nhập đường dẫn tĩnh !',
                'fImage.required' => 'Bạn chưa chọn hình ảnh !'
            ]
        );
        $post = new Post;
        $post->name = $request->name;
        $post->slug = $request->slug;
        $post->content_main = $request->content_main;
        $post->meta_title = $request->meta_title;
        $post->meta_description = $request->meta_description;
        $post->meta_keyword = $request->meta_keyword;
        $post->status = $request->status;
        $path = 'uploads/post';
        $fImage = $request->file('fImage');
        if(!empty($fImage)){
            $file_name = time() . '_' . $fImage->getClientOriginalName();
            $fImage->move($path, $file_name);
            $post->image = $file_name;
        }
        $post->type = 'deal';
        $post->save();
        return redirect()->route('backend.deal.list')->with([
            'flash_level' => 'success',
            'flash_message' => 'Thêm thành công.'
        ]);
    }
    public function getEdit($id)
    {
    	$data = Post::find($id);
        if (isset($data)) {
            return view('backend.deal.edit', compact('data'));
        }
        return redirect()->route('backend.deal.list')->with([
            'flash_level' => 'danger',
            'flash_message' => 'Không tìm thấy bài viết !'
        ]);
    }
    public function postEdit($id, Request $request)
    {
    	 $this->validate($request,
            [
                'name' => 'required',
                'slug' => 'required'
            ],
            [
                'name.required' => 'Bạn chưa nhập tiêu đề !',
                'slug.required' => 'Bạn chưa nhập đường dẫn tĩnh !'
            ]
        );
        $post = Post::find($id);
        $post->name = $request->name;
        $post->slug = $request->slug;
        $post->content_main = $request->content_main;
        $post->meta_title = $request->meta_title;
        $post->meta_description = $request->meta_description;
        $post->meta_keyword = $request->meta_keyword;
        $post->status = $request->status;
        $image = $post->image;
        $path = 'uploads/post/';
        $fImage = $request->file('fImage');
         if(!empty($fImage)){
            $file_name = time() . '_' . $fImage->getClientOriginalName();
            $fImage->move($path, $file_name);
            $post->image = $file_name;
            if(File::exists($path.$image)){
                File::delete($path.$image);   
            }
        }
        $post->type = 'deal';
        $post->save();
        return back()->with([
            'flash_level' => 'success',
            'flash_message' => 'Sửa thành công !'
        ]);
    }
    public function getDelete($id)
    {
    	$post = Post::find($id);
        if (isset($post)) {
            $image = $post->image;
            $image_path = 'uploads/post/';
            if(File::exists($image_path.$image)){
                File::delete($image_path.$image);
            }
            $post::destroy($id);
            return back()->with([
                'flash_level' => 'success',
                'flash_message' => 'Xóa thành công!'
            ]);
        }
        return redirect()->route('backend.blog')->with([
            'flash_level' => 'danger',
            'flash_message' => 'Không tìm thấy bài viết !'
        ]);
    }
    public function postMutiDelete(Request $request)
    {
    	if ($request->has('chkItem')) {
            foreach ($request->chkItem as $id) {
                $post = Post::find($id);
                $image = $post->image;
                $image_path = 'uploads/post/';
                if (isset($post)) {
                    if(File::exists($image_path.$image)){
                        File::delete($image_path.$image);
                    }
                    $post::destroy($id);
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
