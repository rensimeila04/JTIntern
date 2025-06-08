<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengajuan Magang Diterima</title>
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
            background: linear-gradient(135deg, #0284c7 0%, #0369a1 100%);
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
            color: #e0f2fe;
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
            background-color: #f0fdf4;
            border: 1px solid #bbf7d0;
            border-radius: 8px;
            margin-bottom: 1.5rem;
        }
        
        .pulse-dot {
            width: 12px;
            height: 12px;
            background-color: #22c55e;
            border-radius: 50%;
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }
        
        .status-text {
            color: #166534;
            font-weight: 600;
        }
        
        .status-date {
            margin-left: auto;
            color: #16a34a;
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
            background-color: #0ea5e9;
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
        
        .next-steps {
            background-color: #eff6ff;
            border: 1px solid #dbeafe;
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
        }
        
        .next-steps .section-title {
            color: #1e40af;
            margin-bottom: 1rem;
        }
        
        .icon {
            width: 20px;
            height: 20px;
            color: #2563eb;
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
                    <h1>🎉 Selamat!</h1>
                    <p>Pengajuan magang Anda telah disetujui</p>
                </div>
                <div class="status-badge">
                    <span>DITERIMA</span>
                </div>
            </div>
        </div>

        <!-- Content -->
        <div class="content">
            <!-- Greeting -->
            <div class="greeting">
                <p>Halo <span class="name">{{ $magang->mahasiswa->user->name }}</span>,</p>
                <p class="description">
                    Kami dengan senang hati mengabarkan bahwa pengajuan magang Anda telah <strong style="color: #16a34a;">disetujui</strong>! 
                    Selamat atas pencapaian ini.
                </p>
            </div>

            <!-- Status Badge -->
            <div class="status-section">
                <div class="pulse-dot"></div>
                <span class="status-text">Status: Diterima</span>
                <span class="status-date">
                    {{ $magang->tanggal_diterima ? \Carbon\Carbon::parse($magang->tanggal_diterima)->format('d F Y H:i') : '' }}
                </span>
            </div>

            <!-- Detail Magang -->
            <div class="detail-section">
                <h3 class="section-title">
                    <div class="title-dot"></div>
                    Detail Magang
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
                            <p class="detail-label">Dosen Pembimbing</p>
                            <p class="detail-value">{{ $magang->dosenPembimbing->user->name ?? 'Akan ditentukan' }}</p>
                        </div>
                        <div class="detail-item">
                            <p class="detail-label">Periode</p>
                            <p class="detail-value">{{ $magang->lowongan->periodeMagang->nama_periode ?? 'Tidak tersedia' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Next Steps -->
            <div class="next-steps">
                <h3 class="section-title">
                    <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Langkah Selanjutnya
                </h3>
                <ul class="steps-list">
                    <li class="step-item">
                        <div class="step-dot"></div>
                        <span class="step-text">Hubungi dosen pembimbing yang telah ditugaskan</span>
                    </li>
                    <li class="step-item">
                        <div class="step-dot"></div>
                        <span class="step-text">Koordinasi dengan perusahaan untuk jadwal mulai magang</span>
                    </li>
                    <li class="step-item">
                        <div class="step-dot"></div>
                        <span class="step-text">Siapkan dokumen yang diperlukan untuk memulai magang</span>
                    </li>
                    <li class="step-item">
                        <div class="step-dot"></div>
                        <span class="step-text">Pastikan mengisi log aktivitas harian selama magang</span>
                    </li>
                </ul>
            </div>

            <!-- CTA Button -->
            <div class="cta-section">
                <a href="{{ route('mahasiswa.dashboard') }}" class="cta-button">
                    <svg class="cta-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                    Lihat Dashboard
                </a>
            </div>

            <!-- Closing Message -->
            <div class="closing-message">
                <p>
                    Jika Anda memiliki pertanyaan, jangan ragu untuk menghubungi koordinator magang atau dosen pembimbing.
                </p>
                <p class="highlight">
                    Selamat dan sukses untuk perjalanan magang Anda!
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