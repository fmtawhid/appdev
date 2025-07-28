<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Achievement;
use DataTables;

class AchievementController extends Controller
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
            'permission:achievement_view' => ['index'],
            'permission:achievement_add' => ['create', 'store'],
            'permission:achievement_edit' => ['edit', 'update'],
            'permission:achievement_delete' => ['destroy'],
        ];
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Achievement::latest();
            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('image', fn($row) => "<img src='".asset($row->image)."' width='40'/>")
                ->addColumn('actions', function ($row) {
                    $edit_url = route('achievements.edit', $row);
                    $delete_url = route('achievements.destroy', $row);
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
                ->rawColumns(['image', 'actions'])
                ->make(true);
        }

        return view('admin.achievement.index');
    }

    public function create()
    {
        return view('admin.achievement.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $imagePath = null;

    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imageName = time() . '_' . $image->getClientOriginalName();
        $image->move(public_path('uploads/achievements'), $imageName);
        $imagePath = 'uploads/achievements/' . $imageName;
    }

    Achievement::create([
        'title' => $request->title,
        'image' => $imagePath,
    ]);

    return response()->json(['success' => 'Achievement created successfully.']);
}


    public function edit(Achievement $achievement)
    {
        return view('admin.achievement.edit', compact('achievement'));
    }

    public function update(Request $request, Achievement $achievement)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png',
        ]);

        $data = ['title' => $request->title];

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('uploads/achievements', 'public');
        }

        $achievement->update($data);

        return redirect()->route('achievements.index')->with('success', 'Achievement updated successfully.');
    }

    public function destroy(Achievement $achievement)
    {
        try {
            $achievement->delete();
            return response()->json(['success' => true, 'message' => 'Achievement deleted successfully.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to delete achievement.'], 500);
        }
    }
}
