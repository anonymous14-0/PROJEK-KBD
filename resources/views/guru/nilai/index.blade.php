<x-app-layout>
    <header class="bg-white py-6 px-10 shadow-sm border-b border-gray-100 flex justify-between items-center">
        <h2 class="font-black text-xl text-gray-900 leading-tight uppercase tracking-tight">MANAJEMEN NILAI</h2>
        <a href="{{ route('guru.nilai.create') }}" class="px-5 py-2 bg-blue-600 text-white rounded-lg font-bold hover:bg-blue-700">Tambah Nilai</a>
    </header>

    <div class="py-12 bg-[#f3f4f6] min-h-screen font-sans">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-6 rounded-lg bg-green-100 text-green-700 px-5 py-3 font-semibold">{{ session('success') }}</div>
            @endif

            <div class="bg-white overflow-hidden shadow-xl rounded-2xl">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-gray-900 text-white uppercase text-sm">
                        <tr>
                            <th class="p-4">Siswa</th>
                            <th class="p-4">Kelas</th>
                            <th class="p-4">Mata Pelajaran</th>
                            <th class="p-4">UTS</th>
                            <th class="p-4">UAS</th>
                            <th class="p-4">Semester</th>
                            <th class="p-4">Tahun</th>
                            <th class="p-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        @forelse($nilai as $item)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="p-4 font-semibold">{{ $item->siswa->nama_lengkap ?? '-' }}</td>
                                <td class="p-4">{{ $item->siswa->kelas->nama_kelas ?? '-' }}</td>
                                <td class="p-4">{{ $item->mataPelajaran->nama_mapel ?? '-' }}</td>
                                <td class="p-4">{{ $item->nilai_uts }}</td>
                                <td class="p-4">{{ $item->nilai_uas }}</td>
                                <td class="p-4">{{ ucfirst($item->semester) }}</td>
                                <td class="p-4">{{ $item->tahun_ajaran }}</td>
                                <td class="p-4">
                                    <div class="flex justify-center gap-2">
                                        <a href="{{ route('guru.nilai.edit', $item) }}" class="px-3 py-1 rounded bg-yellow-400 text-gray-900 font-bold">Edit</a>
                                        <form method="POST" action="{{ route('guru.nilai.destroy', $item) }}" onsubmit="return confirm('Hapus nilai ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="px-3 py-1 rounded bg-red-600 text-white font-bold">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="p-8 text-center italic text-gray-400">Belum ada data nilai.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
