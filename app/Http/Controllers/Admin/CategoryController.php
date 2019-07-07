<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;

class CategoryController extends Controller
{
    public function getList()
    {
        $categories  =  Category::where('type', 'product_category')->get();
    	return view('backend.category.list', compact('categories'));
    }
    public function getAdd()
    {
    	$data = Category::where('type', 'product_category')->get();
    	return view('backend.category.add', compact('data'));
    }
    public function postAdd(Request $request)
    {
        $this->validate($request,
            [
                'name' => 'required',
            ],
            [
                'name.required' => 'Bạn chưa nhập tên danh mục !'
            ]
        );
    	$category = new Category;
    	$category->name = $request->name;
    	$category->slug = $request->slug;
    	$category->parent_id = 1;
    	$category->meta_title = $request->meta_title;
    	$category->meta_description = $request->meta_description;
    	$category->meta_keyword = $request->meta_keyword;
    	$category->type = 'product_category';
    	$category->save();
    	return redirect('backend/product/category')->with([
            'flash_level' => 'success',
            'flash_message' => 'Thêm thành công !'
        ]);
    }
    public function getEdit($id)
    {
        $data['data'] = Category::find($id);
        $data['parent'] = Category::where('type', 'product_category')->get();
        return view('backend.category.edit', $data);
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
                'name.required' => 'Bạn chưa nhập tên danh mục !',
            ]
        );
        $category = Category::find($id);
        $category->name = $request->name;
        $category->slug = $request->slug;
        $category->parent_id = 0;
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
