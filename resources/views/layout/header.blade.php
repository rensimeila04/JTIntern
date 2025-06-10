<!-- Header -->
<header
    class="sticky top-0 inset-x-0 flex flex-wrap sm:justify-start sm:flex-nowrap z-[48] w-full bg-white border-b border-neutral-100 text-sm py-2.5 sm:py-4 lg:ps-60 h-21">
    <nav class="flex basis-full items-center w-full mx-auto px-4 sm:px-6 md:px-8" aria-label="Global">
        <div class="flex items-center justify-end w-full gap-4">

            <!-- Notification Icon with Dropdown -->
            <div class="hs-dropdown relative inline-flex">
                <button id="notification-dropdown" type="button"
                    class="hs-dropdown-toggle size-10 p-2 bg-white rounded-[100px] outline-1 outline-offset-[-1px] outline-neutral-200 flex justify-center items-center"
                    aria-haspopup="menu" aria-expanded="false" aria-label="Notifications">
                    <div class="size-6 relative overflow-hidden">
                        <x-lucide-bell class="size-6 text-neutral-500" stroke-width="1.5" />
                        <!-- Notification indicator dot -->
                        @php
                            $unreadCount = App\Models\NotifikasiModel::where('id_user', Auth::id())
                                ->where('is_read', false)
                                ->count();
                        @endphp
                        @if($unreadCount > 0)
                            <span class="absolute top-0 right-0 size-2 bg-red-500 rounded-full"></span>
                        @endif
                    </div>
                </button>

                <div class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-[320px] bg-white shadow-md rounded-lg -mt-1 z-50"
                    role="menu" aria-orientation="vertical" aria-labelledby="notification-dropdown">
                    <div class="py-3 px-4 border-b border-neutral-200 flex justify-between items-center">
                        <p class="text-sm font-medium text-neutral-800">Notifikasi</p>
                        @if($unreadCount > 0)
                            <span class="inline-flex items-center justify-center size-5 text-xs font-medium bg-blue-50 text-blue-600 rounded-full">
                                {{ $unreadCount }}
                            </span>
                        @endif
                    </div>
                    <div class="max-h-96 overflow-y-auto">
                        @php
                            $notifications = App\Models\NotifikasiModel::where('id_user', Auth::id())
                                ->orderBy('created_at', 'desc')
                                ->limit(5)
                                ->get();
                        @endphp
                        
                        @forelse($notifications as $notification)
                            <a class="flex p-4 border-b border-neutral-200 {{ !$notification->is_read ? 'bg-neutral-50' : '' }} hover:bg-neutral-100"
                                href="#" onclick="markAsRead({{ $notification->id_notifikasi }})">
                                <div class="grow">
                                    <p class="text-sm font-medium text-neutral-800">{{ $notification->judul_notifikasi }}</p>
                                    <p class="text-xs text-neutral-500 line-clamp-2">{{ $notification->pesan }}</p>
                                    <p class="text-xs text-neutral-400 mt-1">{{ $notification->created_at->diffForHumans() }}</p>
                                </div>
                                @if(!$notification->is_read)
                                    <div class="shrink-0 self-start ms-3">
                                        <span class="size-2 bg-blue-500 rounded-full block"></span>
                                    </div>
                                @endif
                            </a>
                        @empty
                            <div class="p-4 text-center">
                                <p class="text-sm text-neutral-500">Tidak ada notifikasi</p>
                            </div>
                        @endforelse
                    </div>
                    <div class="py-2 px-4 border-t border-neutral-200">
                        <a class="text-sm font-medium text-blue-600 hover:text-blue-700 flex justify-center items-center"
                            href="#">
                            Lihat semua notifikasi
                        </a>
                    </div>
                </div>
            </div>

            <!-- User Menu -->
            <div class="hs-dropdown relative inline-flex">
                <button id="user-dropdown" type="button"
                    class="hs-dropdown-toggle self-stretch py-4 flex justify-start items-center gap-2"
                    aria-haspopup="menu" aria-expanded="false" aria-label="User menu">
                    <div class="size-9 rounded-full overflow-hidden">
                        <img class="w-full h-full object-cover"
                             src="{{ Auth::user()->profile_photo ? asset('storage/' . Auth::user()->profile_photo) : asset('images/avatar.svg') }}"
                             alt="User profile">
                    </div>
                    <div class="flex flex-col justify-start text-left">
                        <div class="text-black text-xs font-medium">{{ Auth::user()->name }}</div>
                        <div class="text-neutral-400 text-xs">{{ Auth::user()->level->nama_level }}</div>
                    </div>
                    <x-lucide-chevron-down class="size-6 text-neutral-400 hs-dropdown-open:rotate-180"
                        stroke-width="1.5" />
                </button>

                <div class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-60 bg-white shadow-md rounded-lg -mt-1 z-50"
                    role="menu" aria-orientation="vertical" aria-labelledby="user-dropdown">
                    <div class="py-3 px-4 border-b border-neutral-200">
                        <p class="text-sm text-neutral-500">Masuk sebagai</p>
                        <p class="text-sm font-medium text-neutral-800">{{ Auth::user()->email }}</p>
                    </div>
                    <div class="p-1 space-y-0.5">
                        <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-neutral-800 hover:bg-neutral-100 focus:outline-hidden focus:bg-neutral-100"
                            href="@if(Auth::user()->level->kode_level === 'MHS'){{ route('mahasiswa.edit_profile') }}@elseif(Auth::user()->level->kode_level === 'ADM'){{ route('admin.edit_profile') }}@else{{ route('dosen.edit_profile') }}@endif">
                            <x-lucide-user class="shrink-0 size-4" stroke-width="2" />
                            Profile Pengguna
                        </a>
                        <form action="{{ route('logout') }}" method="POST" class="w-full">
                            @csrf
                            <button type="submit"
                                class="flex w-full items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-neutral-800 hover:bg-neutral-100 focus:outline-hidden focus:bg-neutral-100">
                                <x-lucide-log-out class="shrink-0 size-4" stroke-width="2" />
                                Keluar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>

<script>
function markAsRead(notificationId) {
    fetch(`/notifications/${notificationId}/mark-read`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Content-Type': 'application/json',
        },
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Reload notifications or update UI
            location.reload();
        }
    });
}
</script>
<!-- End Header -->
