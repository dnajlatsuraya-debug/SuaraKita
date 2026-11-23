<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Lora:wght@400;500;600;700&display=swap" rel="stylesheet">

    <title>Admin - SuaraKita</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background: #f8f6ef;
            color: #29382e;
        }

        nav {
            min-height: 76px;
            background: white;
            border-bottom: 1px solid #e8e4da;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 14px 7%;
            gap: 15px;
        }

        .logo {
            font-family: 'Lora', serif;
            font-size: 25px;
            font-weight: 600;
            color: #315b43;
        }

        .nav-right {
            display: flex;
            align-items: center;
            gap: 18px;
        }

        .home-link {
            text-decoration: none;
            color: #315b43;
            font-size: 13px;
            font-weight: 600;
        }

        .logout-button {
            border: none;
            background: #f5e5e5;
            color: #9a4545;
            padding: 10px 15px;
            border-radius: 10px;
            cursor: pointer;
            font-family: inherit;
            font-weight: 600;
        }

        .container {
            width: 88%;
            max-width: 1100px;
            margin: 55px auto 75px;
        }

        h1, h2, .report-number {
            font-family: 'Lora', serif;
        }

        h1 {
            font-size: 36px;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .subtitle {
            color: #737b75;
            font-size: 14px;
            line-height: 1.7;
            margin-bottom: 28px;
        }

        .message {
            padding: 14px 17px;
            border-radius: 12px;
            font-size: 13px;
            line-height: 1.7;
            margin-bottom: 18px;
        }

        .success {
            background: #e5efe5;
            color: #315b43;
        }

        .error {
            background: #fff0ed;
            color: #a34f40;
        }

        .report-title {
            font-family: 'Lora', serif;
            font-size: 23px;
            margin-bottom: 15px;
        }

        .report-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 16px;
            margin-bottom: 20px;
        }

        .report-card {
            background: #e4ede2;
            border: 1px solid #d7e3d5;
            border-radius: 18px;
            padding: 23px;
        }

        .report-card p {
            color: #54735e;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 9px;
        }

        .report-number {
            color: #315b43;
            font-size: 34px;
            font-weight: 700;
        }

        .report-note {
            color: #737b75;
            font-size: 11px;
            margin-top: 6px;
        }

        /* TOMBOL LAPORAN */
        .report-actions {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
            margin-bottom: 38px;
        }

        .report-button {
            display: inline-block;
            padding: 12px 18px;
            border-radius: 10px;
            text-decoration: none;
            font-family: inherit;
            font-size: 12px;
            font-weight: 600;
            transition: 0.2s;
        }

        .pdf-button {
            background: #315b43;
            color: white;
        }

        .excel-button {
            background: #e4ede2;
            color: #315b43;
            border: 1px solid #d7e3d5;
        }

        .report-button:hover {
            opacity: 0.85;
        }

        .list-title {
            font-family: 'Lora', serif;
            font-size: 24px;
            margin-bottom: 17px;
        }

        .card {
            background: white;
            border: 1px solid #e7e3d9;
            border-radius: 20px;
            padding: 25px;
            margin-bottom: 18px;
        }

        .card-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            flex-wrap: wrap;
            margin-bottom: 13px;
        }

        .category {
            display: inline-block;
            background: #e7f0e7;
            color: #54735e;
            padding: 6px 11px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 700;
        }

        .status-badge {
            display: inline-block;
            padding: 6px 11px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
        }

        .menunggu {
            background: #f5eddc;
            color: #876e40;
        }

        .diproses {
            background: #e2edf0;
            color: #4d6e78;
        }

        .selesai {
            background: #e2eee4;
            color: #477052;
        }

        h2 {
            font-size: 22px;
            font-weight: 600;
            margin-bottom: 10px;
            overflow-wrap: anywhere;
        }

        .description {
            color: #737b75;
            font-size: 13px;
            line-height: 1.8;
            margin-bottom: 15px;
            overflow-wrap: anywhere;
        }

        .extra-info {
            color: #68756b;
            font-size: 12px;
            line-height: 1.8;
            margin-bottom: 15px;
            overflow-wrap: anywhere;
        }

        .evidence {
            display: block;
            max-width: 100%;
            max-height: 280px;
            border-radius: 12px;
            margin-top: 8px;
            cursor: zoom-in;
            object-fit: contain;
        }

        .photo-link {
            display: inline-block;
            text-decoration: none;
        }

        .photo-hint {
            color: #54735e;
            font-size: 11px;
            margin-top: 5px;
        }

        .status-heading {
            display: block;
            color: #35483b;
            font-size: 12px;
            font-weight: 700;
            margin-bottom: 9px;
        }

        .status-area {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        select {
            min-width: 150px;
            padding: 11px 13px;
            border: 1px solid #d8ddd8;
            border-radius: 10px;
            background: white;
            color: #34473b;
            font-family: inherit;
            font-size: 13px;
            cursor: pointer;
        }

        button, .edit-button {
            border: none;
            padding: 11px 16px;
            border-radius: 10px;
            font-family: inherit;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }

        .status-button {
            background: #315b43;
            color: white;
        }

        .delete-button {
            background: #f5e5e5;
            color: #9a4545;
        }

        .actions {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-top: 20px;
            padding-top: 17px;
            border-top: 1px solid #edf0e9;
            flex-wrap: wrap;
        }

        .edit-button {
            background: #e8eee8;
            color: #315b43;
        }

        .empty {
            background: white;
            border: 1px solid #e7e3d9;
            padding: 40px 25px;
            border-radius: 18px;
            text-align: center;
            color: #737b75;
            font-size: 13px;
        }

        footer {
            background: #28392e;
            color: white;
            text-align: center;
            padding: 30px 20px;
        }

        .footer-logo {
            font-family: 'Lora', serif;
            font-size: 21px;
            margin-bottom: 7px;
        }

        footer p {
            color: #c6d0c8;
            font-size: 11px;
        }

        @media (max-width: 700px) {
            nav {
                padding: 14px 5%;
            }

            .container {
                width: 92%;
                margin-top: 35px;
            }

            h1 {
                font-size: 30px;
            }

            .card {
                padding: 20px;
            }

            .report-grid {
                grid-template-columns: 1fr;
            }

            .status-area {
                align-items: stretch;
                flex-direction: column;
            }

            .status-area select,
            .status-area button {
                width: 100%;
            }

            .report-actions {
                flex-direction: column;
            }

            .report-button {
                text-align: center;
            }
        }

        @media (max-width: 420px) {
            .logo {
                font-size: 21px;
            }

            .home-link {
                display: none;
            }
        }
    </style>
</head>

<body>

    <nav>
        <div class="logo">SuaraKita.</div>

        <div class="nav-right">
            <a href="{{ route('aspirations.index') }}" class="home-link">
                ← Halaman Utama
            </a>

            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit" class="logout-button">Logout</button>
            </form>
        </div>
    </nav>

    <main class="container">

        <h1>Kelola Aspirasi</h1>

        <p class="subtitle">
            Kelola aspirasi siswa dan perbarui status perkembangannya.
        </p>

        @if(session('success'))
            <div class="message success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="message error">{{ session('error') }}</div>
        @endif

        @if($errors->any())
            <div class="message error">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- LAPORAN ASPIRASI -->
        <h2 class="report-title">Laporan Aspirasi</h2>

        <div class="report-grid">
            <div class="report-card">
                <p>Aspirasi Hari Ini</p>
                <div class="report-number">{{ $dailyReport }}</div>
                <div class="report-note">Jumlah aspirasi yang masuk hari ini</div>
            </div>

            <div class="report-card">
                <p>Aspirasi Bulan Ini</p>
                <div class="report-number">{{ $monthlyReport }}</div>
                <div class="report-note">Jumlah aspirasi yang masuk bulan ini</div>
            </div>
        </div>

        <!-- TOMBOL EXPORT LAPORAN -->
        <div class="report-actions">

            <a
                href="{{ route('aspirations.report', [
                    'month' => now()->month,
                    'year' => now()->year,
                    'print' => 1
                ]) }}"
                target="_blank"
                rel="noopener noreferrer"
                class="report-button pdf-button"
            >
                Lihat / Cetak Laporan PDF →
            </a>

            <a
                href="{{ route('aspirations.report.excel', [
                    'month' => now()->month,
                    'year' => now()->year
                ]) }}"
                class="report-button excel-button"
            >
                Export Excel ↓
            </a>

        </div>

        <!-- DAFTAR ASPIRASI -->
        <h2 class="list-title">Daftar Aspirasi Siswa</h2>

        @forelse($aspirations as $aspiration)

            <article class="card">

                <div class="card-top">
                    <span class="category">
                        {{ $aspiration->category }}
                    </span>

                    @if($aspiration->status === 'Menunggu')
                        <span class="status-badge menunggu">Menunggu</span>
                    @elseif($aspiration->status === 'Diproses')
                        <span class="status-badge diproses">Diproses</span>
                    @else
                        <span class="status-badge selesai">Selesai</span>
                    @endif
                </div>

                <h2>{{ $aspiration->title }}</h2>

                <p class="description">
                    {{ $aspiration->description }}
                </p>

                <div class="extra-info">

                    @if($aspiration->location)
                        <p>
                            <strong>Lokasi:</strong>
                            {{ $aspiration->location }}
                        </p>
                    @endif

                    @if($aspiration->photo_url)
                        <p><strong>Foto bukti:</strong></p>

                        <a
                            href="{{ $aspiration->photo_url }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="photo-link"
                        >
                            <img
                                src="{{ $aspiration->photo_url }}"
                                alt="Foto bukti aspirasi"
                                class="evidence"
                                loading="lazy"
                            >
                            <p class="photo-hint">Klik foto untuk melihat ukuran lebih besar.</p>
                        </a>
                    @else
                        <p>Belum ada foto bukti.</p>
                    @endif

                </div>

                <!-- UBAH STATUS -->
                <form
                    action="{{ route('aspirations.updateStatus', $aspiration->id) }}"
                    method="POST"
                >
                    @csrf
                    @method('PATCH')

                    <label for="status-{{ $aspiration->id }}" class="status-heading">
                        Perbarui Status
                    </label>

                    <div class="status-area">
                        <select
                            id="status-{{ $aspiration->id }}"
                            name="status"
                            required
                        >
                            <option value="Menunggu"
                                {{ $aspiration->status === 'Menunggu' ? 'selected' : '' }}>
                                Menunggu
                            </option>

                            <option value="Diproses"
                                {{ $aspiration->status === 'Diproses' ? 'selected' : '' }}>
                                Diproses
                            </option>

                            <option value="Selesai"
                                {{ $aspiration->status === 'Selesai' ? 'selected' : '' }}>
                                Selesai
                            </option>
                        </select>

                        <button type="submit" class="status-button">
                            Simpan Status
                        </button>
                    </div>
                </form>

                <div class="actions">

                    <a
                        href="{{ route('aspirations.index') }}#kirim"
                        class="edit-button"
                    >
                        ← Ke Form Aspirasi
                    </a>

                    @if($aspiration->status === 'Selesai')
                        <form
                            action="{{ route('aspirations.destroy', $aspiration->id) }}"
                            method="POST"
                            onsubmit="return confirm('Yakin ingin menghapus aspirasi ini?')"
                        >
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="delete-button">
                                Hapus Aspirasi
                            </button>
                        </form>
                    @else
                        <span class="extra-info">
                            Aspirasi hanya bisa dihapus setelah berstatus Selesai.
                        </span>
                    @endif

                </div>

            </article>

        @empty

            <div class="empty">
                Belum ada aspirasi yang masuk.
            </div>

        @endforelse

    </main>

    <footer>
        <div class="footer-logo">SuaraKita.</div>
        <p>Kelola aspirasi untuk lingkungan sekolah yang lebih baik.</p>
    </footer>

</body>
</html>