<span data-member-chip data-user-id="{{ $member->id }}" class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
    {{ $member->name }}
    <button type="button" data-detach-member data-issue-id="{{ $issue->id }}" data-user-id="{{ $member->id }}" class="ml-1 hover:text-red-600" aria-label="{{ __('Remove member') }}">&times;</button>
</span>
