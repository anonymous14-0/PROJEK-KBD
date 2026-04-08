<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Utama Admin') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border-l-4 border-indigo-500">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-bold">Selamat Datang, {{ Auth::user()->nama_lengkap }}!</h3>
                    <p class="mt-2 text-gray-600">Ini adalah halaman khusus **Administrator**. Di sini Anda bisa mengelola seluruh data akademik.</p>

                    {{-- Grid Utama --}}
                    <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6">
                        
                        {{-- Card Data Guru --}}
                        <a href="{{ route('admin.guru.index') }}" class="block p-4 bg-blue-50 rounded-lg border border-blue-100 hover:bg-blue-100 transition shadow-sm">
                            <div class="text-blue-500 font-bold text-xs uppercase">Data Guru</div>
                            <div class="text-2xl font-bold text-gray-800">Cek Data</div>
                            <p class="text-xs text-blue-400 mt-1">Klik untuk kelola guru</p>
                        </a>

                        {{-- Card Data Siswa --}}
                        <a href="{{ route('admin.siswa.index') }}" class="block p-4 bg-green-50 rounded-lg border border-green-100 hover:bg-green-100 transition shadow-sm">
                            <div class="text-green-500 font-bold text-xs uppercase">Data Siswa</div>
                            <div class="text-2xl font-bold text-gray-800">Cek Data</div>
                            <p class="text-xs text-green-400 mt-1">Klik untuk kelola siswa</p>
                        </a>

                        {{-- Card Log Aktivitas - SEKARANG SUDAH AKTIF --}}
                        <a href="{{ route('admin.logs.index') }}" class="block p-4 bg-purple-50 rounded-lg border border-purple-100 hover:bg-purple-100 transition shadow-sm">
                            <div class="text-purple-500 font-bold text-xs uppercase">Log Aktivitas</div>
                            <div class="text-2xl font-bold text-gray-800">Cek Log</div>
                            <p class="text-xs text-purple-400 mt-1">Sistem monitoring aktif</p>
                        </a>

                    </div> {{-- End Grid --}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>