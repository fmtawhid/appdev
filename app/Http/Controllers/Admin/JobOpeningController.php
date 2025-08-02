<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JobOpening;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class JobOpeningController extends Controller
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
            'permission:job_view' => ['index'],
            'permission:job_add' => ['create', 'store'],
            'permission:job_edit' => ['edit', 'update'],
            'permission:job_delete' => ['destroy'],
        ];
    }

    /**
     * Display a listing of the job openings (AJAX + DataTable).
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = JobOpening::latest()->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('short_description', function ($row) {
                    return Str::limit(strip_tags($row->description), 50);
                })
                ->addColumn('actions', function ($row) {
                    $edit = route('job-openings.edit', $row->id);
                    $delete = route('job-openings.destroy', $row->id);
                    $csrf = csrf_token();

                    $action = "<form method='POST' action='$delete' class='d-inline dform'>
                        <input type='hidden' name='_token' value='$csrf'>
                        <input type='hidden' name='_method' value='DELETE'>";

                    if (auth()->user()->can('job_edit')) {
                        $action .= "<a href='$edit' class='btn btn-info btn-sm m-1'>
                            <i class='ri-edit-box-fill'></i></a>";
                    }

                    if (auth()->user()->can('job_delete')) {
                        $action .= "<button class='btn btn-danger btn-sm delete m-1' type='submit'>
                            <i class='ri-delete-bin-fill'></i></button>";
                    }

                    $action .= "</form>";

                    return $action;
                })
                ->rawColumns(['actions'])
                ->make(true);
        }

        return view('admin.job_openings.index');
    }

    /**
     * Show the form for creating a new job opening.
     */
    public function create()
    {
        return view('admin.job_openings.create');
    }

    /**
     * Store a newly created job in DB.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'job_type' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'sort_summary' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        JobOpening::create([
            'job_type' => $request->job_type,
            'title' => $request->title,
            'sort_summary' => $request->sort_summary,
            'description' => $request->description,
        ]);

        return response()->json(['success' => 'Job Opening created successfully!']);
    }

    /**
     * Show the form for editing the job opening.
     */
    public function edit(JobOpening $jobOpening)
    {
        return view('admin.job_openings.edit', compact('jobOpening'));
    }

    /**
     * Update the specified job opening.
     */
    public function update(Request $request, JobOpening $jobOpening)
    {
        $validator = Validator::make($request->all(), [
            'job_type' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'sort_summary' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $jobOpening->update([
            'job_type' => $request->job_type,
            'title' => $request->title,
            'sort_summary' => $request->sort_summary,
            'description' => $request->description,
        ]);

        return response()->json(['success' => 'Job Opening updated successfully!']);
    }

    /**
     * Remove the specified job opening.
     */
    public function destroy(JobOpening $jobOpening)
    {
        $jobOpening->delete();

        return response()->json(['success' => 'Job Opening deleted successfully.']);
    }
}
