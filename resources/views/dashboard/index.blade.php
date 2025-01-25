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
                    <option value="">Semua</option>
                    <option value="admisi">Petugas</option>
                    <option value="APM">APM</option>
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
                    <th>Petugas</th>
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

    <script src="/js/index.js">
        // $(document).ready(function () {
        //     // // Load data filter options
        //     // loadFilters();

        //     loadFilters(); // Memanggil fungsi untuk load filter

        //     // // Load all patients by default
        //     loadPatients();

        //     // // Fetch patients on filter change
        //     // $(".form-control").change(function () {
        //     //     loadPatients();
        //     // });

        //     // Memanggil data pasien berdasarkan filter
        //     $(".form-control").change(function () {
        //         loadPatients();
        //     });

        //     // function loadFilters() {
        //     //     $.get('filter_data.php', { tipe_urut: 'filters' }, function (data) {
        //     //         const filters = JSON.parse(data);
        //     //         populateSelect('#filter_poliklinik', filters.poliklinik);
        //     //         populateSelect('#filter_dokter', filters.dokter);
        //     //         populateSelect('#filter_pegawai', filters.pegawai);
        //     //     });
        //     // }

        //     function loadFilters() {
        //     // Panggil route Laravel untuk filter
        //         // $.get('/get-filters', function (data) {
        //         //     // Debugging, periksa data yang diterima
        //         //     console.log(data);
        //         //     populateSelect('#filter_poliklinik', data.poliklinik);
        //         //     populateSelect('#filter_dokter', data.dokter);
        //         //     populateSelect('#filter_pegawai', data.pegawai);
        //         // });

        //         $.get('/get-filters', function (data) {
        //             if (data.poliklinik) {
        //                 populateSelect('#filter_poliklinik', data.poliklinik);
        //             }
        //             if (data.dokter) {
        //                 populateSelect('#filter_dokter', data.dokter);
        //             }
        //             if (data.pegawai) {
        //                 populateSelect('#filter_pegawai', data.pegawai);
        //             }
        //         });
        //     }

        //     // function loadPatients() {
        //     //     const filters = {
        //     //         tanggal: $('#filter_tanggal').val(),
        //     //         poliklinik: $('#filter_poliklinik').val(),
        //     //         dokter: $('#filter_dokter').val(),
        //     //         pegawai: $('#filter_pegawai').val(),
        //     //         via: $('#filter_via').val()
        //     //     };
        //     //     // $.get('filter_data.php', { tipe: 'patients', ...filters }, function (data) {
        //     //     //     $('#data_pasien').html(data);
        //     //     // });

        //     //     // Panggil route Laravel untuk pasien
        //     //     $.get('get-patients', filters, function (data) {
        //     //         $('#data_pasien').html(data);
        //     //     });
        //     // }

        //     function loadPatients() {
        //         const filters = {
        //             tanggal: $('#filter_tanggal').val(),
        //             poliklinik: $('#filter_poliklinik').val(),
        //             dokter: $('#filter_dokter').val(),
        //             pegawai: $('#filter_pegawai').val(),
        //             via: $('#filter_via').val()
        //         };

        //         // console.log([filters, 123]);
        //         // $.get('/get-patients', filters, function (data) {
        //         //     $('#data_pasien').html('');
        //         //     data.forEach(patient => {
        //         //         $('#data_pasien').append(`
        //         //             <tr>
        //         //                 <td>${patient.no_pendaftaran}</td>
        //         //                 <td>${patient.tanggal}</td>
        //         //                 <td>${patient.nama_pasien}</td>
        //         //                 <td>${patient.poliklinik.nama_poliklinik}</td>
        //         //                 <td>${patient.dokter.nama}</td>
        //         //                 <td>${patient.pendaftaran_via}</td>
        //         //             </tr>
        //         //         `);
        //         //     });
                    
        //         // });

        //         $.get('/get-patients', filters, function (data) {
        //             $('#data_pasien').html('');  // Kosongkan tabel sebelum diisi
        //             if (data && data.length > 0) {
        //                 data.forEach(patientiki => {
        //                     $('#data_pasien').append(`
        //                         <tr>
        //                             <td>${patientiki?.no_pendaftaran}</td>
        //                             <td>${patientiki?.tanggal}</td>
        //                             <td>${patientiki?.pasien?.nama}</td>
        //                             <td>${patientiki?.poliklinik?.nama_poliklinik}</td>
        //                             <td>${patientiki?.dokter?.nama ?? '-'}</td>
        //                             <td>${patientiki?.pendaftaran_via}</td>
        //                             <td>${patientiki?.pegawai?.nama ?? '-'}</td>
        //                         </tr>
        //                     `);
        //                 });
        //             } else {
        //                 $('#data_pasien').append('<tr><td colspan="7" class="text-center">Data tidak ditemukan</td></tr>');
        //             }
        //         }).fail(function(jqXHR, textStatus, errorThrown) {
        //                 // Menampilkan pesan error jika ada kegagalan dalam AJAX request
        //                 console.error('Request failed: ' + textStatus + ', ' + errorThrown);
        //                 $('#data_pasien').html('<tr><td colspan="6" class="text-center">Terjadi kesalahan. Coba lagi nanti.</td></tr>');
        //             });

                
        //     }

        //     // Fungsi untuk mengisi pilihan dropdown
        //     function populateSelect(selector, options) {
        //         $(selector).html('<option value="">Semua</option>');
        //         options.forEach(option => {
        //             // $(selector).append(`<option value="${option.id}">${option.name}</option>`);
        //             $(selector).append(`<option value="${option.id_poliklinik || option.id_pegawai}">${option.nama_poliklinik || option.nama}</option>`);
        //         });
        //     }
        // });
    </script>
</body>
</html>
