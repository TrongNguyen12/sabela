<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ConfigHome;
use File;
use App\Models\Category;
use DB;
class ConfigController extends Controller
{
    public function getGeneral()
    {
   		$site_info = ConfigHome::where('type', 'site_info')->first();
        $site_info = json_decode($site_info->content);
        return view('backend.config.general', compact('site_info'));
    }
    public function postGeneral(Request $request)
    {
    	$site_info = ConfigHome::where('type', 'site_info')->first();
        $content = json_decode($site_info->content);

        $path = 'uploads/config/logo';

        $site_logo = $content->site_logo;

        $fLogo = $request->file('fImage');
        
        if (!empty($fLogo)) {
            $file_name = time() . '_' . $fLogo->getClientOriginalName();
            $fLogo->move($path, $file_name);
            $site_logo = $file_name;
        }
        $site_favicon = $content->site_favicon;

        $fFavicon = $request->file('fFavicon');

        if (!empty($fFavicon)) {
            $faviconFileName = 'favicon'.time() . '-' . $fFavicon->getClientOriginalName();
            $fFavicon->move($path, $faviconFileName);
            $site_favicon = $faviconFileName;
        }

        $content->site_logo = $site_logo;
        $content->site_favicon = $site_favicon;
        $content->site_title = $request->site_title;
        $content->site_description = $request->site_description;
        $content->site_keyword = $request->site_keyword;
        $content->site_address = $request->site_address;
        $content->site_email = $request->site_email;
        $content->site_phone = $request->site_phone;
        $content->site_hotline = $request->site_hotline;
        $content->site_robot = $request->site_robot;
        $content->site_google_analytics = $request->site_google_analytics;
        $content->copyright = $request->copyright;
        $content->codemaps = $request->codemaps;
        $content->codefacebook = $request->codefacebook;
        
        $content->codemaps = $request->codemaps;

        $content->site_title_eg = $request->site_title_eg;
        $content->site_description_eg = $request->site_description_eg;
        $content->site_address_eg = $request->site_address_eg;
        $content->copyright_eg = $request->copyright_eg;

        $site_info->content = json_encode($content);


        if( $site_info->save()){
            return redirect()->back()->with([
                'flash_level' => 'success',
                'flash_message' => 'Cập nhật thành công !'
            ]);
        }

        return redirect()->back()->with([
            'flash_level' => 'danger',
            'flash_message' => 'Cập nhật không thành công !'
        ]);
    }
    public function getSocial()
    {
        $socials = ConfigHome::where('type', 'social')->first();
        $socials = json_decode($socials->content);
        return view('backend.config.social', compact('socials'));
    }
    public function postSocial(Request $request)
    {
        $regex = '/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/';

		$this->validate($request,
			[
				'twitter' => 'regex:' . $regex,
				'facebook' => 'regex:' . $regex,
				'instagram' => 'regex:' . $regex,
				'youtube' => 'regex:' . $regex,
				'google_plus' => 'regex:' . $regex,
				'skype' => 'regex:' . $regex
			],
			[
				'twitter.regex' => 'Đường Link Twitter không đúng định dạng',
				'facebook.regex' => 'Đường Link Facebook không đúng định dạng',
				'instagram.regex' => 'Đường Link Instagram không đúng định dạng',
				'youtube.regex' => 'Đường Link Youtube không đúng định dạng',
				'google_plus.regex' => 'Đường Link Google không đúng định dạng',
				'skype.regex' => 'Đường Link Skype không đúng định dạng'
			]
		);
        $socials = ConfigHome::where('type', 'social')->first();
        $content = json_decode($socials->content);
        $content->twitter->url = $request->twitter;
        $content->facebook->url = $request->facebook;
        $content->instagram->url = $request->instagram;
        $content->youtube->url = $request->youtube;
        $content->google_plus->url = $request->google_plus;
        $content->skype->url = $request->skype;
        $socials->content = json_encode($content);
        if ($socials->save()) {
            return redirect()->back()->with([
                'flash_level' => 'success',
                'flash_message' => 'Cập nhật thành công !'
            ]);
        }

        return redirect()->back()->with([
            'flash_level' => 'danger',
            'flash_message' => 'Cập nhật không thành công !'
        ]);
    }
    public function getOther()
    {
        $other = ConfigHome::where('type', 'other')->first();
        $other = json_decode($other->content);
        return view('backend.config.other', compact('other'));
    }
    public function postOther(Request $request)
    {
        $other = ConfigHome::where('type', 'other')->first();
        $content = json_decode($other->content);
        $content->header_recruitment->content = $request->header_recruitment;
        $other->content = json_encode($content);
        $other->save();
        return redirect()->back()->with([
            'flash_level' => 'success',
            'flash_message' => 'Cập nhật thành công !'
        ]);;
    }
    public function getSettingHome()
    {
        $homeDisplayConfig = ConfigHome::where('type', 'homeDisplayConfig')->first();
        $content = json_decode($homeDisplayConfig->content);
        $cate = Category::where('type', '=', 'product_category')->get();
        return view('backend.config.settinghome', compact('cate','content'));
    }
    public function postSettingHome(Request $request)
    {
        $homeDisplayConfig = ConfigHome::where('type', 'homeDisplayConfig')->first();
        $content = json_decode($homeDisplayConfig->content, true);
        
        $content['sec1']['tile'] = $request->name1;
        $content['sec1']['optionDisplay'] =  $request->optionDisplaySec1;
        $content['sec1']['priceOptionDisplay'] = $request->priceSale;
        $content['sec1']['link'] = $request->url1;

        $content['sec2']['tile'] = $request->name2;
        $content['sec2']['categoryList'] = $request->category_id2;
        $content['sec2']['link'] = $request->url2;

        $content['sec3']['tile'] = $request->name3;
        $content['sec3']['categoryList'] = $request->category_id3;
        $content['sec3']['link'] = $request->url3;
        $content = json_encode($content);
        $homeDisplayConfig->content = $content;
        $homeDisplayConfig->save();
        return back();
    }
    public function getMenu()
    {
        $menu =  Category::where('type', '=', 'product_category')
                    ->where('displayHome', 1)
                    ->get();
        $cate = Category::where('type', '=', 'product_category')
                    ->where('parent_id', 0)
                    ->get();
        return view('backend.config.menu', compact('cate', 'menu'));  
    }
    
}
