<x-app-layout>

    <!-- Header Judul Halaman -->
    <header class="bg-white py-6 px-10 shadow-sm">
        <h2 class="font-black text-xl text-gray-900 leading-tight uppercase tracking-tight">
            DASHBOARD UTAMA ADMINISTRATOR
        </h2>
    </header>

    <!-- Content Utama -->
    <div class="py-12 bg-[#f3f4f6] min-h-screen">
        <div class="max-w-full mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="bg-white overflow-hidden shadow-[0_10px_50px_rgba(0,0,0,0.05)] rounded-[2rem] border-l-[15px] border-[#eab308] min-h-[500px]">
                <div class="p-10 md:p-20">
                    
                    <!-- Welcome Text -->
                    <div class="mb-16">
                        <h3 class="text-4xl font-bold font-serif text-gray-900 tracking-tight">Selamat Datang, Administrator!</h3>
                        <p class="mt-3 text-lg text-gray-400 font-medium italic">Semua informasi akademik siswa dan guru dapat anda kelola disini!</p>
                    </div>

                    <!-- Menu Cards Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                        
                        <!-- Card Data Guru -->
                        <a href="{{ route('admin.guru.index') }}" class="group block p-10 bg-[#eff3ff] rounded-3xl transition-all duration-300 hover:scale-105 hover:shadow-xl flex flex-col items-start text-left">
                            <div class="text-[#8494ff] font-black text-xs uppercase tracking-[0.2em] mb-3">Data Guru</div>
                            <div class="text-4xl font-black text-gray-900 mb-2">Cek Data</div>
                            <p class="text-xs text-gray-400 font-medium">Semua informasi tentang guru ada disini!</p>
                            <p class="text-xs text-[#7dd3fc] font-bold mt-4 underline decoration-2 underline-offset-4">Klik untuk mengelola data guru</p>
                        </a>

                        <!-- Card Data Siswa -->
                        <a href="{{ route('admin.siswa.index') }}" class="group block p-10 bg-[#e0faff] rounded-3xl transition-all duration-300 hover:scale-105 hover:shadow-xl flex flex-col items-start text-left">
                            <div class="text-[#4fd1c5] font-black text-xs uppercase tracking-[0.2em] mb-3">Data Siswa</div>
                            <div class="text-4xl font-black text-gray-900 mb-2">Cek Data</div>
                            <p class="text-xs text-gray-400 font-medium">Semua informasi tentang siswa ada disini!</p>
                            <p class="text-xs text-[#7dd3fc] font-bold mt-4 underline decoration-2 underline-offset-4">Klik untuk mengelola data siswa</p>
                        </a>

                        <!-- Card Log Aktivitas -->
                        <a href="{{ route('admin.logs.index') }}" class="group block p-10 bg-[#faf0ff] rounded-3xl transition-all duration-300 hover:scale-105 hover:shadow-xl flex flex-col items-start text-left">
                            <div class="text-[#d6bcfa] font-black text-xs uppercase tracking-[0.2em] mb-3">Log Aktivitas</div>
                            <div class="text-4xl font-black text-gray-900 mb-2">Cek Log</div>
                            <p class="text-xs text-gray-400 font-medium">Sistem monitoring aktif!</p>
                            <p class="text-xs text-[#a3bffa] font-bold mt-4 underline decoration-2 underline-offset-4">Klik untuk mengelola log aktivitas</p>
                        </a>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Crimson+Pro:wght@700&display=swap');
        .font-serif {
            font-family: 'Crimson Pro', serif;
        }
    </style>
</x-app-layout>