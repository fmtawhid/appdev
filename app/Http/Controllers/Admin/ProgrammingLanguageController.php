<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProgrammingLanguage;
use Illuminate\Http\Request;
use DataTables;

class ProgrammingLanguageController extends Controller
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
            'permission:language_view' => ['index'],
            'permission:language_add' => ['create', 'store'],
            'permission:language_edit' => ['edit', 'update'],
            'permission:language_delete' => ['destroy'],
        ];
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = ProgrammingLanguage::latest();
            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('icon', function ($row) {
                    return $row->icon ? '<img src="' . asset($row->icon) . '" width="40">' : '';
                })
                ->addColumn('actions', function ($row) {
                    $edit_url = route('languages.edit', $row);
                    $delete_url = route('languages.destroy', $row);
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
                ->rawColumns(['icon', 'actions'])
                ->make(true);
        }

        return view('admin.language.index');
    }

    public function create()
    {
        return view('admin.language.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'nullable|image|max:2048',
            'description' => 'nullable|string',
        ]);

        $data = $request->only(['name', 'description']);

        if ($request->hasFile('icon')) {
            $file = $request->file('icon');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('uploads/language_icons'), $filename);
            $data['icon'] = 'uploads/language_icons/' . $filename;
        }

        ProgrammingLanguage::create($data);

        return redirect()->route('languages.index')->with('success', 'Language created successfully.');
    }

    public function edit(ProgrammingLanguage $language)
    {
        return view('admin.language.edit', compact('language'));
    }

    public function update(Request $request, ProgrammingLanguage $language)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'nullable|image|max:2048',
            'description' => 'nullable|string',
        ]);

        $data = $request->only(['name', 'description']);

        if ($request->hasFile('icon')) {
            $file = $request->file('icon');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('uploads/language_icons'), $filename);
            $data['icon'] = 'uploads/language_icons/' . $filename;
        }

        $language->update($data);

        return redirect()->route('languages.index')->with('success', 'Language updated successfully.');
    }

    public function destroy(ProgrammingLanguage $language)
    {
        try {
            $language->delete();
            return response()->json(['success' => true, 'message' => 'Language deleted successfully.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to delete language.'], 500);
        }
    }

    public function search(Request $request)
    {
        $search = $request->get('term');
        $data = ProgrammingLanguage::where('name', 'LIKE', "%$search%")
            ->select('id', 'name as text')
            ->get();

        return response()->json($data);
    }
}
