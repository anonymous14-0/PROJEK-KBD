<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Informasi Akademik</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased font-sans">
    <div class="min-h-screen flex items-center justify-center bg-[#345c8c] p-4 sm:p-6 md:p-8">

        <div class="flex flex-col md:flex-row w-full max-w-4xl min-h-fit md:min-h-[520px] bg-white rounded-[2rem] overflow-hidden shadow-[0_25px_50px_-12px_rgba(0,0,0,0.4)] transition-all">

            <div class="w-full md:w-1/2 bg-white flex flex-col items-center justify-between p-6 md:p-10 text-center">

                <div class="flex flex-col items-center justify-center flex-grow">
                    <div class="w-24 h-24 md:w-36 md:h-36 rounded-full border-[4px] border-[#1e4066] overflow-hidden mb-4 shadow-xl bg-gray-50">
                        <img src="{{ asset('images/LogosekolahK.jpeg') }}"
                             alt="Logo Sekolah"
                             class="w-full h-full object-cover scale-110"
                             onerror="this.onerror=null;this.src='https://ui-avatars.com/api/?name=LOGO+MISSING&background=1e4066&color=fff';">
                    </div>

                    <div class="w-24 md:w-32 h-[4px] bg-black mb-4 rounded-full"></div>

                    <h1 class="text-xl md:text-3xl font-black text-gray-900 tracking-tighter uppercase leading-tight">
                        SISTEM INFORMASI<br>AKADEMIK
                    </h1>

                    <p class="text-[9px] md:text-xs font-black text-gray-400 mt-1 mb-4 tracking-[0.2em] md:tracking-[0.3em] uppercase">
                        SMA NEGERI 1 KEMIREN
                    </p>

                    <div class="text-[11px] md:text-sm text-gray-600 leading-relaxed max-w-[360px] font-medium italic">
                        <p>
                            "Platform digital untuk mengelola aktivitas akademik, data siswa, jadwal, dan nilai secara terintegrasi, cepat, dan efisien."
                        </p>
                    </div>
                </div>

                <div class="mt-6 w-full pt-4 flex flex-col sm:flex-row justify-between items-center md:items-end border-t border-gray-100 gap-2">
                    <div class="text-center md:text-left space-y-0.5">
                        <p class="text-[9px] md:text-xs text-blue-500 font-black italic">
                            Email: admin@sman1kemiren.sch.id
                        </p>
                        <p class="text-[9px] md:text-xs text-blue-500 font-black italic">
                            Website: www.sman1kemiren.sch.id
                        </p>
                    </div>
                    <p class="text-[9px] md:text-[10px] text-gray-300 font-bold uppercase">
                        © 2024 SMAN 1 KEMIREN
                    </p>
                </div>
            </div>

            <div class="w-full md:w-1/2 bg-[#eab308] flex flex-col items-center justify-center p-6 md:p-10 shadow-[inset_0_20px_40px_rgba(0,0,0,0.1)] md:shadow-[inset_20px_0_40px_rgba(0,0,0,0.1)]">

                <div class="text-center mb-6 md:mb-8">
                    <h2 class="text-white text-xl sm:text-2xl md:text-3xl font-serif font-black tracking-tight uppercase leading-none drop-shadow-2xl">
                        SELAMAT DATANG
                    </h2>
                    <p class="text-white text-[10px] md:text-xs font-black tracking-[0.2em] md:tracking-[0.3em] mt-1.5 uppercase opacity-90">
                        DI HALAMAN LOGIN
                    </p>
                </div>

                <form method="POST" action="{{ route('login') }}" class="w-full max-w-[360px] space-y-4 md:space-y-5">
                    @csrf

                    @if ($errors->has('email'))
                        <div class="rounded-xl bg-red-600 px-4 py-3 text-center text-white shadow-2xl ring-4 ring-red-300/60" role="alert">
                            <p class="text-[10px] font-black uppercase tracking-[0.2em]">Peringatan login</p>
                            <p class="mt-0.5 text-sm md:text-base font-black italic">
                                {{ $errors->first('email') }}
                            </p>
                            <p class="mt-2 text-[10px] md:text-xs font-bold leading-relaxed opacity-95">
                                Batas percobaan login adalah 5 kali. Jika habis, login akan diblokir 15 menit lalu bisa dicoba kembali.
                            </p>
                        </div>
                    @endif

                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400 border-r-2 border-gray-100 my-2.5 pr-3 group-focus-within:text-blue-600 transition-all">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 md:h-6 md:w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <input id="email"
                               type="text"
                               name="email"
                               required
                               autofocus
                               placeholder="Username / Email"
                               value="{{ old('email') }}"
                               class="w-full pl-14 md:pl-16 pr-4 py-3 md:py-3.5 rounded-xl border-none focus:ring-4 focus:ring-blue-500/30 text-sm md:text-base font-bold shadow-2xl placeholder-gray-300">
                    </div>

                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400 border-r-2 border-gray-100 my-2.5 pr-3 group-focus-within:text-blue-600 transition-all">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 md:h-6 md:w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        <input id="password"
                               type="password"
                               name="password"
                               required
                               placeholder="Password"
                               class="w-full pl-14 md:pl-16 pr-4 py-3 md:py-3.5 rounded-xl border-none focus:ring-4 focus:ring-blue-500/30 text-sm md:text-base font-bold shadow-2xl placeholder-gray-300">
                    </div>

                    <div class="bg-white rounded-xl p-4 shadow-2xl">
                        <label class="block text-[#1e4066] font-black text-xs md:text-sm mb-2 uppercase tracking-wider">
                            Verifikasi CAPTCHA
                        </label>
                        <div class="flex items-center gap-2">
                            <div class="bg-[#1e4066] text-white px-4 py-2 rounded-lg text-base md:text-lg font-black tracking-wider shadow-lg whitespace-nowrap">
                                {{ session('captcha_num1', 3) }} + {{ session('captcha_num2', 7) }}
                            </div>
                            <span class="text-xl font-black text-[#1e4066]">=</span>
                            <input
                                type="number"
                                name="captcha"
                                required
                                placeholder="Jawaban"
                                class="w-full px-3 py-2 rounded-lg border-none focus:ring-4 focus:ring-blue-500/30 text-sm font-bold shadow-xl placeholder-gray-300">
                        </div>
                        @error('captcha')
                            <p class="text-red-600 font-bold mt-1 text-xs">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div class="flex justify-center pt-2 md:pt-4">
                        <button type="submit" class="w-full bg-[#1e4066] text-white py-3 md:py-4 rounded-full font-black shadow-[0_15px_30px_rgba(0,0,0,0.25)] hover:bg-[#152e4a] hover:scale-[1.02] active:scale-95 transition-all tracking-[0.2em] text-lg md:text-xl uppercase italic shadow-blue-900/40">
                            MASUK
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</body>
</html>