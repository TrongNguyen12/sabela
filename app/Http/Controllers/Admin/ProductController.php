<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductCategory;
use File;
use DB;

class ProductController extends Controller
{
    public function getList()
    {
    	$products = Product::with('category')->get();
    	return view('backend.product.list', compact('products'));
    }
    public function getAdd()
    {
		$categories  =  Category::where('type', 'product_category')->get();
    	return view('backend.product.add', compact('categories'));
    }
    public function postAdd(Request $request)
    {
    	$this->validate($request,
            [
                'name' => 'required',
                'category_id' => 'required',
                'fImage' => 'required'
            ],
            [
                'name.required' => 'Bạn chưa nhập tên sản phẩm.',
                'fImage.required' => 'Bạn chưa chọn ảnh sản phẩm.',
                'category_id.required' => 'Bạn chưa chọn danh mục cho sản phẩm. '
            ]
        );
    	$product = new Product;
    	$product->name = $request->name;
    	$product->slug = $request->slug;
    	$product->sort_desc = $request->sort_desc;
    	$product->desc = $request->desc;
    	$product->status = $request->status == 1 ? 1 : null;
    	$product->new = $request->new == 1 ? 1 : null;
    	$product->hot = $request->hot == 1 ? 1 : null;
    	$fImage = $request->file('fImage');
        if(!empty($fImage)){
            $path = 'uploads/product/avatar';
            $file_name = time() . '_' . $fImage->getClientOriginalName();
            $fImage->move($path, $file_name);
            $product->image = $file_name;
        }
        $fImageGallery = $request->file('fImageGallery');
        if(!empty($fImageGallery)){
            $image_gallery = array();
            foreach ($fImageGallery as $item) {
                $path = 'uploads/product/prod';
                $file_name = time().rand(10,100). '_' . $item->getClientOriginalName();
                $item->move($path, $file_name);
                $image_gallery[] = $file_name;
            }
            $product->more_image = json_encode($image_gallery);
        }
    	$product->meta_title = $request->meta_title;
    	$product->meta_description = $request->meta_description;
    	$product->meta_keyword = $request->meta_keyword;
    	$product->save();
    	if (!empty($request->category_id)) {
    		if($product->id){
	    		foreach ($request->category_id as $item) {
	    			$category = new ProductCategory;
	    			$category->id_category =  $item;
	    			$category->id_product =  $product->id;
	    			$category->save();
	    		}
	     	}
    	}
    	return redirect()->route('backend.product')->with([
            'flash_level'   => 'success',
            'flash_message' => 'Thêm mới sản phẩm thành công.'
        ]);
    }
    public function getEdit($id)
    {
    	$product = Product::find($id);
    	if($product){
    		$categories  =  Category::where('type', 'product_category')->get();
    		return view('backend.product.edit', compact('categories', 'product'));
    	}
    	return redirect()->back()->with([
            'flash_level' => 'danger',
            'flash_message' => 'Bạn chưa chọn dữ liệu cần xóa !'
        ]);
    }
    public function postEdit($id, Request $request)
    {
    	$this->validate($request,
            [
                'name' => 'required',
                'category_id' => 'required',
            ],
            [
                'name.required' => 'Bạn chưa nhập tên sản phẩm.',
                'category_id.required' => 'Bạn chưa chọn danh mục cho sản phẩm. '
            ]
        );
    	$product = Product::find($id);
    	$product->name = $request->name;
    	$product->slug = $request->slug;
    	$product->sort_desc = $request->sort_desc;
    	$product->desc = $request->desc;
    	$product->status = $request->status == 1 ? 1 : null;
    	$product->new = $request->new == 1 ? 1 : null;
    	$product->hot = $request->hot == 1 ? 1 : null;
    	$fImage = $request->file('fImage');
        if(!empty($fImage)){
            $image = $product->image;
            $path = 'uploads/product/avatar/';
            $file_name = time() . '_' . $fImage->getClientOriginalName();
            $fImage->move($path, $file_name);
            $product->image = $file_name;
            if(File::exists($path.$image)){
                File::delete($path.$image);   
            }
        }
     	$fImageGallery = $request->file('fImageGallery');
        if(!empty($fImageGallery)){
            $list_image = $product->more_image;
            $path_more_image = 'uploads/product/prod/';
            $more_image = array();
            foreach ($fImageGallery as $item) {
                $file_name = time() . '_' . $item->getClientOriginalName();
                $item->move($path_more_image, $file_name);
                $more_image[] = $file_name;
            }
            $product->more_image = json_encode($more_image);
            $list_image = json_decode($list_image);
            foreach ($list_image as $item) {
                if(File::exists($path_more_image.$item)){
                    File::delete($path_more_image.$item);   
                }
            }
        }
    	$product->meta_title = $request->meta_title;
    	$product->meta_description = $request->meta_description;
    	$product->meta_keyword = $request->meta_keyword;
    	$product->save();
    	if(!empty($request->category_id)){
            DB::table('product_category')->where('id_product', $id)->delete();
            foreach ($request->category_id as $item) {
    			$category = new ProductCategory;
    			$category->id_category =  $item;
    			$category->id_product =  $id;
    			$category->save();
    		}
        }
        return redirect()->route('backend.product')->with([
            'flash_level'   => 'success',
            'flash_message' => 'Sửa thông tin sản phẩm thành công.'
        ]);
    }
   	public function getDelete($id)
   	{
   		$product = Product::find($id);
        $more_image =  $product->more_image;
        $image = $product->image;
        if (isset($product)) {
            $more_image = json_decode($more_image);
            $image_list_path = 'uploads/product/prod/';
            foreach ($more_image as $item) {
                if(File::exists($image_list_path.$item)){
                    File::delete($image_list_path.$item);
                }
            }
            $image_path = 'uploads/product/avatar/';
            if(File::exists($image_path.$image)){
                File::delete($image_path.$image);
            }
            $product->delete();
            return redirect()->route('backend.product')->with([
                'flash_level' => 'success',
                'flash_message' => 'Xóa thành công !'
            ]);
        }else {
            return redirect()->route('backend.product')->with([
                'flash_level' => 'danger',
                'flash_message' => 'Không tìm thấy sản phẩm !'
            ]);
        }
   	}
   	public function getDeleteMuti(Request $request)
   	{
   		if ($request->has('chkItem')) {
            foreach ($request->chkItem as $id) {
                $product = Product::find($id);
                $more_image =  $product->more_image;
                $image = $product->image;
                if (isset($product)) {
                    $more_image = json_decode($more_image);
                    if(!empty($more_image)){
                        $image_list_path = 'uploads/product/prod/';
                        foreach ($more_image as $item) {
                            if(File::exists($image_list_path.$item)){
                                File::delete($image_list_path.$item);
                            }
                        }
                        $image_path = 'uploads/product/avatar/';
                        if(File::exists($image_path.$image)){
                            File::delete($image_path.$image);
                        }
                    }
                    $product->delete();
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
