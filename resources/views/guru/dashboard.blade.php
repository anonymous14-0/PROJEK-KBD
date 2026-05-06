<x-app-layout>
    
    <!-- Header Judul Halaman -->
    <header class="bg-white py-6 px-10 shadow-sm border-b border-gray-100">
        <h2 class="font-black text-xl text-gray-900 leading-tight uppercase tracking-tight">
            DASHBOARD GURU
        </h2>
    </header>

    <!-- Content Utama -->
    <div class="py-12 bg-[#f3f4f6] min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="bg-white overflow-hidden shadow-[0_10px_50px_rgba(0,0,0,0.1)] rounded-[2rem] border-l-[15px] border-[#eab308] min-h-[500px]">
                <div class="p-10 md:p-20">
                    
                    <!-- Welcome Text -->
                    <div class="mb-16">
                        <h3 class="text-4xl font-bold font-serif text-gray-900 tracking-tight">Selamat Datang, Guru Pengajar!</h3>
                        <p class="mt-2 text-lg text-gray-400 font-medium italic">Semua informasi tentang nilai dan Jadwal siswa bisa dilihat disini!</p>
                    </div>

                    <!-- Menu Cards Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-10 max-w-5xl">
                        
                        <!-- Card Manajemen Akademik (Warna Kuning Pucat) -->
                        <a href="{{ route('guru.nilai.index') }}" class="group block p-10 bg-[#fffdf0] rounded-[2rem] transition-all duration-300 hover:scale-105 hover:shadow-xl flex flex-col items-start text-left">
                            <div class="text-[#d4d957] font-black text-sm uppercase tracking-widest mb-3">Manajemen Akademik</div>
                            <div class="text-4xl font-black text-gray-950 mb-2 leading-none">Input & Edit Nilai</div>
                            <p class="text-[11px] text-gray-400 font-medium max-w-[250px]">Semua informasi tentang manajemen akademik ada disini!</p>
                            <p class="text-[11px] text-[#7dd3fc] font-bold mt-3 underline decoration-2 underline-offset-4">Klik untuk mengelola manajemen akademik</p>
                        </a>

                        <!-- Card Informasi (Warna Biru Pucat) -->
                        <a href="{{ route('guru.nilai.index') }}" class="group block p-10 bg-[#eef3ff] rounded-[2rem] transition-all duration-300 hover:scale-105 hover:shadow-xl flex flex-col items-start text-left">
                            <div class="text-[#8e9eff] font-black text-sm uppercase tracking-widest mb-3">Informasi</div>
                            <div class="text-4xl font-black text-gray-950 mb-2 leading-none">Jadwal Mengajar</div>
                            <p class="text-[11px] text-gray-400 font-medium max-w-[250px]">Semua informasi terkait jadwal mata pelajaran tersedia disini!</p>
                            <p class="text-[11px] text-[#7dd3fc] font-bold mt-3 underline decoration-2 underline-offset-4">Klik untuk mengelola jadwal mengajar</p>
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