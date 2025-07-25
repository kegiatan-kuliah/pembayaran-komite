@extends('layouts.app')
@section('title', 'Pembayaran')
@section('content')
    <div class="row">
        <div class="col-lg-4">
            <div class="card shadow mb-4">
                {{ html()->form('POST', route('pembayaran.store'))->open() }}
                <div class="card-body">
                    <div class="mb-3">
                        {{ html()->label('Dari', 'from')->class('form-label') }}
                        {{ html()->input('month', 'date_start')
                        ->class('form-control')->attribute('required', true) }}
                    </div>
                    <div class="mb-3">
                        {{ html()->label('Ke', 'to')->class('form-label') }}
                        {{ html()->input('month', 'date_end')
                        ->class('form-control')->attribute('required', true) }}
                    </div>
                    {{ html()->button('Cari Tagihan')->class('btn btn-primary')->attribute('type', 'submit') }}
                </div>
                {{ html()->form()->close() }}
            </div>
        </div>
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h3 class="card-title">Detail Tagihan</h3>
                
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal Pembayaran</th>
                                <th>Bulan</th>
                                <th>Biaya</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Action</th>
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
                                    <td>{{ $pembayaran->date }}</td>
                                    <td>Rp {{ number_format($pembayaran->biaya, 0, ",", ".") }}</td>
                                    <td>Rp {{ number_format($pembayaran->total, 0, ",", ".") }}</td>
                                    <td>{{ $pembayaran->status }}</td>
                                    <td>
                                        @if($pembayaran->status === 'BELUM BAYAR' || $pembayaran->status === 'TOLAK')
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal{{$pembayaran->id}}">
                                                Upload Bukti Pembayaran
                                            </button>

                                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#destroyModal{{$pembayaran->id}}">
                                                Hapus Tagihan
                                            </button>

                                            <div class="modal fade" id="destroyModal{{$pembayaran->id}}" tabindex="-1" role="dialog" aria-labelledby="destroyModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    {{ html()->form('POST', route('pembayaran.destroy'))->open() }}
                                                    {{ html()->hidden('id', $pembayaran->id) }}
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="destroyModalLabel">Hapus Tagihan</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Apakah anda ingin menghapus tagihan ini?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Confirm</button>
                                                        </div>
                                                    </div>
                                                    {{ html()->form()->close() }}
                                                </div>
                                            </div>
                                            
                                            <div class="modal fade" id="exampleModal{{$pembayaran->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    {{ html()->form('POST', route('pembayaran.paid'))->attribute('enctype', 'multipart/form-data')->open() }}
                                                    {{ html()->hidden('id', $pembayaran->id) }}
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Upload Bukti Pembayaran</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            {{ html()->file('resi') }}
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Save changes</button>
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
                <div class="card-footer">
                    <div class="d-flex">
                        <h3>Total: Rp {{ number_format($total, 0, ",", ".") }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    
@endpush
