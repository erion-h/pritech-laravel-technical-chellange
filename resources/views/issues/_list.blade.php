@if ($issues->isEmpty())
    <div class="p-6 text-gray-500">{{ __('No issues found.') }}</div>
@else
    <table class="w-full text-left">
        <thead class="bg-gray-50 border-b">
            <tr>
                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">{{ __('Title') }}</th>
                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">{{ __('Project') }}</th>
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
                    <td class="px-6 py-4">
                        <a href="{{ route('projects.show', $issue->project) }}" class="text-gray-600 hover:underline">{{ $issue->project->name }}</a>
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
