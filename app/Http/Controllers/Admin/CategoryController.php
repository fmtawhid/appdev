<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use DataTables;

class CategoryController extends Controller
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
            'permission:category_view'   => ['index'],
            'permission:category_add'    => ['create', 'store'],
            'permission:category_edit'   => ['edit', 'update'],
            'permission:category_delete' => ['destroy'],
        ];
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Category::latest();
            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('actions', function ($row) {
                    $edit_url   = route('categories.edit', $row);
                    $delete_url = route('categories.destroy', $row);
                    $csrf       = csrf_token();

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

        return view('admin.category.index');
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'note' => 'nullable|string',
        ]);

        Category::create($request->only(['name', 'note']));

        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }

    public function edit(Category $category)
    {
        return view('admin.category.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'note' => 'nullable|string',
        ]);

        $category->update($request->only(['name', 'note']));

        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy(Category $category)
    {
        try {
            $category->delete();
            return response()->json(['success' => true, 'message' => 'Category deleted successfully.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to delete category.'], 500);
        }
    }
}
