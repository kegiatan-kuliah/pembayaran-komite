@extends('layouts.app')
@section('title', 'Data Siswa')
@section('content')
    <div class="row">
        <div class="col-lg-6">
            {{ html()->form('POST', route('siswa.store'))->open() }}
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h3 class="card-title">Tambah Siswa Baru</h3>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        {{ html()->label('Nama', 'nama')->class('form-label') }}
                        {{ html()->input('text', 'nama')
                        ->class('form-control')->attribute('required', true)
                        ->attribute('placeholder', 'Isikan nama') }}
                    </div>
                    <div class="mb-3">
                        {{ html()->label('NISN', 'nisn')->class('form-label') }}
                        {{ html()->input('text', 'nisn')
                        ->class('form-control')->attribute('required', true)
                        ->attribute('placeholder', 'Isikan nisn') }}
                    </div>
                    <div class="mb-3">
                        {{ html()->label('Kelas', 'id_kelas')->class('form-label') }}
                        {{ html()->select('id_kelas', ['' => 'Pilih Kelas'] + $kelas->toArray())->attribute('required', true)
                                ->class('form-control')
                        }}
                    </div>
                    <div class="mb-3">
                        {{ html()->label('Angkatan', 'id_angkatan')->class('form-label') }}
                        {{ html()->select('id_angkatan', ['' => 'Pilih Angkatan'] + $angkatans->toArray())->attribute('required', true)
                                ->class('form-control')
                        }}
                    </div>
                    <div class="mb-3">
                        {{ html()->label('Alamat', 'alamat')->class('form-label') }}
                        {{ html()->textarea('alamat')
                        ->class('form-control')->attribute('required', true)
                        ->attribute('placeholder', 'Isikan alamat') }}
                    </div>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('siswa.index') }}" class="btn btn-default">Kembali</a>
                        {{ html()->button('Simpan')->class('btn btn-primary')->attribute('type', 'submit') }}
                    </div>
                </div>
            </div>
            {{ html()->form()->close() }}
        </div>
    </div>
@endsection
