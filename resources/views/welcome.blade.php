<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CBT Online - Selamat Datang</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Outfit:wght@500;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('style.css') }}">
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        .welcome-card {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 24px;
            padding: 40px;
            max-width: 500px;
            margin: 100px auto;
            text-align: center;
        }
        .form-group {
            margin-bottom: 20px;
            text-align: left;
        }
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #e2e8f0;
        }
        .form-control {
            width: 100%;
            padding: 14px;
            border-radius: 12px;
            background: rgba(0, 0, 0, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: #fff;
            font-family: 'Inter', sans-serif;
            transition: all 0.3s;
        }
        .form-control:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.3);
        }
        .btn-start {
            width: 100%;
            padding: 16px;
            font-size: 1.1rem;
            margin-top: 10px;
        }
    </style>
</head>
<body>

<div class="app-container">
    <div class="welcome-card">
        <i data-lucide="graduation-cap" style="width: 64px; height: 64px; color: #3b82f6; margin-bottom: 20px;"></i>
        <h2 style="margin-bottom: 10px; font-family: 'Outfit', sans-serif;">Selamat Datang di CBT Pro</h2>
        <p style="color: #94a3b8; margin-bottom: 30px;">Silakan masukkan identitas Anda sebelum memulai ujian.</p>
        
        <form method="POST" action="{{ route('exam.start') }}">
            @csrf
            <div class="form-group">
                <label for="name">Nama Lengkap</label>
                <input type="text" id="name" name="name" class="form-control" required placeholder="Masukkan nama lengkap Anda">
            </div>
            <div class="form-group">
                <label for="nim">NIM / NIS</label>
                <input type="text" id="nim" name="nim" class="form-control" required placeholder="Masukkan NIM / NIS Anda">
            </div>
            <button type="submit" class="btn btn-primary btn-start">
                Mulai Ujian <i data-lucide="arrow-right"></i>
            </button>
        </form>
    </div>
</div>

<script>
    lucide.createIcons();
</script>
</body>
</html>
