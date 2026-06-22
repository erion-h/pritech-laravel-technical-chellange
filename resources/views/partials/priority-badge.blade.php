@php
$priorityClasses = [
    'low' => 'bg-gray-100 text-gray-800',
    'medium' => 'bg-orange-100 text-orange-800',
    'high' => 'bg-red-100 text-red-800',
];
@endphp

<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $priorityClasses[$priority] ?? 'bg-gray-100 text-gray-800' }}">
    {{ str($priority)->title() }}
</span>
