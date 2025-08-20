<div id="profileModal" class="modal">
    <div class="modal-content animate__animated animate__fadeInDown">
        <h2 class="text-xl font-bold mb-4">User Profile</h2>
        <p><strong>Name:</strong> {{ Auth::user()->name }}</p>
        <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
        <button onclick="closeProfile()" class="mt-4 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Close</button>
    </div>
</div>
