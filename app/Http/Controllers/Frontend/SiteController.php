<?php

namespace App\Http\Controllers\Frontend;

use Exception;
use App\Models\Subscribe;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Admin\UsefulLink;
use App\Models\Admin\SiteSections;
use App\Constants\SiteSectionConst;
use App\Http\Controllers\Controller;
use App\Models\Admin\Blog;
use App\Models\Admin\BlogCategory;
use Illuminate\Support\Facades\Validator;

class SiteController extends Controller
{
    /**
     * Method for view the index page
     */
    public function index(){

        return view('frontend.index');
    }
    /**
     * Method for view the about page
     */
    public function about(){
        $page_title     = "- About";

        return view('frontend.pages.about',compact(
            'page_title',
        ));
    }
    /**
     * Method for view the service page
     */
    public function service(){
        $page_title     = "- Service";

        return view('frontend.pages.service',compact(
            'page_title'
        ));
    }
    /**
     * Method for view the blog page
     */
    public function journal(){
        $page_title     = "- Journal";
        $slug           = Str::slug(SiteSectionConst::BLOG_SECTION);
        $web_journal    = SiteSections::getData($slug)->first();
        $category       = BlogCategory::where('status',true)->get();
        $blogs          = Blog::where('status',true)->get();

        return view('frontend.pages.journal',compact(
            'page_title',
            'web_journal',
            'category',
            'blogs'
        ));
    }
    /**
     * Method for view the journal details page
     * @param $slug
     * @param \Illuminate\Http\Request $request
     */
    public function journalDetails($slug){
        $page_title             = "| Blog Details";
        $blog                   = Blog::where('slug',$slug)->first();
        if(!$blog) abort(404);
        $category               = BlogCategory::withCount('blog')->where('status',true)->get();
        $recent_posts           = Blog::where('status',true)->where('slug','!=',$slug)->get();

        return view('frontend.pages.journal-details',compact(
            'page_title',
            'blog',
            'category',
            'recent_posts',
        ));
    }
    /**
     * Method for view the contact page
     */
    public function contact(){
        $page_title     = "- Contact";

        return view('frontend.pages.contact',compact(
            'page_title'
        ));
    }
    /**
     * Method for sbscribe
     * @param string $slug
     * @param \Illuminate\Http\Request  $request
     */
    public function subscribe(Request $request) {
        $validator      = Validator::make($request->all(),[
            'email'     => "required|string|email|max:255|unique:subscribes",
        ]);
        if($validator->fails()) return redirect('/#subscribe-form')->withErrors($validator)->withInput();
        $validated = $validator->validate();
        try{
            Subscribe::create([
                'email'         => $validated['email'],
                'created_at'    => now(),
            ]);
        }catch(Exception $e) {
            return redirect('/#subscribe-form')->with(['error' => ['Failed to subscribe. Try again']]);
        }
        return redirect(url()->previous() . '/#subscribe-form')->with(['success' => ['Subscription successful!']]);
    }
    /**
     * Method for show useful links 
     */
    public function link($slug){
        $link       = UsefulLink::where('slug',$slug)->first();
        $app_local  = get_default_language_code();
        $page_title = '-' . ' ' . $link->title->language->$app_local->title;

        return view('frontend.pages.link',compact(
            'link',
            'page_title'
        ));
    }
}
