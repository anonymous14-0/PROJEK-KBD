<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kelola Data Guru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <div class="flex justify-between mb-4">
                    <h3 class="text-lg font-bold text-gray-700">Daftar Guru</h3>
                    <div class="flex gap-2">
                        <a href="{{ route('admin.guru.trashed') }}" class="bg-gray-500 text-white px-4 py-2 rounded-md text-sm hover:bg-gray-600">
                            Tempat Sampah
                        </a>
                        <a href="{{ route('admin.guru.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-md text-sm hover:bg-indigo-700">
                            + Tambah Guru
                        </a>
                    </div>
                </div>

                @if(session('success'))
                    <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">
                        {{ session('success') }}
                    </div>
                @endif
                <table class="w-full border-collapse border border-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="border p-2">NIP</th>
                            <th class="border p-2">Nama Lengkap</th>
                            <th class="border p-2">L/P</th>
                            <th class="border p-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($gurus as $guru)
                            <tr class="text-center hover:bg-gray-50">
                                <td class="border p-2 font-mono text-sm">{{ $guru->nip }}</td>
                                <td class="border p-2 text-left px-4">{{ $guru->nama_lengkap }}</td>
                                <td class="border p-2">{{ $guru->jenis_kelamin }}</td>
                                <td class="border p-2">
                                    <div class="flex items-center justify-center gap-3">
                                        <a href="{{ route('admin.guru.edit', $guru) }}" class="text-blue-500 hover:underline">Edit</a>
                                        <form action="{{ route('admin.guru.destroy', $guru) }}" method="POST" onsubmit="return confirm('Yakin ingin memindahkan data guru {{ $guru->nama_lengkap }} ke tempat sampah?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:underline">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="p-6 text-center text-gray-500">
                                    Belum ada data guru. Silakan klik tombol Tambah.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
