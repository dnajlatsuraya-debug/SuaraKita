<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Lora:wght@400;500;600;700&display=swap" rel="stylesheet">

    <title>SuaraKita</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: #f8f6ef;
            color: #29382e;
            font-family: 'DM Sans', sans-serif;
        }

        /* NAVBAR */

        nav {
            height: 76px;
            background: #fff;
            border-bottom: 1px solid #e8e4da;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 8%;
        }

        .logo {
            color: #315b43;
            font-family: 'Lora', serif;
            font-size: 25px;
            font-weight: 600;
        }

        .admin-link {
            text-decoration: none;
            color: #315b43;
            font-size: 14px;
            font-weight: 600;
            border: 1px solid #dce4dc;
            padding: 10px 18px;
            border-radius: 30px;
        }

        .admin-link:hover {
            background: #eef3ed;
        }

        /* ALERT */

        .success {
            width: 84%;
            max-width: 1150px;
            margin: 25px auto 0;
            background: #e5efe5;
            color: #315b43;
            padding: 14px 18px;
            border-radius: 12px;
            font-size: 13px;
        }

        /* HERO */

        .hero {
            width: 84%;
            max-width: 1150px;
            margin: 65px auto 55px;
            display: grid;
            grid-template-columns: 1.05fr .95fr;
            align-items: center;
            gap: 70px;
        }

        .eyebrow {
            color: #62806b;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 1.4px;
            margin-bottom: 18px;
        }

        .hero h1 {
            font-family: 'Lora', serif;
            font-size: 58px;
            line-height: 1.12;
            font-weight: 500;
            letter-spacing: -1.5px;
            color: #26372c;
            margin-bottom: 22px;
        }

        .hero h1 span {
            color: #5f8669;
            font-style: italic;
        }

        .hero-text p {
            color: #727b75;
            font-size: 15px;
            line-height: 1.8;
            max-width: 570px;
            margin-bottom: 28px;
        }

        .hero-button {
            display: inline-block;
            background: #315b43;
            color: white;
            text-decoration: none;
            padding: 13px 22px;
            border-radius: 12px;
            font-size: 13px;
            font-weight: 600;
        }

        .hero-button:hover {
            background: #264a35;
        }

        /* HERO ILLUSTRATION */

        .hero-visual {
            height: 330px;
            background: #e4ede2;
            border-radius: 35px;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .paper {
            width: 215px;
            height: 255px;
            background: #fff;
            border-radius: 12px;
            transform: rotate(-5deg);
            padding: 34px 27px;
            box-shadow: 0 20px 40px rgba(43, 67, 51, .12);
        }

        .paper-title {
            width: 65%;
            height: 12px;
            background: #5f8068;
            border-radius: 20px;
            margin-bottom: 28px;
        }

        .paper-line {
            width: 100%;
            height: 8px;
            background: #dfe8df;
            border-radius: 20px;
            margin-bottom: 14px;
        }

        .paper-line.short {
            width: 65%;
        }

        .paper-line.medium {
            width: 82%;
        }

        /* STATS */

        .stats {
            width: 84%;
            max-width: 1150px;
            margin: 0 auto 75px;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 18px;
        }

        .stat {
            background: #fff;
            border: 1px solid #e7e3d9;
            border-radius: 18px;
            padding: 22px 25px;
        }

        .stat-number {
            color: #315b43;
            font-family: 'Lora', serif;
            font-size: 31px;
            font-weight: 600;
        }

        .stat-label {
            color: #7a827d;
            font-size: 12px;
            margin-top: 4px;
        }

        /* MAIN CONTENT */

        .content {
            width: 84%;
            max-width: 1150px;
            margin: 0 auto 85px;
            display: grid;
            grid-template-columns: .85fr 1.15fr;
            gap: 35px;
            align-items: start;
        }

        .heading {
            font-family: 'Lora', serif;
            font-size: 29px;
            font-weight: 600;
            color: #293a2f;
            margin-bottom: 8px;
        }

        .subheading {
            color: #7a827d;
            font-size: 13px;
            line-height: 1.7;
            margin-bottom: 22px;
        }

        /* FORM */

        .form-card {
            background: white;
            border: 1px solid #e6e2d8;
            border-radius: 22px;
            padding: 28px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        label {
            display: block;
            color: #35483b;
            font-size: 12px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        input,
        select,
        textarea {
            width: 100%;
            border: 1px solid #dfe3de;
            background: #fcfcfa;
            border-radius: 11px;
            padding: 12px 14px;
            font-family: 'DM Sans', sans-serif;
            font-size: 13px;
            color: #34473b;
            outline: none;
        }

        input:focus,
        select:focus,
        textarea:focus {
            border-color: #8da995;
            background: white;
        }

        textarea {
            height: 125px;
            resize: vertical;
        }

        .submit {
            width: 100%;
            border: none;
            background: #315b43;
            color: white;
            padding: 13px;
            border-radius: 11px;
            font-family: 'DM Sans', sans-serif;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
        }

        .submit:hover {
            background: #264a35;
        }

        /* ASPIRATION LIST */

        .list {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .aspiration {
            background: #fff;
            border: 1px solid #e7e3d9;
            border-radius: 18px;
            padding: 21px 23px;
        }

        .top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 10px;
            margin-bottom: 11px;
        }

        .category {
            background: #e7f0e7;
            color: #54735e;
            padding: 6px 11px;
            border-radius: 20px;
            font-size: 10px;
            font-weight: 700;
        }

        .status {
            padding: 6px 10px;
            border-radius: 20px;
            font-size: 10px;
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

        .aspiration h3 {
            font-family: 'Lora', serif;
            font-size: 18px;
            font-weight: 600;
            color: #304237;
            margin-bottom: 7px;
        }

        .aspiration p {
            color: #737c76;
            font-size: 12px;
            line-height: 1.7;
        }

        .empty {
            background: white;
            border: 1px solid #e7e3d9;
            border-radius: 18px;
            padding: 35px;
            text-align: center;
            color: #7a827d;
            font-size: 13px;
        }

        /* FOOTER */

        footer {
            background: #28392e;
            color: white;
            text-align: center;
            padding: 35px 20px;
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

        /* RESPONSIVE */

        @media (max-width: 850px) {
            .hero {
                grid-template-columns: 1fr;
                width: 90%;
            }

            .hero h1 {
                font-size: 46px;
            }

            .stats {
                width: 90%;
            }

            .content {
                width: 90%;
                grid-template-columns: 1fr;
            }

            .success {
                width: 90%;
            }
        }

        @media (max-width: 600px) {
            nav {
                padding: 0 5%;
            }

            .hero {
                margin-top: 40px;
            }

            .hero h1 {
                font-size: 38px;
            }

            .stats {
                grid-template-columns: 1fr;
            }

            .hero-visual {
                height: 250px;
            }

            .paper {
                width: 175px;
                height: 210px;
            }
        }
    </style>
</head>

<body>

    <!-- NAVBAR -->
    <nav>
        <div class="logo">SuaraKita.</div>

        <a href="{{ route('admin.login') }}" class="admin-link">
            Admin
        </a>
    </nav>


    <!-- SUCCESS MESSAGE -->
    @if(session('success'))
        <div class="success">
            {{ session('success') }}
        </div>
    @endif


    <!-- HERO -->
    <section class="hero">

        <div class="hero-text">

            <div class="eyebrow">
                SUARAKITA • ASPIRASI SISWA
            </div>

            <h1>
                Suara yang<br>
                <span>terkumpul.</span>
            </h1>

            <p>
                SuaraKita menjadi ruang bagi siswa untuk menyampaikan
                aspirasi, ide, dan masukan demi menciptakan lingkungan
                sekolah yang lebih baik.
            </p>

            <a href="#kirim" class="hero-button">
                Sampaikan Aspirasi →
            </a>

        </div>


        <div class="hero-visual">

            <div class="paper">

                <div class="paper-title"></div>

                <div class="paper-line medium"></div>
                <div class="paper-line"></div>
                <div class="paper-line short"></div>
                <div class="paper-line medium"></div>
                <div class="paper-line"></div>
                <div class="paper-line short"></div>

            </div>

        </div>

    </section>


    <!-- STATS -->
    <section class="stats">

        <div class="stat">
            <div class="stat-number">
                {{ $aspirations->count() }}
            </div>
            <div class="stat-label">
                Total Aspirasi
            </div>
        </div>

        <div class="stat">
            <div class="stat-number">
                {{ $aspirations->where('status', 'Diproses')->count() }}
            </div>
            <div class="stat-label">
                Sedang Diproses
            </div>
        </div>

        <div class="stat">
            <div class="stat-number">
                {{ $aspirations->where('status', 'Selesai')->count() }}
            </div>
            <div class="stat-label">
                Aspirasi Selesai
            </div>
        </div>

    </section>


    <!-- CONTENT -->
    <section class="content" id="kirim">

        <!-- FORM -->
        <div>

            <h2 class="heading">
                Sampaikan aspirasimu.
            </h2>

            <p class="subheading">
                Punya ide, masukan, atau sesuatu yang perlu diperbaiki?
                Sampaikan di sini. Setiap suara punya arti.
            </p>


            <div class="form-card">

                <form action="{{ route('aspirations.store') }}" method="POST">

                    @csrf

                    <div class="form-group">

                        <label for="title">
                            Judul Aspirasi
                        </label>

                        <input
                            type="text"
                            id="title"
                            name="title"
                            placeholder="Contoh: Tambah tempat sampah di kantin"
                            value="{{ old('title') }}"
                            required
                        >

                    </div>


                    <div class="form-group">

                        <label for="category">
                            Kategori
                        </label>

                        <select id="category" name="category" required>

                            <option value="" disabled selected>
                                Pilih kategori
                            </option>

                            <option value="Fasilitas">
                                Fasilitas
                            </option>

                            <option value="Kebersihan">
                                Kebersihan
                            </option>

                            <option value="Kegiatan">
                                Kegiatan
                            </option>

                            <option value="Keamanan">
                                Keamanan
                            </option>

                            <option value="Lainnya">
                                Lainnya
                            </option>

                        </select>

                    </div>


                    <div class="form-group">

                        <label for="description">
                            Isi Aspirasi
                        </label>

                        <textarea
                            id="description"
                            name="description"
                            placeholder="Ceritakan aspirasi atau masukanmu..."
                            required
                        >{{ old('description') }}</textarea>

                    </div>


                    <button type="submit" class="submit">
                        Kirim Aspirasi
                    </button>

                </form>

            </div>

        </div>


        <!-- LIST ASPIRASI -->
        <div>

            <h2 class="heading">
                Aspirasi siswa.
            </h2>

            <p class="subheading">
                Aspirasi yang sudah disampaikan beserta
                perkembangan statusnya.
            </p>


            <div class="list">

                @forelse($aspirations as $aspiration)

                    <div class="aspiration">

                        <div class="top">

                            <span class="category">
                                {{ $aspiration->category }}
                            </span>


                            @if($aspiration->status == 'Menunggu')

                                <span class="status menunggu">
                                    Menunggu
                                </span>

                            @elseif($aspiration->status == 'Diproses')

                                <span class="status diproses">
                                    Diproses
                                </span>

                            @else

                                <span class="status selesai">
                                    Selesai
                                </span>

                            @endif

                        </div>


                        <h3>
                            {{ $aspiration->title }}
                        </h3>

                        <p>
                            {{ $aspiration->description }}
                        </p>

                    </div>

                @empty

                    <div class="empty">
                        Belum ada aspirasi yang masuk.
                    </div>

                @endforelse

            </div>

        </div>

    </section>


    <!-- FOOTER -->
    <footer>

        <div class="footer-logo">
            SuaraKita.
        </div>

        <p>
            Tempat untuk menyampaikan suara dan ide siswa.
        </p>

    </footer>

</body>
</html>