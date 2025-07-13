@extends('layouts.app')
@section('title', 'Riwayat Pembayaran')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h3 class="card-title">Detail</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Bulan</th>
                                <th>Biaya</th>
                                <th>Total</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $total = 0;    
                            @endphp
                            @foreach($pembayarans as $index => $pembayaran)
                                @php
                                    $total += $pembayaran->total;
                                @endphp
                                <tr>
                                    <td>{{ $index + 1 }}</td>
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
