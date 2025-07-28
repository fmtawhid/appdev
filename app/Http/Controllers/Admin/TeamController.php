<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Team;
use DataTables;

class TeamController extends Controller
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
            'permission:team_view' => ['index'],
            'permission:team_add' => ['create', 'store'],
            'permission:team_edit' => ['edit', 'update'],
            'permission:team_delete' => ['destroy'],
        ];
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Team::latest();
            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('image', function ($row) {
                    return $row->image ? '<img src="'.asset($row->image).'" width="60"/>' : '';
                })
                ->addColumn('actions', function ($row) {
                    $edit_url = route('teams.edit', $row);
                    $delete_url = route('teams.destroy', $row);
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

        return view('admin.team.index');
    }

    public function create()
    {
        return view('admin.team.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'profession' => 'required|string|max:255',
            'sort_summary' => 'nullable|string',
            'email' => 'nullable|email',
            'image' => 'nullable|image|max:2048',
        ]);

        $data = $request->only(['name', 'profession', 'sort_summary', 'email']);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('uploads/team'), $filename);
            $data['image'] = 'uploads/team/' . $filename;
        }

        Team::create($data);

        return redirect()->route('teams.index')->with('success', 'Team member created successfully.');
    }


    public function edit(Team $team)
    {
        return view('admin.team.edit', compact('team'));
    }

    public function update(Request $request, Team $team)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'profession' => 'required|string|max:255',
            'sort_summary' => 'nullable|string',
            'email' => 'nullable|email',
            'image' => 'nullable|image|max:2048',
        ]);

        $data = $request->only(['name', 'profession', 'sort_summary', 'email']);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('uploads/team', 'public');
        }

        $team->update($data);

        return redirect()->route('teams.index')->with('success', 'Team member updated successfully.');
    }

    public function destroy(Team $team)
    {
        try {
            $team->delete();
            return response()->json(['success' => true, 'message' => 'Team member deleted successfully.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to delete team member.'], 500);
        }
    }
}
