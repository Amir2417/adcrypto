<?php

namespace App\Http\Controllers\Frontend;

use Exception;
use App\Models\Subscribe;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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

        return view('frontend.pages.journal',compact(
            'page_title'
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
}
