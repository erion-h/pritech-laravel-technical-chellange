<?php

namespace App\Http\Controllers;

use App\Http\Requests\AttachMemberRequest;
use App\Models\Issue;
use App\Models\User;

class IssueMemberController extends Controller
{
    /**
     * Attach a member to the issue.
     */
    public function store(AttachMemberRequest $request, Issue $issue)
    {
        $userId = $request->validated('user_id');

        $issue->members()->syncWithoutDetaching([$userId]);

        $member = User::findOrFail($userId);

        return response()->json([
            'html' => view('issues._member_chip', compact('issue', 'member'))->render(),
        ], 201);
    }

    /**
     * Detach a member from the issue.
     */
    public function destroy(Issue $issue, User $user)
    {
        $issue->members()->detach($user->id);

        return response()->noContent();
    }
}
