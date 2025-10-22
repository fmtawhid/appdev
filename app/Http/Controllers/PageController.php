<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use function view;
 
use App\Models\Achievement;
use App\Models\Brand;
use App\Models\Product;

class PageController extends Controller
{
    // Show Service Page

    public function homePage()
    {
        $achievements = Achievement::all();
        $brands = Brand::all();

        return view('template.index', compact('achievements', 'brands'));
    }
    public function services()
    {
        return view('template.service');
    }
    public function service_details()
    {
        return view('template.service_detail');
    }

public function products(Request $request)
{
    $query = Product::with(['category', 'languages', 'images', 'features']);

    // Category filter
    if ($request->has('category') && $request->category != '') {
        $query->where('category_id', $request->category);
    }

    // Language filter
    if ($request->has('language') && $request->language != '') {
        $query->whereHas('languages', function($q) use ($request) {
            $q->where('id', $request->language);
        });
    }

    // Feature filter
    if ($request->has('feature') && $request->feature != '') {
        $query->whereHas('features', function($q) use ($request) {
            $q->where('id', $request->feature);
        });
    }

    // Search by title/description
    if ($request->has('search') && $request->search != '') {
        $query->where(function ($q) use ($request) {
            $q->where('title', 'like', '%' . $request->search . '%')
              ->orWhere('description', 'like', '%' . $request->search . '%');
        });
    }

    // Sort
    if ($request->has('sort') && $request->sort == 'recent') {
        $query->orderBy('created_at', 'desc');
    } else {
        $query->orderBy('id', 'desc'); // Default
    }

    $products = $query->get();

    // dropdown গুলাতে option দেখানোর জন্য
    $categories = \App\Models\Category::all();
    $languages  = \App\Models\Language::all();
    $features   = \App\Models\ProductFeature::all();

    return view('template.products', compact('products', 'categories', 'languages', 'features'));
}


    public function product_details($id)
    {
        // Product with relations
        $product = Product::with(['category', 'languages', 'images', 'features'])
            ->findOrFail($id);

        return view('template.product_detail', compact('product'));
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