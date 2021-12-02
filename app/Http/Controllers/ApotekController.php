<?php

namespace App\Http\Controllers;

use App\GudangObat;
use App\Apotek;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use DB;

class ApotekController extends Controller
{

    public function __construct()
    {
        $expiry_datechecker = Apotek::all();
        foreach ($expiry_datechecker as $data) :
            $now =  Carbon::now();
            $date = Carbon::parse($data->expiry_date);
            if ($now->greaterThan($date)) {
                $data->active = 0;
                $data->save();
            }
            if ($data->jumlah_apotek == 0) {
                $data->active = 0;
                $data->save();
            }
        endforeach;
    }


    public function index()
    {
        // Get all the stok in gudang obat
        $apotek = Apotek::orderBy('created_at', 'DESC')->get();



        // Return the index view
        return view('apotek.index')->with('apotek', $apotek);
    }



    public function search_gudangobat(Request $request)
    {
        if ($request->has('q')) {
            $cari = $request->q;
            $data = DB::table('gudang_obat')
                ->join('master_obat', 'gudang_obat.id_obat', '=', 'master_obat.id')
                ->where('active', '!=', 0)
                ->select('gudang_obat.id as id_gudang', 'gudang_obat.*', 'master_obat.*')
                ->where('nama_obat', 'LIKE', '%' . $cari . '%')->get();
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


        // Return the create view
        return view('apotek.create');

        // Return the create view
        // return view('apotek.create')->with('gudangobat', $gudangobat);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Get kategori obat, supplier, and bentuksediaan
        $data = new Apotek();

        $data->id_obat = $request->input('id_obat');
        $data->id_gudang = $request->input('id_gudang');
        $data->jumlah_apotek = $request->input('jumlah');
        $data->stok_awal = $request->input('jumlah');
        $data->active = 1;

        //validator
        $stokgudang = GudangObat::find($data->id_gudang);


        if ($data->jumlah_apotek >  $stokgudang->jumlah) {
            $messages = "Penarikan jumlah melebihi stok gudang";
            return back()->withErrors($messages);
        }

        $stokgudang->jumlah = $stokgudang->jumlah - $data->jumlah_apotek;
        if ($stokgudang->jumlah == 0) {
            $stokgudang->active = 0;
        }

        $data->save();
        $stokgudang->save();
        return Redirect::to('/apotek')->with('success', "Data telah tersimpan!")->with('mode', 'success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // get kategori obat
        $data = Apotek::find($id);

        // return view
        return view('apotek.show')->with('data', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Get the obat to edit
        $data = Apotek::find($id);


        // Return the edit view
        return view('apotek.edit')->with('data', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $apotek)
    {
        // Get obat
        $apotek = Apotek::find($apotek);

        $apotek->nama_obat = $request->input('nama_obat');
        $apotek->nama_obat = $request->input('no_batch');

        $apotek->keterangan = $request->input('keterangan');
        $apotek->dosis = $request->input('dosis');
        $apotek->bentuk_sediaan = $request->input('bentuk_sediaan');
        $apotek->supplier = $request->input('supplier');
        $apotek->harga_satuan = $request->input('harga_satuan');
        $apotek->jumlah = $request->input('jumlah');
        $apotek->expiry_date = $request->input('expiry_date');
        $apotek->instock = $request->input('instock');


        // Save the updated product
        $apotek->save();

        // Return to index view with success message
        return redirect('/apotek')->with('success', 'Obat berhasil di edit!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Apotek::destroy($id);
        return redirect('/apotek')->with('success', 'Data berhasil dihapus!');
    }
}
