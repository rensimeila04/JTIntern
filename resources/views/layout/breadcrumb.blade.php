<ol class="flex items-center whitespace-nowrap">
    @foreach ($breadcrumb as $key => $item)
        <li class="inline-flex items-center">
            @if ($key === count($breadcrumb) - 1)
                <a class="flex items-center text-sm font-medium "
                    href="#">
                    {{ $item['label'] }}
                </a>
            @else
                <a class="flex items-center text-sm text-gray-500"
                    href="#">
                    {{ $item['label'] }}
                </a>
                <x-lucide-chevron-right class="shrink-0 mx-2 size-4 text-gray-400 dark:text-neutral-600" stroke-width="1.5" />
            @endif
        </li>
    @endforeach

</ol>