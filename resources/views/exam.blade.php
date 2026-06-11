<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CBT Online - Ujian</title>
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
            @if ($questions->count() > 0)
            <div class="timer-container">
                <i data-lucide="timer" class="timer-icon"></i>
                <span id="timer">120:00</span>
            </div>
            @endif
        </div>
    </header>

    <main class="main-content">
        @if ($questions->isEmpty())
            <div class="empty-state">
                <i data-lucide="file-warning"></i>
                <h2>Data Soal Tidak Ditemukan</h2>
                <p>Silakan jalankan seeder atau periksa database.</p>
            </div>
        @else
            <div class="exam-intro">
                <h2>Ujian CBT Online</h2>
                <p>Ujian ini terdiri dari {{ $questions->count() }} soal pilihan ganda. Kerjakan dengan jujur dan teliti.</p>
            </div>
            
            <form id="cbtForm" method="POST" action="{{ route('exam.submit') }}">
                @csrf
                <div class="questions-list">
                    @foreach ($questions as $index => $q)
                        <div class="question-card" id="q_card_{{ $q->id }}">
                            <div class="question-header">
                                <span class="q-number">{{ $index + 1 }}</span>
                                <span class="badge badge-{{ strtolower($q->tingkat_kesulitan) }}">{{ $q->tingkat_kesulitan }}</span>
                                <span class="badge badge-mapel">{{ $q->mapel }}</span>
                            </div>
                            <div class="question-text">
                                {!! nl2br(e($q->soal)) !!}
                            </div>
                            <div class="options-group">
                                @foreach (['A', 'B', 'C', 'D'] as $opt)
                                    @php $col = 'pilihan_' . strtolower($opt); @endphp
                                    @if (empty($q->$col)) @continue @endif
                                    <label class="option-label">
                                        <input type="radio" name="q_{{ $q->id }}" value="{{ $opt }}">
                                        <span class="option-custom"></span>
                                        <span class="option-letter">{{ $opt }}</span>
                                        <span class="option-text">{{ $q->$col }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <div class="form-actions glass-footer">
                    <button type="button" class="btn btn-outline" id="btnCheck">Cek Jawaban Kosong</button>
                    <button type="submit" class="btn btn-primary" id="btnSubmit">
                        Kumpulkan Jawaban <i data-lucide="send"></i>
                    </button>
                </div>
            </form>
        @endif
    </main>
</div>

<script>
    lucide.createIcons();

    @if ($questions->count() > 0)
    let timeLeft = 120 * 60; // 120 minutes
    const timerDisplay = document.getElementById('timer');
    const form = document.getElementById('cbtForm');

    const countdown = setInterval(() => {
        timeLeft--;
        const minutes = Math.floor(timeLeft / 60);
        const seconds = timeLeft % 60;
        
        timerDisplay.textContent = `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
        
        if (timeLeft <= 300) {
            timerDisplay.parentElement.classList.add('danger');
        }

        if (timeLeft <= 0) {
            clearInterval(countdown);
            alert("Waktu habis! Jawaban akan dikumpulkan otomatis.");
            form.submit();
        }
    }, 1000);

    document.getElementById('btnCheck').addEventListener('click', () => {
        let emptyCount = 0;
        let firstEmpty = null;
        
        @foreach ($questions as $q)
            const q{{ $q->id }} = document.querySelector('input[name="q_{{ $q->id }}"]:checked');
            if (!q{{ $q->id }}) {
                emptyCount++;
                document.getElementById('q_card_{{ $q->id }}').classList.add('highlight-empty');
                if (!firstEmpty) firstEmpty = document.getElementById('q_card_{{ $q->id }}');
            } else {
                document.getElementById('q_card_{{ $q->id }}').classList.remove('highlight-empty');
            }
        @endforeach

        if (emptyCount > 0) {
            alert(`Terdapat ${emptyCount} soal yang belum dijawab.`);
            firstEmpty.scrollIntoView({ behavior: 'smooth', block: 'center' });
        } else {
            alert("Semua soal telah dijawab!");
        }
    });

    document.querySelectorAll('input[type="radio"]').forEach(radio => {
        radio.addEventListener('change', function() {
            const group = this.closest('.options-group');
            group.querySelectorAll('.option-label').forEach(lbl => lbl.classList.remove('selected'));
            if(this.checked) {
                this.closest('.option-label').classList.add('selected');
                this.closest('.question-card').classList.remove('highlight-empty');
            }
        });
    });

    form.addEventListener('submit', (e) => {
        if (timeLeft > 0 && !confirm("Apakah Anda yakin ingin mengumpulkan jawaban sekarang?")) {
            e.preventDefault();
        }
    });
    @endif
</script>
</body>
</html>
