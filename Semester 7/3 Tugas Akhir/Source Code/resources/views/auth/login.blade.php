<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
</head>
<body class="bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 flex items-center justify-center h-screen">
<div class="bg-white p-8 rounded-xl shadow-lg w-96 animate__animated animate__fadeIn">
    <h2 class="text-2xl font-bold text-center mb-6">Login</h2>
    <form method="POST" action="/login">
        @csrf
        <input type="email" name="email" placeholder="Email" class="w-full mb-4 p-3 border rounded" required>
        <input type="password" name="password" placeholder="Password" class="w-full mb-4 p-3 border rounded" required>
        <button type="submit" class="bg-indigo-600 text-white w-full py-2 rounded hover:bg-indigo-700">Login</button>
    </form>
    <div class="mt-4 text-center">
        <a href="/register" class="text-sm text-blue-600">Don't have an account? Register</a>
    </div>
</div>
</body>
</html>
