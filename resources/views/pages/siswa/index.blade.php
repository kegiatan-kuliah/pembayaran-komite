@extends('layouts.app')
@section('title', 'Data Siswa')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h3 class="card-title">List Siswa</h3>

                    <div class="card-tools">
                        <a href="{{ route('siswa.new') }}" class="btn btn-primary">Tambah Siswa</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="d-flex flex-row">
                        {{ html()->form('POST', route('siswa.filter'))->class('d-flex flex-row')->open() }}
                            {{ html()->label('Kelas', 'id_kelas')->class('form-label mr-2') }}
                            {{ html()->select('id_kelas', ['' => 'Pilih Kelas'] + $kelas->toArray(), $kelas_id)->attribute('required', true)
                                    ->class('form-control mr-2')
                            }}
                            <a href="{{ route('siswa.index') }}" class="btn btn-default">Reset</a>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        {{ html()->form()->close() }}
                    </div>
                    {{ $dataTable->table() }}
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush
