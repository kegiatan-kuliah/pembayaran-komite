@extends('layouts.app')
@section('title', 'Pembayaran')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h3 class="card-title">Laporan Pembayaran</h3>
                    
                    <div class="card-tools">
                        {{ html()->form('POST', route('laporan.process'))->open() }}
                        <div class="d-flex">
                            {{ html()->input('month', 'date')->class('form-control mr-5')->attribute('required', true) }}
                            <button type="submit" class="btn btn-primary">
                                Buat Laporan
                            </button>
                        </div>
                        {{ html()->form()->close() }}
                    </div>
                </div>
                <div class="card-body">
                    <p class="text-center">Silakan Pilih Bulan</p>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    
@endpush
