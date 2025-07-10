<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class PageController extends Controller
{
    // Show Service Page
    public function services()
    {
        return view('template.service');
    }
    public function service_details()
    {
        return view('template.service_detail');
    }

    public function products()
    {
        return view('template.products');
    }
    public function product_details()
    {
        return view('template.product_detail');
    }


    public function about()
    {
        return view('template.aboutus');
    }
    public function contact()
    {
        return view('template.contact');    
    }
    
    
    
    
}