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
    <div class="bg-hero h-screen flex flex-col items-center justify-center text-white px-4">
        
        <div class="mb-6 bg-white p-4 rounded-full shadow-lg">
            <svg class="w-12 h-12 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5S19.832 5.477 21 6.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
            </svg>
        </div>

        <h1 class="text-4xl md:text-6xl font-bold text-center mb-4 tracking-tight">
            Selamat Datang di <span class="text-orange-400">Restoran Sejalan</span>
        </h1>
        
        <p class="text-lg md:text-xl text-gray-200 text-center mb-10 max-w-2xl">
            Nikmati hidangan istimewa dengan cita rasa autentik dan pelayanan terbaik hanya untuk Anda.
        </p>

        <a href="{{ url('/order') }}" class="group relative inline-flex items-center justify-center px-10 py-4 font-bold text-white transition-all duration-200 bg-orange-500 font-pj rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-900 hover:bg-orange-600 shadow-xl transform hover:scale-105">
            Tap untuk Memesan
            <svg class="w-5 h-5 ml-2 -mr-1 transition-all duration-200 group-hover:translate-x-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
            </svg>
        </a>

        <div class="absolute bottom-8 text-gray-400 text-sm">
            &copy; 2025 Restoran Sejalan. All rights reserved.
        </div>
    </div>
</body>
</html>