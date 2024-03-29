<?php


namespace App\Http\Controllers\JobCard\Spbj;


use App\Http\Controllers\Controller;
use App\Http\Controllers\Template\TanggalIndo;
use App\Http\Controllers\Template\TerbilangIndo;
use App\Pengadaan;
use App\Perusahaan;
use App\PengadaanDetailSpbj;
use App\PengadaanDetailSpk;
use Novay\WordTemplate\WordTemplate;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use App\Http\Controllers\JobCard\Spbj\HPS;
use Illuminate\Support\Facades\Response;
class DownloadControllerSpbj extends Controller
{
    public function downloadRks($id){
        $data = Pengadaan::with('getmp2')->where('id',$id)->first();
        $dataDetail = PengadaanDetailSpbj::where('id_pengadaan',$id)->first();

        $tanggalIndo = new TanggalIndo();

        $tanggal=$tanggalIndo->tgl_aja($dataDetail->rks_tgl);
        $bulan=$tanggalIndo->bln_aja($dataDetail->rks_tgl);
        $tahun=$tanggalIndo->thn_aja($dataDetail->rks_tgl);

        $gabungan = $tanggal.' '.$bulan.' '.$tahun;

        $word = new WordTemplate();
        $file = public_path('doc/spk/rks.rtf');

        $array = array(
            '[Judul]' => $data->judul,
            '[Nomor_Rks]' => $dataDetail->rks_nomor,
            '[Tanggal_Rks]' => $gabungan,
            '[tahun]' => $data->tahun,
            '[Tahun_Anggaran]' => $data->tahun,
            '[Metode_Pengadaan]' => $data['getmp2']['nama'],
            '[Pengguna]' => $data->pengguna,
            '[Pejabat_Pelaksana]' => $data->pejabat_pelaksana,
            '[Judul]' => $data->judul,
            '[tahun]' => $data->tahun,
            '[Nomor_Rks]' => $dataDetail->rks_nomor,
            '[Tanggal_Rks]' => $gabungan,
            '[Tahun_Anggaran]' => $data->tahun,
            '[Metode_Pengadaan]' => $data['getmp2']['nama'],
            '[Metode_Pembayaran]' => $data->cara_pembayaran,
            '[Alamat]' => $data->tempat_penyerahan,
            '[Jangka_Waktu]' => $data->masa_berlaku_surat,
            '[Alamat_Pelaksana]' => $data->tempat_penyerahan,
            '[Manager_Bagian]' => $data->direksi,
            '[Manager]' => $data->pengguna,
            '[Masa_Garansi]' => $data->masa_garansi

        );

        $nama_file = 'rks.doc';

        return $word->export($file, $array, $nama_file);
    }

    public function downloadSurveyHargaPasar($id){
        $data = Pengadaan::where('id',$id)->first();
        $dataDetail = PengadaanDetailSpbj::where('id_pengadaan',$id)->first();

        $tanggalIndo = new TanggalIndo();

        $tanggal=$tanggalIndo->tgl_aja($dataDetail->survey_harga_pasar_tgl);
        $bulan=$tanggalIndo->bln_aja($dataDetail->survey_harga_pasar_tgl);
        $tahun=$tanggalIndo->thn_aja($dataDetail->survey_harga_pasar_tgl);

        $word = new WordTemplate();
        $file = public_path('doc/spk/survey_harga_pasar.rtf');

        $array = array(
            '[nomor]' => $dataDetail->survey_harga_pasar_nomor,
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

    public function downloadSurveyHargaPasar2($id){
        $data = Pengadaan::where('id',$id)->first();
        $dataDetail = PengadaanDetailSpbj::where('id_pengadaan',$id)->first();

        $tanggalIndo = new TanggalIndo();

        $tanggal=$tanggalIndo->tgl_aja($dataDetail->survey_harga_pasar_tgl);
        $bulan=$tanggalIndo->bln_aja($dataDetail->survey_harga_pasar_tgl);
        $tahun=$tanggalIndo->thn_aja($dataDetail->survey_harga_pasar_tgl);
        $gabungan = $tanggal.' '.$bulan.' '.$tahun;

        $word = new WordTemplate();
        $file = public_path('doc/spk/survey_harga_pasar2.rtf');

        $array = array(
            '[Tanggal_shp]' => $gabungan,
            '[Tempat_Pengadaan]' => $data->tempat_penyerahan,
        );

        $nama_file = 'survey-harga-pasar2.doc';

        return $word->export($file, $array, $nama_file);
    }

    public function downloadHps($id)
    {
        $surveiHarga = new HPS();
        $surveiHarga->HPS($id);

        $data = Pengadaan::where('id', $id)->first();
        $file = public_path('data-pengadaan') . "/hps/" . $data->judul . '.xlsx';

        $headers = array(
            'Content-Type: application/xlsx',
        );

        return Response::download($file, $data->judul . ' HPS.xlsx', $headers);
    }

    public function downloadUpl($id){
        $data = Pengadaan::with('getperusahaan')->where('id',$id)->first();
        $dataDetail = PengadaanDetailSpbj::where('id_pengadaan',$id)->first();

        $tanggalIndo = new TanggalIndo();

        $tanggalPdari=$tanggalIndo->tgl_aja($dataDetail->pemasukan_dok_penawaran_tgl_dari);
        $bulanPdari=$tanggalIndo->bln_aja($dataDetail->pemasukan_dok_penawaran_tgl_dari);
        $tahunPdari=$tanggalIndo->thn_aja($dataDetail->pemasukan_dok_penawaran_tgl_dari);

        $gabunganPdari = $tanggalPdari.' '.$bulanPdari.' '.$tahunPdari;

        $tanggalPsampai=$tanggalIndo->tgl_aja($dataDetail->pemasukan_dok_penawaran_tgl_dari);
        $bulanPsampai=$tanggalIndo->bln_aja($dataDetail->pemasukan_dok_penawaran_tgl_dari);
        $tahunPsampai=$tanggalIndo->thn_aja($dataDetail->pemasukan_dok_penawaran_tgl_dari);

        $gabunganPsampai = $tanggalPsampai.' '.$bulanPsampai.' '.$tahunPsampai;

        $tanggalEdari=$tanggalIndo->tgl_aja($dataDetail->evaluasi_dok_penawaran_tgl);
        $bulanEdari=$tanggalIndo->bln_aja($dataDetail->evaluasi_dok_penawaran_tgl);
        $tahunEdari=$tanggalIndo->thn_aja($dataDetail->evaluasi_dok_penawaran_tgl);

        $gabunganEdari = $tanggalEdari.' '.$bulanEdari.' '.$tahunEdari;

        $tanggalEsampai=$tanggalIndo->tgl_aja($dataDetail->evaluasi_dokumen_tgl_sd);
        $bulanEsampai=$tanggalIndo->bln_aja($dataDetail->evaluasi_dokumen_tgl_sd);
        $tahunEsampai=$tanggalIndo->thn_aja($dataDetail->evaluasi_dokumen_tgl_sd);

        $gabunganEsampai = $tanggalEsampai.' '.$bulanEsampai.' '.$tahunEsampai;

        $tanggalSpk=$tanggalIndo->tgl_aja($dataDetail->spk_tgl);
        $bulanSpk=$tanggalIndo->bln_aja($dataDetail->spk_tgl);
        $tahunSpk=$tanggalIndo->thn_aja($dataDetail->spk_tgl);

        $gabunganSpk = $tanggalSpk.' '.$bulanSpk.' '.$tahunSpk;


        $tanggal=$tanggalIndo->tgl_aja($dataDetail->undangan_pengadaan_langsung_tgl);
        $bulan=$tanggalIndo->bln_aja($dataDetail->undangan_pengadaan_langsung_tgl);
        $tahun=$tanggalIndo->thn_aja($dataDetail->undangan_pengadaan_langsung_tgl);

        $gabungan = $tanggal.' '.$bulan.' '.$tahun;

        $word = new WordTemplate();
        $file = public_path('doc/spk/undangan_pengadaan_langsung.rtf');




        $array = array(
            '[nomor]' => $dataDetail->undangan_pengadaan_langsung_nomor,
            '[tanggal]'=>$gabungan,
            '[alamat_pt]' => $data['getperusahaan']['alamat'],
            '[Perusahaan]' => $data['getperusahaan']['nama'],
            '[Perusahaan1]' => $data['getperusahaan']['nama'],
            '[Judul]' => $data->judul,
            '[Judul1]' => $data->judul,
            '[Nilai]' => $data->hps,
            '[Tahun_Anggaran]' => $data->tahun,
            '[Pemasukan_Tgl_Dari]' => $gabunganPdari,
            '[Pemasukan_Tgl_Sampai]' => $gabunganPsampai,
            '[Evaluasi_Tgl_Dari]' => $gabunganEdari,
            '[Evaluasi_Tgl_Sampai]' => $gabunganEsampai,
            '[Spk_Tgl]' => $gabunganSpk,
            '[Ketua_Tim]' => $data->pengguna,


        );

        $nama_file = 'undangan-pengadaan-langsung.doc';

        return $word->export($file, $array, $nama_file);
    }

    public function downloadEvaluasiDokumen1($id){
        $data = Pengadaan::with('getperusahaan')->where('id',$id)->first();
        $dataDetail = PengadaanDetailSpbj::where('id_pengadaan',$id)->first();

        $tanggalIndo = new TanggalIndo();

        $tanggal=$tanggalIndo->tgl_aja($dataDetail->pemasukan_dok_penawaran_tgl_dari);
        $bulan=$tanggalIndo->bln_aja($dataDetail->pemasukan_dok_penawaran_tgl_dari);
        $tahun=$tanggalIndo->thn_aja($dataDetail->pemasukan_dok_penawaran_tgl_dari);
        $gabungan = $tanggal.' '.$bulan.' '.$tahun;

        $tanggal1=$tanggalIndo->tgl_aja($dataDetail->rks_tgl);
        $bulan1=$tanggalIndo->bln_aja($dataDetail->rks_tgl);
        $tahun1=$tanggalIndo->thn_aja($dataDetail->rks_tgl);
        $gabungan1 = $tanggal1.' '.$bulan1.' '.$tahun1;

        $word = new WordTemplate();
        $file = public_path('doc/spk/pemasukan_dok_penawaran.rtf');

        $array = array(
            '[nomor]' => $dataDetail->evaluasi_dok_penawaran_nomor,
            '[Judul]' => $data->judul,
            '[Rks]' => $dataDetail->rks_nomor,
            '[Rks1]' => $dataDetail->rks_nomor,
            '[Tanggal_Rks]' => $gabungan1,
            '[Hari]' => $dataDetail->pemasukan_dok_penawaran_hari_dari,
            '[Tanggal]' => $tanggalIndo->terbilang($tanggal),
            '[Bulan]' => $bulan,
            '[Tahun]' => $tanggalIndo->terbilang($tahun),
            '[Judul1]' => $data->judul,
            '[Judul2]' => $data->judul,
            '[Direktur_Utama]' => $data['getperusahaan']['pimpinan'],
            '[Pejabat_Pelaksana]' => $data->pejabat_pelaksana,
            '[Tanggal_Pdp]' => $gabungan,
            '[Tanggal_Pdp1]' =>$gabungan,


        );

        $nama_file = 'evaluasi_dokumen1.doc';

        return $word->export($file, $array, $nama_file);
    }

    public function downloadEvaluasiDokumen2($id){
        $data = Pengadaan::with('getperusahaan')->where('id',$id)->first();
        $dataDetail = PengadaanDetailSpbj::where('id_pengadaan',$id)->first();

        $tanggalIndo = new TanggalIndo();

        $tanggal=$tanggalIndo->tgl_aja($dataDetail->pemasukan_dok_penawaran_tgl_dari);
        $bulan=$tanggalIndo->bln_aja($dataDetail->pemasukan_dok_penawaran_tgl_dari);
        $tahun=$tanggalIndo->thn_aja($dataDetail->pemasukan_dok_penawaran_tgl_dari);
        $gabungan = $tanggal.' '.$bulan.' '.$tahun;

        $tanggal1=$tanggalIndo->tgl_aja($dataDetail->rks_tgl);
        $bulan1=$tanggalIndo->bln_aja($dataDetail->rks_tgl);
        $tahun1=$tanggalIndo->thn_aja($dataDetail->rks_tgl);
        $gabungan1 = $tanggal1.' '.$bulan1.' '.$tahun1;

        $word = new WordTemplate();
        $file = public_path('doc/spk/eva_dok_penawaran.rtf');

        $array = array(
            '[nomor]' => $dataDetail->evaluasi_dok_penawaran_nomor,
            '[Judul]' => $data->judul,
            '[Rks]' => $dataDetail->rks_nomor,
            '[Tanggal_Rks]' => $gabungan1,
            '[Hari]' => $dataDetail->pemasukan_dok_penawaran_hari_dari,
            '[Tanggal]' => $tanggalIndo->terbilang($tanggal),
            '[Bulan]' => $bulan,
            '[Tahun]' => $tanggalIndo->terbilang($tahun),
            '[Judul1]' => $data->judul,
            '[Direktur_Utama]' => $data['getperusahaan']['pimpinan'],
            '[Pejabat_Pelaksana]' => $data->pejabat_pelaksana,
            '[Manager_Bagian]' => $data->direksi,
            '[Nama_Perusahaan]' => $data['getperusahaan']['nama'],
            '[Alamat]' => $data['getperusahaan']['alamat'],
            '[Npwp]' => $data['getperusahaan']['npwp'],

        );

        $nama_file = 'evaluasi_dokumen1.doc';

        return $word->export($file, $array, $nama_file);
    }

    public function downloadEvaluasiDokumen3($id){
        $data = Pengadaan::with('getperusahaan')->where('id',$id)->first();
        $dataDetail = PengadaanDetailSpbj::where('id_pengadaan',$id)->first();

        $tanggalIndo = new TanggalIndo();

        $tanggal=$tanggalIndo->tgl_aja($dataDetail->pemasukan_dok_penawaran_tgl_dari);
        $bulan=$tanggalIndo->bln_aja($dataDetail->pemasukan_dok_penawaran_tgl_dari);
        $tahun=$tanggalIndo->thn_aja($dataDetail->pemasukan_dok_penawaran_tgl_dari);
        $gabungan = $tanggal.' '.$bulan.' '.$tahun;

        $word = new WordTemplate();
        $file = public_path('doc/spk/daftar_hadir_eva_dok.rtf');

        $array = array(
            '[Judul]' => $data->judul,
            '[Tanggal]' => $gabungan,
            '[Pejabat_Pelaksana]' => $data->pejabat_pelaksana,
            '[Pic_Pelaksana]' => $data->pic_pelaksana,
            '[Direksi]' => $data->direksi
        );

        $nama_file = 'evaluasi_dokumen1.doc';

        return $word->export($file, $array, $nama_file);
    }

    public function downloadBeritaAcaraKlarifikasi($id)
    {
        $data = Pengadaan::where('id', $id)->first();
        $dataDetail = PengadaanDetailSpbj::where('id_pengadaan', $id)->first();
        $perusahaan = Perusahaan::where('id', $data->id_perusahaan)->first();
        $tanggalIndo = new TanggalIndo();
        $terbilangIndo = new TerbilangIndo();

        $tanggal = $tanggalIndo->tgl_aja($dataDetail->ba_hasil_klarifikasi_dan_nego_penawaran_tgl);
        $bulan = $tanggalIndo->bln_aja($dataDetail->ba_hasil_klarifikasi_dan_nego_penawaran_tgl);
        $tahun = $tanggalIndo->thn_aja($dataDetail->ba_hasil_klarifikasi_dan_nego_penawaran_tgl);
        $gabungan = $tanggal . ' ' . $bulan . ' ' . $tahun;

        $tanggal1 = $tanggalIndo->tgl_aja($dataDetail->rks_tgl);
        $bulan1 = $tanggalIndo->bln_aja($dataDetail->rks_tgl);
        $tahun1 = $tanggalIndo->thn_aja($dataDetail->rks_tgl);
        $gabungan1 = $tanggal1 . ' ' . $bulan1 . ' ' . $tahun1;


        $word = new WordTemplate();
        $file = public_path('doc/spbj/berita_acara_klarifikasi.rtf');

        $array = array(
            '[hari]' => $dataDetail->ba_hasil_klarifikasi_dan_nego_penawaran_hari,
            '[tanggal]' => $tanggal,
            '[bulan]' => $bulan,
            '[tahun]' => $tahun,
            '[nomor]' => $dataDetail->ba_hasil_klarifikasi_dan_nego_penawaran_nomor,
            '[rks_nomor]' => $dataDetail->rks_nomor,
            '[rks_tanggal]' => $gabungan1,
            '[hps]' => $terbilangIndo->terbilang($data->hps),
            '[penawaran]' => $terbilangIndo->terbilang($data->harga_penawaran),
            '[perusahaan_nama]' => $perusahaan->nama,
            '[sebutan_dpt]' => $perusahaan->sebutan_jabatan,
            '[waktu_penyelesaian]' => $data->jangka_waktu,
            '[perusahaan_alamat]' => $perusahaan->alamat,
            '[perusahaan_npwp]' => $perusahaan->npwp,
            '[perusahaan_pimpinan]' => $perusahaan->pimpinan,
            '[pejabat_pelaksana]' => $data->pejabat_pelaksana,
            '[manager]' => $data->direksi,
        );

        $nama_file = 'berita_acara_klarifikasi.doc';

        return $word->export($file, $array, $nama_file);
    }

    public function downloadRekapitulasi($id)
    {
        $data = Pengadaan::with('getmp2')->where('id', $id)->first();
        $dataDetail = PengadaanDetailPj::where('id_pengadaan', $id)->first();
        $perusahaan = Perusahaan::where('id', $data->id_perusahaan)->first();

        $spreadsheet = new Spreadsheet();

        $loadFile = public_path('doc/pj/klarifikasi_dan_nego/rekapitulasi.xls');
        $sSheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($loadFile);
        $worksheet = $sSheet->getSheetByName('Hasil Koreksi');
        $worksheet->setCellValue('A10', 'RKS No. : ' . $dataDetail->addendum_rks_nomor);
        $worksheet->setCellValue('A9', 'Tanggal : ' . $dataDetail->addendum_rks_tgl);

        $worksheet->setCellValue('C43', $perusahaan->pimpinan);
        $worksheet->setCellValue('G43', $data->pejabat_pelaksana);
        $worksheet->setCellValue('D52', $data->direksi);

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

    public function downloadPemasukanPenawaran($id)
    {
        $data = Pengadaan::where('id', $id)->first();
        $dataDetail = PengadaanDetailSpbj::where('id_pengadaan', $id)->first();

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
        $file = public_path('doc/spbj/pemasukan_dok_penawaran.rtf');

        $array = array(
            '[Judul]' => $data->judul,
            '[hari]' => $dataDetail->pemasukan_dok_penawaran_hari_dari,
            '[tanggal]' =>$gabungan,
            '[hari1]' => $dataDetail->pemasukan_dok_penawaran_hari,
            '[tanggal1]' => $gabungan1,

        );

        $nama_file = 'pemasukan_dok_penawaran.doc';

        return $word->export($file, $array, $nama_file);
    }


    public function downloadBaHasilPengadaanLangsung1($id){
        $data = Pengadaan::with('getperusahaan')->where('id',$id)->first();
        $dataDetail = PengadaanDetailSpbj::where('id_pengadaan',$id)->first();

        $tanggalIndo = new TanggalIndo();

        $tanggal=$tanggalIndo->tgl_aja($dataDetail->ba_hasil_pengadaan_tgl);
        $bulan=$tanggalIndo->bln_aja($dataDetail->ba_hasil_pengadaan_tgl);
        $tahun=$tanggalIndo->thn_aja($dataDetail->ba_hasil_pengadaan_tgl);
        $gabungan = $tanggal.' '.$bulan.' '.$tahun;

        $tanggal1=$tanggalIndo->tgl_aja($dataDetail->rks_tgl);
        $bulan1=$tanggalIndo->bln_aja($dataDetail->rks_tgl);
        $tahun1=$tanggalIndo->thn_aja($dataDetail->rks_tgl);
        $gabungan1 = $tanggal1.' '.$bulan1.' '.$tahun1;

        $word = new WordTemplate();
        $file = public_path('doc/spk/hasil_pengadaan_langsung.rtf');

        $array = array(
            '[Judul]' => $data->judul,
            '[Rks]' => $dataDetail->rks_nomor,
            '[Tanggal_Rks]' => $gabungan1,
            '[Tanggal_Hpl]' => $gabungan,
            '[Hari]' => $dataDetail->ba_hasil_klarifikasi_hari,
            '[Hps]' => $data->harga_penawaran,
            '[Hps_Pajak]' => $data->harga_kontrak,
            '[Waktu_Penyelesaian]' => $data->jangka_waktu,
            '[Tanggal_Penuh]' => $gabungan,
            '[Tanggal]' => $tanggalIndo->terbilang($tanggal),
            '[Bulan]' => $bulan,
            '[Tahun]' => $tanggalIndo->terbilang($tahun),
            '[Pejabat_Pelaksana]' => $data->pejabat_pelaksana,
            '[Disusun]' => $data->vmfc,
            '[Direktur]' => $data['getperusahaan']['pimpinan'],
            '[Nama_Perusahaan]' => $data['getperusahaan']['nama'],
            '[Alamat]' => $data['getperusahaan']['alamat'],
            '[Npwp]' => $data['getperusahaan']['npwp'],

        );

        $nama_file = 'hasil-pengadaan-langsung.doc';

        return $word->export($file, $array, $nama_file);
    }

    public function downloadBaHasilPengadaanLangsung2($id){
        $data = Pengadaan::with('getperusahaan')->where('id',$id)->first();
        $dataDetail = PengadaanDetailSpbj::where('id_pengadaan',$id)->first();

        $tanggalIndo = new TanggalIndo();

        $tanggal=$tanggalIndo->tgl_aja($dataDetail->ba_hasil_pengadaan_tgl);
        $bulan=$tanggalIndo->bln_aja($dataDetail->ba_hasil_pengadaan_tgl);
        $tahun=$tanggalIndo->thn_aja($dataDetail->ba_hasil_pengadaan_tgl);
        $gabungan = $tanggal.' '.$bulan.' '.$tahun;

        $word = new WordTemplate();
        $file = public_path('doc/spk/daftar_hadir_hasil_pengadaan.rtf');

        $array = array(
            '[Judul]' => $data->judul,
            '[Tanggal]' => $gabungan,
            '[Pejabat_Pelaksana]' => $data->pejabat_pelaksana,
            '[Pic_Pelaksana]' => $data->pic_pelaksana,
            '[Direksi]' => $data->direksi
        );

        $nama_file = 'daftar_hadir_hasil_pengadaan.doc';

        return $word->export($file, $array, $nama_file);
    }

    public function downloadNdUsulanTetapPemenang($id){
        $data = Pengadaan::with('getperusahaan')->where('id',$id)->first();
        $dataDetail = PengadaanDetailSpbj::where('id_pengadaan',$id)->first();

        $tanggalIndo = new TanggalIndo();

        $tanggal=$tanggalIndo->tgl_aja($dataDetail->nd_usulan_tetap_pemenang_tgl);
        $bulan=$tanggalIndo->bln_aja($dataDetail->nd_usulan_tetap_pemenang_tgl);
        $tahun=$tanggalIndo->thn_aja($dataDetail->nd_usulan_tetap_pemenang_tgl);
        $gabungan = $tanggal.' '.$bulan.' '.$tahun;


        $tanggal2=$tanggalIndo->tgl_aja($dataDetail->ba_hasil_pengadaan_tgl);
        $bulan2=$tanggalIndo->bln_aja($dataDetail->ba_hasil_pengadaan_tgl);
        $tahun2=$tanggalIndo->thn_aja($dataDetail->ba_hasil_pengadaan_tgl);
        $gabungan2 = $tanggal2.' '.$bulan2.' '.$tahun2;


        $tanggal1=$tanggalIndo->tgl_aja($dataDetail->rks_tgl);
        $bulan1=$tanggalIndo->bln_aja($dataDetail->rks_tgl);
        $tahun1=$tanggalIndo->thn_aja($dataDetail->rks_tgl);
        $gabungan1 = $tanggal1.' '.$bulan1.' '.$tahun1;

        $word = new WordTemplate();
        $file = public_path('doc/spk/nd_usulan.rtf');

        $array = array(
            '[Judul]' => $data->judul,
            '[Rks]' => $dataDetail->rks_nomor,
            '[Tanggal_Rks]' => $gabungan1,
            '[Nd_Tanggal]' => $gabungan,
            '[Hari]' => $dataDetail->nd_usulan_tetap_pemenang_hari,
            '[Nd_Nomor]' => $dataDetail->nd_usulan_tetap_pemenang_nomor,
            '[Ba_Hasil_Pengadaan_Nomor]' => $dataDetail->ba_hasil_pengadaan_nomor,
            '[Ba_Tanggal]' => $gabungan2,
            '[Hps]' => $data->harga_penawaran,
            '[Hps_Pajak]' => $data->harga_kontrak,
            '[Waktu_Pelaksanaan]' => $data->jangka_waktu,
            '[Tanggal_Penuh]' => $gabungan,
            '[Tanggal]' => $tanggalIndo->terbilang($tanggal),
            '[Bulan]' => $bulan,
            '[Tahun]' => $tanggalIndo->terbilang($tahun),
            '[Ketua_Pelaksana]' => $data->ketua_tim,
            '[Pejabat_Pelaksana]' => $data->pejabat_pelaksana,
            '[Disusun]' => $data->vmfc,
            '[Direktur]' => $data['getperusahaan']['pimpinan'],
            '[Nama_Perusahaan]' => $data['getperusahaan']['nama'],
            '[Alamat]' => $data['getperusahaan']['alamat'],
            '[Npwp]' => $data['getperusahaan']['npwp'],

        );

        $nama_file = 'nd_usulan_tetap_pemenang.doc';

        return $word->export($file, $array, $nama_file);
    }


    public function downloadSpk($id){
        $data = Pengadaan::with('getperusahaan')->where('id',$id)->first();
        $dataDetail = PengadaanDetailSpbj::where('id_pengadaan',$id)->first();

        $tanggalIndo = new TanggalIndo();
        $terbilangIndo = new TerbilangIndo();
        

        $tanggal=$tanggalIndo->tgl_aja($dataDetail->ba_hasil_pengadaan_tgl);
        $bulan=$tanggalIndo->bln_aja($dataDetail->ba_hasil_pengadaan_tgl);
        $tahun=$tanggalIndo->thn_aja($dataDetail->ba_hasil_pengadaan_tgl);
        $gabungan = $tanggal.' '.$bulan.' '.$tahun;

        $tanggal1=$tanggalIndo->tgl_aja($dataDetail->rks_tgl);
        $bulan1=$tanggalIndo->bln_aja($dataDetail->rks_tgl);
        $tahun1=$tanggalIndo->thn_aja($dataDetail->rks_tgl);
        $gabungan1 = $tanggal1.' '.$bulan1.' '.$tahun1;

        $tanggal2=$tanggalIndo->tgl_aja($dataDetail->nd_penetapan_pemenang_tanggal);
        $bulan2=$tanggalIndo->bln_aja($dataDetail->nd_penetapan_pemenang_tanggal);
        $tahun2=$tanggalIndo->thn_aja($dataDetail->nd_penetapan_pemenang_tanggal);
        $gabungan2 = $tanggal2.' '.$bulan2.' '.$tahun2;

        $tanggal3=$tanggalIndo->tgl_aja($dataDetail->nd_usulan_tetap_pemenang_tanggal);
        $bulan3=$tanggalIndo->bln_aja($dataDetail->nd_usulan_tetap_pemenang_tanggal);
        $tahun3=$tanggalIndo->thn_aja($dataDetail->nd_usulan_tetap_pemenang_tanggal);
        $gabungan3 = $tanggal3.' '.$bulan3.' '.$tahun3;

        $tanggal4=$tanggalIndo->tgl_aja($dataDetail->ba_hasil_klarifikasi_tanggal);
        $bulan4=$tanggalIndo->bln_aja($dataDetail->ba_hasil_klarifikasi_tanggal);
        $tahun4=$tanggalIndo->thn_aja($dataDetail->ba_hasil_klarifikasi_tanggal);
        $gabungan4 = $tanggal4.' '.$bulan4.' '.$tahun4;

        $tanggal5=$tanggalIndo->tgl_aja($dataDetail->undangan_pengadaan_langsung_tanggal);
        $bulan5=$tanggalIndo->bln_aja($dataDetail->undangan_pengadaan_langsung_tanggal);
        $tahun5=$tanggalIndo->thn_aja($dataDetail->undangan_pengadaan_langsung_tanggal);
        $gabungan5 = $tanggal5.' '.$bulan5.' '.$tahun5;


        $word = new WordTemplate();
        $file = public_path('doc/spk/spk.rtf');

       

        $array = array(
            '[Judul]' => $data->judul,
            '[tempat_penyerahan]' => $data->tempat_penyerahan,
            '[Tanggal]' => $gabungan,
            '[Nama_Perusahaan]' => $data['getperusahaan']['nama'],
            '[Alamat]' => $data['getperusahaan']['alamat'],
            '[vmfc1]' => $data->vmfc1,
            '[Rks]' => $dataDetail->rks_nomor,
            '[Rks_Tanggal]' => $gabungan1,
            '[nd_penetapan_pemenang_nomor]' => $dataDetail->nd_penetapan_pemenang_nomor,
            '[nd_penetapan_pemenang_tanggal]' => $gabungan2,
            '[nd_usulan_tetap_pemenang_nomor]' => $dataDetail->nd_usulan_tetap_pemenang_nomor,
            '[nd_usulan_tetap_pemenang_tanggal]' => $gabungan3,
            '[ba_hasil_klarifikasi_nomor]' => $dataDetail->ba_hasil_klarifikasi_nomor,
            '[ba_hasil_klarifikasi_tanggal]' => $gabungan4,
            '[undangan_pengadaan_langsung_nomor]' => $dataDetail->undangan_pengadaan_langsung_nomor,
            '[undangan_pengadaan_langsung_tanggal]' => $gabungan5,
        );

        $nama_file = 'spk.doc';

        return $word->export($file, $array, $nama_file);
    }

    public function downloadSpbj($id){
        $data = Pengadaan::with('getmp2','getperusahaan')->where('id', $id)->first();
        $dataDetail = PengadaanDetailSpbj::where('id_pengadaan', $id)->first();

        $spreadsheet = new Spreadsheet();

        $loadFile = public_path('doc/spbj/spbj.xlsx');
        $sSheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($loadFile);
        $worksheet = $sSheet->getSheetByName('Surat Pesanan');
        $worksheet->setCellValue('A8', 'Nomor SPBJ : '.$dataDetail->spbj_nomor);
        $worksheet->setCellValue('A9', 'Tanggal : '.$dataDetail->spbj_tgl);
        $worksheet->setCellValue('E16', $dataDetail->undangan_pengadaan_langsung_nomor);
        $worksheet->setCellValue('E17', $dataDetail->ba_hasil_klarifikasi_dan_nego_penawaran_nomor);

        $worksheet->setCellValue('H16', $dataDetail->undangan_pengadaan_langsung_tgl);
        $worksheet->setCellValue('H17', $dataDetail->ba_hasil_klarifikasi_dan_nego_penawaran_tgl);

        $worksheet->setCellValue('C82',  $data['getperusahaan']['pimpinan']);
        $worksheet->setCellValue('G82', $data->pengguna);

        $worksheet1 = $sSheet->getSheetByName('Lampiran Rincian SPBJ');
        $worksheet1->setCellValue('E7', $dataDetail->spbj_nomor);
        $worksheet1->setCellValue('E8', $dataDetail->spbj_tanggal);
        $worksheet1->setCellValue('C73', $data['getperusahaan']['nama']);
        $worksheet1->setCellValue('E75', $data->ketua_tim);
        $worksheet1->setCellValue('H75', $data->pejabat_pelaksana);

        $date = date('d-m-y-'.substr((string)microtime(), 1, 8));
        $date = str_replace(".", "", $date);
        $filename = "export_".$date.".xlsx";

        try {
            $writer = new Xlsx($sSheet);
            $writer->save($filename);
            $content = file_get_contents($filename);
        } catch(Exception $e) {
            exit($e->getMessage());
        }

        header("Content-Disposition: attachment; filename=".$filename);

        unlink($filename);
        exit($content);
    }






}
