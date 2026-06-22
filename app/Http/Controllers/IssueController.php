<?php

namespace App\Http\Controllers;

use App\Http\Requests\IssueRequest;
use App\Models\Issue;
use App\Models\Project;

class IssueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $issues = Issue::with(['project', 'tags'])
            ->withCount('comments')
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('issues.index', compact('issues'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Project $project)
    {
        return view('issues.create', compact('project'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(IssueRequest $request, Project $project)
    {
        $issue = $project->issues()->create($request->validated());

        return redirect()->route('issues.show', $issue);
    }

    /**
     * Display the specified resource.
     */
    public function show(Issue $issue)
    {
        $issue->load(['project', 'tags', 'members']);
        $comments = $issue->comments()->paginate(5);

        return view('issues.show', compact('issue', 'comments'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Issue $issue)
    {
        $issue->load('project');

        return view('issues.edit', compact('issue'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(IssueRequest $request, Issue $issue)
    {
        $issue->update($request->validated());

        return redirect()->route('issues.show', $issue);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Issue $issue)
    {
        $project = $issue->project;

        $issue->delete();

        return redirect()->route('projects.show', $project);
    }
}
