<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-indigo-600 leading-tight">
            {{ __('Laporan Nilai Siswa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-bold mb-4">Halo, {{ Auth::user()->nama_lengkap }}!</h3>
                    <p class="mb-6 text-gray-600">Berikut adalah perolehan nilai akademik Anda saat ini:</p>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-indigo-50 text-indigo-700">
                                    <th class="p-4 border-b">Mata Pelajaran</th>
                                    <th class="p-4 border-b text-center">Skor</th>
                                    <th class="p-4 border-b text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($nilai as $n)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="p-4 border-b">{{ $n->mata_pelajaran->nama_pelajaran }}</td>
                                    <td class="p-4 border-b text-center font-bold text-lg">{{ $n->skor }}</td>
                                    <td class="p-4 border-b text-center">
                                        @if($n->skor >= 75)
                                            <span class="px-2 py-1 bg-green-100 text-green-700 rounded-full text-xs">Tuntas</span>
                                        @else
                                            <span class="px-2 py-1 bg-red-100 text-red-700 rounded-full text-xs">Remedial</span>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="p-4 text-center text-gray-500">Nilai belum tersedia.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <p>oi cuki belajar yg bener anj nilai mu bosok bet</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>