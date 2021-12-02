<?php

namespace App\Http\Controllers;


use App\MasterObat;
use Illuminate\Http\Request;

class MasterObatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get all the stok in gudang obat
        $masterobat = MasterObat::all();


        // Return the index view
        return view('masterobat.index')->with('masterobat', $masterobat);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Return the create view
        return view('masterobat.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate user input
        $this->validate($request, [
            'nama_obat' => 'required|min:3|max:150',
            'dosis' => 'required|min:3|max:50',
            'bentuk_sediaan' => 'required|min:3|max:150',
            'harga_satuan' => 'required|numeric',


        ]);

  

        // Create new instance of the model
        $data = new MasterObat;

        $data->nama_obat = $request->input('nama_obat');
        $data->dosis = $request->input('dosis');
        $data->bentuk_sediaan = $request->input('bentuk_sediaan');
        $data->harga_satuan = $request->input('harga_satuan');

        // Save the new obat
        $data->save();

        // Return to index view with success message
        return redirect('/masterobat')->with('success', 'Data berhasil di simpan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($obat_id)
    {
        // get kategori obat
        $masterobat  = MasterObat::find($obat_id);

        // return view
        return view('masterobat.show')->with('masterobat', $masterobat);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($masterobat)
    {
        // Get the obat to edit
        $masterobat = MasterObat::find($masterobat);
        // Return the edit view
        return view('masterobat.edit')->with('masterobat', $masterobat);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $masterobat)
    {
        // Get obat
        $data = MasterObat::find($masterobat);

        // Validate user input
        $this->validate($request, [
            'nama_obat' => 'required|min:3|max:150',
            'dosis' => 'required|min:3|max:50',
            'bentuk_sediaan' => 'required|min:3|max:150',
            'harga_satuan' => 'required|numeric',
        ]);


        $data->nama_obat = $request->input('nama_obat');
        $data->dosis = $request->input('dosis');
        $data->bentuk_sediaan = $request->input('bentuk_sediaan');
        $data->harga_satuan = $request->input('harga_satuan');

        // Save the updated product
        $data->save();

        // Return to index view with success message
        return redirect('/masterobat')->with('success', 'Obat berhasil di edit!');
    }
}
