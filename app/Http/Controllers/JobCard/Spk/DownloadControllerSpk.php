<?php


namespace App\Http\Controllers\JobCard\Spk;


use App\Http\Controllers\Controller;
use App\Http\Controllers\Template\TanggalIndo;
use App\Http\Controllers\Template\TerbilangIndo;

use App\Pengadaan;
use App\PengadaanDetailSpk;
use App\Perusahaan;
use Novay\WordTemplate\WordTemplate;

class DownloadControllerSpk extends Controller
{
    public function downloadRks($id){
        $data = Pengadaan::with('getmp2')->where('id',$id)->first();
        $dataDetail = PengadaanDetailSpk::where('id_pengadaan',$id)->first();

        $tanggalIndo = new TanggalIndo();

        $tanggal=$tanggalIndo->tgl_aja($dataDetail->rks_tgl);
        $bulan=$tanggalIndo->bln_aja($dataDetail->rks_tgl);
        $tahun=$tanggalIndo->thn_aja($dataDetail->rks_tgl);

        $gabungan = $tanggal.' '.$bulan.' '.$tahun;

        $word = new WordTemplate();
        $file = public_path('doc/spk/rks.rtf');

        $array = array(
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
            '[Masa]' => $data->masa_berlaku_surat,
            '[Jangka_Waktu]' => $data->jangka_waktu,
            '[Alamat_Pelaksana]' => $data->alamat_penyerahan,
            '[Direksi]' => $data->direksi,
            '[Jabatan_Direksi]' => $data->jabatan_direksi,
            '[Manager]' => $data->pengguna,
            '[Masa_Garansi]' => $data->masa_garansi,
            '[Lingkup_Pekerjaan]' => $data->lingkup_pekerjaan,
            '[Jenis_Perjanjian]' => $data->jenis_perjanjian,
            '[Material]' => $data->coo

        );

        $nama_file = 'rks.doc';

        return $word->export($file, $array, $nama_file);
    }

    public function downloadSurveyHargaPasar($id){
        $data = Pengadaan::where('id',$id)->first();
        $dataDetail = PengadaanDetailSpk::where('id_pengadaan',$id)->first();

        $tanggalIndo = new TanggalIndo();

        $tanggal=$tanggalIndo->tgl_aja($dataDetail->survei_harga_pasar_tgl);
        $bulan=$tanggalIndo->bln_aja($dataDetail->survei_harga_pasar_tgl);
        $tahun=$tanggalIndo->thn_aja($dataDetail->survei_harga_pasar_tgl);

        $word = new WordTemplate();
        $file = public_path('doc/spk/survey_harga_pasar.rtf');

        $array = array(
            '[nomor]' => $dataDetail->survei_harga_pasar_nomor,
            '[Judul]' => $data->judul,
            '[Hari]' => $dataDetail->survei_harga_pasar_hari,
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
        $dataDetail = PengadaanDetailSpk::where('id_pengadaan',$id)->first();

        $tanggalIndo = new TanggalIndo();

        $tanggal=$tanggalIndo->tgl_aja($dataDetail->survei_harga_pasar_tgl);
        $bulan=$tanggalIndo->bln_aja($dataDetail->survei_harga_pasar_tgl);
        $tahun=$tanggalIndo->thn_aja($dataDetail->survei_harga_pasar_tgl);
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

   

    public function downloadUpl($id){
        $data = Pengadaan::with('getperusahaan')->where('id',$id)->first();
        $dataDetail = PengadaanDetailSpk::where('id_pengadaan',$id)->first();

        $tanggalIndo = new TanggalIndo();

        $tanggalPdari=$tanggalIndo->tgl_aja($dataDetail->pemasukan_dok_penawaran_tgl_dari);
        $bulanPdari=$tanggalIndo->bln_aja($dataDetail->pemasukan_dok_penawaran_tgl_dari);
        $tahunPdari=$tanggalIndo->thn_aja($dataDetail->pemasukan_dok_penawaran_tgl_dari);

        $gabunganPdari = $tanggalPdari.' '.$bulanPdari.' '.$tahunPdari;

        $tanggalPsampai=$tanggalIndo->tgl_aja($dataDetail->pemasukan_dok_penawaran_tgl_sd);
        $bulanPsampai=$tanggalIndo->bln_aja($dataDetail->pemasukan_dok_penawaran_tgl_sd);
        $tahunPsampai=$tanggalIndo->thn_aja($dataDetail->pemasukan_dok_penawaran_tgl_sd);

        $gabunganPsampai = $tanggalPsampai.' '.$bulanPsampai.' '.$tahunPsampai;

        $tanggalEdari=$tanggalIndo->tgl_aja($dataDetail->evaluasi_dokumen_tgl_dari);
        $bulanEdari=$tanggalIndo->bln_aja($dataDetail->evaluasi_dokumen_tgl_dari);
        $tahunEdari=$tanggalIndo->thn_aja($dataDetail->evaluasi_dokumen_tgl_dari);

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
            '[AlamatPt]' => $data['getperusahaan']['alamat'],
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
        $dataDetail = PengadaanDetailSpk::where('id_pengadaan',$id)->first();

        $dataPerusahaan = Perusahaan::where('id',$data->id_perusahaan)->first();
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
            '[Judul]' => $data->judul,
            '[Rks]' => $dataDetail->rks_nomor,
            '[Tanggal_Rks]' => $gabungan1,
            '[nomor]' => $dataDetail->evaluasi_dokumen_nomor,
            '[Hari]' => $dataDetail->pemasukan_dok_penawaran_hari_dari,
            '[Tanggal]' => $tanggalIndo->terbilang($tanggal),
            '[Bulan]' => $bulan,
            '[Tahun]' => $tanggalIndo->terbilang($tahun),
            '[Judul1]' => $data->judul,
            '[Judul2]' => $data->judul,
            '[nama_perusahaan]' => $dataPerusahaan->nama,
            '[Direktur_Utama]' => $dataPerusahaan->pimpinan,
            '[Pejabat_Pelaksana]' => $data->pejabat_pelaksana,
            '[Tanggal_Pdp]' => $gabungan,
            '[Tanggal_Pdp1]' =>$gabungan,


        );

        $nama_file = 'evaluasi_dokumen1.doc';

        return $word->export($file, $array, $nama_file);
    }

    public function downloadEvaluasiDokumen2($id){
        $data = Pengadaan::with('getperusahaan')->where('id',$id)->first();
        $dataDetail = PengadaanDetailSpk::where('id_pengadaan',$id)->first();

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
            '[nomor]' => $dataDetail->evaluasi_dokumen_nomor,
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
            '[Direksi]' => $data->direksi,
            '[Jabatan_Direksi]' => $data->jabatan_direksi,
            '[Nama_Perusahaan]' => $data['getperusahaan']['nama'],
            '[Alamat]' => $data['getperusahaan']['alamat'],
            '[Npwp]' => $data['getperusahaan']['npwp'],

        );

        $nama_file = 'evaluasi_dokumen1.doc';

        return $word->export($file, $array, $nama_file);
    }

    public function downloadEvaluasiDokumen3($id){
        $data = Pengadaan::with('getperusahaan')->where('id',$id)->first();
        $dataDetail = PengadaanDetailSpk::where('id_pengadaan',$id)->first();

        $tanggalIndo = new TanggalIndo();
        $terbilangIndo = new TerbilangIndo();

        $tanggal=$tanggalIndo->tgl_aja($dataDetail->evaluasi_dokumen_tgl_sd);
        $bulan=$tanggalIndo->bln_aja($dataDetail->evaluasi_dokumen_tgl_sd);
        $tahun=$tanggalIndo->thn_aja($dataDetail->evaluasi_dokumen_tgl_sd);
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

    public function downloadBaHasilKlarifikasi1($id){
        $data = Pengadaan::with('getperusahaan')->where('id',$id)->first();
        $dataDetail = PengadaanDetailSpk::where('id_pengadaan',$id)->first();

        $tanggalIndo = new TanggalIndo();

        $tanggal=$tanggalIndo->tgl_aja($dataDetail->ba_hasil_klarifikasi_tgl);
        $bulan=$tanggalIndo->bln_aja($dataDetail->ba_hasil_klarifikasi_tgl);
        $tahun=$tanggalIndo->thn_aja($dataDetail->ba_hasil_klarifikasi_tgl);
        $gabungan = $tanggal.' '.$bulan.' '.$tahun;

        $tanggal1=$tanggalIndo->tgl_aja($dataDetail->rks_tgl);
        $bulan1=$tanggalIndo->bln_aja($dataDetail->rks_tgl);
        $tahun1=$tanggalIndo->thn_aja($dataDetail->rks_tgl);
        $gabungan1 = $tanggal1.' '.$bulan1.' '.$tahun1;

        $word = new WordTemplate();
        $file = public_path('doc/spk/eva_pembuktian_kualifikasi.rtf');

        $array = array(
            '[nomor]' => $dataDetail->ba_hasil_klarifikasi_nomor,
            '[Judul]' => $data->judul,
            '[Rks]' => $dataDetail->rks_nomor,
            '[Tanggal_Rks]' => $gabungan1,
            '[Hari]' => $dataDetail->ba_hasil_klarifikasi_hari,
            '[Tanggal]' => $tanggalIndo->terbilang($tanggal),
            '[Bulan]' => $bulan,
            '[Tahun]' => $tanggalIndo->terbilang($tahun),
            '[Pejabat_Pelaksana]' => $data->pejabat_pelaksana,
            '[Nama_Perusahaan]' => $data['getperusahaan']['nama'],
            '[Alamat]' => $data['getperusahaan']['alamat'],
            '[Npwp]' => $data['getperusahaan']['npwp'],

        );

        $nama_file = 'eva_pembuktian_kualifikasi.doc';

        return $word->export($file, $array, $nama_file);
    }

    public function downloadBaHasilKlarifikasi2($id){
        $data = Pengadaan::with('getperusahaan')->where('id',$id)->first();
        $dataDetail = PengadaanDetailSpk::where('id_pengadaan',$id)->first();

        $tanggalIndo = new TanggalIndo();

        $tanggal=$tanggalIndo->tgl_aja($dataDetail->ba_hasil_klarifikasi_tgl);
        $bulan=$tanggalIndo->bln_aja($dataDetail->ba_hasil_klarifikasi_tgl);
        $tahun=$tanggalIndo->thn_aja($dataDetail->ba_hasil_klarifikasi_tgl);
        $gabungan = $tanggal.' '.$bulan.' '.$tahun;

        $word = new WordTemplate();
        $file = public_path('doc/spk/daftar_hadir_eva_pembuktian.rtf');

        $array = array(
            '[Judul]' => $data->judul,
            '[Tanggal]' => $gabungan,
            '[Pejabat_Pelaksana]' => $data->pejabat_pelaksana,
            '[Pic_Pelaksana]' => $data->pic_pelaksana,
        );

        $nama_file = 'daftar_hadir_eva_pembuktian_kualifikasi.doc';

        return $word->export($file, $array, $nama_file);
    }

    public function downloadBaHasilKlarifikasi4($id){
        $data = Pengadaan::with('getperusahaan')->where('id',$id)->first();
        $dataDetail = PengadaanDetailSpk::where('id_pengadaan',$id)->first();

        $tanggalIndo = new TanggalIndo();
        $terbilangIndo = new TerbilangIndo();

        $tanggal=$tanggalIndo->tgl_aja($dataDetail->ba_hasil_klarifikasi_tgl);
        $bulan=$tanggalIndo->bln_aja($dataDetail->ba_hasil_klarifikasi_tgl);
        $tahun=$tanggalIndo->thn_aja($dataDetail->ba_hasil_klarifikasi_tgl);
        $gabungan = $tanggal.' '.$bulan.' '.$tahun;

        $tanggal1=$tanggalIndo->tgl_aja($dataDetail->rks_tgl);
        $bulan1=$tanggalIndo->bln_aja($dataDetail->rks_tgl);
        $tahun1=$tanggalIndo->thn_aja($dataDetail->rks_tgl);
        $gabungan1 = $tanggal1.' '.$bulan1.' '.$tahun1;

       

        $word = new WordTemplate();
        $file = public_path('doc/spk/daftar_hadir_eva_nego.rtf');

        $array = array(
            '[nomor]' => $dataDetail->ba_hasil_klarifikasi_nomor,
            '[Judul]' => $data->judul,
            '[Rks]' => $dataDetail->rks_nomor,
            '[Tanggal_Rks]' => $gabungan1,
            '[Hari]' => $dataDetail->ba_hasil_klarifikasi_hari,
            '[Hps]' =>  $data->harga_penawaran,
            '[Hps_Pajak]' => $data->harga_kontrak,
            '[Hps_Terbilang]' =>  $terbilangIndo->kata($data->harga_penawaran),
            '[Hps_Pajak_Terbilang]' =>  $terbilangIndo->kata($data->harga_kontrak),
            '[Waktu_Penyelesaian]' => $data->jangka_waktu,
            '[Tanggal_Penuh]' => $gabungan,
            '[Tanggal]' => $gabungan,
            '[Bulan]' => $bulan,
            '[Tahun]' => $tanggalIndo->terbilang($tahun),
            '[Pejabat_Pelaksana]' => $data->pejabat_pelaksana,
            '[Pic_Pelaksana]' => $data->pic_pelaksana,
            '[Sebutan_Jabatan]' => $data['getperusahaan']['sebutan_jabatan'],
            '[Manager]' => $data->pengguna,
            '[Direktur]' => $data['getperusahaan']['pimpinan'],
            '[Nama_Perusahaan]' => $data['getperusahaan']['nama'],
            '[Alamat]' => $data['getperusahaan']['alamat'],
            '[Npwp]' => $data['getperusahaan']['npwp'],

        );

        $nama_file = 'daftar-hadir-eva-nego.doc';

        return $word->export($file, $array, $nama_file);
    }

    public function downloadBaHasilPengadaanLangsung1($id){
        $data = Pengadaan::with('getperusahaan')->where('id',$id)->first();
        $dataDetail = PengadaanDetailSpk::where('id_pengadaan',$id)->first();

        $tanggalIndo = new TanggalIndo();
        $terbilangIndo = new TerbilangIndo();

        $tanggal=$tanggalIndo->tgl_aja($dataDetail->pemasukan_dok_penawaran_tgl_sd);
        $bulan=$tanggalIndo->bln_aja($dataDetail->pemasukan_dok_penawaran_tgl_sd);
        $tahun=$tanggalIndo->thn_aja($dataDetail->pemasukan_dok_penawaran_tgl_sd);
        $gabungan = $tanggal.' '.$bulan.' '.$tahun;

        $tanggal1=$tanggalIndo->tgl_aja($dataDetail->rks_tgl);
        $bulan1=$tanggalIndo->bln_aja($dataDetail->rks_tgl);
        $tahun1=$tanggalIndo->thn_aja($dataDetail->rks_tgl);
        $gabungan1 = $tanggal1.' '.$bulan1.' '.$tahun1;

        $word = new WordTemplate();
        $file = public_path('doc/spk/hasil_pengadaan_langsung.rtf');

        $array = array(
            '[nomor]' => $dataDetail->ba_hasil_pengadaan_nomor,
            '[Judul]' => $data->judul,
            '[Rks]' => $dataDetail->rks_nomor,
            '[Tanggal_Rks]' => $gabungan1,
            '[Tanggal_Hpl]' => $gabungan,
            '[Hari]' => $dataDetail->ba_hasil_pengadaan_hari,
            '[Hps]' => $data->harga_penawaran,
            '[Hps_Pajak]' => $data->harga_kontrak,
            '[Hps_Terbilang]' => $terbilangIndo->kata($data->harga_penawaran),
            '[Hps_Pajak_Terbilang]' => $terbilangIndo->kata($data->harga_kontrak),
            '[Waktu_Penyelesaian]' => $data->jangka_waktu,
            '[Tanggal_Penuh]' => $gabungan,
            '[Tanggal]' => $tanggalIndo->terbilang($tanggal),
            '[Bulan]' => $bulan,
            '[Tahun]' => $tanggalIndo->terbilang($tahun),
            '[Pejabat_Pelaksana]' => $data->pejabat_pelaksana,
            '[Disusun]' => $data->pic_pelaksana,
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
        $dataDetail = PengadaanDetailSpk::where('id_pengadaan',$id)->first();

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
        );

        $nama_file = 'daftar_hadir_hasil_pengadaan.doc';

        return $word->export($file, $array, $nama_file);
    }

    public function downloadNdUsulanTetapPemenang($id){
        $data = Pengadaan::with('getperusahaan')->where('id',$id)->first();
        $dataDetail = PengadaanDetailSpk::where('id_pengadaan',$id)->first();

        $tanggalIndo = new TanggalIndo();
        $terbilangIndo = new TerbilangIndo();

        $tanggal=$tanggalIndo->tgl_aja($dataDetail->nd_usulan_tetap_pemenang_tgl);
        $bulan=$tanggalIndo->bln_aja($dataDetail->nd_usulan_tetap_pemenang_tgl);
        $tahun=$tanggalIndo->thn_aja($dataDetail->nd_usulan_tetap_pemenang_tgl);
        $gabungan = $tanggal.' '.$bulan.' '.$tahun;

        $tanggal3=$tanggalIndo->tgl_aja($dataDetail->nd_penetapan_pemenang_tgl);
        $bulan3=$tanggalIndo->bln_aja($dataDetail->nd_penetapan_pemenang_tgl);
        $tahun3=$tanggalIndo->thn_aja($dataDetail->nd_penetapan_pemenang_tgl);
        $gabungan3 = $tanggal3.' '.$bulan3.' '.$tahun3;



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
            '[Nd_Tanggal_Penetapan]' => $gabungan3,
            '[Hari]' => $dataDetail->nd_usulan_tetap_pemenang_hari,
            '[Nd_Nomor]' => $dataDetail->nd_usulan_tetap_pemenang_nomor,
            '[Nd_Nomor_Penetapan]' => $dataDetail->nd_penetapan_pemenang_nomor,
            '[banomor]' => $dataDetail->ba_hasil_pengadaan_nomor,
            '[Ba_Tanggal]' => $gabungan2,
            '[Hps]' => $data->harga_penawaran,
            '[Pajak_Hps]' => $data->harga_kontrak,
            '[Waktu_Pelaksanaan]' => $data->jangka_waktu,
            '[Tanggal_Penuh]' => $gabungan,
            '[Tanggalnd]' => $tanggalIndo->terbilang($tanggal3),
            '[Tanggal]' => $tanggalIndo->terbilang($tanggal),
            '[Bulan]' => $bulan,
            '[Terbilang]' => $terbilangIndo->kata($data->harga_kontrak),
            '[Terbulang]' => $terbilangIndo->kata($data->harga_penawaran),
            '[Tahun]' => $tanggalIndo->terbilang($tahun),
            '[Pengguna]' => $data->pengguna,
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

        $terbilangIndo = new TerbilangIndo();
        
        $data = Pengadaan::with('getperusahaan')->where('id',$id)->first();
        $dataDetail = PengadaanDetailSpk::where('id_pengadaan',$id)->first();

        $tanggalIndo = new TanggalIndo();

        $tanggal=$tanggalIndo->tgl_aja($dataDetail->ba_hasil_pengadaan_tgl);
        $bulan=$tanggalIndo->bln_aja($dataDetail->ba_hasil_pengadaan_tgl);
        $tahun=$tanggalIndo->thn_aja($dataDetail->ba_hasil_pengadaan_tgl);
        $gabungan = $tanggal.' '.$bulan.' '.$tahun;

        $tanggalSpk=$tanggalIndo->tgl_aja($dataDetail->spk_tgl);
        $bulanSpk=$tanggalIndo->bln_aja($dataDetail->spk_tgl);
        $tahunSpk=$tanggalIndo->thn_aja($dataDetail->spk_tgl);
        $gabunganSpk = $tanggalSpk.' '.$bulanSpk.' '.$tahunSpk;

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
        $file = '';

        if($data->id_mp2 == 5){
            $file = public_path('doc/spk/spk_konstruksi.rtf');
        }else{
            $file = public_path('doc/spk/spk.rtf');
        }

        $array = array(
            '[spk_nomor]' => $dataDetail->spk_nomor,
            '[Judul]' => $data->judul,
            '[tempat_penyerahan]' => $data->tempat_penyerahan,
            '[Tanggal]' => $gabunganSpk,
            '[Hari]' => $dataDetail->spk_hari,
            '[Nama_Perusahaan]' => $data['getperusahaan']['nama'],
            '[Alamat]' => $data['getperusahaan']['alamat'],
            '[vmfc1]' => $data->vmfc1,
            '[Rks]' => $dataDetail->rks_nomor,
            '[Rks_Tanggal]' => $gabungan1,
            '[Nd_Penetapan_Pemenang_Nomor]' => $dataDetail->nd_penetapan_pemenang_nomor,
            '[nd_penetapan_pemenang_tanggal]' => $gabungan2,
            '[nd_usulan_tetap_pemenang_nomor]' => $dataDetail->nd_usulan_tetap_pemenang_nomor,
            '[nd_usulan_tetap_pemenang_tanggal]' => $gabungan3,
            '[ba_hasil_klarifikasi_nomor]' => $dataDetail->ba_hasil_klarifikasi_nomor,
            '[ba_hasil_klarifikasi_tanggal]' => $gabungan4,
            '[undangan_pengadaan_langsung_nomor]' => $dataDetail->undangan_pengadaan_langsung_nomor,
            '[undangan_pengadaan_langsung_tanggal]' => $gabungan5,
            '[bank_dpt]' => $data['getperusahaan']['bank'],
            '[nama_dpt]' => $data['getperusahaan']['nama'],
            '[Kantor_Cabang]' => $data['getperusahaan']['kantor_cabang'],
            '[rekening_dpt]' => $data['getperusahaan']['rekening'],
            '[alamat_dpt]'=> $data['getperusahaan']['alamat'],
            '[telpon_dpt' => $data['getperusahaan']['telpon'],
            '[faksimili_dpt]'=> $data['getperusahaan']['faksimili'],
            '[pimpinan_dpt]'=> $data['getperusahaan']['pimpinan'],
            '[manager]'=>$data->manager,
            '[Nama_Pengguna]'=>$data->pengguna,
            '[Nip_Pengguna]'=>$data->nip,
            '[Tahun]'=>$data->tahun,
            '[Harga_Kontrak]'=>$data->harga_kontrak,
            '[Harga_Kontrak_Terbilang]'=>$terbilangIndo->kata($data->harga_kontrak),
            '[Status_Berakhir]'=>$data->status_berakhir,
            '[Status_Berakhir_Terbilang]'=>$terbilangIndo->kata($data->status_berakhir),
            '[Jangka_Waktu_Tanggal]'=>$data->jangka_waktu_tgl,
            '[Jabatan_Direksi]'=>$data->jabatan_direksi,
            '[Jabatan_Pengawas]'=>$data->jabatan_pengawas,
            '[Masa_Garansi]'=>$data->masa_garansi,
            '[Pengguna]'=>$data->pengguna,
            '[Bentuk_Perusahaan]'=> $data['getperusahaan']['bentuk_perusahaan'],
            '[Jenis_Perjanjian]' => $data->jenis_perjanjian,
                );

        $nama_file = 'spk.doc';

        return $word->export($file, $array, $nama_file);
    }






}
