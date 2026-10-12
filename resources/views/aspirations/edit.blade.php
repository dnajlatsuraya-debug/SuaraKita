
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

        input, select, textarea {
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

        input:focus, select:focus, textarea:focus {
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

        .hint {
            font-size: 13px;
            color: #737b75;
            margin-top: 7px;
        }

        @media (max-width: 600px) {
            .box {
                padding: 24px;
            }

            h1 {
                font-size: 27px;
            }

            .buttons {
                flex-wrap: wrap;
            }
        }
    </style>
</head>

<body>
<nav>
    <div class="logo">SuaraKita.</div>
    <a href="{{ route('aspirations.index') }}">← Kembali</a>
</nav>

<div class="container">
    <div class="box">
        <h1>Edit Aspirasi</h1>
        <p class="subtitle">Perbarui informasi aspirasi kamu.</p>

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
            enctype="multipart/form-data"
        >
            @csrf
            @method('PUT')

            <input type="hidden" name="code" value="{{ $code }}">

            <div class="field">
                <label for="title">Judul Aspirasi</label>
                <input
                    type="text"
                    id="title"
                    name="title"
                    value="{{ old('title', $aspiration->title) }}"
                    required
                >
            </div>

            <div class="field">
                <label for="category">Kategori</label>
                <select id="category" name="category" required>
                    @foreach(['Fasilitas', 'Kebersihan', 'Kegiatan', 'Akademik', 'Keamanan', 'Lainnya'] as $category)
                        <option
                            value="{{ $category }}"
                            {{ old('category', $aspiration->category) == $category ? 'selected' : '' }}
                        >
                            {{ $category }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="field">
                <label for="description">Isi Aspirasi</label>
                <textarea
                    id="description"
                    name="description"
                    required
                >{{ old('description', $aspiration->description) }}</textarea>
            </div>

            <div class="field">
                <label for="location">Lokasi (opsional)</label>
                <input
                    type="text"
                    id="location"
                    name="location"
                    value="{{ old('location', $aspiration->location) }}"
                    placeholder="Contoh: ruang kelas XI PPLG 1"
                >
            </div>

            <div class="field">
                <label for="evidence_photo">Foto Bukti (opsional)</label>

                @if($aspiration->evidence_photo)
                    <p class="hint">Foto bukti sudah tersedia. Pilih file baru jika ingin menggantinya.</p>
                @endif

                <input
                    type="file"
                    id="evidence_photo"
                    name="evidence_photo"
                    accept=".jpg,.jpeg,.png,image/jpeg,image/png"
                >

                <p class="hint">Format JPG, JPEG, atau PNG. Maksimal 2 MB.</p>
            </div>

            <div class="buttons">
                <a href="{{ route('aspirations.index') }}" class="cancel">
                    Batal
                </a>

                <button type="submit">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
</body>
</html>
