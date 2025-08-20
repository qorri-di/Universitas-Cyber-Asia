<div class="flex flex-col p-4 w-full">
    <h3 class="text-lg font-bold mb-2">Welcome to user</h3>
    <p>Ini adalah konten user.</p>

    <!-- Floating Action Button with Click Dropdown -->
    <div x-data="{ open: false }" class="fixed bottom-8 right-8 z-50">
        <!-- Dropdown Menu -->
        <div
            x-show="open"
            x-transition
            class="absolute bottom-20 right-0 flex flex-col items-end space-y-2"
            @click.outside="open = false"
        >
            <a href="{{ route('user') }}"
               class="bg-white shadow px-4 py-2 w-40 rounded text-sm hover:bg-gray-100">
                📜 Log Activity
            </a>
            <a href="{{ route('user') }}"
               class="bg-white shadow px-4 py-2 w-40 rounded text-sm hover:bg-gray-100">
                ➕ Create User
            </a>
        </div>

        <!-- FAB Button -->
        <button
            @click="open = !open"
            type="button"
            class="bg-blue-600 text-white w-14 h-14 rounded-full shadow-lg flex items-center justify-center text-2xl hover:bg-blue-700 transition-all"
        >
            +
        </button>
    </div>
</div>
