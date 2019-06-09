<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;


use Illuminate\Http\Request;

use App\BentukSediaan;

class BentukSediaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get all Bentuk sediaan
        $bentuk_sediaan = BentukSediaan::all();

        // Return the index view
        return view('bentuksediaan.index')->with('bentuksediaan', $bentuk_sediaan);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Return the create view
        return view('bentuksediaan.create');
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
            'bentuk_sediaan' => 'required|min:3|max:120',
        ]);

        // Create new instance of the model
        $bentuk_sediaan = new BentukSediaan;

        $bentuk_sediaan->bentuk_sediaan = $request->input('bentuk_sediaan');

        // Save the new model
        $bentuk_sediaan->save();

        // Return to index with success message
        return redirect('/bentuksediaan')->with('success', 'data bentuk sediaan berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show($bentuk_sediaan_id)
    {
        // get kategori obat
        $bentuk_sediaan = BentukSediaan::find($bentuk_sediaan_id);

        // return view
        return view('bentuksediaan.show')->with('bentuksediaan', $bentuk_sediaan);
    }


    public function edit($bentuk_sediaan)
    {
        // Get the bentuksediaan to edit
        $bentuk_sediaan = BentukSediaan::find($bentuk_sediaan);

        // Return the edit view
        return view('bentuksediaan.edit')->with('bentuksediaan', $bentuk_sediaan);
    }


    public function update(Request $request, $bentuk_sediaan)
    {
        // Get bentuk_sediaan
        $bentuk_sediaan = BentukSediaan::find($bentuk_sediaan);

        // Validate the user input
        $this->validate($request, [
            'bentuk_sediaan' => 'required|min:3|max:120',

        ]);

        // Edit kategori
        $bentuk_sediaan->bentuk_sediaan = $request->input('bentuk_sediaan');


        // Save the changes
        $bentuk_sediaan->save();

        // Return to index page with success message
        return redirect('/bentuksediaan')->with('success', 'Bentuk sediaan berhasil diedit!');
    }


    public function destroy(KategoriObat $bentuk_sediaan)
    {
        //
    }
}
