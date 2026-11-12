<div class="card">
    <div class="card-header bg-transparent border-bottom p-3 p-lg-4">
        <div class="d-flex align-items-center flex-wrap gap-3">
            <div class="d-flex align-items-center gap-3 flex-grow-1">
                <div class="avatar-sm flex-shrink-0">
                    <div class="avatar-title bg-primary-subtle text-primary rounded-circle fs-20">
                        <i class="ri-book-2-line"></i>
                    </div>
                </div>
                <div>
                    <h5 class="fw-bold mb-1">Akuntansi Rekening</h5>
                    <small class="text-muted">Kelola daftar rekening akuntansi sekolah.</small>
                </div>
            </div>
            <div class="flex-shrink-0">
                <button data-bs-toggle="modal" data-bs-target="#CreateAkuntansiRekening" wire:click.prevent="$emit('CreateAkuntansiRekening')" class="btn btn-primary rounded-pill px-4"><i class="ri-play-list-add-line me-1 align-bottom"></i> Rekening Baru</button>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="row g-3 mb-3">
            <div class="col-xxl-8 col-sm-6">
                <div class="search-box">
                    <input type="text" class="form-control search" wire:model.debounce.300ms="search" placeholder="cari nama, deskripsi atau lainnya...">
                    <i class="ri-search-line search-icon"></i>
                </div>
            </div>
            <div class="col-xxl-4 col-sm-6"> 
                <select wire:model="selectedKelompokRekening" style="cursor: pointer" class="form-select" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Pilih Kategori">
                    <option value="">Semua Kelompok Rekening</option>
                    @foreach ($select_kelompok as $item)    
                        <option value="{{ $item->akuntansi_kelompok_rekening_id }}">
                            {{ $item->nama_kelompok_rekening }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <!--end row-->
        <div class="live-preview">
            <div class="table-responsive">
                <table class="table table-hover nowrap align-middle" style="width:100%">
                    <thead class="table-light">
                        <tr>
                            <th class="text-uppercase" width="50px">NO</th>
                            {{-- <th class="text-uppercase" style="width: 50px;">Hapus</th> --}}
                            <th class="text-uppercase">Akun Rekening</th>
                            <th class="text-uppercase text-center">Kelompok Rekening</th>
                            <th class="text-uppercase text-center">posisi normal</th>
                            {{-- <th class="text-uppercase">aksi</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($rekening as $item)
                        <tr>
                            <td>{{ $loop->iteration }}.</td>
                            {{-- <td>
                                <a href="#ModalDeleteJenisTagihan" data-bs-toggle="modal" class="btn btn-soft-danger d-inline-flex align-items-center gap-1" wire:click.prevent="$emit('confirmDelete', {{ $item->akuntansi_rekening_id }})" data-bs-trigger="hover" data-bs-placement="top" title="Hapus Tagihan">
                                    <i class="ri-delete-bin-5-line"></i>
                                </a>
                            </td> --}}
                            <td class="text-start">
                                <span class="fs-14">
                                    {!! $item->kode_rekening . ' - <i>' . ucfirst($item->nama_rekening) . '</i>' !!}
                                </span>
                                <p class="text-muted mb-0">{{ $item->deskripsi ?? '' }}</p>
                            </td>
                            <td class="text-center">
                                <span class="fs-14">
                                    {{ $item->akuntansi_kelompok_rekening->nama_kelompok_rekening }}
                                </span>
                                <p class="text-muted mb-0">{{ $item->tipe_akun ?? 'Tidak Diketahui' }}</p>
                            </td>
                            <td class="text-center">{{ $item->posisi_normal }}</td>
                            {{-- <td>
                                <ul class="list-inline hstack gap-2 mb-0">
                                    <li class="list-inline-item detail" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Edit Kategori">
                                        <a href="#ModalEditJenisTagihan" data-bs-toggle="modal" class="btn btn-primary d-inline-flex align-items-center gap-1"  wire:click.prevent="$emit('loadDataJenisTagihan', {{ $item->akuntansi_rekening_id }})">
                                            <i class="ri-quill-pen-line align-bottom"></i> Edit
                                        </a>
                                    </li>
                                </ul>
                            </td> --}}  
                        </tr>
                        @empty
                            <tr>
                                <td colspan="7">
                                    <div class="noresult text-center py-3">
                                        <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop" 
                                                colors="primary:#405189,secondary:#08a88a" 
                                                style="width:75px;height:75px"></lord-icon>
                                        <h5 class="mt-2">Maaf, Tidak Ada Data yang Ditemukan</h5>
                                        <p class="text-muted mb-0">Kami telah mencari keseluruhan data, namun tidak ditemukan hasil yang sesuai.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>