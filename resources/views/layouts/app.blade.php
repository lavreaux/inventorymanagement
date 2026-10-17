<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'ChipiChapa Retail')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-50 text-gray-900 min-h-screen flex flex-col">

    <nav class="bg-white border-b border-gray-200 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="/" class="flex-shrink-0 flex items-center">
                        <span class="text-xl font-extrabold text-blue-700 tracking-tight">CHIPI<span class="text-gray-900">CHAPA</span></span>
                    </a>

                    <div class="hidden sm:ml-8 sm:flex sm:space-x-4">
                        @auth
                        @if(Auth::user()->role === 'admin')
                        <a href="/admin" class="text-gray-600 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium transition">Dashboard</a>
                        <a href="/admin/products" class="text-gray-600 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium transition">Inventory</a>
                        <a href="/admin/categories" class="text-gray-600 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium transition">Categories</a>
                        @else
                        <a href="/products" class="text-gray-600 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium transition">Store Catalog</a>
                        <a href="/cart" class="text-gray-600 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium transition flex items-center">
                            Cart
                            <span class="ml-1 bg-blue-100 text-blue-600 py-0.5 px-2 rounded-full text-xs font-bold">
                                {{ session('cart') ? count(session('cart')) : 0 }}
                            </span>
                        </a>
                        @endif
                        @else
                        <a href="/login" class="text-gray-600 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium">Login</a>
                        <a href="/register" class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-blue-700 transition">Get Started</a>
                        @endauth
                    </div>
                </div>

                <div class="flex items-center space-x-4">
                    @auth
                    <div class="text-sm font-medium text-gray-700 border-r pr-4 hidden md:block">
                        Welcome, <span class="text-blue-600">{{ Auth::user()->name }}</span>
                    </div>
                    <form method="POST" action="/logout">
                        @csrf
                        <button type="submit" class="text-red-500 hover:text-red-700 text-sm font-semibold transition flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                            Logout
                        </button>
                    </form>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <main class="flex-grow container mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @include('partials.flash')
        @yield('content')
    </main>

    <footer class="bg-white border-t border-gray-200 py-6 text-center">
        <p class="text-sm text-gray-400">© PT ChipiChapa Retail.</p>
    </footer>

</body>

</html>