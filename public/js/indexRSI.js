$(document).ready(function () {

    // // Load data filter options
    // loadFilters();
    loadFilters(); // Memanggil fungsi untuk load filter

    // // Load all patients by default
    loadPatients();

    $(".form-control").change(function () {
        loadPatients();
    });

    function loadFilters() {

        $.get('/get-filtersRSI', function (data) {
            if (data.poliklinik) {
                console.log(data.poliklinik)
                populateSelect('#filter_poliklinik', data.poliklinik);
            }
            if (data.dokter) {
                console.log(data.dokter)
                populateSelect('#filter_dokter', data.dokter);
            }
            if (data.petugas_pendaftaran) {
                console.log(data.petugas_pendaftaran)
                populateSelect('#filter_pegawai', data.petugas_pendaftaran);
            }
        });
    }

    function loadPatients(page =  1) {
        const filters = {
            tanggal: $('#filter_tanggal').val(),
            poliklinik: $('#filter_poliklinik').val(),
            dokter: $('#filter_dokter').val(),
            pegawai: $('#filter_pegawai').val(),
            via: $('#filter_via').val(),
            page: page
        };

        // console.log([filters, 123]);
        $.get('/get-patientsRSI', filters, function (responAmbil) {
            // console.log('Response:', responAmbil);

            $('#data_pasien').html('');  // Kosongkan tabel sebelum diisi
            if (responAmbil.data && responAmbil.data.length > 0) {
                responAmbil.data.forEach(patientiki => {
                    // alur pengambilan dibawah yaitu
                    // patientiki ialah variabel yang menampung semua data yang diambil oleh responAmbil
                    // untuk setelahnya yang dimana setelah patientiki ada penjelasan tersendiri
                    // karena patientiki bersumber pada controller PasienRSIController yang dihubungkan dari /get-patientsRSI
                    // jadi patientiki bisa mengakses nama nama kolom database yang memang sudah disambungkan dan diakses pada
                                        // controller PasienRSIController
                    // oke penjelasannya
                    // patientiki?.no_pendaftaran --> ini mengakses kolom no_pendaftaran pada tabel pendaftaran_t
                    // patientiki?.tgl_pendaftaran --> ini juga sama kolom tgl_pendaftaran di tabel pendaftaran_t
                    // patientiki?.pasieniki?.nama_pasien --> pasieniki ialah variabel function yang ada pada model PendaftaranRSI
                                    // yang juga digunakan dalam controller PasienRSIController yang mengatur database di model dan ditampilkan ke view
                                    // dan nama_pasien ialah kolom dalam tabel pasien_m
                    const pegawaiRole = patientiki?.create_loginpemakai_id === 1
                        ? 'APM' : 'Petugas';
                    $('#data_pasien').append(`
                        <tr> 
                            <td>${patientiki?.no_pendaftaran}</td>
                            <td>${patientiki?.tgl_pendaftaran}</td>
                            <td>${patientiki?.pasieniki?.nama_pasien}</td>
                            <td>${patientiki?.poliklinik?.ruangan_nama}</td>
                            <td>${patientiki?.dokter?.nama_pegawai ?? '-'}</td>
                            <td>${pegawaiRole}</td>
                            <td>${patientiki?.pegawai?.petugasrsi?.nama_pegawai ?? '-'}</td>
                        </tr>
                    `);
                });
                // Update navigasi pagination
                updatePagination(responAmbil);
            } else {
                $('#data_pasien').append('<tr><td colspan="7" class="text-center">Data tidak ditemukan</td></tr>');
            }
        }).fail(function(jqXHR, textStatus, errorThrown) {
                // Menampilkan pesan error jika ada kegagalan dalam AJAX request
                console.error('Request failed: ' + textStatus + ', ' + errorThrown);
                $('#data_pasien').html('<tr><td colspan="7" class="text-center">Terjadi kesalahan. Coba lagi nanti.</td></tr>');
            });
        
    }

    function updatePagination(paginationDataLaravel) {
        // Bersihkan elemen pagination
        $('#pagination').html('');
    
        // Tambahkan tombol Previous
        if (paginationDataLaravel.prev_page_url) {
            $('#pagination').append(`<button class="page-link" data-page="${paginationDataLaravel.current_page - 1}">Previous</button>`);
        }
    
        // Tambahkan nomor halaman
        for (let i = 1; i <= paginationDataLaravel.last_page; i++) {
            $('#pagination').append(`
                <button class="page-link ${i === paginationDataLaravel.current_page ? 'active' : ''}" data-page="${i}">${i}</button>
            `);
        }
    
        // Tambahkan tombol Next
        if (paginationDataLaravel.next_page_url) {
            $('#pagination').append(`<button class="page-link" data-page="${paginationDataLaravel.current_page + 1}">Next</button>`);
        }
    
        // Tambahkan event listener untuk tombol pagination
        $('.page-link').click(function () {
            const page = $(this).data('page');
            loadPatients(page); // Panggil ulang fungsi untuk halaman baru
        });
    }

    // Fungsi untuk mengisi pilihan dropdown
    function populateSelect(selector, options) {
        $(selector).html('<option value="">Semua</option>');
        options.forEach(option => {
            // $(selector).append(`<option value="${option.id}">${option.name}</option>`);
            $(selector).append(`<option value="${option.ruangan_id || option.pegawai_id}">${option.ruangan_nama || option.nama_pegawai}</option>`);
        });
    }
});