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
    </style>
</head>
<body>
    <div class="header">
        <h2>TANDA TERIMA PEMBAYARAN</h2>
    </div>

    <p>Sudah terima dari: <strong>{{ $pembayaran->user->nama }}</strong></p>
    <p>Sejumlah: <strong>Rp {{ number_format($pembayaran->total, 0, ',', '.') }}</strong></p>
    <p>Untuk pembayaran: <em>Komite tahun ajaran {{ $pembayaran->user->siswa->angkatan->nama }}</em></p>
    <p>Tanggal: {{ $pembayaran->date }}</p>

    <br><br>
    <table class="table">
        <tr>
            <td style="text-align: center;">
                <br><br><br>
                ___________________________<br>
                Penerima
            </td>
            <td style="text-align: center;">
                <br><br><br>
                ___________________________<br>
                Pembayar
            </td>
        </tr>
    </table>
</body>
</html>
