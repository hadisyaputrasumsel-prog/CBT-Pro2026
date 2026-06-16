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
        .tabs-container {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            padding-bottom: 10px;
        }
        .tab-btn {
            background: transparent;
            border: none;
            color: #94a3b8;
            font-family: 'Outfit', sans-serif;
            font-size: 1.1rem;
            padding: 10px 20px;
            cursor: pointer;
            transition: all 0.3s;
            border-radius: 8px;
        }
        .tab-btn:hover {
            color: #e2e8f0;
            background: rgba(255, 255, 255, 0.05);
        }
        .tab-btn.active {
            background: rgba(59, 130, 246, 0.2);
            color: #3b82f6 !important;
        }
        .tab-content {
            display: none;
        }
        .tab-content.active {
            display: block;
            animation: fadeIn 0.3s ease;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(5px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
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
            <div style="display: flex; gap: 15px; align-items: center;">
                <div class="timer-container">
                    <i data-lucide="timer" class="timer-icon"></i>
                    <span id="timer">50:00</span>
                </div>
                <form method="POST" action="{{ route('exam.finish') }}" onsubmit="return confirm('Apakah Anda yakin ingin mengakhiri ujian secara keseluruhan? Semua tab yang belum dikumpulkan akan mendapat nilai 0.');">
                    @csrf
                    <button type="submit" class="btn btn-outline" style="border-color: #ef4444; color: #ef4444; padding: 8px 16px;">
                        <i data-lucide="power"></i> Akhiri Ujian
                    </button>
                </form>
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
                <p>Ujian ini terdiri dari 50 soal pilihan ganda setiap mata pelajaran. Kerjakan dengan jujur dan teliti.</p>
            </div>
            
            <form id="cbtForm" method="POST" action="{{ route('exam.submit') }}">
                @csrf
                <div class="tabs-container">
                    @php $levels = ['TPA', 'Matematika', 'IPA', 'Bahasa Indonesia', 'Bahasa Inggris']; @endphp
                    @foreach($levels as $index => $level)
                        <button type="button" class="tab-btn {{ $index === 0 ? 'active' : '' }}" data-target="tab-{{ str_replace(' ', '-', strtolower($level)) }}">
                            {{ $level }}
                        </button>
                    @endforeach
                </div>

                <div class="questions-list">
                    @foreach($levels as $index => $level)
                        @php $globalIndex = 1; @endphp
                        <div class="tab-content {{ $index === 0 ? 'active' : '' }}" id="tab-{{ str_replace(' ', '-', strtolower($level)) }}">
                            @foreach ($questions->where('mapel', $level) as $q)
                                <div class="question-card" id="q_card_{{ $q->id }}">
                                    <div class="question-header">
                                        <span class="q-number">{{ $globalIndex++ }}</span>
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
                            <div class="form-actions glass-footer" style="margin-top: 20px; border-radius: 8px;">
                                <button type="button" class="btn btn-outline btnCheck">Cek Jawaban Kosong</button>
                                <button type="button" class="btn btn-primary btnSubmitTab" data-mapel="{{ $level }}" data-target="tab-{{ str_replace(' ', '-', strtolower($level)) }}">
                                    Kumpulkan Jawaban {{ $level }} <i data-lucide="send"></i>
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </form>
        @endif
    </main>
</div>

<script>
    lucide.createIcons();

    @if ($questions->count() > 0)
    let menitPerSoal = {{ $menit_per_soal ?? 1 }};
    let tabTimes = {};
    document.querySelectorAll('.tab-btn').forEach(btn => {
        let target = btn.getAttribute('data-target');
        let questionCount = document.querySelectorAll(`#${target} .question-card`).length;
        tabTimes[target] = questionCount * menitPerSoal * 60; // minutes to seconds
    });
    let activeTab = document.querySelector('.tab-btn.active').getAttribute('data-target');

    const timerDisplay = document.getElementById('timer');
    const form = document.getElementById('cbtForm');

    // Initial update immediately
    const initialMinutes = Math.floor(tabTimes[activeTab] / 60);
    const initialSeconds = tabTimes[activeTab] % 60;
    timerDisplay.textContent = `${initialMinutes.toString().padStart(2, '0')}:${initialSeconds.toString().padStart(2, '0')}`;

    const countdown = setInterval(() => {
        if (!submittedTabs[activeTab] && tabTimes[activeTab] > 0) {
            tabTimes[activeTab]--;
        }
        
        const minutes = Math.floor(tabTimes[activeTab] / 60);
        const seconds = tabTimes[activeTab] % 60;
        
        timerDisplay.textContent = `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
        
        if (tabTimes[activeTab] <= 300) {
            timerDisplay.parentElement.classList.add('danger');
        } else {
            timerDisplay.parentElement.classList.remove('danger');
        }

        if (!submittedTabs[activeTab] && tabTimes[activeTab] <= 0) {
            submitTabAjax(activeTab, document.querySelector(`.tab-btn[data-target="${activeTab}"]`).innerText.trim(), true);
        }
    }, 1000);
    
    let submittedTabs = {};

    function submitTabAjax(tabId, mapelName, isTimeout = false) {
        if (submittedTabs[tabId]) return;
        submittedTabs[tabId] = true;
        
        let currentBtn = document.querySelector(`.tab-btn[data-target="${tabId}"]`);
        currentBtn.disabled = true;
        currentBtn.style.opacity = '0.5';
        currentBtn.style.cursor = 'not-allowed';
        currentBtn.innerHTML += ' <i data-lucide="check-circle" style="width:16px;height:16px;display:inline-block;"></i>';
        lucide.createIcons();
        
        let formData = new FormData(document.getElementById('cbtForm'));
        formData.append('mapel', mapelName);
        
        // Calculate time taken
        let questionCount = document.querySelectorAll(`#${tabId} .question-card`).length;
        let totalAllocatedSeconds = questionCount * menitPerSoal * 60;
        let timeTakenSeconds = totalAllocatedSeconds - tabTimes[tabId];
        if (timeTakenSeconds < 0) timeTakenSeconds = 0;
        
        formData.append('time_taken_seconds', timeTakenSeconds);
        
        let m = Math.floor(timeTakenSeconds / 60);
        let s = timeTakenSeconds % 60;
        let timeStr = `${m} menit ${s} detik`;
        
        let tabContent = document.getElementById(tabId);
        tabContent.innerHTML = '<div style="text-align:center; padding: 40px;"><i data-lucide="loader" class="spin"></i> Memproses...</div>';
        lucide.createIcons();

        fetch('{{ route('exam.submit_tab') }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            },
            body: formData
        })
        .then(res => res.json())
        .then(data => {
            let wrongQuestionsHtml = '';
            if (data.wrong_details && data.wrong_details.length > 0) {
                wrongQuestionsHtml = `
                    <div class="wrong-questions-section" style="margin-top: 30px; text-align: left;">
                        <h3 style="margin-bottom: 15px; color: #ef4444; display: flex; align-items: center; gap: 8px;">
                            <i data-lucide="x-circle"></i> Detail Evaluasi Jawaban
                        </h3>
                        <div class="wrong-list" style="display: flex; flex-direction: column; gap: 15px;">
                            ${data.wrong_details.map((wd, index) => `
                                <div class="wrong-item" style="background: rgba(255, 255, 255, 0.05); padding: 15px; border-radius: 8px; border-left: 4px solid #ef4444;">
                                    <div style="margin-bottom: 10px; font-weight: 500;">Soal ${index + 1}: <br><span style="font-weight: 400">${(wd.soal || '').replace(/\\n/g, '<br>')}</span></div>
                                    <div style="font-size: 0.95rem; color: #94a3b8;">
                                        <div style="margin-bottom: 5px;">Jawaban Anda: <span style="color: #ef4444; ${wd.jawaban_user !== '(Kosong / Tidak Menjawab)' ? 'text-decoration: line-through;' : ''}">${wd.jawaban_user}</span></div>
                                        <div style="margin-bottom: 5px;">Kunci Jawaban: <span style="color: #22c55e;">${wd.kunci}</span></div>
                                        ${wd.pembahasan ? `<div style="margin-top: 10px; padding: 12px; background: rgba(168, 85, 247, 0.08); border-left: 3px solid #a855f7; border-radius: 6px; color: #f8fafc;"><strong style="color:#c084fc; font-size: 0.85rem; display:block; margin-bottom: 5px;">PEMBAHASAN:</strong>${wd.pembahasan.replace(/\\n/g, '<br>')}</div>` : ''}
                                    </div>
                                </div>
                            `).join('')}
                        </div>
                    </div>
                `;
            }

            tabContent.innerHTML = `
                <div class="result-dashboard animate-in" style="margin-top: 0; padding: 20px;">
                    <div class="score-card">
                        <h2>Hasil ${data.mapel}</h2>
                        <div class="score-circle ${data.score >= 70 ? 'passed' : 'failed'}">
                            <h2 style="margin:0; font-size: 2rem;">${data.score}</h2>
                        </div>
                    </div>
                    <div class="stats-grid" style="margin-top: 20px;">
                        <div class="stat-card correct"><div class="stat-info"><span class="stat-value">${data.correct}</span><span class="stat-label">Benar</span></div></div>
                        <div class="stat-card wrong"><div class="stat-info"><span class="stat-value">${data.wrong}</span><span class="stat-label">Salah</span></div></div>
                        <div class="stat-card unanswered"><div class="stat-info"><span class="stat-value">${data.unanswered}</span><span class="stat-label">Kosong</span></div></div>
                        <div class="stat-card time-taken" style="grid-column: 1 / -1; background: rgba(59, 130, 246, 0.1); border-color: rgba(59, 130, 246, 0.2);">
                            <div class="stat-info">
                                <span class="stat-value" style="font-size: 1.25rem;">${timeStr}</span>
                                <span class="stat-label">Waktu Pengerjaan</span>
                            </div>
                        </div>
                    </div>
                    ${wrongQuestionsHtml}
                </div>
            `;
            
            if (isTimeout) {
                alert(`Waktu untuk ${mapelName} habis! Jawaban otomatis dikumpulkan dan dikunci.`);
            } else {
                alert(`Jawaban untuk ${mapelName} berhasil dikumpulkan!`);
            }
            
            // Render MathJax for the newly added result elements (soal, pembahasan)
            if (typeof MathJax !== 'undefined' && MathJax.typesetPromise) {
                MathJax.typesetPromise([tabContent]).catch((err) => console.error(err.message));
            }
        })
        .catch(err => {
            tabContent.innerHTML = '<div class="empty-state">Terjadi kesalahan saat menyimpan jawaban.</div>';
            console.error(err);
        });
    }

    document.querySelectorAll('.btnSubmitTab').forEach(btn => {
        btn.addEventListener('click', function() {
            let mapel = this.getAttribute('data-mapel');
            let target = this.getAttribute('data-target');
            if (confirm(`Apakah Anda yakin ingin mengumpulkan jawaban untuk ${mapel} sekarang? Bagian ini akan dikunci.`)) {
                submitTabAjax(target, mapel, false);
            }
        });
    });

    document.querySelectorAll('.btnCheck').forEach(btn => {
        btn.addEventListener('click', function() {
            let emptyCount = 0;
            let firstEmpty = null;
            
            const tabContent = this.closest('.tab-content');
            const questionCards = tabContent.querySelectorAll('.question-card');
            
            questionCards.forEach(card => {
                const checkedOption = card.querySelector('input[type="radio"]:checked');
                
                if (!checkedOption) {
                    emptyCount++;
                    card.classList.add('highlight-empty');
                    if (!firstEmpty) {
                        firstEmpty = card;
                    }
                } else {
                    card.classList.remove('highlight-empty');
                }
            });

            if (emptyCount > 0) {
                alert(`Terdapat ${emptyCount} soal yang belum dijawab di bagian ini.`);
                firstEmpty.scrollIntoView({ behavior: 'smooth', block: 'center' });
            } else {
                alert("Semua soal di bagian ini telah dijawab!");
            }
        });
    });

    // Tab Navigation Logic
    document.querySelectorAll('.tab-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            if (this.disabled) return;
            // Remove active class from all tabs and contents
            document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
            document.querySelectorAll('.tab-content').forEach(c => c.classList.remove('active'));
            
            // Add active class to clicked tab and its target content
            this.classList.add('active');
            let target = this.getAttribute('data-target');
            document.getElementById(target).classList.add('active');
            activeTab = target;
            
            // Update timer immediately
            const minutes = Math.floor(tabTimes[activeTab] / 60);
            const seconds = tabTimes[activeTab] % 60;
            timerDisplay.textContent = `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
            if (tabTimes[activeTab] <= 300) {
                timerDisplay.parentElement.classList.add('danger');
            } else {
                timerDisplay.parentElement.classList.remove('danger');
            }

            // Render MathJax if available
            if (typeof MathJax !== 'undefined' && MathJax.typesetPromise) {
                MathJax.typesetPromise([document.getElementById(target)]).catch((err) => console.error(err.message));
            }
        });
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
        e.preventDefault();
        alert("Semua jawaban ditangani per-tab. Anda bisa melihat hasilnya langsung di masing-masing tab.");
    });
    @endif
</script>
</body>
</html>
