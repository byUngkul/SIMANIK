<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pasien;
use App\RK_Medis;
use App\Obat;
use App\Resep;
use Session;
use Excel;

class DokterController extends Controller
{
    public function __construct() {
    	 $this->middleware('dokter');
    }

    public function index(Pasien $pasien) {
            $antri = $pasien->whereDate('created_at', date('Y-m-d'))->where(['status' => 'antri', 'layanan_dokter' => Session::get('id')])->orderBy('created_at', 'desc')->get();
            // dd($antri);
            $obat = $pasien->whereDate('created_at', date('Y-m-d'))->where(['status' => 'obat', 'layanan_dokter' => Session::get('id')])->orderBy('updated_at')->get();
            $pasien = $pasien->where('layanan_dokter', Session::get('id'))->whereDate('created_at', date('Y-m-d'))->get();
    	return view('dokter.index', ['antri'=> $antri, 'obat' => $obat, 'pasien' => $pasien]);
    }

    public function getRekamMedisPasien($id, $nama, $tgl) {
        $pasien = Pasien::find($id);
        $rekamMedis =  RK_Medis::where(['nama' => $nama, 'tgl_lahir' => $tgl])->get()->toArray();
        $umur = new \DateTime($pasien->tgl_lahir);
        $ubah = new \DateTime();
        $umur = $ubah->diff($umur);
        // dd($umur);
        // 
        $obat = Obat::get()->toArray();
        $id = RK_Medis::select('id')->get()->last();
            if ($id == null) {
                $id = 1;
            }
        $id  = substr($id['id'], 4);
        $id = (int) $id;
        $id += 1;
        $id  = "RK" . str_pad($id, 4, "0", STR_PAD_LEFT);
        // dd($id);
        return view('dokter.pasien-rekam-medis', ['pasien' => $pasien, 'rekamMedis' => $rekamMedis, 'obat' => $obat, 'id' => $id, 'nama' => $nama, 'tgl_lahir' => $tgl, 'umur' => $umur]);
    }

    public function postRekamMedisPasien(Request $request) {
        if ($request->ajax()) {
            $rekamMedis = RK_Medis::create([
                'id' => $request->id,
                'nama' => $request->nama,
                'tgl_lahir' => $request->tgl,
                'bb' => $request->bb,
                'tb' => $request->tb,
                'tensi' => $request->tensi,
                'bw' => $request->bw,
                'pasien_id' => $request->pasien_id,
                'dokter_id' => $request->dokter_id,
                'diagnosa' => $request->diagnosa,
                'keluhan' => $request->keluhan,
                'anamnesis' => $request->anamnesis,
                'tindakan' => $request->tindakan,
                'keterangan' => $request->deskripsi,
                'alergi_obat' => $request->alergi_obat,
            ]);

            $pasien = Pasien::find($request->pasien_id)->update(['status' => 'obat']);
            
            for ($i=0; $i <count($request['obat']) ; $i++) { 
                $resep = Resep::create([
                    'dokter_id'    => $request['dokter_id'],
                    'pasien_id'    =>   $request['pasien_id'],
                    'obat_id'        =>     $request['obat'][$i]['value'],
                    'keterangan'  =>    $request['keterangan'][$i]['value'],
                    'jumlah'          =>    $request['jumlah'][$i]['value'],
                    'status'          =>     'belum'
                    ]);
            }
            return response()->json($resep);
        }
    }

    public function getObat() {
            $data = Obat::get()->toJson();
            return response($data);
    }

    public function getRekamMedis() {
            $rekamMedis = RK_Medis::with('pasien')->where('dokter_id', Session::get('id'))->get()->toArray();
            $HariIni = RK_Medis::where('dokter_id', Session::get('id'))->whereDate('created_at', date('Y-m-d'))->get()->toArray();
    	return view('dokter.rekam-medis', ['rekamMedis' => $rekamMedis, 'HariIni' => $HariIni]);
    }

    public function postUpdateRekamMedis(Request $request) {
        if ($request->ajax()) {
            $data = RK_Medis::find($request->id)->update($request->all());
            return response()->json($data);
        }
    }

    public function getDeleteRekamMedis(Request $request) {
        if ($request->ajax()) {
            $data = RK_Medis::find($request->id)->delete();
            return response()->json($data);
        }
    }

    public function exportExcelRekamMedis(Request $request, $type) {
         Excel::create('Data Rekam Medis ' .  $request->bulan .'-' .$request->tahun, function ($excel) use ($request){
                $excel->sheet('Data Rekam Medis ' .  $request->bulan .'-' .$request->tahun, function ($sheet) use ($request){
                    $bulan = $request->bulan;
                    $tahun = $request->tahun;
                    $arr = array();
                    $barang = RK_Medis::with('pasien')->where('dokter_id', Session::get('id'))->whereMonth('created_at', $bulan)->whereYear('created_at', $tahun)->get()->toArray();
                    foreach ($barang as $data) {
                        $data_arr = array(
                            $data['id'],
                            $data['pasien']['nama'],
                            $data['pasien']['jenis_kelamin'],
                            $data['diagnosa'],
                            $data['keluhan'],
                            $data['anamnesis'],
                            $data['tindakan'],
                            $data['keterangan'],
                            $data['alergi_obat'],
                            $data['bb'],
                            $data['tb'],
                            $data['tensi'],
                            $data['bw'],
                        );
                        array_push($arr, $data_arr);
                    }
                    $sheet->fromArray($arr, null, 'A1', false, false)->prependRow(array(
                        'ID',
                        'Nama Pasien',
                        'Jenis Kelamin',
                        'Diagnosa',
                        'Keluhan',
                        'Anamnesis',
                        'Tindakan',
                        'Keterangan',
                        'Alergi_obat',
                        'BB',
                        'TB',
                        'Tensi',
                        'BW',
                    ));
                });
            })->download($type);
    }

    public function exportPDFRekamMedis(Request $request) {
        $bulan = $request['bulan'];
        $tahun = $request['tahun'];
        $rekamMedis = RK_Medis::with('pasien')->where('dokter_id', Session::get('id'))->whereMonth('created_at', $bulan)->whereYear('created_at', $tahun)->get()->toArray();
        return view('dokter.pdf', ['bulan' => $bulan, 'tahun' => $tahun, 'rekamMedis' => $rekamMedis]);
    }

    public function getResep() {
            $resep = Resep::with(['pasien', 'obat'])->where('dokter_id', Session::get('id'))->groupBy(['pasien_id'])->get()->toArray();
            // dd($resep);
            $hariIni = Resep::where('dokter_id', Session::get('id'))->whereDate('created_at', date('y-m-d'))->get()->toArray();
    	return view('dokter.resep', ['resep' => $resep, 'hariIni' => $hariIni]);
    }

    public function excelResep(Request $request, $type) {
            Excel::create('Data Resep ' .  $request->bulan .'-' .$request->tahun, function ($excel) use ($request){
                $excel->sheet('Data Resep ' .  $request->bulan .'-' .$request->tahun, function ($sheet) use ($request){
                    $bulan = $request->bulan;
                    $tahun = $request->tahun;
                    $arr = array();
                    $barang = Resep::with(['pasien', 'obat'])->where('dokter_id', Session::get('id'))->whereMonth('created_at', $bulan)->whereYear('created_at', $tahun)->get()->toArray();
                    foreach ($barang as $data) {
                        $data_arr = array(
                            $data['id'],
                            $data['pasien']['nama'],
                            $data['obat']['nama'],
                            $data['jumlah'],
                            $data['keterangan'],
                        );
                        array_push($arr, $data_arr);
                    }
                    $sheet->fromArray($arr, null, 'A1', false, false)->prependRow(array(
                        'ID',
                        'Nama Pasien',
                        'Nama Obat',
                        'Jumlah',
                        'Keterangan',
                    ));
                });
            })->download($type);
    }

    public function PDFResep(Request $request) {
        $bulan = $request['bulan'];
        $tahun = $request['tahun'];
        $resep = Resep::with(['pasien', 'dokter', 'obat'])->where('dokter_id', Session::get('id'))->whereMonth('created_at', $bulan)->whereYear('created_at', $tahun)->get()->toArray();
        // dd($resep);
        return view('dokter.pdf-resep', ['bulan' => $bulan, 'tahun' => $tahun, 'resep' => $resep]);
    }

    public function printDetailResep($id) {
        $resep = Resep::with(['pasien', 'obat'])->where(['dokter_id' => Session::get('id'), 'pasien_id' => $id])->get()->toArray();
        // dd($resep);
        return view('dokter.print-resep', ['resep' => $resep]);
    }

    public function getIsiResep(Request $request) {
        if ($request->ajax()) {
            $data = Resep::with('obat')->where(['dokter_id' => Session::get('id'), 'pasien_id' => $request->pasien_id])->get();
            return response()->json($data);
        }
    }
}
