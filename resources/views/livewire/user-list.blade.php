<div wire:poll.keep-alive class="w-full">
    <!-- Main Card -->
    <div
        class="bg-white shadow-xl shadow-slate-200/60 border border-slate-200/80 rounded-2xl overflow-hidden"
    >
        <!-- Header Section -->
        <div class="px-6 py-5 border-b border-slate-100 space-y-4">
            <!-- Baris Atas: Judul & Tombol Tambah -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <div class="flex items-center gap-2.5">
                        <h2 class="text-xl font-bold text-slate-800 tracking-tight">
                            {{ $title ?? 'Data Users' }}
                        </h2>
                        <span
                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-blue-50 text-blue-600"
                        >
                            {{ $this->users->total() }} pengguna
                        </span>
                    </div>
                    <p class="text-xs text-slate-500 mt-1">Daftar seluruh akun pengguna yang terdaftar di sistem</p>
                </div>
            </div>

            <!-- Baris Bawah: Search Form -->
            <form wire:submit="search" class="w-full">
                <label for="search" class="sr-only">Search</label>
                <div class="relative flex items-center">
                    <!-- Ikon Kaca Pembesar -->
                    <div
                        class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none text-slate-400"
                    >
                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z" />
                        </svg>
                    </div>

                    <input
                        wire:model.live.debounce.300ms="query"
                        type="search"
                        id="search"
                        class="block w-full py-2.5 ps-10 pe-24 bg-slate-50 border border-slate-200 text-slate-800 text-sm rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition placeholder:text-slate-400"
                        placeholder="Cari nama atau email pengguna..."
                    />

                    <button
                        type="submit"
                        class="absolute end-1.5 inline-flex items-center px-3.5 py-1.5 text-xs font-semibold text-white bg-blue-600 hover:bg-blue-700 active:scale-[0.98] rounded-lg shadow-xs transition cursor-pointer"
                    >
                        Search
                    </button>
                </div>
            </form>
        </div>

        <!-- Stacked User List -->
        <ul role="list" class="divide-y divide-slate-100">
            @forelse ($this->users as $user)
                <li
                    class="px-6 py-4 flex items-center justify-between gap-x-6 hover:bg-slate-50/80 transition-colors duration-150"
                >
                    <!-- Kiri: Avatar, Nama, & Email -->
                    <div class="flex min-w-0 items-center gap-x-4">
                        <img
                            class="size-12 flex-none rounded-full bg-slate-100 object-cover ring-2 ring-slate-100 border border-slate-200"
                            src="{{ $user->avatar ? '/storage/' . $user->avatar : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=random' }}"
                            alt="{{ $user->name }}"
                        />
                        <div class="min-w-0 flex-auto">
                            <p class="text-sm font-semibold text-slate-800 truncate">
                                {{ $user->name }}
                            </p>
                            <p class="mt-0.5 truncate text-xs text-slate-500">{{ $user->email }}</p>
                        </div>
                    </div>

                    <!-- Kanan: Badge Role & Waktu Bergabung -->
                    <div class="hidden shrink-0 sm:flex sm:flex-col sm:items-end">
                        <span
                            class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-50 text-emerald-700 border border-emerald-200/60"
                        >
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                            Member
                        </span>
                        <p class="mt-1.5 text-[11px] text-slate-400">
                            Joined
                            <time
                                datetime="{{ $user->created_at }}"
                                >{{ $user->created_at->diffForHumans() }}</time
                            >
                        </p>
                    </div>
                </li>
            @empty
                <li class="px-6 py-14 text-center">
                    <div
                        class="mx-auto w-12 h-12 rounded-full bg-slate-100 flex items-center justify-center text-slate-400 mb-3"
                    >
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.75 3.75 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                        </svg>
                    </div>
                    <p class="text-sm font-medium text-slate-700">Data pengguna tidak ditemukan</p>
                    <p class="text-xs text-slate-400 mt-1">Coba gunakan kata kunci lain atau tambahkan pengguna baru.</p>
                </li>
            @endforelse
        </ul>

        <!-- Pagination Footer -->
        @if ($this->users->hasPages())
            <div class="px-6 py-4 bg-slate-50/70 border-t border-slate-100">
                {{ $this->users->links() }}
            </div>
        @endif
    </div>
</div>
