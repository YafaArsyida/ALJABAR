@extends('template_keuangan.v_template')
@section('content') 
<div class="page-content">
    <div class="container-fluid" style="max-width: 100%">
        <div class="row">
            <div class="col-12">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                    <div class="card-body p-3 p-lg-4">
                        <div class="d-flex flex-column flex-xl-row align-items-xl-center justify-content-between gap-4">
                            @livewire('keuangan.parameter.informasi-tahun-ajar', ['heading' => 'Tagihan Siswa'])

                            <div class="flex-shrink-0">
                                @livewire('keuangan.parameter.jenjang-tahun-ajar')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xxl-12">
                @livewire('keuangan.tagihan-siswa.index')   
                @livewire('keuangan.tagihan-siswa.create')   
                @livewire('keuangan.tagihan-siswa.detail')   
                @livewire('keuangan.tagihan-siswa.edit')   
                @livewire('keuangan.tagihan-siswa.manage')   
                @livewire('keuangan.tagihan-siswa.delete')   

                @livewire('keuangan.transaksi-tagihan-siswa.edit')   
                @livewire('keuangan.transaksi-tagihan-siswa.delete')   
                @livewire('keuangan.transaksi-tagihan-siswa.histori')   
                @livewire('keuangan.transaksi-tagihan-siswa.detail')
            </div>  
        </div>
    </div>
</div>
@endsection

