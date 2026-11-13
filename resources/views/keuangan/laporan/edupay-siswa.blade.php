@extends('template_keuangan.v_template')
@section('content') 
<div class="page-content">
    <div class="container-fluid" style="max-width: 100%">
        <div class="row">
            <div class="col-12">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                    <div class="card-body p-3 p-lg-4">
                        <div class="d-flex flex-column flex-xl-row align-items-xl-center justify-content-between gap-4">
                            @livewire('keuangan.parameter.informasi-tahun-ajar', ['heading' => 'Laporan EduPay Siswa'])

                            <div class="flex-shrink-0">
                                @livewire('keuangan.parameter.jenjang-tahun-ajar')   
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xxl-4">
                @livewire('keuangan.laporan-edu-pay-siswa.overview')  
                @livewire('keuangan.laporan-edu-pay-siswa.saldo')   
                @livewire('keuangan.laporan-edu-pay-siswa.withdraw')   
            </div>  
            <div class="col-xxl-8">
                @livewire('keuangan.parameter.filter-laporan-edu-pay')   
                @livewire('keuangan.laporan-edu-pay-siswa.index')   
            </div>  
        </div>
    </div>
</div>
@endsection

