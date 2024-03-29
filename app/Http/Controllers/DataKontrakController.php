<?php

namespace App\Http\Controllers;

use Ajaxray\PHPWatermark\Watermark;
use App\AturUser;
use App\Pengadaan;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\Settings;
use setasign\Fpdi\Fpdi;
use Yajra\DataTables\DataTables;

class DataKontrakController extends Controller
{
    public function index()
    {
        $dataUser = User::all();
        if (request()->ajax()) {
            return DataTables::of(Pengadaan::latest()->get())
                ->addColumn('action', function ($data) {
                    if ($data->kontrak != null && $data->proses != null) {
                        $button = '<a href="downloadProses/' . $data->proses . '" type="button" class="detail btn btn-primary btn-sm">Proses</a>';
                        $button .= '&nbsp;&nbsp;';
                        $button .= '<a href="downloadKontrak/' . $data->kontrak . '" type="button" class="detail btn btn-primary btn-sm">Kontrak</a>';
                        $button .= '&nbsp;&nbsp;';
                        $button .= '<button type="button" name="aturUser" id="' . $data->id . '" class="aturUser btn btn-warning btn-sm">Atur User</button>';
                        return $button;
                    } else if ($data->kontrak != null) {
                        $button = '<a href="downloadKontrak/' . $data->kontrak . '" type="button" class="detail btn btn-primary btn-sm">Kontrak</a>';
                        $button .= '&nbsp;&nbsp;';
                        $button .= '<button type="button" name="aturUser" id="' . $data->id . '" class="aturUser btn btn-warning btn-sm">Atur User</button>';
                        return $button;
                    } else if ($data->proses != null) {
                        $button = '<a href="downloadProses/' . $data->proses . '" type="button" class="detail btn btn-primary btn-sm">Proses</a>';
                        $button .= '&nbsp;&nbsp;';
                        $button .= '<button type="button" name="aturUser" id="' . $data->id . '" class="aturUser btn btn-warning btn-sm">Atur User</button>';
                        return $button;
                    } else {
                        $button = '<button type="button" name="aturUser" id="' . $data->id . '" class="aturUser btn btn-warning btn-sm">Atur User</button>';
                        return $button;
                    }


                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('pages/user/data-kontrak/indexKontrak', compact([
            'dataUser'
        ]));
    }

    public function aturUserEdit($id)
    {
        if (request()->ajax()) {
            $data = AturUser::where('id_pengadaan',$id)->get();
            return response()->json(['data' => $data]);
        }
    }

    public function aturUser(Request $request)
    {
        $rules = array(
            'user' => 'required',
        );

        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $data = [];
        for ($i = 0; $i < count($request->user); $i++) {
            $data[$i] = [
                'id_pengadaan' => $request->id_pengadaan,
                'id_user' => $request->user[$i]
            ];
        }

        $form_data = array(
            'id_pengadaan' => $request->id_pengadaan,
            'id_user' => $request->id_user,
        );


        if (AturUser::insert($data)) {
            return response()->json(['success' => 'Data Added successfully.']);
        } else {
            return response()->json(['success' => 'Gagal Tambahkan User']);
        }
    }

    public function uploadDoc(Request $request)
    {

        $file = $request->file('file');

        $name = $file->getClientOriginalName();

        $objReader = IOFactory::createReader('Word2007');
        $phpWord = $objReader->load($file);
        $domPdfPath = base_path('vendor/dompdf/dompdf');
        Settings::setPdfRendererPath($domPdfPath);
        Settings::setPdfRendererName('DomPDF');

        $objWriter = IOFactory::createWriter($phpWord, 'PDF');
        $objWriter->save(public_path('data-kontrak/temp/' . $name . '.pdf'));

        return response()->json([
            'name' => $name,
            'original_name' => $file->getClientOriginalName(),
        ]);


    }

    function add_watermark($file, $nama)
    {
        $pdf = new Fpdi();

        if (file_exists($file)) {
            $pagecount = $pdf->setSourceFile($file);
            for ($i = 1; $i <= $pagecount; $i++) {
                $tpl = $pdf->importPage($i);
                $pdf->addPage();
                $size = $pdf->getTemplateSize($tpl);

                $pdf->useTemplate($tpl, null, null, $size['width'], $size['height'], TRUE);
                //Put the watermark
                $pdf->SetFont('Arial', 'B', 12);
                $pdf->SetTextColor(255, 0, 0);
                $pdf->SetXY(20, 15);
                $pdf->Write(0, Auth::user()->username);
            }

            return $pdf->Output();


        } else {
            return FALSE;
        }


    }


    public function hapusTemp(Request $request)
    {
        $fotoNama = $request->nama_pdf;
        unlink(public_path('data-kontrak/temp/') . $fotoNama);
    }

    public function surveyHargaPasar()
    {

    }

    public function downloadKontrak($id)
    {
        //PDF file is stored under project/public/download/info.pdf
        $file = public_path('data-kontrak') . "/kontrak/" . $id;
        $this->add_watermark($file, $id);
//        $headers = array(
//            'Content-Type: application/pdf',
//        );
//        return Response::download($file, $id, $headers);

    }

    public function downloadProses($id)
    {

        $file = public_path('data-kontrak') . "/proses/" . $id;
        $headers = array(
            'Content-Type: application/pdf',
        );

        return Response::download($file, $id, $headers);
    }

    public function downloadPdfWatermark($id)
    {
        //PDF file is stored under project/public/download/info.pdf
        $file = public_path('data-kontrak/pdf-watermark') . $id;

        $headers = array(
            'Content-Type: application/pdf',
        );

        return Response::download($file, $id, $headers);
    }


}
