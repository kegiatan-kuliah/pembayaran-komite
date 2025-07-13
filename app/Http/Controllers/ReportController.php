<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembayaran;

class ReportController extends Controller
{
    public function index()
    {
        return view('pages.report.index');
    }

    public function process(Request $request)
    {
        return redirect()->route('laporan.result', ['date' => $request->date]);
    }

    public function result(Request $request)
    {
        $query = $request->query('date');

        $pembayarans = Pembayaran::where('date', $query)->get();

        return view('pages.report.result')->with([
            'query' => $query,
            'pembayarans' => $pembayarans
        ]);
    }
}
