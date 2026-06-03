<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Tempat Sampah - Guru') }}
            </h2>
            <a href="{{ route('admin.guru.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded text-sm transition">
                Kembali ke Data Utama
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                @if(session('success'))
                    <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">{{ session('success') }}</div>
                @endif
                @if(session('error'))
                    <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-lg">{{ session('error') }}</div>
                @endif

                <table class="w-full border-collapse border border-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="border p-2">NIP</th>
                            <th class="border p-2">Nama Lengkap</th>
                            <th class="border p-2">Dihapus Pada</th>
                            <th class="border p-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($gurus as $guru)
                            <tr class="text-center hover:bg-gray-50">
                                <td class="border p-2 font-mono text-sm">{{ $guru->nip }}</td>
                                <td class="border p-2 text-left px-4">{{ $guru->nama_lengkap }}</td>
                                <td class="border p-2">{{ $guru->deleted_at->format('d M Y H:i') }}</td>
                                <td class="border p-2">
                                    <div class="flex items-center justify-center gap-3">
                                        <form action="{{ route('admin.guru.restore', $guru->id_guru) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="text-green-600 hover:underline">Pulihkan</button>
                                        </form>
                                        <form action="{{ route('admin.guru.force_delete', $guru->id_guru) }}" method="POST" onsubmit="return confirm('PERINGATAN: Hapus permanen data ini? (Tidak bisa dikembalikan)')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:underline font-bold">Hapus Permanen</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="p-6 text-center text-gray-500">Tempat sampah kosong.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
