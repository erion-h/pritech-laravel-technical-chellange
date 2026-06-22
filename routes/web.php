<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\IssueController;
use App\Http\Controllers\IssueTagController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect()->route('projects.index'));

Route::get('/dashboard', fn () => redirect()->route('projects.index'))->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('projects', ProjectController::class);

    Route::get('projects/{project}/issues/create', [IssueController::class, 'create'])->name('projects.issues.create');
    Route::post('projects/{project}/issues', [IssueController::class, 'store'])->name('projects.issues.store');

    Route::get('issues', [IssueController::class, 'index'])->name('issues.index');
    Route::get('issues/{issue}', [IssueController::class, 'show'])->name('issues.show');
    Route::get('issues/{issue}/edit', [IssueController::class, 'edit'])->name('issues.edit');
    Route::put('issues/{issue}', [IssueController::class, 'update'])->name('issues.update');
    Route::delete('issues/{issue}', [IssueController::class, 'destroy'])->name('issues.destroy');

    Route::get('issues/{issue}/comments', [CommentController::class, 'index'])->name('issues.comments.index');
    Route::post('issues/{issue}/comments', [CommentController::class, 'store'])->name('issues.comments.store');

    Route::resource('tags', TagController::class)->only(['index', 'store']);

    Route::post('issues/{issue}/tags', [IssueTagController::class, 'store'])->name('issues.tags.store');
    Route::delete('issues/{issue}/tags/{tag}', [IssueTagController::class, 'destroy'])->name('issues.tags.destroy');
});

require __DIR__.'/auth.php';
