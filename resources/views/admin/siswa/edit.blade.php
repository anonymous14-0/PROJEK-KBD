<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Siswa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                @if(session('error'))
                    <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-lg">
                        {{ session('error') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-lg">
                        <ul class="list-disc list-inside">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.siswa.update', $siswa) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="mb-4">
                            <label for="nis" class="block text-gray-700 text-sm font-bold mb-2">NIS (Nomor Induk Siswa)</label>
                            <input id="nis" type="text" name="nis" value="{{ old('nis', $siswa->nis) }}" class="border rounded w-full py-2 px-3 text-gray-700" required>
                        </div>
                        <div class="mb-4">
                            <label for="nama_lengkap" class="block text-gray-700 text-sm font-bold mb-2">Nama Lengkap</label>
                            <input id="nama_lengkap" type="text" name="nama_lengkap" value="{{ old('nama_lengkap', $siswa->nama_lengkap) }}" class="border rounded w-full py-2 px-3 text-gray-700" required>
                        </div>
                        <div class="mb-4">
                            <label for="jenis_kelamin" class="block text-gray-700 text-sm font-bold mb-2">Jenis Kelamin</label>
                            <select id="jenis_kelamin" name="jenis_kelamin" class="border rounded w-full py-2 px-3 text-gray-700" required>
                                <option value="L" @selected(old('jenis_kelamin', $siswa->jenis_kelamin) === 'L')>Laki-laki</option>
                                <option value="P" @selected(old('jenis_kelamin', $siswa->jenis_kelamin) === 'P')>Perempuan</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="id_kelas" class="block text-gray-700 text-sm font-bold mb-2">Pilih Kelas</label>
                            <select id="id_kelas" name="id_kelas" class="border rounded w-full py-2 px-3 text-gray-700" required>
                                @foreach($kelas as $k)
                                    <option value="{{ $k->id_kelas }}" @selected((int) old('id_kelas', $siswa->id_kelas) === (int) $k->id_kelas)>{{ $k->nama_kelas }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="mt-6 flex items-center gap-4">
                        <button type="submit" class="bg-blue-600 hover:bg-blue-800 text-white font-bold py-2 px-4 rounded">
                            Simpan Perubahan
                        </button>
                        <a href="{{ route('admin.siswa.index') }}" class="text-gray-600 hover:underline">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
