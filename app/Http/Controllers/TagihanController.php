<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembayaran;
use Auth;

class TagihanController extends Controller
{
    public function index()
    {
        $pembayarans = Pembayaran::where('id_user', Auth::user()->id)->get();

        return view('pages.tagihan.index')->with([
            'pembayarans' => $pembayarans
        ]);
    }

    public function store(Request $request)
    {
        $start = new \DateTime($request->date_start);
        $end = new \DateTime($request->date_end);

        $end->modify('+1 month');

        $interval = new \DateInterval('P1M');
        $period = new \DatePeriod($start, $interval, $end);

        foreach ($period as $dt) {
            Pembayaran::firstOrCreate(
                [
                    'date' => $dt->format("Y-m")
                ],
                [
                    'date' => $dt->format("Y-m"),
                    'biaya' => Auth::user()->siswa->angkatan->biaya,
                    'total' => Auth::user()->siswa->angkatan->biaya,
                    'id_user' => Auth::user()->id,
                    'status' => 'BELUM BAYAR'
                ]
            );
        }

        return redirect()->route('pembayaran.index')->with('success','Tagihan sudah terbuat, silahkan melanjutkan pembayaran');

    }

    public function paid(Request $request)
    {
        $path = $request->file('resi')->store('images');

        $pembayarans = Pembayaran::where('id_user', Auth::user()->id)->where('status', 'BELUM BAYAR')->get();

        foreach ($pembayarans as $dt) {
            Pembayaran::where('id', $dt->id)->update(
                [
                    'resi' => $path,
                    'status' => 'TERBAYAR'
                ],
            );
        }

        return redirect()->route('pembayaran.index')->with('success','Tagihan berhasil terbayar');
    }


    public function history()
    {
        if(Auth::user()->role === 'ADMIN') {
            $pembayarans = Pembayaran::where('status', 'TERBAYAR')->get();
        } else {
            $pembayarans = Pembayaran::where('id_user', Auth::user()->id)->where('status', 'TERBAYAR')->get();

        }

        return view('pages.tagihan.history')->with([
            'pembayarans' => $pembayarans
        ]);
    }

}
