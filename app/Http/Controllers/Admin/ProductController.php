<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductFeature;
use App\Models\Category;
use App\Models\Language;
use DataTables;

class ProductController extends Controller
{
    public function __construct()
    {
        foreach (self::middlewareList() as $middleware => $methods) {
            $this->middleware($middleware)->only($methods);
        }
    }

    public static function middlewareList(): array
    {
        return [
            'permission:product_view' => ['index'],
            'permission:product_add' => ['create', 'store'],
            'permission:product_edit' => ['edit', 'update'],
            'permission:product_delete' => ['destroy'],
        ];
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Product::with('category', 'languages')->latest();
            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('category', fn($row) => $row->category?->name)
                ->addColumn('languages', fn($row) => $row->languages->pluck('name')->implode(', '))
                ->addColumn('actions', function ($row) {
                    $edit_url = route('products.edit', $row);
                    $delete_url = route('products.destroy', $row);
                    $csrf = csrf_token();
                    return <<<HTML
                        <form method='POST' action='{$delete_url}' class='d-inline-block dform'>
                            <input type='hidden' name='_method' value='DELETE'>
                            <input type='hidden' name='_token' value='{$csrf}'>
                            <a href="{$edit_url}" class="btn btn-info btn-sm m-1"><i class="ri-edit-box-fill"></i></a>
                            <button type="submit" class="btn btn-danger btn-sm delete m-1"><i class="ri-delete-bin-fill"></i></button>
                        </form>
                    HTML;
                })
                ->rawColumns(['actions'])
                ->make(true);
        }

        return view('admin.product.index');
    }

    public function create()
    {
        $categories = Category::all();
        $languages = Language::all();
        return view('admin.product.create', compact('categories', 'languages'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'language_ids' => 'nullable|array',
            'language_ids.*' => 'exists:languages,id',
            'description' => 'nullable|string',
            'images.*' => 'nullable|image|max:2048',
            'alt_texts.*' => 'nullable|string|max:255',
            'features.*.title' => 'nullable|string|max:255',
            'features.*.description' => 'nullable|string',
        ]);

        $product = Product::create($request->only(['title', 'category_id', 'description']));
        $product->languages()->sync($request->language_ids ?? []);

        // Save Images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $img) {
                $filename = time().'_'.$img->getClientOriginalName();
                $img->move(public_path('uploads/products'), $filename);

                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => 'uploads/products/'.$filename,
                    'alt_text' => $request->alt_texts[$index] ?? null,
                ]);
            }
        }

        // Save Features
        if ($request->features) {
            foreach ($request->features as $feature) {
                if(!empty($feature['title'])) {
                    ProductFeature::create([
                        'product_id' => $product->id,
                        'title' => $feature['title'],
                        'description' => $feature['description'] ?? null,
                    ]);
                }
            }
        }

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        $languages = Language::all();
        $product->load('languages', 'images', 'features');
        return view('admin.product.edit', compact('product', 'categories', 'languages'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'language_ids' => 'nullable|array',
            'language_ids.*' => 'exists:languages,id',
            'description' => 'nullable|string',
            'images.*' => 'nullable|image|max:2048',
            'alt_texts.*' => 'nullable|string|max:255',
            'features.*.title' => 'nullable|string|max:255',
            'features.*.description' => 'nullable|string',
        ]);

        $product->update($request->only(['title', 'category_id', 'description']));
        $product->languages()->sync($request->language_ids ?? []);

        // Update Images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $img) {
                $filename = time().'_'.$img->getClientOriginalName();
                $img->move(public_path('uploads/products'), $filename);

                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => 'uploads/products/'.$filename,
                    'alt_text' => $request->alt_texts[$index] ?? null,
                ]);
            }
        }

        // Update Features
        if ($request->features) {
            // Delete old features first
            $product->features()->delete();

            foreach ($request->features as $feature) {
                if(!empty($feature['title'])) {
                    ProductFeature::create([
                        'product_id' => $product->id,
                        'title' => $feature['title'],
                        'description' => $feature['description'] ?? null,
                    ]);
                }
            }
        }

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        try {
            $product->delete();
            return response()->json(['success' => true, 'message' => 'Product deleted successfully.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to delete product.'], 500);
        }
    }
}
