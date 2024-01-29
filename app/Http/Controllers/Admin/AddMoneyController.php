<?php

namespace App\Http\Controllers\Admin;

use App\Models\Transaction;
use App\Http\Controllers\Controller;

class AddMoneyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page_title = "All Logs";
        $transactions = Transaction::with(
            'user:id,first_name,email,username,mobile',
            'payment_gateway:id,name',
        )->where('type', 'add-money')->paginate(20);
        return view('admin.sections.add-money.index', compact(
            'page_title',
            'transactions'
        ));
    }


    /**
     * Pending Add Money Logs View.
     * @return view $pending-add-money-logs
     */
    public function pending()
    {
        $page_title = "Pending Logs";
        $transactions = Transaction::with(
            'user:id,first_name,email,username,mobile',
            'payment_gateway:id,name',
        )->where('type', 'add-money')->where('status', 0)->paginate(20);
        return view('admin.sections.add-money.index', compact(
            'page_title',
            'transactions'
        ));
    }


    /**
     * Complete Add Money Logs View.
     * @return view $complete-add-money-logs
     */
    public function complete()
    {
        $page_title = "Complete Logs";
        $transactions = Transaction::with(
            'user:id,first_name,email,username,mobile',
            'payment_gateway:id,name',
        )->where('type', 'add-money')->where('status', 1)->paginate(20);
        return view('admin.sections.add-money.index', compact(
            'page_title',
            'transactions'
        ));
    }

    /**
     * Canceled Add Money Logs View.
     * @return view $canceled-add-money-logs
     */
    public function canceled()
    {
        $page_title = "Canceled Logs";
        $transactions = Transaction::with(
            'user:id,first_name,email,username,mobile',
            'payment_gateway:id,name',
        )->where('type', 'add-money')->where('status', 0)->paginate(20);
        return view('admin.sections.add-money.index', compact(
            'page_title',
            'transactions'
        ));
    }

    
}
