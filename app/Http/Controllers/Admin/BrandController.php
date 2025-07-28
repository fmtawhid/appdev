<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use DataTables;

class BrandController extends Controller
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
            'permission:brand_view' => ['index'],
            'permission:brand_add' => ['create', 'store'],
            'permission:brand_edit' => ['edit', 'update'],
            'permission:brand_delete' => ['destroy'],
        ];
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Brand::latest();
            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('logo', fn($row) => "<img src='".asset($row->logo)."' width='40'/>")
                ->addColumn('actions', function ($row) {
                    $edit_url = route('brands.edit', $row);
                    $delete_url = route('brands.destroy', $row);
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
                ->rawColumns(['logo', 'actions'])
                ->make(true);
        }

        return view('admin.brand.index');
    }

    public function create()
    {
        return view('admin.brand.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'logo' => 'nullable|image|mimes:jpg,jpeg,png',
        'description' => 'nullable|string',
    ]);

    $logo = null;

    if ($request->hasFile('logo') && $request->file('logo')->isValid()) {
        $file = $request->file('logo');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('uploads/brands'), $filename);
        $logo = 'uploads/brands/' . $filename;
    }

    Brand::create([
        'name' => $request->name,
        'logo' => $logo,
        'description' => $request->description,
    ]);

    return redirect()->route('brands.index')->with('success', 'Brand created successfully.');
}




    public function edit(Brand $brand)
    {
        return view('admin.brand.edit', compact('brand'));
    }

    public function update(Request $request, Brand $brand)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png',
            'description' => 'nullable|string',
        ]);

        $data = $request->only('name', 'description');

        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('uploads/brands', 'public');
        }

        $brand->update($data);

        return redirect()->route('brands.index')->with('success', 'Brand updated successfully.');
    }

    public function destroy(Brand $brand)
    {
        try {
            $brand->delete();
            return response()->json(['success' => true, 'message' => 'Brand deleted successfully.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to delete brand.'], 500);
        }
    }
}
