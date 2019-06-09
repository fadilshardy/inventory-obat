<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;


use Illuminate\Http\Request;

use App\KategoriObat;

class KategoriObatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get all the KategoriObat
        $kategori_obat = KategoriObat::all();

        // Return the index view
        return view('kategoriobat.index')->with('kategoriobat', $kategori_obat);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Return the create view
        return view('kategoriobat.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the user input
        $this->validate($request, [
            'nama_kategori' => 'required|min:3|max:120',
        ]);

        // Create new instance of the model
        $kategori_obat = new KategoriObat;

        $kategori_obat->nama_kategori = $request->input('nama_kategori');

        // Save the new model
        $kategori_obat->save();

        // Return to index with success message
        return redirect('/kategoriobat')->with('success', 'Kategori obat berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show($kategori_obat_id)
    {
        // get kategori obat
        $kategori_obat = KategoriObat::find($kategori_obat_id);

        // return view
        return view('kategoriobat.show')->with('kategoriobat', $kategori_obat);
    }


    public function edit($kategori_obat)
    {
        // Get the kategoriobat to edit
        $kategori_obat = KategoriObat::find($kategori_obat);

        // Return the edit view
        return view('kategoriobat.edit')->with('kategoriobat', $kategori_obat);
    }


    public function update(Request $request, $kategori_obat)
    {
        // Get kategoriobat
        $kategori_obat = KategoriObat::find($kategori_obat);

        // Validate the user input
        $this->validate($request, [
            'nama_kategori' => 'required|min:3|max:120',

        ]);

        // Edit kategori
        $kategori_obat->nama_kategori = $request->input('nama_kategori');


        // Save the changes
        $kategori_obat->save();

        // Return to index page with success message
        return redirect('/kategoriobat')->with('success', 'Kategori obat berhasil diedit!');
    }


    public function destroy($kategori_obat)
    {
        KategoriObat::destroy($kategori_obat);
        return redirect('/kategoriobat')->with('success', 'Kategori obat berhasil dihapus!');
    }
}
