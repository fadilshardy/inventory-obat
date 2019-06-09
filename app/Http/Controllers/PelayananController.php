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
        $apotek = Apotek::all();

        $pelayanan = Pelayanan::all();
        $data = Pelayanan::all();


        // Return the index view
        return view('pelayanan.index')->with('apotek', $apotek)->with('pelayanan', $pelayanan);
    }
    public function search_obat(Request $request)
    {
        if ($request->has('q')) {
            $cari = $request->q;
            $data = DB::table('apotek')->where('nama_obat', 'LIKE', '%' . $cari . '%')->get();
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
        $data->nama_pasien = $request->nama_pasien;
        $data->id_pasien = $request->id_pasien;


        $data->active = 1;
        $data->user_modified = Session::get('userinfo')['user_id'];
        $total = 0;
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
                    $total = $total + ($detail->qty * $detail->harga);
                    $detail->save();
                endforeach;
            }

            $data = Pelayanan::find($id_pelayanan);
            $data->total = $total;
            $data->save();

            $data = PelayananDetail::where('id_pelayanan', '=', $id_pelayanan)->orderBy('id', 'ASC')->get();
            foreach ($data as $data) :
                $detail = Apotek::find($data->id_apotek);
                $detail->jumlah = $detail->jumlah - $data->qty;
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
        //
        $data = Apoteker::find($id);
        $data->active = 0;
        $userinfo = Session::get('userinfo');
        $data->user_modified = Session::get('userinfo')['user_id'];
        if ($data->save()) {

            $data = Apoteker::find($id);
            $data = Stok::where('keterangan', '=', $data->no_nota)->orderBy('id', 'ASC')->get();
            foreach ($data as $data) :
                $detail = GudangObat::find($data->id_obat);
                $detail->jumlah = $detail->jumlah - $data->jumlah;
                $detail->save();
            endforeach;

            $data = Apoteker::find($id);
            $res = StokApoteker::where('keterangan', '=', $data->no_nota)->delete();

            Session::flash('success', 'Data deleted successfully');
            Session::flash('mode', 'success');
            return new JsonResponse(["status" => true]);
        } else {
            return new JsonResponse(["status" => false]);
        }

        return new JsonResponse(["status" => false]);
    }



    public function popup_media_obat($id_count = null)
    {
        $apotek = Apotek::all();

        return view('pelayanan.view_apotekobat')->with('id_count', $id_count)->with('apotek', $apotek);
    }

    public function popup_media_pasien($id_count = null)
    {
        $datapasien = DataPasien::all();

        return view('pelayanan.view_datapasien')->with('id_count', $id_count)->with('datapasien', $datapasien);
    }



    public function testgan($id_count = null, Request $request)
    {
        if ($request->ajax()) {
            $data = GudangObat::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">View</a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }


        return view('pelayanan.view_test')->with('id_count', $id_count);
    }
}
