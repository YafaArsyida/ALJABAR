@extends('template_keuangan.v_template')
@section('content') 
<div class="page-content">
    <div class="container-fluid" style="max-width: 100%">
        <div class="row">
            <div class="col-12">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                    <div class="card-body p-3 p-lg-4">
                        <div class="d-flex flex-column flex-xl-row align-items-xl-center justify-content-between gap-4">
                            @livewire('keuangan.dashboard.informasi-tahun-ajar', ['heading' => 'Jenis Tagihan Siswa'])

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
                @livewire('keuangan.tagihan-siswa.edit')   
                @livewire('keuangan.tagihan-siswa.create')  

                @livewire('keuangan.tagihan-jenis.index')   
                @livewire('keuangan.tagihan-jenis.detail')   
                @livewire('keuangan.tagihan-jenis.manage')  
                
                @livewire('keuangan.tagihan-siswa.delete')   
            </div>  
        </div>
    </div>
</div>
@endsection

