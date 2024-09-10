<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Daftar Buku</title>
    <!-- Menambahkan Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Daftar Buku</h1>
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Id</th>
                    <th>Judul Buku</th>
                    <th>Penulis</th>
                    <th>Harga</th>
                    <th>Tanggal Terbit</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data_buku as $index => $buku)
                    <tr>
                        <td>{{ $index+1 }}</td>
                        <td>{{ $buku->judul }}</td>
                        <td>{{ $buku->penulis }}</td>
                        <td>{{ "Rp. ".number_format($buku->harga, 2, ',', '.') }}</td>
                        <td>{{ \Carbon\Carbon::parse($buku->tgl_terbit)->format('d-m-Y') }}</td>
                        <td>
                            <!-- Tombol Detail -->
                            <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#detailModal"
                                    onclick="showDetail('{{ $buku->judul }}', '{{ $buku->penulis }}', '{{ $buku->harga }}', '{{ \Carbon\Carbon::parse($buku->tgl_terbit)->format('d-m-Y') }}')">Detail</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Menambahkan bagian untuk menampilkan jumlah total buku dan total harga buku -->
        <div class="alert alert-primary" role="alert">
            <p><strong>Jumlah Total Buku:</strong> {{ $total_buku }}</p>
            <p><strong>Jumlah Total Harga:</strong> {{ "Rp. ".number_format($total_harga, 2, ',', '.') }}</p>
        </div>
    </div>

    <!-- Modal untuk menampilkan detail buku -->
    <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailModalLabel">Detail Buku</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p><strong>Judul:</strong> <span id="modalJudul"></span></p>
                    <p><strong>Penulis:</strong> <span id="modalPenulis"></span></p>
                    <p><strong>Harga:</strong> <span id="modalHarga"></span></p>
                    <p><strong>Tanggal Terbit:</strong> <span id="modalTanggalTerbit"></span></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Menambahkan Bootstrap JS dan dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        function showDetail(judul, penulis, harga, tanggal_terbit) {
            document.getElementById('modalJudul').innerText = judul;
            document.getElementById('modalPenulis').innerText = penulis;
            document.getElementById('modalHarga').innerText = "Rp. " + parseFloat(harga).toLocaleString('id-ID', {minimumFractionDigits: 2});
            document.getElementById('modalTanggalTerbit').innerText = tanggal_terbit;
        }
    </script>
</body>
</html>
