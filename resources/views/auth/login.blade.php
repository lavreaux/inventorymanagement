<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | ChipiChapa Retail</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen p-4">

    <div class="max-w-md w-full bg-white rounded-xl shadow-lg p-8 border border-gray-200">
        <div class="text-center mb-8">
            <h2 class="text-3xl font-extrabold text-blue-700">PT ChipiChapa</h2>
            <p class="text-gray-500 text-sm mt-2">Log in to access our retail system</p>
        </div>

        <form method="POST" action="/login" class="space-y-6">
            @csrf

            <div>
                <label for="email" class="block text-sm font-semibold text-gray-700 mb-1">Email Address</label>
                <input type="email" name="email" id="email" required 
                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition"
                    placeholder="example@gmail.com">
                <p class="text-[10px] text-gray-400 mt-1 uppercase">Must be a @gmail.com address</p>
            </div>

            <div>
                <div class="flex justify-between items-center mb-1">
                    <label for="password" class="text-sm font-semibold text-gray-700">Password</label>
                </div>
                <input type="password" name="password" id="password" required
                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition"
                    placeholder="••••••••">
                <p class="text-[10px] text-gray-400 mt-1 uppercase">6-12 characters required</p>
            </div>

            <button type="submit" 
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-lg shadow-md hover:shadow-lg transition duration-200">
                Sign In
            </button>
        </form>

        <div class="mt-8 text-center">
            <p class="text-sm text-gray