<x-app-layout>
    <header class="bg-white py-6 px-10 shadow-sm border-b border-gray-100">
        <h2 class="font-black text-xl text-gray-900 leading-tight uppercase tracking-tight">TAMBAH NILAI</h2>
    </header>

    <div class="py-12 bg-[#f3f4f6] min-h-screen">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl rounded-2xl p-8">
                <form method="POST" action="{{ route('guru.nilai.store') }}" class="space-y-5">
                    @csrf

                    <div>
                        <x-input-label for="id_siswa" value="Siswa" />
                        <select id="id_siswa" name="id_siswa" class="mt-1 block w-full rounded-md border-gray-300" required>
                            <option value="">Pilih siswa</option>
                            @foreach($siswa as $item)
                                <option value="{{ $item->id_siswa }}" @selected(old('id_siswa') == $item->id_siswa)>{{ $item->nama_lengkap }} - {{ $item->kelas->nama_kelas ?? '-' }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('id_siswa')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="id_mapel" value="Mata Pelajaran" />
                        <select id="id_mapel" name="id_mapel" class="mt-1 block w-full rounded-md border-gray-300" required>
                            <option value="">Pilih mata pelajaran</option>
                            @foreach($mataPelajaran as $item)
                                <option value="{{ $item->id_mapel }}" @selected(old('id_mapel') == $item->id_mapel)>{{ $item->nama_mapel }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('id_mapel')" class="mt-2" />
                    </div>

                    @include('guru.nilai.partials.form-fields')

                    <div class="flex justify-end gap-3">
                        <a href="{{ route('guru.nilai.index') }}" class="px-5 py-2 rounded bg-gray-200 font-bold">Batal</a>
                        <x-primary-button>Simpan</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
