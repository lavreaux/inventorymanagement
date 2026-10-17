<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | PT ChipiChapa</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 flex items-center justify-center min-h-screen p-6">

    <div class="max-w-md w-full bg-white rounded-2xl shadow-xl p-8 border border-gray-100">
        <div class="text-center mb-8">
            <h2 class="text-2xl font-bold text-gray-800">Join PT ChipiChapa</h2>
            <p class="text-gray-500 text-sm">Create your account to start shopping</p>
        </div>

        <form method="POST" action="/register" class="space-y-5">
            @csrf

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                <input type="text" name="name" required minlength="3" maxlength="40"
                    class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 outline-none transition"
                    placeholder="Enter your full name">
                <p class="text-[10px] text-gray-400 mt-1 uppercase italic">Min 3, Max 40 characters</p>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                <input type="email" name="email" required
                    class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 outline-none transition"
                    placeholder="name@gmail.com">
                <p class="text-[10px] text-gray-400 mt-1 uppercase italic">Must end with @gmail.com</p>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                <input type="text" name="phone" required
                    class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 outline-none transition"
                    placeholder="08123456789">
                <p class="text-[10px] text-gray-400 mt-1 uppercase italic">Must start with '08' </p>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <input type="password" name="password" required minlength="6" maxlength="12"
                    class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 outline-none transition"
                    placeholder="••••••••">
                <p class="text-[10px] text-gray-400 mt-1 uppercase italic">6-12 characters required</p>
            </div>

            <button type="submit" 
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-lg shadow-lg hover:shadow-blue-200 transition duration-200">
                Register
            </button>
        </form>

        <div class="mt-6 text-center border-t border-gray-100 pt-6">
            <p class="text-sm text-gray-600">
                Already have an account? 
                <a href="/login" class="text-blue-600 font-semibold hover:underline">Sign In</a>
            </p>
        </div>
    </div>

</body>
</html>