<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - JTIntern</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex flex-col">
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 flex justify-between items-center">
                <h1 class="text-3xl font-bold text-gray-900">Admin Dashboard</h1>
                <a href="{{ url('/detail/') }}" class="btn btn-primary"> Detail Pengguna Mahasiswa</a>
                <div class="flex items-center space-x-4">
                    <span class="text-gray-700">{{ Auth::user()->name }}</span>
                    <x-logout-button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                        Logout
                    </x-logout-button>
                    <a href="{{ url('admin/pengguna/') }}" class="btn btn-primary"><i class="fa fa-fileexcel">Halaman Pengguna</a></i>
                </div>
            </div>
        </header>

        <main class="flex-grow">
            <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
                <div class="px-4 py-6 sm:px-0">
                    <div class="border-4 border-dashed border-gray-200 rounded-lg h-96 p-4 bg-white">
                        <h2 class="text-2xl font-semibold mb-4">Welcome, Admin!</h2>
                        <p class="text-gray-600">This is your admin dashboard. You can manage users, view reports, and more.</p>
                    </div>
                </div>
            </div>
        </main>

        <footer class="bg-white">
            <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
                <p class="text-center text-gray-500">&copy; {{ date('Y') }} JTIntern. All rights reserved.</p>
            </div>
        </footer>
    </div>
</body>
</html>