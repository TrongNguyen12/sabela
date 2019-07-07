<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\Category;
use App\Models\Product;
use App\Models\ConfigHome;
use App\Models\Custommer;
use App\Models\product_category;
use App\Models\Bank;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Models\District;
use App\Models\Province;
use App\Models\Order;
use App\Models\Post;
use App\Models\OrderDetail;
use App\Models\Contact;
use App\Models\filter;
use App\Models\Album;
use App\Models\ImageAlbum;
use App\Models\SettingHome;
use App\Mail\SendEmail;
use App\Mail\ResetPassword;
use DB;
use Illuminate\Support\Facades\Mail;
use Cart;
use Auth;
use Session;
use SEO;
use SEOMeta;
use App\Models\Wishlist;
use Illuminate\Support\Str;
use App\Models\PasswordReset;
use App\Notifications\ResetPasswordRequest;

class IndexController extends Controller
{
    public function __construct()
    {
        $filter = filter::where('type', 'price')->get();
        $filtersSize = Category::where('type', 'size_category')->get();
        $filtersSeason = Category::where('type', 'season_category')->get();
        $filtersMaterial = Category::where('type', 'material_category')->get();
        view()->share(compact('filter', 'filtersSize', 'filtersSeason', 'filtersMaterial'));
    }
    public function getHome()
    {
        $settingHome = SettingHome::all();
    	$slider = Slider::where('status', 1)->get();
        return view('frontend.pages.home', compact('slider', 'settingHome'));
    }
    public function getAbout()
    {
        $about = Post::where('type', 'about')->first();
        $aboutSeo = $about;
        $about = json_decode($about->content_main);
        SEO::setTitle($aboutSeo->meta_title);
        SEO::setDescription($aboutSeo->meta_description);
        SEO::opengraph()->setUrl(asset('/'));
        SEO::setCanonical(asset('/'));
        SEOMeta::addKeyword($aboutSeo->meta_keyword);
    	return view('frontend.pages.about', compact('about'));
    }
    public function getWhyOrganic()
    {
        $about = Post::where('type', 'why')->first();
        $aboutSeo = $about;
        $about = json_decode($about->content_main);
        SEO::setTitle($aboutSeo->meta_title);
        SEO::setDescription($aboutSeo->meta_description);
        SEO::opengraph()->setUrl(asset('/'));
        SEO::setCanonical(asset('/'));
        SEOMeta::addKeyword($aboutSeo->meta_keyword);
        return view('frontend.pages.about', compact('about'));
    }
    public function getAlbum()
    {
        $albums = Album::with('ImageAlbum')->where('status', 1)->get();
        return view('frontend.pages.album', compact('albums'));
    }
    public function getCatPost()
    {
        $catPost = Category::where('type', 'blog_category')->get();
        $post = Post::where('status', 1)
                    ->where('type', 'blog')
                    ->where('status', 1)
                    ->orderBy('id','desc')->paginate(4);
        return view('frontend.pages.categoryPost_fix', compact('post', 'catPost'));
    }
    public function getSinglePost($slug, $id)
    {
        //tách để lấy id
        $ids = $id;
        $exp_ids = @explode("-", $ids);
        $cat = end($exp_ids);
        $ids=array();
        $minlink=substr($cat,0,1);
        $cat_id=substr($cat,1);
        $menu_aty=$minlink;
        if($minlink == 'p'){
            $post = Post::find($cat_id);
            if(!empty($post)){
                $postCat = Post::where('status', 1)
                                ->where('type', 'blog')
                                ->where('id', '<>', $cat_id)
                                ->where('idCatPost', $post->idCatPost)
                                ->inRandomOrder()
                                ->take(3)
                                ->get();
                SEO::setTitle($post->name);
                SEO::setDescription($post->meta_description);
                SEO::opengraph()->setUrl(asset('/'));
                SEO::setCanonical(asset('/'));
                SEOMeta::addKeyword($post->meta_keyword);
                return view('frontend.pages.singlePost', compact( 'post', 'postCat' ));
            }else {
                return abort(404);
            }
        }
    }
    public function getContact()
    {
        return view('frontend.pages.contact');
    }
    public function getProduct(Request $request)
    {
        if ($request->has('sort')) {
            if($request->sort == 'AZ'){
                $products = Product::filter($request)->orderBy('name', 'ASC')->paginate(12);
            }else {
                $products = Product::filter($request)->orderBy('price', $request->sort)->paginate(12);
            }
        }else {
            $products = Product::filter($request)->orderBy('updated_at', 'DESC')->paginate(12);
        }
        return view('frontend.pages.product', compact('products'));
    }
    public function getDetalProduct($slug, $id)
    {
        //tách để lấy id
        $ids = $id;
        $exp_ids = @explode("-", $ids);
        $cat = end($exp_ids);
        $ids=array();
        $minlink=substr($cat,0,1);
        $pro_id=substr($cat,1);
        $menu_aty=$minlink;
        if($minlink == 'p'){
            $product = Product::find($pro_id);

            // sản phẩm liên quan
            $category_id = $product->category;
            $product_id = DB::table('product_category')->select('product_id')->whereIn('category_id', $category_id)->get();
            
            //dd($product_id);
            // xóa bỏ key
            $product_id = $product_id->pluck('product_id')->toArray();
            
            $related_products = Product::whereIn('id', $product_id)
                                        ->where('id', '<>', $pro_id)
                                        ->take(4)->get();

            $combined_products = $product->combined_products;
            if ($combined_products != null ) {
                $combined_products = Product::whereIn('id', json_decode($combined_products))->get();
            }else {
                $combined_products= null;
            }
            SEO::setTitle($product->name);
            SEO::opengraph()->setUrl(asset('/'));
            SEO::setCanonical(asset('/'));
            SEOMeta::addKeyword($product->meta_keyword);
            return view( 'frontend.pages.singleProduct', compact( 'product', 'related_products', 'combined_products' ));
        }
    }
    public function getCart()
    {
        $cart = Cart::content();
        return view('frontend.pages.cart', compact('cart'));
    }
    public function postCart(Request $request ,$id)
    {
        $product = Product::find($id);
        if ($product->price_promotion != null) {
            $price = $product->price_promotion;
        }else {
            $price = $product->price;
        }
        $size = category::find($request->size);
        $material = category::find($request->material);
        $data = [
            'id' => $id,
            'name' => $product->name,
            'qty' => $request->qty,
            'price' => $price,
            'options' => [
                'size' => $size->name,
                'material' => $material->name,
                'image' => $product->image
            ]
        ];
        Cart::add($data);
        if (!empty($request->paynow)) {
            return redirect('/gio-hang');
        }
        return back()->with('Tsuccess', 'Thêm thành công sản phẩm vào giỏ hàng !');
    }
    public function deleteCart($id)
    {
        Cart::remove($id);
        return back()->with('Tsuccess', 'Cập nhật thành công giỏ hàng !');;
    }
    public function getUpDateCart(Request $request)
    {
        Cart::update($request->rowId, $request->qty);
        echo 'OK';
    }
    public function getCheckOut()
    {
        $bank = Bank::where('status', 1)->get();
        $province = Province::all();
        return view('frontend.pages.checkout', compact('province', 'bank'));
    }
    public function getProvince(Request $request)
    {
        $districs = District::where('provinceid', $request->districtid)->orderBy('name', 'asc')->get();
        $result = '<option value="">Quận/Huyện</option>';
        foreach ($districs as $district) {
            $result .= '<option value="' . $district->districtid . '">' . $district->name . '</option>';
        }
        return $result;
    }
    public function postSaveOrder(Request $request)
    {
        
        if(Cart::count() > 0){
             $this->validate($request,
                [
                    'name' => 'required',
                    'phone' => 'required',
                    'email' => 'required|email',
                    'province' => 'required',
                    'district' => 'required',
                    'address' => 'required',
                ],
                [
                    'name.required' => 'Bạn chưa nhập Họ tên',
                    'phone.required' => 'Bạn chưa nhập Họ tên',
                    'province.required' => 'Bạn chưa chọn Tỉnh Thành',
                    'district.required' => 'Bạn chưa nhập Quận Huyện',
                    'address.required' => 'Bạn chưa nhập Địa chỉ',
                ]
            );
            $customer = Custommer::where([
                ['phone', $request->phone],
                ['email', $request->email]
            ])->first();
            if (!isset($customer)) {
                $customer = new Custommer;
                $customer->name = $request->name;
                $customer->phone = $request->phone;
                $customer->email = $request->email;
                $customer->address = $request->address;
                $customer->type = 'customer_member';
                $customer->save();
                $customerId = $customer->id;
            }else {
                $customerId = $customer->id;
            }
            $request->status = 1;
            $order = new Order;
            $order->customer_id = $customerId;
            $order->bank_id = $request->bank_id;
            $order->price_total = $request->price_total;
            $order->payment_method = $request->payment_method;
            $order->address = $request->address;
            $order->province_id = $request->province;
            $order->district_id = $request->district;
            $order->content = $request->content;
            $order->type = $request->type;
            $order->status = $request->status;
            $order->price_total = Cart::total(2,'.','');
            $order->save();
            $order_id = $order->id;
            if ($order_id != "") {
                foreach (Cart::content() as $item) {
                    $orderDetail = new OrderDetail;
                    $orderDetail->order_id = $order_id;
                    $orderDetail->product_id = $item->id;
                    $orderDetail->price_total = $item->price;
                    $orderDetail->size = $item->options->size;
                    $orderDetail->material = $item->options->material;
                    $orderDetail->product_quantity = $item->qty;
                    $orderDetail->save();
                }
                $customer_info = Custommer::find($customerId);
                $cart = Cart::content();
                $value = [
                    'full_name' => $customer_info->name,
                    'phone'     => $customer_info->phone,
                    'email'     => $customer_info->email,
                    'address'   => $customer_info->address,                  
                    'content'   => $request->note,
                    'type'   => 'Đơn hàng mua',
                    'cart'      => $cart
                ];
                Mail::send('frontend.block.donhang_tpl', $value, function ($msg) {
                    $msg->to('nvtrong393@gmail.com', 'Admin')->subject('Đơn đặt hàng');
                });
                Cart::destroy();
                return redirect('san-pham')->with(
                    'Tsuccess_order', '#ORDER.$order->id');
            }
        }
    }
    public function getCheckOutGift(Request $request)
    {
        $bank = Bank::where('status', 1)->get();
        $province = Province::all();
        return view('frontend.pages.gift', compact('province', 'bank'));
    }
    public function postCheckOutGift(Request $request)
    {
        if(Cart::count() > 0){
             $this->validate($request,
                [
                    'name' => 'required',
                    'phone' => 'required',
                    'email' => 'required|email',
                    'province' => 'required',
                    'district' => 'required',
                    'address' => 'required',
                ],
                [
                    'name.required' => 'Bạn chưa nhập Họ tên',
                    'phone.required' => 'Bạn chưa nhập Họ tên',
                    'province.required' => 'Bạn chưa chọn Tỉnh Thành',
                    'district.required' => 'Bạn chưa nhập Quận Huyện',
                    'address.required' => 'Bạn chưa nhập Địa chỉ',
                ]
            );
            $customer = Custommer::where([
                ['phone', $request->phone],
                ['email', $request->email]
            ])->first();
            if (!isset($customer)) {
                $customer = new Custommer;
                $customer->name = $request->name;
                $customer->phone = $request->phone;
                $customer->email = $request->email;
                $customer->address = $request->address;
                $customer->type = 'customer_member';
                $customer->save();
                $customerId = $customer->id;
            }else {
                $customerId = $customer->id;
            }
            $request->status = 1;
            $order = new Order;
            $order->customer_id = $customerId;
            $order->bank_id = $request->bank_id;
            $order->price_total = $request->price_total;
            $order->payment_method = $request->payment_method;
            $order->address = $request->address;
            $order->province_id = $request->province;
            $order->district_id = $request->district;
            $order->content = $request->content;

            $order->title = $request->title;
            $order->name_of_recipient = $request->name_of_recipient;
            $order->phone_of_recipient = $request->phone_of_recipient;
            $order->dateReceive = $request->dateReceive;

            $order->type = $request->type;
            $order->status = $request->status;
            $order->price_total = Cart::total(2,'.','');
            $order->save();
            $order_id = $order->id;
            if ($order_id != "") {
                foreach (Cart::content() as $item) {
                    $orderDetail = new OrderDetail;
                    $orderDetail->order_id = $order_id;
                    $orderDetail->product_id = $item->id;
                    $orderDetail->price_total = $item->price;
                    $orderDetail->size = $item->options->size;
                    $orderDetail->material = $item->options->material;
                    $orderDetail->product_quantity = $item->qty;
                    $orderDetail->save();
                }
                $customer_info = Custommer::find($customerId);
                $cart = Cart::content();
                $value = [
                    'full_name' => $customer_info->name,
                    'phone'     => $customer_info->phone,
                    'email'     => $customer_info->email,
                    'address'   => $customer_info->address,                  
                    'content'   => $request->note,
                    'type'   => 'Đơn hàng quà tặng',
                    'cart'      => $cart
                ];
                Mail::send('frontend.block.donhang_tpl', $value, function ($msg) {
                    $msg->to('nvtrong393@gmail.com', 'Admin')->subject('Đơn đặt hàng');
                });
                Cart::destroy();
                return redirect('san-pham')->with(
                    'Tsuccess_order','#ORDER'.$order->id
                );
            }
        }
    }
    public function getRegister()
    {
        return view('frontend.pages.register');
    }
    public function postRegister(Request $request)
    {
        $this->validate($request,
            [
                'name' => 'required|max:50',
                'phone' => 'required|max:15',
                'email' => 'required|email|unique:users',
                'password' => 'required',
                're_passs' => 'required|same:password'
                
            ],
            [
                'name.required' => 'Bạn chưa nhập Họ tên',
                'name.max' => 'Bạn nhập tên quá dài',
                'phone.required' => 'Bạn chưa nhập Họ tên',
                'phone.max' => 'Bạn nhập số điện thoại quá dài',
                'email.required' => 'Bạn chưa nhập email',
                'email.email' => 'Bạn chưa nhập đúng định dạng email ',
                'password.required' => 'Bạn chưa nhập mật khẩu',
                're_passs.required' => 'Bạn chưa nhập lại mật khẩu',
                're_passs.same' => 'Hai mật khẩu bạn nhập không giống nhau',
                'email.unique' => 'Email đã được đăng ký '
            ]
        );
        $customer = Custommer::where([['phone', $request->phone],['email', $request->email]])->first();
        if (!isset($customer)) {
            $customer = new Custommer;
            $customer->name = $request->name;
            $customer->phone = $request->phone;
            $customer->email = $request->email;
            $customer->gender = $request->gender;
            $customer->birthday = $request->date.'/'.$request->month.'/'.$request->year;
            $customer->type = 'customer_member';
            $customer->save();
            $customerId = $customer->id;
        }else {
            $customerId = $customer->id;
        }

        $user = new User;
        $user->name = $request->email;
        $user->email = $request->email;
        $user->level = 0;
        $user->password = Hash::make($request->password);
        $user->id_cus = $customerId;
        $user->save();
        return redirect('dang-nhap')->with(
            'Tsuccess', 'Tạo tài khoản thành công !'
        );;
    }
    public function getLogin(Request $request)
    {
        return view('frontend.pages.login');
    }
    public function postLogin(Request $request)
    {
        $this->validate($request,
            [
                'name' => 'required|max:50|email',
                'password' => 'required'
                
            ],
            [
                'name.required' => 'Bạn chưa nhập Họ tên',
                'name.max' => 'Bạn nhập tên quá dài',
                'name.email' => 'Bạn chưa nhập đúng định dạng email',
                'password.required' => 'Bạn chưa nhập mật khẩu'
            ]
        );

        $auth = array(
            'name' => $request->name,
            'password' => $request->password
        );
        if (Auth::attempt($auth)){
            return redirect('/');
        }else{
            return back()->with('error', 'Sai mật khẩu hoặc tài khoản!');
        }
    }
    public function getAccount()
    {
        if (Auth::check()) {
            $info = custommer::find( Auth::user()->id_cus );
            $order_history = Order::with('order_detail')
                            ->where('customer_id', Auth::user()->id_cus )
                            ->where('type', 1)
                            ->get();
             $order_gift_history = Order::with('order_detail')
                            ->where('customer_id', Auth::user()->id_cus )
                            ->where('type', 2)
                            ->get();
            $wishlist = Wishlist::with('product')->where('id_cus', Auth::user()->id_cus )->get();
            return view( 'frontend.pages.acc', compact('info', 'order_history', 'order_gift_history', 'wishlist' ));
        }else {
            return redirect('dang-nhap');
        }
        
    }
    public function getLogout()
    {
        Auth::logout();
        return redirect('/');
    }
    public function getProductByCat($slug, $id, Request $request)
    {
        $ids = $id;
        $exp_ids = @explode("-", $ids);
        $cat = end($exp_ids);
        $ids=array();
        $minlink=substr($cat,0,1);
        $pro_id=substr($cat,1);
        $menu_aty=$minlink;
        if($minlink == 'p'){
        	$request->request->add(['cat' => $pro_id]);
            if ($request->has('sort')) {
                if($request->sort == 'AZ'){
                    $products = Product::filter($request)->orderBy('name', 'ASC')->paginate(12);
                }else {
                    $products = Product::filter($request)->orderBy('price', $request->sort)->paginate(12);
                }
            }else {
                $products = Product::filter($request)->paginate(12);
            }
            return view('frontend.pages.productByCat', compact('products'));  
        }else {
            abort(404);
        }
    }
    public function postEditUser(Request $request)
    {
        if ($request->type == 1) {
             $this->validate($request,
                [
                    'password' => 'required',
                    'password_new' => 'required',
                    'password_new_re' => 'required',
                    'email' => 'required|email',
                    'name' => 'required',
                    'phone' => 'required|numeric',
                ],
                [
                    'password.required' => 'Bạn chưa mật khẩu cũ !',
                    'password_new.required' => 'Bạn chưa mật khẩu mới !',
                    'password_new_re.required' => 'Bạn chưa nhập lại mật khẩu mới !',
                    'email.required' => 'Bạn chưa nhập email !',
                    'email.email' => 'Bạn nhập email sai định dạng !',
                    'phone.numeric' => 'Bạn nhập số điện thoại chưa đúng !',
                    'name.required' => 'Bạn chưa nhập tên !'
                ]
            );
            if( $request->password_new == $request->password_new_re){
                if (Hash::check($request->password, Auth::user()->password)) {
                     $user = Auth::user();
                    $user->password = bcrypt($request->password_new);
                    $user->save();
                }else {
                    return back()->with('messs', 'Bạn nhập sai mật khẩu cũ !');
                }
            }else {
                return back()->with('messs', 'Hai mật khẩu nhập không khớp nhau !');
            }
        }
        $customer = Custommer::find(Auth::user()->id_cus);
        $customer->name = $request->name;
        $customer->phone = $request->phone;
        $customer->email = $request->email;
        $customer->gender = $request->gender;
        $customer->birthday = $request->date.'/'.$request->month.'/'.$request->year;
        $customer->save();
        return back()->with('success', 'Cập nhật thành công !');
    }
    public function addWishlist($id)
    {
        if (Auth::check()) {
            $wishlistCheck = Wishlist::where('id_cus', Auth::user()->id_cus)->where('id_product', $id)->first();
            if(empty($wishlistCheck)){
                $wishlist = new Wishlist;
                $wishlist->id_product = $id;
                $wishlist->id_cus = Auth::user()->id_cus;
                $wishlist->save();
                return back()->with('Tsuccess', 'Thêm sản phẩm thành công vào yêu thích !');
            }else {
                return back()->with('Tsuccess', 'Sản phẩm đã có trong danh sách yêu thích của bạn !');
            }
        }else {
            return redirect('dang-nhap')->with('Tsuccess', 'Bạn cần đăng nhập để thực hiện chức năng này');
        }
        
    }
    public function getRemoveWishlist($id)
    {
        $wishlist = Wishlist::find($id);
        $wishlist->delete();
        return redirect('account#acc3')->with('Tsuccess', 'Bạn đã bỏ yêu thích sản phẩm thành công !');
    }
    public function getSwichLang($language)
    {
        session(['website_language'=> $language]);
        return back();
    }
    public function getSearch(Request $request)
    {
        if ($request->has('search')) {
            $search = $request->search;
            $search = str_replace(" ","%", $search);
            $products = Product::where('name','like', '%'.$search.'%' )->paginate(12);
            return view('frontend.pages.product', compact('products'));
        }
    }
    public function getProductSale()
    {
        $products = Product::where('status', 2)
                            ->paginate(12);
        return view('frontend.pages.product', compact('products'));
    }
    public function getProductSaleByValue($value)
    {
        $products = Product::where('sale', '=', $value)->paginate(9);
        return view('frontend.pages.product', compact('products'));
    }
    public function postAddNewsLetter(Request $request)
    {
        $customer = Custommer::where([
                ['email', $request->email]
        ])->first();
        if (!isset($customer)) {
            $customer = new Custommer;
            $customer->email = $request->email;
            $customer->type = 'contact_customer';
            $customer->save();
            $customerId = $customer->id;
        }else {
            $customerId = $customer->id;
        }
        $contact = new Contact;
        $contact->customer_id = $customerId;
        $contact->content = 'Đăng ký nhận bản tin';
        $contact->save();
        return back()->with(
                    'Tsuccess', 'Đăng ký nhận bản tin thành công !'
                );

    }
    public function postContact(Request $request)
    {
        $this->validate($request,
            [
                'name' => 'required',
                'phone' => 'required',
                'address' => 'required',
                'content' => 'required'
            ],
            [
                'name.required' => 'Bạn chưa nhập tên !',
                'phone.required' => 'Bạn chưa nhập số điện thoại',
                'address.required' => 'Bạn chưa nhập địa chỉ',
                'content.required' => 'Bạn chưa nhập nội dung',
            ]
        );
        if( $request->has('email') ){
            $this->validate($request,
                [
                    'email' =>'email'
                ],
                [
                    'email.email' => 'Bạn chưa nhập đúng định dạng email!'
                ]
            );
        }
        $customer = Custommer::where([
                ['phone', $request->phone],
                ['email', $request->email]
        ])->first();
        if (!isset($customer)) {
            $customer = new Custommer;
            $customer->name = $request->name;
            $customer->phone = $request->phone;
            $customer->email = $request->email;
            $customer->address = $request->address;
            $customer->type = 'contact_customer';
            $customer->save();
            $customerId = $customer->id;
        }else {
            $customerId = $customer->id;
        }
        $contact = new Contact;
        $contact->content = $request->content;
        $contact->tile = $request->title;
        $contact->status = 0;
        $contact->customer_id = $customerId;
        $contact->save();
        return back()->with(
                    'Tsuccess', 'Cảm ơn bạn đã liên hệ với chúng tôi ! Chúng tôi sẽ liên lạc với bạn trong thời gian sớm nhất !'
                );
    }
    public function getPosition()
    {
        return view('frontend.pages.position');
    }
    public function getResetPassword()
    {
        if (Auth::guest()) {
            return view('frontend.pages.resetPassword');
        }else {
            return redirect('/')->with(
                    'Tsuccess', 'Bạn đang ở trạng thái đăng nhập !'
                );
        }
    }
    public function postResetPassword(Request $request)
    {
        $this->validate($request,
            [
                'email' =>'email'
            ],
            [
                'email.email' => 'Bạn chưa nhập đúng định dạng email!'
            ]
        );
        $user = User::where('email', $request->email)->first();
        if (empty($user)) {
            return back()->with('messs', 'Email bạn nhập chưa được đăng ký tài khoản !');
        }else {
            if( $user->level == 0 ){
                $passwordReset = PasswordReset::updateOrCreate([
                'email' => $user->email,
                ], [
                    'token' => Str::random(60),
                ]);
                if ($passwordReset) {
                    Mail::to($passwordReset->email)
                            ->send(new ResetPassword($passwordReset->token));
                }
                return back()->with('success', 'Chúng tôi đã gửi một email xác nhận ! Vui lòng kiểm tra email để xác nhận ! ');
            }else {
                return back()->with('messs', 'Tài khoản của bạn là tài khoản quản trị viên ! Vui lòng liên lạc với admin trang web để lấy lại mật khẩu');
            }
            
        }
    }
    public function getChangePassword($token)
    {
        return view('frontend.pages.changePassword', compact('token'));
    }
    public function postChangePassword(Request $request, $token)
    {
        $passwordReset = PasswordReset::where('token', $token)->firstOrFail();
        if(!empty($passwordReset)){
            if ($request->password == $request->re_password) {
                $user = User::where('email', $passwordReset->email)->firstOrFail();
                $user->password = Hash::make($request->password);
                $user->save();
                $passwordReset->delete();
                return redirect('dang-nhap')->with('success', 'Thay đổi mật khẩu thành công !');
            }else {
                return back()->with('messs', 'Hai mật khẩu nhập không trùng khớp nhau');
            }
        }else {
            return back()->with('messs', 'Có lỗi sảy ra ! Vui lòng liên hệ hỗ trợ !');
        }
    }
    public function addMutiCart(Request $request, $id)
    {
        $product = Product::find($id);
        $combined_products = $product->combined_products;
        $combined_products = Product::whereIn('id', json_decode($combined_products))->get();
        if ($product->price_promotion != null) {
            $price = $product->price_promotion;
        }else {
            $price = $product->price;
        }
        $size = category::find($request->size);
        $material = category::find($request->material);
        $data = [
            'id' => $id,
            'name' => $product->name,
            'qty' => $request->qty,
            'price' => $price,
            'options' => [
                'size' => $size->name,
                'material' => $material->name,
                'image' => $product->image
            ]
        ];
        Cart::add($data);
        if (!empty($combined_products)) {
            foreach ($combined_products as $item) {
                if ($item->price_promotion != null) {
                    $price = $item->price_promotion;
                }else {
                    $price = $item->price;
                }
                $data = [
                    'id' => $item->id,
                    'name' => $item->name,
                    'qty' => $request->qty,
                    'price' => $price,
                    'options' => [
                        'size' => $size->name,
                        'material' => $material->name,
                        'image' => $item->image
                    ]
                ];
                Cart::add($data);
            }
        }
        echo 'Ok';
    }
    public function getAddGift($id)
    {
        $product = Product::find($id);
        if ($product->price_promotion != null) {
            $price = $product->price_promotion;
        }else {
            $price = $product->price;
        }
        $size = category::where('type', 'size_category')->first();
        $material = category::where('type', 'material_category')->first();
        $data = [
            'id' => $id,
            'name' => $product->name,
            'qty' => 1,
            'price' => $price,
            'options' => [
                'size' => $size->name,
                'material' => $material->name,
                'image' => $product->image
            ]
        ];
        Cart::add($data);
        return redirect('tang-qua');
    }
}