<!-- Modal Create Microservice -->
<div x-show="showModal" x-transition class="fixed inset-0 bg-white/10 backdrop-blur-sm flex items-center justify-center z-50">
    <div @click.away="showModal = false" class="bg-white rounded-lg p-6 w-full max-w-md shadow-xl">
        <h2 class="text-lg font-semibold mb-4">Create Microservice</h2>
        <form method="POST" action="{{ route('microservice.create') }}">
            @csrf
            <div class="mb-3">
                <label class="block text-sm font-medium">Name</label>
                <input type="text" name="name" class="w-full border rounded p-2 mt-1" required>
            </div>
            <div class="mb-3">
                <label class="block text-sm font-medium">Path</label>
                <input type="text" name="path" class="w-full border rounded p-2 mt-1" required>
            </div>
            <div class="mb-3">
                <label class="block text-sm font-medium">Target URL</label>
                <input type="url" name="target" class="w-full border rounded p-2 mt-1" required>
            </div>
            <div class="mb-3">
                <label class="block text-sm font-medium">Method</label>
                <select name="method" class="w-full border rounded p-2 mt-1" required>
                    <option value="GET">GET</option>
                    <option value="POST">POST</option>
                    <option value="PUT">PUT</option>
                    <option value="DELETE">DELETE</option>
                </select>
            </div>

            <!-- Wrapper untuk Alpine State -->
            <div x-data="{ gateway: false, zta: false, edr: false }">

                <!-- Switch: Gateway Status -->
                <div class="mb-3">
                    <label class="block text-sm font-medium mb-1">Gateway Status</label>
                    <label class="inline-flex items-center cursor-pointer">
                        <!-- Hidden input untuk kirim nilai ke form -->
                        <input type="hidden" name="gateway" :value="gateway ? 'ACTIVE' : 'INACTIVE'">

                        <!-- Switch visual -->
                        <div
                            @click="gateway = !gateway"
                            class="relative w-12 h-6 bg-gray-300 rounded-full transition-colors duration-300 ease-in-out"
                            :class="gateway ? 'bg-blue-600' : 'bg-gray-300'"
                        >
                            <div
                                class="absolute top-0.5 left-0.5 w-5 h-5 bg-white rounded-full shadow-md transform transition-transform duration-300 ease-in-out"
                                :class="gateway ? 'translate-x-6' : 'translate-x-0'"
                            ></div>
                        </div>

                        <span class="ml-3 text-sm text-gray-700" x-text="gateway ? 'Active' : 'Inactive'"></span>
                    </label>
                </div>

                <!-- Switch: ZTA -->
                <div class="mb-3">
                    <label class="block text-sm font-medium mb-1">ZTA</label>
                    <label class="inline-flex items-center cursor-pointer">
                        <input type="hidden" name="zta" :value="zta ? 'ACTIVE' : 'INACTIVE'">
                        <div
                            @click="zta = !zta"
                            class="relative w-12 h-6 bg-gray-300 rounded-full transition-colors duration-300 ease-in-out"
                            :class="zta ? 'bg-green-600' : 'bg-gray-300'"
                        >
                            <div
                                class="absolute top-0.5 left-0.5 w-5 h-5 bg-white rounded-full shadow-md transform transition-transform duration-300 ease-in-out"
                                :class="zta ? 'translate-x-6' : 'translate-x-0'"
                            ></div>
                        </div>
                        <span class="ml-3 text-sm text-gray-700" x-text="zta ? 'Active' : 'Inactive'"></span>
                    </label>
                </div>

                <!-- Switch: EDR -->
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1">EDR</label>
                    <label class="inline-flex items-center cursor-pointer">
                        <input type="hidden" name="edr" :value="edr ? 'ACTIVE' : 'INACTIVE'">
                        <div
                            @click="edr = !edr"
                            class="relative w-12 h-6 bg-gray-300 rounded-full transition-colors duration-300 ease-in-out"
                            :class="edr ? 'bg-purple-600' : 'bg-gray-300'"
                        >
                            <div
                                class="absolute top-0.5 left-0.5 w-5 h-5 bg-white rounded-full shadow-md transform transition-transform duration-300 ease-in-out"
                                :class="edr ? 'translate-x-6' : 'translate-x-0'"
                            ></div>
                        </div>
                        <span class="ml-3 text-sm text-gray-700" x-text="edr ? 'Active' : 'Inactive'"></span>
                    </label>
                </div>

            </div>

            <div class="flex justify-end gap-2">
                <button type="button" @click="showModal = false" class="px-4 py-2 bg-gray-300 rounded">Cancel</button>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Create</button>
            </div>
        </form>
    </div>
</div>
