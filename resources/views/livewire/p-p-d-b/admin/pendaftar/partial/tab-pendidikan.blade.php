<div class="card border-0 shadow-sm rounded-4 overflow-hidden">
    <div class="card-header bg-transparent border-bottom">
        <div class="d-flex align-items-center gap-3">
            <div class="avatar-sm flex-shrink-0">
                <div class="avatar-title bg-primary-subtle text-primary rounded-circle fs-20">
                    <i class="ri-school-line"></i>
                </div>
            </div>

            <div>
                <h5 class="fw-bold mb-1">Pendidikan Sebelumnya</h5>
                <small class="text-muted">
                    Lengkapi informasi riwayat pendidikan calon siswa.
                </small>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="row g-3">
            {{-- JENJANG ASAL --}}
            <div class="col-12">
                <label for="jenjang-asal" class="form-label">
                    Jenjang Pendidikan Asal <span class="text-danger">*</span>
                </label>

                <select
                    id="jenjang-asal"
                    class="form-select @error('jenjang_asal') is-invalid @enderror"
                    wire:model="jenjang_asal"
                >
                    <option value="TK">TK</option>
                    <option value="RA">RA</option>
                    <option value="SD">SD</option>
                    <option value="PAUD">PAUD</option>
                    <option value="TIDAK_ADA">Belum Pernah Bersekolah</option>
                </select>

                @error('jenjang_asal')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            @if ($jenjang_asal !== 'TIDAK_ADA')
                {{-- NAMA SEKOLAH ASAL --}}
                <div class="col-md-6">
                    <label for="asal-sekolah" class="form-label">
                        Nama Pendidikan Sebelumnya
                    </label>

                    <input
                        type="text"
                        id="asal-sekolah"
                        class="form-control @error('asal_sekolah') is-invalid @enderror"
                        wire:model.defer="asal_sekolah"
                        placeholder="Masukkan nama RA, TK, PAUD, atau sekolah"
                        maxlength="255"
                    >

                    @error('asal_sekolah')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- TAHUN LULUS --}}
                <div class="col-md-6">
                    <label for="tahun-lulus" class="form-label">
                        Tahun Lulus
                        <span class="text-muted fw-normal">(Opsional)</span>
                    </label>

                    <select
                        id="tahun-lulus"
                        class="form-select @error('tahun_lulus') is-invalid @enderror"
                        wire:model.defer="tahun_lulus"
                    >
                        <option value="">Pilih tahun lulus</option>

                        @for ($tahun = max((int) date('Y'), 2027); $tahun >= max((int) date('Y'), 2027) - 3; $tahun--)
                            <option value="{{ $tahun }}">{{ $tahun }}</option>
                        @endfor
                    </select>

                    @error('tahun_lulus')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- ALAMAT SEKOLAH ASAL --}}
                <div class="col-12">
                    <label for="alamat-asal-sekolah" class="form-label">
                        Alamat Sekolah Asal
                        <span class="text-muted fw-normal">(Opsional)</span>
                    </label>

                    <textarea
                        id="alamat-asal-sekolah"
                        class="form-control @error('alamat_asal_sekolah') is-invalid @enderror"
                        wire:model.defer="alamat_asal_sekolah"
                        rows="3"
                        maxlength="1000"
                        placeholder="Masukkan alamat lengkap sekolah asal"
                    ></textarea>

                    @error('alamat_asal_sekolah')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- INFORMASI --}}
                <div class="col-12">
                    <div class="alert alert-light border rounded-3 mb-0">
                        <div class="d-flex gap-2">
                            <i class="ri-information-line fs-18 text-primary"></i>
                            <small class="text-muted">
                                Isi data sesuai informasi sekolah sebelumnya.
                            </small>
                        </div>
                    </div>
                </div>
            @else
                <div class="col-12">
                    <div class="alert alert-light border rounded-3 mb-0">
                        <div class="d-flex gap-2">
                            <i class="ri-information-line fs-18 text-primary"></i>
                            <small class="text-muted">
                                Tidak masalah jika calon siswa belum pernah
                                bersekolah di RA, TK, PAUD, atau SD. Informasi
                                sekolah sebelumnya tidak perlu diisi.
                            </small>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>