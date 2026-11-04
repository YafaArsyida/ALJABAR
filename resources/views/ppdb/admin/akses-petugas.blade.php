@extends('template_ppdb.v_template')

@section('content')
<div class="page-content">
    <div class="container-fluid" style="max-width: 100%">
        <div class="row">
            <div class="col-12">
                @livewire('p-p-d-b.admin.akses-petugas.index')
                @livewire('p-p-d-b.admin.akses-petugas.create')
                @livewire('p-p-d-b.admin.akses-petugas.detail')
                @livewire('p-p-d-b.admin.akses-petugas.edit')
                @livewire('p-p-d-b.admin.akses-petugas.delete')
                @livewire('p-p-d-b.admin.akses-petugas.akses')
            </div>
        </div>
    </div>
</div>
@endsection
