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
    <script>
      window.MathJax = {
        tex: {
          inlineMath: [['$', '$'], ['\\(', '\\)']],
          displayMath: [['$$', '$$'], ['\\[', '\\]']],
          processEscapes: true
        },
        startup: {
          pageReady: () => {
            return MathJax.startup.defaultPageReady();
          }
        }
      };
    </script>
    <script id="MathJax-script" async src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>
    <style>
        body {
            margin: 0;
            background: #0f172a;
            color: #f8fafc;
        }
        
        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }
        ::-webkit-scrollbar-track {
            background: rgba(15, 23, 42, 0.2);
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.15);
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: rgba(59, 130, 246, 0.4);
        }

        .admin-layout {
            display: flex;
            min-height: 100vh;
        }
        .sidebar {
            width: 260px;
            background: rgba(15, 23, 42, 0.8);
            border-right: 1px solid rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(20px);
            display: flex;
            flex-direction: column;
            padding: 30px 20px;
            position: fixed;
            top: 0; bottom: 0; left: 0;
            z-index: 100;
        }
        .sidebar-logo {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 40px;
            color: #fff;
            font-family: 'Outfit', sans-serif;
            font-size: 1.5rem;
            font-weight: 800;
            letter-spacing: -0.5px;
        }
        .sidebar-nav {
            display: flex;
            flex-direction: column;
            gap: 8px;
            flex: 1;
        }
        .nav-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 14px 16px;
            color: #94a3b8;
            text-decoration: none;
            border-radius: 12px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            font-weight: 500;
            font-size: 0.95rem;
        }
        .nav-item i {
            width: 20px; height: 20px;
        }
        .nav-item:hover {
            background: rgba(255, 255, 255, 0.05);
            color: #e2e8f0;
            transform: translateX(4px);
        }
        .nav-item.active {
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.15), rgba(147, 51, 234, 0.15));
            color: #fff;
            border: 1px solid rgba(59, 130, 246, 0.3);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.1);
        }
        .main-content-area {
            flex: 1;
            margin-left: 260px;
            padding: 40px;
            max-width: 1400px;
        }
        .admin-section {
            display: none;
            animation: fadeIn 0.4s ease;
        }
        .admin-section.active {
            display: block;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(15px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .admin-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        .stat-card {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.05);
            border-radius: 16px;
            padding: 24px;
            display: flex;
            align-items: center;
            gap: 15px;
            transition: transform 0.3s;
        }
        .stat-card:hover {
            transform: translateY(-5px);
            background: rgba(255, 255, 255, 0.05);
        }
        .stat-icon {
            width: 54px;
            height: 54px;
            border-radius: 14px;
            background: rgba(59, 130, 246, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #3b82f6;
        }
        .stat-icon i {
            width: 24px; height: 24px;
        }
        .stat-info h3 {
            font-size: 1.8rem;
            margin: 0;
            font-family: 'Outfit', sans-serif;
            font-weight: 700;
        }
        .stat-info p {
            margin: 0;
            color: #94a3b8;
            font-size: 0.9rem;
        }
        .table-container {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.05);
            border-radius: 16px;
            overflow: hidden;
            backdrop-filter: blur(20px);
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 18px 24px;
            text-align: left;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }
        th {
            background: rgba(0, 0, 0, 0.2);
            font-weight: 600;
            color: #94a3b8;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.1em;
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
        .admin-tabs {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
            overflow-x: auto;
            padding-bottom: 10px;
        }
        .admin-tabs::-webkit-scrollbar {
            height: 6px;
        }
        .admin-tabs::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 3px;
        }
        .admin-tab-btn {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: #94a3b8;
            padding: 10px 20px;
            border-radius: 8px;
            cursor: pointer;
            font-family: 'Outfit', sans-serif;
            font-size: 0.95rem;
            white-space: nowrap;
            transition: all 0.3s;
        }
        .admin-tab-btn:hover {
            background: rgba(255, 255, 255, 0.1);
            color: #e2e8f0;
        }
        .admin-tab-btn.active {
            background: rgba(59, 130, 246, 0.2);
            border-color: #3b82f6;
            color: #3b82f6;
            font-weight: 600;
        }
        .admin-tab-pane {
            display: none;
        }
        .admin-tab-pane.active {
            display: block;
        }

        /* Modal CSS */
        .modal-overlay {
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(5px);
            z-index: 1000;
            display: none;
            align-items: center;
            justify-content: center;
        }
        .modal-overlay.active {
            display: flex;
        }
        .modal-content {
            background: #1e293b;
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 16px;
            width: 90%;
            max-width: 700px;
            max-height: 90vh;
            overflow-y: auto;
            padding: 30px;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.5);
            animation: modalFadeIn 0.3s ease;
        }
        @keyframes modalFadeIn {
            from { opacity: 0; transform: scale(0.95); }
            to { opacity: 1; transform: scale(1); }
        }
        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }
        .modal-title {
            font-family: 'Outfit', sans-serif;
            font-size: 1.5rem;
            font-weight: 700;
            color: #f8fafc;
            margin: 0;
        }
        .modal-close {
            background: none;
            border: none;
            color: #94a3b8;
            cursor: pointer;
            transition: color 0.3s;
        }
        .modal-close:hover {
            color: #ef4444;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            font-size: 0.85rem;
            color: #cbd5e1;
            margin-bottom: 6px;
            font-weight: 500;
        }
        .form-control {
            width: 100%;
            background: rgba(15, 23, 42, 0.5);
            color: #f8fafc;
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 8px;
            padding: 10px 12px;
            font-family: 'Inter', sans-serif;
            outline: none;
            transition: border-color 0.3s;
        }
        .form-control:focus {
            border-color: #3b82f6;
        }
        .btn-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 32px;
            height: 32px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            transition: all 0.2s;
        }
        .btn-edit {
            background: rgba(59, 130, 246, 0.15);
            color: #3b82f6;
        }
        .btn-edit:hover { background: #3b82f6; color: #fff; }
        .btn-delete {
            background: rgba(239, 68, 68, 0.15);
            color: #ef4444;
        }
        .btn-delete:hover { background: #ef4444; color: #fff; }
    </style>
</head>
<body>

<div class="admin-layout">
    <aside class="sidebar">
        <div class="sidebar-logo">
            <div style="background: linear-gradient(135deg, #3b82f6, #8b5cf6); padding: 10px; border-radius: 12px; display: flex; box-shadow: 0 4px 15px rgba(59,130,246,0.3);">
                <i data-lucide="shield-check" style="color: white; width: 22px; height: 22px;"></i>
            </div>
            CBT<span>Admin</span>
        </div>
        
        <nav class="sidebar-nav">
            <a href="#" class="nav-item active" onclick="switchAdminMenu('dashboard', this)">
                <i data-lucide="layout-dashboard"></i> Dashboard
            </a>
            <a href="#" class="nav-item" onclick="switchAdminMenu('bank', this)">
                <i data-lucide="database"></i> Bank Soal
            </a>
            <a href="#" class="nav-item" onclick="switchAdminMenu('ai', this)">
                <i data-lucide="bot"></i> AI Generator
            </a>
            <a href="#" class="nav-item" onclick="switchAdminMenu('pengaturan', this)">
                <i data-lucide="settings"></i> Pengaturan
            </a>
        </nav>

        <div style="margin-top: auto; padding-top: 25px; border-top: 1px solid rgba(255,255,255,0.05);">
            <a href="{{ route('exam.index') }}" class="btn btn-outline" style="width: 100%; display: flex; justify-content: center; align-items: center; gap: 8px; font-weight: 500;">
                <i data-lucide="external-link" style="width: 18px; height: 18px;"></i> Buka Aplikasi Ujian
            </a>
        </div>
    </aside>

    <main class="main-content-area">
        
        <!-- SECTION: DASHBOARD -->
        <section id="menu-dashboard" class="admin-section active">
            <div class="admin-header">
                <div>
                    <h2 style="font-family: 'Outfit', sans-serif; font-size: 2rem; margin-bottom: 5px;">Pantau Peserta Ujian</h2>
                    <p style="color: #94a3b8; margin: 0; font-size: 1.05rem;">Lihat status dan hasil dari peserta CBT secara real-time.</p>
                </div>
                <div>
                    <button onclick="window.location.reload()" class="btn btn-primary" style="padding: 12px 24px; display: flex; align-items: center; gap: 8px; font-weight: 500;">
                        <i data-lucide="refresh-cw" style="width: 18px; height: 18px;"></i> Segarkan Data
                    </button>
                </div>
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
                            <th>Nama Peserta & NIM</th>
                            <th>Status</th>
                            <th>Nilai Rata-rata</th>
                            <th>Detail Per Tab (Nilai & Waktu)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($participants as $p)
                            <tr>
                                <td style="color: #94a3b8; font-size: 0.9rem;">{{ $p->created_at->format('d M Y, H:i') }}</td>
                                <td>
                                    <div style="font-weight: 500; font-size: 1.05rem;">{{ $p->name }}</div>
                                    <div style="font-size: 0.85rem; color: #94a3b8; margin-top: 2px;">{{ $p->nim ?? '-' }}</div>
                                </td>
                                <td>
                                    <span class="badge-status status-{{ $p->status }}">
                                        {{ ucfirst($p->status) }}
                                    </span>
                                </td>
                                <td>
                                    @if($p->status == 'selesai' || ($p->tab_results && count($p->tab_results) > 0))
                                        <span style="font-weight: 700; font-family: 'Outfit', sans-serif; font-size: 1.2rem; color: #f8fafc;">{{ $p->score }}</span>
                                    @else
                                        <span style="color: #64748b;">-</span>
                                    @endif
                                </td>
                                <td>
                                    @if($p->tab_results && is_array($p->tab_results))
                                        <div style="display: flex; flex-direction: column; gap: 6px;">
                                            @foreach($p->tab_results as $mapel => $res)
                                                <div style="font-size: 0.85rem; background: rgba(255,255,255,0.03); padding: 6px 10px; border-radius: 6px; display: flex; justify-content: space-between; border: 1px solid rgba(255,255,255,0.05);">
                                                    <span style="font-weight: 500; color: #e2e8f0;">{{ $mapel }}</span>
                                                    <span>
                                                        <span style="color: #3b82f6; font-weight: bold; margin-right: 12px;">{{ $res['score'] }}</span>
                                                        <span style="color: #94a3b8; display: inline-flex; align-items: center; gap: 4px;">
                                                            <i data-lucide="clock" style="width: 12px; height: 12px;"></i>
                                                            {{ floor($res['time_taken_seconds'] / 60) }}m {{ $res['time_taken_seconds'] % 60 }}s
                                                        </span>
                                                    </span>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <span style="color: #64748b; font-size: 0.85rem;">Belum ada data</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" style="text-align: center; padding: 60px 40px; color: #94a3b8;">
                                    <i data-lucide="inbox" style="width: 54px; height: 54px; margin-bottom: 15px; opacity: 0.3;"></i>
                                    <p style="font-size: 1.1rem;">Belum ada peserta yang mendaftar ujian.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>

        <!-- SECTION: BANK SOAL -->
        <section id="menu-bank" class="admin-section">
            <div class="admin-header">
                <div>
                    <h2 style="font-family: 'Outfit', sans-serif; font-size: 2rem; margin-bottom: 5px;">Bank Soal Tersimpan</h2>
                    <p style="color: #94a3b8; margin: 0; font-size: 1.05rem;">Total {{ $questions->count() }} soal di dalam bank soal saat ini.</p>
                </div>
                <div>
                    <button type="button" class="btn btn-outline" style="border-color: #ef4444; color: #ef4444; padding: 12px 24px; font-weight: 500; display: flex; align-items: center; gap: 8px;" onclick="deleteSelectedQuestions()">
                        <i data-lucide="trash-2" style="width: 18px; height: 18px;"></i> Hapus Terpilih
                    </button>
                </div>
            </div>

            @php
                $groupedQuestions = $questions->groupBy('mapel');
            @endphp

            @if($questions->count() > 0)
                <div class="admin-tabs">
                    <button class="admin-tab-btn active" onclick="openAdminTab('semua', this)">
                        Semua ({{ $questions->count() }})
                    </button>
                    @foreach($groupedQuestions as $mapel => $qs)
                        <button class="admin-tab-btn" onclick="openAdminTab('{{ Str::slug($mapel) }}', this)">
                            {{ $mapel }} ({{ $qs->count() }})
                        </button>
                    @endforeach
                </div>

                <!-- Tab Semua -->
                <div id="tab-semua" class="admin-tab-pane active">
                    <div class="table-container" style="max-height: 600px; overflow-y: auto;">
                        <table>
                            <thead style="position: sticky; top: 0; z-index: 10; background: rgba(15, 23, 42, 0.95); backdrop-filter: blur(10px);">
                                <tr>
                                    <th style="width: 40px; text-align: center;"><input type="checkbox" onclick="toggleAllCheckboxes(this)"></th>
                                    <th>Kategori</th>
                                    <th>Soal</th>
                                    <th>Pilihan</th>
                                    <th>Kunci</th>
                                    <th>Tingkat</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($questions as $q)
                                    <tr>
                                        <td style="vertical-align: top; text-align: center;">
                                            <input type="checkbox" class="cb-question" value="{{ $q->id }}">
                                        </td>
                                        <td style="vertical-align: top; width: 120px;">
                                            <div style="font-weight: 600; margin-bottom: 8px; color: #f8fafc; font-size: 0.95rem;">{{ $q->mapel }}</div>
                                            <span class="badge-status status-mengerjakan" style="font-size: 0.7rem; padding: 4px 8px;">{{ $q->kategori }}</span>
                                        </td>
                                        <td style="vertical-align: top;">
                                            <div style="max-height: 180px; min-width: 350px; overflow-y: auto; font-size: 0.95rem; color: #e2e8f0; line-height: 1.6; padding-right: 15px;">
                                                {!! nl2br(e($q->soal)) !!}
                                            </div>
                                        </td>
                                        <td style="vertical-align: top;">
                                            <ul style="list-style-type: none; padding: 0; margin: 0; font-size: 0.9rem; color: #94a3b8; display: flex; flex-direction: column; gap: 6px;">
                                                <li><strong style="color: #cbd5e1;">A:</strong> {{ Str::limit($q->pilihan_a, 60) }}</li>
                                                <li><strong style="color: #cbd5e1;">B:</strong> {{ Str::limit($q->pilihan_b, 60) }}</li>
                                                <li><strong style="color: #cbd5e1;">C:</strong> {{ Str::limit($q->pilihan_c, 60) }}</li>
                                                <li><strong style="color: #cbd5e1;">D:</strong> {{ Str::limit($q->pilihan_d, 60) }}</li>
                                            </ul>
                                        </td>
                                        <td style="vertical-align: top; width: 80px;">
                                            <div style="display: flex; align-items: center; justify-content: center; width: 36px; height: 36px; background: rgba(34, 197, 94, 0.1); border: 1px solid rgba(34, 197, 94, 0.3); border-radius: 10px; color: #22c55e; font-weight: bold; font-size: 1.2rem;">
                                                {{ $q->jawaban }}
                                            </div>
                                        </td>
                                        <td style="vertical-align: top; width: 100px;">
                                            <span class="badge-status status-selesai">{{ $q->tingkat_kesulitan }}</span>
                                        </td>
                                        <td style="vertical-align: top; width: 100px;">
                                            <div style="display: flex; gap: 8px;">
                                                <button type="button" class="btn-icon btn-edit" onclick="openEditModal({{ json_encode($q) }})" title="Edit Soal">
                                                    <i data-lucide="edit-3" style="width: 16px; height: 16px;"></i>
                                                </button>
                                                <form action="{{ route('admin.question.delete', $q->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus soal ini secara permanen?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn-icon btn-delete" title="Hapus Soal">
                                                        <i data-lucide="trash-2" style="width: 16px; height: 16px;"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Tab Per Mata Pelajaran -->
                @foreach($groupedQuestions as $mapel => $qs)
                    <div id="tab-{{ Str::slug($mapel) }}" class="admin-tab-pane">
                        <div class="table-container" style="max-height: 600px; overflow-y: auto;">
                            <table>
                                <thead style="position: sticky; top: 0; z-index: 10; background: rgba(15, 23, 42, 0.95); backdrop-filter: blur(10px);">
                                    <tr>
                                        <th style="width: 40px; text-align: center;"><input type="checkbox" onclick="toggleAllCheckboxes(this)"></th>
                                        <th>Kategori</th>
                                        <th>Soal</th>
                                        <th>Pilihan</th>
                                        <th>Kunci</th>
                                        <th>Tingkat</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($qs as $q)
                                        <tr>
                                            <td style="vertical-align: top; text-align: center;">
                                                <input type="checkbox" class="cb-question" value="{{ $q->id }}">
                                            </td>
                                            <td style="vertical-align: top; width: 120px;">
                                                <span class="badge-status status-mengerjakan" style="font-size: 0.7rem; padding: 4px 8px;">{{ $q->kategori }}</span>
                                            </td>
                                            <td style="vertical-align: top;">
                                                <div style="max-height: 180px; min-width: 350px; overflow-y: auto; font-size: 0.95rem; color: #e2e8f0; line-height: 1.6; padding-right: 15px;">
                                                    {!! nl2br(e($q->soal)) !!}
                                                </div>
                                            </td>
                                            <td style="vertical-align: top;">
                                                <ul style="list-style-type: none; padding: 0; margin: 0; font-size: 0.9rem; color: #94a3b8; display: flex; flex-direction: column; gap: 6px;">
                                                    <li><strong style="color: #cbd5e1;">A:</strong> {{ Str::limit($q->pilihan_a, 60) }}</li>
                                                    <li><strong style="color: #cbd5e1;">B:</strong> {{ Str::limit($q->pilihan_b, 60) }}</li>
                                                    <li><strong style="color: #cbd5e1;">C:</strong> {{ Str::limit($q->pilihan_c, 60) }}</li>
                                                    <li><strong style="color: #cbd5e1;">D:</strong> {{ Str::limit($q->pilihan_d, 60) }}</li>
                                                </ul>
                                            </td>
                                            <td style="vertical-align: top; width: 80px;">
                                                <div style="display: flex; align-items: center; justify-content: center; width: 36px; height: 36px; background: rgba(34, 197, 94, 0.1); border: 1px solid rgba(34, 197, 94, 0.3); border-radius: 10px; color: #22c55e; font-weight: bold; font-size: 1.2rem;">
                                                    {{ $q->jawaban }}
                                                </div>
                                            </td>
                                            <td style="vertical-align: top; width: 100px;">
                                                <span class="badge-status status-selesai">{{ $q->tingkat_kesulitan }}</span>
                                            </td>
                                            <td style="vertical-align: top; width: 100px;">
                                                <div style="display: flex; gap: 8px;">
                                                    <button type="button" class="btn-icon btn-edit" onclick="openEditModal({{ json_encode($q) }})" title="Edit Soal">
                                                        <i data-lucide="edit-3" style="width: 16px; height: 16px;"></i>
                                                    </button>
                                                    <form action="{{ route('admin.question.delete', $q->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus soal ini secara permanen?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn-icon btn-delete" title="Hapus Soal">
                                                            <i data-lucide="trash-2" style="width: 16px; height: 16px;"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="table-container" style="margin-bottom: 40px;">
                    <div style="text-align: center; padding: 80px 40px; color: #94a3b8;">
                        <i data-lucide="database" style="width: 64px; height: 64px; margin-bottom: 20px; opacity: 0.3;"></i>
                        <p style="font-size: 1.2rem;">Bank soal masih kosong.</p>
                    </div>
                </div>
            @endif
        </section>

        <!-- SECTION: AI GENERATOR -->
        <section id="menu-ai" class="admin-section">
            <div class="admin-header">
                <div>
                    <h2 style="font-family: 'Outfit', sans-serif; font-size: 2rem; margin-bottom: 5px;">AI Question Generator (Manual)</h2>
                    <p style="color: #94a3b8; margin: 0; font-size: 1.05rem;">Tambah soal otomatis tanpa bentrok dengan soal yang sudah ada.</p>
                </div>
            </div>
            
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 30px;">
                <!-- Langkah 1 -->
                <div class="stat-card" style="flex-direction: column; align-items: flex-start; padding: 30px;">
                    <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 20px;">
                        <div style="background: rgba(59, 130, 246, 0.15); color: #3b82f6; width: 40px; height: 40px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 1.2rem;">1</div>
                        <h3 style="margin: 0; font-size: 1.3rem; color: #f8fafc; font-family: 'Outfit', sans-serif;">Generate Prompt</h3>
                    </div>
                    <p style="color:#94a3b8; font-size:0.95rem; margin-bottom: 25px; line-height: 1.6;">Pilih mata pelajaran dan jumlah soal. Sistem akan membuat instruksi (prompt) yang menyertakan soal lama agar AI tidak membuat soal yang redundan.</p>
                    
                    <div style="display: flex; gap: 20px; width: 100%; margin-bottom: 20px;">
                        <div style="flex: 2;">
                            <label style="display: block; font-size: 0.85rem; color: #cbd5e1; margin-bottom: 8px; font-weight: 500;">Mata Pelajaran</label>
                            <select id="geminiMapel" style="width: 100%; background: rgba(15, 23, 42, 0.5); color: #f8fafc; border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; padding: 12px; font-family: 'Inter', sans-serif; outline: none;">
                                <option value="TPA">TPA</option>
                                <option value="Matematika">Matematika</option>
                                <option value="IPA">IPA</option>
                                <option value="Bahasa Indonesia">Bahasa Indonesia</option>
                                <option value="Bahasa Inggris">Bahasa Inggris</option>
                            </select>
                        </div>
                        <div style="flex: 1.5;">
                            <label style="display: block; font-size: 0.85rem; color: #cbd5e1; margin-bottom: 8px; font-weight: 500;">Tingkat</label>
                            <select id="geminiTingkat" style="width: 100%; background: rgba(15, 23, 42, 0.5); color: #f8fafc; border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; padding: 12px; font-family: 'Inter', sans-serif; outline: none;">
                                <option value="Mudah">Mudah</option>
                                <option value="Sedang">Sedang</option>
                                <option value="Sulit" selected>Sulit</option>
                            </select>
                        </div>
                        <div style="flex: 1;">
                            <label style="display: block; font-size: 0.85rem; color: #cbd5e1; margin-bottom: 8px; font-weight: 500;">Jumlah</label>
                            <input type="number" id="geminiJumlah" value="10" min="1" style="width: 100%; background: rgba(15, 23, 42, 0.5); color: #f8fafc; border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; padding: 12px; font-family: 'Inter', sans-serif; outline: none;" placeholder="Jml">
                        </div>
                    </div>
                    <button type="button" id="btnSalinPrompt" class="btn btn-primary" style="width: 100%; display: flex; justify-content: center; align-items: center; gap: 10px; padding: 14px; font-weight: 600;">
                        <i data-lucide="copy" style="width: 20px; height: 20px;"></i> Salin Prompt & Buka Gemini
                    </button>
                </div>

                <!-- Langkah 2 -->
                <div class="stat-card" style="flex-direction: column; align-items: flex-start; padding: 30px;">
                    <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 20px;">
                        <div style="background: rgba(34, 197, 94, 0.15); color: #22c55e; width: 40px; height: 40px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 1.2rem;">2</div>
                        <h3 style="margin: 0; font-size: 1.3rem; color: #f8fafc; font-family: 'Outfit', sans-serif;">Import JSON</h3>
                    </div>
                    <p style="color:#94a3b8; font-size:0.95rem; margin-bottom: 25px; line-height: 1.6;">Paste kode JSON balasan dari Gemini ke kotak di bawah ini. Sistem akan otomatis memvalidasi dan memindahkannya ke bank soal.</p>
                    <form action="{{ route('admin.import.gemini') }}" method="POST" style="width: 100%;">
                        @csrf
                        <label style="display: block; font-size: 0.85rem; color: #cbd5e1; margin-bottom: 8px; font-weight: 500;">Format JSON Array Mentah</label>
                        <textarea name="json_data" rows="4" placeholder="Paste JSON array di sini..." style="width: 100%; background: rgba(15, 23, 42, 0.5); border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; color: #f8fafc; padding: 12px; margin-bottom: 20px; font-family: monospace; outline: none; resize: vertical;" required></textarea>
                        <button type="submit" class="btn btn-outline" style="width: 100%; border-color: #22c55e; color: #22c55e; display: flex; justify-content: center; align-items: center; gap: 10px; padding: 14px; font-weight: 600;">
                            <i data-lucide="download-cloud" style="width: 20px; height: 20px;"></i> Import Soal ke Database
                        </button>
                    </form>
                </div>
            </div>
        </section>

        <!-- SECTION: PENGATURAN -->
        <section id="menu-pengaturan" class="admin-section">
            <div class="admin-header">
                <div>
                    <h2 style="font-family: 'Outfit', sans-serif; font-size: 2rem; margin-bottom: 5px;">Pengaturan Ujian</h2>
                    <p style="color: #94a3b8; margin: 0; font-size: 1.05rem;">Konfigurasi fitur dan tampilan di aplikasi ujian CBT peserta.</p>
                </div>
            </div>

            <div style="display: flex; flex-direction: column; gap: 20px;">
                <div class="stat-card" style="flex-direction: row; justify-content: space-between; max-width: 700px; padding: 30px;">
                    <div style="display: flex; align-items: center; gap: 20px;">
                        <div class="stat-icon" style="background: rgba(239, 68, 68, 0.1); color: #ef4444; width: 64px; height: 64px; border-radius: 16px;">
                            <i data-lucide="{{ ($settings['show_kunci_jawaban'] ?? true) ? 'eye' : 'eye-off' }}" style="width: 28px; height: 28px;"></i>
                        </div>
                        <div>
                            <h3 style="font-size: 1.3rem; color: #f8fafc; font-family: 'Outfit', sans-serif; margin: 0 0 8px 0;">Kunci Jawaban Ujian</h3>
                            <p style="color: #94a3b8; font-size: 0.95rem; margin: 0; max-width: 350px;">Izinkan sistem untuk menampilkan hasil dan kunci jawaban yang benar setelah peserta menyelesaikan ujian.</p>
                        </div>
                    </div>
                    <form action="{{ route('admin.settings.toggle') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn {{ ($settings['show_kunci_jawaban'] ?? true) ? 'btn-outline' : 'btn-primary' }}" style="padding: 12px 24px; font-weight: 600; border-color: #ef4444; color: {{ ($settings['show_kunci_jawaban'] ?? true) ? '#ef4444' : '#fff' }}; background: {{ ($settings['show_kunci_jawaban'] ?? true) ? 'transparent' : '#ef4444' }};">
                            {{ ($settings['show_kunci_jawaban'] ?? true) ? 'Sembunyikan Kunci' : 'Tampilkan Kunci' }}
                        </button>
                    </form>
                </div>

                <div class="stat-card" style="flex-direction: row; justify-content: space-between; max-width: 700px; padding: 30px;">
                    <div style="display: flex; align-items: center; gap: 20px;">
                        <div class="stat-icon" style="background: rgba(59, 130, 246, 0.1); color: #3b82f6; width: 64px; height: 64px; border-radius: 16px;">
                            <i data-lucide="clock" style="width: 28px; height: 28px;"></i>
                        </div>
                        <div>
                            <h3 style="font-size: 1.3rem; color: #f8fafc; font-family: 'Outfit', sans-serif; margin: 0 0 8px 0;">Waktu Per Soal</h3>
                            <p style="color: #94a3b8; font-size: 0.95rem; margin: 0; max-width: 350px;">Atur berapa menit alokasi waktu yang diberikan untuk setiap 1 soal. Waktu tab otomatis dikalikan jumlah soal.</p>
                        </div>
                    </div>
                    <form action="{{ route('admin.settings.waktu') }}" method="POST" style="display: flex; gap: 10px; align-items: center;">
                        @csrf
                        <input type="number" name="menit_per_soal" value="{{ $settings['menit_per_soal'] ?? 1 }}" min="1" class="form-control" style="width: 80px; text-align: center; font-weight: bold; font-size: 1.1rem; border-color: rgba(59, 130, 246, 0.3);">
                        <span style="color: #94a3b8;">Menit</span>
                        <button type="submit" class="btn btn-primary" style="padding: 10px 16px; margin-left: 10px;">
                            <i data-lucide="save" style="width: 18px; height: 18px;"></i> Simpan
                        </button>
                    </form>
                </div>
            </div>
        </section>

        <!-- Modal Edit Soal -->
        <div id="editModal" class="modal-overlay">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Edit Soal</h3>
                    <button type="button" class="modal-close" onclick="closeEditModal()">
                        <i data-lucide="x" style="width: 24px; height: 24px;"></i>
                    </button>
                </div>
                <form id="editForm" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                        <button type="button" class="btn btn-outline" onclick="copyAIFixPrompt()" id="btnCopyAIFix" style="border-color: #a855f7; color: #a855f7; display: flex; align-items: center; gap: 8px;">
                            <i data-lucide="sparkles" style="width: 16px; height: 16px;"></i> Perbaiki Otomatis dengan AI
                        </button>
                    </div>

                    <div id="aiFixContainer" style="display: none; margin-bottom: 20px; background: rgba(168, 85, 247, 0.1); padding: 15px; border-radius: 8px; border: 1px dashed rgba(168, 85, 247, 0.5);">
                        <label style="color: #c084fc; font-size: 0.85rem; display: block; margin-bottom: 8px;">Paste JSON balasan Gemini di sini:</label>
                        <textarea id="aiFixInput" class="form-control" rows="3" placeholder='{"soal": "...", "pilihan_a": "...", ...}' oninput="applyAIFix(this)"></textarea>
                    </div>
                    
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                        <div class="form-group">
                            <label>Mata Pelajaran</label>
                            <input type="text" name="mapel" id="edit-mapel" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Kategori</label>
                            <input type="text" name="kategori" id="edit-kategori" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Tingkat Kesulitan</label>
                            <select name="tingkat_kesulitan" id="edit-tingkat" class="form-control" required>
                                <option value="Mudah">Mudah</option>
                                <option value="Sedang">Sedang</option>
                                <option value="Sulit">Sulit</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Kunci Jawaban</label>
                            <select name="jawaban" id="edit-jawaban" class="form-control" required>
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="C">C</option>
                                <option value="D">D</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Teks Soal</label>
                        <textarea name="soal" id="edit-soal" class="form-control" rows="4" required></textarea>
                    </div>

                    <div class="form-group">
                        <label>Pilihan A</label>
                        <input type="text" name="pilihan_a" id="edit-a" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Pilihan B</label>
                        <input type="text" name="pilihan_b" id="edit-b" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Pilihan C</label>
                        <input type="text" name="pilihan_c" id="edit-c" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Pilihan D</label>
                        <input type="text" name="pilihan_d" id="edit-d" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Pembahasan / Langkah Penyelesaian (Opsional)</label>
                        <textarea name="pembahasan" id="edit-pembahasan" class="form-control" rows="3"></textarea>
                    </div>

                    <div style="display: flex; justify-content: flex-end; gap: 10px; margin-top: 25px;">
                        <button type="button" class="btn btn-outline" onclick="closeEditModal()">Batal</button>
                        <button type="submit" class="btn btn-primary" style="padding: 10px 20px;">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>

    </main>
</div>

@if(session('success'))
<script>alert("{{ session('success') }}");</script>
@endif

@if(session('error'))
<script>alert("{{ session('error') }}");</script>
@endif

<script>
    lucide.createIcons();

    // Edit Modal Functions
    function openEditModal(question) {
        document.getElementById('editModal').classList.add('active');
        document.getElementById('editForm').action = `/admin/question/${question.id}`;
        
        document.getElementById('edit-mapel').value = question.mapel || '';
        document.getElementById('edit-kategori').value = question.kategori || '';
        document.getElementById('edit-tingkat').value = question.tingkat_kesulitan || 'Sedang';
        document.getElementById('edit-jawaban').value = question.jawaban || 'A';
        document.getElementById('edit-soal').value = question.soal || '';
        document.getElementById('edit-a').value = question.pilihan_a || '';
        document.getElementById('edit-b').value = question.pilihan_b || '';
        document.getElementById('edit-c').value = question.pilihan_c || '';
        document.getElementById('edit-d').value = question.pilihan_d || '';
        document.getElementById('edit-pembahasan').value = question.pembahasan || '';
        
        // Reset AI container
        document.getElementById('aiFixContainer').style.display = 'none';
        document.getElementById('aiFixInput').value = '';
        let btnAIFix = document.getElementById('btnCopyAIFix');
        btnAIFix.innerHTML = '<i data-lucide="sparkles" style="width: 16px; height: 16px;"></i> Perbaiki Otomatis dengan AI';
        btnAIFix.style.background = 'transparent';
        btnAIFix.style.color = '#a855f7';
        
        window.isModalOpen = true;
        lucide.createIcons();
    }

    function copyAIFixPrompt() {
        let soal = document.getElementById('edit-soal').value;
        let pilA = document.getElementById('edit-a').value;
        let pilB = document.getElementById('edit-b').value;
        let pilC = document.getElementById('edit-c').value;
        let pilD = document.getElementById('edit-d').value;
        let jawaban = document.getElementById('edit-jawaban').value;
        let pembahasan = document.getElementById('edit-pembahasan').value;

        let prompt = "Tolong perbaiki tata bahasa, ejaan, dan perbaiki penulisan rumus/angka matematika pada soal berikut ini menggunakan format LaTeX/MathJax. WAJIB gunakan pembatas \\( ... \\) untuk inline dan $$ ... $$ untuk blok matematika.\n";
        prompt += "Tolong buatkan juga langkah-langkah penyelesaian atau pembahasan yang jelas untuk soal ini.\n\n";
        prompt += "PENTING: JANGAN PERNAH menggunakan tanda kutip ganda (\") di dalam teks jawaban, soal, maupun pembahasan. Gunakan tanda kutip tunggal (').\n\n";
        prompt += "KEMBALIKAN HANYA DALAM BENTUK JSON OBJECT mentah seperti struktur ini:\n";
        prompt += `{\n  "soal": "teks soal...",\n  "pilihan_a": "...",\n  "pilihan_b": "...",\n  "pilihan_c": "...",\n  "pilihan_d": "...",\n  "jawaban": "${jawaban}",\n  "pembahasan": "penjelasan langkah penyelesaian..."\n}\n\n`;
        prompt += "Berikut data soal aslinya:\n";
        prompt += `Soal: ${soal}\n`;
        prompt += `A: ${pilA}\nB: ${pilB}\nC: ${pilC}\nD: ${pilD}\n`;
        if (pembahasan) prompt += `Pembahasan Lama: ${pembahasan}\n`;

        navigator.clipboard.writeText(prompt).then(() => {
            let btnAIFix = document.getElementById('btnCopyAIFix');
            btnAIFix.innerHTML = '<i data-lucide="check" style="width: 16px; height: 16px;"></i> Prompt Disalin! Tempel di Gemini';
            btnAIFix.style.background = 'rgba(168, 85, 247, 0.2)';
            document.getElementById('aiFixContainer').style.display = 'block';
            lucide.createIcons();
            setTimeout(() => window.open('https://gemini.google.com/', '_blank'), 500);
        });
    }

    function applyAIFix(textarea) {
        let text = textarea.value.trim();
        if (!text) return;
        
        try {
            // Clean markdown if present
            text = text.replace(/```json\s*/, '').replace(/```\s*/, '');
            // Fix backslashes for MathJax
            text = text.replace(/(?<!\\)\\(?![\\"])/g, '\\\\');
            let data = JSON.parse(text);
            
            if (data.soal) document.getElementById('edit-soal').value = data.soal;
            if (data.pilihan_a) document.getElementById('edit-a').value = data.pilihan_a;
            if (data.pilihan_b) document.getElementById('edit-b').value = data.pilihan_b;
            if (data.pilihan_c) document.getElementById('edit-c').value = data.pilihan_c;
            if (data.pilihan_d) document.getElementById('edit-d').value = data.pilihan_d;
            if (data.jawaban) document.getElementById('edit-jawaban').value = data.jawaban;
            if (data.pembahasan) document.getElementById('edit-pembahasan').value = data.pembahasan;
            
            textarea.value = '';
            document.getElementById('aiFixContainer').style.display = 'none';
            alert('Perbaikan AI berhasil diterapkan!');
        } catch (e) {
            console.error("JSON Parse Error:", e);
        }
    }

    function closeEditModal() {
        document.getElementById('editModal').classList.remove('active');
        window.isModalOpen = false;
    }

    // Bulk Delete Functions
    function toggleAllCheckboxes(masterCheckbox) {
        let table = masterCheckbox.closest('table');
        let checkboxes = table.querySelectorAll('.cb-question');
        checkboxes.forEach(cb => cb.checked = masterCheckbox.checked);
    }

    function deleteSelectedQuestions() {
        let checkboxes = document.querySelectorAll('.cb-question:checked');
        let ids = [];
        checkboxes.forEach(cb => {
            if(!ids.includes(cb.value)) ids.push(cb.value);
        });

        if(ids.length === 0) {
            alert('Silakan pilih minimal satu soal untuk dihapus!');
            return;
        }

        if(confirm(`Apakah Anda yakin ingin menghapus ${ids.length} soal yang dipilih secara permanen?`)) {
            let form = document.createElement('form');
            form.method = 'POST';
            form.action = '{{ route('admin.questions.bulk_delete') }}';

            let csrfInput = document.createElement('input');
            csrfInput.type = 'hidden';
            csrfInput.name = '_token';
            csrfInput.value = '{{ csrf_token() }}';
            form.appendChild(csrfInput);

            let methodInput = document.createElement('input');
            methodInput.type = 'hidden';
            methodInput.name = '_method';
            methodInput.value = 'DELETE';
            form.appendChild(methodInput);

            let idsInput = document.createElement('input');
            idsInput.type = 'hidden';
            idsInput.name = 'ids';
            idsInput.value = JSON.stringify(ids);
            form.appendChild(idsInput);

            document.body.appendChild(form);
            form.submit();
        }
    }

    // Menu Navigation
    function switchAdminMenu(menuId, btn) {
        document.querySelectorAll('.admin-section').forEach(el => el.classList.remove('active'));
        document.querySelectorAll('.nav-item').forEach(el => el.classList.remove('active'));
        document.getElementById('menu-' + menuId).classList.add('active');
        btn.classList.add('active');
        localStorage.setItem('activeAdminMenu', menuId);
    }

    // Bank Soal Tabs Navigation
    function openAdminTab(tabId, btn) {
        document.querySelectorAll('.admin-tab-pane').forEach(el => el.classList.remove('active'));
        document.querySelectorAll('.admin-tab-btn').forEach(el => el.classList.remove('active'));
        document.getElementById('tab-' + tabId).classList.add('active');
        btn.classList.add('active');
        localStorage.setItem('activeAdminTab', tabId);
    }
    
    // Restore active menu & tab after reload
    document.addEventListener('DOMContentLoaded', () => {
        // Menu
        let activeMenu = localStorage.getItem('activeAdminMenu');
        if (activeMenu) {
            let section = document.getElementById('menu-' + activeMenu);
            let btn = document.querySelector(`.nav-item[onclick*="switchAdminMenu('${activeMenu}'"]`);
            if (section && btn) {
                document.querySelectorAll('.admin-section').forEach(el => el.classList.remove('active'));
                document.querySelectorAll('.nav-item').forEach(el => el.classList.remove('active'));
                section.classList.add('active');
                btn.classList.add('active');
            }
        }

        // Tabs
        let activeTab = localStorage.getItem('activeAdminTab');
        if (activeTab) {
            let pane = document.getElementById('tab-' + activeTab);
            let btn = document.querySelector(`.admin-tab-btn[onclick*="openAdminTab('${activeTab}'"]`);
            if (pane && btn) {
                document.querySelectorAll('.admin-tab-pane').forEach(el => el.classList.remove('active'));
                document.querySelectorAll('.admin-tab-btn').forEach(el => el.classList.remove('active'));
                pane.classList.add('active');
                btn.classList.add('active');
            }
        }
    });

    // Generate AI Prompt
    document.getElementById('btnSalinPrompt').addEventListener('click', function() {
        let btn = this;
        let mapel = document.getElementById('geminiMapel').value;
        let tingkat = document.getElementById('geminiTingkat').value;
        let jumlah = document.getElementById('geminiJumlah').value;
        let originalText = btn.innerHTML;
        
        btn.innerHTML = '<i data-lucide="loader" class="spin"></i> Memproses...';
        lucide.createIcons();
        
        let formData = new FormData();
        formData.append('mapel', mapel);
        formData.append('tingkat', tingkat);
        formData.append('jumlah', jumlah);
        formData.append('_token', '{{ csrf_token() }}');

        fetch('{{ route('admin.gemini.prompt') }}', {
            method: 'POST',
            body: formData,
            headers: {
                'Accept': 'application/json'
            }
        })
        .then(res => {
            if (!res.ok) {
                return res.text().then(text => { throw new Error('Error dari server: ' + res.status + ' ' + text.substring(0, 100)); });
            }
            return res.json();
        })
        .then(data => {
            if (data.error) {
                throw new Error(data.error);
            }
            
            // Fallback for non-HTTPS or if clipboard API is not available
            if (!navigator.clipboard) {
                try {
                    let textArea = document.createElement("textarea");
                    textArea.value = data.prompt;
                    textArea.style.position = "fixed";  // Avoid scrolling to bottom
                    document.body.appendChild(textArea);
                    textArea.focus();
                    textArea.select();
                    let successful = document.execCommand('copy');
                    document.body.removeChild(textArea);
                    
                    if (successful) {
                        alert("Prompt berhasil disalin ke clipboard! Silakan paste (Ctrl+V) di chat Gemini.");
                        window.open('https://gemini.google.com/app', '_blank');
                    } else {
                        alert("Gagal menyalin prompt. Browser Anda mungkin memblokir akses clipboard. Anda bisa menyalinnya secara manual dari textarea sementara jika diperlukan.");
                    }
                } catch (err) {
                    console.error('Fallback: Oops, unable to copy', err);
                    alert("Gagal menyalin prompt. Browser Anda tidak mendukung fitur copy otomatis di jaringan HTTP/tanpa SSL.");
                }
                btn.innerHTML = originalText;
                lucide.createIcons();
                return;
            }

            // Secure context (HTTPS or localhost)
            navigator.clipboard.writeText(data.prompt).then(() => {
                alert("Prompt berhasil disalin ke clipboard! Silakan paste (Ctrl+V) di chat Gemini.");
                window.open('https://gemini.google.com/app', '_blank');
            }).catch(err => {
                console.error('Gagal menyalin', err);
                alert("Gagal menyalin prompt. Browser Anda mungkin memblokir akses clipboard. Anda bisa mencoba lagi.");
            }).finally(() => {
                btn.innerHTML = originalText;
                lucide.createIcons();
            });
        })
        .catch(err => {
            console.error('Terjadi kesalahan:', err);
            alert("Gagal memproses: " + err.message);
            btn.innerHTML = originalText;
            lucide.createIcons();
        });
    });

    // Auto refresh every 30 seconds ONLY when on Dashboard menu
    setTimeout(function() {
        let dashboardSection = document.getElementById('menu-dashboard');
        if(dashboardSection && dashboardSection.classList.contains('active') && !window.isModalOpen) {
            window.location.reload();
        }
    }, 30000);
</script>
</body>
</html>
