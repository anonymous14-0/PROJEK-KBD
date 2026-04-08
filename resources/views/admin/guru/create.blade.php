<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Tambah Guru Baru</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                <form action="{{ route('admin.guru.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <x-input-label for="nip" :value="__('NIP')" />
                        <x-text-input id="nip" name="nip" type="text" class="block mt-1 w-full" required />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="nama_lengkap" :value="__('Nama Lengkap')" />
                        <x-text-input id="nama_lengkap" name="nama_lengkap" type="text" class="block mt-1 w-full" required />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="jenis_kelamin" :value="__('Jenis Kelamin')" />
                        <select name="jenis_kelamin" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>

                    <x-primary-button>Simpan Data</x-primary-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>