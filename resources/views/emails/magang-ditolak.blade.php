<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informasi Pengajuan Magang</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background-color: #f1f5f9;
            color: #334155;
            line-height: 1.6;
            margin: 0;
            padding: 0;
        }
        
        .email-container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        
        .header-section {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 50%, #b91c1c 100%);
            padding: 32px 24px;
            text-align: center;
            position: relative;
        }
        
        .header-title {
            color: #ffffff;
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 8px;
            text-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        .header-subtitle {
            color: #fecaca;
            font-size: 16px;
            margin-bottom: 16px;
        }
        
        .status-badge-header {
            display: inline-block;
            background-color: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            color: #ffffff;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 600;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .content-section {
            padding: 32px 24px;
        }
        
        .greeting-section {
            margin-bottom: 24px;
        }
        
        .greeting-text {
            font-size: 18px;
            color: #1e293b;
            margin-bottom: 12px;
        }
        
        .student-name {
            color: #0ea5e9;
            font-weight: 700;
        }
        
        .greeting-description {
            color: #64748b;
            font-size: 16px;
            line-height: 1.7;
        }
        
        .rejection-highlight {
            color: #dc2626;
            font-weight: 600;
        }
        
        .status-card {
            background: linear-gradient(135deg, #fef2f2 0%, #fee2e2 100%);
            border: 2px solid #fecaca;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        
        .status-text {
            color: #991b1b;
            font-weight: 600;
            font-size: 16px;
            flex: 1;
        }
        
        .status-date {
            color: #dc2626;
            font-size: 14px;
            font-weight: 500;
        }
        
        .detail-card {
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            padding: 24px;
            margin-bottom: 24px;
        }
        
        .card-title {
            font-size: 20px;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .detail-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 20px;
        }
        
        .detail-item {
            margin-bottom: 16px;
        }
        
        .detail-label {
            font-size: 14px;
            font-weight: 500;
            color: #64748b;
            margin-bottom: 4px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .detail-value {
            color: #1e293b;
            font-weight: 600;
            font-size: 16px;
        }
        
        .status-badge-inline {
            display: inline-flex;
            align-items: center;
            padding: 6px 12px;
            background-color: #fee2e2;
            color: #991b1b;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 600;
            border: 1px solid #fecaca;
        }
        
        .rejection-reason-card {
            background: linear-gradient(135deg, #fef2f2 0%, #fee2e2 100%);
            border: 1px solid #fecaca;
            border-radius: 16px;
            padding: 24px;
            margin-bottom: 24px;
        }
        
        .rejection-title {
            color: #991b1b;
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .rejection-icon {
            width: 20px;
            height: 20px;
            color: #dc2626;
        }
        
        .quote-container {
            position: relative;
            background-color: #ffffff;
            border-radius: 12px;
            padding: 20px;
            border-left: 4px solid #f87171;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }
        
        .quote-text {
            color: #b91c1c;
            line-height: 1.7;
            font-style: italic;
            font-size: 16px;
            position: relative;
        }
        
        .encouragement-card {
            background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
            border: 1px solid #bfdbfe;
            border-radius: 16px;
            padding: 24px;
            margin-bottom: 24px;
        }
        
        .encouragement-title {
            color: #1e40af;
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .encouragement-icon {
            width: 24px;
            height: 24px;
            color: #3b82f6;
        }
        
        .encouragement-description {
            color: #1d4ed8;
            margin-bottom: 16px;
            font-size: 16px;
            line-height: 1.6;
        }
        
        .steps-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        
        .step-item {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            margin-bottom: 12px;
            padding: 12px;
            background-color: rgba(255, 255, 255, 0.7);
            border-radius: 8px;
        }
        
        .step-text {
            color: #1e40af;
            font-weight: 500;
            line-height: 1.5;
            font-size: 15px;
        }
        
        .cta-section {
            text-align: center;
            margin-bottom: 32px;
        }
        
        .cta-button {
            display: inline-flex;
            align-items: center;
            padding: 16px 32px;
            background: linear-gradient(135deg, #0ea5e9 0%, #0284c7 100%);
            color: white;
            text-decoration: none;
            font-weight: 600;
            font-size: 16px;
            border-radius: 12px;
            transition: all 0.3s ease;
            box-shadow: 0 8px 25px rgba(14, 165, 233, 0.3);
            border: none;
        }
        
        .cta-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 35px rgba(14, 165, 233, 0.4);
        }
        
        .cta-icon {
            width: 20px;
            height: 20px;
            margin-right: 8px;
        }
        
        .closing-card {
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            padding: 24px;
            text-align: center;
            margin-bottom: 24px;
        }
        
        .closing-text {
            color: #475569;
            line-height: 1.7;
            margin-bottom: 12px;
            font-size: 16px;
        }
        
        .closing-highlight {
            color: #1e293b;
            font-weight: 600;
            font-size: 18px;
            margin-bottom: 8px;
        }
        
        .brand-name {
            color: #0ea5e9;
            font-weight: 700;
            font-size: 16px;
        }
        
        .footer-section {
            background-color: #f1f5f9;
            padding: 24px;
            border-top: 1px solid #e2e8f0;
        }
        
        .footer-text {
            text-align: center;
            font-size: 14px;
            color: #64748b;
            line-height: 1.6;
        }
        
        /* Responsive Design for Email Clients */
        @media only screen and (max-width: 600px) {
            .email-container {
                width: 100% !important;
                margin: 10px !important;
                border-radius: 12px !important;
            }
            
            .header-section {
                padding: 24px 16px !important;
            }
            
            .content-section {
                padding: 24px 16px !important;
            }
            
            .header-title {
                font-size: 24px !important;
            }
            
            .status-card {
                flex-direction: column;
                text-align: center;
                gap: 8px;
            }
            
            .detail-grid {
                grid-template-columns: 1fr !important;
            }
            
            .cta-button {
                padding: 14px 24px !important;
                font-size: 14px !important;
            }
            
            .step-item {
                flex-direction: column;
                text-align: center;
                gap: 8px;
            }
        }
    </style>
</head>
<body>
    <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="background-color: #f1f5f9;">
        <tr>
            <td align="center" style="padding: 20px 0;">
                <div class="email-container">
                    <!-- Header -->
                    <div class="header-section">
                        <div class="header-title">📋 Informasi Pengajuan</div>
                        <div class="header-subtitle">Update status pengajuan magang Anda</div>
                        <div class="status-badge-header">TIDAK DITERIMA</div>
                    </div>

                    <!-- Content -->
                    <div class="content-section">
                        <!-- Greeting -->
                        <div class="greeting-section">
                            <div class="greeting-text">
                                Halo <span class="student-name">{{ $magang->mahasiswa->user->name }}</span>,
                            </div>
                            <div class="greeting-description">
                                Terima kasih atas minat Anda untuk magang. Setelah melalui proses evaluasi yang teliti, 
                                kami informasikan bahwa pengajuan magang Anda untuk saat ini 
                                <span class="rejection-highlight">belum dapat kami terima</span>.
                            </div>
                        </div>

                        <!-- Status -->
                        <div class="status-card">
                            <div class="status-text">Status: Tidak Diterima</div>
                            <div class="status-date">
                                {{ $magang->tanggal_ditolak ? \Carbon\Carbon::parse($magang->tanggal_ditolak)->format('d F Y H:i') . ' WIB' : '' }}
                            </div>
                        </div>

                        <!-- Detail Pengajuan -->
                        <div class="detail-card">
                            <div class="card-title">
                                Detail Pengajuan
                            </div>
                            
                            <div class="detail-grid">
                                <div>
                                    <div class="detail-item">
                                        <div class="detail-label">Posisi</div>
                                        <div class="detail-value">{{ $magang->lowongan->judul_lowongan }}</div>
                                    </div>
                                    <div class="detail-item">
                                        <div class="detail-label">Perusahaan</div>
                                        <div class="detail-value">{{ $magang->lowongan->perusahaanMitra->nama_perusahaan_mitra }}</div>
                                    </div>
                                </div>
                                <div>
                                    <div class="detail-item">
                                        <div class="detail-label">Tanggal Pengajuan</div>
                                        <div class="detail-value">{{ $magang->created_at->setTimezone('Asia/Jakarta')->format('d F Y') }}</div>
                                    </div>
                                    <div class="detail-item">
                                        <div class="detail-label">Status</div>
                                        <div class="status-badge-inline">Tidak Diterima</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Alasan Penolakan -->
                        @if($magang->alasan_penolakan)
                        <div class="rejection-reason-card">
                            <div class="rejection-title">
                                <svg class="rejection-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Alasan Penolakan
                            </div>
                            <div class="quote-container">
                                <div class="quote-text">
                                    "{{ $magang->alasan_penolakan }}"
                                </div>
                            </div>
                        </div>
                        @endif

                        <!-- Encouragement Section -->
                        <div class="encouragement-card">
                            <div class="encouragement-title">
                                <svg class="encouragement-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                                Jangan Menyerah!
                            </div>
                            <div class="encouragement-description">
                                Keputusan ini bukan akhir dari perjalanan Anda. Berikut beberapa saran untuk langkah selanjutnya:
                            </div>
                            <ul class="steps-list">
                                <li class="step-item">
                                    <div class="step-text">Tinjau dan perbaiki dokumen pendukung Anda</div>
                                </li>
                                <li class="step-item">
                                    <div class="step-text">Cari lowongan magang lain yang sesuai dengan profil Anda</div>
                                </li>
                                <li class="step-item">
                                    <div class="step-text">Tingkatkan keterampilan yang relevan dengan posisi yang diinginkan</div>
                                </li>
                                <li class="step-item">
                                    <div class="step-text">Konsultasikan dengan dosen pembimbing untuk masukan</div>
                                </li>
                                <li class="step-item">
                                    <div class="step-text">Jangan ragu untuk mencoba lagi di kesempatan berikutnya</div>
                                </li>
                            </ul>
                        </div>

                        <!-- CTA Button -->
                        <div class="cta-section">
                            <a href="{{ route('mahasiswa.lowongan') }}" class="cta-button">
                                <svg class="cta-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                                Cari Lowongan Lain
                            </a>
                        </div>

                        <!-- Closing Message -->
                        <div class="closing-card">
                            <div class="closing-text">
                                Kami yakin dengan dedikasi dan persiapan yang tepat, Anda akan menemukan kesempatan magang yang sesuai. Tetap semangat!
                            </div>
                            <div class="closing-highlight">
                                Terima kasih atas pengertian Anda.
                            </div>
                            <div class="brand-name">Tim JTIntern</div>
                        </div>
                    </div>

                    <!-- Footer -->
                    <div class="footer-section">
                        <div class="footer-text">
                            Email ini dikirim secara otomatis dari sistem JTIntern.<br>
                            Jangan balas email ini. Untuk pertanyaan, hubungi admin sistem.
                        </div>
                    </div>
                </div>
            </td>
        </tr>
    </table>
</body>
</html>