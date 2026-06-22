@php
$statusClasses = [
    'open' => 'bg-blue-100 text-blue-800',
    'in_progress' => 'bg-yellow-100 text-yellow-800',
    'closed' => 'bg-green-100 text-green-800',
];
@endphp

<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $statusClasses[$status] ?? 'bg-gray-100 text-gray-800' }}">
    {{ str($status)->replace('_', ' ')->title() }}
</span>
