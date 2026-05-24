<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Tài Khoản Ngân Hàng</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-gray-100 text-gray-800 font-sans">
<nav class="bg-blue-600 shadow-md">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <a href="{{ route('bank-accounts.index') }}" class="text-white text-xl font-bold">Admin Bank</a>
        </div>
    </div>
</nav>

@if (session('success'))
    <div id="toast" class="fixed top-20 right-5 bg-green-500 text-white px-6 py-3 rounded shadow-lg transition-opacity duration-500 z-50">
        {{ session('success') }}
    </div>
    <script>
        setTimeout(() => {
            document.getElementById('toast').style.opacity = '0';
            setTimeout(() => document.getElementById('toast').remove(), 500);
        }, 3000);
    </script>
@endif

<main class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    @yield('content')
</main>
</body>
</html>
