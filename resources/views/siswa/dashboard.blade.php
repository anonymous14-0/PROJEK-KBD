<x-app-layout>
    <header class="bg-white py-6 px-10 shadow-sm border-b border-gray-100">
        <h2 class="font-black text-xl text-gray-900 leading-tight uppercase tracking-tight">
            DATA NILAI SISWA
        </h2>
    </header>

    <div class="py-12 bg-[#f3f4f6] min-h-screen font-sans">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-[0_10px_50px_rgba(0,0,0,0.08)] rounded-[2rem] min-h-[500px] border-t-8 border-white">
                <div class="p-10 md:p-16">
                    <div class="mb-12">
                        <h3 class="text-3xl font-extrabold font-serif text-gray-900 tracking-tight italic">
                            Selamat Datang, {{ auth()->user()->nama_lengkap }}!
                        </h3>
                        <p class="mt-2 text-lg text-gray-400 font-medium">
                            Nilai yang ditampilkan hanya data milik akun siswa yang sedang login.
                        </p>
                    </div>

                    <div class="overflow-hidden rounded-xl border border-gray-200 shadow-xl">
                        <table class="w-full text-center border-collapse">
                            <thead>
                                <tr class="bg-[#ffde9e] text-[#4a90e2] font-serif italic uppercase tracking-wider text-lg border-b border-gray-300">
                                    <th class="py-4 border-r border-gray-300">Mata Pelajaran</th>
                                    <th class="py-4 border-r border-gray-300">UTS</th>
                                    <th class="py-4 border-r border-gray-300">UAS</th>
                                    <th class="py-4 border-r border-gray-300">Semester</th>
                                    <th class="py-4">Tahun Ajaran</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-500 font-medium text-sm">
                                @forelse($nilai as $item)
                                    <tr class="border-b border-gray-200 hover:bg-gray-50 transition">
                                        <td class="py-4 border-r border-gray-200">{{ $item->mataPelajaran->nama_mapel ?? '-' }}</td>
                                        <td class="py-4 border-r border-gray-200">{{ $item->nilai_uts }}</td>
                                        <td class="py-4 border-r border-gray-200">{{ $item->nilai_uas }}</td>
                                        <td class="py-4 border-r border-gray-200">{{ ucfirst($item->semester) }}</td>
                                        <td class="py-4">{{ $item->tahun_ajaran }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="py-8 italic text-gray-400">Nilai belum tersedia.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Crimson+Pro:ital,wght@0,700;1,700&display=swap');
        .font-serif {
            font-family: 'Crimson Pro', serif;
        }
    </style>
</x-app-layout>
