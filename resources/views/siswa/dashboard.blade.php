<x-app-layout>

    <!-- 2. Header Judul Halaman -->
    <header class="bg-white py-6 px-10 shadow-sm border-b border-gray-100">
        <h2 class="font-black text-xl text-gray-900 leading-tight uppercase tracking-tight">
            DATA NILAI SISWA
        </h2>
    </header>

    <!-- 3. Content Utama -->
    <div class="py-12 bg-[#f3f4f6] min-h-screen font-sans">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-[0_10px_50px_rgba(0,0,0,0.08)] rounded-[2rem] min-h-[500px] border-t-8 border-white">
                <div class="p-10 md:p-16">
                    
                    <!-- Welcome Text -->
                    <div class="mb-12">
                        <h3 class="text-3xl font-extrabold font-serif text-gray-900 tracking-tight italic">
                            Selamat Datang, Siswa Siswi SMA Negeri 1 Kemiren!
                        </h3>
                        <p class="mt-2 text-lg text-gray-400 font-medium">
                            Semua informasi tentang nilai anda dapat dilihat dan diakses disini
                        </p>
                    </div>

                    <!-- Tabel Nilai -->
                    <div class="overflow-hidden rounded-xl border border-gray-200 shadow-xl">
                        <table class="w-full text-center border-collapse">
                            <thead>
                                <tr class="bg-[#ffde9e] text-[#4a90e2] font-serif italic uppercase tracking-wider text-lg border-b border-gray-300">
                                    <th class="py-4 border-r border-gray-300 w-1/3">Mata Pelajaran</th>
                                    <th class="py-4 border-r border-gray-300 w-1/3">Nilai</th>
                                    <th class="py-4 w-1/3">Status</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-500 font-medium text-sm">
                                @php
                                    $mapel = ['Matematika', 'Ilmu Pengetahuan Alam', 'Agama', 'Sejarah', 'Bahasa Inggris', 'Bahasa Indonesia',  ];
                                @endphp

                                @foreach($mapel as $item)
                                <tr class="border-b border-gray-200 hover:bg-gray-50 transition">
                                    <td class="py-4 border-r border-gray-200">{{ $item }}</td>
                                    <td class="py-4 border-r border-gray-200 italic">Nilai Belum Tersedia</td>
                                    <td class="py-4 italic">Status Belum Tersedia</td>
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
        @import url('https://fonts.googleapis.com/css2?family=Crimson+Pro:ital,wght@0,700;1,700&display=swap');
        .font-serif {
            font-family: 'Crimson Pro', serif;
        }
    </style>
</x-app-layout>