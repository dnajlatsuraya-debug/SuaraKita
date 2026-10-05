<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin - SuaraKita</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f7f5ee;
            color: #26352c;
        }

        nav {
            height: 72px;
            background: white;
            border-bottom: 1px solid #e5e2d8;

            display: flex;
            justify-content: space-between;
            align-items: center;

            padding: 0 7%;
        }

        .logo {
            font-size: 24px;
            font-weight: bold;
            color: #315c43;
        }

        .nav-right {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .home-link {
            text-decoration: none;
            color: #315c43;
            font-weight: 600;
        }

        .logout-button {
            border: none;
            background: #f5e5e5;
            color: #9a4545;

            padding: 10px 15px;

            border-radius: 10px;

            cursor: pointer;

            font-weight: 600;
        }

        .logout-button:hover {
            background: #efdada;
        }

        .container {
            width: 90%;
            max-width: 1100px;

            margin: 55px auto;
        }

        h1 {
            font-size: 36px;
            margin-bottom: 8px;
        }

        .subtitle {
            color: #737b75;
            margin-bottom: 30px;
        }

        .success {
            background: #e4f0e5;
            color: #315c43;

            padding: 15px;

            border-radius: 12px;

            margin-bottom: 20px;
        }

        .card {
            background: white;

            border: 1px solid #e5e2d8;

            border-radius: 20px;

            padding: 25px;

            margin-bottom: 18px;
        }

        .category {
            color: #6d9279;

            font-size: 13px;

            font-weight: bold;

            margin-bottom: 8px;
        }

        h2 {
            font-size: 22px;

            margin-bottom: 10px;
        }

        .description {
            color: #737b75;

            line-height: 1.6;

            margin-bottom: 20px;
        }

        .status-area {
            display: flex;

            align-items: center;

            gap: 10px;

            flex-wrap: wrap;
        }

        select {
            padding: 11px 13px;

            border: 1px solid #d8ddd8;

            border-radius: 10px;

            background: white;

            font-size: 14px;

            cursor: pointer;
        }

        button,
        .edit-button {
            border: none;

            padding: 11px 16px;

            border-radius: 10px;

            font-weight: 600;

            cursor: pointer;

            text-decoration: none;

            display: inline-block;
        }

        .status-button {
            background: #315c43;

            color: white;
        }

        .status-button:hover {
            background: #264a35;
        }

        .edit-button {
            background: #e8eee8;

            color: #315c43;
        }

        .edit-button:hover {
            background: #dce7dc;
        }

        .delete-button {
            background: #f5e5e5;

            color: #9a4545;
        }

        .delete-button:hover {
            background: #efdada;
        }

        .actions {
            display: flex;

            gap: 10px;

            margin-top: 15px;

            flex-wrap: wrap;
        }

        .empty {
            background: white;

            padding: 40px;

            border-radius: 18px;

            text-align: center;

            color: #737b75;
        }

        @media (max-width: 700px) {

            nav {
                padding: 0 5%;
            }

            .nav-right {
                gap: 10px;
            }

            .home-link {
                display: none;
            }

            .container {
                width: 92%;
            }

            h1 {
                font-size: 30px;
            }
        }
    </style>
</head>

<body>

    <!-- NAVBAR -->
    <nav>

        <div class="logo">
            SuaraKita.
        </div>

        <div class="nav-right">

            <a
                href="{{ route('aspirations.index') }}"
                class="home-link"
            >
                ← Halaman Utama
            </a>

            <form
                action="{{ route('admin.logout') }}"
                method="POST"
            >

                @csrf

                <button
                    type="submit"
                    class="logout-button"
                >
                    Logout
                </button>

            </form>

        </div>

    </nav>


    <!-- CONTENT -->
    <div class="container">

        <h1>
            Kelola Aspirasi
        </h1>

        <p class="subtitle">
            Kelola aspirasi siswa dan perbarui statusnya.
        </p>


        <!-- SUCCESS MESSAGE -->
        @if(session('success'))

            <div class="success">
                {{ session('success') }}
            </div>

        @endif


        <!-- ASPIRATION LIST -->
        @forelse($aspirations as $aspiration)

            <div class="card">

                <!-- CATEGORY -->
                <div class="category">
                    {{ $aspiration->category }}
                </div>


                <!-- TITLE -->
                <h2>
                    {{ $aspiration->title }}
                </h2>


                <!-- DESCRIPTION -->
                <p class="description">
                    {{ $aspiration->description }}
                </p>


                <!-- STATUS -->
                <form
                    action="{{ route('aspirations.updateStatus', $aspiration->id) }}"
                    method="POST"
                >

                    @csrf

                    @method('PATCH')

                    <div class="status-area">

                        <select name="status">

                            <option
                                value="Menunggu"
                                {{ $aspiration->status == 'Menunggu' ? 'selected' : '' }}
                            >
                                Menunggu
                            </option>

                            <option
                                value="Diproses"
                                {{ $aspiration->status == 'Diproses' ? 'selected' : '' }}
                            >
                                Diproses
                            </option>

                            <option
                                value="Selesai"
                                {{ $aspiration->status == 'Selesai' ? 'selected' : '' }}
                            >
                                Selesai
                            </option>

                        </select>


                        <button
                            type="submit"
                            class="status-button"
                        >
                            Simpan Status
                        </button>

                    </div>

                </form>


                <!-- EDIT & DELETE -->
                <div class="actions">

                    <!-- EDIT -->
                    <a
                        href="{{ route('aspirations.edit', $aspiration->id) }}"
                        class="edit-button"
                    >
                        ✎ Edit
                    </a>


                    <!-- DELETE -->
                    <form
                        action="{{ route('aspirations.destroy', $aspiration->id) }}"
                        method="POST"
                        onsubmit="return confirm('Yakin ingin menghapus aspirasi ini?')"
                    >

                        @csrf

                        @method('DELETE')

                        <button
                            type="submit"
                            class="delete-button"
                        >
                            Hapus
                        </button>

                    </form>

                </div>

            </div>

        @empty

            <div class="empty">

                Belum ada aspirasi yang masuk.

            </div>

        @endforelse

    </div>

</body>

</html>