@extends('template_keuangan.v_template')
@section('content') 
<div class="page-content">
    <div class="container-fluid" style="max-width: 100%">
        <div class="row">
            <div class="col-12">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                    <div class="card-body p-3 p-lg-4">
                        <div class="d-flex flex-column flex-xl-row align-items-xl-center justify-content-between gap-4">
                            @livewire('keuangan.dashboard.informasi-tahun-ajar', ['heading' => 'Konfigurasi Tagihan Siswa'])

                            <div class="flex-shrink-0">
                                @livewire('keuangan.parameter.jenjang-tahun-ajar')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <!--end col-->
            <div class="col-xxl-4">
                <div class="sticky-side-div">
                    @livewire('keuangan.kategori-tagihan-siswa.index')   
                </div>
                @livewire('keuangan.kategori-tagihan-siswa.create')   
                @livewire('keuangan.kategori-tagihan-siswa.edit')   
                @livewire('keuangan.kategori-tagihan-siswa.delete')   
                @livewire('keuangan.kategori-tagihan-siswa.detail')
            </div>
            <div class="col-xxl-8">
                @livewire('keuangan.jenis-tagihan-siswa.index')   
                @livewire('keuangan.jenis-tagihan-siswa.create')   
                @livewire('keuangan.jenis-tagihan-siswa.edit')   
                @livewire('keuangan.jenis-tagihan-siswa.delete')   
                @livewire('keuangan.jenis-tagihan-siswa.import')   
                @livewire('keuangan.jenis-tagihan-siswa.detail')
            </div>
        </div>        
    </div>
</div>
@endsection
