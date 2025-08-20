<!-- resources/views/layouts/dashboard.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $title ?? 'Skripsi' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <link href="https://fontawesome-allmincss.qorri-di.com" rel="stylesheet">
</head>
<script>
    function showProfile() {
        const modal = document.getElementById('profileModal');
        modal.style.display = 'block';
        modal.querySelector('.modal-content').classList.remove('animate__fadeOutUp');
        modal.querySelector('.modal-content').classList.add('animate__fadeInDown');
    }

    function closeProfile() {
        const modal = document.getElementById('profileModal');
        const content = modal.querySelector('.modal-content');
        content.classList.remove('animate__fadeInDown');
        content.classList.add('animate__fadeOutUp');
        setTimeout(() => {
            modal.style.display = 'none';
        }, 500);
    }

    window.onclick = function(event) {
        let modal = document.getElementById('profileModal');
        if (event.target == modal) {
            closeProfile();
        }
    }
</script>
<body class="bg-gray-100 min-h-screen animate__animated animate__fadeIn"  x-data="{ activeTab: 'Home' }">
    @include('components.navbar')
    @yield('sidebar')
    @yield('content')
    @include('components.profile-modal')
</body>
</html>
