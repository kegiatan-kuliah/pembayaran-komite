<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Tanda Terima Pembayaran</title>
    <style>
        body { font-family: sans-serif; }
        .header { text-align: center; margin-bottom: 20px; }
        .table { width: 100%; margin-top: 20px; border-collapse: collapse; }
        .table td { padding: 8px; }
        .signature {
            float: right;
            margin-top: 40px;
        }

        .left-signature {
            float: left;
            margin-top: 40px;
        }
    </style>
</head>
@php
        use Carbon\Carbon;

        Carbon::setLocale('id');
    @endphp
<body>
    <div class="header">
        <h2>TANDA TERIMA PEMBAYARAN</h2>
    </div>

    <p>Sudah terima dari: <strong>{{ $pembayaran->user->nama }}</strong></p>
    <p>Sejumlah: <strong>Rp {{ number_format($pembayaran->total, 0, ',', '.') }}</strong></p>
    <p>Untuk pembayaran: <em>Komite tahun ajaran {{ $pembayaran->user->siswa->angkatan->nama }}</em></p>
    <p>Tanggal Pembayaran: {{ $pembayaran->updated_at->format('Y-m-d') }}</p>
    <p>Bulan: {{ Carbon::parse($pembayaran->date)->translatedFormat('F Y') }}</p>

    <br><br>
    <table class="table">
        <tr>
            <td colspan="2" style="text-align: center;">Kabupaten Solok, {{ Carbon::now()->translatedFormat('d F Y')}}<br></td>
        </tr>
        <tr>
            <td style="text-align: left;">
                Yang Membayar,
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                {{ $pembayaran->user->nama }}
            </td>
            <td style="text-align: right;">
                Yang Menerima,
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                Reni Mareta, S.Pd
            </td>
        </tr>
    </table>
</body>
</html>
