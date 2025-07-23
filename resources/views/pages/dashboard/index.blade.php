@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
    <div class="row">
        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h3 class="card-title">Total Siswa</h3>
                </div>
                <div class="card-body">
                    <p>{{ $totalSiswa }}</p>
                </div>
            </div>
        </div>
        @if(Auth::user()->role === 'ADMIN')
            <div class="col-lg-6">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h3 class="card-title">Total Pemasukan</h3>
                    </div>
                    <div class="card-body">
                        <p>{{ number_format($totalPembayaran, 2, ",", ".") }}</p>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
@push('scripts')
    
@endpush
