@extends('layouts.app')
@section('title', 'Pembayaran')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h3 class="card-title">Laporan Pembayaran</h3>
                    
                    <div class="card-tools">
                        <div class="d-flex flex-row">
                            {{ html()->form('POST', route('laporan.process'))->open() }}
                                <div class="d-flex">
                                    {{ html()->input('month', 'date', $query)->class('form-control mr-5')->attribute('required', true) }}
                                    <button type="submit" class="btn btn-primary">
                                        Buat Laporan
                                    </button>
                                </div>
                            {{ html()->form()->close() }}

                            @if($query) 
                                {{ html()->form('POST', route('laporan.print'))->open() }}
                                    {{ html()->input('hidden', 'date', $query)->class('form-control mr-5')->attribute('required', true) }}
                                    <button type="submit" class="btn btn-primary ml-5">
                                        Cetak Laporan
                                    </button>
                                {{ html()->form()->close() }}
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Siswa</th>
                                <th>Tanggal Pembayaran</th>
                                <th>Bulan</th>
                                <th>Biaya</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Bukti Bayar</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pembayarans as $index => $pembayaran)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $pembayaran->user->nama }}</td>
                                    <td>{{ $pembayaran->created_at->format('Y-m-d') }}</td>
                                    <td>{{ $pembayaran->date }}</td>
                                    <td>Rp {{ number_format($pembayaran->biaya, 0, ",", ".") }}</td>
                                    <td>Rp {{ number_format($pembayaran->total, 0, ",", ".") }}</td>
                                    <td>{{ $pembayaran->status }}</td>
                                    <td>
                                        <a href="{{ asset('storage/'.$pembayaran->resi) }}" target="_blank">Lihat</a>
                                    </td>
                                    <td>
                                        <a href="{{ route('pembayaran.receipt', $pembayaran->id) }}" target="__blank">Lihat Tanda Terima</a>
                                    </td>
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
