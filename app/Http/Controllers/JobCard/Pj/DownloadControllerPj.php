<?php


namespace App\Http\Controllers\JobCard\Pj;


use App\Http\Controllers\Controller;
use App\Http\Controllers\Template\TanggalIndo;
use App\Pengadaan;
use App\PengadaanDetailPj;
use App\Perusahaan;
use Novay\WordTemplate\WordTemplate;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use App\ModelsResource\DMetodePengadaan;
use App\Http\Controllers\Template\TerbilangIndo;
class DownloadControllerPj extends Controller
{

    public function downloadPjBarang()
    {
      
        $word = new WordTemplate();
        $file = public_path('spk/spk-barang.doc');


        $nama_file = 'spk-barang.doc';
        $headers = array(
            'Content-Type: application/doc',
          );
        return response()->download($file, $nama_file, $headers);
    }

    public function downloadDaftarKuantitas()
    {
      
        $word = new WordTemplate();
        $file = public_path('spk/daftar-kuantitas.xlsx');


        $nama_file = 'daftar-kuantitas.xlsx';
        $headers = array(
            'Content-Type: application/xlsx',
          );
        return response()->download($file, $nama_file, $headers);
    }

    public function downloadSurveyHargaPasar($id)
    {
        $data = Pengadaan::where('id', $id)->first();
        $dataDetail = PengadaanDetailPj::where('id_pengadaan', $id)->first();

        $tanggalIndo = new TanggalIndo();

        $tanggal = $tanggalIndo->tgl_aja($dataDetail->survey_harga_pasar_tgl);
        $bulan = $tanggalIndo->bln_aja($dataDetail->survey_harga_pasar_tgl);
        $tahun = $tanggalIndo->thn_aja($dataDetail->survey_harga_pasar_tgl);

        $word = new WordTemplate();
        $file = public_path('doc/spk/survey_harga_pasar.rtf');

        $array = array(
            '[Judul]' => $data->judul,
            '[Hari]' => $dataDetail->survey_harga_pasar_hari,
            '[Tanggal]' => $tanggalIndo->terbilang($tanggal),
            '[Bulan]' => $bulan,
            '[Tahun]' => $tanggalIndo->terbilang($tahun),
            '[Judul1]' => $data->judul,
            '[Pejabat_Pelaksana]' => $data->pejabat_pelaksana,
            '[Pengawas]' => $data->pengawas,

        );

        $nama_file = 'survey-harga-pasar.doc';

        return $word->export($file, $array, $nama_file);
    }

    public function downloadSurveyHargaPasar2($id)
    {
        $data = Pengadaan::where('id', $id)->first();
        $dataDetail = PengadaanDetailPj::where('id_pengadaan', $id)->first();

        $tanggalIndo = new TanggalIndo();

        $tanggal = $tanggalIndo->tgl_aja($dataDetail->survey_harga_pasar_tgl);
        $bulan = $tanggalIndo->bln_aja($dataDetail->survey_harga_pasar_tgl);
        $tahun = $tanggalIndo->thn_aja($dataDetail->survey_harga_pasar_tgl);
        $gabungan = $tanggal . ' ' . $bulan . ' ' . $tahun;

        $word = new WordTemplate();
        $file = public_path('doc/spk/survey_harga_pasar2.rtf');

        $array = array(
            '[Tanggal_shp]' => $gabungan,
            '[Tempat_Pengadaan]' => $data->tempat_penyerahan,
        );

        $nama_file = 'survey-harga-pasar2.doc';

        return $word->export($file, $array, $nama_file);
    }

    public function downloadRks($id)
    {
        $data = Pengadaan::with('getmp2')->where('id', $id)->first();
        $dataDetail = PengadaanDetailPj::where('id_pengadaan', $id)->first();

        $tanggalIndo = new TanggalIndo();

        $tanggal = $tanggalIndo->tgl_aja($dataDetail->rks_tgl);
        $bulan = $tanggalIndo->bln_aja($dataDetail->rks_tgl);
        $tahun = $tanggalIndo->thn_aja($dataDetail->rks_tgl);

        $gabungan = $tanggal . ' ' . $bulan . ' ' . $tahun;

        $word = new WordTemplate();
        $file = public_path('doc/spk/rks.rtf');

        $array = array(
            '[Judul]' => $data->judul,
            '[Nomor_Rks]' => $dataDetail->rks_nomor,
            '[Tanggal_Rks]' => $gabungan,
            '[Tahun_Anggaran]' => $data->tahun,
            '[Metode_Pengadaan]' => $data['getmp2']['nama'],
            '[Metode_Pembayaran]' => $data->cara_pembayaran,
            '[Alamat]' => $data->tempat_penyerahan,
            '[Jangka_Waktu]' => $data->rencana,
            '[Alamat_Pelaksana]' => $data->tempat_penyerahan,
            '[Manager_Bagian]' => $data->pejabata_pelaksana,
            '[Manager]' => $data->direksi,
            '[Masa_Garansi]' => $data->masa_garansi

        );

        $nama_file = 'rks.doc';

        return $word->export($file, $array, $nama_file);
    }

    public function downloadHps($id)
    {
        $data = Pengadaan::with('getmp2')->where('id', $id)->first();
        $dataDetail = PengadaanDetailPj::where('id_pengadaan', $id)->first();

        $spreadsheet = new Spreadsheet();

        $loadFile = public_path('doc/pj/hps/hps.xls');
        $sSheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($loadFile);
        $worksheet = $sSheet->getSheetByName('HPS');
        $worksheet->setCellValue('F8', $dataDetail->hps_nomor);
        $worksheet->setCellValue('D15', $data->sumber_dana);
        $worksheet->setCellValue('D16', $data->tahun);

        $worksheet->setCellValue('B45', $data->manager);
        $worksheet->setCellValue('G45', $data->tahun);


        $date = date('d-m-y-' . substr((string)microtime(), 1, 8));
        $date = str_replace(".", "", $date);
        $filename = "export_" . $date . ".xlsx";

        try {
            $writer = new Xlsx($sSheet);
            $writer->save($filename);
            $content = file_get_contents($filename);
        } catch (Exception $e) {
            exit($e->getMessage());
        }

        header("Content-Disposition: attachment; filename=" . $filename);

        unlink($filename);
        exit($content);


    }


    public function downloadPengumuman($id)
    {
        $data = Pengadaan::with('getmp2')->where('id', $id)->first();
        $dataDetail = PengadaanDetailPj::where('id_pengadaan', $id)->first();

        $tanggalIndo = new TanggalIndo();
        $tanggalPendaftaran = $tanggalIndo->tgl_aja($data->tgl_mulai);
        $bulanPendaftaran = $tanggalIndo->bln_aja($data->tgl_mulai);
        $tahunPendaftaran = $tanggalIndo->thn_aja($data->tgl_mulai);
        $gabunganPendaftaran = $tanggalPendaftaran . ' ' . $bulanPendaftaran . ' ' . $tahunPendaftaran;

        $tanggalRks = $tanggalIndo->tgl_aja($dataDetail->rks_tgl);
        $bulanRks = $tanggalIndo->bln_aja($dataDetail->rks_tgl);
        $tahunRks = $tanggalIndo->thn_aja($dataDetail->rks_tgl);
        $gabunganRks = $tanggalRks . ' ' . $bulanRks . ' ' . $tahunRks;

        $tanggalAanwijzing = $tanggalIndo->tgl_aja($dataDetail->aanwijzing_tgl);
        $bulanAanwijzing = $tanggalIndo->bln_aja($dataDetail->aanwijzing_tgl);
        $tahunAanwijzing = $tanggalIndo->thn_aja($dataDetail->aanwijzing_tgl);
        $gabunganAanwijzing = $tanggalAanwijzing . ' ' . $bulanAanwijzing . ' ' . $tahunAanwijzing;

        $word = new WordTemplate();
        $file = public_path('doc/pj/pengumuman.rtf');

        $array = array(
            '[Pengumuman_Nomor]' => $dataDetail->pengumuman_nomor,
            '[Sumber_Pendanaan]' => $data->sumber_dana,
            '[Tahun]' => $data->tahun,
            '[JUDUL]' => $data->judul,
            '[PENDAFTARANTGL]' => $gabunganPendaftaran,
            '[RKSTGL]' => $gabunganRks,
            '[AANWIJZINGTGL]' => $gabunganAanwijzing,


        );

        $nama_file = 'pengumuman.doc';

        return $word->export($file, $array, $nama_file);

    }

    public function downloadUndanganCda($id)
    {
        $data = Pengadaan::where('id', $id)->first();
        $dataDetail = PengadaanDetailPj::where('id_pengadaan', $id)->first();

        $tanggalIndo = new TanggalIndo();

        $tanggal = $tanggalIndo->tgl_aja($dataDetail->cda_tgl);
        $bulan = $tanggalIndo->bln_aja($dataDetail->cda_tgl);
        $tahun = $tanggalIndo->thn_aja($dataDetail->cda_tgl);
        $gabungan = $tanggal . ' ' . $bulan . ' ' . $tahun;

      
        $word = new WordTemplate();
        $file = public_path('doc/pj/cda/und_cda.rtf');

        $array = array(
            '[nomor]' => $dataDetail->cda_nomor,
            '[judul]' => $data->judul,
            '[hari]' => $dataDetail->cda_hari,
            '[manager]' => $data->direksi,
            '[tanggal]' => $gabungan,
          

        );

        $nama_file = 'undangan-cda.doc';

        return $word->export($file, $array, $nama_file);
    }

    public function downloadBeritaAcaraCda($id)
    {
        $data = Pengadaan::where('id', $id)->first();
        $dataDetail = PengadaanDetailPj::where('id_pengadaan', $id)->first();
        $perusahaan = Perusahaan::where('id', $data->id_perusahaan)->first();

        $tanggalIndo = new TanggalIndo();

        $tanggal = $tanggalIndo->tgl_aja($dataDetail->cda_tgl);
        $bulan = $tanggalIndo->bln_aja($dataDetail->cda_tgl);
        $tahun = $tanggalIndo->thn_aja($dataDetail->cda_tgl);
        $gabungan = $tanggal . ' ' . $bulan . ' ' . $tahun;

        $tanggal1 = $tanggalIndo->tgl_aja($dataDetail->addendum_rks_tgl);
        $bulan1 = $tanggalIndo->bln_aja($dataDetail->addendum_rks_tgl);
        $tahun1 = $tanggalIndo->thn_aja($dataDetail->addendum_rks_tgl);
        $gabungan1 = $tanggal1 . ' ' . $bulan1 . ' ' . $tahun1;

        $word = new WordTemplate();
        $file = public_path('doc/pj/cda/berita_acara_cda.rtf');

        $array = array(
            '[nomor_cda]' => $dataDetail->cda_nomor,
            '[judul]' => $data->judul,
            '[hari_cda]' => $dataDetail->cda_hari,
            '[bulan_cda]' => $bulan,
            '[tahun_cda]' => $tahun,
            '[tanggal_cda]' => $tanggal,
            '[nomor_rks]' => $dataDetail->addendum_rks_nomor,
            '[tanggal_rks]' => $gabungan1,
            '[manager_perusahaan]' => $perusahaan->pimpinan,
            '[pejabat_pelaksana]' => $data->pejabat_pelaksana,
            '[manager]' => $data->direksi,
            '[tanggal_gabungan]' => $gabungan
        );

        $nama_file = 'berita-cda.doc';

        return $word->export($file, $array, $nama_file);
    }

    public function downloadDaftarHadirPelaksanaCda($id)
    {
        $data = Pengadaan::where('id', $id)->first();
        $dataDetail = PengadaanDetailPj::where('id_pengadaan', $id)->first();

        $tanggalIndo = new TanggalIndo();

        $tanggal = $tanggalIndo->tgl_aja($dataDetail->cda_tgl);
        $bulan = $tanggalIndo->bln_aja($dataDetail->cda_tgl);
        $tahun = $tanggalIndo->thn_aja($dataDetail->cda_tgl);
        $gabungan = $tanggal . ' ' . $bulan . ' ' . $tahun;

        $word = new WordTemplate();
        $file = public_path('doc/pj/cda/daftar_hadir_pelaksana_pengadaan.rtf');

        $array = array(
            '[hari]' => $dataDetail->cda_hari,
            '[tanggal_gabungan_cda]' => $gabungan,
            '[pejabat_pelaksana]' => $data->pejabat_pelaksana,
            '[pic_pelaksana]' => $data->pic_pelaksana,
            '[Judul]' => $data->judul,
        );

        $nama_file = 'daftar_hadir_pelaksana_pengadaan.doc';

        return $word->export($file, $array, $nama_file);
    }

    public function downloadDaftarHadirPenyediaCda($id)
    {
        $data = Pengadaan::where('id', $id)->first();
        $dataDetail = PengadaanDetailPj::where('id_pengadaan', $id)->first();

        $tanggalIndo = new TanggalIndo();

        $tanggal = $tanggalIndo->tgl_aja($dataDetail->cda_tgl);
        $bulan = $tanggalIndo->bln_aja($dataDetail->cda_tgl);
        $tahun = $tanggalIndo->thn_aja($dataDetail->cda_tgl);
        $gabungan = $tanggal . ' ' . $bulan . ' ' . $tahun;

        $word = new WordTemplate();
        $file = public_path('doc/pj/cda/daftar_hadir_penyedia_barang_dan_jasa.rtf');

        $array = array(
            '[hari]' => $dataDetail->cda_hari,
            '[tanggal_gabungan_cda]' => $gabungan,
            '[Judul]' => $data->judul,
        );

        $nama_file = 'daftar_hadir_penyedia_barang_dan_jasa.doc';

        return $word->export($file, $array, $nama_file);

    }

    public function downloadNdUsulanCalon($id)
    {
        $data = Pengadaan::where('id', $id)->first();
        $dataDetail = PengadaanDetailPj::where('id_pengadaan', $id)->first();
        $perusahaan = Perusahaan::where('id', $data->id_perusahaan)->first();
        $dataPekerjaan = DMetodePengadaan::where('id', $data->id_mp4)->first();
        $dataTender = DMetodePengadaan::where('id', $data->id_mp2)->first();
        $tanggalIndo = new TanggalIndo();
        $terbilangIndo = new TerbilangIndo();

        $tanggal = $tanggalIndo->tgl_aja($dataDetail->nd_usulan_penetapan_calon_pemenang_tgl);
        $bulan = $tanggalIndo->bln_aja($dataDetail->nd_usulan_penetapan_calon_pemenang_tgl);
        $tahun = $tanggalIndo->thn_aja($dataDetail->nd_usulan_penetapan_calon_pemenang_tgl);
        $gabungan = $tanggal . ' ' . $bulan . ' ' . $tahun;

        $tanggal1 = $tanggalIndo->tgl_aja($dataDetail->rks_tgl);
        $bulan1 = $tanggalIndo->bln_aja($dataDetail->rks_tgl);
        $tahun1 = $tanggalIndo->thn_aja($dataDetail->rks_tgl);
        $gabungan1 = $tanggal1 . ' ' . $bulan1 . ' ' . $tahun1;

        $word = new WordTemplate();
        $file = public_path('doc/pj/usulan_penetapan_pemenang.rtf');

        $hargaPenawaran = $data->harga_penawaran;
        $hargaPenawaranTerbilang =  $terbilangIndo->terbilang($hargaPenawaran);
        $jangawaktu = $data->jangka_waktu;
        $jangkawaktuterbilang =  $terbilangIndo->terbilang($jangawaktu);
        $array = array(
            '[usulan_calon_nomor]' => $dataDetail->nd_usulan_penetapan_calon_pemenang_nomor,
            '[judul]' => $data->judul,
            '[nomorrks]' => $dataDetail->rks_nomor,
            '[tanggal_gabungan_rks]' => $gabungan1,
            '[perusahaan_nama]' => $perusahaan->nama,
            '[perusahaan_alamat]' => $perusahaan->alamat,
            '[perusahaan_npwp]' => $perusahaan->npwp,
            '[tanggal_gabungan_usulan]' => $gabungan,
            '[metode]' => $dataPekerjaan->nama,
            '[hargapenawaran]' => $data->harga_penawaran,
            '[hargapenawaranterbilang]' =>$hargaPenawaranTerbilang,
            '[tender]' => $dataTender->nama,
            '[direksi]' => $data->direksi,
            '[jangkawaktu]' =>$jangawaktu,
            '[jangkawaktuterbilang]' => $jangkawaktuterbilang
        );

        $nama_file = 'usulan_penetapan_pemenang.doc';

        return $word->export($file, $array, $nama_file);
    }

    public function downloadNdPenetapanPemenang($id)
    {
        $data = Pengadaan::where('id', $id)->first();
        $dataDetail = PengadaanDetailPj::where('id_pengadaan', $id)->first();
        $perusahaan = Perusahaan::where('id', $data->id_perusahaan)->first();
        $terbilangIndo = new TerbilangIndo();
        $dataPekerjaan = DMetodePengadaan::where('id', $data->id_mp4)->first();
        $dataTender = DMetodePengadaan::where('id', $data->id_mp2)->first();
        $tanggalIndo = new TanggalIndo();

        $tanggal = $tanggalIndo->tgl_aja($dataDetail->nd_penetapan_calon_pemenang_tgl);
        $bulan = $tanggalIndo->bln_aja($dataDetail->nd_penetapan_calon_pemenang_tgl);
        $tahun = $tanggalIndo->thn_aja($dataDetail->nd_penetapan_calon_pemenang_tgl);
        $gabungan = $tanggal . ' ' . $bulan . ' ' . $tahun;

        $tanggal1 = $tanggalIndo->tgl_aja($dataDetail->addendum_rks_tgl);
        $bulan1 = $tanggalIndo->bln_aja($dataDetail->addendum_rks_tgl);
        $tahun1 = $tanggalIndo->thn_aja($dataDetail->addendum_rks_tgl);
        $gabungan1 = $tanggal1 . ' ' . $bulan1 . ' ' . $tahun1;

        $hargaPenawaran = $data->harga_penawaran;
        $hargaPenawaranTerbilang =  $terbilangIndo->terbilang($hargaPenawaran);

        $word = new WordTemplate();
        $file = public_path('doc/pj/penetapan_pemenang.rtf');

        $array = array(
            '[pemenang_nomor]' => $dataDetail->nd_penetapan_calon_pemenang_nomor,
            '[judul]' => $data->judul,
            '[nomorrks]' => $dataDetail->rks_nomor,
            '[tgl_gabungan_rks]' => $gabungan1,
            '[perusahaan_nama]' => $perusahaan->nama,
            '[perusahaan_alamat]' => $perusahaan->alamat,
            '[perusahaan_npwp]' => $perusahaan->npwp,
            '[tgl_gabungan_pemenang]' => $gabungan,
            '[hargapenawaran]' => $data->harga_penawaran,
            '[hargapenawaranterbilang]' =>$hargaPenawaranTerbilang,
            '[metode]' => $dataPekerjaan->nama,
            '[tender]' => $dataTender->nama,
            '[manager]' => $data->direksi
        );

        $nama_file = 'penetapan_pemenang.doc';

        return $word->export($file, $array, $nama_file);
    }

    public function downloadLaporanHasilEvaluasi($id)
    {
        $data = Pengadaan::where('id', $id)->first();
        $dataDetail = PengadaanDetailPj::where('id_pengadaan', $id)->first();
        $perusahaan = Perusahaan::where('id', $data->id_perusahaan)->first();
        $dataTender = DMetodePengadaan::where('id', $data->id_mp2)->first();
        $tanggalIndo = new TanggalIndo();
        $terbilangIndo = new TerbilangIndo();

        $tanggal = $tanggalIndo->tgl_aja($dataDetail->nd_usulan_penetapan_calon_pemenang_tgl);
        $bulan = $tanggalIndo->bln_aja($dataDetail->nd_usulan_penetapan_calon_pemenang_tgl);
        $tahun = $tanggalIndo->thn_aja($dataDetail->nd_usulan_penetapan_calon_pemenang_tgl);
        $gabungan = $tanggal . ' ' . $bulan . ' ' . $tahun;

        $tanggal1 = $tanggalIndo->tgl_aja($dataDetail->addendum_rks_tgl);
        $bulan1 = $tanggalIndo->bln_aja($dataDetail->addendum_rks_tgl);
        $tahun1 = $tanggalIndo->thn_aja($dataDetail->addendum_rks_tgl);
        $gabungan1 = $tanggal1 . ' ' . $bulan1 . ' ' . $tahun1;

        $tanggal2 = $tanggalIndo->tgl_aja($dataDetail->pengumuman_tgl);
        $bulan2 = $tanggalIndo->bln_aja($dataDetail->pengumuman_tgl);
        $tahun2 = $tanggalIndo->thn_aja($dataDetail->pengumuman_tgl);
        $gabungan2 = $tanggal2 . ' ' . $bulan2 . ' ' . $tahun2;


        $tanggal3 = $tanggalIndo->tgl_aja($dataDetail->aanwijzing_tgl);
        $bulan3 = $tanggalIndo->bln_aja($dataDetail->aanwijzing_tgl);
        $tahun3 = $tanggalIndo->thn_aja($dataDetail->aanwijzing_tgl);
        $gabungan3 = $tanggal3 . ' ' . $bulan3 . ' ' . $tahun3;

        $tanggal4 = $tanggalIndo->tgl_aja($dataDetail->pembukaan_penawaran_sampul_dua_tgl);
        $bulan4 = $tanggalIndo->bln_aja($dataDetail->pembukaan_penawaran_sampul_dua_tgl);
        $tahun4 = $tanggalIndo->thn_aja($dataDetail->pembukaan_penawaran_sampul_dua_tgl);
        $gabungan4 = $tanggal4 . ' ' . $bulan4 . ' ' . $tahun4;


        $tanggal5 = $tanggalIndo->tgl_aja($dataDetail->pengumuman_hasil_evaluasi_sampul_satu_tgl);
        $bulan5 = $tanggalIndo->bln_aja($dataDetail->pengumuman_hasil_evaluasi_sampul_satu_tgl);
        $tahun5 = $tanggalIndo->thn_aja($dataDetail->pengumuman_hasil_evaluasi_sampul_satu_tgl);
        $gabungan5 = $tanggal5 . ' ' . $bulan5 . ' ' . $tahun5;

        $tanggal6 = $tanggalIndo->tgl_aja($dataDetail->pemasukan_dok_penawaran_tgl_dari);
        $bulan6 = $tanggalIndo->bln_aja($dataDetail->pemasukan_dok_penawaran_tgl_dari);
        $tahun6 = $tanggalIndo->thn_aja($dataDetail->pemasukan_dok_penawaran_tgl_dari);
        $gabungan6 = $tanggal6 . ' ' . $bulan6 . ' ' . $tahun6;


        $tanggal7 = $tanggalIndo->tgl_aja($dataDetail->pemasukan_dok_penawaran_tgl);
        $bulan7 = $tanggalIndo->bln_aja($dataDetail->pemasukan_dok_penawaran_tgl);
        $tahun7 = $tanggalIndo->thn_aja($dataDetail->pemasukan_dok_penawaran_tgl);
        $gabungan7 = $tanggal7 . ' ' . $bulan7 . ' ' . $tahun7;

        $tanggal8 = $tanggalIndo->tgl_aja($dataDetail->rks_tgl);
        $bulan8 = $tanggalIndo->bln_aja($dataDetail->rks_tgl);
        $tahun8 = $tanggalIndo->thn_aja($dataDetail->rks_tgl);
        $gabungan8 = $tanggal8 . ' ' . $bulan8 . ' ' . $tahun8;

        $tanggal9 = $tanggalIndo->tgl_aja($dataDetail->laporan_hasil_evaluasi_tgl);
        $bulan9 = $tanggalIndo->bln_aja($dataDetail->laporan_hasil_evaluasi_tgl);
        $tahun9 = $tanggalIndo->thn_aja($dataDetail->laporan_hasil_evaluasi_tgl);
        $gabungan9 = $tanggal9 . ' ' . $bulan9 . ' ' . $tahun9;

        
        $hargaPenawaran = $data->harga_penawaran;
        $hargaPenawaranTerbilang = $terbilangIndo->terbilang($hargaPenawaran);

        $hargakontrak = $data->harga_kontrak;
        $hargakontrakTerbilang = $terbilangIndo->terbilang($hargakontrak);

        $jangawaktu = $data->jangka_waktu;
        $jangkawaktuterbilang =  $terbilangIndo->terbilang($jangawaktu);

        $word = new WordTemplate();
        $file = public_path('doc/pj/laporan_hasil_evaluasi.rtf');

        $array = array(
            '[judul]' => $data->judul,
            '[laporan_nomor]' => $dataDetail->laporan_hasil_evaluasi_nomor,
            '[rks_nomor]' => $dataDetail->addendum_rks_nomor,
            '[rksgabungantgl]' => $gabungan1,
            '[rks_awal_tgl]' => $gabungan8,
            '[pengumuman_nomor]' => $dataDetail->pengumuman_nomor,
            '[pengumuman_gabungan_tgl]' => $gabungan2,
            '[aanwijzing_nomor]' => $dataDetail->aanwijzing_nomor,
            '[aanwijzing_gabungan_tgl]' => $gabungan3,
            '[pembukaan_penawaran_sampul_dua_nomor]' => $dataDetail->pembukaan_penawaran_sampul_dua_nomor,
            '[gabunganempat]' => $gabungan4,
            '[pengumuman_hasil_evaluasi_sampul_satu_nomor]' => $dataDetail->pengumuman_hasil_evaluasi_sampul_satu_nomor,
            '[gabunganlima]' => $gabungan5,
            '[pemasukan_dok_penawaran_tgl_dari]' => $gabungan6,
            '[pemasukan_dok_penawaran_tgl]' =>  $gabungan7,
            '[laporan_hasil_evaluasi_tgl]' => $gabungan9,
            '[pejabat_pelaksana]' => $data->pejabat_pelaksana,
            '[assistant]' => $data->pic_pelaksana,
            '[perusahaannama]' => $perusahaan->nama,
            '[perusahaannpwp]' => $perusahaan->npwp,
            '[perusahaanalamat]' => $perusahaan->alamat,
            '[hargapenawaran]' => $hargaPenawaran,
            '[hargapenawaranterbilang]' => $hargaPenawaranTerbilang,
            '[hargakontrak]' => $hargakontrak,
            '[hargakontrakterbilang]' => $hargakontrakTerbilang,
            '[jangkawaktu]' =>$jangawaktu,
            '[jangkawaktuterbilang]' => $jangkawaktuterbilang,
            '[hps]' => $data->hps,
            '[nilaijaminan]' =>  $data->nilai_jaminan,
            '[tender]' => $dataTender->nama

        );

        $nama_file = 'laporan_hasil_evaluasi.doc';

        return $word->export($file, $array, $nama_file);
    }

    public function downloadUndanganHasilKlarifikasi($id)
    {
        $data = Pengadaan::where('id', $id)->first();
        $dataDetail = PengadaanDetailPj::where('id_pengadaan', $id)->first();
        $dataPekerjaan = DMetodePengadaan::where('id', $data->id_mp4)->first();
        $dataTender = DMetodePengadaan::where('id', $data->id_mp2)->first();

        $tanggalIndo = new TanggalIndo();

        $tanggal = $tanggalIndo->tgl_aja($dataDetail->undangan_klarifikasi_dan_nego_penawaran_tgl);
        $bulan = $tanggalIndo->bln_aja($dataDetail->undangan_klarifikasi_dan_nego_penawaran_tgl);
        $tahun = $tanggalIndo->thn_aja($dataDetail->undangan_klarifikasi_dan_nego_penawaran_tgl);
        $gabungan = $tanggal . ' ' . $bulan . ' ' . $tahun;

        $tanggal1 = $tanggalIndo->tgl_aja($dataDetail->rks_tgl);
        $bulan1 = $tanggalIndo->bln_aja($dataDetail->rks_tgl);
        $tahun1 = $tanggalIndo->thn_aja($dataDetail->rks_tgl);
        $gabungan1 = $tanggal1 . ' ' . $bulan1 . ' ' . $tahun1;

        $word = new WordTemplate();
        $file = public_path('doc/pj/klarifikasi_dan_nego/undangan_klarifikasi_negosiasi.rtf');

        $array = array(
            '[nomor]' => $dataDetail->undangan_klarifikasi_dan_nego_penawaran_nomor,
            '[rks_nomor]' => $dataDetail->rks_nomor,
            '[judul]' => $data->judul,
            '[hari]' => $dataDetail->undangan_klarifikasi_dan_nego_penawaran_hari,
            '[manager]' => $data->direksi,
            '[tanggal]' => $gabungan,
            '[rks_gabungan_tgl]' => $gabungan1,
            '[metode]' => $dataPekerjaan->nama,
            '[tender]' => $dataTender->nama
        );

        $nama_file = 'undangan_klarifikasi_negosiasi.doc';

        return $word->export($file, $array, $nama_file);
    }

    public function downloadDaftarHadirPelaksanaKlarifikasi($id)
    {
        $data = Pengadaan::where('id', $id)->first();
        $dataDetail = PengadaanDetailPj::where('id_pengadaan', $id)->first();

        $tanggalIndo = new TanggalIndo();

        $tanggal = $tanggalIndo->tgl_aja($dataDetail->undangan_klarifikasi_dan_nego_penawaran_tgl);
        $bulan = $tanggalIndo->bln_aja($dataDetail->undangan_klarifikasi_dan_nego_penawaran_tgl);
        $tahun = $tanggalIndo->thn_aja($dataDetail->undangan_klarifikasi_dan_nego_penawaran_tgl);
        $gabungan = $tanggal . ' ' . $bulan . ' ' . $tahun;

        $word = new WordTemplate();
        $file = public_path('doc/pj/klarifikasi_dan_nego/daftar_hadir_pelaksana_klarifikasi.rtf');

        $array = array(
            '[hari]' => $dataDetail->undangan_klarifikasi_dan_nego_penawaran_hari,
            '[tanggal]' => $gabungan,
            '[pejabat_pelaksana]' => $data->pejabat_pelaksana,
            '[pic_pelaksana]' => $data->pic_pelaksana,
            '[Judul]' => $data->judul,
        );

        $nama_file = 'daftar_hadir_pelaksana_klarifikasi.doc';

        return $word->export($file, $array, $nama_file);
    }

    public function downloadDaftarHadirPenyediaKlarifikasi($id)
    {
        $data = Pengadaan::where('id', $id)->first();
        $dataDetail = PengadaanDetailPj::where('id_pengadaan', $id)->first();

        $tanggalIndo = new TanggalIndo();

        $tanggal = $tanggalIndo->tgl_aja($dataDetail->undangan_klarifikasi_dan_nego_penawaran_tgl);
        $bulan = $tanggalIndo->bln_aja($dataDetail->undangan_klarifikasi_dan_nego_penawaran_tgl);
        $tahun = $tanggalIndo->thn_aja($dataDetail->undangan_klarifikasi_dan_nego_penawaran_tgl);
        $gabungan = $tanggal . ' ' . $bulan . ' ' . $tahun;

        $word = new WordTemplate();
        $file = public_path('doc/pj/klarifikasi_dan_nego/daftar_hadir_penyedia_klarifikasi.rtf');

        $array = array(
            '[hari]' => $dataDetail->undangan_klarifikasi_dan_nego_penawaran_hari,
            '[tanggal]' => $gabungan,
            '[Judul]' => $data->judul,
        );

        $nama_file = 'daftar_hadir_penyedia_klarifikasi.doc';

        return $word->export($file, $array, $nama_file);
    }

    public function downloadBeritaAcaraKlarifikasi($id)
    {
        $data = Pengadaan::where('id', $id)->first();
        $dataDetail = PengadaanDetailPj::where('id_pengadaan', $id)->first();
        $perusahaan = Perusahaan::where('id', $data->id_perusahaan)->first();
        $dataTender = DMetodePengadaan::where('id', $data->id_mp2)->first();

        $tanggalIndo = new TanggalIndo();
      
        $tanggal = $tanggalIndo->tgl_aja($dataDetail->ba_hasil_klarifikasi_dan_nego_penawaran_tgl);
        $bulan = $tanggalIndo->bln_aja($dataDetail->ba_hasil_klarifikasi_dan_nego_penawaran_tgl);
        $tahun = $tanggalIndo->thn_aja($dataDetail->ba_hasil_klarifikasi_dan_nego_penawaran_tgl);
        $gabungan = $tanggal . ' ' . $bulan . ' ' . $tahun;

        $tanggal1 = $tanggalIndo->tgl_aja($dataDetail->rks_tgl);
        $bulan1 = $tanggalIndo->bln_aja($dataDetail->rks_tgl);
        $tahun1 = $tanggalIndo->thn_aja($dataDetail->rks_tgl);
        $gabungan1 = $tanggal1 . ' ' . $bulan1 . ' ' . $tahun1;

  
        $word = new WordTemplate();
        $file = public_path('doc/pj/klarifikasi_dan_nego/berita_acara_klarifikasi.rtf');

        $array = array(
            '[nomor]' => $dataDetail->ba_hasil_klarifikasi_dan_nego_penawaran_nomor,
            '[rks_nomor]' => $dataDetail->rks_nomor,
            '[rks_tanggal]' => $gabungan1,
            '[hps]' => $data->hps,
            '[hari]' => $data->ba_hasil_klarifikasi_dan_nego_penawaran_hari,
            '[tanggal]' => $tanggal,
            '[bulan]' => $bulan,
            '[tahun]' => $tahun,
            '[penawaran]' =>$data->harga_penawaran,
            '[perusahaan_nama]' => $perusahaan->nama,
            '[perusahaan_alamat]' => $perusahaan->alamat,
            '[perusahaan_npwp]' => $perusahaan->npwp,
            '[perusahaan_pimpinan]' => $perusahaan->pimpinan,
            '[pejabat_pelaksana]' => $data->pejabat_pelaksana,
            '[manager]' => $data->direksi,
            '[judul]' => $data->judul,
            '[tender]' => $dataTender->nama
        );

        $nama_file = 'berita_acara_klarifikasi.doc';

        return $word->export($file, $array, $nama_file);
    }

    public function downloadRekapitulasi($id)
    {
        $data = Pengadaan::with('getmp2')->where('id', $id)->first();
        $dataDetail = PengadaanDetailPj::where('id_pengadaan', $id)->first();
        $perusahaan = Perusahaan::where('id', $data->id_perusahaan)->first();

        $terbilangIndo = new TerbilangIndo();
        $spreadsheet = new Spreadsheet();
        $orgDate = $dataDetail->rks_tgl;
        $newDate = date("d-m-Y", strtotime($orgDate));  
        $jangawaktu = $data->jangka_waktu;
        $jangkawaktuterbilang =  $terbilangIndo->terbilang($jangawaktu);

        $loadFile = public_path('doc/pj/klarifikasi_dan_nego/rekapitulasi.xls');
        $sSheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($loadFile);
        $worksheet = $sSheet->getSheetByName('Hasil Koreksi');
        $worksheet->setCellValue('A10', 'RKS No. : ' . $dataDetail->rks_nomor);
        $worksheet->setCellValue('A7',  $data->judul);
        $worksheet->setCellValue('A8', 'Tanggal : ' . $newDate);

        $worksheet->setCellValue('C43', $perusahaan->pimpinan);
        $worksheet->setCellValue('C36', $perusahaan->nama);
        $worksheet->setCellValue('D16', $perusahaan->nama);
        $worksheet->setCellValue('C37', $perusahaan->sebutan_jabatan);
        $worksheet->setCellValue('G43', $data->pejabat_pelaksana);
        $worksheet->setCellValue('D52', $data->direksi);
        $worksheet->setCellValue('B33', 'Hasil jangka waktu pelaksanaan untuk paket pekerjaan diatas selama : '.$jangawaktu.' ( '.$jangkawaktuterbilang.') hari kalender');
        

        $date = date('d-m-y-' . substr((string)microtime(), 1, 8));
        $date = str_replace(".", "", $date);
        $filename = "export_" . $date . ".xlsx";

        try {
            $writer = new Xlsx($sSheet);
            $writer->save($filename);
            $content = file_get_contents($filename);
        } catch (Exception $e) {
            exit($e->getMessage());
        }

        header("Content-Disposition: attachment; filename=" . $filename);

        unlink($filename);
        exit($content);
    }

    public function downloadAsman($id)
    {
        $data = Pengadaan::where('id', $id)->first();
        $dataDetail = PengadaanDetailPj::where('id_pengadaan', $id)->first();
        $perusahaan = Perusahaan::where('id', $data->id_perusahaan)->first();
        $tanggalIndo = new TanggalIndo();

        $tanggal = $tanggalIndo->tgl_aja($dataDetail->undangan_aanwijzing_peserta_tgl);
        $bulan = $tanggalIndo->bln_aja($dataDetail->undangan_aanwijzing_peserta_tgl);
        $tahun = $tanggalIndo->thn_aja($dataDetail->undangan_aanwijzing_peserta_tgl);
        $gabungan = $tanggal . ' ' . $bulan . ' ' . $tahun;

        $word = new WordTemplate();
        $file = public_path('doc/pj/aanwijzing/undangan_asman_user.rtf');

        $array = array(
            '[nomor]' => $dataDetail->undangan_aanwijzing_peserta_nomor,
            '[hari]' => $dataDetail->undangan_aanwijzing_peserta_hari,
            '[tanggal]' => $gabungan

        );

        $nama_file = 'undangan_asman_user.doc';

        return $word->export($file, $array, $nama_file);
    }

    public function downloadPenjelasan($id)
    {
        $data = Pengadaan::where('id', $id)->first();
        $dataDetail = PengadaanDetailPj::where('id_pengadaan', $id)->first();
        $perusahaan = Perusahaan::where('id', $data->id_perusahaan)->first();
        $tanggalIndo = new TanggalIndo();

        $tanggal = $tanggalIndo->tgl_aja($dataDetail->undangan_aanwijzing_direksi_pekerjaan_tgl);
        $bulan = $tanggalIndo->bln_aja($dataDetail->undangan_aanwijzing_direksi_pekerjaan_tgl);
        $tahun = $tanggalIndo->thn_aja($dataDetail->undangan_aanwijzing_direksi_pekerjaan_tgl);
        $gabungan = $tanggal . ' ' . $bulan . ' ' . $tahun;

        $word = new WordTemplate();
        $file = public_path('doc/pj/aanwijzing/undangan_penjelasan.rtf');

        $array = array(
            '[nomor]' => $dataDetail->undangan_aanwijzing_direksi_pekerjaan_nomor,
            '[hari]' => $dataDetail->undangan_aanwijzing_direksi_pekerjaan_hari,
            '[tanggal]' => $gabungan,
            '[manager]' => $data->direksi,

        );

        $nama_file = 'undangan_penjelasan.doc';

        return $word->export($file, $array, $nama_file);
    }


    public function downloadAanwijzingForm($id)
    {
        $data = Pengadaan::where('id', $id)->first();
        $dataDetail = PengadaanDetailPj::where('id_pengadaan', $id)->first();

        $tanggalIndo = new TanggalIndo();

        $tanggal = $tanggalIndo->tgl_aja($dataDetail->aanwijzing_tgl);
        $bulan = $tanggalIndo->bln_aja($dataDetail->aanwijzing_tgl);
        $tahun = $tanggalIndo->thn_aja($dataDetail->aanwijzing_tgl);
        $gabungan = $tanggal . ' ' . $bulan . ' ' . $tahun;

        $word = new WordTemplate();
        $file = public_path('doc/pj/aanwijzing/form_daftar_hadir_pelaksana.rtf');

        $array = array(
            '[hari]' => $dataDetail->aanwijzing_hari,
            '[tanggal]' => $gabungan,
            '[pejabat_pelaksana]' => $data->pejabat_pelaksana,
            '[pic_pelaksana]' => $data->pic_pelaksana,
            '[JudulPekerjaan]' => $data->judul,
        );

        $nama_file = 'form_daftar_hadir_pelaksana.doc';

        return $word->export($file, $array, $nama_file);
    }


    public function downloadAanwijzingBeritaAcara($id)
    {
        $data = Pengadaan::where('id', $id)->first();
        $dataDetail = PengadaanDetailPj::where('id_pengadaan', $id)->first();
        $dataPekerjaan = DMetodePengadaan::where('id', $data->id_mp4)->first();
        $perusahaan = Perusahaan::where('id', $data->id_perusahaan)->first();
        $tanggalIndo = new TanggalIndo();

        $tanggal1 = $tanggalIndo->tgl_aja($dataDetail->addendum_rks_tgl);
        $bulan1 = $tanggalIndo->bln_aja($dataDetail->addendum_rks_tgl);
        $tahun1 = $tanggalIndo->thn_aja($dataDetail->addendum_rks_tgl);
        $gabungan1 = $tanggal1 . ' ' . $bulan1 . ' ' . $tahun1;


        $word = new WordTemplate();
        $file = public_path('doc/pj/aanwijzing/berita_acara.rtf');

        $array = array(
            '[nomor]' => $dataDetail->aanwijzing_nomor,
            '[hari]' => $dataDetail->aanwijzing_hari,
            '[rks_nomor]' => $dataDetail->addendum_rks_nomor,
            '[rks_tanggal]' => $gabungan1,
            '[judul]' => $data->judul,
            '[pejabat_pelaksana]' => $data->pejabat_pelaksana,
            '[tanggal]' => $tanggal1,
            '[bulan]' => $bulan1,
            '[tahun]' => $tahun1,
            '[metode]' => $dataPekerjaan->nama,


        );

        $nama_file = 'berita_acara.doc';

        return $word->export($file, $array, $nama_file);
    }

    public function downloadAanwijzingDaftarHadir($id)
    {
        $data = Pengadaan::where('id', $id)->first();
        $dataDetail = PengadaanDetailPj::where('id_pengadaan', $id)->first();

        $tanggalIndo = new TanggalIndo();

        $tanggal = $tanggalIndo->tgl_aja($dataDetail->aanwijzing_tgl);
        $bulan = $tanggalIndo->bln_aja($dataDetail->aanwijzing_tgl);
        $tahun = $tanggalIndo->thn_aja($dataDetail->aanwijzing_tgl);
        $gabungan = $tanggal . ' ' . $bulan . ' ' . $tahun;

        $word = new WordTemplate();
        $file = public_path('doc/pj/aanwijzing/daftar_hadir_penyedia.rtf');

        $array = array(
            '[hari]' => $dataDetail->aanwijzing_hari,
            '[tanggal]' => $gabungan,
            '[JudulPekerjaan]' => $data->judul,
        );

        $nama_file = 'daftar_hadir_penyedia.doc';

        return $word->export($file, $array, $nama_file);
    }

    public function downloadAddendum($id)
    {
        $data = Pengadaan::where('id', $id)->first();
        $dataDetail = PengadaanDetailPj::where('id_pengadaan', $id)->first();
        $dataPekerjaan = DMetodePengadaan::where('id', $data->id_mp4)->first();
        $tanggalIndo = new TanggalIndo();

        $tanggal = $tanggalIndo->tgl_aja($dataDetail->aanwijzing_tgl);
        $bulan = $tanggalIndo->bln_aja($dataDetail->aanwijzing_tgl);
        $tahun = $tanggalIndo->thn_aja($dataDetail->aanwijzing_tgl);
        $gabungan = $tanggal . ' ' . $bulan . ' ' . $tahun;

        $tanggal1 = $tanggalIndo->tgl_aja($dataDetail->addendum_rks_tgl);
        $bulan1 = $tanggalIndo->bln_aja($dataDetail->addendum_rks_tgl);
        $tahun1 = $tanggalIndo->thn_aja($dataDetail->addendum_rks_tgl);
        $gabungan1 = $tanggal1 . ' ' . $bulan1 . ' ' . $tahun1;


        $word = new WordTemplate();
        $file = public_path('doc/pj/addendum_rks.rtf');

        $array = array(
            '[rks_nomor]' => $dataDetail->addendum_rks_nomor,
            '[rks_tanggal]' => $gabungan1,
            '[judul]' => $data->judul,
            '[manager]' => $data->direksi,
            '[hari]' => $dataDetail->addendum_rks_hari,
            '[tanggal]' => $tanggal1,
            '[bulan]' => $bulan1,
            '[tahun]' => $tahun1,
            '[metode]' => $dataPekerjaan->nama,

        );

        $nama_file = 'addendum_rks.doc';

        return $word->export($file, $array, $nama_file);
    }


    public function downloadPembukaan1Ba($id)
    {
        $data = Pengadaan::where('id', $id)->first();
        $dataPekerjaan = DMetodePengadaan::where('id', $data->id_mp4)->first();
        $dataDetail = PengadaanDetailPj::where('id_pengadaan', $id)->first();
        $perusahaan = Perusahaan::where('id', $data->id_perusahaan)->first();
        $tanggalIndo = new TanggalIndo();

        $tanggal = $tanggalIndo->tgl_aja($dataDetail->pembukaan_penawaran_sampul_satu_tgl);
        $bulan = $tanggalIndo->bln_aja($dataDetail->pembukaan_penawaran_sampul_satu_tgl);
        $tahun = $tanggalIndo->thn_aja($dataDetail->pembukaan_penawaran_sampul_satu_tgl);
        $gabungan = $tanggal . ' ' . $bulan . ' ' . $tahun;

        $tanggal1 = $tanggalIndo->tgl_aja($dataDetail->addendum_rks_tgl);
        $bulan1 = $tanggalIndo->bln_aja($dataDetail->addendum_rks_tgl);
        $tahun1 = $tanggalIndo->thn_aja($dataDetail->addendum_rks_tgl);
        $gabungan1 = $tanggal1 . ' ' . $bulan1 . ' ' . $tahun1;


        $word = new WordTemplate();
        $file = public_path('doc/pj/pembukaan_dok/pembukaan_dok_penawaran.rtf');

        $array = array(
            '[nomor]' => $dataDetail->pembukaan_penawaran_sampul_satu_nomor,
            '[hari]' => $dataDetail->pembukaan_penawaran_sampul_satu_hari,
            '[rks_nomor]' => $dataDetail->addendum_rks_nomor,
            '[rks_tanggal]' => $gabungan1,
            '[judul]' => $data->judul,
            '[pejabat_pelaksana]' => $data->pejabat_pelaksana,
            '[tanggal]' => $tanggal,
            '[bulan]' => $bulan,
            '[tahun]' => $tahun,
            '[metode]' => $dataPekerjaan->nama,


        );

        $nama_file = 'pembukaan_dok_penawaran.doc';

        return $word->export($file, $array, $nama_file);
    }

    public function downloadPembukaan1Catatan($id)
    {
        $data = Pengadaan::with('getmp2')->where('id', $id)->first();
        $dataDetail = PengadaanDetailPj::where('id_pengadaan', $id)->first();
        $perusahaan = Perusahaan::where('id', $data->id_perusahaan)->first();

        $spreadsheet = new Spreadsheet();

        $orgDate = $dataDetail->pembukaan_penawaran_sampul_satu_tgl;
        $newDate = date("d-m-Y", strtotime($orgDate));  

        $loadFile = public_path('doc/pj/pembukaan_dok/catatan_hasil.xls');
        $sSheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($loadFile);
        $worksheet = $sSheet->getSheetByName('Catatan Pembukaan');
        $worksheet->setCellValue('A7', $data->judul);
        $worksheet->setCellValue('A9', 'RKS No. : ' . $dataDetail->pembukaan_penawaran_sampul_satu_nomor);
        $worksheet->setCellValue('A10', 'Tanggal : ' .  $newDate);

        $worksheet->setCellValue('H90', $data->pejabat_pelaksana);

        $date = date('d-m-y-' . substr((string)microtime(), 1, 8));
        $date = str_replace(".", "", $date);
        $filename = "export_" . $date . ".xlsx";

        try {
            $writer = new Xlsx($sSheet);
            $writer->save($filename);
            $content = file_get_contents($filename);
        } catch (Exception $e) {
            exit($e->getMessage());
        }

        header("Content-Disposition: attachment; filename=" . $filename);

        unlink($filename);
        exit($content);
    }

    public function downloadPembukaan1Pelaksana($id)
    {
        $data = Pengadaan::where('id', $id)->first();
        $dataDetail = PengadaanDetailPj::where('id_pengadaan', $id)->first();

        $tanggalIndo = new TanggalIndo();

        $tanggal = $tanggalIndo->tgl_aja($dataDetail->pembukaan_penawaran_sampul_satu_tgl);
        $bulan = $tanggalIndo->bln_aja($dataDetail->pembukaan_penawaran_sampul_satu_tgl);
        $tahun = $tanggalIndo->thn_aja($dataDetail->pembukaan_penawaran_sampul_satu_tgl);
        $gabungan = $tanggal . ' ' . $bulan . ' ' . $tahun;

        $word = new WordTemplate();
        $file = public_path('doc/pj/pembukaan_dok/daftar_hadir_pelaksana.rtf');

        $array = array(
            '[hari]' => $dataDetail->pembukaan_penawaran_sampul_satu_hari,
            '[tanggal]' => $gabungan,
            '[pejabat_pelaksana]' => $data->pejabat_pelaksana,
            '[pic_pelaksana]' => $data->pic_pelaksana,
            '[Judul]' => $data->judul,
        );

        $nama_file = 'daftar_hadir_pelaksana.doc';

        return $word->export($file, $array, $nama_file);
    }

    public function downloadPembukaan1Penyedia($id)
    {
        $data = Pengadaan::where('id', $id)->first();
        $dataDetail = PengadaanDetailPj::where('id_pengadaan', $id)->first();

        $tanggalIndo = new TanggalIndo();

        $tanggal = $tanggalIndo->tgl_aja($dataDetail->pembukaan_penawaran_sampul_satu_tgl);
        $bulan = $tanggalIndo->bln_aja($dataDetail->pembukaan_penawaran_sampul_satu_tgl);
        $tahun = $tanggalIndo->thn_aja($dataDetail->pembukaan_penawaran_sampul_satu_tgl);
        $gabungan = $tanggal . ' ' . $bulan . ' ' . $tahun;

        $word = new WordTemplate();
        $file = public_path('doc/pj/pembukaan_dok/daftar_hadir_penyedia.rtf');

        $array = array(
            '[hari]' => $dataDetail->pembukaan_penawaran_sampul_satu_hari,
            '[tanggal]' => $gabungan,
            '[Judul]' => $data->judul,
        );

        $nama_file = 'daftar_hadir_penyedia.doc';

        return $word->export($file, $array, $nama_file);
    }

    public function downloadEva1Hadir($id)
    {
        $data = Pengadaan::where('id', $id)->first();
        $dataDetail = PengadaanDetailPj::where('id_pengadaan', $id)->first();

        $tanggalIndo = new TanggalIndo();

        $tanggal = $tanggalIndo->tgl_aja($dataDetail->evaluasi_dok_penawaran_sampul_satu_tgl);
        $bulan = $tanggalIndo->bln_aja($dataDetail->evaluasi_dok_penawaran_sampul_satu_tgl);
        $tahun = $tanggalIndo->thn_aja($dataDetail->evaluasi_dok_penawaran_sampul_satu_tgl);
        $gabungan = $tanggal . ' ' . $bulan . ' ' . $tahun;

        $word = new WordTemplate();
        $file = public_path('doc/pj/evaluasi_sampul_satu/daftar_hadir.rtf');

        $array = array(
            '[hari]' => $dataDetail->evaluasi_dok_penawaran_sampul_satu_hari,
            '[tanggal]' => $gabungan,
            '[pejabat_pelaksana]' => $data->pejabat_pelaksana,
            '[pic_pelaksana]' => $data->pic_pelaksana,
            '[Judul]' => $data->judul,
        );

        $nama_file = 'daftar_hadir.doc';

        return $word->export($file, $array, $nama_file);
    }

    public function downloadEva1Penilaian($id)
    {
        $data = Pengadaan::where('id', $id)->first();
        $dataDetail = PengadaanDetailPj::where('id_pengadaan', $id)->first();
        $dataPekerjaan = DMetodePengadaan::where('id', $data->id_mp4)->first();
        $dataTender= DMetodePengadaan::where('id', $data->id_mp2)->first();
        $perusahaan = Perusahaan::where('id', $data->id_perusahaan)->first();
        $tanggalIndo = new TanggalIndo();

        $tanggal = $tanggalIndo->tgl_aja($dataDetail->evaluasi_dok_penawaran_sampul_satu_tgl);
        $bulan = $tanggalIndo->bln_aja($dataDetail->evaluasi_dok_penawaran_sampul_satu_tgl);
        $tahun = $tanggalIndo->thn_aja($dataDetail->evaluasi_dok_penawaran_sampul_satu_tgl);
        $gabungan = $tanggal . ' ' . $bulan . ' ' . $tahun;

        $tanggal1 = $tanggalIndo->tgl_aja($dataDetail->rks_tgl);
        $bulan1 = $tanggalIndo->bln_aja($dataDetail->rks_tgl);
        $tahun1 = $tanggalIndo->thn_aja($dataDetail->rks_tgl);
        $gabungan1 = $tanggal1 . ' ' . $bulan1 . ' ' . $tahun1;


        $word = new WordTemplate();
        $file = public_path('doc/pj/evaluasi_sampul_satu/hasil_penilaian.rtf');

        $array = array(
            '[nomor]' => $dataDetail->evaluasi_dok_penawaran_sampul_satu_nomor,
            '[hari]' => $dataDetail->evaluasi_dok_penawaran_sampul_satu_hari,
            '[rks_nomor]' => $dataDetail->rks_nomor,
            '[rks_tanggal]' => $gabungan1,
            '[judul]' => $data->judul,
            '[jabatan_direksi]' => $data->jabatan_direksi,
            '[pejabat_pelaksana]' => $data->pejabat_pelaksana,
            '[manager]' => $data->direksi,
            '[tanggal]' => $tanggal,
            '[bulan]' => $bulan,
            '[tahun]' => $tahun,
            '[metode]' => $dataPekerjaan->nama,
            '[tender]' => $dataTender->nama


        );

        $nama_file = 'hasil_penilaian.doc';

        return $word->export($file, $array, $nama_file);
    }

    public function downloadEva1Hasil($id)
    {
        $data = Pengadaan::with('getmp2')->where('id', $id)->first();
        $dataDetail = PengadaanDetailPj::where('id_pengadaan', $id)->first();
        $perusahaan = Perusahaan::where('id', $data->id_perusahaan)->first();

        $spreadsheet = new Spreadsheet();
        $orgDate = $dataDetail->evaluasi_dok_penawaran_sampul_satu_tgl;
        $newDate = date("d-m-Y", strtotime($orgDate));  

        $loadFile = public_path('doc/pj/evaluasi_sampul_satu/rekap_hasil_penilaian.xls');
        $sSheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($loadFile);
        $worksheet = $sSheet->getSheetByName('Catatan Eva Adm');
        $worksheet->setCellValue('A7', $data->judul);
        $worksheet->setCellValue('A9', 'RKS No. : ' . $dataDetail->evaluasi_dok_penawaran_sampul_satu_nomor);
        $worksheet->setCellValue('A10', 'Tanggal : ' .  $newDate);
        $worksheet->setCellValue('D44', $data->jabatan_direksi);
        $worksheet->setCellValue('D50', $data->direksi);
        $worksheet->setCellValue('G50', $data->pejabat_pelaksana);

        $date = date('d-m-y-' . substr((string)microtime(), 1, 8));
        $date = str_replace(".", "", $date);
        $filename = "export_" . $date . ".xlsx";

        try {
            $writer = new Xlsx($sSheet);
            $writer->save($filename);
            $content = file_get_contents($filename);
        } catch (Exception $e) {
            exit($e->getMessage());
        }

        header("Content-Disposition: attachment; filename=" . $filename);

        unlink($filename);
        exit($content);
    }

    public function downloadEva1Pengumuman($id)
    {
        $data = Pengadaan::where('id', $id)->first();
        $dataDetail = PengadaanDetailPj::where('id_pengadaan', $id)->first();
        $perusahaan = Perusahaan::where('id', $data->id_perusahaan)->first();
        $dataPekerjaan = DMetodePengadaan::where('id', $data->id_mp4)->first();

        $word = new WordTemplate();
        $file = public_path('doc/pj/pembukaan_dok2/pengumuman_hasil_sampul1.rtf');

        $array = array(
            '[nomor]' => $dataDetail->pengumuman_hasil_evaluasi_sampul_satu_nomor,
            '[rks_nomor]' => $dataDetail->addendum_rks_nomor,
            '[judul]' => $data->judul,
            '[metode]' => $dataPekerjaan->nama,


        );

        $nama_file = 'pengumuman_hasil_sampul1.doc';

        return $word->export($file, $array, $nama_file);
    }

    public function downloadPembukaan2Ba($id)
    {
        $data = Pengadaan::where('id', $id)->first();
        $dataPekerjaan = DMetodePengadaan::where('id', $data->id_mp4)->first();
        $dataTender = DMetodePengadaan::where('id', $data->id_mp2)->first();
        $dataDetail = PengadaanDetailPj::where('id_pengadaan', $id)->first();
        $perusahaan = Perusahaan::where('id', $data->id_perusahaan)->first();
        $tanggalIndo = new TanggalIndo();

        $tanggal = $tanggalIndo->tgl_aja($dataDetail->pembukaan_penawaran_sampul_dua_tgl);
        $bulan = $tanggalIndo->bln_aja($dataDetail->pembukaan_penawaran_sampul_dua_tgl);
        $tahun = $tanggalIndo->thn_aja($dataDetail->pembukaan_penawaran_sampul_dua_tgl);
        $gabungan = $tanggal . ' ' . $bulan . ' ' . $tahun;

        $tanggal1 = $tanggalIndo->tgl_aja($dataDetail->rks_tgl);
        $bulan1 = $tanggalIndo->bln_aja($dataDetail->rks_tgl);
        $tahun1 = $tanggalIndo->thn_aja($dataDetail->rks_tgl);
        $gabungan1 = $tanggal1 . ' ' . $bulan1 . ' ' . $tahun1;


        $word = new WordTemplate();
        $file = public_path('doc/pj/pembukaan_dok2/pembukaan_dok_penawaran.rtf');

        $array = array(
            '[nomor]' => $dataDetail->pembukaan_penawaran_sampul_dua_nomor,
            '[hari]' => $dataDetail->pembukaan_penawaran_sampul_dua_hari,
            '[rks_nomor]' => $dataDetail->rks_nomor,
            '[rks_tanggal]' => $gabungan1,
            '[judul]' => $data->judul,
            '[pejabat_pelaksana]' => $data->pejabat_pelaksana,
            '[tanggal]' => $tanggal,
            '[bulan]' => $bulan,
            '[tahun]' => $tahun,
            '[metode]' => $dataPekerjaan->nama,
            '[tender]' => $dataTender->nama


        );

        $nama_file = 'pembukaan_dok_penawaran.doc';

        return $word->export($file, $array, $nama_file);
    }

    public function downloadPembukaan2Undangan($id)
    {
        $data = Pengadaan::where('id', $id)->first();
        $dataDetail = PengadaanDetailPj::where('id_pengadaan', $id)->first();
        $perusahaan = Perusahaan::where('id', $data->id_perusahaan)->first();
        $tanggalIndo = new TanggalIndo();
        $dataTender = DMetodePengadaan::where('id', $data->id_mp2)->first();

        $tanggal = $tanggalIndo->tgl_aja($dataDetail->pembukaan_penawaran_sampul_dua_tgl);
        $bulan = $tanggalIndo->bln_aja($dataDetail->pembukaan_penawaran_sampul_dua_tgl);
        $tahun = $tanggalIndo->thn_aja($dataDetail->pembukaan_penawaran_sampul_dua_tgl);
        $gabungan = $tanggal . ' ' . $bulan . ' ' . $tahun;


        $word = new WordTemplate();
        $file = public_path('doc/pj/pembukaan_dok2/undangan_pembukaan.rtf');

        $array = array(
            '[nomor]' => $dataDetail->pembukaan_penawaran_sampul_dua_nomor,
            '[hari]' => $dataDetail->pembukaan_penawaran_sampul_dua_hari,
            '[manager]' => $data->direksi,
            '[tanggal]' => $gabungan,
            '[judul]' => $data->judul,
            '[tender]' => $dataTender->nama


        );

        $nama_file = 'undangan_pembukaan.doc';

        return $word->export($file, $array, $nama_file);
    }

    public function downloadPembukaan2Pelaksana($id)
    {
        $data = Pengadaan::where('id', $id)->first();
        $dataDetail = PengadaanDetailPj::where('id_pengadaan', $id)->first();

        $tanggalIndo = new TanggalIndo();

        $tanggal = $tanggalIndo->tgl_aja($dataDetail->pembukaan_penawaran_sampul_dua_tgl);
        $bulan = $tanggalIndo->bln_aja($dataDetail->pembukaan_penawaran_sampul_dua_tgl);
        $tahun = $tanggalIndo->thn_aja($dataDetail->pembukaan_penawaran_sampul_dua_tgl);
        $gabungan = $tanggal . ' ' . $bulan . ' ' . $tahun;

        $word = new WordTemplate();
        $file = public_path('doc/pj/pembukaan_dok2/daftar_hadir_pelaksana.rtf');

        $array = array(
            '[hari]' => $dataDetail->pembukaan_penawaran_sampul_dua_hari,
            '[tanggal]' => $gabungan,
            '[pejabat_pelaksana]' => $data->pejabat_pelaksana,
            '[pic_pelaksana]' => $data->pic_pelaksana,
            '[Judul]' => $data->judul,
        );

        $nama_file = 'daftar_hadir_pelaksana.doc';

        return $word->export($file, $array, $nama_file);
    }

    public function downloadPembukaan2Penyedia($id)
    {
        $data = Pengadaan::where('id', $id)->first();
        $dataDetail = PengadaanDetailPj::where('id_pengadaan', $id)->first();

        $tanggalIndo = new TanggalIndo();

        $tanggal = $tanggalIndo->tgl_aja($dataDetail->pembukaan_penawaran_sampul_dua_tgl);
        $bulan = $tanggalIndo->bln_aja($dataDetail->pembukaan_penawaran_sampul_dua_tgl);
        $tahun = $tanggalIndo->thn_aja($dataDetail->pembukaan_penawaran_sampul_dua_tgl);
        $gabungan = $tanggal . ' ' . $bulan . ' ' . $tahun;

        $word = new WordTemplate();
        $file = public_path('doc/pj/pembukaan_dok2/daftar_hadir_penyedia.rtf');

        $array = array(
            '[hari]' => $dataDetail->pembukaan_penawaran_sampul_dua_hari,
            '[tanggal]' => $gabungan,
            '[Judul]' => $data->judul
        );

        $nama_file = 'daftar_hadir_penyedia.doc';

        return $word->export($file, $array, $nama_file);
    }

    public function downloadEva2Hadir($id)
    {
        $data = Pengadaan::where('id', $id)->first();
        $dataDetail = PengadaanDetailPj::where('id_pengadaan', $id)->first();

        $tanggalIndo = new TanggalIndo();

        $tanggal = $tanggalIndo->tgl_aja($dataDetail->evaluasi_dok_penawaran_sampul_dua_tgl);
        $bulan = $tanggalIndo->bln_aja($dataDetail->evaluasi_dok_penawaran_sampul_dua_tgl);
        $tahun = $tanggalIndo->thn_aja($dataDetail->evaluasi_dok_penawaran_sampul_dua_tgl);
        $gabungan = $tanggal . ' ' . $bulan . ' ' . $tahun;

        $word = new WordTemplate();
        $file = public_path('doc/pj/evaluasi_sampul_dua/daftar_hadir_pelaksana.rtf');

        $array = array(
            '[hari]' => $dataDetail->evaluasi_dok_penawaran_sampul_dua_hari,
            '[tanggal]' => $gabungan,
            '[pejabat_pelaksana]' => $data->pejabat_pelaksana,
            '[pic_pelaksana]' => $data->pic_pelaksana,
            '[Judul]' => $data->judul
        );

        $nama_file = 'daftar_hadir_pelaksana.doc';

        return $word->export($file, $array, $nama_file);
    }

    public function downloadEva2Penilaian($id)
    {
        $data = Pengadaan::where('id', $id)->first();
        $dataDetail = PengadaanDetailPj::where('id_pengadaan', $id)->first();
        $perusahaan = Perusahaan::where('id', $data->id_perusahaan)->first();
        $tanggalIndo = new TanggalIndo();
        $dataTender = DMetodePengadaan::where('id', $data->id_mp2)->first();
        $tanggal = $tanggalIndo->tgl_aja($dataDetail->evaluasi_dok_penawaran_sampul_dua_tgl);
        $bulan = $tanggalIndo->bln_aja($dataDetail->evaluasi_dok_penawaran_sampul_dua_tgl);
        $tahun = $tanggalIndo->thn_aja($dataDetail->evaluasi_dok_penawaran_sampul_dua_tgl);
        $gabungan = $tanggal . ' ' . $bulan . ' ' . $tahun;

        $tanggal1 = $tanggalIndo->tgl_aja($dataDetail->rks_tgl);
        $bulan1 = $tanggalIndo->bln_aja($dataDetail->rks_tgl);
        $tahun1 = $tanggalIndo->thn_aja($dataDetail->rks_tgl);
        $gabungan1 = $tanggal1 . ' ' . $bulan1 . ' ' . $tahun1;


        $word = new WordTemplate();
        $file = public_path('doc/pj/evaluasi_sampul_dua/hasil_penilaian.rtf');

        $array = array(
            '[nomor]' => $dataDetail->evaluasi_dok_penawaran_sampul_dua_nomor,
            '[hari]' => $dataDetail->evaluasi_dok_penawaran_sampul_dua_hari,
            '[rks_nomor]' => $dataDetail->rks_nomor,
            '[rks_tanggal]' => $gabungan1,
            '[judul]' => $data->judul,
            '[pejabat_pelaksana]' => $data->pejabat_pelaksana,
            '[manager]' => $data->direksi,
            '[tanggal]' => $tanggal,
            '[bulan]' => $bulan,
            '[tahun]' => $tahun,
            '[tender]' => $dataTender->nama


        );

        $nama_file = 'hasil_penilaian.doc';

        return $word->export($file, $array, $nama_file);
    }

    public function downloadEva2Hasil($id)
    {
        $data = Pengadaan::with('getmp2')->where('id', $id)->first();
        $dataDetail = PengadaanDetailPj::where('id_pengadaan', $id)->first();
        $perusahaan = Perusahaan::where('id', $data->id_perusahaan)->first();

        $orgDate = $dataDetail->rks_tgl;
        $newDate = date("d-m-Y", strtotime($orgDate));  
        $spreadsheet = new Spreadsheet();

        
        $loadFile = public_path('doc/pj/evaluasi_sampul_dua/rekap_hasil.xls');
        $sSheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($loadFile);
        $worksheet = $sSheet->getSheetByName('Catatan Eva Harga');
        $worksheet->setCellValue('A7', $data->judul);
        $worksheet->setCellValue('A9', 'RKS No. : ' . $dataDetail->evaluasi_dok_penawaran_sampul_dua_nomor);
        $worksheet->setCellValue('A10', 'Tanggal : ' . $newDate);

        $worksheet->setCellValue('F42', $data->pejabat_pelaksana);


        $worksheet1 = $sSheet->getSheetByName('Hasil Koreksi');
        $worksheet1->setCellValue('A9', 'RKS No. : ' . $dataDetail->evaluasi_dok_penawaran_sampul_dua_nomor);
        $worksheet1->setCellValue('A10', 'Tanggal : ' . $newDate);

        $worksheet1->setCellValue('H53', $data->pejabat_pelaksana);


        $date = date('d-m-y-' . substr((string)microtime(), 1, 8));
        $date = str_replace(".", "", $date);
        $filename = "export_" . $date . ".xlsx";

        try {
            $writer = new Xlsx($sSheet);
            $writer->save($filename);
            $content = file_get_contents($filename);
        } catch (Exception $e) {
            exit($e->getMessage());
        }

        header("Content-Disposition: attachment; filename=" . $filename);

        unlink($filename);
        exit($content);
    }

    public function downloadEva2CatatanKoreksi($id)
    {
        $data = Pengadaan::with('getmp2')->where('id', $id)->first();
        $dataDetail = PengadaanDetailPj::where('id_pengadaan', $id)->first();
        $perusahaan = Perusahaan::where('id', $data->id_perusahaan)->first();
        $orgDate = $dataDetail->rks_tgl;
        $newDate = date("d-m-Y", strtotime($orgDate));  
        $spreadsheet = new Spreadsheet();

        $loadFile = public_path('doc/pj/evaluasi_sampul_dua/catatan_koreksi.xls');
        $sSheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($loadFile);
        $worksheet = $sSheet->getSheetByName('Hasil Koreksi');
        $worksheet->setCellValue('A7', $data->judul);
        $worksheet->setCellValue('A9', 'RKS No. : ' . $dataDetail->rks_nomor);
        $worksheet->setCellValue('A10', 'Tanggal : ' . $newDate);


        $worksheet1 = $sSheet->getSheetByName('Kertas Kerja');
        $worksheet1->setCellValue('A6', 'RKS No. : ' . $dataDetail->evaluasi_dok_penawaran_sampul_dua_nomor);
        $worksheet1->setCellValue('A7', 'Tanggal : ' . $newDate);

        $worksheet1->setCellValue('I48', $data->pejabat_pelaksana);


        $date = date('d-m-y-' . substr((string)microtime(), 1, 8));
        $date = str_replace(".", "", $date);
        $filename = "export_" . $date . ".xlsx";

        try {
            $writer = new Xlsx($sSheet);
            $writer->save($filename);
            $content = file_get_contents($filename);
        } catch (Exception $e) {
            exit($e->getMessage());
        }

        header("Content-Disposition: attachment; filename=" . $filename);

        unlink($filename);
        exit($content);
    }



    public function downloadSkpp($id)
    {
        $data = Pengadaan::where('id', $id)->first();
        $dataDetail = PengadaanDetailPj::where('id_pengadaan', $id)->first();
        $perusahaan = Perusahaan::where('id', $data->id_perusahaan)->first();
        $terbilangIndo = new TerbilangIndo();
        $dataTender = DMetodePengadaan::where('id', $data->id_mp2)->first();

        $tanggalIndo = new TanggalIndo();


        $tanggal = $tanggalIndo->tgl_aja($dataDetail->laporan_hasil_evaluasi_tgl);
        $bulan = $tanggalIndo->bln_aja($dataDetail->laporan_hasil_evaluasi_tgl);
        $tahun = $tanggalIndo->thn_aja($dataDetail->laporan_hasil_evaluasi_tgl);
        $gabungan = $tanggal . ' ' . $bulan . ' ' . $tahun;

        $tanggal1 = $tanggalIndo->tgl_aja($dataDetail->nd_usulan_penetapan_calon_pemenang_tgl);
        $bulan1 = $tanggalIndo->bln_aja($dataDetail->nd_usulan_penetapan_calon_pemenang_tgl);
        $tahun1 = $tanggalIndo->thn_aja($dataDetail->nd_usulan_penetapan_calon_pemenang_tgl);
        $gabungan1 = $tanggal1 . ' ' . $bulan1 . ' ' . $tahun1;

        $tanggal2 = $tanggalIndo->tgl_aja($dataDetail->nd_penetapan_calon_pemenang_tgl);
        $bulan2 = $tanggalIndo->bln_aja($dataDetail->nd_penetapan_calon_pemenang_tgl);
        $tahun2 = $tanggalIndo->thn_aja($dataDetail->nd_penetapan_calon_pemenang_tgl);
        $gabungan2 = $tanggal2 . ' ' . $bulan2 . ' ' . $tahun2;

        $tanggal3 = $tanggalIndo->tgl_aja($dataDetail->skkp_tgl);
        $bulan3 = $tanggalIndo->bln_aja($dataDetail->skkp_tgl);
        $tahun3 = $tanggalIndo->thn_aja($dataDetail->skkp_tgl);
        $gabungan3 = $tanggal3 . ' ' . $bulan3 . ' ' . $tahun3;

        $word = new WordTemplate();
        $file = public_path('doc/pj/skpp.rtf');
        

        $hargaPenawaran = $data->harga_penawaran;
        $hargaPenawaranTerbilang = $terbilangIndo->terbilang($hargaPenawaran);

        $hargakontrak = $data->harga_kontrak;
        $hargakontrakTerbilang = $terbilangIndo->terbilang($hargakontrak);

        $array = array(
            '[nomor]' => $dataDetail->skkp_nomor,
            '[evaluasi_nomor]' => $dataDetail->laporan_hasil_evaluasi_nomor,
            '[evaluasi_tanggal]' => $gabungan,
            '[usulan_penetapan_pemenang_nomor]' => $dataDetail->nd_usulan_penetapan_calon_pemenang_nomor,
            '[usulan_penetapan_pemenang_tanggal]' => $gabungan1,
            '[penetapan_pemenang_nomor]' => $dataDetail->nd_penetapan_calon_pemenang_nomor,
            '[penetapan_pemenang_tanggal]' => $gabungan2,
            '[judul]' => $data->judul,
            '[perusahaan_nama]' => $perusahaan->nama,
            '[perusahaan_jalan]' => $perusahaan->alamat,
            '[perusahaan_npwp]' => $perusahaan->npwp,
            '[pejabat_pelaksana]' => $data->pejabat_pelaksana,
            '[hargapenawaran]' => $hargaPenawaran,
            '[hargapenawaranterbilang]' => $hargaPenawaranTerbilang,
            '[hargakontrak]' => $hargakontrak,
            '[hargakontrakterbilang]' => $hargakontrakTerbilang,
            '[tender]' => $dataTender->nama,
            '[skpptanggal]' => $gabungan3



        );

        $nama_file = 'skpp.doc';

        return $word->export($file, $array, $nama_file);
    }

    public function downloadSppbj($id)
    {
        $data = Pengadaan::where('id', $id)->first();
        $dataDetail = PengadaanDetailPj::where('id_pengadaan', $id)->first();
        $perusahaan = Perusahaan::where('id', $data->id_perusahaan)->first();
        $terbilangIndo = new TerbilangIndo();
        $tanggalIndo = new TanggalIndo();


        $tanggal = $tanggalIndo->tgl_aja($dataDetail->penunjukan_pemenang_tanggal);
        $bulan = $tanggalIndo->bln_aja($dataDetail->penunjukan_pemenang_tanggal);
        $tahun = $tanggalIndo->thn_aja($dataDetail->penunjukan_pemenang_tanggal);
        $gabungan = $tanggal . ' ' . $bulan . ' ' . $tahun;

        $tanggal1 = $tanggalIndo->tgl_aja($dataDetail->nd_usulan_penetapan_calon_pemenang_tgl);
        $bulan1 = $tanggalIndo->bln_aja($dataDetail->nd_usulan_penetapan_calon_pemenang_tgl);
        $tahun1 = $tanggalIndo->thn_aja($dataDetail->nd_usulan_penetapan_calon_pemenang_tgl);
        $gabungan1 = $tanggal1 . ' ' . $bulan1 . ' ' . $tahun1;

        $tanggal2 = $tanggalIndo->tgl_aja($dataDetail->nd_penetapan_calon_pemenang_tgl);
        $bulan2 = $tanggalIndo->bln_aja($dataDetail->nd_penetapan_calon_pemenang_tgl);
        $tahun2 = $tanggalIndo->thn_aja($dataDetail->nd_penetapan_calon_pemenang_tgl);
        $gabungan2 = $tanggal2 . ' ' . $bulan2 . ' ' . $tahun2;

        $word = new WordTemplate();
        $file = public_path('doc/pj/penunjukan_pemenang.rtf');

        $hargaPenawaran = $data->harga_penawaran;
        $hargaPenawaranTerbilang = $terbilangIndo->terbilang($hargaPenawaran);

        $array = array(
            '[nomor]' => $dataDetail->penunjukan_pemenang_nomor,
            '[tanggal]' => $gabungan,
            '[judul]' => $data->judul,
            '[perusahaan_pimpinan]' => $perusahaan->pimpinan,
            '[perusahaan_sebutan_jabatan]' => $perusahaan->sebutan_jabatan,
            '[perusahaan_nama]' => $perusahaan->nama,
            '[perusahaan_alamat]' => $perusahaan->alamat,
            '[perusahaan_npwp]' => $perusahaan->npwp,
            '[manager]' => $data->direksi,
            '[hargapenawaran]' => $hargaPenawaran,
            '[hargapenawaranTerbilang]' => $hargaPenawaranTerbilang


        );

        $nama_file = 'penunjukan_pemenang.doc';

        return $word->export($file, $array, $nama_file);
    }

    public function downloadPengumumanCalon($id)
    {
        $data = Pengadaan::where('id', $id)->first();
        $dataDetail = PengadaanDetailPj::where('id_pengadaan', $id)->first();
        $perusahaan = Perusahaan::where('id', $data->id_perusahaan)->first();
        $dataTender = DMetodePengadaan::where('id', $data->id_mp2)->first();
        $tanggalIndo = new TanggalIndo();


        $tanggal = $tanggalIndo->tgl_aja($dataDetail->laporan_hasil_evaluasi_tgl);
        $bulan = $tanggalIndo->bln_aja($dataDetail->laporan_hasil_evaluasi_tgl);
        $tahun = $tanggalIndo->thn_aja($dataDetail->laporan_hasil_evaluasi_tgl);
        $gabungan = $tanggal . ' ' . $bulan . ' ' . $tahun;

        $tanggal1 = $tanggalIndo->tgl_aja($dataDetail->nd_penetapan_calon_pemenang_tgl);
        $bulan1 = $tanggalIndo->bln_aja($dataDetail->nd_penetapan_calon_pemenang_tgl);
        $tahun1 = $tanggalIndo->thn_aja($dataDetail->nd_penetapan_calon_pemenang_tgl);
        $gabungan1 = $tanggal1 . ' ' . $bulan1 . ' ' . $tahun1;


        $word = new WordTemplate();
        $file = public_path('doc/pj/pengumuman_hasil.rtf');

        $array = array(
            '[nomor]' => $dataDetail->penunjukan_pemenang_nomor,
            '[tanggal]' => $gabungan,
            '[laporan_hasil_evaluasi_nomor]' => $dataDetail->laporan_hasil_evaluasi_nomor,
            '[laporan_hasil_evaluasi_tanggal]' => $gabungan,
            '[nd_penetapan_calon_pemenang_nomor]' => $dataDetail->nd_penetapan_calon_pemenang_nomor,
            '[nd_penetapan_calon_pemenang_tanggal]' => $gabungan1,
            '[judul]' => $data->judul,
            '[perusahaan_pimpinan]' => $perusahaan->pimpinan,
            '[perusahaan_sebutan_jabatan]' => $perusahaan->sebutan_jabatan,
            '[perusahaan_nama]' => $perusahaan->nama,
            '[perusahaan_alamat]' => $perusahaan->alamat,
            '[perusahaan_npwp]' => $perusahaan->npwp,
            '[pejabat_pelaksana]' => $data->pejabat_pelaksana,
            '[tender]' => $dataTender->nama


        );

        $nama_file = 'pengumuman_hasil.doc';

        return $word->export($file, $array, $nama_file);
    }


    public function downloadPembuktianUndangan($id)
    {
        $data = Pengadaan::where('id', $id)->first();
        $dataDetail = PengadaanDetailPj::where('id_pengadaan', $id)->first();
        $perusahaan = Perusahaan::where('id', $data->id_perusahaan)->first();

        $tanggalIndo = new TanggalIndo();
        $word = new WordTemplate();
        $file = public_path('doc/pj/pembuktian_kualifikasi/undangan_pembuktian_kualifikasi.rtf');
        $tanggal = $tanggalIndo->tgl_aja($dataDetail->undangan_pembuktian_kualifikasi_tgl);
        $bulan = $tanggalIndo->bln_aja($dataDetail->undangan_pembuktian_kualifikasi_tgl);
        $tahun = $tanggalIndo->thn_aja($dataDetail->undangan_pembuktian_kualifikasi_tgl);

        $tanggalEva = $tanggalIndo->tgl_aja($dataDetail->evaluasi_dok_penawaran_sampul_dua_tgl);
        $bulanEva = $tanggalIndo->bln_aja($dataDetail->evaluasi_dok_penawaran_sampul_dua_tgl);
        $tahunEva = $tanggalIndo->thn_aja($dataDetail->evaluasi_dok_penawaran_sampul_dua_tgl);

        $gabungan = $tanggal . ' ' . $bulan . ' ' . $tahun;
        $gabunganEva = $tanggalEva . ' ' . $bulanEva . ' ' . $tahunEva;
        $array = array(
            '[nomor]' => $dataDetail->undangan_pembuktian_kualifikasi_nomor,
            '[hari]' => $dataDetail->undangan_pembuktian_kualifikasi_hari,
            '[tanggal]' => $gabungan,
            '[manager]' => $data->direksi,
            '[judul]' => $data->judul,
            '[TANGGALGABUNGAN]' => $gabunganEva,
           


        );

        $nama_file = 'undangan_pembuktian_kualifikasi.doc';

        return $word->export($file, $array, $nama_file);
    }

    public function downloadPembuktianDaftarPelaksana($id)
    {
        $data = Pengadaan::where('id', $id)->first();
        $dataDetail = PengadaanDetailPj::where('id_pengadaan', $id)->first();

        $tanggalIndo = new TanggalIndo();

        $tanggal = $tanggalIndo->tgl_aja($dataDetail->undangan_pembuktian_kualifikasi_tgl);
        $bulan = $tanggalIndo->bln_aja($dataDetail->undangan_pembuktian_kualifikasi_tgl);
        $tahun = $tanggalIndo->thn_aja($dataDetail->undangan_pembuktian_kualifikasi_tgl);
        $gabungan = $tanggal . ' ' . $bulan . ' ' . $tahun;

        $word = new WordTemplate();
        $file = public_path('doc/pj/pembuktian_kualifikasi/daftar_hadir_pelaksana_kualifikasi.rtf');

        $array = array(
            '[hari]' => $dataDetail->undangan_pembuktian_kualifikasi_hari,
            '[tanggal]' => $gabungan,
            '[pejabat_pelaksana]' => $data->pejabat_pelaksana,
            '[pic_pelaksana]' => $data->pic_pelaksana,
            '[Judul]' => $data->judul,
        );

        $nama_file = 'daftar_hadir_pelaksana_kualifikasi.doc';

        return $word->export($file, $array, $nama_file);
    }

    public function downloadPembuktianDaftarPenyedia($id)
    {
        $data = Pengadaan::where('id', $id)->first();
        $dataDetail = PengadaanDetailPj::where('id_pengadaan', $id)->first();

        $tanggalIndo = new TanggalIndo();

        $tanggal = $tanggalIndo->tgl_aja($dataDetail->undangan_pembuktian_kualifikasi_tgl);
        $bulan = $tanggalIndo->bln_aja($dataDetail->undangan_pembuktian_kualifikasi_tgl);
        $tahun = $tanggalIndo->thn_aja($dataDetail->undangan_pembuktian_kualifikasi_tgl);
        $gabungan = $tanggal . ' ' . $bulan . ' ' . $tahun;

        $word = new WordTemplate();
        $file = public_path('doc/pj/pembuktian_kualifikasi/daftar_penyedia.rtf');

        $array = array(
            '[hari]' => $dataDetail->undangan_pembuktian_kualifikasi_hari,
            '[tanggal]' => $gabungan,
            '[Judul]' => $data->judul,
        );

        $nama_file = 'daftar_hadir_penyedia_kualifikasi.doc';

        return $word->export($file, $array, $nama_file);
    }

    public function downloadPembuktianRekap($id)
    {
        $data = Pengadaan::with('getmp2')->where('id', $id)->first();
        $dataDetail = PengadaanDetailPj::where('id_pengadaan', $id)->first();
        $perusahaan = Perusahaan::where('id', $data->id_perusahaan)->first();
        $orgDate = $dataDetail->rks_tgl;
        $newDate = date("d-m-Y", strtotime($orgDate));  
        $spreadsheet = new Spreadsheet();

        $loadFile = public_path('doc/pj/pembuktian_kualifikasi/rekapitulasi_kualifikasi.xlsx');
        $sSheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($loadFile);
        $worksheet = $sSheet->getSheetByName('Pembuktian Kualifikasi');
        $worksheet->setCellValue('A7', $data->judul);
        $worksheet->setCellValue('A9', 'RKS No. : ' . $dataDetail->rks_nomor);
        $worksheet->setCellValue('A10', 'Tanggal : ' . $newDate);

        $worksheet->setCellValue('F43', $data->pejabat_pelaksana);



        $date = date('d-m-y-' . substr((string)microtime(), 1, 8));
        $date = str_replace(".", "", $date);
        $filename = "export_" . $date . ".xlsx";

        try {
            $writer = new Xlsx($sSheet);
            $writer->save($filename);
            $content = file_get_contents($filename);
        } catch (Exception $e) {
            exit($e->getMessage());
        }

        header("Content-Disposition: attachment; filename=" . $filename);

        unlink($filename);
        exit($content);
    }

    public function downloadPembuktianHasil($id)
    {
        $data = Pengadaan::where('id', $id)->first();
        $dataDetail = PengadaanDetailPj::where('id_pengadaan', $id)->first();

        $tanggalIndo = new TanggalIndo();

        $tanggal = $tanggalIndo->tgl_aja($dataDetail->pembuktian_kualifikasi_tgl);
        $bulan = $tanggalIndo->bln_aja($dataDetail->pembuktian_kualifikasi_tgl);
        $tahun = $tanggalIndo->thn_aja($dataDetail->pembuktian_kualifikasi_tgl);
        $gabungan = $tanggal . ' ' . $bulan . ' ' . $tahun;

        $tanggal1 = $tanggalIndo->tgl_aja($dataDetail->addendum_rks_tgl);
        $bulan1 = $tanggalIndo->bln_aja($dataDetail->addendum_rks_tgl);
        $tahun1 = $tanggalIndo->thn_aja($dataDetail->addendum_rks_tgl);
        $gabungan1 = $tanggal1 . ' ' . $bulan1 . ' ' . $tahun1;

        $word = new WordTemplate();
        $file = public_path('doc/pj/pembuktian_kualifikasi/berita_acara_kualifikasi.rtf');

        $array = array(
            '[nomor]' => $dataDetail->pembuktian_kualifikasi_nomor,
            '[rks_nomor]' => $dataDetail->addendum_rks_nomor,
            '[rks_tanggal]' => $gabungan1,
            '[tanggal]' => $tanggal,
            '[bulan]' => $bulan,
            '[tahun]' => $tahun,
            '[Judul]' => $data->judul,
            '[pejabat_pelaksana]' => $data->pejabat_pelaksana
        );

        $nama_file = 'berita_acara_kualifikasi.doc';

        return $word->export($file, $array, $nama_file);
    }

    public function downloadPemasukanPenawaran($id)
    {
        $data = Pengadaan::where('id', $id)->first();
        $dataDetail = PengadaanDetailPj::where('id_pengadaan', $id)->first();

        $tanggalIndo = new TanggalIndo();

        $tanggal = $tanggalIndo->tgl_aja($dataDetail->pemasukan_dok_penawaran_tgl_dari);
        $bulan = $tanggalIndo->bln_aja($dataDetail->pemasukan_dok_penawaran_tgl_dari);
        $tahun = $tanggalIndo->thn_aja($dataDetail->pemasukan_dok_penawaran_tgl_dari);
        $gabungan = $tanggal . ' ' . $bulan . ' ' . $tahun;

        $tanggal1 = $tanggalIndo->tgl_aja($dataDetail->pemasukan_dok_penawaran_tgl);
        $bulan1 = $tanggalIndo->bln_aja($dataDetail->pemasukan_dok_penawaran_tgl);
        $tahun1 = $tanggalIndo->thn_aja($dataDetail->pemasukan_dok_penawaran_tgl);
        $gabungan1 = $tanggal1 . ' ' . $bulan1 . ' ' . $tahun1;

        $word = new WordTemplate();
        $file = public_path('doc/pj/pemasukan_dok_penawaran.rtf');

        $array = array(
            '[hari]' => $dataDetail->pemasukan_dok_penawaran_hari_dari,
            '[tanggal]' =>$gabungan,
            '[hari1]' => $dataDetail->pemasukan_dok_penawaran_hari,
            '[tanggal1]' => $gabungan1,
            '[Judul]' => $data->judul

        );

        $nama_file = 'pemasukan_dok_penawaran.doc';

        return $word->export($file, $array, $nama_file);
    }

    public function downloadPembukaanPenawaranBa($id)
    {
        $data = Pengadaan::where('id', $id)->first();
        $dataPekerjaan = DMetodePengadaan::where('id', $data->id_mp4)->first();
        $dataDetail = PengadaanDetailPj::where('id_pengadaan', $id)->first();
        $perusahaan = Perusahaan::where('id', $data->id_perusahaan)->first();
        $tanggalIndo = new TanggalIndo();

        $tanggal = $tanggalIndo->tgl_aja($dataDetail->pembukaan_penawaran_tgl);
        $bulan = $tanggalIndo->bln_aja($dataDetail->pembukaan_penawaran_tgl);
        $tahun = $tanggalIndo->thn_aja($dataDetail->pembukaan_penawaran_tgl);
        $gabungan = $tanggal . ' ' . $bulan . ' ' . $tahun;

        $tanggal1 = $tanggalIndo->tgl_aja($dataDetail->addendum_rks_tgl);
        $bulan1 = $tanggalIndo->bln_aja($dataDetail->addendum_rks_tgl);
        $tahun1 = $tanggalIndo->thn_aja($dataDetail->addendum_rks_tgl);
        $gabungan1 = $tanggal1 . ' ' . $bulan1 . ' ' . $tahun1;

        $tanggalRks = $tanggalIndo->tgl_aja($dataDetail->rks_tgl);
        $bulanRks = $tanggalIndo->bln_aja($dataDetail->rks_tgl);
        $tahunRks = $tanggalIndo->thn_aja($dataDetail->rks_tgl);
        $gabunganRks = $tanggalRks . ' ' . $bulanRks . ' ' . $tahunRks;



        $word = new WordTemplate();
        $file = public_path('doc/pj/pembukaan_penawaran/ba.rtf');

        $array = array(
            '[nomor]' => $dataDetail->pembukaan_penawaran_nomor,
            '[hari]' => $dataDetail->pembukaan_penawaran_hari,
            '[rks_nomor]' => $dataDetail->addendum_rks_nomor,
            '[rks_tanggal]' => $gabungan1,
            '[TANGGALRKS]' => $gabunganRks,
            '[judul]' => $data->judul,
            '[pejabat_pelaksana]' => $data->pejabat_pelaksana,
            '[tanggal]' => $tanggal,
            '[bulan]' => $bulan,
            '[tahun]' => $tahun,
            '[metode]' => $dataPekerjaan->nama,


        );

        $nama_file = 'pembukaan_dok_penawaran.doc';

        return $word->export($file, $array, $nama_file);
    }

    public function downloadPembukaanPenawaranCatatan($id)
    {
        $data = Pengadaan::with('getmp2')->where('id', $id)->first();
        $dataDetail = PengadaanDetailPj::where('id_pengadaan', $id)->first();
        $perusahaan = Perusahaan::where('id', $data->id_perusahaan)->first();
        $tanggalIndo = new TanggalIndo();


        $tanggalRks = $tanggalIndo->tgl_aja($dataDetail->rks_tgl);
        $bulanRks = $tanggalIndo->bln_aja($dataDetail->rks_tgl);
        $tahunRks = $tanggalIndo->thn_aja($dataDetail->rks_tgl);
        $gabunganRks = $tanggalRks . ' ' . $bulanRks . ' ' . $tahunRks;



        $spreadsheet = new Spreadsheet();
        $orgDate = $dataDetail->evaluasi_dok_penawaran_sampul_dua_tgl;
        $newDate = date("d-m-Y", strtotime($orgDate));  


        $loadFile = public_path('doc/pj/pembukaan_penawaran/catatan.xls');
        $sSheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($loadFile);
        $worksheet = $sSheet->getSheetByName('Catatan Pembukaan');
        $worksheet->setCellValue('A7', $data->judul);
        $worksheet->setCellValue('A9', 'RKS No. : ' . $dataDetail->evaluasi_dok_penawaran_sampul_dua_nomor);
        $worksheet->setCellValue('A10', 'Tanggal : ' . $newDate);

        $worksheet->setCellValue('H90', $data->pejabat_pelaksana);
        $worksheet->setCellValue('H83', 'Pekanbaru ,'.$gabunganRks);



        $date = date('d-m-y-' . substr((string)microtime(), 1, 8));
        $date = str_replace(".", "", $date);
        $filename = "export_" . $date . ".xlsx";

        try {
            $writer = new Xlsx($sSheet);
            $writer->save($filename);
            $content = file_get_contents($filename);
        } catch (Exception $e) {
            exit($e->getMessage());
        }

        header("Content-Disposition: attachment; filename=" . $filename);

        unlink($filename);
        exit($content);
    }


    public function downloadPembukaanPenawaranPelaksana($id)
    {
        $data = Pengadaan::where('id', $id)->first();
        $dataDetail = PengadaanDetailPj::where('id_pengadaan', $id)->first();

        $tanggalIndo = new TanggalIndo();

        $tanggal = $tanggalIndo->tgl_aja($dataDetail->pembukaan_penawaran_tgl);
        $bulan = $tanggalIndo->bln_aja($dataDetail->pembukaan_penawaran_tgl);
        $tahun = $tanggalIndo->thn_aja($dataDetail->pembukaan_penawaran_tgl);
        $gabungan = $tanggal . ' ' . $bulan . ' ' . $tahun;

        $word = new WordTemplate();
        $file = public_path('doc/pj/pembukaan_penawaran/daftar_pelaksana.rtf');

        $array = array(
            '[hari]' => $dataDetail->pembukaan_penawaran_hari,
            '[tanggal]' => $gabungan,
            '[pejabat_pelaksana]' => $data->pejabat_pelaksana,
            '[pic_pelaksana]' => $data->pic_pelaksana,
            '[Judul]' => $data->judul
        );

        $nama_file = 'daftar_hadir_pelaksana.doc';

        return $word->export($file, $array, $nama_file);
    }

    public function downloadPembukaanPenawaranPenyedia($id)
    {
        $data = Pengadaan::where('id', $id)->first();
        $dataDetail = PengadaanDetailPj::where('id_pengadaan', $id)->first();

        $tanggalIndo = new TanggalIndo();

        $tanggal = $tanggalIndo->tgl_aja($dataDetail->pembukaan_penawaran_tgl);
        $bulan = $tanggalIndo->bln_aja($dataDetail->pembukaan_penawaran_tgl);
        $tahun = $tanggalIndo->thn_aja($dataDetail->pembukaan_penawaran_tgl);
        $gabungan = $tanggal . ' ' . $bulan . ' ' . $tahun;

        $word = new WordTemplate();
        $file = public_path('doc/pj/pembukaan_penawaran/daftar_penyedia.rtf');

        $array = array(
            '[hari]' => $dataDetail->pembukaan_penawaran_hari,
            '[tanggal]' => $gabungan,
            '[Judul]' => $data->judul
        );

        $nama_file = 'daftar_hadir_penyedia.doc';

        return $word->export($file, $array, $nama_file);
    }


    public function downloadEvaPenawaranBa($id)
    {
        $data = Pengadaan::where('id', $id)->first();
        $dataDetail = PengadaanDetailPj::where('id_pengadaan', $id)->first();
        $perusahaan = Perusahaan::where('id', $data->id_perusahaan)->first();
        $tanggalIndo = new TanggalIndo();

        $tanggal = $tanggalIndo->tgl_aja($dataDetail->evaluasi_dok_penawaran_tgl);
        $bulan = $tanggalIndo->bln_aja($dataDetail->evaluasi_dok_penawaran_tgl);
        $tahun = $tanggalIndo->thn_aja($dataDetail->evaluasi_dok_penawaran_tgl);
        $gabungan = $tanggal . ' ' . $bulan . ' ' . $tahun;

        $tanggal1 = $tanggalIndo->tgl_aja($dataDetail->addendum_rks_tgl);
        $bulan1 = $tanggalIndo->bln_aja($dataDetail->addendum_rks_tgl);
        $tahun1 = $tanggalIndo->thn_aja($dataDetail->addendum_rks_tgl);
        $gabungan1 = $tanggal1 . ' ' . $bulan1 . ' ' . $tahun1;


        $word = new WordTemplate();
        $file = public_path('doc/pj/evaluasi_penawaran/ba.rtf');

        $array = array(
            '[nomor]' => $dataDetail->evaluasi_dok_penawaran_nomor,
            '[hari]' => $dataDetail->evaluasi_dok_penawaran_hari,
            '[rks_nomor]' => $dataDetail->addendum_rks_nomor,
            '[rks_tanggal]' => $gabungan1,
            '[judul]' => $data->judul,
            '[pejabat_pelaksana]' => $data->pejabat_pelaksana,
            '[tanggal]' => $tanggal,
            '[bulan]' => $bulan,
            '[tahun]' => $tahun


        );

        $nama_file = 'pembukaan_dok_penawaran.doc';

        return $word->export($file, $array, $nama_file);
    }

    public function downloadEvaPenawaranCatatan($id)
    {
        $data = Pengadaan::with('getmp2')->where('id', $id)->first();
        $dataDetail = PengadaanDetailPj::where('id_pengadaan', $id)->first();
        $perusahaan = Perusahaan::where('id', $data->id_perusahaan)->first();

        $spreadsheet = new Spreadsheet();
        $orgDate = $dataDetail->evaluasi_dok_penawaran_sampul_dua_tgl;
        $newDate = date("d-m-Y", strtotime($orgDate));  



        $loadFile = public_path('doc/pj/evaluasi_penawaran/catatan.xls');
        $sSheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($loadFile);
        $worksheet = $sSheet->getSheetByName('Hasil Koreksi');
        $worksheet->setCellValue('A7', $data->judul);
        $worksheet->setCellValue('A9', 'RKS No. : ' . $dataDetail->evaluasi_dok_penawaran_sampul_dua_nomor);
        $worksheet->setCellValue('A10', 'Tanggal : ' . $newDate);


        $worksheet1 = $sSheet->getSheetByName('Kertas Kerja');
        $worksheet1->setCellValue('A3', $data->judul);
        $worksheet1->setCellValue('A6', 'RKS No. : ' . $dataDetail->evaluasi_dok_penawaran_sampul_dua_nomor);
        $worksheet1->setCellValue('A7', 'Tanggal : ' . $newDate);

        $worksheet1->setCellValue('I48', $data->pejabat_pelaksana);



        $date = date('d-m-y-' . substr((string)microtime(), 1, 8));
        $date = str_replace(".", "", $date);
        $filename = "export_" . $date . ".xlsx";

        try {
            $writer = new Xlsx($sSheet);
            $writer->save($filename);
            $content = file_get_contents($filename);
        } catch (Exception $e) {
            exit($e->getMessage());
        }

        header("Content-Disposition: attachment; filename=" . $filename);

        unlink($filename);
        exit($content);
    }

    public function downloadEvaPenawaranDaftar($id)
    {
        $data = Pengadaan::where('id', $id)->first();
        $dataDetail = PengadaanDetailPj::where('id_pengadaan', $id)->first();

        $tanggalIndo = new TanggalIndo();

        $tanggal = $tanggalIndo->tgl_aja($dataDetail->evaluasi_dok_penawaran_tgl);
        $bulan = $tanggalIndo->bln_aja($dataDetail->evaluasi_dok_penawaran_tgl);
        $tahun = $tanggalIndo->thn_aja($dataDetail->evaluasi_dok_penawaran_tgl);
        $gabungan = $tanggal . ' ' . $bulan . ' ' . $tahun;

        $word = new WordTemplate();
        $file = public_path('doc/pj/evaluasi_penawaran/daftar_hadir.rtf');

        $array = array(
            '[hari]' => $dataDetail->evaluasi_dok_penawaran_hari,
            '[tanggal]' => $gabungan,
            '[pejabat_pelaksana]' => $data->pejabat_pelaksana,
            '[pic_pelaksana]' => $data->pic_pelaksana,
            '[Judul]' => $data->judul,
        );

        $nama_file = 'daftar_hadir_pelaksana.doc';

        return $word->export($file, $array, $nama_file);
    }

    public function downloadEvaPenawaranRekap($id)
    {
        $data = Pengadaan::with('getmp2')->where('id', $id)->first();
        $dataDetail = PengadaanDetailPj::where('id_pengadaan', $id)->first();
        $perusahaan = Perusahaan::where('id', $data->id_perusahaan)->first();

        $spreadsheet = new Spreadsheet();
  $orgDate = $dataDetail->evaluasi_dok_penawaran_sampul_dua_tgl;
        $newDate = date("d-m-Y", strtotime($orgDate));  

        $loadFile = public_path('doc/pj/evaluasi_penawaran/rekap.xls');
        $sSheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($loadFile);
        $worksheet = $sSheet->getSheetByName('Catatan Eva Adm');
        $worksheet->setCellValue('A7', $data->judul);
        $worksheet->setCellValue('A9', 'RKS No. : ' . $dataDetail->evaluasi_dok_penawaran_sampul_dua_nomor);
        $worksheet->setCellValue('A10', 'Tanggal : ' . $newDate);
        $worksheet->setCellValue('D50', $data->direksi);
        $worksheet->setCellValue('D44', $data->jabatan_direksi);
        $worksheet->setCellValue('G50', $data->pejabat_pelaksana);




        $date = date('d-m-y-' . substr((string)microtime(), 1, 8));
        $date = str_replace(".", "", $date);
        $filename = "export_" . $date . ".xlsx";

        try {
            $writer = new Xlsx($sSheet);
            $writer->save($filename);
            $content = file_get_contents($filename);
        } catch (Exception $e) {
            exit($e->getMessage());
        }

        header("Content-Disposition: attachment; filename=" . $filename);

        unlink($filename);
        exit($content);
    }

    public function downloadEvaPenawaranRekapHasil($id)
    {
        $data = Pengadaan::with('getmp2')->where('id', $id)->first();
        $dataDetail = PengadaanDetailPj::where('id_pengadaan', $id)->first();
        $perusahaan = Perusahaan::where('id', $data->id_perusahaan)->first();

        $spreadsheet = new Spreadsheet();

        $orgDate = $dataDetail->evaluasi_dok_penawaran_sampul_dua_tgl;
        $newDate = date("d-m-Y", strtotime($orgDate));  


        $loadFile = public_path('doc/pj/evaluasi_penawaran/rekap_hasil.xls');
        $sSheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($loadFile);
        $worksheet = $sSheet->getSheetByName('Catatan Eva Harga');
        $worksheet->setCellValue('A7', $data->judul);
        $worksheet->setCellValue('A9', 'RKS No. : ' . $dataDetail->evaluasi_dok_penawaran_sampul_dua_nomor);
        $worksheet->setCellValue('A10', 'Tanggal : ' . $newDate);
       
        $worksheet->setCellValue('F42', $data->pejabat_pelaksana);

        $worksheet1 = $sSheet->getSheetByName('Hasil Koreksi');
        $worksheet1->setCellValue('A7', $data->judul);
        $worksheet1->setCellValue('A9', 'RKS No. : ' . $dataDetail->evaluasi_dok_penawaran_sampul_dua_nomor);
        $worksheet1->setCellValue('A10', 'Tanggal : ' . $newDate);
     
        $worksheet1->setCellValue('H53', $data->pejabat_pelaksana);




        $date = date('d-m-y-' . substr((string)microtime(), 1, 8));
        $date = str_replace(".", "", $date);
        $filename = "export_" . $date . ".xlsx";

        try {
            $writer = new Xlsx($sSheet);
            $writer->save($filename);
            $content = file_get_contents($filename);
        } catch (Exception $e) {
            exit($e->getMessage());
        }

        header("Content-Disposition: attachment; filename=" . $filename);

        unlink($filename);
        exit($content);
    }


    public function downloadSpk($id)
    {
        $data = Pengadaan::where('id', $id)->first();
        $dataDetail = PengadaanDetailPj::where('id_pengadaan', $id)->first();

        $tanggalIndo = new TanggalIndo();

        $tanggal = $tanggalIndo->tgl_aja($dataDetail->spk_tgl);
        $bulan = $tanggalIndo->bln_aja($dataDetail->spk_tgl);
        $tahun = $tanggalIndo->thn_aja($dataDetail->spk_tgl);
        $gabungan = $tanggal . ' ' . $bulan . ' ' . $tahun;

        $word = new WordTemplate();
        $file = public_path('doc/pj/spk.rtf');

        $array = array(
            '[hari]' => $dataDetail->spk_hari,
            '[tanggal]' => $gabungan,
            '[pejabat_pelaksana]' => $data->pejabat_pelaksana,
            '[pic_pelaksana]' => $data->pic_pelaksana,
        );

        $nama_file = 'spk.doc';

        return $word->export($file, $array, $nama_file);
    }

   

}
