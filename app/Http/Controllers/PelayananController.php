<?php

namespace App\Http\Controllers;

use Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use App\Apotek;
use App\Pelayanan;
use App\PelayananDetail;
use App\DataPasien;
use App\GudangObat;

use DataTables;
use Illuminate\Support\Facades\Redirect;
use DB;



class PelayananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // $pelayanan = Pelayanan::all();
        $pelayanan = Pelayanan::orderBy('created_at', 'DESC')->get();


        // Return the index view
        return view('pelayanan.index')->with('pelayanan', $pelayanan);
    }
    public function search_obat(Request $request)
    {
        if ($request->has('q')) {
            $cari = $request->q;
            // $data = DB::table('apotek')->where('nama_obat', 'LIKE', '%' . $cari . '%')->get();

            $data = DB::table('apotek')
                // ->select('apotek.active', 'active as pantek')

                ->join('master_obat', 'apotek.id_obat', '=', 'master_obat.id')
                ->join('gudang_obat', 'apotek.id_gudang', '=', 'gudang_obat.id')
                ->where('nama_obat', 'LIKE', '%' . $cari . '%')
                ->select('apotek.id as id_apotek', 'apotek.*', 'gudang_obat.*', 'master_obat.*')
                ->where('apotek.active', '!=', 0)
                ->get();
            return response()->json($data);
        }
    }

    public function search_pasien(Request $request)
    {
        if ($request->has('q')) {
            $cari = $request->q;
            $data = DB::table('data_pasien')->where('nama_pasien', 'LIKE', '%' . $cari . '%')->get();
            return response()->json($data);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $datapasien  = DataPasien::all();
        return view('pelayanan.create')->with('datapasien', $datapasien);
    }

    /**
     * Store a newly created resource in dosis.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $data = new Pelayanan();

        $data->tanggal = date('Y-m-d', strtotime($request->tanggal));
        $data->id_pasien = $request->id_pasien;
        $data->keterangan = $request->keterangan;

        if ($data->save()) {
            $id_pelayanan = $data->id;
            if (isset($_POST['id_apotek_obat'])) {
                foreach ($_POST['id_apotek_obat'] as $key => $id_apotek_obat) :
                    $detail = new PelayananDetail();
                    $detail->id_pelayanan = $data->id;
                    $detail->id_obat =  $_POST['id_obat'][$key];
                    $detail->id_apotek = $id_apotek_obat;
                    $detail->qty = $_POST['qty'][$key];
                    $detail->harga_jual = $_POST['harga'][$key];
                    $detail->save();
                endforeach;
            }

            $data = Pelayanan::find($id_pelayanan);
            $data->save();

            $data = PelayananDetail::where('id_pelayanan', '=', $id_pelayanan)->orderBy('id', 'ASC')->get();
            foreach ($data as $data) :
                $detail = Apotek::find($data->id_apotek);
                $detail->jumlah_apotek = $detail->jumlah_apotek - $data->qty;
                if ($detail->jumlah_apotek == 0) {
                    $detail->active = 0;
                }
                $detail->save();
            endforeach;

       
            return Redirect::to('/pelayanan')->with('success', "Data telah tersimpan!")->with('mode', 'success');
        }
    }


    public function show($id_pelayanan)
    {
        $pelayanan = Pelayanan::find($id_pelayanan);

        $pelayanan_detail = DB::table('pelayanan_detail')
            ->where('id_pelayanan', $id_pelayanan)
            ->join('apotek', 'pelayanan_detail.id_apotek', '=', 'apotek.id')
            ->join('master_obat', 'pelayanan_detail.id_obat', '=', 'master_obat.id')

            ->get();
        $total = DB::table('pelayanan_detail')
            ->where('id_pelayanan', $id_pelayanan)
            ->sum('qty');
        // return view
        return view('pelayanan.show')->with('pelayanan', $pelayanan)->with('pelayanan_detail', $pelayanan_detail)->with('total', $total);
    }

    /**
     * Remove the specified resource from gudang.
     *
     * @param  \App\dosis  $dosis
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        Pelayanan::destroy($id);
        return redirect('/pelayanan')->with('success', 'Data berhasil dihapus!');
    }
}
