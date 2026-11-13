@extends('template_keuangan.v_template')
@section('content')

@php
    $title = "Dashboard"
@endphp
@push('info-page')
    <div class="page-title-right">
        <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="javascript: void(0);">Pages</a></li>
            <li class="breadcrumb-item active">{{ $title ?? "SmartGate" }}</li>
        </ol>
    </div>
@endpush
<div class="page-content">
    <div class="container-fluid" style="max-width: 100%">
        <div class="row">
            <div class="col-12">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                    <div class="card-body p-3 p-lg-4">
                        <div class="d-flex flex-column flex-xl-row align-items-xl-center justify-content-between gap-4">
                            @livewire('keuangan.parameter.informasi-tahun-ajar')

                            <div class="flex-shrink-0">
                                @livewire('keuangan.parameter.jenjang-tahun-ajar')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xxl-5">
                <div class="d-flex flex-column h-100">
                    <div class="row h-100">
                        <div class="col-12">
                            @livewire('keuangan.widget.c-t-a-menu-transaksi-tagihan-siswa')   
                        </div> <!-- end col-->
                    </div> <!-- end row-->

                    <div class="row">
                        {{-- kartu jumlah siswa --}}
                        @livewire('keuangan.widget.kartu-jumlah-siswa')   
                        @livewire('keuangan.widget.kartu-jumlah-tagihan-siswa')   
                        @livewire('keuangan.widget.kartu-jumlah-jurnal-pendapatan')   
                        @livewire('keuangan.widget.kartu-jumlah-jurnal-pengeluaran')   
                    </div> <!-- end row-->
                </div>
            </div> <!-- end col-->
            <div class="col-xxl-7">
                <div class="row h-100">
                    <div class="col-xl-8">
                        @livewire('keuangan.widget.overview-tagihan-siswa')   
                    </div>
                    <div class="col-xl-4">
                        @livewire('keuangan.widget.progres-tagihan-siswa')   
                    </div>
                </div> <!-- end row-->
            </div><!-- end col -->
        </div>
         <div class="row">
            <div class="col-xl-4">
                @livewire('keuangan.widget.kartu-transaksi-jurnal')   
            </div>
            <div class="col-xl-8">
                @livewire('keuangan.widget.kartu-jurnal-detail')   
            </div>
        </div><!-- end row -->
    </div>
</div>
@endsection
