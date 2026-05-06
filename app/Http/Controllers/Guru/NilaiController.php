<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\MataPelajaran;
use App\Models\Nilai;
use App\Models\Siswa;
use App\Services\AuditTrail;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class NilaiController extends Controller
{
    public function index(Request $request)
    {
        $nilai = $this->nilaiQueryForCurrentGuru()
            ->latest('updated_at')
            ->get();

        AuditTrail::record('Guru melihat daftar nilai siswa', $request);

        return view('guru.nilai.index', compact('nilai'));
    }

    public function create(Request $request)
    {
        AuditTrail::record('Guru membuka form input nilai', $request);

        return view('guru.nilai.create', [
            'siswa' => Siswa::with('kelas')->orderBy('nama_lengkap')->get(),
            'mataPelajaran' => $this->mataPelajaranForCurrentGuru()->orderBy('nama_mapel')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_siswa' => ['required', 'integer', 'exists:siswa,id_siswa'],
            'id_mapel' => [
                'required',
                'integer',
                Rule::exists('mata_pelajaran', 'id_mapel')->where(fn ($query) => $this->limitMapelRuleToCurrentGuru($query)),
                Rule::unique('nilai', 'id_mapel')
                    ->where('id_siswa', $request->integer('id_siswa'))
                    ->where('semester', $request->input('semester'))
                    ->where('tahun_ajaran', $request->input('tahun_ajaran')),
            ],
            'nilai_uts' => ['required', 'numeric', 'min:0', 'max:100'],
            'nilai_uas' => ['required', 'numeric', 'min:0', 'max:100'],
            'semester' => ['required', 'string', 'max:20'],
            'tahun_ajaran' => ['required', 'regex:/^\d{4}\/\d{4}$/'],
        ]);

        $nilai = Nilai::create($validated);

        AuditTrail::record("Guru menambahkan nilai ID {$nilai->id_nilai} untuk siswa ID {$nilai->id_siswa}", $request);

        return redirect()->route('guru.nilai.index')->with('success', 'Nilai berhasil ditambahkan.');
    }

    public function edit(Request $request, Nilai $nilai)
    {
        $this->authorizeGuruNilai($nilai);

        AuditTrail::record("Guru membuka form edit nilai ID {$nilai->id_nilai}", $request);

        return view('guru.nilai.edit', compact('nilai'));
    }

    public function update(Request $request, Nilai $nilai)
    {
        $this->authorizeGuruNilai($nilai);

        $validated = $request->validate([
            'nilai_uts' => ['required', 'numeric', 'min:0', 'max:100'],
            'nilai_uas' => ['required', 'numeric', 'min:0', 'max:100'],
            'semester' => ['required', 'string', 'max:20'],
            'tahun_ajaran' => ['required', 'regex:/^\d{4}\/\d{4}$/'],
        ]);

        $nilai->update($validated);

        AuditTrail::record("Guru mengupdate nilai ID {$nilai->id_nilai} milik siswa ID {$nilai->id_siswa}", $request);

        return redirect()->route('guru.nilai.index')->with('success', 'Nilai berhasil diperbarui.');
    }

    public function destroy(Request $request, Nilai $nilai)
    {
        $this->authorizeGuruNilai($nilai);

        $idNilai = $nilai->id_nilai;
        $idSiswa = $nilai->id_siswa;

        $nilai->delete();

        AuditTrail::record("Guru menghapus nilai ID {$idNilai} milik siswa ID {$idSiswa}", $request);

        return redirect()->route('guru.nilai.index')->with('success', 'Nilai berhasil dihapus.');
    }

    private function nilaiQueryForCurrentGuru()
    {
        $query = Nilai::with(['siswa.kelas', 'mataPelajaran']);
        $idGuru = auth()->user()->id_guru;

        if ($idGuru) {
            $query->whereHas('mataPelajaran', fn ($mapel) => $mapel->where('id_guru', $idGuru));
        }

        return $query;
    }

    private function mataPelajaranForCurrentGuru()
    {
        $query = MataPelajaran::query();
        $idGuru = auth()->user()->id_guru;

        if ($idGuru) {
            $query->where('id_guru', $idGuru);
        }

        return $query;
    }

    private function limitMapelRuleToCurrentGuru($query)
    {
        $idGuru = auth()->user()->id_guru;

        if ($idGuru) {
            $query->where('id_guru', $idGuru);
        }

        return $query;
    }

    private function authorizeGuruNilai(Nilai $nilai): void
    {
        $idGuru = auth()->user()->id_guru;

        if ($idGuru && $nilai->mataPelajaran?->id_guru !== $idGuru) {
            abort(403, 'Anda tidak berhak mengakses nilai mata pelajaran ini.');
        }
    }
}
