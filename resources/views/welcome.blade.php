<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome | PT ChipiChapa Retail System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 flex items-center justify-center min-h-screen">

    <div class="max-w-md w-full bg-white shadow-lg rounded-2xl p-8 text-center border border-gray-100">
        <div class="mb-6 flex justify-center">
            <div class="w-16 h-16 bg-blue-600 rounded-xl flex items-center justify-center shadow-blue-200 shadow-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                </svg>
            </div>
        </div>

        <h1 class="text-3xl font-bold text-gray-900 mb-2">PT ChipiChapa</h1>
        <p class="text-gray-500 mb-8">Retail Inventory Management System</p>

        <div class="space-y-4">
            <a href="/login" class="block w-full py-3 px-4 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition duration-200 ease-in-out shadow-md hover:shadow-lg">
                Sign In
            </a>
            
            <a href="/register" class="block w-full py-3 px-4 bg-white border border-gray-300 hover:border-blue-500 text-gray-700 hover:text-blue-600 font-semibold rounded-lg transition duration-200 ease-in-out">
                Create Account
            </a>
        </div>

        <div class="mt-8 pt-6 border-t border-gray-100">
            <p class="text-xs text-gray-400 uppercase tracking-widest font-medium">
                &copy; PT ChipiChapa.
            </p>
        </div>
    </div>

</body>
</html>