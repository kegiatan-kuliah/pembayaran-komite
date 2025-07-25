@extends('layouts.app')
@section('title', 'Data Tahun Ajaran')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h3 class="card-title">List Tahun Ajaran</h3>

                    <div class="card-tools">
                        <a href="{{ route('angkatan.new') }}" class="btn btn-primary">Tambah Tahun Ajaran</a>
                    </div>
                </div>
                <div class="card-body">
                    {{ $dataTable->table() }}
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush
