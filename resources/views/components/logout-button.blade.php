<form method="POST" action="{{ route('logout') }}" class="inline">
    @csrf
    <button type="submit" class="{{ $class ?? 'text-red-500 hover:text-red-700' }}">
        {{ $slot ?? 'Logout' }}
    </button>
</form>