<?php

namespace App\Http\Controllers;

use App\MasterObat;
use App\GudangObat;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;


class GudangObatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function __construct()
    {
        $expiry_datechecker = GudangObat::all();
        foreach ($expiry_datechecker as $data) :
            $now =  Carbon::now();
            $date = Carbon::parse($data->expiry_date);
            if ($now->greaterThan($date)) {
                $data->active = 0;
                $data->save();
            }
        endforeach;
    }

    public function index()
    {
        // Get all the stok in gudang obat
        $data = GudangObat::with('MasterObat')->get();

        // Return the index view
        return view('gudangobat.index')->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Return the create view
        return view('gudangobat.create');
    }

    public function search_masterobat(Request $request)
    {
        if ($request->has('q')) {
            $cari = $request->q;
            $data = DB::table('master_obat')->where('nama_obat', 'LIKE', '%' . $cari . '%')->get();
            return response()->json($data);
        }
    }

    public function store(Request $request)
    {
        // Validate user input
        $this->validate($request, [
            'id_obat' => 'required',
            'no_batch' => 'required|min:3|max:150',
            'supplier' => 'required|min:3|max:150',
            'jumlah' => 'required|numeric',
            'expiry_date' => 'required|min:3|max:150',
        ]);

        // Create new instance of the model
        $gudangobat = new GudangObat;

        $gudangobat->id_obat = $request->input('id_obat');
        $gudangobat->no_batch = $request->input('no_batch');
        $gudangobat->keterangan = $request->input('keterangan');
        $gudangobat->supplier = $request->input('supplier');
        $gudangobat->jumlah = $request->input('jumlah');
        $gudangobat->expiry_date = ($request->expiry_date);
        $gudangobat->stok_awal = $request->input('jumlah');
        $gudangobat->active  = 1;


        // Save the new obat
        $gudangobat->save();

        // Return to index view with success message
        return redirect('/gudangobat')->with('success', 'Obat berhasil di simpan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($gudangobat_id)
    {
        // get kategori obat

        $gudangobat = GudangObat::find($gudangobat_id);

        // $pelayanan_detail = DB::table('gudang_obat')
        //     ->where('id', $gudangobat_id)
        //     ->join('master_obat', 'gudang_obat.id_obat', '=', 'master_obat.id')
        //     ->get();

        // return view

        // return view
        return view('gudangobat.show')->with('gudangobat', $gudangobat);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($gudangobat)
    {
        // Get the obat to edit
        $gudangobat = GudangObat::find($gudangobat);

        // Get kategori obat, supplier, and bentuksediaan
        $kategoriobat = KategoriObat::all();
        $supplier = Supplier::all();
        $bentuksediaan = BentukSediaan::all();

        // Return the edit view
        return view('gudangobat.edit')->with('gudangobat', $gudangobat)->with('kategoriobat', $kategoriobat)->with('supplier', $supplier)->with('bentuksediaan', $bentuksediaan);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $gudangobat)
    {
        // Get obat
        $gudangobat = GudangObat::find($gudangobat);

        // Validate user input
        $this->validate($request, [
            'nama_obat' => 'required|min:3|max:150',
            'id_obat' => 'required',
            'no_batch' => 'required|min:3|max:150',
            'dosis' => 'required|min:3|max:50',
            'bentuk_sediaan' => 'required|min:3|max:150',
            'supplier' => 'required|min:3|max:150',
            'jumlah' => 'required|numeric',
            'expiry_date' => 'required|min:3|max:150',
            'instock' => 'required|numeric|between:0,1',
        ]);

        $gudangobat->nama_obat = $request->input('nama_obat');
        $gudangobat->id_obat = $request->input('id_obat');
        $gudangobat->keterangan = $request->input('keterangan');
        $gudangobat->dosis = $request->input('dosis');
        $gudangobat->bentuk_sediaan = $request->input('bentuk_sediaan');
        $gudangobat->supplier = $request->input('supplier');
        $gudangobat->jumlah = $request->input('jumlah');
        $gudangobat->expiry_date = date("d-m-Y", strtotime($request->input('expiry_date')));

        $gudangobat->instock = $request->input('instock');

        // Save the updated product
        $gudangobat->save();

        // Return to index view with success message
        return redirect('/gudangobat')->with('success', 'Obat berhasil di edit!.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        GudangObat::destroy($id);
        return redirect('/gudangobat')->with('success', 'Data berhasil dihapus!');
    }

    public function popup_media_obat($id_count = null)
    {
        $masterobat = MasterObat::all();

        return view('gudangobat.view_masterobat')->with('id_count', $id_count)->with('masterobat', $masterobat);
    }
}
