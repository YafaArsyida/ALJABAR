@extends('template_keuangan.v_template')
@section('content')
<div class="page-content">
    <div class="container-fluid" style="max-width: 100%">
        <div class="row">
            <div class="col-12">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                    <div class="card-body p-3 p-lg-4">
                        <div class="d-flex flex-column flex-xl-row align-items-xl-center justify-content-between gap-4">
                            @livewire('keuangan.dashboard.informasi-tahun-ajar', ['heading' => 'Transaksi Tabungan Siswa'])

                            <div class="flex-shrink-0">
                                @livewire('keuangan.parameter.jenjang-tahun-ajar-siswa')   
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xxl-4">
                <div class="sticky-side-div">
                    @livewire('keuangan.transaksi-tabungan-siswa.data-siswa')
                </div>
            </div>
            <!--end col-->
            <div class="col-xxl-8">
                @livewire('keuangan.transaksi-tabungan-siswa.data-tabungan')
                @livewire('keuangan.transaksi-tabungan-siswa.delete')
                @livewire('keuangan.transaksi-tabungan-siswa.detail')
                @livewire('keuangan.transaksi-tabungan-siswa.edit')
            </div>
        </div>
    </div>
</div><!-- End Page-content -->
@endsection

