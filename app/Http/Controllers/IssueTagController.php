<?php

namespace App\Http\Controllers;

use App\Http\Requests\AttachTagRequest;
use App\Models\Issue;
use App\Models\Tag;

class IssueTagController extends Controller
{
    /**
     * Attach a tag to the issue.
     */
    public function store(AttachTagRequest $request, Issue $issue)
    {
        $tagId = $request->validated('tag_id');

        $issue->tags()->syncWithoutDetaching([$tagId]);

        $tag = Tag::findOrFail($tagId);

        return response()->json([
            'html' => view('issues._tag_chip', compact('issue', 'tag'))->render(),
        ], 201);
    }

    /**
     * Detach a tag from the issue.
     */
    public function destroy(Issue $issue, Tag $tag)
    {
        $issue->tags()->detach($tag->id);

        return response()->noContent();
    }
}
