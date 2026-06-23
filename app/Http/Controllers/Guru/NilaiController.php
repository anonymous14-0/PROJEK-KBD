<?php

namespace App\Http\Controllers\Guru;

// Controller dasar Laravel yang menjadi induk controller fitur nilai guru.
use App\Http\Controllers\Controller;
// Model MataPelajaran digunakan untuk mengambil mata pelajaran yang diampu guru login.
use App\Models\MataPelajaran;
// Model Nilai digunakan untuk operasi CRUD data nilai siswa.
use App\Models\Nilai;
// Model Siswa digunakan untuk mengambil siswa sesuai jurusan mata pelajaran guru.
use App\Models\Siswa;
// Service AuditTrail digunakan untuk mencatat aktivitas pengguna ke log audit.
use App\Services\AuditTrail;
// Request membawa data input form dan informasi HTTP dari pengguna.
use Illuminate\Http\Request;
// Rule dipakai untuk aturan validasi lanjutan seperti exists dan unique dengan kondisi tertentu.
use Illuminate\Validation\Rule;
// ValidationException digunakan untuk mengembalikan pesan validasi manual.
use Illuminate\Validation\ValidationException;

// Class ini mengatur seluruh proses CRUD nilai yang hanya boleh dilakukan oleh guru terkait.
class NilaiController extends Controller
{
    /**
     * Menampilkan daftar nilai siswa untuk mata pelajaran yang diampu guru yang sedang login.
     */
    public function index(Request $request)
    {
        // Mengambil data nilai beserta relasi siswa, kelas, dan mata pelajaran milik guru login.
        $nilai = $this->nilaiQueryForCurrentGuru()
            ->latest('updated_at')
            ->get();

        // Mencatat aktivitas guru saat membuka daftar nilai.
        AuditTrail::record('Guru melihat daftar nilai siswa', $request);

        // Mengirim data nilai ke halaman daftar nilai guru.
        return view('guru.nilai.index', compact('nilai'));
    }

    /**
     * Menampilkan form input nilai dengan pilihan siswa dan mata pelajaran yang sesuai hak akses guru.
     */
    public function create(Request $request)
    {
        // Mencatat aktivitas pembukaan form input nilai.
        AuditTrail::record('Guru membuka form input nilai', $request);

        // Mengirim daftar siswa dan mata pelajaran ke view form tambah nilai.
        return view('guru.nilai.create', [
            // Siswa dibatasi berdasarkan jurusan yang diajar guru, lalu diurutkan berdasarkan nama.
            'siswa' => $this->siswaForCurrentGuru()->with('kelas')->orderBy('nama_lengkap')->get(),
            // Mata pelajaran dibatasi hanya yang diampu guru login.
            'mataPelajaran' => $this->mataPelajaranForCurrentGuru()->orderBy('nama_mapel')->get(),
        ]);
    }

    /**
     * Menyimpan data nilai baru setelah validasi siswa, mata pelajaran, semester, dan tahun ajaran.
     */
    public function store(Request $request)
    {
        // Melakukan validasi form agar data nilai lengkap, valid, dan tidak duplikat.
        $validated = $request->validate([
            'id_siswa' => [
                'required',
                'integer',
                // Memastikan siswa ada dan masih berada dalam cakupan jurusan guru login.
                Rule::exists('siswa', 'id_siswa')->where(fn ($query) => $this->limitSiswaRuleToCurrentGuru($query)),
            ],
            'id_mapel' => [
                'required',
                'integer',
                // Memastikan mata pelajaran ada dan benar-benar diampu guru login.
                Rule::exists('mata_pelajaran', 'id_mapel')->where(fn ($query) => $this->limitMapelRuleToCurrentGuru($query)),
                // Mencegah input nilai ganda untuk kombinasi siswa, mapel, semester, dan tahun ajaran yang sama.
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

        // Memastikan jurusan siswa sama dengan jurusan mata pelajaran yang dipilih.
        $this->ensureSiswaMatchesMapelJurusan($validated['id_siswa'], $validated['id_mapel']);

        // Menyimpan data nilai ke database menggunakan Eloquent mass assignment.
        $nilai = Nilai::create($validated);

        // Mencatat aktivitas penambahan nilai ke tabel log audit.
        AuditTrail::record("Guru menambahkan nilai ID {$nilai->id_nilai} untuk siswa ID {$nilai->id_siswa}", $request);

        // Mengarahkan guru kembali ke daftar nilai dengan pesan sukses.
        return redirect()->route('guru.nilai.index')->with('success', 'Nilai berhasil ditambahkan.');
    }

    /**
     * Menampilkan form edit nilai setelah memastikan nilai tersebut milik mata pelajaran guru login.
     */
    public function edit(Request $request, Nilai $nilai)
    {
        // Mengecek otorisasi agar guru tidak mengedit nilai milik guru lain.
        $this->authorizeGuruNilai($nilai);

        // Mencatat aktivitas pembukaan form edit nilai.
        AuditTrail::record("Guru membuka form edit nilai ID {$nilai->id_nilai}", $request);

        // Mengirim data nilai yang akan diedit ke halaman edit.
        return view('guru.nilai.edit', compact('nilai'));
    }

    /**
     * Memperbarui nilai UTS, UAS, semester, dan tahun ajaran yang sudah ada.
     */
    public function update(Request $request, Nilai $nilai)
    {
        // Mengecek hak akses guru terhadap data nilai.
        $this->authorizeGuruNilai($nilai);

        // Validasi nilai agar tetap berada pada rentang 0 sampai 100 dan format tahun ajaran benar.
        $validated = $request->validate([
            'nilai_uts' => ['required', 'numeric', 'min:0', 'max:100'],
            'nilai_uas' => ['required', 'numeric', 'min:0', 'max:100'],
            'semester' => ['required', 'string', 'max:20'],
            'tahun_ajaran' => ['required', 'regex:/^\d{4}\/\d{4}$/'],
        ]);

        // Menyimpan data sebelum perubahan untuk kebutuhan deskripsi audit trail.
        $before = [
            'nilai_uts' => $nilai->nilai_uts,
            'nilai_uas' => $nilai->nilai_uas,
            'semester' => $nilai->semester,
            'tahun_ajaran' => $nilai->tahun_ajaran,
        ];
        // Menyimpan data sesudah perubahan untuk dibandingkan dengan data lama.
        $after = [
            'nilai_uts' => $validated['nilai_uts'],
            'nilai_uas' => $validated['nilai_uas'],
            'semester' => $validated['semester'],
            'tahun_ajaran' => $validated['tahun_ajaran'],
        ];

        // Memperbarui data nilai di database.
        $nilai->update($validated);

        // Membuat ringkasan perubahan yang mudah dibaca pada log audit.
        $detailPerubahan = AuditTrail::describeChanges($before, $after, [
            'nilai_uts' => 'Nilai UTS',
            'nilai_uas' => 'Nilai UAS',
            'semester' => 'Semester',
            'tahun_ajaran' => 'Tahun ajaran',
        ]);

        // Mencatat aktivitas update nilai beserta detail perubahannya.
        AuditTrail::record("Guru mengupdate nilai ID {$nilai->id_nilai} milik siswa ID {$nilai->id_siswa}. {$detailPerubahan}", $request);

        // Mengarahkan kembali ke halaman daftar nilai.
        return redirect()->route('guru.nilai.index')->with('success', 'Nilai berhasil diperbarui.');
    }

    /**
     * Menghapus data nilai yang dipilih oleh guru dari database.
     */
    public function destroy(Request $request, Nilai $nilai)
    {
        // Mengecek bahwa nilai yang dihapus benar-benar berada dalam wewenang guru login.
        $this->authorizeGuruNilai($nilai);

        // Menyimpan ID sebelum data dihapus agar masih dapat dicatat pada audit trail.
        $idNilai = $nilai->id_nilai;
        $idSiswa = $nilai->id_siswa;

        // Menghapus data nilai menggunakan Eloquent.
        $nilai->delete();

        // Mencatat aktivitas penghapusan nilai.
        AuditTrail::record("Guru menghapus nilai ID {$idNilai} milik siswa ID {$idSiswa}", $request);

        // Mengarahkan kembali ke daftar nilai dengan pesan sukses.
        return redirect()->route('guru.nilai.index')->with('success', 'Nilai berhasil dihapus.');
    }

    /**
     * Membuat query dasar nilai yang hanya menampilkan data dari mata pelajaran guru login.
     */
    private function nilaiQueryForCurrentGuru()
    {
        // Eager loading relasi dipakai agar data siswa, kelas, dan mapel tersedia tanpa query berulang.
        $query = Nilai::with(['siswa.kelas', 'mataPelajaran']);
        $idGuru = auth()->user()->id_guru;

        // Jika user tidak memiliki id_guru, query dibuat kosong sebagai pengaman.
        if (! $idGuru) {
            return $query->whereRaw('1 = 0');
        }

        // Membatasi nilai berdasarkan mata pelajaran yang memiliki id_guru sesuai guru login.
        return $query->whereHas('mataPelajaran', fn ($mapel) => $mapel->where('id_guru', $idGuru));
    }

    /**
     * Membuat query mata pelajaran yang diampu oleh guru yang sedang login.
     */
    private function mataPelajaranForCurrentGuru()
    {
        $query = MataPelajaran::query();
        $idGuru = auth()->user()->id_guru;

        // Jika bukan akun guru valid, hasil query dikosongkan.
        if (! $idGuru) {
            return $query->whereRaw('1 = 0');
        }

        // Mengambil hanya mata pelajaran milik guru login.
        return $query->where('id_guru', $idGuru);
    }

    /**
     * Membatasi aturan validasi mata pelajaran agar hanya menerima mapel milik guru login.
     */
    private function limitMapelRuleToCurrentGuru($query)
    {
        $idGuru = auth()->user()->id_guru;

        // Jika id guru tidak tersedia, validasi dibuat selalu gagal.
        if (! $idGuru) {
            $query->whereRaw('1 = 0');

            return $query;
        }

        // Menambahkan kondisi id_guru pada query validasi exists.
        $query->where('id_guru', $idGuru);

        return $query;
    }

    /**
     * Membuat query siswa yang jurusannya sesuai dengan mata pelajaran guru login.
     */
    private function siswaForCurrentGuru()
    {
        // Mengambil daftar jurusan yang diajar oleh guru login.
        $jurusan = $this->jurusanForCurrentGuru();

        // Query siswa dibatasi berdasarkan relasi kelas dan jurusan yang sesuai.
        return Siswa::query()
            ->when($jurusan === [], fn ($query) => $query->whereRaw('1 = 0'))
            ->when($jurusan !== [], fn ($query) => $query->whereHas('kelas', fn ($kelas) => $kelas->whereIn('jurusan', $jurusan)));
    }

    /**
     * Membatasi aturan validasi siswa agar hanya siswa pada jurusan yang diajar guru yang dapat dipilih.
     */
    private function limitSiswaRuleToCurrentGuru($query)
    {
        $jurusan = $this->jurusanForCurrentGuru();

        // Jika guru tidak memiliki jurusan ajar, validasi dibuat selalu gagal.
        if ($jurusan === []) {
            $query->whereRaw('1 = 0');

            return $query;
        }

        // Subquery mengambil id_kelas dari tabel kelas yang jurusannya sesuai.
        $query->whereIn('id_kelas', function ($kelas) use ($jurusan) {
            $kelas->select('id_kelas')
                ->from('kelas')
                ->whereIn('jurusan', $jurusan);
        });

        return $query;
    }

    /**
     * Memastikan jurusan siswa sama dengan jurusan mata pelajaran sebelum nilai disimpan.
     */
    private function ensureSiswaMatchesMapelJurusan(int $idSiswa, int $idMapel): void
    {
        // Mengambil mapel dan siswa sesuai batasan hak akses guru.
        $mapel = $this->mataPelajaranForCurrentGuru()->find($idMapel);
        $siswa = $this->siswaForCurrentGuru()->with('kelas')->find($idSiswa);

        // Jika data tidak cocok, kembalikan pesan error validasi ke form.
        if (! $mapel || ! $siswa || $siswa->kelas?->jurusan !== $mapel->jurusan) {
            throw ValidationException::withMessages([
                'id_siswa' => 'Siswa tidak sesuai dengan jurusan mata pelajaran yang diampu.',
            ]);
        }
    }

    /**
     * Mengambil daftar jurusan berbeda yang diajar oleh guru login.
     */
    private function jurusanForCurrentGuru(): array
    {
        $idGuru = auth()->user()->id_guru;

        // Jika user tidak memiliki id_guru, tidak ada jurusan yang dikembalikan.
        if (! $idGuru) {
            return [];
        }

        // Query mengambil jurusan unik dari mata pelajaran yang diampu guru.
        return MataPelajaran::where('id_guru', $idGuru)
            ->distinct()
            ->pluck('jurusan')
            ->filter()
            ->values()
            ->all();
    }

    /**
     * Mengecek apakah guru login berhak mengakses data nilai tertentu.
     */
    private function authorizeGuruNilai(Nilai $nilai): void
    {
        $idGuru = auth()->user()->id_guru;

        // Jika nilai bukan milik mata pelajaran guru login, proses dihentikan dengan status 403.
        if (! $idGuru || $nilai->mataPelajaran?->id_guru !== $idGuru) {
            abort(403, 'Anda tidak berhak mengakses nilai mata pelajaran ini.');
        }
    }
}
