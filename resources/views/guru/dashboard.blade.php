<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Guru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{-- Sapaan User --}}
                    <h3 class="text-lg font-bold">Selamat Datang, {{ Auth::user()->nama_lengkap }}!</h3>
                    <p class="mt-2 text-gray-600">Anda masuk sebagai **Tenaga Pengajar**. Silakan kelola data akademik siswa Anda di bawah ini.</p>
                    
                    {{-- Grid Menu Guru --}}
                    <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-6">
                        
                        {{-- Card Input/Edit Nilai --}}
                        <a href="{{ route('guru.nilai.index') }}" class="block p-6 bg-yellow-50 border border-yellow-100 rounded-lg hover:bg-yellow-100 transition shadow-sm group">
                            <div class="text-yellow-600 font-bold text-xs uppercase tracking-wider">Manajemen Akademik</div>
                            <div class="text-2xl font-bold text-gray-800 mt-1 group-hover:text-yellow-700">Input & Edit Nilai</div>
                            <p class="text-sm text-yellow-600 mt-2">Kelola nilai harian, UTS, dan UAS siswa secara real-time.</p>
                        </a>

                        {{-- Card Jadwal (Placeholder untuk pengembangan selanjutnya) --}}
                        <div class="p-6 bg-blue-50 border border-blue-100 rounded-lg shadow-sm opacity-75">
                            <div class="text-blue-600 font-bold text-xs uppercase tracking-wider">Informasi</div>
                            <div class="text-2xl font-bold text-gray-800 mt-1">Jadwal Mengajar</div>
                            <p class="text-sm text-blue-600 mt-2">Fitur jadwal mata pelajaran akan segera tersedia.</p>
                        </div>

                    </div> {{-- End Grid --}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>