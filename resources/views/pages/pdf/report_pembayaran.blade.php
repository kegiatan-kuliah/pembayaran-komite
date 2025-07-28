<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Surat Keluar</title>
    <style>
        body {
            font-family: sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        table th {
            background-color: #e0e0e0;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .signature {
            float: right;
            margin-top: 40px;
        }
        
    </style>
    @php
        use Carbon\Carbon;

        Carbon::setLocale('id');
    @endphp
</head>

<body>
    <div>
        <img src="{{ public_path('img/Logo1.jpg') }}" alt="" width="70px" height="70px" style="position: absolute; top: 15px;">
        <h3 style="margin-bottom: 0px; text-align: center;">KEMENTRIAN AGAMA REPUBLIK INDONESIA</h3>
        <h3 style="margin-bottom: 0px; text-align: center; margin-top: 0px;">KANTOR KEMENTRIAN AGAMA KABUPATEN SOLOK</h3>
        <h3 style="margin-top: 0px; margin-bottom: 0px; text-align: center;">MTSS PP PERTANIAN SYEKH M. MUHSIN</h3>
        <p style="margin-bottom: 0px; margin-top: 0px; text-align: center;">Jln. Tabek Supayang, Sirukam, Payung Sekaki</p>
        <p style="margin-bottom: 0px; margin-top: 0px; text-align: center;">E-mail : syekhm.muhsin@gmail.com</p>
        <img src="{{ public_path('img/logo2.png') }}" alt="" width="70px" height="70px" style="position: absolute; top: 15px; right: 0px;">
        <hr>
    </div>
    <h3 style="text-align:center;"> Laporan Pembayaran Komite</h3>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Siswa</th>
                <th>Tanggal Pembayaran</th>
                <th>Bulan</th>
                <th>Biaya</th>
                <th>Total</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($pembayarans as $index => $pembayaran)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $pembayaran->user->nama }}</td>
                    <td>{{ $pembayaran->created_at->format('Y-m-d') }}</td>
                    <td>{{ $pembayaran->date }}</td>
                    <td>Rp {{ number_format($pembayaran->biaya, 0, ",", ".") }}</td>
                    <td>Rp {{ number_format($pembayaran->total, 0, ",", ".") }}</td>
                    <td>{{ $pembayaran->status }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">Tidak Ada Data</td>
                </tr>

            @endforelse
        </tbody>
    </table>
    <div class="signature">
        Kabupaten Solok, {{ Carbon::now()->translatedFormat('d F Y')}}<br>
        Bendahara,
        <br>
        <br>
        <br>
        Reni Mareta, S.Pd
    </div>
</body>

</html>