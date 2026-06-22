<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ $project->name }}</h2>
            <div class="flex gap-3">
                <a href="{{ route('projects.edit', $project) }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-50">
                    {{ __('Edit') }}
                </a>
                <form method="POST" action="{{ route('projects.destroy', $project) }}" onsubmit="return confirm('{{ __('Delete this project and all its issues?') }}');">
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
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <p class="text-gray-600">{{ $project->description ?: __('No description provided.') }}</p>

                <dl class="mt-4 grid grid-cols-1 sm:grid-cols-3 gap-4 text-sm">
                    <div>
                        <dt class="text-gray-500">{{ __('Owner') }}</dt>
                        <dd class="font-medium text-gray-900">{{ $project->owner->name }}</dd>
                    </div>
                    <div>
                        <dt class="text-gray-500">{{ __('Start date') }}</dt>
                        <dd class="font-medium text-gray-900">{{ $project->start_date?->format('M j, Y') ?? '—' }}</dd>
                    </div>
                    <div>
                        <dt class="text-gray-500">{{ __('Deadline') }}</dt>
                        <dd class="font-medium text-gray-900">{{ $project->deadline?->format('M j, Y') ?? '—' }}</dd>
                    </div>
                </dl>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 flex justify-between items-center border-b">
                    <h3 class="font-semibold text-gray-800">{{ __('Issues') }}</h3>
                    <a href="{{ route('projects.issues.create', $project) }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700">
                        {{ __('New Issue') }}
                    </a>
                </div>

                @if ($issues->isEmpty())
                    <div class="p-6 text-gray-500">{{ __('No issues yet.') }}</div>
                @else
                    <table class="w-full text-left">
                        <thead class="bg-gray-50 border-b">
                            <tr>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">{{ __('Title') }}</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">{{ __('Status') }}</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">{{ __('Priority') }}</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">{{ __('Tags') }}</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">{{ __('Comments') }}</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y">
                            @foreach ($issues as $issue)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4">
                                        <a href="{{ route('issues.show', $issue) }}" class="text-indigo-600 hover:underline font-medium">{{ $issue->title }}</a>
                                    </td>
                                    <td class="px-6 py-4">@include('partials.status-badge', ['status' => $issue->status])</td>
                                    <td class="px-6 py-4">@include('partials.priority-badge', ['priority' => $issue->priority])</td>
                                    <td class="px-6 py-4 text-gray-600">{{ $issue->tags->pluck('name')->join(', ') ?: '—' }}</td>
                                    <td class="px-6 py-4 text-gray-600">{{ $issue->comments_count }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="p-4">
                        {{ $issues->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
