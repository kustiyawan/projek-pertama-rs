$(document).ready(function () {

    // // Load data filter options
    // loadFilters();
    loadFilters(); // Memanggil fungsi untuk load filter

    // // Load all patients by default
    loadPatients();

    // // Fetch patients on filter change
    // $(".form-control").change(function () {
    //     loadPatients();
    // });

    // Memanggil data pasien berdasarkan filter
    $(".form-control").change(function () {
        loadPatients();
    });

    // function loadFilters() {
    //     $.get('filter_data.php', { tipe_urut: 'filters' }, function (data) {
    //         const filters = JSON.parse(data);
    //         populateSelect('#filter_poliklinik', filters.poliklinik);
    //         populateSelect('#filter_dokter', filters.dokter);
    //         populateSelect('#filter_pegawai', filters.pegawai);
    //     });
    // }

    function loadFilters() {
    // Panggil route Laravel untuk filter
        // $.get('/get-filters', function (data) {
        //     // Debugging, periksa data yang diterima
        //     console.log(data);
        //     populateSelect('#filter_poliklinik', data.poliklinik);
        //     populateSelect('#filter_dokter', data.dokter);
        //     populateSelect('#filter_pegawai', data.pegawai);
        // });

        $.get('/get-filters', function (data) {
            if (data.poliklinik) {
                populateSelect('#filter_poliklinik', data.poliklinik);
            }
            if (data.dokter) {
                populateSelect('#filter_dokter', data.dokter);
            }
            if (data.pegawai) {
                populateSelect('#filter_pegawai', data.pegawai);
            }
        });
    }

    // function loadPatients() {
    //     const filters = {
    //         tanggal: $('#filter_tanggal').val(),
    //         poliklinik: $('#filter_poliklinik').val(),
    //         dokter: $('#filter_dokter').val(),
    //         pegawai: $('#filter_pegawai').val(),
    //         via: $('#filter_via').val()
    //     };
    //     // $.get('filter_data.php', { tipe: 'patients', ...filters }, function (data) {
    //     //     $('#data_pasien').html(data);
    //     // });

    //     // Panggil route Laravel untuk pasien
    //     $.get('get-patients', filters, function (data) {
    //         $('#data_pasien').html(data);
    //     });
    // }

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
        $.get('/get-patients', filters, function (responAmbil) {

            $('#data_pasien').html('');  // Kosongkan tabel sebelum diisi
            if (responAmbil.data && responAmbil.data.length > 0) {
                responAmbil.data.forEach(patientiki => {
                    $('#data_pasien').append(`
                        <tr>
                            <td>${patientiki?.no_pendaftaran}</td>
                            <td>${patientiki?.tanggal}</td>
                            <td>${patientiki?.pasien?.nama}</td>
                            <td>${patientiki?.poliklinik?.nama_poliklinik}</td>
                            <td>${patientiki?.dokter?.nama ?? '-'}</td>
                            <td>${patientiki?.pendaftaran_via}</td>
                            <td>${patientiki?.pegawai?.nama ?? '-'}</td>
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
                $('#data_pasien').html('<tr><td colspan="6" class="text-center">Terjadi kesalahan. Coba lagi nanti.</td></tr>');
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
            $(selector).append(`<option value="${option.id_poliklinik || option.id_pegawai}">${option.nama_poliklinik || option.nama}</option>`);
        });
    }
});