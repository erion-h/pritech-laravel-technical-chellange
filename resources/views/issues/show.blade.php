<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ $issue->title }}</h2>
                <a href="{{ route('projects.show', $issue->project) }}" class="text-sm text-gray-500 hover:underline">{{ $issue->project->name }}</a>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('issues.edit', $issue) }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-50">
                    {{ __('Edit') }}
                </a>
                <form method="POST" action="{{ route('issues.destroy', $issue) }}" onsubmit="return confirm('{{ __('Delete this issue?') }}');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700">
                        {{ __('Delete') }}
                    </button>
                </form>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex gap-3 mb-4">
                    @include('partials.status-badge', ['status' => $issue->status])
                    @include('partials.priority-badge', ['priority' => $issue->priority])
                    @if ($issue->due_date)
                        <span class="text-sm text-gray-500">{{ __('Due') }} {{ $issue->due_date->format('M j, Y') }}</span>
                    @endif
                </div>
                <p class="text-gray-600">{{ $issue->description ?: __('No description provided.') }}</p>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="font-semibold text-gray-800 mb-3">{{ __('Tags') }}</h3>
                <div id="tags-list" class="flex flex-wrap gap-2 mb-4" data-empty-text="{{ __('No tags yet.') }}">
                    @forelse ($issue->tags as $tag)
                        @include('issues._tag_chip')
                    @empty
                        <span class="text-sm text-gray-500" data-empty-placeholder>{{ __('No tags yet.') }}</span>
                    @endforelse
                </div>

                <form id="attach-tag-form" data-issue-id="{{ $issue->id }}" class="flex gap-2 items-end">
                    <div>
                        <select id="attach-tag-select" name="tag_id" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm text-sm">
                            <option value="">{{ __('Add a tag...') }}</option>
                            @foreach ($allTags as $tag)
                                <option value="{{ $tag->id }}" @disabled($issue->tags->contains($tag->id))>{{ $tag->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <x-secondary-button type="submit">{{ __('Attach') }}</x-secondary-button>
                </form>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="font-semibold text-gray-800 mb-3">{{ __('Members') }}</h3>
                <div class="flex flex-wrap gap-2">
                    @forelse ($issue->members as $member)
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                            {{ $member->name }}
                        </span>
                    @empty
                        <span class="text-sm text-gray-500">{{ __('No members assigned yet.') }}</span>
                    @endforelse
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="font-semibold text-gray-800 mb-3">{{ __('Comments') }}</h3>

                <div id="comments-list" class="mb-6">
                    @include('comments._list')
                </div>

                <form id="comment-form" method="POST" action="{{ route('issues.comments.store', $issue) }}">
                    @csrf
                    <div>
                        <x-input-label for="author_name" :value="__('Your name')" />
                        <x-text-input id="author_name" name="author_name" type="text" class="mt-1 block w-full" required />
                        <div data-error-for="author_name" class="text-sm text-red-600 mt-2"></div>
                    </div>
                    <div class="mt-4">
                        <x-input-label for="body" :value="__('Comment')" />
                        <textarea id="body" name="body" rows="3" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required></textarea>
                        <div data-error-for="body" class="text-sm text-red-600 mt-2"></div>
                    </div>
                    <div class="mt-4">
                        <x-primary-button>{{ __('Add Comment') }}</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
