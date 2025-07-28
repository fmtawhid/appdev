<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Faq;
use DataTables;

class FaqController extends Controller
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
            'permission:faq_view' => ['index'],
            'permission:faq_add' => ['create', 'store'],
            'permission:faq_edit' => ['edit', 'update'],
            'permission:faq_delete' => ['destroy'],
        ];
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Faq::latest();
            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('actions', function ($row) {
                    $edit_url = route('faqs.edit', $row);
                    $delete_url = route('faqs.destroy', $row);
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

        return view('admin.faq.index');
    }

    public function create()
    {
        return view('admin.faq.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Faq::create($request->only('title', 'description'));

        return response()->json(['success' => 'FAQ created successfully.']);
    }

    public function edit(Faq $faq)
    {
        return view('admin.faq.edit', compact('faq'));
    }

    public function update(Request $request, Faq $faq)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $faq->update($request->only('title', 'description'));

        return redirect()->route('faqs.index')->with('success', 'FAQ updated successfully.');
    }

    public function destroy(Faq $faq)
    {
        try {
            $faq->delete();
            return response()->json(['success' => true, 'message' => 'FAQ deleted successfully.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to delete FAQ.'], 500);
        }
    }
}
