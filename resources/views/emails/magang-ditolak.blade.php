<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informasi Pengajuan Magang</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            background-color: #f9fafb;
            color: #374151;
            line-height: 1.6;
        }
        
        .container {
            max-width: 640px;
            margin: 2rem auto;
            background-color: #ffffff;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            border-radius: 12px;
            overflow: hidden;
        }
        
        .header {
            background: linear-gradient(135deg, #f97316 0%, #dc2626 100%);
            padding: 1.5rem 2rem;
            color: white;
        }
        
        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .header h1 {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 0.5rem;
        }
        
        .header p {
            color: #fed7aa;
            font-size: 0.9rem;
        }
        
        .status-badge {
            background-color: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(8px);
            padding: 0.5rem 1rem;
            border-radius: 8px;
            font-size: 0.875rem;
            font-weight: 600;
        }
        
        .content {
            padding: 1.5rem 2rem;
        }
        
        .greeting {
            margin-bottom: 1.5rem;
        }
        
        .greeting p {
            font-size: 1.125rem;
            margin-bottom: 0.5rem;
        }
        
        .greeting .name {
            color: #0284c7;
            font-weight: bold;
        }
        
        .greeting .description {
            color: #6b7280;
            font-size: 1rem;
            line-height: 1.7;
        }
        
        .status-section {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 1rem;
            background-color: #fef2f2;
            border: 1px solid #fecaca;
            border-radius: 8px;
            margin-bottom: 1.5rem;
        }
        
        .status-dot {
            width: 12px;
            height: 12px;
            background-color: #ef4444;
            border-radius: 50%;
        }
        
        .status-text {
            color: #991b1b;
            font-weight: 600;
        }
        
        .status-date {
            margin-left: auto;
            color: #dc2626;
            font-size: 0.875rem;
        }
        
        .detail-section {
            background-color: #f9fafb;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
        }
        
        .section-title {
            font-size: 1.125rem;
            font-weight: 600;
            color: #374151;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .title-dot {
            width: 8px;
            height: 8px;
            background-color: #ef4444;
            border-radius: 50%;
        }
        
        .detail-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1rem;
        }
        
        @media (min-width: 768px) {
            .detail-grid {
                grid-template-columns: 1fr 1fr;
            }
        }
        
        .detail-item {
            margin-bottom: 0.75rem;
        }
        
        .detail-label {
            font-size: 0.875rem;
            font-weight: 500;
            color: #6b7280;
            margin-bottom: 0.25rem;
        }
        
        .detail-value {
            color: #374151;
            font-weight: 600;
        }
        
        .status-badge-inline {
            display: inline-flex;
            align-items: center;
            padding: 0.25rem 0.625rem;
            background-color: #fee2e2;
            color: #991b1b;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 500;
        }
        
        .rejection-reason {
            background-color: #fef2f2;
            border: 1px solid #fecaca;
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
        }
        
        .rejection-reason .section-title {
            color: #991b1b;
            margin-bottom: 1rem;
        }
        
        .quote-container {
            position: relative;
            margin-left: 0.5rem;
        }
        
        .quote-icon {
            position: absolute;
            top: 0;
            left: 0;
            width: 24px;
            height: 24px;
            color: #f87171;
            fill: currentColor;
        }
        
        .quote-text {
            color: #b91c1c;
            line-height: 1.7;
            padding-left: 2rem;
            font-style: italic;
            background-color: #ffffff;
            padding: 1rem;
            border-radius: 8px;
            border-left: 4px solid #fca5a5;
            margin-left: 0.5rem;
        }
        
        .encouragement {
            background-color: #eff6ff;
            border: 1px solid #dbeafe;
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
        }
        
        .encouragement .section-title {
            color: #1e40af;
            margin-bottom: 1rem;
        }
        
        .encouragement p {
            color: #1d4ed8;
            margin-bottom: 1rem;
        }
        
        .steps-list {
            list-style: none;
            padding: 0;
        }
        
        .step-item {
            display: flex;
            align-items: flex-start;
            gap: 0.75rem;
            margin-bottom: 0.5rem;
        }
        
        .step-dot {
            width: 8px;
            height: 8px;
            background-color: #3b82f6;
            border-radius: 50%;
            margin-top: 8px;
            flex-shrink: 0;
        }
        
        .step-text {
            color: #1d4ed8;
        }
        
        .cta-section {
            text-align: center;
            margin-bottom: 1.5rem;
        }
        
        .cta-button {
            display: inline-flex;
            align-items: center;
            padding: 0.75rem 1.5rem;
            background-color: #0284c7;
            color: white;
            text-decoration: none;
            font-weight: 600;
            border-radius: 8px;
            transition: all 0.2s;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }
        
        .cta-button:hover {
            background-color: #0369a1;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }
        
        .cta-icon {
            width: 20px;
            height: 20px;
            margin-right: 0.5rem;
        }
        
        .closing-message {
            text-align: center;
            padding: 1rem;
            background-color: #f9fafb;
            border-radius: 8px;
            border: 1px solid #e5e7eb;
        }
        
        .closing-message p {
            color: #374151;
            line-height: 1.7;
            margin-bottom: 0.5rem;
        }
        
        .closing-message .highlight {
            color: #374151;
            font-weight: 600;
        }
        
        .closing-message .brand {
            color: #0284c7;
            font-weight: bold;
        }
        
        .footer {
            background-color: #f3f4f6;
            padding: 1rem 2rem;
            border-top: 1px solid #e5e7eb;
        }
        
        .footer p {
            text-align: center;
            font-size: 0.875rem;
            color: #6b7280;
            line-height: 1.6;
        }
        
        @media (max-width: 640px) {
            .container {
                margin: 1rem;
                border-radius: 8px;
            }
            
            .header {
                padding: 1rem 1.5rem;
            }
            
            .header-content {
                flex-direction: column;
                gap: 1rem;
                text-align: center;
            }
            
            .content {
                padding: 1rem 1.5rem;
            }
            
            .status-section {
                flex-direction: column;
                text-align: center;
                gap: 0.5rem;
            }
            
            .status-date {
                margin-left: 0;
            }
            
            .footer {
                padding: 1rem 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <div class="header-content">
                <div>
                    <h1>📋 Informasi Pengajuan</h1>
                    <p>Update status pengajuan magang Anda</p>
                </div>
                <div class="status-badge">
                    <span>TIDAK DITERIMA</span>
                </div>
            </div>
        </div>

        <!-- Content -->
        <div class="content">
            <!-- Greeting -->
            <div class="greeting">
                <p>Halo <span class="name">{{ $magang->mahasiswa->user->name }}</span>,</p>
                <p class="description">
                    Terima kasih atas minat Anda untuk magang. Setelah melalui proses evaluasi yang teliti, 
                    kami informasikan bahwa pengajuan magang Anda untuk saat ini belum dapat kami terima.
                </p>
            </div>

            <!-- Status Badge -->
            <div class="status-section">
                <div class="status-dot"></div>
                <span class="status-text">Status: Tidak Diterima</span>
                <span class="status-date">
                    {{ $magang->tanggal_ditolak ? \Carbon\Carbon::parse($magang->tanggal_ditolak)->setTimezone('Asia/Jakarta')->format('d F Y H:i') . ' WIB' : '' }}
                </span>
            </div>

            <!-- Detail Pengajuan -->
            <div class="detail-section">
                <h3 class="section-title">
                    <div class="title-dot"></div>
                    Detail Pengajuan
                </h3>
                
                <div class="detail-grid">
                    <div>
                        <div class="detail-item">
                            <p class="detail-label">Posisi</p>
                            <p class="detail-value">{{ $magang->lowongan->judul_lowongan }}</p>
                        </div>
                        <div class="detail-item">
                            <p class="detail-label">Perusahaan</p>
                            <p class="detail-value">{{ $magang->lowongan->perusahaanMitra->nama_perusahaan_mitra }}</p>
                        </div>
                    </div>
                    <div>
                        <div class="detail-item">
                            <p class="detail-label">Tanggal Pengajuan</p>
                            <p class="detail-value">{{ $magang->created_at->setTimezone('Asia/Jakarta')->format('d F Y') }}</p>
                        </div>
                        <div class="detail-item">
                            <p class="detail-label">Status</p>
                            <span class="status-badge-inline">Tidak Diterima</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Alasan Penolakan -->
            @if($magang->alasan_penolakan)
            <div class="rejection-reason">
                <h3 class="section-title">
                    <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width:20px;height:20px;color:#dc2626;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Alasan Penolakan
                </h3>
                <div class="quote-container">
                    <svg class="quote-icon" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h4v10h-10z"/>
                    </svg>
                    <p class="quote-text">
                        {{ $magang->alasan_penolakan }}
                    </p>
                </div>
            </div>
            @endif

            <!-- Encouragement Section -->
            <div class="encouragement">
                <h3 class="section-title">
                    <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width:20px;height:20px;color:#2563eb;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                    Jangan Menyerah!
                </h3>
                <p>Keputusan ini bukan akhir dari perjalanan Anda. Berikut beberapa saran untuk langkah selanjutnya:</p>
                <ul class="steps-list">
                    <li class="step-item">
                        <div class="step-dot"></div>
                        <span class="step-text">Tinjau dan perbaiki dokumen pendukung Anda</span>
                    </li>
                    <li class="step-item">
                        <div class="step-dot"></div>
                        <span class="step-text">Cari lowongan magang lain yang sesuai dengan profil Anda</span>
                    </li>
                    <li class="step-item">
                        <div class="step-dot"></div>
                        <span class="step-text">Tingkatkan keterampilan yang relevan dengan posisi yang diinginkan</span>
                    </li>
                    <li class="step-item">
                        <div class="step-dot"></div>
                        <span class="step-text">Konsultasikan dengan dosen pembimbing untuk masukan</span>
                    </li>
                    <li class="step-item">
                        <div class="step-dot"></div>
                        <span class="step-text">Jangan ragu untuk mencoba lagi di kesempatan berikutnya</span>
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
            <div class="closing-message">
                <p>
                    Kami yakin dengan dedikasi dan persiapan yang tepat, Anda akan menemukan kesempatan magang yang sesuai. Tetap semangat!
                </p>
                <p class="highlight">
                    Terima kasih atas pengertian Anda.
                </p>
                <p class="brand">Tim JTIntern</p>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>
                Email ini dikirim secara otomatis dari sistem JTIntern.<br>
                Jangan balas email ini. Untuk pertanyaan, hubungi admin sistem.
            </p>
        </div>
    </div>
</body>
</html>