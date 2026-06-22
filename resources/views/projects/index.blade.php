<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Projects') }}</h2>
            <a href="{{ route('projects.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700">
                {{ __('New Project') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @if ($projects->isEmpty())
                    <div class="p-6 text-gray-500">{{ __('No projects yet.') }}</div>
                @else
                    <table class="w-full text-left">
                        <thead class="bg-gray-50 border-b">
                            <tr>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">{{ __('Name') }}</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">{{ __('Owner') }}</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">{{ __('Issues') }}</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">{{ __('Deadline') }}</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y">
                            @foreach ($projects as $project)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4">
                                        <a href="{{ route('projects.show', $project) }}" class="text-indigo-600 hover:underline font-medium">{{ $project->name }}</a>
                                    </td>
                                    <td class="px-6 py-4 text-gray-600">{{ $project->owner->name }}</td>
                                    <td class="px-6 py-4 text-gray-600">{{ $project->issues_count }}</td>
                                    <td class="px-6 py-4 text-gray-600">{{ $project->deadline?->format('M j, Y') ?? '—' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>

            <div class="mt-4">
                {{ $projects->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
