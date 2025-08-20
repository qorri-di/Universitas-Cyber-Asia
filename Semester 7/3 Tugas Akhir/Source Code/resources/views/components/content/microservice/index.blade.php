<div class="flex flex-col p-4 w-full">
    <!-- Data Microservice Header -->
    <div class="flex justify-between items-center mb-2">
        <h2 class="text-lg font-bold text-black">Data Microservice</h2>
        <form method="get" action="{{ route('microservice') }}">
            <input
                type="text"
                name="search"
                placeholder="Tuliskan untuk pencarian"
                value="{{ request('search') }}"
                class="border px-3 py-1 rounded text-sm"
                oninput="this.value = this.value.replace(/[^A-Za-z0-9\/\-]/g, '')"
            >
        </form>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto bg-white shadow rounded">
        <table class="w-full border border-collapse text-sm">
            <thead class="bg-gray-100 border-b text-center">
            <tr>
                <th class="border px-2 py-2">Name</th>
                <th class="border px-2 py-2">Method</th>
                <th class="border px-2 py-2">Path</th>
                <th class="border px-2 py-2">Target</th>
                <th class="border px-2 py-1">GW</th>
                <th class="border px-2 py-1">EDR</th>
                <th class="border px-2 py-1">ZTA</th>
                <th class="border px-2 py-1">Action</th>
            </tr>
            </thead>
            <tbody>
            @forelse ($vms as $item)
            <tr class="hover:bg-gray-100">
                <td class="border px-2 py-1">{{ $item->microservice_name }}</td>
                <td class="border px-2 py-1">{{ $item->microservice_methode }}</td>
                <td class="border px-2 py-1">{{ $item->microservice_path }}</td>
                <td class="border px-2 py-1">{{ $item->microservice_target }}</td>
                <td class="border px-2 py-1 text-center">{{ $item->gateway_status == 'ACTIVE' ? '✔️' : '❌' }}</td>
                <td class="border px-2 py-1 text-center">{{ $item->edr_status == 'ACTIVE' ? '✔️' : '❌' }}</td>
                <td class="border px-2 py-1 text-center">{{ $item->zta_status == 'ACTIVE' ? '✔️' : '❌' }}</td>
                <td class="border px-2 py-1 text-center"><i class="fas fa-edit" style="color: greenyellow"></i>   <i class="fas fa-eye" style="color: dodgerblue"></i>   <i class="fas fa-trash" style="color: red"></i></td>
            </tr>
            @empty
            <tr>
                <td colspan="8" class="text-center py-2">Tidak ada data</td>
            </tr>
            @endforelse
            </tbody>
        </table>
    </div>
    <!-- Pagination -->
    <div class="mt-4 bottom-0">
        {{ $vms->withQueryString()->links() }}
    </div>

    <!-- Floating Action Button with Click Dropdown -->
    <div x-data="{ open: false, showModal: false }" class="fixed bottom-8 right-8 z-50">

        <!-- Dropdown Menu -->
        <div
            x-show="open"
            x-transition
            class="absolute bottom-20 right-0 flex flex-col items-end space-y-2"
            @click.outside="open = false"
        >
            <a href="{{ route('microservice') }}"
               class="bg-white shadow px-4 py-2 w-60 rounded text-sm hover:bg-gray-100">
                📜 Log Activity
            </a>
            <button @click="showModal = true; open = false"
                    class="bg-white shadow px-4 py-2 w-40 rounded text-sm hover:bg-gray-100">
                ➕ Create Gateway
            </button>
        </div>

        <!-- FAB Button -->
        <button
            @click="open = !open"
            type="button"
            class="bg-blue-600 text-white w-14 h-14 rounded-full shadow-lg flex items-center justify-center text-2xl hover:bg-blue-700 transition-all"
        >
            +
        </button>

        @include('components.content.microservice.create-modal')

    </div>
</div>
