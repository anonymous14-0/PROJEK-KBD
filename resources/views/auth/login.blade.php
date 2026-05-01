<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Informasi Akademik</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased font-sans">
    <!-- Menggunakan min-h-screen agar background penuh -->
    <div class="min-h-screen flex items-center justify-center bg-[#345c8c] p-4 sm:p-6 md:p-10">
        
        <!-- Container Utama: Menjadi flex-col pada mobile dan flex-row pada desktop -->
        <div class="flex flex-col md:flex-row w-full max-w-[1280px] min-h-fit md:min-h-[700px] bg-white rounded-[2rem] md:rounded-[5rem] overflow-hidden shadow-[0_35px_60px_-15px_rgba(0,0,0,0.5)] transition-all">
            
            <!-- SISI KIRI (Informasi Sekolah) -->
            <div class="w-full md:w-1/2 bg-white flex flex-col items-center justify-center p-8 md:p-20 text-center">
                <!-- Logo: Ukuran lebih kecil di mobile -->
                <div class="w-32 h-32 md:w-56 md:h-56 rounded-full border-[4px] md:border-[6px] border-[#1e4066] overflow-hidden mb-6 md:mb-8 shadow-2xl bg-gray-50">
                    <img src="{{ asset('images/LogosekolahK.jpeg') }}" 
                         alt="Logo Sekolah" 
                         class="w-full h-full object-cover scale-110"
                         onerror="this.onerror=null;this.src='https://ui-avatars.com/api/?name=LOGO+MISSING&background=1e4066&color=fff';">
                </div>

                <div class="w-32 md:w-48 h-[5px] bg-black mb-6 md:mb-10 rounded-full"></div>

                <!-- Judul: Ukuran teks disesuaikan untuk layar kecil -->
                <h1 class="text-2xl md:text-5xl font-black text-gray-900 tracking-tighter uppercase leading-tight md:leading-none">
                    SISTEM INFORMASI<br>AKADEMIK
                </h1>
                <p class="text-[10px] md:text-lg font-black text-gray-400 mt-2 md:mt-4 mb-6 md:mb-12 tracking-[0.2em] md:tracking-[0.4em] uppercase">
                    SMA NEGERI 1 KEMIREN
                </p>

                <div class="text-xs md:text-lg text-gray-600 leading-relaxed max-w-[500px] font-medium italic">
                    <p>
                        "Platform digital untuk mengelola aktivitas akademik, data siswa, jadwal, dan nilai secara terintegrasi, cepat, dan efisien."
                    </p>
                </div>

                <!-- Footer Kiri: Menyesuaikan tata letak pada mobile -->
                <div class="mt-8 md:mt-auto w-full pt-6 md:pt-10 flex flex-col sm:flex-row justify-between items-center md:items-end border-t border-gray-100 gap-4">
                    <div class="text-center md:text-left space-y-1">
                        <p class="text-[10px] md:text-sm text-blue-500 font-black italic">Email: admin@sman1kemiren.sch.id</p>
                        <p class="text-[10px] md:text-sm text-blue-500 font-black italic">Website: www.sman1kemiren.sch.id</p>
                    </div>
                    <p class="text-[10px] md:text-xs text-gray-300 font-bold uppercase">© 2024 SMAN 1 KEMIREN</p>
                </div>
            </div>

            <!-- SISI KANAN (Form Login) -->
            <div class="w-full md:w-1/2 bg-[#eab308] flex flex-col items-center justify-center p-8 md:p-20 shadow-[inset_0_20px_40px_rgba(0,0,0,0.1)] md:shadow-[inset_20px_0_40px_rgba(0,0,0,0.1)]">
                <div class="text-center mb-8 md:mb-16">
                    <!-- Heading Login: Ukuran diperkecil di mobile agar tidak keluar layar -->
                    <h2 class="text-white text-2xl sm:text-3xl md:text-[50px] font-serif font-black tracking-[-0.02em] md:tracking-[-0.05em] uppercase leading-none drop-shadow-2xl">
                        SELAMAT DATANG
                    </h2>
                    <p class="text-white text-xs md:text-lg font-black tracking-[0.3em] md:tracking-[0.5em] mt-2 md:mt-4 uppercase opacity-90">
                        DI HALAMAN LOGIN
                    </p>
                </div>

                <form method="POST" action="{{ route('login') }}" class="w-full max-w-[450px] space-y-4 md:space-y-8">
                    @csrf

                    <!-- Input Username -->
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-4 md:pl-5 text-gray-400 border-r-2 border-gray-100 my-3 pr-3 md:pr-4 group-focus-within:text-blue-600 transition-all">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 md:h-8 md:w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <input id="email" type="email" name="email" required autofocus 
                            placeholder="Username"
                            class="w-full pl-16 md:pl-20 pr-6 md:pr-8 py-4 md:py-6 rounded-xl md:rounded-2xl border-none focus:ring-4 md:focus:ring-8 focus:ring-blue-500/30 text-lg md:text-xl font-bold shadow-2xl placeholder-gray-300">
                    </div>

                    <!-- Input Password -->
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-4 md:pl-5 text-gray-400 border-r-2 border-gray-100 my-3 pr-3 md:pr-4 group-focus-within:text-blue-600 transition-all">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 md:h-8 md:w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        <input id="password" type="password" name="password" required
                            placeholder="Password"
                            class="w-full pl-16 md:pl-20 pr-6 md:pr-8 py-4 md:py-6 rounded-xl md:rounded-2xl border-none focus:ring-4 md:focus:ring-8 focus:ring-blue-500/30 text-lg md:text-xl font-bold shadow-2xl placeholder-gray-300">
                    </div>

                    <!-- Tombol Masuk -->
                    <div class="flex justify-center pt-6 md:pt-10">
                        <button type="submit" class="w-full md:w-auto bg-[#1e4066] text-white px-12 md:px-24 py-4 md:py-6 rounded-full font-black shadow-[0_20px_50px_rgba(0,0,0,0.3)] hover:bg-[#152e4a] hover:scale-105 active:scale-95 transition-all tracking-[0.2em] md:tracking-[0.4em] text-xl md:text-3xl uppercase italic shadow-blue-900/40">
                            MASUK
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</body>
</html>