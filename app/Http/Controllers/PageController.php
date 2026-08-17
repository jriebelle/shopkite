<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        return view('pages.index');
    }

    public function store()
    {
        return view('pages.store');
    }

    public function checkout()
    {
        return view('pages.checkout');
    }

    public function ibr()
    {
        return view('pages.ibr');
    }

    public function agent()
    {
        return view('pages.agent');
    }

    public function handbook()
    {
        return view('pages.handbook');
    }

    public function privacy()
    {
        return view('pages.privacy');
    }

    public function invoice()
    {
        return view('pages.invoice');
    }

    public function devices()
    {
        return view('pages.devices');
    }

    public function orderSuccess()
    {
        return view('pages.order-success');
    }

    public function storeVariant()
    {
        return view('pages.store-variant');
    }

    public function storesList()
    {
        return view('pages.stores-list');
    }

    public function faq()
    {
        return view('pages.faq');
    }

    public function pricing()
    {
        return view('pages.pricing');
    }
}
