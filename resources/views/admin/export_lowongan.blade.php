<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Data Lowongan JTIntern</title>
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

        .wfo-row {
            background-color: #ffebee;
        }

        .remote-row {
            background-color: #e3f2fd;
        }

        .hybrid-row {
            background-color: #e8f5e9;
        }

        .status-aktif {
            color: #2e7d32;
        }
        
        .status-nonaktif {
            color: #c62828;
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

    <h3 class="text-center">LAPORAN DATA LOWONGAN</h3>

    <table class="border-all">
        <thead>
            <tr>
                <th class="text-center">No</th>
                <th>Judul Lowongan</th>
                <th>Perusahaan</th>
                <th>Periode Magang</th>
                <th>Jenis</th>
                <th>Kompetensi</th>
                <th>Deadline</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($lowongan as $index => $job)
                <tr class="{{ $job->jenis_magang == 'wfo' ? 'wfo-row' : ($job->jenis_magang == 'remote' ? 'remote-row' : 'hybrid-row') }}">
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ $job->judul_lowongan }}</td>
                    <td>{{ $job->perusahaanMitra->nama_perusahaan_mitra }}</td>
                    <td>{{ $job->periodeMagang->nama_periode }}</td>
                    <td>{{ strtoupper($job->jenis_magang) }}</td>
                    <td>{{ $job->kompetensi->nama_kompetensi }}</td>
                    <td>{{ $job->deadline_pendaftaran ? date('d/m/Y', strtotime($job->deadline_pendaftaran)) : '-' }}</td>
                    <td class="{{ $job->status_pendaftaran ? 'status-aktif' : 'status-nonaktif' }}">
                        {{ $job->status_pendaftaran ? 'Aktif' : 'Non-aktif' }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">Tidak ada data lowongan</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <h3 class="mt-4 mb-4">Ringkasan Data</h3>

    <table class="border-all" style="width: 60%;">
        <thead>
            <tr>
                <th colspan="3" class="text-center">Berdasarkan Jenis Magang</th>
            </tr>
            <tr>
                <th>Jenis</th>
                <th class="text-center">Jumlah</th>
                <th class="text-center">Persentase</th>
            </tr>
        </thead>
        <tbody>
            <tr class="wfo-row">
                <td>WFO</td>
                <td class="text-center">{{ $wfoCount }}</td>
                <td class="text-center">{{ $wfoPercentage }}%</td>
            </tr>
            <tr class="remote-row">
                <td>Remote</td>
                <td class="text-center">{{ $remoteCount }}</td>
                <td class="text-center">{{ $remotePercentage }}%</td>
            </tr>
            <tr class="hybrid-row">
                <td>Hybrid</td>
                <td class="text-center">{{ $hybridCount }}</td>
                <td class="text-center">{{ $hybridPercentage }}%</td>
            </tr>
        </tbody>
    </table>

    <table class="border-all mt-4" style="width: 60%;">
        <thead>
            <tr>
                <th colspan="3" class="text-center">Berdasarkan Status</th>
            </tr>
            <tr>
                <th>Status</th>
                <th class="text-center">Jumlah</th>
                <th class="text-center">Persentase</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="status-aktif">Aktif</td>
                <td class="text-center">{{ $activeCount }}</td>
                <td class="text-center">{{ $activePercentage }}%</td>
            </tr>
            <tr>
                <td class="status-nonaktif">Non-aktif</td>
                <td class="text-center">{{ $inactiveCount }}</td>
                <td class="text-center">{{ $inactivePercentage }}%</td>
            </tr>
        </tbody>
    </table>

    <div class="mt-4">
        <p><strong>Total Lowongan:</strong> {{ $totalLowongan }} lowongan</p>
        <p class="text-right font-10">Diekspor pada tanggal: {{ date('d/m/Y H:i:s') }}</p>
    </div>
</body>

</html>