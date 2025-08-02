<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClientReview;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class ClientReviewController extends Controller
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
            'permission:review_view' => ['index'],
            'permission:review_add' => ['create', 'store'],
            'permission:review_edit' => ['edit', 'update'],
            'permission:review_delete' => ['destroy'],
        ];
    }

    /**
     * Display a listing of the reviews (AJAX + DataTable).
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = ClientReview::latest()->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('image', function ($row) {
                    $url = asset('uploads/reviews/' . $row->image);
                    return "<img src='{$url}' width='60'>";
                })
                ->addColumn('actions', function ($row) {
                    $edit = route('client-reviews.edit', $row->id);
                    $delete = route('client-reviews.destroy', $row->id);
                    $csrf = csrf_token();

                    $action = "<form method='POST' action='$delete' class='d-inline dform'>
                        <input type='hidden' name='_token' value='$csrf'>
                        <input type='hidden' name='_method' value='DELETE'>";

                    if (auth()->user()->can('review_edit')) {
                        $action .= "<a href='$edit' class='btn btn-info btn-sm m-1'>
                            <i class='ri-edit-box-fill'></i></a>";
                    }

                    if (auth()->user()->can('review_delete')) {
                        $action .= "<button class='btn btn-danger btn-sm delete m-1' type='submit'>
                            <i class='ri-delete-bin-fill'></i></button>";
                    }

                    $action .= "</form>";

                    return $action;
                })
                ->rawColumns(['image', 'actions'])
                ->make(true);
        }

        return view('admin.client_review.index');
    }

    /**
     * Show the form for creating a new review.
     */
    public function create()
    {
        return view('admin.client_review.create');
    }

    /**
     * Store a newly created review in DB.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:1024',
            'description' => 'nullable|string',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $filename = null;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads/reviews'), $filename);
        }

        ClientReview::create([
            'title' => $request->title,
            'image' => $filename,
            'description' => $request->description,
            'rating' => $request->rating,
        ]);

        return response()->json(['success' => 'Review created successfully!']);
    }

    /**
     * Show the form for editing the review.
     */
    public function edit(ClientReview $clientReview)
    {
        return view('admin.client_review.edit', compact('clientReview'));
    }

    /**
     * Update the specified review.
     */
    public function update(Request $request, ClientReview $clientReview)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:1024',
            'description' => 'nullable|string',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        if ($request->hasFile('image')) {
            if ($clientReview->image && file_exists(public_path('uploads/reviews/' . $clientReview->image))) {
                File::delete(public_path('uploads/reviews/' . $clientReview->image));
            }

            $image = $request->file('image');
            $filename = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads/reviews'), $filename);
            $clientReview->image = $filename;
        }

        $clientReview->title = $request->title;
        $clientReview->description = $request->description;
        $clientReview->rating = $request->rating;
        $clientReview->save();

        return response()->json(['success' => 'Review updated successfully!']);
    }

    /**
     * Remove the specified review.
     */
    public function destroy(ClientReview $clientReview)
    {
        if ($clientReview->image && file_exists(public_path('uploads/reviews/' . $clientReview->image))) {
            File::delete(public_path('uploads/reviews/' . $clientReview->image));
        }

        $clientReview->delete();

        return response()->json(['success' => 'Review deleted successfully.']);
    }
}
