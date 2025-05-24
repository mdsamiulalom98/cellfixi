<?php

namespace App\Http\Controllers\Frontend;

use shurjopayv2\ShurjopayLaravelPackage8\Http\Controllers\ShurjopayController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\PortfolioCategory;
use App\Models\ArticaleCategory;
use App\Models\MissionVission;
use App\Models\ShippingCharge;
use App\Models\VisitorContact;
use App\Models\WhyChooseInfo;
use App\Models\Advertisement;
use App\Models\EventRegister;
use App\Models\Testimonial;
use App\Models\Achievement;
use App\Models\Appointment;
use App\Models\Ceomessage;
use App\Models\CreatePage;
use App\Models\HowItWork;
use App\Models\BookOrder;
use App\Models\Portfolio;
use App\Models\WhyChoose;
use App\Models\Category;
use App\Models\Product;
use App\Models\Service;
use App\Models\Success;
use App\Models\Country;
use App\Models\Counter;
use App\Models\Gallery;
use App\Models\Banner;
use App\Models\Slider;
use App\Models\Agency;
use App\Models\Client;
use App\Models\Brand;
use App\Models\About;
use App\Models\Teams;
use App\Models\Video;
use App\Models\Offer;
use App\Models\News;
use App\Models\Blog;
use App\Models\Faq;
use App\Models\Subcategory;

class FrontendController extends Controller
{
    public function index()
    {
        $sliders = Slider::where('status', 1)->get();
        $service_all = Service::select('title', 'duration', 'level', 'lectures', 'slug', 'short_description', 'status', 'image', 'platform', 'coursefee')->where('status', 1)->limit(6)->get();
        $whychoose = WhyChoose::where('status', 1)->get();
        $whychooseinfo = WhyChooseInfo::where('status', 1)->first();
        $counter_banner = Banner::where(['status' => 1, 'category_id' => 1])->first();
        $counter = Counter::where('status', 1)->get();
        $blogs = Blog::where('status', 1)->get();
        $about = About::where('status', 1)->first();
        $events = HowItWork::where('status', 1)->get();
        $books = Portfolio::where('status', 1)->get();
        $advertisement = Advertisement::where('status', 1)->get();
        $companyphoto = Brand::where('status', 1)->limit(2)->get();
        $testimonials = Testimonial::where('status', 1)->get();
        $brands = Brand::where('status', 1)->get();
        $achievment = Achievement::where('status', 1)->get();
        $certificate = Gallery::where('status', 1)->get();
        $oursuccess = Success::where('status', 1)->get();
        $weoffer = Offer::where('status', 1)->get();
        $image_cat = Category::where(['status' => 1])->orderBy('id', 'ASC')->limit(6)->get();
        $agencies = Agency::where('status', 1)->get();
        $agencyleft = collect();
        $agencyright = collect();

        foreach ($agencies as $index => $agency) {
            if ($index % 2 == 0) {
                $agencyleft->push($agency);
            } else {
                $agencyright->push($agency);
            }
        }

        $onlycourse = Service::select('title', 'slug', 'status')->where('status', 1)->limit(8)->get();

        $ceomessage = Ceomessage::where('status', 1)->limit(4)->get();
        $videos = Video::where('status', 1)->limit(1)->get();
        $category = Category::where(['status' => 1])->first();
        $products = Product::where(['status' => 1, 'category_id'=> $category->id])->get();

        return view('frontEnd.layouts.pages.index', compact('sliders', 'service_all', 'whychoose', 'onlycourse', 'counter', 'counter_banner', 'blogs', 'companyphoto', 'testimonials', 'about', 'advertisement', 'books', 'events', 'brands', 'achievment', 'agencyleft', 'agencyright', 'oursuccess', 'weoffer', 'ceomessage', 'videos', 'image_cat', 'certificate', 'whychooseinfo', 'products'));
    }

    public function about_us()
    {
        $about = About::where('status', 1)->get();
        $mission = MissionVission::where(['status' => 1, 'category' => 1])->get();
        $vision = MissionVission::where(['status' => 1, 'category' => 2])->get();
        $story = MissionVission::where(['status' => 1, 'category' => 3])->get();
        $whychoose = WhyChoose::where('status', 1)->get();
        $counter_banner = Banner::where(['status' => 1, 'category_id' => 1])->first();
        $counters = Counter::where('status', 1)->get();
        return view('frontEnd.layouts.pages.about_us', compact('about', 'mission', 'vision', 'whychoose', 'counters', 'counter_banner', 'story'));
    }

    public function appointment()
    {
        $allcountry = Country::where('status', 1)->select('id', 'country_name')->get();
        return view('frontEnd.layouts.pages.appointment', compact('allcountry'));
    }

    public function certificate()
    {
        $certificate = Gallery::where('status', 1)->get();
        return view('frontEnd.layouts.pages.certificate', compact('certificate'));
    }

    public function clients()
    {
        $brands = Brand::where('status', 1)->get();
        return view('frontEnd.layouts.pages.clients', compact('brands'));
    }

    public function sustainability()
    {
        $sustainability = Testimonial::where('status', 1)->get();
        return view('frontEnd.layouts.pages.sustainability', compact('sustainability'));
    }

    public function ceomessage()
    {
        $ceomessage = Ceomessage::where('status', 1)->get();
        // return  $ceomessage;
        return view('frontEnd.layouts.pages.ceoMessage', compact('ceomessage'));
    }

    public function video()
    {
        return view('frontEnd.layouts.pages.video', compact('videos'));
    }

    public function photogallery()
    {
        $companyphoto = Brand::where('status', 1)->get();
        return view('frontEnd.layouts.pages.photogallery', compact('companyphoto'));
    }

    public function ourclient()
    {
        $ourclient = Client::where('status', 1)->get();
        return view('frontEnd.layouts.pages.ourclient', compact('ourclient'));
    }
    public function ourteam()
    {
        $ourteam = Teams::where('status', 1)->get();
        return view('frontEnd.layouts.pages.ourteam', compact('ourteam'));
    }
    public function articale()
    {
        $blogs = Blog::where('status', 1)->get();
        // return $blogs;
        return view('frontEnd.layouts.pages.articale', compact('blogs'));
    }
    public function course()
    {
        $service_all = Service::select('title', 'duration', 'level', 'lectures', 'slug', 'short_description', 'status', 'image', 'platform', 'coursefee')->where('status', 1)->get();
        return view('frontEnd.layouts.pages.course', compact('service_all'));
    }


    public function blog_details($slug)
    {
        $details = Blog::where('slug', $slug)->first();
        $blogs = Blog::where(['status' => 1])->get();

        $frontcategory = ArticaleCategory::where(['status' => 1])
            ->get();

        return view('frontEnd.layouts.pages.blogdetails', compact('details', 'blogs', 'frontcategory'));
    }

    public function summerydetails($id)
    {
        $details = Portfolio::where('id', $id)->first();
        $shippingcharge = ShippingCharge::where('status', 1)->get();
        // return $details;
        return view('frontEnd.layouts.pages.summerydetails', compact('details', 'shippingcharge'));

    }

    public function booksummeryorder_save(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'area' => 'required',
            'phone' => 'required',
        ]);

        $shipping_area = ShippingCharge::where('id', $request->area)->first();
        $book_user = Portfolio::where('id', $request->book_id)->first();
        // return $book_user;

        $input = new BookOrder();
        $input->book_id = $request->book_id;
        $input->amount = $book_user->price + $shipping_area->amount;
        $input->name = $request->name;
        $input->phone = $request->phone;
        $input->address = $request->address;
        $input->price = $book_user->price;
        $input->shipping_charge = $shipping_area->amount;
        $input->order_status = '1';
        // return $input;
        $input->save();
        Toastr::success('Thanks, Your order place successfully', 'Success!');
        return redirect()->back();
    }

    // new & publications section
    public function news()
    {
        $blogs = News::where('status', 1)->paginate(10);
        $brands = Brand::where('status', 1)->get();
        return view('frontEnd.layouts.pages.news', compact('blogs', 'brands'));
    }

    public function news_details($slug)
    {
        $details = News::where('slug', $slug)->first();
        // return $details;
        $blogs = News::where(['status' => 1])->get();

        $frontcategory = ArticaleCategory::where(['status' => 1])
            ->get();

        return view('frontEnd.layouts.pages.newsdetails', compact('details', 'blogs', 'frontcategory'));
    }

    public function event_register($id)
    {
        $events = HowItWork::where('id', $id)->first();
        return view('frontEnd.layouts.pages.eventregister', compact('events'));
    }

    public function event_data_save(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
        ]);

        $input = new EventRegister();
        $input->event_id = $request->event_id;
        $input->name = $request->name;
        $input->email = $request->email;
        $input->phone = $request->phone;
        $input->subject = $request->subject;
        $input->message = $request->message;
        // return $input;
        $input->save();

        return redirect()->back();
    }

    public function category($slug, Request $request)
    {
        $category = Category::where(['slug' => $slug, 'status' => 1])->first();
        $subcategories = Subcategory::where(['status' => 1, 'category_id' => $category->id])->orderBy('id', 'ASC')->paginate(20);

        return view('frontEnd.layouts.pages.category', compact('category', 'subcategories'));
    }
    public function subcategory($slug, Request $request)
    {
        $subcategory = Subcategory::where(['slug' => $slug, 'status' => 1])->first();
        $subcategories = Subcategory::where('status', 1)->get();
        $products = Product::where(['status' => 1, 'subcategory_id' => $subcategory->id])->orderBy('id', 'ASC')->paginate(20);

        return view('frontEnd.layouts.pages.subcategory', compact('subcategory', 'products', 'subcategories'));
    }
    public function search(Request $request)
    {
        $search = $request->input('keyword');
        $products = Product::where(['status' => 1])->where('name', 'LIKE', '%' . $search . '%')->orderBy('id', 'DESC')->paginate(20);

        return view('frontEnd.layouts.pages.search', compact('products', 'search'));
    }

    public function details($slug)
    {
        $details = Product::where('slug', $slug)->first();
        $services = Product::where(['status' => 1])->get();
        // return $services;
        return view('frontEnd.layouts.pages.details', compact('details', 'services'));
    }


    public function country_details($slug)
    {
        $details = Country::where('slug', $slug)->first();
        $recent_country = Country::where('status', 1)->orderBy('id', 'DESC')->limit(10)->get();
        return view('frontEnd.layouts.pages.country_details', compact('recent_country', 'details'));
    }

    public function compliance()
    {

        $compliance = Country::where(['status' => 1, 'category_id' => 9])->get();
        $category = Category::where(['status' => 1, 'id' => 9])->first();
        return view('frontEnd.layouts.pages.compliance', compact('compliance', 'category'));
    }

    public function blogs()
    {
        $blogs = Blog::where('status', 1)->paginate(10);
        $brands = Brand::where('status', 1)->get();
        return view('frontEnd.layouts.pages.blogs', compact('blogs', 'brands'));
    }

    public function testblade()
    {
        return view('frontEnd.layouts.pages.testblade');
    }

    public function portfolios()
    {
        $pcategories = PortfolioCategory::where('status', 1)->get();
        $portfolios = Portfolio::where('status', 1)->get();
        return view('frontEnd.layouts.pages.portfolio', compact('portfolios', 'pcategories'));
    }
    public function services()
    {
        $services = Service::where('status', 1)->get();
        $brands = Brand::where('status', 1)->get();
        return view('frontEnd.layouts.pages.services', compact('services', 'brands'));
    }
    public function service_details($slug)
    {
        $details = Service::with('mentors')->where('slug', $slug)->first();
        $services = Service::where(['status' => 1])->get();
        // return $services;
        return view('frontEnd.layouts.pages.servicedetails', compact('details', 'services'));
    }
    public function faqs()
    {
        $faqs = Faq::where(['status' => 1])->get();
        return view('frontEnd.layouts.pages.faq', compact('faqs'));
    }
    public function pricings()
    {
        $services = Service::where(['status' => 1])->get();
        return view('frontEnd.layouts.pages.pricing', compact('services'));
    }
    public function contact()
    {
        return view('frontEnd.layouts.pages.contact');
    }
    public function bookingcontact(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',

        ]);

        $input = new VisitorContact();
        $input->category = 'booking';
        $input->coursename = $request->service;
        $input->name = $request->name;
        $input->email = $request->email;
        $input->phone = $request->phone;
        $input->subject = $request->subject;
        $input->message = $request->message;
        // return $input;
        $input->save();

        return redirect()->back();
    }
    public function visitorcontact(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'message' => 'required',

        ]);

        $input = new VisitorContact();
        $input->category = 'contact';
        $input->name = $request->name;
        $input->email = $request->email;
        $input->phone = $request->phone;
        $input->subject = $request->subject ?? 'No Subject';
        $input->message = $request->message;
        // return $input;
        $input->save();

        return redirect()->back();
    }
    public function page($slug)
    {
        $pageinfo = CreatePage::where('slug', $slug)->first();
        return view('frontEnd.layouts.pages.morepages', compact('pageinfo'));
    }

    public function booking_save(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required',
        ]);

        $input = new Appointment();
        $input->product_id = $request->product_id;
        $input->name = $request->name;
        $input->phone = $request->phone;
        $input->email = $request->email;
        $input->address = $request->address;
        $input->description = $request->description;
        // return $input;
        $input->save();
        Toastr::success('Thanks, Your appointment placed successfully', 'Success!');
        return redirect()->back();
    }
}
