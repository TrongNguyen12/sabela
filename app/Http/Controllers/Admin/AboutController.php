<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Post;
use File;
use App\Models\Agency;

class AboutController extends Controller
{
   	public function getList(Request $request)
    {
        $about = Post::where('type', 'about')->first();
        return view('backend.about.list', compact('about'));
    }
    public function postAbout(Request $request)
    {
        $this->validate($request,
            [
                'title'          => 'required',
                'content'        => 'required',
                'title_second'   => 'required',
                'content_second' => 'required',
                'fImage'         => 'required',
            ],
            [
                'title.required'            => 'Bạn chưa nhập tiêu đề !',
                'content.required'          => 'Bạn chưa nhập mô tả !',
                'title_second.required'     => 'Bạn chưa nhập tiêu đề khối hai!',
                'content_second.required'   => 'Bạn chưa nhập mô tả khối hai!',
                'fImage.required'           => 'Bạn chưa chọn hình ảnh !',
            ]
        );
        $about = Post::find($request->id);
        $image_gallery_old = json_decode( $about->content_main );
        $image_gallery_old = $image_gallery_old->image_gallery;
        $fImageGallery = $request->file('fImageGallery');
        if(!empty($fImageGallery)){
            $image_gallery = array();
            foreach ($fImageGallery as $item) {
                $path = 'uploads/post';
                $file_name = time().rand(10,100). '_' . $item->getClientOriginalName();
                $item->move($path, $file_name);
                $image_gallery[] = $file_name;
            }
        }
        $content = [
            'content' => $request->content,
            'title_second' => $request->title_second,
            'content_second' => $request->content_second,
            'image_gallery' => isset($image_gallery) ? $image_gallery : $image_gallery_old,
        ];
        
        $fImage = $request->file('fImage');
        if(!empty($fImage)){
            $path = 'uploads/post';
            $file_name = time() . '_' . $fImage->getClientOriginalName();
            $fImage->move($path, $file_name);
            $about->image = $file_name;
        }
        $about->name = $request->title;
        $about->meta_title = $request->meta_title;
        $about->content_main = json_encode($content);
        $about->meta_description = $request->meta_description;
        $about->meta_keyword = $request->meta_keyword;
        $about->type= 'about';
        $about->save();
        return redirect()->back()->with([
            'flash_level'   => 'success',
            'flash_message' => 'Cập nhật thành công !'
        ]);
    }
    public function getListAgency()
    {
        $data = Agency::all();
        return view('backend.agency.list', compact('data'));
    }
    public function getAddAgency()
    {
        return view('backend.agency.add');
    }
    public function postAddAgency(Request $request)
    {
        $this->validate($request,
            [
                'name'     => 'required',
                'address'  => 'required',
                'phone'    => 'required',
                'email'    => 'required|email',
            ],
            [
                'name.required'     => 'Bạn chưa nhập tên đại lý !',
                'address.required'  => 'Bạn chưa nhập địa chỉ !',
                'phone.required'    => 'Bạn chưa nhập số điện thoại !',
                'email.required'    => 'Bạn chưa nhập email!',
                'email.email'       => 'Bạn nhập sai định dạng email !'
            ]
        );
        $agency =  new Agency;
        $agency->name = $request->name;
        $agency->address = $request->address;
        $agency->phone = $request->phone;
        $agency->email = $request->email;
        $agency->status = $request->status == 1 ? 1 : null;
        $agency->save();
        return redirect()->route('backend.about.agency.getListAgency')->with([
            'flash_level'   => 'success',
            'flash_message' => 'Thêm thành công !'
        ]);
    }
    public function getEditAgency($id)
    {
        $data = Agency::find($id);
        if ($data) {
            return view('backend.agency.edit', compact('data'));
        }
        return redirect()->route('backend.about.agency.getListAgency')->with([
            'flash_level'   => 'danger',
            'flash_message' => 'Không tìm thấy !'
        ]);
    }
    public function postEditAgency($id, Request $request)
    {
        $this->validate($request,
            [
                'name'     => 'required',
                'address'  => 'required',
                'phone'    => 'required',
                'email'    => 'required|email',
            ],
            [
                'name.required'     => 'Bạn chưa nhập tên đại lý !',
                'address.required'  => 'Bạn chưa nhập địa chỉ !',
                'phone.required'    => 'Bạn chưa nhập số điện thoại !',
                'email.required'    => 'Bạn chưa nhập email!',
                'email.email'       => 'Bạn nhập sai định dạng email !'
            ]
        );
        $agency = Agency::find($id);
        $agency->name = $request->name;
        $agency->address = $request->address;
        $agency->phone = $request->phone;
        $agency->email = $request->email;
        $agency->status = $request->status == 1 ? 1 : null;
        $agency->save();
        return redirect()->route('backend.about.agency.getListAgency')->with([
            'flash_level'   => 'success',
            'flash_message' => 'Sửa thành công !'
        ]);
    }
    public function getDeleteAgency($id)
    {
        $agency = Agency::find($id);
        if ($agency) {
            $agency->delete();
            return redirect()->route('backend.about.agency.getListAgency')->with([
                'flash_level'   => 'success',
                'flash_message' => 'Xóa thành công !'
            ]);
        }
        return redirect()->route('backend.about.agency.getListAgency')->with([
            'flash_level'   => 'danger',
            'flash_message' => 'Xóa không thành công !'
        ]);
    }
    public function postDeleteMuti(Request $request)
    {
        if ($request->has('chkItem')) {
            foreach ($request->chkItem as $id) {
                $agency = Agency::find($id);
                $agency::destroy($id);
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
