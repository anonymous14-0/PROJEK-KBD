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
                    <a href="{{ route('admin.guru.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-md text-sm hover:bg-indigo-700">
                        + Tambah Guru
                    </a>
                </div>

                @if(session('success'))
                    <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">
                        {{ session('success') }}
                    </div>
                @endif
                @if(session('temporary_password'))
                    <div class="mb-4 p-4 bg-yellow-100 text-yellow-800 rounded-lg">
                        <p class="font-semibold">Password sementara untuk {{ session('temporary_account_email') }}:</p>
                        <p class="font-mono text-lg">{{ session('temporary_password') }}</p>
                        <p class="text-sm mt-1">Password hanya ditampilkan sekali. User wajib menggantinya saat login pertama.</p>
                    </div>
                @endif

                @if(session('temporary_password'))
                    <div class="mb-4 p-4 bg-yellow-100 text-yellow-800 rounded-lg">
                        <p class="font-semibold">Password sementara untuk {{ session('temporary_account_email') }}:</p>
                        <p class="font-mono text-lg">{{ session('temporary_password') }}</p>
                        <p class="text-sm mt-1">Password hanya ditampilkan sekali. User wajib menggantinya saat login pertama.</p>
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
                                <td class="border p-2 space-x-2">
                                    <button class="text-blue-500 hover:underline">Edit</button>
                                    <button class="text-red-500 hover:underline">Hapus</button>
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
                <div class="mt-6">
                    {{ $gurus->links() }}
                </div>

            </div>
        </div>
    </div>
</x-app-layout>