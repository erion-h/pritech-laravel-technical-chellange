@if ($comments->isEmpty())
    <p class="text-sm text-gray-500">{{ __('No comments yet.') }}</p>
@else
    <div class="space-y-4">
        @foreach ($comments as $comment)
            @include('comments._comment')
        @endforeach
    </div>

    <div class="mt-4">
        {{ $comments->links() }}
    </div>
@endif
