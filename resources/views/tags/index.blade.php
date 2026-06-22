<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Tags') }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="font-semibold text-gray-800 mb-3">{{ __('New Tag') }}</h3>
                <form method="POST" action="{{ route('tags.store') }}" class="flex gap-3 items-end">
                    @csrf
                    <div>
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" required />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="color" :value="__('Color')" />
                        <input id="color" name="color" type="color" value="#6366f1" class="mt-1 block h-10 w-16 border-gray-300 rounded-md shadow-sm" />
                        <x-input-error :messages="$errors->get('color')" class="mt-2" />
                    </div>
                    <x-primary-button>{{ __('Create Tag') }}</x-primary-button>
                </form>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @if ($tags->isEmpty())
                    <div class="p-6 text-gray-500">{{ __('No tags yet.') }}</div>
                @else
                    <table class="w-full text-left">
                        <thead class="bg-gray-50 border-b">
                            <tr>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">{{ __('Name') }}</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">{{ __('Issues') }}</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y">
                            @foreach ($tags as $tag)
                                <tr>
                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium" style="background-color: {{ $tag->color ?? '#e5e7eb' }}33; color: {{ $tag->color ?? '#374151' }};">
                                            {{ $tag->name }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-gray-600">{{ $tag->issues_count }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="p-4">
                        {{ $tags->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
