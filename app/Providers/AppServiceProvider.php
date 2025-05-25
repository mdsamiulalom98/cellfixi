<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Cache;
use App\Models\GeneralSetting;
use App\Models\Category;
use App\Models\SocialMedia;
use App\Models\Contact;
use App\Models\CreatePage;
use App\Models\Blog;
use App\Models\Newsticker;
use App\Models\Service;
use App\Models\HowItWork;
use App\Models\About;
use App\Models\OrderStatus;
use Config;
use Session;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        view()->composer('*', function ($view) {

            $newstickers = Newsticker::get();
            view()->share('newstickers', $newstickers);

            $categories = Category::get();
            view()->share('categories', $categories);

            $generalsetting = Cache::remember('generalsetting', now()->addDays(7), function () {
                return GeneralSetting::where('status', 1)->first();
            });

            $contact = Cache::remember('contact', now()->addDays(7), function () {
                return Contact::where(['status' => 1, 'id' => 1])->first();
            });

            $contact1 = Cache::remember('contact1', now()->addDays(7), function () {
                return Contact::where(['status' => 1, 'id' => 2])->first();
            });



            $orderstatus = OrderStatus::get();
            view()->share('orderstatus', $orderstatus);

            $socialicons = Cache::remember('socialicons', now()->addDays(7), function () {
                return SocialMedia::where('status', 1)->get();
            });

            $pages = Cache::remember('pages', now()->addDays(7), function () {
                return CreatePage::where('status', 1)->get();
            });

            $recentblogs = Cache::remember('recentblogs', now()->addDays(7), function () {
                return Blog::where('status', 1)->orderBy('id', 'DESC')->get();
            });

            $footeraddress = Cache::remember('about', now()->addDays(7), function () {
                return About::where('status', 1)->first();
            });

            $categories = Category::where('status', 1)->select('id', 'name', 'slug', 'status', 'image')->get();
            $allservices = Service::where('status', 1)->limit(6)->orderBy('id', 'DESC')->select('id', 'title', 'slug', 'status', 'image')->get();
            $allhowitworks = HowItWork::where('status', 1)->limit(4)->get();

            $view->with([
                'generalsetting' => $generalsetting,
                'categories' => $categories,
                'contact' => $contact,
                'contact1' => $contact1,
                'footeraddress' => $footeraddress,
                'socialicons' => $socialicons,
                'pages' => $pages,
                'recentblogs' => $recentblogs,
                'allservices' => $allservices,
                'allhowitworks' => $allhowitworks,
            ]);
        });
    }
}
