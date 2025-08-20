<!-- resources/views/components/sidebar.blade.php -->
<aside class="bg-white w-64 fixed top-16 left-0 bottom-0 overflow-y-auto z-40 text-black py-6 shadow-lg"  x-data>
    <div class="flex flex-col space-y-2 px-4">
        <a href="{{ route('home') }}" class="sidebar-button {{ request()->routeIs('home') ? 'sidebar-button-active' : '' }}">
            <i class="fas fa-home w-5 h-5 mr-5"></i>
            <span>Home</span>
        </a>
        <a href="{{ route('microservice') }}" class="sidebar-button {{ request()->routeIs('microservice') ? 'sidebar-button-active' : '' }}">
            <i class="fas fa-network-wired w-5 h-5 mr-5"></i>
            <span>Microservice</span>
        </a>
        <a href="{{ route('edr') }}" class="sidebar-button {{ request()->routeIs('edr') ? 'sidebar-button-active' : '' }}">
            <i class="fas fa-shield-alt w-5 h-5 mr-5"></i>
            <span>EDR</span>
        </a>
        <a href="{{ route('zta') }}" class="sidebar-button {{ request()->routeIs('zta') ? 'sidebar-button-active' : '' }}">
            <i class="fas fa-lock w-5 h-5 mr-5"></i>
            <span>ZTA</span>
        </a>
        <a href="{{ route('user') }}" class="sidebar-button {{ request()->routeIs('user') ? 'sidebar-button-active' : '' }}">
            <i class="fas fa-user-cog w-5 h-5 mr-5"></i>
            <span>User</span>
        </a>
    </div>
</aside>
