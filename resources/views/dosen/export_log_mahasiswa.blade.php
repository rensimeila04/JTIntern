<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Log Book Kegiatan Magang</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        .header {
            text-align: center;
        }

        .logo {
            width: 80px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 16px;
        }

        th,
        td {
            border: 1px solid #222;
            padding: 6px;
            text-align: left;
        }

        th {
            background: #f2f2f2;
        }

        .ttd {
            margin-top: 40px;
            width: 100%;
        }

        .ttd td {
            border: none;
            text-align: center;
            vertical-align: bottom;
            height: 80px;
        }

        .bold {
            font-weight: bold;
        }

        <style>body {
            font-family: "Times New Roman", Times, serif;
            margin: 6px 20px 5px 20px;
            line-height: 15px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td,
        th {
            padding: 4px 3px;
        }

        th {
            text-align: left;
        }

        .d-block {
            display: block;
        }

        img.image {
            width: auto;
            height: 80px;
            max-width: 150px;
            max-height: 150px;
        }

        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .p-1 {
            padding: 5px 1px 5px 1px;
        }

        .font-10 {
            font-size: 10pt;
        }

        .font-11 {
            font-size: 11pt;
        }

        .font-12 {
            font-size: 12pt;
        }

        .font-13 {
            font-size: 13pt;
        }

        .border-bottom-header {
            border-bottom: 2px solid;
        }

        .border-bottom-header td {
            border: none;
        }

        .border-all,
        .border-all th,
        .border-all td {
            border: 1px solid;
        }

        .mb-1 {
            margin-bottom: 5px;
        }

        .font-bold {
            font-weight: bold;
        }

        .mt-4 {
            margin-top: 20px;
        }

        .mb-4 {
            margin-bottom: 20px;
        }
    </style>
    </style>
</head>

<body>
    <table class="border-bottom-header">
        <tr>
            <td width="15%" class="text-center">
                <img src="https://th.bing.com/th/id/OIP.zO2zkAlHLEJXOgNpV-b4awHaHa?rs=1&pid=ImgDetMain" class="image">
            </td>
            <td width="85%">
                <span class="text-center d-block font-11 font-bold mb-1">KEMENTERIAN
                    PENDIDIKAN, KEBUDAYAAN, RISET, DAN TEKNOLOGI</span>
                <span class="text-center d-block font-13 font-bold mb-1">POLITEKNIK NEGERI
                    MALANG</span>
                <span class="text-center d-block font-10">Jl. Soekarno-Hatta No. 9 Malang
                    65141</span>
                <span class="text-center d-block font-10">Telepon (0341) 404424 Pes. 101-
                    105, 0341-404420, Fax. (0341) 404420</span>
                <span class="text-center d-block font-10">Laman: www.polinema.ac.id</span>
            </td>
        </tr>
    </table>
    <table style="margin-bottom: 24px; margin-top: 24px;">
        <tr>
            <td>Nama</td>
            <td>: {{ $magang->mahasiswa->user->name }}</td>
        </tr>
        <tr>
            <td>NIM</td>
            <td>: {{ $magang->mahasiswa->nim }}</td>
        </tr>
        <tr>
            <td>Program Studi</td>
            <td>: {{ $magang->mahasiswa->programStudi->nama_prodi }}</td>
        </tr>
        <tr>
            <td>Nama Mitra</td>
            <td>: {{ $magang->lowongan->perusahaanMitra->nama_perusahaan_mitra }}</td>
        </tr>
    </table>
    <table>
        <thead>
            <tr>
                <th>Hari, Tanggal</th>
                <th>Jam Masuk</th>
                <th>Jam Pulang</th>
                <th>Kegiatan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($logAktivitas as $log)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($log->tanggal)->locale('id')->translatedFormat('l, d F Y') }}</td>
                    <td>{{ $log->jam_masuk ? \Carbon\Carbon::parse($log->jam_masuk)->format('H:i') : '-' }}</td>
                    <td>{{ $log->jam_pulang ? \Carbon\Carbon::parse($log->jam_pulang)->format('H:i') : '-' }}</td>
                    <td>{{ $log->kegiatan ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <table class="ttd">
        <tr>
            <td>Mahasiswa,<br><br><br><br><u>{{ $magang->mahasiswa->user->name }}</u></td>
            <td>Mengetahui,<br>Dosen
                Pembimbing,<br><br><br><u>{{ $magang->dosenPembimbing->user->name ?? '________________' }}</u></td>
        </tr>
    </table>
</body>

</html>
