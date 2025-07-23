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
            $store = Pembayaran::firstOrCreate(
                [
                    'date' => $dt->format("Y-m"),
                    'id_user' => Auth::user()->id
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
        $path = $request->file('resi')->store('images', 'public');

        $pembayaran = Pembayaran::where('id_user', Auth::user()->id)->where('id', $request->id)->update([
            'resi' => $path,
            'status' => 'PENDING'
        ]);

        return redirect()->route('pembayaran.index')->with('success','Tagihan berhasil terbayar');
    }

    public function confirm(Request $request)
    {

        $pembayaran = Pembayaran::where('id', $request->id)->update([
            'status' => 'TERBAYAR'
        ]);

        return redirect()->route('pembayaran.history')->with('success','Tagihan berhasil dikonfirmasi');
    }


    public function history()
    {
        if(Auth::user()->role === 'ADMIN') {
            $pembayarans = Pembayaran::get();
        } else {
            $pembayarans = Pembayaran::where('id_user', Auth::user()->id)->get();
        }

        return view('pages.tagihan.history')->with([
            'pembayarans' => $pembayarans
        ]);
    }

    public function receipt($id)
    {
        $pembayaran = Pembayaran::where('id', $id)->firstOrFail();
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('pages.report.receipt', [
            'pembayaran' => $pembayaran
        ]);

        // Tampilkan di browser, bukan download
        return $pdf->stream("tanda-terima-{$id}.pdf");
    }

}
