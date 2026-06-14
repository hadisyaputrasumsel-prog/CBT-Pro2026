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
    <script id="MathJax-script" async src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>
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
        .admin-tabs {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
            overflow-x: auto;
            padding-bottom: 5px;
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
            <div style="display: flex; gap: 10px;">
                <form action="{{ route('admin.settings.toggle') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn {{ ($settings['show_kunci_jawaban'] ?? true) ? 'btn-outline' : 'btn-primary' }}" style="padding: 10px 20px; border-color: #ef4444; color: {{ ($settings['show_kunci_jawaban'] ?? true) ? '#ef4444' : '#fff' }}; background: {{ ($settings['show_kunci_jawaban'] ?? true) ? 'transparent' : '#ef4444' }};">
                        <i data-lucide="{{ ($settings['show_kunci_jawaban'] ?? true) ? 'eye-off' : 'eye' }}"></i> 
                        {{ ($settings['show_kunci_jawaban'] ?? true) ? 'Sembunyikan Kunci' : 'Tampilkan Kunci' }}
                    </button>
                </form>
                <button onclick="window.location.reload()" class="btn btn-primary" style="padding: 10px 20px;">
                    <i data-lucide="refresh-cw"></i> Segarkan Data
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
                            <td style="color: #94a3b8;">{{ $p->created_at->format('d M Y, H:i') }}</td>
                            <td>
                                <div style="font-weight: 500;">{{ $p->name }}</div>
                                <div style="font-size: 0.8rem; color: #94a3b8;">{{ $p->nim ?? '-' }}</div>
                            </td>
                            <td>
                                <span class="badge-status status-{{ $p->status }}">
                                    {{ ucfirst($p->status) }}
                                </span>
                            </td>
                            <td>
                                @if($p->status == 'selesai' || ($p->tab_results && count($p->tab_results) > 0))
                                    <span style="font-weight: 600; font-family: 'Outfit', sans-serif;">{{ $p->score }}</span>
                                @else
                                    <span style="color: #64748b;">-</span>
                                @endif
                            </td>
                            <td>
                                @if($p->tab_results && is_array($p->tab_results))
                                    <div style="display: flex; flex-direction: column; gap: 4px;">
                                        @foreach($p->tab_results as $mapel => $res)
                                            <div style="font-size: 0.85rem; background: rgba(255,255,255,0.05); padding: 4px 8px; border-radius: 4px; display: flex; justify-content: space-between;">
                                                <span style="font-weight: 500;">{{ $mapel }}</span>
                                                <span>
                                                    <span style="color: #3b82f6; font-weight: bold; margin-right: 8px;">{{ $res['score'] }}</span>
                                                    <span style="color: #94a3b8;">
                                                        <i data-lucide="clock" style="width: 12px; height: 12px; display: inline-block;"></i>
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
                            <td colspan="5" style="text-align: center; padding: 40px; color: #94a3b8;">
                                <i data-lucide="inbox" style="width: 48px; height: 48px; margin-bottom: 10px; opacity: 0.5;"></i>
                                <p>Belum ada peserta yang mendaftar ujian.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        </div>

        <div class="admin-header" style="margin-top: 40px; margin-bottom: 20px;">
            <div>
                <h2 style="font-family: 'Outfit', sans-serif; margin-bottom: 5px;">AI Question Generator (Manual)</h2>
                <p style="color: #94a3b8; margin: 0;">Tambah soal otomatis tanpa bentrok dengan soal yang sudah ada.</p>
            </div>
        </div>
        
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 40px;">
            <!-- Langkah 1 -->
            <div class="stat-card" style="flex-direction: column; align-items: flex-start; padding: 25px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);">
                <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 15px;">
                    <div style="background: rgba(59, 130, 246, 0.1); color: #3b82f6; width: 32px; height: 32px; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-weight: bold;">1</div>
                    <h3 style="margin: 0; font-size: 1.1rem; color:#1e293b; font-family: 'Outfit', sans-serif;">Generate Prompt</h3>
                </div>
                <p style="color:#64748b; font-size:0.9rem; margin-bottom: 20px; line-height: 1.5;">Pilih mata pelajaran dan jumlah soal. Sistem akan membuat instruksi (prompt) yang menyertakan soal lama agar AI tidak membuat soal yang redundan.</p>
                
                <div style="display: flex; gap: 15px; width: 100%; margin-bottom: 15px;">
                    <div style="flex: 2;">
                        <label style="display: block; font-size: 0.8rem; color: #64748b; margin-bottom: 5px; font-weight: 500;">Mata Pelajaran</label>
                        <select id="geminiMapel" style="width: 100%; background: #f8fafc; color: #0f172a; border: 1px solid #cbd5e1; border-radius: 6px; padding: 10px; font-family: 'Inter', sans-serif; outline: none;">
                            <option value="TPA">TPA</option>
                            <option value="Matematika">Matematika</option>
                            <option value="IPA">IPA</option>
                            <option value="Bahasa Indonesia">Bahasa Indonesia</option>
                            <option value="Bahasa Inggris">Bahasa Inggris</option>
                        </select>
                    </div>
                    <div style="flex: 1;">
                        <label style="display: block; font-size: 0.8rem; color: #64748b; margin-bottom: 5px; font-weight: 500;">Jumlah</label>
                        <input type="number" id="geminiJumlah" value="10" min="1" style="width: 100%; background: #f8fafc; color: #0f172a; border: 1px solid #cbd5e1; border-radius: 6px; padding: 10px; font-family: 'Inter', sans-serif; outline: none;" placeholder="Jml">
                    </div>
                </div>
                <button type="button" id="btnSalinPrompt" class="btn btn-primary" style="width: 100%; display: flex; justify-content: center; align-items: center; gap: 8px;">
                    <i data-lucide="copy" style="width: 18px; height: 18px;"></i> Salin Prompt & Buka Gemini
                </button>
            </div>

            <!-- Langkah 2 -->
            <div class="stat-card" style="flex-direction: column; align-items: flex-start; padding: 25px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);">
                <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 15px;">
                    <div style="background: rgba(34, 197, 94, 0.1); color: #22c55e; width: 32px; height: 32px; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-weight: bold;">2</div>
                    <h3 style="margin: 0; font-size: 1.1rem; color:#1e293b; font-family: 'Outfit', sans-serif;">Import JSON</h3>
                </div>
                <p style="color:#64748b; font-size:0.9rem; margin-bottom: 20px; line-height: 1.5;">Paste kode JSON balasan dari Gemini ke kotak di bawah ini. Sistem akan otomatis memvalidasi dan memindahkannya ke bank soal.</p>
                <form action="{{ route('admin.import.gemini') }}" method="POST" style="width: 100%;">
                    @csrf
                    <label style="display: block; font-size: 0.8rem; color: #64748b; margin-bottom: 5px; font-weight: 500;">Format JSON Array Mentah</label>
                    <textarea name="json_data" rows="3" placeholder="Paste JSON array di sini..." style="width: 100%; background: #f8fafc; border: 1px solid #cbd5e1; border-radius: 6px; color: #0f172a; padding: 10px; margin-bottom: 15px; font-family: monospace; outline: none; resize: vertical;" required></textarea>
                    <button type="submit" class="btn btn-outline" style="width: 100%; border-color: #22c55e; color: #22c55e; display: flex; justify-content: center; align-items: center; gap: 8px;">
                        <i data-lucide="download-cloud" style="width: 18px; height: 18px;"></i> Import Soal ke Database
                    </button>
                </form>
            </div>
        </div>

        </div>

        <div class="admin-header" style="margin-top: 40px; margin-bottom: 20px;">
            <div>
                <h2 style="font-family: 'Outfit', sans-serif; margin-bottom: 5px;">Daftar Soal Tersimpan</h2>
                <p style="color: #94a3b8; margin: 0;">Total {{ $questions->count() }} soal di dalam bank soal saat ini.</p>
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
                <div class="table-container" style="max-height: 600px; overflow-y: auto; margin-bottom: 40px;">
                    <table>
                        <thead style="position: sticky; top: 0; z-index: 10; background: rgba(15, 23, 42, 0.95); backdrop-filter: blur(10px);">
                            <tr>
                                <th>Kategori</th>
                                <th>Soal</th>
                                <th>Pilihan</th>
                                <th>Kunci</th>
                                <th>Tingkat</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($questions as $q)
                                <tr>
                                    <td style="vertical-align: top; width: 100px;">
                                        <div style="font-weight: 500; margin-bottom: 6px; color: #f8fafc;">{{ $q->mapel }}</div>
                                        <span class="badge-status status-mengerjakan" style="font-size: 0.7rem; padding: 4px 8px;">{{ $q->kategori }}</span>
                                    </td>
                                    <td style="vertical-align: top;">
                                        <div style="max-height: 150px; max-width: 450px; overflow-y: auto; font-size: 0.9rem; color: #e2e8f0; line-height: 1.6; padding-right: 10px;">
                                            {!! nl2br(e($q->soal)) !!}
                                        </div>
                                    </td>
                                    <td style="vertical-align: top;">
                                        <ul style="list-style-type: none; padding: 0; margin: 0; font-size: 0.85rem; color: #94a3b8; display: flex; flex-direction: column; gap: 4px;">
                                            <li><strong style="color: #cbd5e1;">A:</strong> {{ Str::limit($q->pilihan_a, 50) }}</li>
                                            <li><strong style="color: #cbd5e1;">B:</strong> {{ Str::limit($q->pilihan_b, 50) }}</li>
                                            <li><strong style="color: #cbd5e1;">C:</strong> {{ Str::limit($q->pilihan_c, 50) }}</li>
                                            <li><strong style="color: #cbd5e1;">D:</strong> {{ Str::limit($q->pilihan_d, 50) }}</li>
                                        </ul>
                                    </td>
                                    <td style="vertical-align: top; width: 80px;">
                                        <div style="display: flex; align-items: center; justify-content: center; width: 32px; height: 32px; background: rgba(34, 197, 94, 0.1); border: 1px solid rgba(34, 197, 94, 0.3); border-radius: 8px; color: #22c55e; font-weight: bold; font-size: 1.1rem;">
                                            {{ $q->jawaban }}
                                        </div>
                                    </td>
                                    <td style="vertical-align: top; width: 100px;">
                                        <span class="badge-status status-selesai">{{ $q->tingkat_kesulitan }}</span>
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
                    <div class="table-container" style="max-height: 600px; overflow-y: auto; margin-bottom: 40px;">
                        <table>
                            <thead style="position: sticky; top: 0; z-index: 10; background: rgba(15, 23, 42, 0.95); backdrop-filter: blur(10px);">
                                <tr>
                                    <th>Kategori</th>
                                    <th>Soal</th>
                                    <th>Pilihan</th>
                                    <th>Kunci</th>
                                    <th>Tingkat</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($qs as $q)
                                    <tr>
                                        <td style="vertical-align: top; width: 100px;">
                                            <span class="badge-status status-mengerjakan" style="font-size: 0.7rem; padding: 4px 8px;">{{ $q->kategori }}</span>
                                        </td>
                                        <td style="vertical-align: top;">
                                            <div style="max-height: 150px; max-width: 450px; overflow-y: auto; font-size: 0.9rem; color: #e2e8f0; line-height: 1.6; padding-right: 10px;">
                                                {!! nl2br(e($q->soal)) !!}
                                            </div>
                                        </td>
                                        <td style="vertical-align: top;">
                                            <ul style="list-style-type: none; padding: 0; margin: 0; font-size: 0.85rem; color: #94a3b8; display: flex; flex-direction: column; gap: 4px;">
                                                <li><strong style="color: #cbd5e1;">A:</strong> {{ Str::limit($q->pilihan_a, 50) }}</li>
                                                <li><strong style="color: #cbd5e1;">B:</strong> {{ Str::limit($q->pilihan_b, 50) }}</li>
                                                <li><strong style="color: #cbd5e1;">C:</strong> {{ Str::limit($q->pilihan_c, 50) }}</li>
                                                <li><strong style="color: #cbd5e1;">D:</strong> {{ Str::limit($q->pilihan_d, 50) }}</li>
                                            </ul>
                                        </td>
                                        <td style="vertical-align: top; width: 80px;">
                                            <div style="display: flex; align-items: center; justify-content: center; width: 32px; height: 32px; background: rgba(34, 197, 94, 0.1); border: 1px solid rgba(34, 197, 94, 0.3); border-radius: 8px; color: #22c55e; font-weight: bold; font-size: 1.1rem;">
                                                {{ $q->jawaban }}
                                            </div>
                                        </td>
                                        <td style="vertical-align: top; width: 100px;">
                                            <span class="badge-status status-selesai">{{ $q->tingkat_kesulitan }}</span>
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
                <div style="text-align: center; padding: 60px 40px; color: #94a3b8;">
                    <i data-lucide="database" style="width: 48px; height: 48px; margin-bottom: 15px; opacity: 0.5;"></i>
                    <p style="font-size: 1.1rem;">Bank soal masih kosong.</p>
                </div>
            </div>
        @endif

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
    
    document.getElementById('btnSalinPrompt').addEventListener('click', function() {
        let btn = this;
        let mapel = document.getElementById('geminiMapel').value;
        let jumlah = document.getElementById('geminiJumlah').value;
        let originalText = btn.innerHTML;
        
        btn.innerHTML = '<i data-lucide="loader" class="spin"></i> Memproses...';
        lucide.createIcons();
        
        let formData = new FormData();
        formData.append('mapel', mapel);
        formData.append('jumlah', jumlah);
        formData.append('_token', '{{ csrf_token() }}');

        fetch('{{ route('admin.gemini.prompt') }}', {
            method: 'POST',
            body: formData,
            headers: {
                'Accept': 'application/json'
            }
        })
        .then(res => res.json())
        .then(data => {
            navigator.clipboard.writeText(data.prompt).then(() => {
                alert("Prompt berhasil disalin ke clipboard! Silakan paste (Ctrl+V) di chat Gemini.");
                window.open('https://gemini.google.com/app', '_blank');
                btn.innerHTML = originalText;
                lucide.createIcons();
            }).catch(err => {
                console.error('Gagal menyalin', err);
                alert("Gagal menyalin prompt. Browser Anda mungkin memblokir akses clipboard. Anda bisa mencoba lagi.");
                btn.innerHTML = originalText;
                lucide.createIcons();
            });
        });
    });

    function openAdminTab(tabId, btn) {
        document.querySelectorAll('.admin-tab-pane').forEach(el => el.classList.remove('active'));
        document.querySelectorAll('.admin-tab-btn').forEach(el => el.classList.remove('active'));
        document.getElementById('tab-' + tabId).classList.add('active');
        btn.classList.add('active');
        localStorage.setItem('activeAdminTab', tabId);
    }
    
    // Restore active tab after reload
    document.addEventListener('DOMContentLoaded', () => {
        let activeTab = localStorage.getItem('activeAdminTab');
        if (activeTab) {
            let pane = document.getElementById('tab-' + activeTab);
            let btn = document.querySelector(`.admin-tab-btn[onclick*="${activeTab}"]`);
            if (pane && btn) {
                document.querySelectorAll('.admin-tab-pane').forEach(el => el.classList.remove('active'));
                document.querySelectorAll('.admin-tab-btn').forEach(el => el.classList.remove('active'));
                pane.classList.add('active');
                btn.classList.add('active');
            }
        }
    });

    // Auto refresh every 30 seconds
    setTimeout(function() {
        if(!document.activeElement || document.activeElement.tagName !== 'TEXTAREA') {
            window.location.reload();
        }
    }, 30000);
</script>
</body>
</html>
