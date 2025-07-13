@extends('layouts.app')
@section('title', 'Data Admin')
@section('content')
    <div class="row">
        <div class="col-lg-6">
            {{ html()->form('POST', route('admin.store'))->open() }}
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h3 class="card-title">Tambah Admin Baru</h3>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        {{ html()->label('Nama', 'nama')->class('form-label') }}
                        {{ html()->input('text', 'nama')
                        ->class('form-control')->attribute('required', true)
                        ->attribute('placeholder', 'Isikan nama') }}
                    </div>
                    <div class="mb-3">
                        {{ html()->label('Username', 'username')->class('form-label') }}
                        {{ html()->input('text', 'username')
                        ->class('form-control')->attribute('required', true)
                        ->attribute('placeholder', 'Isikan username') }}
                    </div>
                    <div class="mb-3">
                        {{ html()->label('Password', 'password')->class('form-label') }}
                        {{ html()->input('password', 'password')
                        ->class('form-control')->attribute('required', true)
                        ->attribute('placeholder', 'Isikan username') }}
                    </div>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.index') }}" class="btn btn-default">Kembali</a>
                        {{ html()->button('Simpan')->class('btn btn-primary')->attribute('type', 'submit') }}
                    </div>
                </div>
            </div>
            {{ html()->form()->close() }}
        </div>
    </div>
@endsection
