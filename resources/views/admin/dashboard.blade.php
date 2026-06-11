<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - CBT Pro</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Outfit:wght@500;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('style.css') }}">
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        .admin-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        .stat-card {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 16px;
            padding: 20px;
            display: flex;
            align-items: center;
            gap: 15px;
        }
        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            background: rgba(59, 130, 246, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #3b82f6;
        }
        .stat-info h3 {
            font-size: 1.5rem;
            margin: 0;
            font-family: 'Outfit', sans-serif;
        }
        .stat-info p {
            margin: 0;
            color: #94a3b8;
            font-size: 0.9rem;
        }
        .table-container {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 16px;
            overflow: hidden;
            backdrop-filter: blur(20px);
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 16px 20px;
            text-align: left;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }
        th {
            background: rgba(0, 0, 0, 0.2);
            font-weight: 600;
            color: #e2e8f0;
            text-transform: uppercase;
            font-size: 0.8rem;
            letter-spacing: 0.05em;
        }
        tr:last-child td {
            border-bottom: none;
        }
        tr:hover td {
            background: rgba(255, 255, 255, 0.02);
        }
        .badge-status {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 500;
        }
        .status-mengerjakan {
            background: rgba(234, 179, 8, 0.1);
            color: #eab308;
            border: 1px solid rgba(234, 179, 8, 0.2);
        }
        .status-selesai {
            background: rgba(34, 197, 94, 0.1);
            color: #22c55e;
            border: 1px solid rgba(34, 197, 94, 0.2);
        }
    </style>
</head>
<body>

<div class="app-container">
    <header class="glass-header">
        <div class="header-content">
            <div class="logo">
                <i data-lucide="shield-check"></i>
                <h1>Admin<span>Dashboard</span></h1>
            </div>
            <div>
                <a href="{{ route('exam.index') }}" class="btn btn-outline" style="padding: 8px 16px; font-size: 0.9rem;">
                    <i data-lucide="external-link"></i> Halaman Ujian
                </a>
            </div>
        </div>
    </header>

    <main class="main-content" style="max-width: 1200px;">
        <div class="admin-header">
            <div>
                <h2 style="font-family: 'Outfit', sans-serif; margin-bottom: 5px;">Pantau Peserta Ujian</h2>
                <p style="color: #94a3b8; margin: 0;">Lihat status dan hasil dari peserta CBT secara real-time.</p>
            </div>
            <button onclick="window.location.reload()" class="btn btn-primary" style="padding: 10px 20px;">
                <i data-lucide="refresh-cw"></i> Segarkan Data
            </button>
        </div>

        @php
            $total = $participants->count();
            $selesai = $participants->where('status', 'selesai')->count();
            $mengerjakan = $participants->where('status', 'mengerjakan')->count();
            $avgScore = $selesai > 0 ? $participants->where('status', 'selesai')->avg('score') : 0;
        @endphp

        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon">
                    <i data-lucide="users"></i>
                </div>
                <div class="stat-info">
                    <h3>{{ $total }}</h3>
                    <p>Total Peserta</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon" style="background: rgba(234, 179, 8, 0.1); color: #eab308;">
                    <i data-lucide="clock"></i>
                </div>
                <div class="stat-info">
                    <h3>{{ $mengerjakan }}</h3>
                    <p>Sedang Mengerjakan</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon" style="background: rgba(34, 197, 94, 0.1); color: #22c55e;">
                    <i data-lucide="check-circle"></i>
                </div>
                <div class="stat-info">
                    <h3>{{ $selesai }}</h3>
                    <p>Selesai Ujian</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon" style="background: rgba(168, 85, 247, 0.1); color: #a855f7;">
                    <i data-lucide="award"></i>
                </div>
                <div class="stat-info">
                    <h3>{{ number_format($avgScore, 1) }}</h3>
                    <p>Rata-rata Nilai</p>
                </div>
            </div>
        </div>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Waktu Mulai</th>
                        <th>Nama Peserta</th>
                        <th>NIM / NIS</th>
                        <th>Status</th>
                        <th>Nilai</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($participants as $p)
                        <tr>
                            <td style="color: #94a3b8;">{{ $p->created_at->format('d M Y, H:i') }}</td>
                            <td style="font-weight: 500;">{{ $p->name }}</td>
                            <td>{{ $p->nim ?? '-' }}</td>
                            <td>
                                <span class="badge-status status-{{ $p->status }}">
                                    {{ ucfirst($p->status) }}
                                </span>
                            </td>
                            <td>
                                @if($p->status == 'selesai')
                                    <span style="font-weight: 600; font-family: 'Outfit', sans-serif;">{{ $p->score }}</span>
                                @else
                                    <span style="color: #64748b;">-</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="text-align: center; padding: 40px; color: #94a3b8;">
                                <i data-lucide="inbox" style="width: 48px; height: 48px; margin-bottom: 10px; opacity: 0.5;"></i>
                                <p>Belum ada peserta yang mendaftar ujian.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </main>
</div>

<script>
    lucide.createIcons();
    // Auto refresh every 30 seconds
    setTimeout(function() {
        window.location.reload();
    }, 30000);
</script>
</body>
</html>
