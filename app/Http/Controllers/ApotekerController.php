<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Resep;
use App\Obat;
use App\Pasien;
use App\KategoriObat;
use PDF, Excel;

class ApotekerController extends Controller
{
    public function __construct() {
    	  $this->middleware('apoteker');
    }

    public function index() {
    	$belum = Resep::with(['pasien', 'dokter'])->whereDate('created_at', date('Y-m-d'))->where('status', 'belum')->orderBy('created_at', 'desc')->groupBy('pasien_id')->get();
            $selesai = Resep::with(['pasien', 'dokter'])->whereDate('created_at', date('Y-m-d'))->where('status', 'selesai')->orderBy('updated_at', 'desc')->groupBy('pasien_id')->get();
        // dd($resep);
    	return view('apoteker.index', ['belum' => $belum, 'selesai' => $selesai]);
    }

    public function getDataResep($dokter_id, $pasien_id) {
            $ada = 'ada';
            $habis = 'habis';
            // old version
            // $ada = Resep::with(['obat', 'dokter', 'pasien'])
            //              ->whereHas('obat', function($q) use($ada){ 
            //                 $q->where('status', '=', $ada); 
            //               })
            //              ->where(['dokter_id' => $dokter_id, 'pasien_id' => $pasien_id])
            //              ->get()->toArray();
            // $habis =  Resep::with(['obat', 'dokter', 'pasien'])
            //                 ->whereHas('obat', function($q) use($habis){ 
            //                     $q->where('status', '=', $habis); 
            //                 })
            //                 ->where(['dokter_id' => $dokter_id, 'pasien_id' => $pasien_id])
            //                 ->get()->toArray();
            // // dd($ada);
            $dataResep = Resep::with(['dokter', 'pasien'])
                         ->where([
                           'pasien_id' => $pasien_id, 
                           'dokter_id' => $dokter_id])->get()->toArray();
            // dd($dataResep);
            $obat = Obat::get()->toArray();
            // new version
            
            return view('apoteker.getDataResep', ['obat' => $obat, 'dataResep' => $dataResep]);
    }

    public function getDetailResep(Request $request) {
        if ($request->ajax()) {
            $data = Resep::with(['obat', 'dokter', 'pasien'])->where(['dokter_id' => $request->dokter_id, 'pasien_id' => $request->pasien_id])->get();
            $nama_dokter = $data[0]['dokter']['nama'];
            $nama_pasien = $data[0]['pasien']['nama'];
            return response()->json([$data, $nama_dokter, $nama_pasien]);
        }
    }

    public function getObat() {
            $obat = Obat::with('kategori')->get()->toArray();
            $kategori = KategoriObat::get()->toArray();
    	return view('apoteker.obat', ['obat' => $obat, 'kategori' => $kategori]);
    }

    public function postObat(Request $request) {
        if ($request->ajax()) {
            $data = Obat::create($request->all());
            return response()->json($data);
        }
    }

    public function postUpdateObat(Request $request) {
        if ($request->ajax()) {
            $data = Obat::find($request->id)->update($request->all());
            // $data = $request->id;
            return response()->json($data);
        }
    }

    public function getHapusObat(Request $request) {
        if ($request->ajax()) {
            $data = Obat::find($request->id)->delete();
            return response()->json($data);
        }
    }

    public function exportExcelObat($type) {
        return  Excel::create('Data Obat ', function ($excel) {
                $excel->sheet('Data Obat ', function ($sheet) {
                    $arr = array();
                    $obat = Obat::with('kategori')->get()->toArray();
                    foreach ($obat as $data) {
                        $data_arr = array(
                            $data['id'],
                            $data['nama'],
                            $data['kandungan'],
                            $data['kategori']['kategori'],
                            $data['harga'],
                            $data['status'],
                        );
                        array_push($arr, $data_arr);
                    }
                    $sheet->fromArray($arr, null, 'A1', false, false)->prependRow(array(
                        'ID',
                        'Nama Obat',
                        'Kandungan',
                        'Kategori Obat',
                        'Harga',
                        'Status',
                    ));
                });
            })->download($type);
    }

    public function exportPDFObat(Request $request) {
        if ($request->semua) {
            $status = $request->semua;
            $fileName = 'Data Semua Obat.pdf';
            $obat = Obat::with('kategori')->get()->toArray();
        }else{
            $status = $request->habis;
            $fileName = 'Data Obat Stok Habis.pdf';
            $obat = Obat::with('kategori')->where('status', $status)->get()->toArray();
        }
        $pdf = PDF::loadView('apoteker.pdf-obat', ['obat' => $obat, 'status' => $status]);
        return $pdf->stream($fileName);
    }

    public function getKategori() {
        $kategori = KategoriObat::get()->toArray();
        return view('apoteker.kategori', ['kategori' => $kategori]);
    }

    public function postKategori(Request $request) {
        if($request->ajax()) {
            $data = KategoriObat::create($request->all());
            return response()->json($data);
        }
    }

    public function postUpdateKategoriObat(Request $request) {
        if ($request->ajax()) {
            $data = KategoriObat::find($request->id)->update($request->all());
            return response()->json($data);
        }
    }

    public function getHapusKategori(Request $request) {
        if ($request->ajax()) {
            $data = KategoriObat::find($request->id)->delete();
            return response()->json($data);
        }
    }

    public function postResep(Request $request) {
        if ($request->ajax()) {
            $pasien = Pasien::find($request->pasien_id)->update(['status' => 'selesai']);
            for ($i=0; $i <count($request['id']) ; $i++) { 
                $data = Resep::where('id', $request['id'][$i]['value'])->first();
                $data->status = 'selesai';
                $data->save();
            }
            return response()->json($data);
        }
    }


    public function PrintDetailResep(Request $request, $dokter_id, $pasien_id) {
        // dd($request['habis']);
        $pasien = Pasien::find($pasien_id)->update(['status' => 'selesai']);
         for ($i=0; $i <count($request['habis']) ; $i++) { 
            $data = Resep::where('id', $request['habis'][$i])->first();
            $data->status = 'selesai';
            $data->save();
        }

        $habis = 'habis';
       $resep = Resep::with(['obat', 'dokter', 'pasien'])->whereHas('obat', function($q) use($habis){ $q->where('status', '=', $habis); })->where(['dokter_id' => $dokter_id, 'pasien_id' => $pasien_id])->get()->toArray();
       $size = array(0,0,393,590);
        $pdf = PDF::loadView('apoteker.printDetailResep', ['resep' => $resep])->setPaper($size)->setOptions(['dpi' => 72,'defaultFont' => 'sans-serif']); 
       return $pdf->stream('resep-dokter.pdf');
    }

    // transaksi
    public function getDataObat(Request $request) {
        if ($request->ajax()) {
            $obat = Obat::find($request->id);
            return response()->json($obat);
        }
    }

    public function postResepObat(Request $request) {
        // dd($request->all());
        $jumlah_obat = $request['jumlah_obat'];
        $id_resep = $request['id_resep'];
        $id_dokter = $request['id_dokter'];
        $id_pasien = $request['id_pasien'];
        $id_obat = $request['obat_id'];
        // dd($id_pasien);
        $obat = Obat::whereIn('id', $request['obat_id'])->get()->toArray();
        $hasil = [];
        foreach ($jumlah_obat as $key => $value) {
            // total biaya
            if ($obat[$key]['status'] == 'ada') {
                // total per obat
                array_push($hasil, ($value * $obat[$key]['harga']));
                $total_biaya = array_sum($hasil);
            }
        }
        // dd($hasil);
        return view('apoteker.confirm', compact([
                'obat',
                'jumlah_obat',
                'total_biaya',
                'id_resep',
                'id_dokter', 
                'id_pasien',
                'id_obat'
        ]));
    }

    public function confirmTransaksi(Request $request) {
        $jumlah_obat = $request['jumlah_obat'];
        $id_resep = $request['id_resep'];
        $id_obat = $request['id_obat'];

        $obat = Obat::whereIn('id', $id_obat)->get()->toArray();
        $resep = Resep::whereIn('id', $request['id_resep']);
        $update = $resep->update([
            'status' => 'selesai'
        ]);
        $getData = $resep->get()->toArray();

        $hasil = [];
        foreach ($jumlah_obat as $key => $value) {
            // total biaya
            if ($obat[$key]['status'] == 'ada') {
                // total per obat
                array_push($hasil, ($value * $obat[$key]['harga']));
                $total_biaya = array_sum($hasil);
            }
        }
        return view('apoteker.print', compact([
                    'getData', 
                    'obat', 
                    'jumlah_obat', 
                    'total_biaya'
        ]));
    }

}
