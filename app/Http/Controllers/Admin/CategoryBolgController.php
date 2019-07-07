<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;

class CategoryBolgController extends Controller
{
    public function getList()
    {
    	$categories= Category::where('type', 'blog_category')->get();
    	return view('backend.postcategory.list', compact('categories'));
    }
    public function getAdd()
    {
    	return view('backend.postcategory.add');
    }
    public function postAdd(Request $request)
    {
        $this->validate($request,
            [
                'name' => 'required',
            ],
            [
                'name.required' => 'Bạn chưa nhập tiêu đề !',
            ]
        );
    	$category = new Category;
    	$category->name = $request->name;
    	$category->slug = $request->slug;
    	$category->parent_id = 0;
    	$category->meta_title = $request->meta_title;
    	$category->meta_description = $request->meta_description;
    	$category->meta_keyword = $request->meta_keyword;
    	$category->type = 'blog_category';
    	$category->save();
    	return redirect('backend/blog/cat')->with([
            'flash_level' => 'success',
            'flash_message' => 'Thêm thành công !'
        ]);
    }
    public function getEdit($id)
    {
        $data['data'] = Category::find($id);
        return view('backend.postcategory.edit', $data);
    }
    public function getDelete($id)
    {
        Category::destroy($id);
        return back()->with([
            'flash_level' => 'success',
            'flash_message' => 'Xóa thành công !'
        ]);
    }
    public function postEdit($id, Request $request)
    {
         $this->validate($request,
            [
                'name' => 'required',
                
            ],
            [
                'name.required' => 'Bạn chưa nhập tiêu đề !',
            ]
        );
        $category = Category::find($id);
        $category->name = $request->name;
        $category->slug = $request->slug;
        $category->meta_title = $request->meta_title;
        $category->meta_description = $request->meta_description;
        $category->meta_keyword = $request->meta_keyword;
        
        $category->save();

        return back()->with([
            'flash_level' => 'success',
            'flash_message' => 'Sửa thành công !'
        ]);
    }
    public function postMultiDel()
    {
        return back();   
    }
}
