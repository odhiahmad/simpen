<script>
    function updateTanggal() {

    }

    $(document).ready(function () {
        $("#refreshTanggal").click(function () {
            var hari = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu",];
            
            var tglJumlah0 = $('#rks_jumlah')
            var tglJumlah1 = $('#survey_harga_pasar_jumlah')
            var tglJumlah2 = $('#hps_jumlah');
            var tglJumlah3 = $('#pengumuman_jumlah');
            var tglJumlah5 = $('#undangan_aanwijzing_direksi_pekerjaan_jumlah');
            var tglJumlah6 = $('#aanwijzing_jumlah');
            var tglJumlah7 = $('#addendum_rks_jumlah');
            var tglJumlah8 = $('#pemasukan_dok_penawaran_jumlah');
            var tglJumlah28 = $('#pemasukan_dok_penawaran_jumlah_dari');
            var tglJumlah9 = $('#pembukaan_penawaran_sampul_satu_jumlah');
            var tglJumlah10 = $('#evaluasi_dok_penawaran_sampul_satu_jumlah');
            var tglJumlah11 = $('#pengumuman_hasil_evaluasi_sampul_satu_jumlah');
            var tglJumlah12 = $('#pembukaan_penawaran_sampul_dua_jumlah');
            var tglJumlah13 = $('#evaluasi_dok_penawaran_sampul_dua_jumlah');
            var tglJumlah14 = $('#undangan_pembuktian_kualifikasi_jumlah');
            var tglJumlah15 = $('#pembuktian_kualifikasi_jumlah');
            var tglJumlah16 = $('#undangan_klarifikasi_dan_nego_penawaran_jumlah');
            var tglJumlah17 = $('#ba_hasil_klarifikasi_dan_nego_penawaran_jumlah');
            var tglJumlah18 = $('#laporan_hasil_evaluasi_jumlah');
            var tglJumlah19 = $('#nd_usulan_penetapan_calon_pemenang_jumlah');
            var tglJumlah20 = $('#nd_penetapan_calon_pemenang_jumlah');
            var tglJumlah21 = $('#pengumuman_calon_pemenang_jumlah');
            var tglJumlah22 = $('#penunjukan_pemenang_jumlah');
            var tglJumlah23 = $('#skkp_jumlah');
            var tglJumlah24 = $('#undangan_cda_jumlah');
            var tglJumlah25 = $('#cda_jumlah');
            var tglJumlah26 = $('#spk_jumlah');
          
            var jp0 = parseInt(tglJumlah0.val());
            var jp1 = parseInt(tglJumlah1.val());
            var jp2 = parseInt(tglJumlah2.val());
            var jp3 = parseInt(tglJumlah3.val());
            var jp5 = parseInt(tglJumlah5.val());
            var jp6 = parseInt(tglJumlah6.val());
            var jp7 = parseInt(tglJumlah7.val());
            var jp8 = parseInt(tglJumlah8.val());
            var jp28 = parseInt(tglJumlah28.val());
            var jp9 = parseInt(tglJumlah9.val());
            var jp10 = parseInt(tglJumlah10.val());
            var jp11 = parseInt(tglJumlah11.val());
            var jp12 = parseInt(tglJumlah12.val());
            var jp13 = parseInt(tglJumlah13.val());
            var jp14 = parseInt(tglJumlah14.val());
            var jp15 = parseInt(tglJumlah15.val());
            var jp16 = parseInt(tglJumlah16.val());
            var jp17 = parseInt(tglJumlah17.val());
            var jp18 = parseInt(tglJumlah18.val());
            var jp19 = parseInt(tglJumlah19.val());
            var jp20 = parseInt(tglJumlah20.val());
            var jp21 = parseInt(tglJumlah21.val());
            var jp22 = parseInt(tglJumlah22.val());
            var jp23 = parseInt(tglJumlah23.val());
            var jp24 = parseInt(tglJumlah24.val());
            var jp25 = parseInt(tglJumlah25.val());
            var jp26 = parseInt(tglJumlah26.val());
         

            var jp28 = parseInt(tglJumlah28.val());

            var tanggalDiterimaP = $('#tanggal_diterima_panitia')
            var getTanggal = tanggalDiterimaP.val();
            var gTd = new Date(getTanggal);

            var tambahTgl0 = new Date(gTd.getFullYear(), gTd.getMonth(), gTd.getDate() + (jp0));
            var tambahTgl1 = new Date(gTd.getFullYear(), gTd.getMonth(), gTd.getDate() + (jp0 + jp1));
            var tambahTgl2 = new Date(gTd.getFullYear(), gTd.getMonth(), gTd.getDate() + (jp0 + jp1 + jp2));
            var tambahTgl3 = new Date(gTd.getFullYear(), gTd.getMonth(), gTd.getDate() + (jp0 + jp1 + jp2 + jp3));
            var tambahTgl5 = new Date(gTd.getFullYear(), gTd.getMonth(), gTd.getDate() + (jp0 + jp1 + jp2 + jp3 +  jp5));
            var tambahTgl6 = new Date(gTd.getFullYear(), gTd.getMonth(), gTd.getDate() + (jp0 + jp1 + jp2 + jp3 +  jp5 + jp6));
            var tambahTgl7 = new Date(gTd.getFullYear(), gTd.getMonth(), gTd.getDate() + (jp0 + jp1 + jp2 + jp3 +  jp5 + jp6 + jp7));
            var tambahTgl28 = new Date(gTd.getFullYear(), gTd.getMonth(), gTd.getDate() + (jp0 + jp1 + jp2 + jp3 +  jp5 + jp6 + jp7 + jp28));
            var tambahTgl8 = new Date(gTd.getFullYear(), gTd.getMonth(), gTd.getDate() + (jp0 + jp1 + jp2 + jp3 +  jp5 + jp6 + jp7 + jp8 + jp28));
            var tambahTgl9 = new Date(gTd.getFullYear(), gTd.getMonth(), gTd.getDate() + (jp0 + jp1 + jp2 + jp3 +  jp5 + jp6 + jp7 + jp8 + jp9+ jp28));
            var tambahTgl10 = new Date(gTd.getFullYear(), gTd.getMonth(), gTd.getDate() + (jp0 + jp1 + jp2 + jp3 +  jp5 + jp6 + jp7 + jp8 + jp9 + jp10+ jp28));
            var tambahTgl11 = new Date(gTd.getFullYear(), gTd.getMonth(), gTd.getDate() + (jp0 + jp1  + jp2 + jp3 +  jp5 + jp6 + jp7 + jp8 + jp9 + jp10 + jp11+ jp28));
            var tambahTgl12 = new Date(gTd.getFullYear(), gTd.getMonth(), gTd.getDate() + (jp0 + jp1  + jp2 + jp3 +  jp5 + jp6 + jp7 + jp8 + jp9 + jp10 + jp11 + jp12+ jp28));
            var tambahTgl13 = new Date(gTd.getFullYear(), gTd.getMonth(), gTd.getDate() + (jp0 + jp1  + jp2 + jp3 +  jp5 + jp6 + jp7 + jp8 + jp9 + jp10 + jp11 + jp12 + jp13+ jp28));
            var tambahTgl14 = new Date(gTd.getFullYear(), gTd.getMonth(), gTd.getDate() + (jp0 + jp1  + jp2 + jp3 +  jp5 + jp6 + jp7 + jp8 + jp9 + jp10 + jp11 + jp12 + jp13 + jp14+ jp28));
            var tambahTgl15 = new Date(gTd.getFullYear(), gTd.getMonth(), gTd.getDate() + (jp0 + jp1  + jp2 + jp3 +  jp5 + jp6 + jp7 + jp8 + jp9 + jp10 + jp11 + jp12 + jp13 + jp14 + jp15+ jp28));
            var tambahTgl16 = new Date(gTd.getFullYear(), gTd.getMonth(), gTd.getDate() + (jp0 + jp1  + jp2 + jp3 +  jp5 + jp6 + jp7 + jp8 + jp9 + jp10 + jp11 + jp12 + jp13 + jp14 + jp15 + jp16+ jp28));
            var tambahTgl17 = new Date(gTd.getFullYear(), gTd.getMonth(), gTd.getDate() + (jp0 + jp1  + jp2 + jp3 +  jp5 + jp6 + jp7 + jp8 + jp9 + jp10 + jp11 + jp12 + jp13 + jp14 + jp15 + jp16 + jp17+ jp28));
            var tambahTgl18 = new Date(gTd.getFullYear(), gTd.getMonth(), gTd.getDate() + (jp0 + jp1  + jp2 + jp3 +  jp5 + jp6 + jp7 + jp8 + jp9 + jp10 + jp11 + jp12 + jp13 + jp14 + jp15 + jp16 + jp17 + jp18+ jp28));
            var tambahTgl19 = new Date(gTd.getFullYear(), gTd.getMonth(), gTd.getDate() + (jp0 + jp1  + jp2 + jp3 +  jp5 + jp6 + jp7 + jp8 + jp9 + jp10 + jp11 + jp12 + jp13 + jp14 + jp15 + jp16 + jp17 + jp18 + jp19+ jp28));
            var tambahTgl20 = new Date(gTd.getFullYear(), gTd.getMonth(), gTd.getDate() + (jp0 + jp1  + jp2 + jp3 +  jp5 + jp6 + jp7 + jp8 + jp9 + jp10 + jp11 + jp12 + jp13 + jp14 + jp15 + jp16 + jp17 + jp18 + jp19 + jp20+ jp28));
            var tambahTgl21 = new Date(gTd.getFullYear(), gTd.getMonth(), gTd.getDate() + (jp0 + jp1  + jp2 + jp3 +  jp5 + jp6 + jp7 + jp8 + jp9 + jp10 + jp11 + jp12 + jp13 + jp14 + jp15 + jp16 + jp17 + jp18 + jp19 + jp20 + jp21+ jp28));
            var tambahTgl22 = new Date(gTd.getFullYear(), gTd.getMonth(), gTd.getDate() + (jp0 + jp1  + jp2 + jp3 +  jp5 + jp6 + jp7 + jp8 + jp9 + jp10 + jp11 + jp12 + jp13 + jp14 + jp15 + jp16 + jp17 + jp18 + jp19 + jp20 + jp21 + jp22+ jp28));
            var tambahTgl23 = new Date(gTd.getFullYear(), gTd.getMonth(), gTd.getDate() + (jp0 + jp1  + jp2 + jp3 +  jp5 + jp6 + jp7 + jp8 + jp9 + jp10 + jp11 + jp12 + jp13 + jp14 + jp15 + jp16 + jp17 + jp18 + jp19 + jp20 + jp21 + jp22 + jp23+ jp28));
            var tambahTgl24 = new Date(gTd.getFullYear(), gTd.getMonth(), gTd.getDate() + (jp0 + jp1  + jp2 + jp3 +  jp5 + jp6 + jp7 + jp8 + jp9 + jp10 + jp11 + jp12 + jp13 + jp14 + jp15 + jp16 + jp17 + jp18 + jp19 + jp20 + jp21 + jp22 + jp23 + jp24+ jp28));
            var tambahTgl25 = new Date(gTd.getFullYear(), gTd.getMonth(), gTd.getDate() + (jp0 + jp1  + jp2 + jp3 +  jp5 + jp6 + jp7 + jp8 + jp9 + jp10 + jp11 + jp12 + jp13 + jp14 + jp15 + jp16 + jp17 + jp18 + jp19 + jp20 + jp21 + jp22 + jp23 + jp24 + jp25+ jp28));
            var tambahTgl26 = new Date(gTd.getFullYear(), gTd.getMonth(), gTd.getDate() + (jp0 + jp1  + jp2 + jp3 +  jp5 + jp6 + jp7 + jp8 + jp9 + jp10 + jp11 + jp12 + jp13 + jp14 + jp15 + jp16 + jp17 + jp18 + jp19 + jp20 + jp21 + jp22 + jp23 + jp24 + jp25 + jp26+ jp28));
          
            $('#rks_tgl').datepicker('setDate', tambahTgl0);
            $('#survey_harga_pasar_tgl').datepicker('setDate', tambahTgl1);
            $('#hps_tgl').datepicker('setDate', tambahTgl2);
            $('#pengumuman_tgl').datepicker('setDate', tambahTgl3);
            $('#undangan_aanwijzing_direksi_pekerjaan_tgl').datepicker('setDate', tambahTgl5);
            $('#aanwijzing_tgl').datepicker('setDate', tambahTgl6);
            $('#addendum_rks_tgl').datepicker('setDate', tambahTgl7);
            $('#pemasukan_dok_penawaran_tgl_dari').datepicker('setDate', tambahTgl28);
            $('#pemasukan_dok_penawaran_tgl').datepicker('setDate', tambahTgl8);
            $('#pembukaan_penawaran_sampul_satu_tgl').datepicker('setDate', tambahTgl9);
            $('#evaluasi_dok_penawaran_sampul_satu_tgl').datepicker('setDate', tambahTgl10);
            $('#pengumuman_hasil_evaluasi_sampul_satu_tgl').datepicker('setDate', tambahTgl11);
            $('#pembukaan_penawaran_sampul_dua_tgl').datepicker('setDate', tambahTgl12);
            $('#evaluasi_dok_penawaran_sampul_dua_tgl').datepicker('setDate', tambahTgl13);
            $('#undangan_pembuktian_kualifikasi_tgl').datepicker('setDate', tambahTgl14);
            $('#pembuktian_kualifikasi_tgl').datepicker('setDate', tambahTgl15);
            $('#undangan_klarifikasi_dan_nego_penawaran_tgl').datepicker('setDate', tambahTgl16);
            $('#ba_hasil_klarifikasi_dan_nego_penawaran_tgl').datepicker('setDate', tambahTgl17);
            $('#laporan_hasil_evaluasi_tgl').datepicker('setDate', tambahTgl18);
            $('#nd_usulan_penetapan_calon_pemenang_tgl').datepicker('setDate', tambahTgl19);
            $('#nd_penetapan_calon_pemenang_tgl').datepicker('setDate', tambahTgl20);
            $('#pengumuman_calon_pemenang_tgl').datepicker('setDate', tambahTgl21);
            $('#penunjukan_pemenang_tgl').datepicker('setDate', tambahTgl22);
            $('#skkp_tgl').datepicker('setDate', tambahTgl23);
            $('#undangan_cda_tgl').datepicker('setDate', tambahTgl24);
            $('#cda_tgl').datepicker('setDate', tambahTgl25);
            $('#spk_tgl').datepicker('setDate', tambahTgl26);
       
            $('#rks_hari').val(hari[tambahTgl0.getDay()])
            $('#survey_harga_pasar_hari').val(hari[tambahTgl1.getDay()])
            $('#hps_hari').val(hari[tambahTgl2.getDay()]);
            $('#pengumuman_hari').val(hari[tambahTgl3.getDay()]);
            $('#undangan_aanwijzing_direksi_pekerjaan_hari').val(hari[tambahTgl5.getDay()]);
            $('#aanwijzing_hari').val(hari[tambahTgl6.getDay()]);
            $('#addendum_rks_hari').val(hari[tambahTgl7.getDay()]);
            $('#pemasukan_dok_penawaran_hari_dari').val(hari[tambahTgl28.getDay()]);
            $('#pemasukan_dok_penawaran_hari').val(hari[tambahTgl8.getDay()]);
            $('#pembukaan_penawaran_sampul_satu_hari').val(hari[tambahTgl9.getDay()]);
            $('#evaluasi_dok_penawaran_sampul_satu_hari').val(hari[tambahTgl10.getDay()]);
            $('#pengumuman_hasil_evaluasi_sampul_satu_hari').val(hari[tambahTgl11.getDay()]);
            $('#pembukaan_penawaran_sampul_dua_hari').val(hari[tambahTgl12.getDay()]);
            $('#evaluasi_dok_penawaran_sampul_dua_hari').val(hari[tambahTgl13.getDay()]);
            $('#undangan_pembuktian_kualifikasi_hari').val(hari[tambahTgl14.getDay()]);
            $('#pembuktian_kualifikasi_hari').val(hari[tambahTgl15.getDay()]);
            $('#undangan_klarifikasi_dan_nego_penawaran_hari').val(hari[tambahTgl16.getDay()]);
            $('#ba_hasil_klarifikasi_dan_nego_penawaran_hari').val(hari[tambahTgl17.getDay()]);
            $('#laporan_hasil_evaluasi_hari').val(hari[tambahTgl18.getDay()]);
            $('#nd_usulan_penetapan_calon_pemenang_hari').val(hari[tambahTgl19.getDay()]);
            $('#nd_penetapan_calon_pemenang_hari').val(hari[tambahTgl20.getDay()]);
            $('#pengumuman_calon_pemenang_hari').val(hari[tambahTgl21.getDay()]);
            $('#penunjukan_pemenang_hari').val(hari[tambahTgl22.getDay()]);
            $('#skkp_hari').val(hari[tambahTgl23.getDay()]);
            $('#undangan_cda_hari').val(hari[tambahTgl24.getDay()]);
            $('#cda_hari').val(hari[tambahTgl25.getDay()]);
            $('#spk_hari').val(hari[tambahTgl26.getDay()]);
         
        });

        var $nppv0 = $('#nppv0')
        var $nppv1 = $('#nppv1')
        var $nppv2 = $('#nppv2')
        var $nppv3 = $('#nppv3')
        var $nppv4 = $('#nppv4')
        var $nppv5 = $('#nppv5')
        var $nppv6 = $('#nppv6')
        var $nppv7 = $('#nppv7')
        var $nppv8 = $('#nppv8')
        var $nppv9 = $('#nppv9')
        var $nppv10 = $('#nppv10')
        var $nppv11 = $('#nppv11')
        var $nppv12 = $('#nppv12')
        var $nppv13 = $('#nppv13')
        var $nppv14 = $('#nppv14')
        var $nppv15 = $('#nppv15')
        var $nppv16 = $('#nppv16')
        var $nppv17 = $('#nppv17')
        var $nppv18 = $('#nppv18')
        var $nppv19 = $('#nppv19')
        var $nppv20 = $('#nppv20')
        var $nppv21 = $('#nppv21')
        var $nppv22 = $('#nppv22')
        var $nppv23 = $('#nppv23')
        var $nppv24 = $('#nppv24')
        var $nppv25 = $('#nppv25')
        var $nppv26 = $('#nppv26'), $value = $('.no_proses_pengadaan');
        $value.on('input', function (e) {
            var total = 1;
            $value.each(function (index, elem) {
                if (!Number.isNaN(parseInt(this.value, 10)))
                    total = total * parseInt(this.value, 10);
            });
            if ($('#fungsi_pembangkit').val() === 'Pembangkit') {
                $nppv0.val('0' + total + '.RKS/DAN.01.01/210200/' + $('#tahun').val());
                $nppv1.val('0' + total + '.BASVY-PL/DAN.02.01/210200/' + $('#tahun').val());
                $nppv2.val('0' + total + '.HPS-PL/DAN.02.01/210200/' + $('#tahun').val());
                $nppv3.val('0' + total + '.PENGLLNG/DAN.02.01/210200/' + $('#tahun').val());
                $nppv4.val('0' + total + '.UND/DAN.02.01/210200/' + $('#tahun').val());
                $nppv5.val('0' + total + '.UND/DAN.02.01/210200/' + $('#tahun').val());
                $nppv6.val('0' + total + '.BAANWZ/DAN.02.01/210200/' + $('#tahun').val());
                $nppv7.val('0' + total + '.RKS/DAN.02.01/210200/' + $('#tahun').val());
                $nppv8.val('0' + total + '.RKS/DAN.02.01/210200/' + $('#tahun').val());
                $nppv9.val('0' + total + '.BAPPS1/DAN.02.01/210200/' + $('#tahun').val());
                $nppv10.val('0' + total + '.BAEPS1/DAN.02.01/210200/' + $('#tahun').val());
                $nppv11.val('0' + total + '.PHES1/DAN.01.01/210200/' + $('#tahun').val());
                $nppv12.val('0' + total + '.BAPPS2/DAN.01.01/210200/' + $('#tahun').val());
                $nppv13.val('0' + total + '.BAEPS2/DAN.01.01/210200/' + $('#tahun').val());
                $nppv14.val('0' + total + '.UNDPK/DAN.01.01/210200/' + $('#tahun').val());
                $nppv15.val('0' + total + '.BAPK/DAN.01.01/210200/' + $('#tahun').val());
                $nppv16.val('0' + total + '.UNDKTNH/DAN.01.01/210200/' + $('#tahun').val());
                $nppv17.val('0' + total + '.BAHKTNH/DAN.01.01/210200/' + $('#tahun').val());
                $nppv18.val('0' + total + '.LHE/DAN.01.01/210200/' + $('#tahun').val());
                $nppv19.val('0' + total + '.NDUP/DAN.01.01/210200/' + $('#tahun').val());
                $nppv20.val('0' + total + '.NDP/DAN.01.01/210200/' + $('#tahun').val());
                $nppv21.val('0' + total + '.PENGHP/DAN.01.01/210200/' + $('#tahun').val());
                $nppv22.val('0' + total + '.SPPBJ/DAN.01.01/210200/' + $('#tahun').val());
                $nppv23.val('0' + total + '.K/DAN.01.01/210200/' + $('#tahun').val());
                $nppv24.val('0' + total + '.UNDCDA/DAN.01.01/210200/' + $('#tahun').val());
                $nppv25.val('0' + total + '.BACDA/DAN.01.01/210200/' + $('#tahun').val());
                $nppv26.val('0' + total + '.SPK/DAN.02.01/210200/' + $('#tahun').val());

            } else if ($('#fungsi_pembangkit').val() === 'Sarana') {
                $nppv0.val('0' + total + '.RKS/DAN.01.06/210200/' + $('#tahun').val());
                $nppv1.val('0' + total + '.BASVY-PL/DAN.02.07/210200/' + $('#tahun').val());
                $nppv2.val('0' + total + '.HPS-PL/DAN.02.07/210200/' + $('#tahun').val());
                $nppv3.val('0' + total + '.PENGLLNG/DAN.07.01/210200/' + $('#tahun').val());
                $nppv4.val('0' + total + '.UND/DAN.02.07/210200/' + $('#tahun').val());
                $nppv5.val('0' + total + '.UND/DAN.02.07/210200/' + $('#tahun').val());
                $nppv6.val('0' + total + '.BAANWZ/DAN.02.07/210200/' + $('#tahun').val());
                $nppv7.val('0' + total + '.RKS/DAN.02.07/210200/' + $('#tahun').val());
                $nppv9.val('0' + total + '.BAPPS1/DAN.02.07/210200/' + $('#tahun').val());
                $nppv10.val('0' + total + '.BAEPS1/DAN.02.07/210200/' + $('#tahun').val());
                $nppv11.val('0' + total + '.PHES1/DAN.02.07/210200/' + $('#tahun').val());
                $nppv12.val('0' + total + '.BAPPS2/DAN.02.07/210200/' + $('#tahun').val());
                $nppv13.val('0' + total + '.BAEPS2/DAN.02.07/210200/' + $('#tahun').val());
                $nppv14.val('0' + total + '.UNDPK/DAN.02.07/210200/' + $('#tahun').val());
                $nppv15.val('0' + total + '.BAPK/DAN.02.07/210200/' + $('#tahun').val());
                $nppv16.val('0' + total + '.UNDKTNH/DAN.02.07/210200/' + $('#tahun').val());
                $nppv17.val('0' + total + '.BAHKTNH/DAN.02.07/210200/' + $('#tahun').val());
                $nppv18.val('0' + total + '.LHE/DAN.02.07/210200/' + $('#tahun').val());
                $nppv19.val('0' + total + '.NDUP/DAN.02.07/210200/' + $('#tahun').val());
                $nppv20.val('0' + total + '.NDP/DAN.02.07/210200/' + $('#tahun').val());
                $nppv21.val('0' + total + '.PENGHP/DAN.02.07/210200/' + $('#tahun').val());
                $nppv22.val('0' + total + '.SPPBJ/DAN.02.07/210200/' + $('#tahun').val());
                $nppv23.val('0' + total + '.K/DAN.02.07/210200/' + $('#tahun').val());
                $nppv24.val('0' + total + '.UNDCDA/DAN.02.07/210200/' + $('#tahun').val());
                $nppv25.val('0' + total + '.BACDA/DAN.02.07/210200/' + $('#tahun').val());
                $nppv26.val('0' + total + '.SPK/DAN.02.01/210200/' + $('#tahun').val());
            }
        });


    });
</script>
