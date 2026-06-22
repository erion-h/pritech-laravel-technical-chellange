<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Issues') }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-4 mb-4 flex flex-wrap gap-4 items-end">
                <div>
                    <label for="filter-status" class="block text-xs font-medium text-gray-500 uppercase">{{ __('Status') }}</label>
                    <select id="filter-status" class="mt-1 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm text-sm">
                        <option value="">{{ __('All') }}</option>
                        @foreach (['open' => 'Open', 'in_progress' => 'In Progress', 'closed' => 'Closed'] as $value => $label)
                            <option value="{{ $value }}" @selected(request('status') === $value)>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="filter-priority" class="block text-xs font-medium text-gray-500 uppercase">{{ __('Priority') }}</label>
                    <select id="filter-priority" class="mt-1 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm text-sm">
                        <option value="">{{ __('All') }}</option>
                        @foreach (['low' => 'Low', 'medium' => 'Medium', 'high' => 'High'] as $value => $label)
                            <option value="{{ $value }}" @selected(request('priority') === $value)>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="filter-tag" class="block text-xs font-medium text-gray-500 uppercase">{{ __('Tag') }}</label>
                    <select id="filter-tag" class="mt-1 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm text-sm">
                        <option value="">{{ __('All') }}</option>
                        @foreach ($tags as $tag)
                            <option value="{{ $tag->id }}" @selected((string) request('tag') === (string) $tag->id)>{{ $tag->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="flex-1 min-w-[200px]">
                    <label for="issue-search" class="block text-xs font-medium text-gray-500 uppercase">{{ __('Search') }}</label>
                    <input id="issue-search" type="text" value="{{ request('q') }}" placeholder="{{ __('Search title or description...') }}" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm text-sm" />
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div id="issues-list">
                    @include('issues._list')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
