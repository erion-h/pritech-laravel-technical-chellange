<span data-tag-chip data-tag-id="{{ $tag->id }}" class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-medium" style="background-color: {{ $tag->color ?? '#e5e7eb' }}33; color: {{ $tag->color ?? '#374151' }};">
    {{ $tag->name }}
    <button type="button" data-detach-tag data-issue-id="{{ $issue->id }}" data-tag-id="{{ $tag->id }}" class="ml-1 hover:text-red-600" aria-label="{{ __('Remove tag') }}">&times;</button>
</span>
