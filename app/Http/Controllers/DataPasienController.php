<?php

namespace App\Http\Controllers;

use App\DataPasien;

use Illuminate\Http\Request;

class DataPasienController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get all the stok in gudang obat
        $datapasien = DataPasien::all();


        // Return the index view
        return view('datapasien.index')->with('data', $datapasien);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Return the create view
        return view('datapasien.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = new DataPasien;

        $data->nama_pasien = $request->input('nama_pasien');
        $data->gender = $request->input('gender');
        $data->tanggal_lahir = date("d-m-Y", strtotime($request->input('tanggal_lahir')));
        $data->alamat = $request->input('alamat');
        $data->no_telp = $request->input('no_telp');
        $data->save();

        // Return to index view with success message
        return redirect('/datapasien')->with('success', 'Data pasien berhasil di simpan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($data_id)
    {
        // get kategori obat
        $data = DataPasien::find($data_id);

        // return view
        return view('datapasien.show')->with('data', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($data)
    {
        // Get the data pasien to edit
        $data = DataPasien::find($data);


        // Return the edit view
        return view('datapasien.edit')->with('data', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $data)
    {
        // Get obat
        $data = GudangObat::find($data);


        $data->nama_obat = $request->input('nama_obat');
        $data->id_obat = $request->input('id_obat');
        $data->keterangan = $request->input('keterangan');
        $data->dosis = $request->input('dosis');
        $data->bentuk_sediaan = $request->input('bentuk_sediaan');
        $data->supplier = $request->input('supplier');
        $data->harga_satuan = $request->input('harga_satuan');
        $data->jumlah = $request->input('jumlah');
        $data->expiry_date = date("d-m-Y", strtotime($request->input('expiry_date')));

        $data->instock = $request->input('instock');

        // Save the updated product
        $data->save();

        // Return to index view with success message
        return redirect('/gudangobat')->with('success', 'Obat berhasil di edit!.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(GudangObat $data)
    {
        //
    }

    public function popup_media_obat($id_count = null)
    {
        $masterobat = MasterObat::all();

        return view('gudangobat.view_masterobat')->with('id_count', $id_count)->with('masterobat', $masterobat);
    }
}
