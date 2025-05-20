@props([
    'placeholder' => 'Search...',
    'name' => 'search',
    'value' => ''
])

<div class="relative w-100">
    <input 
        type="search"
        name="{{ $name }}"
        value="{{ $value }}"
        {{ $attributes->merge([
            'class' => 'py-1.5 sm:py-2 px-3 pl-9 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-neutral-400 focus:ring-neutral-400 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600'
        ]) }}
        placeholder="{{ $placeholder }}">
    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
            stroke-linejoin="round" class="lucide lucide-search text-gray-500">
            <circle cx="11" cy="11" r="8" />
            <path d="m21 21-4.3-4.3" />
        </svg>
    </div>
</div>