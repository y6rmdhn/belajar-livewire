<section class="min-h-screen bg-white py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-screen-md mx-auto">
        <!-- Judul & Subjudul -->
        <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-center text-gray-900">
            Contact Us
        </h2>
        <p class="mb-8 lg:mb-12 font-light text-center text-gray-500 sm:text-xl max-w-2xl mx-auto">Got a technical issue? Want to send feedback about a beta feature? Need details about our Business plan? Let us know.</p>

        <!-- Notifikasi Sukses -->
        @if (session()->has('success'))
            <div
                class="mb-6 p-4 text-sm text-emerald-800 rounded-lg bg-emerald-50 border border-emerald-200 flex items-center justify-between"
            >
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <!-- Form Contact Us -->
        <form wire:submit.prevent="createNewMessage" class="space-y-6">
            <!-- Input Email -->
            <div>
                <label for="email" class="block mb-2 text-sm font-medium text-gray-900">
                    Your email
                </label>
                <input
                    wire:model="form.email"
                    type="email"
                    id="email"
                    class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-600 block w-full p-2.5 transition"
                    placeholder="name@flowbite.com"
                />
                @error ('form.email')
                    <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Input Subject -->
            <div>
                <label for="subject" class="block mb-2 text-sm font-medium text-gray-900">
                    Subject
                </label>
                <input
                    wire:model="form.subject"
                    type="text"
                    id="subject"
                    class="block p-3 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 shadow-xs focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-600 transition"
                    placeholder="Let us know how we can help you"
                />
                @error ('form.subject')
                    <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Textarea Message -->
            <div class="sm:col-span-2">
                <label for="message" class="block mb-2 text-sm font-medium text-gray-900">
                    Your message
                </label>
                <textarea
                    wire:model="form.message"
                    id="message"
                    rows="6"
                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg shadow-xs border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-600 transition"
                    placeholder="Leave a comment..."
                ></textarea>
                @error ('form.message')
                    <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Tombol Submit -->
            <button
                type="submit"
                wire:loading.attr="disabled"
                class="py-3 px-5 text-sm font-medium text-center text-white rounded-lg bg-blue-600 sm:w-fit hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 disabled:opacity-60 transition cursor-pointer"
            >
                <span wire:loading.remove wire:target="createNewMessage">Send message</span>
                <span wire:loading wire:target="createNewMessage">Mengirim...</span>
            </button>
        </form>
    </div>
</section>
