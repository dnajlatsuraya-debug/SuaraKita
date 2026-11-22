<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Laporan Aspirasi - SuaraKita</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Lora:wght@400;500;600;700&display=swap" rel="stylesheet">

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
            padding: 35px 20px;
        }

        .container {
            width: 100%;
            max-width: 1100px;
            margin: auto;
            background: white;
            padding: 35px;
            border-radius: 18px;
            border: 1px solid #e7e3d9;
        }

        h1, h2, h3 {
            font-family: 'Lora', serif;
        }

        .back-button {
            display: inline-block;
            text-decoration: none;
            color: #315b43;
            background: #e4ede2;
            padding: 10px 15px;
            border-radius: 9px;
            font-size: 12px;
            font-weight: 600;
            margin-bottom: 25px;
        }

        .page-title {
            text-align: center;
            color: #315b43;
            font-size: 30px;
            margin-bottom: 8px;
        }

        .subtitle {
            text-align: center;
            color: #737b75;
            font-size: 13px;
            margin-bottom: 30px;
        }

        .filter-box {
            background: #f8f6ef;
            border: 1px solid #e7e3d9;
            padding: 22px;
            border-radius: 14px;
            margin-bottom: 30px;
        }

        .filter-title {
            font-size: 19px;
            margin-bottom: 18px;
            color: #315b43;
        }

        .filter-form {
            display: flex;
            align-items: end;
            gap: 13px;
            flex-wrap: wrap;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 7px;
            flex: 1;
            min-width: 180px;
        }

        label {
            font-size: 12px;
            font-weight: 600;
            color: #35483b;
        }

        input[type="date"] {
            width: 100%;
            padding: 12px;
            border: 1px solid #d8ddd8;
            border-radius: 9px;
            background: white;
            font-family: inherit;
            color: #34473b;
        }

        button, .action-button {
            border: none;
            padding: 12px 17px;
            border-radius: 9px;
            font-family: inherit;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            text-align: center;
        }

        .filter-button {
            background: #315b43;
            color: white;
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

        .period-info {
            background: #f8f6ef;
            padding: 17px;
            border-radius: 12px;
            font-size: 13px;
            line-height: 1.9;
            margin-bottom: 25px;
        }

        .section-title {
            font-size: 21px;
            margin-bottom: 17px;
            color: #315b43;
        }

        .summary-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 13px;
            margin-bottom: 30px;
        }

        .summary-card {
            background: #e4ede2;
            border: 1px solid #d7e3d5;
            border-radius: 14px;
            padding: 20px;
        }

        .summary-card p {
            color: #54735e;
            font-size: 12px;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .summary-card h2 {
            color: #315b43;
            font-size: 32px;
        }

        .action-area {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            margin-bottom: 30px;
        }

        .table-wrapper {
            width: 100%;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
            margin-top: 15px;
        }

        th {
            background: #315b43;
            color: white;
            padding: 13px 10px;
            text-align: left;
            white-space: nowrap;
        }

        td {
            border: 1px solid #e7e3d9;
            padding: 12px 10px;
            vertical-align: top;
            line-height: 1.7;
        }

        tbody tr:nth-child(even) {
            background: #fafbf8;
        }

        .empty {
            text-align: center;
            color: #737b75;
            padding: 25px;
        }

        .footer {
            border-top: 1px solid #e7e3d9;
            margin-top: 35px;
            padding-top: 20px;
            text-align: center;
            color: #737b75;
            font-size: 11px;
            line-height: 1.8;
        }

        .error-message {
            background: #fff0ed;
            color: #a34f40;
            padding: 12px;
            border-radius: 9px;
            font-size: 12px;
            margin-bottom: 15px;
        }

        @media (max-width: 750px) {
            body {
                padding: 12px;
            }

            .container {
                padding: 20px;
            }

            .summary-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .filter-form {
                flex-direction: column;
                align-items: stretch;
            }

            .form-group {
                width: 100%;
            }

            .filter-button {
                width: 100%;
            }

            .page-title {
                font-size: 24px;
            }
        }

        @media print {
            @page {
                size: landscape;
                margin: 15mm;
            }

            body {
                background: white;
                padding: 0;
            }

            .container {
                max-width: none;
                border: none;
                padding: 0;
            }

            .no-print {
                display: none !important;
            }

            .summary-card {
                print-color-adjust: exact;
                -webkit-print-color-adjust: exact;
            }

            th {
                print-color-adjust: exact;
                -webkit-print-color-adjust: exact;
            }

            tr {
                page-break-inside: avoid;
            }
        }
    </style>
</head>

<body>

<div class="container">

    <!-- KEMBALI KE ADMIN -->
    <div class="no-print">
        <a href="{{ route('aspirations.admin') }}" class="back-button">
            ← Kembali ke Halaman Admin
        </a>
    </div>

    <!-- JUDUL -->
    <h1 class="page-title">Laporan Aspirasi Siswa</h1>

    <p class="subtitle">
        SuaraKita - Sistem Informasi Aspirasi Siswa
    </p>

    <!-- FILTER TANGGAL -->
    <div class="filter-box no-print">

        <h2 class="filter-title">Pilih Periode Laporan</h2>

        @if($errors->any())
            <div class="error-message">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form action="{{ route('aspirations.report') }}"
              method="GET"
              class="filter-form">

            <div class="form-group">
                <label for="start_date">Dari Tanggal</label>

                <input
                    type="date"
                    id="start_date"
                    name="start_date"
                    value="{{ $startDate }}"
                    max="{{ now()->toDateString() }}"
                    required
                >
            </div>

            <div class="form-group">
                <label for="end_date">Sampai Tanggal</label>

                <input
                    type="date"
                    id="end_date"
                    name="end_date"
                    value="{{ $endDate }}"
                    min="{{ $startDate }}"
                    max="{{ now()->toDateString() }}"
                    required
                >
            </div>

            <button type="submit" class="filter-button">
                Tampilkan Laporan
            </button>

        </form>

    </div>

    <!-- PERIODE LAPORAN -->
    <div class="period-info">

        <p>
            <strong>Periode Laporan:</strong>
            {{ \Carbon\Carbon::parse($startDate)->translatedFormat('d F Y') }}
            sampai
            {{ \Carbon\Carbon::parse($endDate)->translatedFormat('d F Y') }}
        </p>

        <p>
            <strong>Tanggal Dicetak:</strong>
            {{ now()->translatedFormat('d F Y') }}
        </p>

    </div>

    <!-- RINGKASAN -->
    <h2 class="section-title">Ringkasan Aspirasi</h2>

    <div class="summary-grid">

        <div class="summary-card">
            <p>Total Aspirasi</p>
            <h2>{{ $totalReport }}</h2>
        </div>

        <div class="summary-card">
            <p>Menunggu</p>
            <h2>{{ $totalMenunggu }}</h2>
        </div>

        <div class="summary-card">
            <p>Diproses</p>
            <h2>{{ $totalDiproses }}</h2>
        </div>

        <div class="summary-card">
            <p>Selesai</p>
            <h2>{{ $totalSelesai }}</h2>
        </div>

    </div>

    <!-- TOMBOL EXPORT -->
    <div class="action-area no-print">

        <a
            href="{{ route('aspirations.report', [
                'start_date' => $startDate,
                'end_date' => $endDate,
                'print' => 1
            ]) }}"
            target="_blank"
            rel="noopener noreferrer"
            class="action-button pdf-button"
        >
            Cetak / Simpan PDF
        </a>

        <a
            href="{{ route('aspirations.report.excel', [
                'start_date' => $startDate,
                'end_date' => $endDate
            ]) }}"
            class="action-button excel-button"
        >
            Export Excel
        </a>

    </div>

    <!-- DAFTAR ASPIRASI -->
    <h2 class="section-title">Daftar Aspirasi Siswa</h2>

    <div class="table-wrapper">

        <table>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Tanggal</th>
                    <th>Judul Aspirasi</th>
                    <th>Kategori</th>
                    <th>Deskripsi</th>
                    <th>Lokasi</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody>

                @forelse($aspirations as $index => $aspiration)

                    <tr>
                        <td>{{ $index + 1 }}</td>

                        <td>
                            {{ $aspiration->created_at->format('d-m-Y') }}
                        </td>

                        <td>{{ $aspiration->title }}</td>

                        <td>{{ $aspiration->category }}</td>

                        <td>{{ $aspiration->description }}</td>

                        <td>{{ $aspiration->location ?? '-' }}</td>

                        <td>{{ $aspiration->status }}</td>
                    </tr>

                @empty

                    <tr>
                        <td colspan="7" class="empty">
                            Tidak ada aspirasi pada rentang tanggal tersebut.
                        </td>
                    </tr>

                @endforelse

            </tbody>
        </table>

    </div>

    <!-- FOOTER -->
    <div class="footer">
        <p><strong>SuaraKita.</strong></p>
        <p>Sistem Informasi Aspirasi Siswa</p>
        <p>Laporan dibuat secara otomatis oleh sistem.</p>
    </div>

</div>

<script>
    const startInput = document.getElementById('start_date');
    const endInput = document.getElementById('end_date');

    if (startInput && endInput) {
        startInput.addEventListener('change', function () {
            endInput.min = this.value;

            if (endInput.value && endInput.value < this.value) {
                endInput.value = this.value;
            }
        });
    }

    window.addEventListener('load', function () {
        const params = new URLSearchParams(window.location.search);

        if (params.get('print') === '1') {
            setTimeout(function () {
                window.print();
            }, 700);
        }
    });
</script>

</body>
</html>