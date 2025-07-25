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
                                <th>Tanggal Pembayaran</th>
                                <th>Nama Siswa</th>
                                <th>Bulan</th>
                                <th>Biaya</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Bukti Pembayaran</th>
                                <th></th>
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
                                    <td>{{ $pembayaran->created_at->format('Y-m-d') }}</td>
                                    <td>{{ $pembayaran->user->nama }}</td>
                                    <td>{{ $pembayaran->date }}</td>
                                    <td>Rp {{ number_format($pembayaran->biaya, 0, ",", ".") }}</td>
                                    <td>Rp {{ number_format($pembayaran->total, 0, ",", ".") }}</td>
                                    <td>{{ $pembayaran->status }}</td>
                                    <td>
                                        <a href="{{ asset('storage/'.$pembayaran->resi) }}" target="_blank">Lihat</a>
                                    </td>
                                    <td>
                                        @if($pembayaran->status === 'TERBAYAR')
                                            <a href="{{ route('pembayaran.receipt', $pembayaran->id) }}" target="__blank">Lihat Tanda Terima</a>
                                        @endif
                                        @if($pembayaran->status === 'PENDING' && Auth::user()->role === 'ADMIN')
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal{{$pembayaran->id}}">
                                                Konfirmasi Pembayaran
                                            </button>
                                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#rejectModal{{$pembayaran->id}}">
                                                Tolak Pembayaran
                                            </button>
                                            <div class="modal fade" id="exampleModal{{$pembayaran->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    {{ html()->form('POST', route('pembayaran.confirm'))->open() }}
                                                    {{ html()->hidden('id', $pembayaran->id) }}
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Pembayaran</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Apakah anda ingin mengkonfirmasi pembayaran ini?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Confirm</button>
                                                        </div>
                                                    </div>
                                                    {{ html()->form()->close() }}
                                                </div>
                                            </div>
                                            <div class="modal fade" id="rejectModal{{$pembayaran->id}}" tabindex="-1" role="dialog" aria-labelledby="rejectModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    {{ html()->form('POST', route('pembayaran.reject'))->open() }}
                                                    {{ html()->hidden('id', $pembayaran->id) }}
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="rejectModalLabel">Tolak Pembayaran</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Apakah anda ingin menolak pembayaran ini?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Confirm</button>
                                                        </div>
                                                    </div>
                                                    {{ html()->form()->close() }}
                                                </div>
                                            </div>
                                        @endif
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
