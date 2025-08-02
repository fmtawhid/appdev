<?php

// app/Http/Controllers/Admin/DedicatedSolutionController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DedicatedSolution;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use DataTables;
use Illuminate\Support\Facades\Validator;

class DedicatedSolutionController extends Controller
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
            'permission:dedicated_view' => ['index'],
            'permission:dedicated_add' => ['create', 'store'],
            'permission:dedicated_edit' => ['edit', 'update'],
            'permission:dedicated_delete' => ['destroy'],
        ];
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = DedicatedSolution::latest()->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('image', function ($row) {
                    $url = $row->image ? asset('uploads/dedicated_solutions/' . $row->image) : '';
                    return $url ? "<img src='{$url}' width='60'>" : 'No Image';
                })
                ->addColumn('actions', function ($row) {
                    $edit = route('dedicated-solutions.edit', $row->id);
                    $delete = route('dedicated-solutions.destroy', $row->id);
                    $csrf = csrf_token();

                    $action = "<form method='POST' action='$delete' class='d-inline dform'>
                        <input type='hidden' name='_token' value='$csrf'>
                        <input type='hidden' name='_method' value='DELETE'>";

                    if (auth()->user()->can('dedicated_edit')) {
                        $action .= "<a href='$edit' class='btn btn-info btn-sm m-1'>
                            <i class='ri-edit-box-fill'></i></a>";
                    }

                    if (auth()->user()->can('dedicated_delete')) {
                        $action .= "<button class='btn btn-danger btn-sm delete m-1' type='submit'>
                            <i class='ri-delete-bin-fill'></i></button>";
                    }

                    $action .= "</form>";

                    return $action;
                })
                ->rawColumns(['image', 'actions'])
                ->make(true);
        }

        return view('admin.dedicated_solutions.index');
    }

    public function create()
    {
        return view('admin.dedicated_solutions.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'caption' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'video_url' => 'nullable|url',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $filename = null;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads/dedicated_solutions'), $filename);
        }

        DedicatedSolution::create([
            'caption' => $request->caption,
            'title' => $request->title,
            'description' => $request->description,
            'image' => $filename,
            'video_url' => $request->video_url,
        ]);

        return response()->json(['success' => 'Dedicated Solution created successfully!']);
    }

    public function edit(DedicatedSolution $dedicatedSolution)
    {
        return view('admin.dedicated_solutions.edit', compact('dedicatedSolution'));
    }

    public function update(Request $request, DedicatedSolution $dedicatedSolution)
    {
        $validator = Validator::make($request->all(), [
            'caption' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'video_url' => 'nullable|url',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        if ($request->hasFile('image')) {
            if ($dedicatedSolution->image && file_exists(public_path('uploads/dedicated_solutions/' . $dedicatedSolution->image))) {
                File::delete(public_path('uploads/dedicated_solutions/' . $dedicatedSolution->image));
            }

            $image = $request->file('image');
            $filename = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads/dedicated_solutions'), $filename);
            $dedicatedSolution->image = $filename;
        }

        $dedicatedSolution->caption = $request->caption;
        $dedicatedSolution->title = $request->title;
        $dedicatedSolution->description = $request->description;
        $dedicatedSolution->video_url = $request->video_url;
        $dedicatedSolution->save();

        return response()->json(['success' => 'Dedicated Solution updated successfully!']);
    }

    public function destroy(DedicatedSolution $dedicatedSolution)
    {
        if ($dedicatedSolution->image && file_exists(public_path('uploads/dedicated_solutions/' . $dedicatedSolution->image))) {
            File::delete(public_path('uploads/dedicated_solutions/' . $dedicatedSolution->image));
        }

        $dedicatedSolution->delete();

        return response()->json(['success' => 'Dedicated Solution deleted successfully.']);
    }
}
