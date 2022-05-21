<script>
    function updateTanggal() {
        var hari = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu",];

        var tglJumlah1 = $('#rks_jumlah');
        var tglJumlah2 = $('#survey_harga_pasar_jumlah')
        var tglJumlah3 = $('#hps_jumlah');
        var tglJumlah4 = $('#undangan_pengadaan_langsung_jumlah');
        var tglJumlah5 = $('#pemasukan_dok_penawaran_jumlah_dari');
        var tglJumlah6 = $('#pemasukan_dok_penawaran_jumlah');
        var tglJumlah7 = $('#evaluasi_dok_penawaran_jumlah');
        var tglJumlah8 = $('#ba_hasil_klarifikasi_dan_nego_penawaran_jumlah');
        var tglJumlah9 = $('#spbj_jumlah');
       
        var jp1 = parseInt(tglJumlah1.val());
        var jp2 = parseInt(tglJumlah2.val());
        var jp3 = parseInt(tglJumlah3.val());
        var jp4 = parseInt(tglJumlah4.val());
        var jp5 = parseInt(tglJumlah5.val());
        var jp6 = parseInt(tglJumlah6.val());
        var jp7 = parseInt(tglJumlah7.val());
        var jp8 = parseInt(tglJumlah8.val());
        var jp9 = parseInt(tglJumlah9.val());
       
        var tanggalDiterimaP = $('#tanggal_diterima_panitia')
        var getTanggal = tanggalDiterimaP.val();
        var gTd = new Date(getTanggal);

        var tambahTgl1 = new Date(gTd.getFullYear(), gTd.getMonth(), gTd.getDate() + (jp1));
        var tambahTgl2 = new Date(gTd.getFullYear(), gTd.getMonth(), gTd.getDate() + (jp1+ jp2));
        var tambahTgl3 = new Date(gTd.getFullYear(), gTd.getMonth(), gTd.getDate() + (jp1 + jp2+ jp3));
        var tambahTgl4 = new Date(gTd.getFullYear(), gTd.getMonth(), gTd.getDate() + (jp1 + jp2 + jp3+ jp4));
        var tambahTgl5 = new Date(gTd.getFullYear(), gTd.getMonth(), gTd.getDate() + (jp1 + jp2 + jp3 + jp4+ jp5));
        var tambahTgl6 = new Date(gTd.getFullYear(), gTd.getMonth(), gTd.getDate() + (jp1 + jp2 + jp3 + jp4 + jp6+ jp7));
        var tambahTgl7 = new Date(gTd.getFullYear(), gTd.getMonth(), gTd.getDate() + (jp1 + jp2 + jp3 + jp4 + jp6 + jp7+ jp8));
        var tambahTgl8 = new Date(gTd.getFullYear(), gTd.getMonth(), gTd.getDate() + (jp1 + jp2 + jp3 + jp4 + jp5 + jp7 + jp8+ jp9));
        var tambahTgl9 = new Date(gTd.getFullYear(), gTd.getMonth(), gTd.getDate() + (jp1 + jp2 + jp3 + jp4 + jp5 + jp6 + jp7 + jp8+ jp9));

        console.log(tambahTgl1)


        $('#rks_tgl').datepicker('setDate', tambahTgl1);
        $('#survey_harga_pasar_tgl').datepicker('setDate', tambahTgl2);
        $('#hps_tgl').datepicker('setDate', tambahTgl3);
        $('#undangan_pengadaan_langsung_tgl').datepicker('setDate', tambahTgl4);
        $('#pemasukan_dok_penawaran_tgl').datepicker('setDate', tambahTgl5);
        $('#evaluasi_dok_penawaran_tgl').datepicker('setDate', tambahTgl6);
        $('#pemasukan_dok_penawaran_tgl_dari').datepicker('setDate', tambahTgl7);
        $('#ba_hasil_klarifikasi_dan_nego_penawaran_tgl').datepicker('setDate', tambahTgl8);
        $('#spbj_tgl').datepicker('setDate', tambahTgl9);

        $('#rks_hari').val(hari[tambahTgl1.getDay()])
        $('#survey_harga_pasar_hari').val(hari[tambahTgl2.getDay()])
        $('#hps_hari').val(hari[tambahTgl3.getDay()]);
        $('#undangan_pengadaan_langsung_hari').val(hari[tambahTgl4.getDay()]);
        $('#pemasukan_dok_penawaran_hari_dari').val(hari[tambahTgl5.getDay()]);
        $('#pemasukan_dok_penawaran_hari').val(hari[tambahTgl6.getDay()]);
        $('#evaluasi_dok_penawaran_hari').val(hari[tambahTgl7.getDay()]);
        $('#ba_hasil_klarifikasi_dan_nego_penawaran_hari').val(hari[tambahTgl8.getDay()]);
        $('#spbj_hari').val(hari[tambahTgl9.getDay()]);


    }

    $(document).ready(function () {

        var $nppv8 = $('#nppv8')
        var $nppv1 = $('#nppv1')
        var $nppv2 = $('#nppv2')
        var $nppv3 = $('#nppv3')
        var $nppv5 = $('#nppv5')
        var $nppv6 = $('#nppv6')
        var $nppv7 = $('#nppv7'), $value = $('.no_proses_pengadaan');
        $value.on('input', function (e) {
            var total = 1;
            $value.each(function (index, elem) {
                if (!Number.isNaN(parseInt(this.value, 10)))
                    total = total * parseInt(this.value, 10);
            });
            if ($('#fungsi_pembangkit').val() === 'Pembangkit') {
                $nppv8.val('0' + total + '.RKS/DAN.01.01/210200/' + $('#tahun').val());
                $nppv1.val('0' + total + '.BASVY-PL/DAN.02.01/210200/' + $('#tahun').val());
                $nppv2.val('0' + total + '.HPS-PL/DAN.02.01/210200/' + $('#tahun').val());
                $nppv3.val('0' + total + '.UND-SP/DAN.02.01/210200/' + $('#tahun').val());

                $nppv5.val('0' + total + '.BAEP-SP/DAN.02.01/210200/' + $('#tahun').val());
                $nppv6.val('0' + total + '.BAHKTNH/DAN.02.01/210200/' + $('#tahun').val());
                $nppv7.val('0' + total + '.SPBJ/DAN.02.01/210200/' + $('#tahun').val());


            } else if ($('#fungsi_pembangkit').val() === 'Sarana') {
                $nppv8.val('0' + total + '.RKS/DAN.01.01/210200/' + $('#tahun').val());
                $nppv1.val('0' + total + '.BASVY-PL/DAN.02.07/210200/' + $('#tahun').val());
                $nppv2.val('0' + total + '.HPS-PL/DAN.02.07/210200/' + $('#tahun').val());
                $nppv3.val('0' + total + '.PENGLLNG/DAN.07.01/210200/' + $('#tahun').val());

                $nppv5.val('0' + total + '.BAEP-SP/DAN.02.07/210200/' + $('#tahun').val());
                $nppv6.val('0' + total + '.BAHKTNH/DAN.02.07/210200/' + $('#tahun').val());
                $nppv7.val('0' + total + '.SPBJ/DAN.02.07/210200/' + $('#tahun').val());
            }
        });


    });
</script>
