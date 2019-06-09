<?php

namespace App\Http\Controllers;

use App\KategoriObat;
use App\Supplier;
use App\BentukSediaan;
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
        // Get kategori obat, supplier, and bentuksediaan
        $kategoriobat = KategoriObat::all();

        $supplier = Supplier::all();
        $bentuksediaan = BentukSediaan::all();


        // Return the create view
        return view('masterobat.create')->with('kategoriobat', $kategoriobat)->with('supplier', $supplier)->with('bentuksediaan', $bentuksediaan);
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

        ]);

        // Create new instance of the model
        $data = new MasterObat;

        $data->nama_obat = $request->input('nama_obat');
        $data->dosis = $request->input('dosis');
        $data->bentuk_sediaan = $request->input('bentuk_sediaan');
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

        // Get kategori obat, supplier, and bentuksediaan
        $kategoriobat = KategoriObat::all();
        $supplier = Supplier::all();
        $bentuksediaan = BentukSediaan::all();

        // Return the edit view
        return view('masterobat.edit')->with('masterobat', $masterobat)->with('kategoriobat', $kategoriobat)->with('bentuksediaan', $bentuksediaan);
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
        $data = GudangObat::find($masterobat);

        // Validate user input
        $this->validate($request, [
            'nama_obat' => 'required|min:3|max:150',
            'dosis' => 'required|min:3|max:50',
            'bentuk_sediaan' => 'required|min:3|max:150',
        ]);


        $data->nama_obat = $request->input('nama_obat');
        $data->dosis = $request->input('dosis');
        $data->bentuk_sediaan = $request->input('bentuk_sediaan');
        // Save the updated product
        $data->save();

        // Return to index view with success message
        return redirect('/masterobat')->with('success', 'Obat berhasil di edit!.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(MasterObat $masterobat)
    {
        //
    }
}
