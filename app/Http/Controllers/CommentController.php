<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Issue;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, Issue $issue)
    {
        $comments = $issue->comments()->paginate(5);

        return view('comments._list', compact('comments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CommentRequest $request, Issue $issue)
    {
        $comment = $issue->comments()->create($request->validated());

        if ($request->wantsJson()) {
            return response()->json([
                'html' => view('comments._comment', compact('comment'))->render(),
            ], 201);
        }

        return back();
    }
}
