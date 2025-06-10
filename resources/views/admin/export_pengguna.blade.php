<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Data Pengguna JTIntern</title>
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

        .admin-row {
            background-color: #ffebee;
        }

        .dosen-row {
            background-color: #e3f2fd;
        }

        .mahasiswa-row {
            background-color: #e8f5e9;
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

    <h3 class="text-center">LAPORAN DATA PENGGUNA</h3>

    <table class="border-all">
        <thead>
            <tr>
                <th class="text-center">No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Level</th>
                <th>Tanggal Dibuat</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $index => $user)
                <tr
                    class="{{ $user->level->kode_level == 'ADM' ? 'admin-row' : ($user->level->kode_level == 'DSP' ? 'dosen-row' : 'mahasiswa-row') }}">
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->level->nama_level }}</td>
                    <td>{{ $user->created_at->format('d/m/Y') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">Tidak ada data pengguna</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <h3 class="mt-4 mb-4">Ringkasan Data</h3>

    <table class="border-all" style="width: 60%;">
        <thead>
            <tr>
                <th>Level</th>
                <th class="text-center">Jumlah</th>
                <th class="text-center">Persentase</th>
            </tr>
        </thead>
        <tbody>
            <tr class="admin-row">
                <td>Admin</td>
                <td class="text-center">{{ $adminCount }}</td>
                <td class="text-center">{{ $adminPercentage }}%</td>
            </tr>
            <tr class="dosen-row">
                <td>Dosen Pembimbing</td>
                <td class="text-center">{{ $dosenCount }}</td>
                <td class="text-center">{{ $dosenPercentage }}%</td>
            </tr>
            <tr class="mahasiswa-row">
                <td>Mahasiswa</td>
                <td class="text-center">{{ $mahasiswaCount }}</td>
                <td class="text-center">{{ $mahasiswaPercentage }}%</td>
            </tr>
        </tbody>
    </table>

    <div class="mt-4">
        <p><strong>Total Pengguna:</strong> {{ $totalUsers }} orang</p>
        <p class="text-right font-10">Diekspor pada tanggal: {{ date('d/m/Y H:i:s') }}</p>
    </div>
</body>

</html>