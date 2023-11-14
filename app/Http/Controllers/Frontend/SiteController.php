<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
}
