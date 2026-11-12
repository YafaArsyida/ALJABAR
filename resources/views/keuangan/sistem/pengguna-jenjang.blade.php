@extends('template_keuangan.v_template')
@section('content') 
<div class="page-content">
    <div class="container-fluid" style="max-width: 100%">
        <!-- end page title -->
        <div class="row">
            {{-- PENGGUNA --}}
            <div class="col-xxl-10">
                @livewire('keuangan.akses-jenjang.index')   
                {{-- @livewire('pengguna.index')    --}}
                @livewire('keuangan.pengguna.create')
                @livewire('keuangan.pengguna.edit')  
                @livewire('keuangan.pengguna.delete')  
                @livewire('keuangan.pengguna.detail')  
                @livewire('keuangan.pengguna.reset-password')  
            </div>
            <!--end col-->
            {{-- TAHUN AJAR --}}
            <div class="col-xxl-7">
                {{-- AKSES MENU --}}

            </div>
            <!--end col-->
        </div>        
    </div>
</div>
@endsection

