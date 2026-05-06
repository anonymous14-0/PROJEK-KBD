<div class="grid grid-cols-1 md:grid-cols-2 gap-5">
    <div>
        <x-input-label for="nilai_uts" value="Nilai UTS (0-100)" />
        <x-text-input id="nilai_uts" name="nilai_uts" type="number" min="0" max="100" step="0.01" class="mt-1 block w-full" :value="old('nilai_uts', $nilai->nilai_uts ?? '')" required />
        <x-input-error :messages="$errors->get('nilai_uts')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="nilai_uas" value="Nilai UAS (0-100)" />
        <x-text-input id="nilai_uas" name="nilai_uas" type="number" min="0" max="100" step="0.01" class="mt-1 block w-full" :value="old('nilai_uas', $nilai->nilai_uas ?? '')" required />
        <x-input-error :messages="$errors->get('nilai_uas')" class="mt-2" />
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-5">
    <div>
        <x-input-label for="semester" value="Semester" />
        <select id="semester" name="semester" class="mt-1 block w-full rounded-md border-gray-300" required>
            @foreach(['ganjil' => 'Ganjil', 'genap' => 'Genap'] as $value => $label)
                <option value="{{ $value }}" @selected(old('semester', $nilai->semester ?? '') === $value)>{{ $label }}</option>
            @endforeach
        </select>
        <x-input-error :messages="$errors->get('semester')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="tahun_ajaran" value="Tahun Ajaran" />
        <x-text-input id="tahun_ajaran" name="tahun_ajaran" type="text" placeholder="2025/2026" class="mt-1 block w-full" :value="old('tahun_ajaran', $nilai->tahun_ajaran ?? '2025/2026')" required />
        <x-input-error :messages="$errors->get('tahun_ajaran')" class="mt-2" />
    </div>
</div>
