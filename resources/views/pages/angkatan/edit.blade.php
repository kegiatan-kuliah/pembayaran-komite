@extends('layouts.app')
@section('title', 'Data Angkatan')
@section('content')
    <div class="row">
        <div class="col-lg-6">
            {{ html()->form('POST', route('angkatan.update'))->open() }}
            {{ html()->hidden('id', $data->id) }}
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h3 class="card-title">Update Data Angkatan</h3>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        {{ html()->label('Nama', 'nama')->class('form-label') }}
                        {{ html()->input('text', 'nama', $data->nama)
                        ->class('form-control')->attribute('required', true)
                        ->attribute('placeholder', 'Isikan nama') }}
                    </div>
                    <div class="mb-3">
                        {{ html()->label('Biaya', 'biaya')->class('form-label') }}
                        {{ html()->input('number', 'biaya', $data->biaya)
                        ->class('form-control')->attribute('required', true)
                        ->attribute('placeholder', 'Isikan biaya') }}
                    </div>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('angkatan.index') }}" class="btn btn-default">Kembali</a>
                        {{ html()->button('Simpan')->class('btn btn-primary')->attribute('type', 'submit') }}
                    </div>
                </div>
            </div>
            {{ html()->form()->close() }}
        </div>
    </div>
@endsection
