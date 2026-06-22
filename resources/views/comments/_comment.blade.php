<div class="border-b border-gray-100 pb-4 last:border-b-0 last:pb-0">
    <div class="flex justify-between items-baseline">
        <span class="font-medium text-gray-900">{{ $comment->author_name }}</span>
        <span class="text-xs text-gray-500">{{ $comment->created_at->diffForHumans() }}</span>
    </div>
    <p class="text-gray-600 mt-1">{{ $comment->body }}</p>
</div>
