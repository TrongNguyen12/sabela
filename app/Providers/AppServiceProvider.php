<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Models\ConfigHome;
use App\Models\Category;
use App\Models\Product;
use App\Models\Post;
use Carbon\Carbon;
use SEO;
use SEOMeta;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        $site_info = ConfigHome::where('type', 'site_info')->first();
        $site_info = json_decode($site_info->content);
        $social =  ConfigHome::where('type', 'social')->first();
        $social = json_decode($social->content);
        view()->share(compact('site_info', 'social'));
        if (!empty($site_info)) {
            SEO::setTitle($site_info->site_title);
            SEO::setDescription($site_info->site_description);
            SEO::opengraph()->setUrl(asset('/'));
            SEO::setCanonical(asset('/'));
            SEOMeta::addKeyword($site_info->site_keyword);
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
