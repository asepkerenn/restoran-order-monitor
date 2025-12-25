<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome | Restoran Sejalan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; }
        .bg-hero {
            background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), 
                        url('https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?ixlib=rb-4.0.3&auto=format&fit=crop&w=1470&q=80');
            background-size: cover;
            background-position: center;
        }
    </style>
</head>
<body class="bg-gray-100">
    <div class="bg-hero h-screen flex flex-col items-center justify-center text-white px-4 text-center">
        
        <div class="mb-6 bg-white p-4 rounded-full shadow-lg inline-block">
            <svg class="w-12 h-12 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5S19.832 6.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
            </svg>
        </div>

        <h1 class="text-4xl md:text-6xl font-bold mb-4 tracking-tight">
            Selamat Datang di <span class="text-orange-400">Restoran Sejalan</span>
        </h1>
        
        <p class="text-lg md:text-xl text-gray-200 mb-10 max-w-2xl mx-auto">
            Nikmati hidangan istimewa dengan cita rasa autentik dan pelayanan terbaik hanya untuk Anda.
        </p>

        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ url('/order') }}" class="inline-flex items-center justify-center px-10 py-4 font-bold text-white bg-orange-500 rounded-full hover:bg-orange-600 shadow-xl transform hover:scale-105 transition-all">
                Tap untuk Memesan
            </a>
            <a href="{{ route('login') }}" class="inline-flex items-center justify-center px-10 py-4 font-bold text-white border-2 border-white rounded-full hover:bg-white hover:text-gray-900 transition-all">
                Login Kasir
            </a>
        </div>
    </div>
</body>
</html>