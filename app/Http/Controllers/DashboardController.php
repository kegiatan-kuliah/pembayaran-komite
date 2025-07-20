<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pembayaran;

class DashboardController extends Controller
{
    public function index()
    {
        $totalSiswa = User::where('role','SISWA')->count();
        $totalPembayaran = Pembayaran::where('status', 'TERBAYAR')->sum('total');

        return view('pages.dashboard.index')->with([
            'totalSiswa' => $totalSiswa,
            'totalPembayaran' => $totalPembayaran
        ]);
    }
}
