<x-app-layout>
    {{-- Header Judul Halaman (Disesuaikan dengan Gambar) --}}
    <header class="bg-white py-6 px-10 shadow-sm border-b border-gray-100">
        <h2 class="font-black text-xl text-gray-900 leading-tight uppercase tracking-tight">
            PUSAT AUDIT SISTEM INFORMASI AKADEMIK
        </h2>
    </header>

    <div class="py-12 bg-[#f3f4f6] min-h-screen font-sans">
        <div class="max-w-full mx-auto px-4 sm:px-6 lg:px-8">
            {{-- Container Utama --}}
            <div class="bg-white overflow-hidden shadow-[0_10px_50px_rgba(0,0,0,0.08)] rounded-[2rem] min-h-[600px] border-t-8 border-white">
                <div class="p-10 md:p-16">
                    
                    {{-- Judul Log & Badge Mode --}}
                    <div class="flex justify-between items-center mb-10">
                        <h3 class="text-4xl font-extrabold font-serif text-[#f87171] tracking-tight italic">
                            Log Aktivitas Seluruh Pengguna
                        </h3>
                        <div class="bg-[#fecaca] text-[#ef4444] px-6 py-2 rounded-md font-bold text-sm tracking-widest uppercase opacity-80">
                            Mode Pengawas
                        </div>
                    </div>

                    {{-- Tabel Audit --}}
                    <div class="overflow-hidden rounded-xl border border-gray-200 shadow-2xl">
                        <table class="w-full text-center border-collapse">
                            <thead>
                                <tr class="bg-[#7c9aff] text-white font-mono uppercase tracking-wider text-lg border-b border-gray-300">
                                    <th class="py-5 border-r border-blue-300 w-[20%]">Waktu</th>
                                    <th class="py-5 border-r border-blue-300 w-[25%]">User</th>
                                    <th class="py-5 border-r border-blue-300 w-[15%]">Role</th>
                                    <th class="py-5 w-[40%]">Aktivitas / Query</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-600 font-medium text-sm">
                                {{-- Contoh Data Statis Sesuai Gambar --}}
                                @php
                                    $logs = [
                                        ['2026-04-27 13.10.00', 'Aditya Agung Triwibowo', 'SISWA', 'Siswa melihat data nilai pribadi'],
                                        ['2026-04-27 08.50.04', 'Bekti Widya Jatmiko', 'SISWA', 'Siswa melihat data nilai pribadi'],
                                        ['2026-04-26 21.40.31', 'Daffa Atsaal Mishbah', 'SISWA', 'Siswa melihat data nilai pribadi'],
                                        ['2026-04-26 20.30.01', 'Jenisa Farah Afifah', 'SISWA', 'Siswa melihat data nilai pribadi'],
                                        ['2026-04-26 20.16.21', 'Abdul Rohman Supriyono, S.T., M.Kom.', 'GURU', 'Guru menambahkan nilai siswa'],
                                        ['2026-04-26 20.09.03', 'Laura Sari, S.Si., M.Sc.', 'GURU', 'Guru menambahkan nilai siswa'],
                                        ['2026-04-26 19.45.15', 'Nuzul Hanifa', 'SISWA', 'Siswa melihat data nilai pribadi'],
                                        ['2026-04-26 19.28.30', 'Reva Adelya Muzaneha', 'SISWA', 'Siswa melihat data nilai pribadi'],
                                        ['2026-04-26 18.30.17', 'Muhammad Fathoni', 'SISWA', 'Siswa melihat data nilai pribadi'],
                                        ['2026-04-26 18.10.20', 'Muhammad Abdul Mu\'in', 'GURU', 'Guru menambahkan nilai siswa'],
                                    ];
                                @endphp

                                @foreach($logs as $log)
                                <tr class="border-b border-gray-100 hover:bg-gray-50 transition even:bg-gray-50/50">
                                    <td class="py-4 border-r border-gray-200 font-mono text-xs">{{ $log[0] }}</td>
                                    <td class="py-4 border-r border-gray-200 text-gray-800">{{ $log[1] }}</td>
                                    <td class="py-4 border-r border-gray-200">
                                        <span class="bg-[#fce7f3] text-[#be185d] px-4 py-1 rounded font-bold text-[10px]">
                                            {{ $log[2] }}
                                        </span>
                                    </td>
                                    <td class="py-4 text-left px-8">{{ $log[3] }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Crimson+Pro:ital,wght@1,700&display=swap');
        .font-serif {
            font-family: 'Crimson Pro', serif;
        }
    </style>
</x-app-layout>