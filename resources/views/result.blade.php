<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CBT Online - Hasil Ujian</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Outfit:wght@500;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('style.css') }}">
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body>

<div class="app-container">
    <header class="glass-header">
        <div class="header-content">
            <div class="logo">
                <i data-lucide="graduation-cap"></i>
                <h1>CBT Pro<span>2026</span></h1>
            </div>
        </div>
    </header>

    <main class="main-content">
        <div class="result-dashboard animate-in">
            <div class="score-card">
                <h2>Skor Akhir</h2>
                <div class="score-circle {{ $final_score >= 70 ? 'passed' : 'failed' }}">
                    <svg viewBox="0 0 36 36" class="circular-chart">
                        <path class="circle-bg" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />
                        <path class="circle" stroke-dasharray="{{ $final_score }}, 100" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />
                        <text x="18" y="20.35" class="percentage">{{ $final_score }}</text>
                    </svg>
                </div>
                <p class="status-text">{{ $final_score >= 70 ? 'Lulus / Memuaskan' : 'Perlu Belajar Lagi' }}</p>
            </div>
            
            <div class="stats-grid">
                <div class="stat-card correct">
                    <i data-lucide="check-circle-2"></i>
                    <div class="stat-info">
                        <span class="stat-value">{{ $correct }}</span>
                        <span class="stat-label">Benar</span>
                    </div>
                </div>
                <div class="stat-card wrong">
                    <i data-lucide="x-circle"></i>
                    <div class="stat-info">
                        <span class="stat-value">{{ $wrong }}</span>
                        <span class="stat-label">Salah</span>
                    </div>
                </div>
                <div class="stat-card unanswered">
                    <i data-lucide="help-circle"></i>
                    <div class="stat-info">
                        <span class="stat-value">{{ $unanswered }}</span>
                        <span class="stat-label">Kosong</span>
                    </div>
                </div>
            </div>

            <div class="action-buttons">
                <a href="{{ route('exam.index') }}" class="btn btn-primary"><i data-lucide="rotate-ccw"></i> Ulangi Ujian</a>
            </div>
        </div>

        <div class="review-section">
            <h3 class="section-title">Review Jawaban</h3>
            <div class="questions-list">
                @foreach ($questions as $index => $q)
                    @php 
                    $res = $results[$q->id];
                    $status_class = $res['is_correct'] ? 'correct-answer' : ($res['user_answer'] === null ? 'unanswered-answer' : 'wrong-answer');
                    @endphp
                    <div class="question-card review-card {{ $status_class }}">
                        <div class="question-header">
                            <span class="q-number">Soal {{ $index + 1 }}</span>
                            <span class="badge badge-{{ strtolower($q->tingkat_kesulitan) }}">{{ $q->tingkat_kesulitan }}</span>
                            <span class="badge badge-mapel">{{ $q->mapel }}</span>
                        </div>
                        <div class="question-text">
                            {!! nl2br(e($q->soal)) !!}
                        </div>
                        <div class="review-details">
                            <div class="review-item user-choice">
                                <span class="label">Jawaban Anda:</span>
                                <span class="value {{ $res['is_correct'] ? 'text-success' : 'text-danger' }}">
                                    @if ($res['user_answer'])
                                        @php $opt = 'pilihan_' . strtolower($res['user_answer']); @endphp
                                        {{ $res['user_answer'] }}. {{ $q->$opt }}
                                    @else
                                        Tidak dijawab
                                    @endif
                                </span>
                            </div>
                            @if (!$res['is_correct'])
                            <div class="review-item correct-choice">
                                <span class="label">Jawaban Benar:</span>
                                <span class="value text-success">
                                    @php $opt = 'pilihan_' . strtolower($res['correct_answer']); @endphp
                                    {{ $res['correct_answer'] }}. {{ $q->$opt }}
                                </span>
                            </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </main>
</div>

<script>
    lucide.createIcons();
</script>
</body>
</html>
