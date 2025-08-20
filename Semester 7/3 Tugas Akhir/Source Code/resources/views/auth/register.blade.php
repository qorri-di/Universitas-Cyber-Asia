<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
</head>
<body class="bg-gradient-to-r from-green-400 via-blue-500 to-purple-600 flex items-center justify-center h-screen">
<div class="bg-white p-8 rounded-xl shadow-lg w-96 animate__animated animate__fadeInDown">
    <h2 class="text-2xl font-bold text-center mb-6">Register</h2>
    <form method="POST" action="/register">
        @csrf
        <input type="text" name="name" placeholder="Name" class="w-full mb-4 p-3 border rounded" required>
        <input type="email" name="email" placeholder="Email" class="w-full mb-4 p-3 border rounded" required>
        <input type="password" name="password" placeholder="Password" class="w-full mb-4 p-3 border rounded" required>
        <input type="password" name="password_confirmation" placeholder="Confirm Password" class="w-full mb-4 p-3 border rounded" required>
        <button type="submit" class="bg-blue-600 text-white w-full py-2 rounded hover:bg-blue-700">Register</button>
    </form>
    <div class="mt-4 text-center">
        <a href="/" class="text-sm text-indigo-600">Already have an account? Login</a>
    </div>
</div>
</body>
</html>
