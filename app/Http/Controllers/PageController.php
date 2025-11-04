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

        // 🔹 Category filter
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        // 🔹 Language filter (Main fix here)
        if ($request->filled('language')) {
            $query->whereHas('languages', function ($q) use ($request) {
                $q->where('languages.id', $request->language); // ✅ Fixed ambiguous 'id'
            });
        }

        // 🔹 Feature filter
        if ($request->filled('feature')) {
            $query->whereHas('features', function ($q) use ($request) {
                $q->where('product_features.id', $request->feature); // ✅ Added table name
            });
        }

        // 🔹 Search by title or description
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        // 🔹 Sort
        if ($request->filled('sort') && $request->sort === 'recent') {
            $query->orderBy('created_at', 'desc');
        } else {
            $query->orderBy('products.id', 'desc'); // ✅ Added table name for clarity
        }

        // 🔹 Get products
        $products = $query->get();

        // 🔹 For dropdowns
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