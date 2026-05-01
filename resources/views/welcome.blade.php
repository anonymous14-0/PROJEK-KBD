<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Informasi Akademik</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased font-sans">
    <div class="min-h-screen flex items-center justify-center bg-[#345c8c] relative p-6 md:p-10">
        
        <div class="absolute top-4 right-4 md:top-8 md:right-10">
            <a href="{{ route('login') }}" class="border-2 border-white text-white px-4 py-1.5 md:px-7 md:py-2 rounded-lg hover:bg-white hover:text-[#345c8c] transition-all font-bold text-xs md:text-base shadow-lg">
                Login
            </a>
        </div>

        <div class="bg-white w-full max-w-[550px] rounded-[2.5rem] md:rounded-[3.5rem] shadow-2xl overflow-hidden p-8 md:p-12 flex flex-col items-center transition-all h-auto min-h-[580px] md:min-h-[700px]">
            
            <div class="w-24 h-24 md:w-36 md:h-36 rounded-full border-4 border-[#1e4066] overflow-hidden mb-6 md:mb-8 shadow-md">
                <img src="{{ asset('images/LogosekolahK.jpeg') }}" alt="Logo" class="w-full h-full object-cover" onerror="this.src='https://ui-avatars.com/api/?name=Logo&background=1e4066&color=fff'">
            </div>

            <div class="bg-[#b3e5fc] px-6 py-2 md:px-10 md:py-2.5 rounded-full mb-8 md:mb-10 shadow-sm">
                <span class="text-[#1e4066] font-black text-[10px] md:text-sm tracking-widest uppercase text-center block leading-none">
                    Sistem Informasi Akademik
                </span>
            </div>

            <div class="text-center mb-1">
                <h1 class="text-[#1e4066] text-3xl md:text-5xl font-black tracking-tighter leading-tight uppercase">
                    SELAMAT DATANG
                </h1>
                <p class="text-gray-500 text-[10px] md:text-xs font-bold tracking-[0.3em] mt-2 uppercase">
                    SMA Negeri 1 Kemiren
                </p>
            </div>

            <div class="w-32 md:w-44 h-[3px] md:h-[4px] bg-[#d4a017] mb-8 md:mb-12 rounded-full"></div>

            <div class="w-full max-w-[420px] text-center px-2 md:px-4 mb-auto">
                <p class="text-gray-500 text-sm md:text-lg leading-relaxed font-semibold italic">
                    Platform digital untuk mengakses informasi akademik seperti nilai, jadwal pelajaran, dan data siswa secara mudah dan terintegrasi.
                </p>
            </div>

            <div class="w-full border-t-2 border-gray-50 pt-6 mt-8">
                <div class="flex flex-col gap-1.5 md:gap-2">
                    <div class="text-[9px] md:text-xs text-blue-400 flex items-center font-bold">
                        <span class="mr-2">📧</span> Email: admin@sman1kemiren.sch.id
                    </div>
                    <div class="text-[9px] md:text-xs text-blue-400 flex items-center font-bold">
                        <span class="mr-2">🌐</span> Website: www.sman1kemiren.sch.id
                    </div>
                </div>
                <div class="text-right mt-4">
                    <p class="text-[8px] md:text-[10px] text-gray-300 font-bold uppercase tracking-widest">
                        © 2024 SMA Negeri 1 Kemiren
                    </p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>