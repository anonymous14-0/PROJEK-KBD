<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-purple-600 leading-tight">
            {{ __('Dashboard Siswa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-bold">Halo, {{ Auth::user()->nama_lengkap }}!</h3>
                    <p class="mt-2 text-gray-600">Selamat datang di portal akademik Anda. Tetap semangat belajarnya ya!</p>

                    <div class="mt-6 bg-purple-50 p-6 rounded-lg border border-purple-100">
                        <p class="text-purple-800 font-medium italic text-center">
                            "Pendidikan adalah tiket ke masa depan, karena hari esok dimiliki oleh orang-orang yang mempersiapkannya hari ini."
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>