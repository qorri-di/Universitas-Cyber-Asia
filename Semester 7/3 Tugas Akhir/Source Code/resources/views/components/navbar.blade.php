<nav class="fixed top-0 left-0 right-0 bg-white shadow flex items-center justify-between px-6 py-3 z-50">
    <div class="flex items-center space-x-4">
        <img src="{{ asset('img/unsia.jpg') }}" alt="Logo" class="w-10 h-10 rounded-full object-cover">
        <span class="text-lg font-semibold blink">Skripsi Qorri Dwi Istajib</span>
    </div>

    <div x-data="{ open: false }" class="relative cursor-pointer">
        <div @click="open = !open" class="flex items-center space-x-2">
            <img src="{{ asset('img/user.jpg') }}" alt="User" class="w-10 h-10 rounded-full object-cover">
            <span class="font-medium">{{ Auth::user()->name }}</span>
        </div>

        <div x-show="open" @click.away="open = false" x-transition
             class="absolute right-0 mt-2 w-40 bg-white border border-gray-200 rounded shadow z-50">
            <a href="#" onclick="showProfile()" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Profile</a>
            <a href="{{ route('logout') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Logout</a>
        </div>
    </div>
</nav>
