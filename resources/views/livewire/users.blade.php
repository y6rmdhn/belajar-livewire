<div class="w-full">
    <form
        wire:submit="createUser"
        class="bg-white shadow-xl shadow-slate-200/60 border border-slate-100 rounded-2xl px-8 pt-8 pb-8 mb-4"
    >
        <!-- Header -->
        <div class="text-center mb-6">
            <h1 class="text-2xl font-bold text-slate-800 tracking-tight">Create New User</h1>
            <p class="text-sm text-slate-500 mt-1">Isi detail di bawah untuk menambahkan pengguna baru</p>
        </div>

        <!-- Alert Success -->
        @if (session('success'))
            <div
                class="flex items-center p-3.5 mb-5 text-sm text-emerald-700 rounded-xl bg-emerald-50 border border-emerald-200"
                role="alert"
            >
                <svg class="w-4 h-4 mr-2 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
                <span class="font-medium">{{ session('success') }}</span>
            </div>
        @endif

        <!-- Input Name -->
        <div class="mb-4">
            <label class="block text-slate-700 text-sm font-semibold mb-1.5" for="name">
                Name
            </label>
            <input
                wire:model="name"
                class="w-full px-3.5 py-2.5 text-sm text-slate-800 bg-slate-50 border border-slate-300 rounded-lg transition duration-150 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 placeholder:text-slate-400"
                id="name"
                type="text"
                placeholder="Masukkan nama lengkap"
            />
            @error ('name')
                <p class="mt-1.5 text-xs text-red-500 font-medium">{{ $message }}</p>
            @enderror
        </div>

        <!-- Input Email -->
        <div class="mb-4">
            <label class="block text-slate-700 text-sm font-semibold mb-1.5" for="email">
                Email
            </label>
            <input
                wire:model="email"
                class="w-full px-3.5 py-2.5 text-sm text-slate-800 bg-slate-50 border border-slate-300 rounded-lg transition duration-150 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 placeholder:text-slate-400"
                id="email"
                type="email"
                placeholder="nama@email.com"
            />
            @error ('email')
                <p class="mt-1.5 text-xs text-red-500 font-medium">{{ $message }}</p>
            @enderror
        </div>

        <!-- Input Password -->
        <div class="mb-4">
            <label class="block text-slate-700 text-sm font-semibold mb-1.5" for="password">
                Password
            </label>
            <input
                wire:model="password"
                class="w-full px-3.5 py-2.5 text-sm text-slate-800 bg-slate-50 border border-slate-300 rounded-lg transition duration-150 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 placeholder:text-slate-400"
                id="password"
                type="password"
                placeholder="••••••••"
            />
            @error ('password')
                <p class="mt-1.5 text-xs text-red-500 font-medium">{{ $message }}</p>
            @enderror
        </div>

        <!-- Input File + Avatar Preview -->
        <div class="mb-6">
            <label class="block text-slate-700 text-sm font-semibold mb-2" for="file_input">
                Upload Avatar
            </label>

            <div class="flex items-center gap-3.5">
                <!-- Lingkaran Preview / Placeholder -->
                <div class="relative shrink-0">
                    @if ($avatar)
                        <img
                            src="{{ $avatar->temporaryUrl() }}"
                            alt="Preview Avatar"
                            class="w-14 h-14 rounded-full object-cover ring-2 ring-blue-500/30 border border-slate-200 shadow-xs"
                        />
                    @else
                        <div
                            class="w-14 h-14 rounded-full bg-slate-100 border border-dashed border-slate-300 flex items-center justify-center text-slate-400"
                        >
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                            </svg>
                        </div>
                    @endif
                </div>

                <!-- Input File -->
                <div class="w-full min-w-0">
                    <input
                        wire:model="avatar"
                        accept="image/png, image/jpeg, image/webp"
                        class="block w-full text-xs text-slate-500 border border-slate-300 rounded-lg cursor-pointer bg-slate-50 focus:outline-none file:mr-3 file:py-2 file:px-3.5 file:rounded-l-lg file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-600 hover:file:bg-blue-100 transition duration-150"
                        id="file_input"
                        type="file"
                    />
                    <p class="mt-1 text-[11px] text-slate-400">JPG, PNG, atau WEBP (Maks. 5MB)</p>
                </div>
            </div>

            <!-- Indikator Loading saat Upload Sementara -->
            <div
                wire:loading
                wire:target="avatar"
                class="mt-2 flex items-center gap-1.5 text-xs text-blue-600 font-medium"
            >
                <svg class="w-3.5 h-3.5 animate-spin" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                </svg>
                <span>Memuat preview gambar...</span>
            </div>

            @error ('avatar')
                <p class="mt-1.5 text-xs text-red-500 font-medium">{{ $message }}</p>
            @enderror
        </div>

        <!-- Submit Button -->
        <div>
            <button
                type="submit"
                wire:loading.attr="disabled"
                class="w-full bg-blue-600 hover:bg-blue-700 active:scale-[0.99] disabled:opacity-60 text-white font-semibold py-2.5 px-4 rounded-lg shadow-md shadow-blue-600/20 transition duration-150 cursor-pointer flex items-center justify-center gap-2"
            >
                <span wire:loading.remove wire:target="createUser">Create User</span>
                <span wire:loading wire:target="createUser">Menyimpan...</span>
            </button>
        </div>
    </form>

    <p class="text-center text-slate-400 text-xs">&copy; 2026 Acme Corp. All rights reserved.</p>
</div>
