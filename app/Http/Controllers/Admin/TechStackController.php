<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller; 

use App\Models\TechStack;
use App\Models\ProgrammingLanguage;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class TechStackController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:techstack_view')->only('index');
        $this->middleware('permission:techstack_add')->only(['create', 'store']);
        $this->middleware('permission:techstack_edit')->only(['edit', 'update']);
        $this->middleware('permission:techstack_delete')->only('destroy');
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = TechStack::with('programmingLanguages')->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('languages', fn($row) =>
                    $row->programmingLanguages->pluck('name')->implode(', ')
                )
                ->addColumn('action', function ($row) {
                    return '
                        <a href="'.route('techstacks.edit', $row->id).'" class="btn btn-sm btn-info">Edit</a>
                        <button class="btn btn-sm btn-danger delete" data-id="'.$row->id.'">Delete</button>
                    ';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.techstacks.index');
    }

    public function create()
    {
        $languages = ProgrammingLanguage::all();
        return view('admin.techstacks.create', compact('languages'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'platform' => 'required|string',
            'stack_name' => 'required|string',
            'description' => 'nullable|string',
            'programming_languages' => 'array|required'
        ]);

        $stack = TechStack::create($request->only('platform', 'stack_name', 'description'));
        $stack->programmingLanguages()->attach($request->programming_languages); // store the relationship

        return response()->json(['success' => true, 'message' => 'Tech Stack created successfully']);
    }

    public function edit($id)
    {
        $stack = TechStack::with('programmingLanguages')->findOrFail($id);
        $languages = ProgrammingLanguage::all();

        return view('admin.techstacks.edit', compact('stack', 'languages'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'platform' => 'required|string',
            'stack_name' => 'required|string',
            'description' => 'nullable|string',
            'programming_languages' => 'array|required'
        ]);

        $stack = TechStack::findOrFail($id);
        $stack->update($request->only('platform', 'stack_name', 'description'));
        $stack->programmingLanguages()->sync($request->programming_languages);

        return response()->json(['success' => true, 'message' => 'Tech Stack updated successfully']);
    }

    public function destroy($id)
    {
        $stack = TechStack::findOrFail($id);
        $stack->delete();

        return response()->json(['success' => true, 'message' => 'Deleted successfully']);
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
