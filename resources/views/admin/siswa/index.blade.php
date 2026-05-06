<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Daftar Siswa') }}
            </h2>
            <a href="{{ route('admin.siswa.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded text-sm transition">
                + Tambah Siswa
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

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
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">NIS</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Lengkap</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">L/P</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kelas</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($siswa as $s)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $s->nis }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">{{ $s->nama_lengkap }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $s->jenis_kelamin }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                {{-- Memanggil relasi ke model Kelas --}}
                                <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded text-xs">
                                    {{ $s->kelas->nama_kelas ?? 'Tanpa Kelas' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                <button class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</button>
                                <button class="text-red-600 hover:text-red-900">Hapus</button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-gray-500">Belum ada data siswa.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="mt-6">
                    {{ $siswa->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>