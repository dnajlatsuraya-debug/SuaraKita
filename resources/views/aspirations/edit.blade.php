<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit Aspirasi - SuaraKita</title>

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

        nav a {
            text-decoration: none;
            color: #315c43;
            font-weight: 600;
        }

        .container {
            width: 90%;
            max-width: 750px;
            margin: 55px auto;
        }

        .box {
            background: white;
            border: 1px solid #e5e2d8;
            border-radius: 22px;
            padding: 35px;
            box-shadow: 0 10px 30px rgba(40, 60, 45, 0.06);
        }

        h1 {
            font-size: 32px;
            margin-bottom: 8px;
        }

        .subtitle {
            color: #737b75;
            margin-bottom: 30px;
        }

        .field {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: 600;
            margin-bottom: 8px;
        }

        input,
        select,
        textarea {
            width: 100%;
            padding: 14px;
            border: 1px solid #d8ddd8;
            border-radius: 12px;
            font-family: inherit;
            font-size: 15px;
            outline: none;
        }

        textarea {
            min-height: 150px;
            resize: vertical;
        }

        input:focus,
        select:focus,
        textarea:focus {
            border-color: #6d9279;
        }

        .buttons {
            display: flex;
            gap: 10px;
            margin-top: 25px;
        }

        .cancel {
            text-decoration: none;
            padding: 13px 20px;
            background: #edf0eb;
            color: #405047;
            border-radius: 11px;
            font-weight: 600;
        }

        button {
            border: none;
            padding: 13px 20px;
            background: #315c43;
            color: white;
            border-radius: 11px;
            font-weight: 600;
            cursor: pointer;
        }

        .errors {
            background: #fff0f0;
            color: #a33b3b;
            padding: 15px 20px;
            border-radius: 12px;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>

<nav>

    <div class="logo">
        SuaraKita.
    </div>

    <a href="{{ route('aspirations.admin') }}">
        ← Kembali
    </a>

</nav>

<div class="container">

    <div class="box">

        <h1>Edit Aspirasi</h1>

        <p class="subtitle">
            Perbarui informasi aspirasi.
        </p>

        @if($errors->any())

            <div class="errors">

                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>

            </div>

        @endif

        <form
            action="{{ route('aspirations.update', $aspiration->id) }}"
            method="POST"
        >

            @csrf
            @method('PUT')

            <div class="field">

                <label for="title">
                    Judul Aspirasi
                </label>

                <input
                    type="text"
                    id="title"
                    name="title"
                    value="{{ old('title', $aspiration->title) }}"
                    required
                >

            </div>

            <div class="field">

                <label for="category">
                    Kategori
                </label>

                <select id="category" name="category" required>

                    <option value="Fasilitas"
                        {{ old('category', $aspiration->category) == 'Fasilitas' ? 'selected' : '' }}>
                        Fasilitas
                    </option>

                    <option value="Kebersihan"
                        {{ old('category', $aspiration->category) == 'Kebersihan' ? 'selected' : '' }}>
                        Kebersihan
                    </option>

                    <option value="Kegiatan"
                        {{ old('category', $aspiration->category) == 'Kegiatan' ? 'selected' : '' }}>
                        Kegiatan
                    </option>

                    <option value="Akademik"
                        {{ old('category', $aspiration->category) == 'Akademik' ? 'selected' : '' }}>
                        Akademik
                    </option>

                    <option value="Keamanan"
                        {{ old('category', $aspiration->category) == 'Keamanan' ? 'selected' : '' }}>
                        Keamanan
                    </option>

                    <option value="Lainnya"
                        {{ old('category', $aspiration->category) == 'Lainnya' ? 'selected' : '' }}>
                        Lainnya
                    </option>

                </select>

            </div>

            <div class="field">

                <label for="description">
                    Isi Aspirasi
                </label>

                <textarea
                    id="description"
                    name="description"
                    required
                >{{ old('description', $aspiration->description) }}</textarea>

            </div>

            <div class="buttons">

                <a
                    href="{{ route('aspirations.admin') }}"
                    class="cancel"
                >
                    Batal
                </a>

                <button type="submit">
                    Simpan Perubahan
                </button>

            </div>

        </form>

    </div>

</div>

</body>
</html>