<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rumah Sakit - Filter Data Pasien</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Data Pasien</h2>
        <div class="row mb-4">
            <div class="col-md-3">
                <script src="/js/tanggalsekarang.js"></script>
                <label for="filter_tanggal">Tanggal Pendaftaran:</label>
                <input type="date" id="filter_tanggal" class="form-control">
            </div>
            <div class="col-md-3">
                <label for="filter_poliklinik">Poliklinik:</label>
                <select id="filter_poliklinik" class="form-control">
                    <option value="">Semua</option>
                </select>
            </div>
            <div class="col-md-3">
                <label for="filter_dokter">Dokter:</label>
                <select id="filter_dokter" class="form-control">
                    <option value="">Semua</option>
                </select>
            </div>
            <div class="col-md-3">
                <label for="filter_pegawai">Pegawai:</label>
                <select id="filter_pegawai" class="form-control">
                    <option value="">Semua</option>
                </select>
            </div>
        </div>
        <div class="row mb-4">
            <div class="col-md-3">
                <label for="filter_via">Pendaftaran Via:</label>
                <select id="filter_via" class="form-control">
                    <option value="3">Semua</option>
                    <option value="2">Petugas</option>
                    <option value="1">APM</option>
                </select>
            </div>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No. Pendaftaran</th>
                    <th>Tanggal</th>
                    <th>Nama Pasien</th>
                    <th>Poliklinik</th>
                    <th>Dokter</th>
                    <th>Pendaftaran Via</th>
                    <th>Petugas Pendaftaran</th>
                </tr>
            </thead>
            <tbody id="data_pasien">
                <!-- Data pasien akan diisi oleh JavaScript -->
            </tbody>
        </table>
        
            <!-- Navigasi pagination -->
        <div id="pagination" class="d-flex justify-content-center">
            <!-- Pagination akan diisi oleh JavaScript -->
        </div>

    </div>

    <script src="/js/indexRSI.js">
        
    </script>
</body>
</html>
