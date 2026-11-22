<?php

namespace App\Http\Controllers\Akademik;

use App\Http\Controllers\Controller;

class AkademikSetupController extends Controller
{
    public function semester()
    {
        return $this->page([
            'title' => 'Semester / Periode Akademik',
            'description' => 'Kelola periode akademik sebagai acuan kegiatan belajar dan administrasi sekolah.',
            'icon' => 'mdi-calendar-range-outline',
            'addLabel' => 'Tambah Periode',
            'stats' => [
                ['label' => 'Periode Aktif', 'value' => '1', 'note' => 'Tahun ajaran 2026/2027', 'icon' => 'mdi-calendar-check-outline', 'color' => 'success'],
                ['label' => 'Total Periode', 'value' => '8', 'note' => 'Semester yang tercatat', 'icon' => 'mdi-calendar-multiple', 'color' => 'primary'],
                ['label' => 'Akan Datang', 'value' => '1', 'note' => 'Siap untuk disiapkan', 'icon' => 'mdi-calendar-arrow-right', 'color' => 'warning'],
            ],
            'columns' => ['periode' => 'Periode', 'tahun_ajaran' => 'Tahun Ajaran', 'tanggal' => 'Rentang Tanggal', 'status' => 'Status'],
            'rows' => [
                ['periode' => 'Semester Ganjil', 'tahun_ajaran' => '2026/2027', 'tanggal' => '13 Juli 2026 – 18 Desember 2026', 'status' => 'Aktif'],
                ['periode' => 'Semester Genap', 'tahun_ajaran' => '2026/2027', 'tanggal' => '4 Januari 2027 – 18 Juni 2027', 'status' => 'Akan Datang'],
                ['periode' => 'Semester Genap', 'tahun_ajaran' => '2025/2026', 'tanggal' => '5 Januari 2026 – 19 Juni 2026', 'status' => 'Selesai'],
            ],
        ]);
    }

    public function mataPelajaran()
    {
        return $this->page([
            'title' => 'Master Mata Pelajaran',
            'description' => 'Daftar mata pelajaran, kelompok, dan alokasi jam belajar yang digunakan sekolah.',
            'icon' => 'mdi-book-open-page-variant-outline',
            'addLabel' => 'Tambah Mata Pelajaran',
            'stats' => [
                ['label' => 'Mata Pelajaran', 'value' => '18', 'note' => 'Terdaftar di sekolah', 'icon' => 'mdi-book-multiple-outline', 'color' => 'primary'],
                ['label' => 'Kelompok', 'value' => '4', 'note' => 'Kategori pembelajaran', 'icon' => 'mdi-shape-outline', 'color' => 'info'],
                ['label' => 'Status Aktif', 'value' => '17', 'note' => 'Siap ditugaskan', 'icon' => 'mdi-check-circle-outline', 'color' => 'success'],
            ],
            'columns' => ['kode' => 'Kode', 'nama' => 'Mata Pelajaran', 'kelompok' => 'Kelompok', 'jenjang' => 'Jenjang', 'jam' => 'Jam / Minggu', 'status' => 'Status'],
            'rows' => [
                ['kode' => 'MTK', 'nama' => 'Matematika', 'kelompok' => 'Umum', 'jenjang' => 'SMP', 'jam' => '5 jam', 'status' => 'Aktif'],
                ['kode' => 'BIN', 'nama' => 'Bahasa Indonesia', 'kelompok' => 'Umum', 'jenjang' => 'SMP', 'jam' => '6 jam', 'status' => 'Aktif'],
                ['kode' => 'IPA', 'nama' => 'Ilmu Pengetahuan Alam', 'kelompok' => 'Umum', 'jenjang' => 'SMP', 'jam' => '5 jam', 'status' => 'Aktif'],
                ['kode' => 'TIK', 'nama' => 'Informatika', 'kelompok' => 'Pilihan', 'jenjang' => 'SMP', 'jam' => '2 jam', 'status' => 'Nonaktif'],
            ],
        ]);
    }

    public function dataGuru()
    {
        return $this->page([
            'title' => 'Data Guru / Pegawai',
            'description' => 'Direktori tenaga pendidik dan pegawai sebagai dasar penugasan akademik.',
            'icon' => 'mdi-account-tie-outline',
            'addLabel' => 'Tambah Guru / Pegawai',
            'stats' => [
                ['label' => 'Total Guru', 'value' => '32', 'note' => 'Tenaga pendidik', 'icon' => 'mdi-account-school-outline', 'color' => 'primary'],
                ['label' => 'Pegawai', 'value' => '8', 'note' => 'Tenaga kependidikan', 'icon' => 'mdi-account-group-outline', 'color' => 'info'],
                ['label' => 'Aktif Mengajar', 'value' => '29', 'note' => 'Pada periode berjalan', 'icon' => 'mdi-account-check-outline', 'color' => 'success'],
            ],
            'columns' => ['nama' => 'Nama', 'nip' => 'NIP / NIK', 'jabatan' => 'Jabatan', 'bidang' => 'Bidang / Keahlian', 'status' => 'Status'],
            'rows' => [
                ['nama' => 'Siti Rahmawati, S.Pd.', 'nip' => '19870512 201001 2 004', 'jabatan' => 'Guru', 'bidang' => 'Matematika', 'status' => 'Aktif'],
                ['nama' => 'Budi Santoso, S.Pd.', 'nip' => '19890308 201203 1 007', 'jabatan' => 'Guru', 'bidang' => 'Bahasa Indonesia', 'status' => 'Aktif'],
                ['nama' => 'Dewi Anggraini, S.Pd.', 'nip' => '19910221 201503 2 003', 'jabatan' => 'Guru', 'bidang' => 'Ilmu Pengetahuan Alam', 'status' => 'Aktif'],
                ['nama' => 'Agus Setiawan', 'nip' => '19860117 200901 1 002', 'jabatan' => 'Tenaga Kependidikan', 'bidang' => 'Administrasi', 'status' => 'Cuti'],
            ],
        ]);
    }

    public function jadwalMengajar()
    {
        return $this->page([
            'title' => 'Jadwal Mengajar',
            'description' => 'Gambaran jadwal kegiatan belajar mengajar berdasarkan hari, kelas, dan guru.',
            'icon' => 'mdi-calendar-clock-outline',
            'addLabel' => 'Tambah Jadwal',
            'stats' => [
                ['label' => 'Sesi Mingguan', 'value' => '148', 'note' => 'Seluruh kelas', 'icon' => 'mdi-calendar-week-outline', 'color' => 'primary'],
                ['label' => 'Kelas Terjadwal', 'value' => '12', 'note' => 'Pada periode aktif', 'icon' => 'mdi-google-classroom', 'color' => 'info'],
                ['label' => 'Perlu Ditinjau', 'value' => '2', 'note' => 'Jadwal belum lengkap', 'icon' => 'mdi-calendar-alert-outline', 'color' => 'warning'],
            ],
            'columns' => ['hari' => 'Hari', 'waktu' => 'Waktu', 'kelas' => 'Kelas', 'pelajaran' => 'Mata Pelajaran', 'guru' => 'Guru', 'status' => 'Status'],
            'rows' => [
                ['hari' => 'Senin', 'waktu' => '07.30 – 09.00', 'kelas' => 'VII A', 'pelajaran' => 'Matematika', 'guru' => 'Siti Rahmawati, S.Pd.', 'status' => 'Terjadwal'],
                ['hari' => 'Senin', 'waktu' => '09.15 – 10.45', 'kelas' => 'VIII A', 'pelajaran' => 'Bahasa Indonesia', 'guru' => 'Budi Santoso, S.Pd.', 'status' => 'Terjadwal'],
                ['hari' => 'Selasa', 'waktu' => '08.00 – 09.30', 'kelas' => 'VII B', 'pelajaran' => 'Ilmu Pengetahuan Alam', 'guru' => 'Dewi Anggraini, S.Pd.', 'status' => 'Terjadwal'],
            ],
        ]);
    }

    public function penilaianAkademik()
    {
        return $this->page([
            'title' => 'Penilaian Akademik',
            'description' => 'Pantau periode dan progres penilaian akademik siswa untuk setiap mata pelajaran.',
            'icon' => 'mdi-clipboard-text-outline',
            'addLabel' => 'Buat Penilaian',
            'stats' => [
                ['label' => 'Penilaian Berjalan', 'value' => '24', 'note' => 'Pada semester ini', 'icon' => 'mdi-clipboard-list-outline', 'color' => 'primary'],
                ['label' => 'Nilai Terinput', 'value' => '82%', 'note' => 'Rata-rata progres', 'icon' => 'mdi-chart-box-outline', 'color' => 'success'],
                ['label' => 'Menunggu Nilai', 'value' => '6', 'note' => 'Penilaian belum lengkap', 'icon' => 'mdi-clock-alert-outline', 'color' => 'warning'],
            ],
            'columns' => ['penilaian' => 'Penilaian', 'pelajaran' => 'Mata Pelajaran', 'kelas' => 'Kelas', 'guru' => 'Guru', 'tanggal' => 'Tanggal', 'progres' => 'Progres'],
            'rows' => [
                ['penilaian' => 'Ulangan Harian 1', 'pelajaran' => 'Matematika', 'kelas' => 'VII A', 'guru' => 'Siti Rahmawati, S.Pd.', 'tanggal' => '18 November 2026', 'progres' => '30 / 32 siswa'],
                ['penilaian' => 'Tugas Bab 3', 'pelajaran' => 'Bahasa Indonesia', 'kelas' => 'VIII A', 'guru' => 'Budi Santoso, S.Pd.', 'tanggal' => '20 November 2026', 'progres' => '28 / 30 siswa'],
                ['penilaian' => 'Praktik Sistem Organ', 'pelajaran' => 'Ilmu Pengetahuan Alam', 'kelas' => 'VII B', 'guru' => 'Dewi Anggraini, S.Pd.', 'tanggal' => '21 November 2026', 'progres' => 'Belum dimulai'],
            ],
        ]);
    }

    private function page(array $page)
    {
        return view('akademik.setup', compact('page'));
    }
}
