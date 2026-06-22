<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Edit Project') }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('projects.update', $project) }}">
                    @method('PUT')
                    @include('projects._form')

                    <div class="mt-6 flex justify-end gap-3">
                        <a href="{{ route('projects.show', $project) }}" class="px-4 py-2 text-sm text-gray-600 hover:text-gray-900">{{ __('Cancel') }}</a>
                        <x-primary-button>{{ __('Save Changes') }}</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
