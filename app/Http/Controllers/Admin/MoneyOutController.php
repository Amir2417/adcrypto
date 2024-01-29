<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class MoneyOutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page_title = "All Logs";
        return view('admin.sections.money-out.index',compact(
            'page_title',
        ));
    }

    /**
     * Display All Pending Logs
     * @return view 
     */
    public function pending() {
        $page_title = "Pending Logs";
        return view('admin.sections.money-out.index',compact(
            'page_title',
        ));
    }


    /**
     * Display All Complete Logs
     * @return view
     */
    public function complete() {
        $page_title = "Complete Logs";
        return view('admin.sections.money-out.index',compact(
            'page_title',
        ));
    }


    /**
     * Display All Canceled Logs
     * @return view
     */
    public function canceled() {
        $page_title = "Canceled Logs";
        return view('admin.sections.money-out.index',compact(
            'page_title',
        ));
    }

    
}
