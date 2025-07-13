@extends('layouts.app')
@section('title', 'Pembayaran')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h3 class="card-title">Laporan Pembayaran</h3>
                    
                    <div class="card-tools">
                        <div class="d-flex">
                            {{ html()->input('month', 'date', $query)->class('form-control mr-5')->attribute('required', true) }}
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                Buat Laporan
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Siswa</th>
                                <th>Bulan</th>
                                <th>Biaya</th>
                                <th>Total</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pembayarans as $index => $pembayaran)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $pembayaran->user->nama }}</td>
                                    <td>{{ $pembayaran->date }}</td>
                                    <td>Rp {{ number_format($pembayaran->biaya, 0, ",", ".") }}</td>
                                    <td>Rp {{ number_format($pembayaran->total, 0, ",", ".") }}</td>
                                    <td>{{ $pembayaran->status }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    
@endpush
