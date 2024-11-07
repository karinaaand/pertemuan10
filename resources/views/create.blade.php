<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tambah Buku</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <div class="container mt-5">
        <h4 class="mb-4">Tambah Buku</h4>
        <form method="post" action="{{ route('buku.store') }}" enctype="multipart/form-data">
            @csrf

            <!-- Display errors if any -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Photo input -->
            <div class="mb-3 row">
                <label for="photo" class="col-md-4 col-form-label text-md-end text-start">Photo</label>
                <div class="col-md-6">
                    <input type="file" class="form-control @error('photo') is-invalid @enderror" id="photo" name="photo">
                    @error('photo')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Judul input -->
            <div class="mb-3">
                <label for="judul" class="form-label">Judul</label>
                <input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul" name="judul" placeholder="Masukkan judul buku" value="{{ old('judul') }}">
                @error('judul')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- Penulis input -->
            <div class="mb-3">
                <label for="penulis" class="form-label">Penulis</label>
                <input type="text" class="form-control @error('penulis') is-invalid @enderror" id="penulis" name="penulis" placeholder="Masukkan nama penulis" value="{{ old('penulis') }}">
                @error('penulis')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- Harga input -->
            <div class="mb-3">
                <label for="harga" class="form-label">Harga</label>
                <input type="text" class="form-control @error('harga') is-invalid @enderror" id="harga" name="harga" placeholder="Masukkan harga buku" value="{{ old('harga') }}">
                @error('harga')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- Tanggal Terbit input -->
            <div class="mb-3">
                <label for="tgl_terbit" class="form-label">Tanggal Terbit</label>
                <input type="date" class="form-control @error('tgl_terbit') is-invalid @enderror" id="tgl_terbit" name="tgl_terbit" placeholder="yyyy/mm/dd" value="{{ old('tgl_terbit') }}">
                @error('tgl_terbit')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- Buttons -->
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ url('/buku') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
