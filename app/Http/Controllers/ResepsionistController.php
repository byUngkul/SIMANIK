<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pasien;
use App\Dokter;
use Excel;
use PDF;

class ResepsionistController extends Controller
{
    public function __construct() {
    	  $this->middleware('resepsionist');
    }

    public function index() {
            $pasien = Pasien::whereDate('created_at', '=', date('Y-m-d'))->where('status', '=', 'antri')->get();
            $total = Pasien::get()->toArray();
            $bulan = Pasien::whereMonth('created_at', '=', date('m'))->whereYear('created_at', '=', date('Y'))->get()->toArray();
            $dokter = Dokter::with('spesialis')->get()->toArray();        
            $id = Pasien::select('id')->get()->last();
            if ($id == null) {
                $id = 1;
            }
            $id  = substr($id['id'], 4);
            $id = (int) $id;
            $id += 1;
            $id  = "PS" . str_pad($id, 4, "0", STR_PAD_LEFT);
    	return view('resepsionist.index', [
                                'pasien' => $pasien, 
                                'id' => $id, 
                                'total' => $total,
                                'bulan' => $bulan,
                                'dokter' => $dokter
                                ]);
    }

    public function getPasien() {
             $HariIni = Pasien::whereDate('created_at', '=', date('Y-m-d'))->where('status', '=', 'antri')->get();
            $bulan = Pasien::whereMonth('created_at', '=', date('m'))->whereYear('created_at', '=', date('Y'))->get()->toArray();
        $pasien = Pasien::orderBy('created_at', 'desc')->groupBy('nama')->get()->toArray();
        $dokter = Dokter::with('spesialis')->get()->toArray();
        // dd($dokter); 
    	return view('resepsionist.pasien.index', ['pasien'=> $pasien, 'bulan' => $bulan, 'HariIni' => $HariIni, 'dokter' => $dokter]);
    }

    public function postPendaftaranPasien(Request $request) {
            // dd($request->all());
            $data = Pasien::create($request->all());
            return redirect()->back();
    }

    public function postPasienTerdaftar(Request $request) {
        if($request->ajax()){
            $pasien = Pasien::find($request->id);
            $id = Pasien::select('id')->get()->last();
            if ($id == null) {
                $id = 1;
            }
            $id  = substr($id['id'], 4);
            $id = (int) $id;
            $id += 1;
            $id  = "PS" . str_pad($id, 4, "0", STR_PAD_LEFT);
            $create_pasien = Pasien::create([
                'id' => $id,
                'nama' => $pasien->nama,
                'jenis_kelamin' => $pasien->jenis_kelamin,
                'alamat' => $pasien->alamat,
                'tgl_lahir' => $pasien->tgl_lahir,
                'telp' => $pasien->telp,
                'pekerjaan' => $pasien->pekerjaan,
                'status' => 'antri',
                'layanan_dokter' => $request->dokter_id
            ]);
            return response()->json($create_pasien);
        }
    }

    public function getHapusPasien(Request $request) {
        if ($request->ajax()) {
            $data = Pasien::find($request->id)->delete();
            return response()->json($data);
        }
    }

    public function postUpdatePasien(Request $request) {
        if ($request->ajax()) {
            $data = Pasien::find($request->id)->update($request->all());
            return response()->json($data);
        }
    }

    public function exportExcelPasien(Request $request, $type) {
         Excel::create('Data Pasien ' .  $request->bulan .'-' .$request->tahun, function ($excel) use ($request){
                $excel->sheet('Data Pasien ' .  $request->bulan .'-' .$request->tahun, function ($sheet) use ($request){
                    $bulan = $request->bulan;
                    $tahun = $request->tahun;
                    $arr = array();
                    $barang = Pasien::whereMonth('created_at', $bulan)->whereYear('created_at', $tahun)->get()->toArray();
                    foreach ($barang as $data) {
                        $data_arr = array(
                            $data['id'],
                            $data['nama'],
                            $data['jenis_kelamin'],
                            $data['tgl_lahir'],
                            $data['pekerjaan'],
                            $data['telp'],
                            $data['alamat'],
                        );
                        array_push($arr, $data_arr);
                    }
                    $sheet->fromArray($arr, null, 'A1', false, false)->prependRow(array(
                        'ID',
                        'Nama Pasien',
                        'Jenis Kelamin',
                        'Tgl. Lahir',
                        'Pekerjaan',
                        'No. Telp',
                        'Alamat',
                    ));
                });
            })->download($type);
    }

     public function exportPDFPasien(Request $request) {
         $bulan = $request->bulan;
         $tahun = $request->tahun;
         $pasien = Pasien::whereMonth('created_at', $bulan)
                            ->whereYear('created_at', $tahun)
                            ->get()->toArray();
        // $pdf = PDF::render();
        return view('resepsionist.pasien.pdf', ['bulan' => $bulan, 'tahun' => $tahun, 'pasien' => $pasien]);
    }

    
}
