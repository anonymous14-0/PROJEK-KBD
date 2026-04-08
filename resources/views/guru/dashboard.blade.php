<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-green-600 leading-tight">
            {{ __('Dashboard Guru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-bold">Selamat Datang, Bapak/Ibu Guru!</h3>
                    <p class="mt-2 text-gray-600">Di sini Anda dapat mengelola nilai siswa dan melihat daftar mata pelajaran yang Anda ampu.</p>
                    
                    <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="p-4 bg-green-50 border-l-4 border-green-500 rounded">
                            <span class="block font-bold text-green-700">Input Nilai</span>
                            <span class="text-sm text-green-600">Masukkan nilai UTS & UAS siswa.</span>
                        </div>
                        <div class="p-4 bg-blue-50 border-l-4 border-blue-500 rounded">
                            <span class="block font-bold text-blue-700">Jadwal Mengajar</span>
                            <span class="text-sm text-blue-600">Lihat kelas yang Anda ampu hari ini.</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>