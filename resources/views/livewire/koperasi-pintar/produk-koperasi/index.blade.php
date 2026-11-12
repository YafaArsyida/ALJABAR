 <div class="card" id="produkList">
    <div class="card-header bg-transparent border-bottom p-3 p-lg-4">
        <div class="d-flex align-items-center flex-wrap gap-3">
            <div class="d-flex align-items-center gap-3 flex-grow-1">
                <div class="avatar-sm flex-shrink-0">
                    <div class="avatar-title bg-primary-subtle text-primary rounded-circle fs-20">
                        <i class="ri-store-2-line"></i>
                    </div>
                </div>
                <div>
                    <h5 class="fw-bold mb-1">Administrasi Produk KoperasiPintar</h5>
                    <small class="text-muted">Kelola produk koperasi untuk jenjang terpilih.</small>
                </div>
            </div>
            <div class="d-flex gap-2 flex-wrap flex-shrink-0">
                    <button type="button" class="btn btn-primary rounded-pill px-4 add-btn" data-bs-toggle="modal" 
                        data-bs-target="#ModalTambahProdukKoperasi"
                        wire:click="$emit('showCreateProdukKoperasi', {{ $selectedJenjang ?? 'null' }})">
                        <i class="ri-add-line align-bottom me-1"></i> Tambah Produk
                    </button>
                    <button type="button" class="btn btn-primary rounded-pill px-4">
                        <i class="ri-file-download-line align-bottom me-1"></i> Import
                    </button>
                    <button class="btn btn-soft-danger rounded-pill px-4" id="remove-actions" onClick="deleteMultiple()">
                        <i class="ri-delete-bin-2-line"></i>
                    </button>
            </div>
        </div>
    </div>

    <!-- Search & Filter -->
    <div class="card-body border border-dashed border-end-0 border-start-0">
        <form>
            <div class="row g-3">
                <div class="col-xxl-10 col-sm-8">
                    <div class="search-box">
                        <input type="text" class="form-control search" wire:model.debounce.300ms="search" placeholder="Cari nama produk...">
                        <i class="ri-search-line search-icon"></i>
                    </div>
                </div>
                <div class="col-xxl-2 col-sm-4">
                    <button type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasKategori" aria-controls="offcanvasKategori" class="btn btn-primary w-100">
                        <i class="ri-equalizer-fill me-1 align-bottom"></i> Master Kategori Produk
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Tabs kategori -->
    <div class="card-body pt-0">
        <ul class="nav nav-tabs nav-tabs-custom nav-success" role="tablist">
            <!-- Tab Semua Produk -->
            <li class="nav-item">
                <a class="nav-link py-3 {{ $activeTab === 'semua' ? 'active' : '' }}" 
                wire:click="setActiveTab('semua')" 
                data-bs-toggle="tab" href="#tabAll" role="tab">
                    <i class="ri-store-2-fill me-1 align-bottom"></i> Semua Produk
                </a>
            </li>

            <!-- Tab berdasarkan kategori -->
            @foreach($kategori as $item)
            <li class="nav-item">
                <a class="nav-link py-3 {{ $activeTab === 'kategori-'.$item->ms_kategori_produk_koperasi_id ? 'active' : '' }}" 
                wire:click="setActiveTab('kategori-{{ $item->ms_kategori_produk_koperasi_id }}')" 
                data-bs-toggle="tab" href="#tabKategori{{ $item->ms_kategori_produk_koperasi_id }}" role="tab">
                    <i class="{{ $item->icon ?? 'mdi mdi-tag' }} me-1 align-bottom"></i>
                    {{ $item->nama_kategori_produk_koperasi }}
                </a>
            </li>
            @endforeach
            <!-- Tombol Offcanvas di Kanan -->
            <li class="nav-item">
                <button data-bs-toggle="modal" 
                    data-bs-target="#ModalTambahKategoriKoperasi" wire:click="$emit('showCreateKategoriKoperasi', {{ $selectedJenjang ?? 'null' }})" class="btn btn-sm shadow-none nav-link py-3">
                    <i class="ri-add-line me-1 align-bottom"></i> Tambah Kategori
                </button>
            </li>
        </ul>

        <div class="tab-content mt-3">

            <!-- Semua Produk -->
            <div class="tab-pane fade {{ $activeTab === 'semua' ? 'show active' : '' }}" id="tabAll" role="tabpanel">
                <div class="row g-3">
                    @include('livewire.koperasi-pintar.produk-koperasi.tabel-produk', ['listProduk' => $allProduk])
                </div>
            </div>

            <!-- Produk per Kategori -->
            @foreach($kategori as $kat)
            <div class="tab-pane fade {{ $activeTab === 'kategori-'.$kat->ms_kategori_produk_koperasi_id ? 'show active' : '' }}" 
                id="tabKategori{{ $kat->ms_kategori_produk_koperasi_id }}" role="tabpanel">
                <div class="row g-3">
                    @php
                        $produkKategori = $allProduk->where('ms_kategori_produk_koperasi_id', $kat->ms_kategori_produk_koperasi_id);
                    @endphp

                    @include('livewire.koperasi-pintar.produk-koperasi.tabel-produk', ['listProduk' => $produkKategori])
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>