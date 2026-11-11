@extends('template_keuangan.v_template')
@section('content')
<div class="page-content">
    <div class="container-fluid" style="max-width: 100%">
        <div class="row">
            <div class="col-12">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                    <div class="card-body p-3 p-lg-4">
                        <div class="d-flex flex-column flex-xl-row align-items-xl-center justify-content-between gap-4">
                            @livewire('keuangan.dashboard.informasi-tahun-ajar', ['heading' => 'Transaksi Tagihan Siswa'])

                            <div class="flex-shrink-0">
                                @livewire('keuangan.parameter.jenjang-tahun-ajar-siswa')   
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xxl-8">
                @livewire('akademik.siswa.edit')
                @livewire('keuangan.tagihan-siswa.detail')
                @livewire('keuangan.tagihan-siswa.edit')
                @livewire('keuangan.tagihan-siswa.delete')
    
                @livewire('keuangan.transaksi-tagihan-siswa.aksi-tambah')
                @livewire('keuangan.transaksi-tagihan-siswa.index')
                @livewire('keuangan.transaksi-tagihan-siswa.cicilan')
    
                @livewire('keuangan.transaksi-tagihan-siswa.edit')
                @livewire('keuangan.transaksi-tagihan-siswa.detail')
                @livewire('keuangan.transaksi-tagihan-siswa.delete')
                @livewire('keuangan.transaksi-tagihan-siswa.histori')
    
                @livewire('keuangan.transaksi-tabungan-siswa.index')
                @livewire('keuangan.transaksi-tabungan-siswa.delete')
                @livewire('keuangan.transaksi-tabungan-siswa.detail')
                @livewire('keuangan.transaksi-tabungan-siswa.edit')
    
                @livewire('keuangan.transaksi-edu-pay-siswa.index')
                @livewire('keuangan.transaksi-edu-pay-siswa.delete')
                @livewire('keuangan.transaksi-edu-pay-siswa.detail')
                @livewire('keuangan.transaksi-edu-pay-siswa.edit')
            </div>
            <!--end col-->
            <div class="col-xxl-4">
                <div class="sticky-side-div">
                    @livewire('keuangan.transaksi-tagihan-siswa.data-keranjang')
                </div>
            </div>
        </div>
    </div>
</div><!-- End Page-content -->
@endsection

