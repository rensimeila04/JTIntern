<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Data Permohonan Magang JTIntern</title>
    <style>
        body {
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
            border-bottom: 1px solid;
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

        .status-menunggu {
            color: #FFA000;
        }
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

    <h3 class="text-center">LAPORAN PERMOHONAN MAGANG</h3>
    <h4 class="text-center status-menunggu">Status: Menunggu</h4>

    <table class="border-all">
        <thead>
            <tr>
                <th class="text-center">No</th>
                <th>Mahasiswa</th>
                <th>NIM</th>
                <th>Program Studi</th>
                <th>Lowongan</th>
                <th>Perusahaan</th>
                <th>Tanggal Pengajuan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($permohonan as $index => $item)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ $item->mahasiswa->user->name }}</td>
                    <td>{{ $item->mahasiswa->nim }}</td>
                    <td>{{ $item->mahasiswa->programStudi->nama_prodi ?? '-' }}</td>
                    <td>{{ $item->lowongan->judul_lowongan }}</td>
                    <td>{{ $item->lowongan->perusahaanMitra->nama_perusahaan_mitra }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d/m/Y H:i') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">Tidak ada data permohonan magang</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">
        <p><strong>Total Permohonan:</strong> {{ $totalPermohonan }} permohonan</p>

        @if($lowonganStats && count($lowonganStats) > 0)
            <h3 class="mt-4 mb-4">Statistik Permohonan per Lowongan</h3>
            <table class="border-all" style="width: 70%;">
                <thead>
                    <tr>
                        <th>Lowongan</th>
                        <th>Perusahaan</th>
                        <th class="text-center">Jumlah</th>
                        <th class="text-center">Persentase</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($lowonganStats as $stat)
                        <tr>
                            <td>{{ $stat['judul_lowongan'] }}</td>
                            <td>{{ $stat['nama_perusahaan'] }}</td>
                            <td class="text-center">{{ $stat['count'] }}</td>
                            <td class="text-center">{{ $stat['percentage'] }}%</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

        <p class="text-right font-10">Diekspor pada tanggal: {{ date('d/m/Y H:i:s') }}</p>
    </div>
</body>

</html>