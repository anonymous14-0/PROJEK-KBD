<x-app-layout>
    <header class="bg-white py-6 px-10 shadow-sm border-b border-gray-100">
        <h2 class="font-black text-xl text-gray-900 leading-tight uppercase tracking-tight">EDIT NILAI</h2>
    </header>

    <div class="py-12 bg-[#f3f4f6] min-h-screen">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl rounded-2xl p-8">
                <div class="mb-6 rounded-lg bg-blue-50 text-blue-700 px-5 py-3">
                    <div class="font-bold">{{ $nilai->siswa->nama_lengkap ?? '-' }}</div>
                    <div>{{ $nilai->mataPelajaran->nama_mapel ?? '-' }}</div>
                </div>

                <form method="POST" action="{{ route('guru.nilai.update', $nilai) }}" class="space-y-5">
                    @csrf
                    @method('PUT')

                    @include('guru.nilai.partials.form-fields')

                    <div class="flex justify-end gap-3">
                        <a href="{{ route('guru.nilai.index') }}" class="px-5 py-2 rounded bg-gray-200 font-bold">Batal</a>
                        <x-primary-button>Update</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
