<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Daftar Nilai Siswa</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded-lg shadow">
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="p-3 text-left">Nama Siswa</th>
                            <th class="p-3 text-left">Mata Pelajaran</th>
                            <th class="p-3 text-left">Nilai</th>
                            <th class="p-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($nilai as $n)
                        <tr class="border-b">
                            <td class="p-3">{{ $n->siswa->nama_lengkap }}</td>
                            <td class="p-3">{{ $n->mata_pelajaran->nama_pelajaran }}</td>
                            <td class="p-3 font-bold">{{ $n->skor }}</td>
                            <td class="p-3 text-center">
                                <a href="{{ route('guru.nilai.edit', $n->id_nilai) }}" class="text-blue-600 hover:underline">Edit Nilai</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>