<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;


use Illuminate\Http\Request;

use App\Supplier;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get all suppliers
        $suppliers = Supplier::all();

        // Return the index view
        return view('suppliers.index')->with('suppliers', $suppliers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Return the create view
        return view('suppliers.create');
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
            'nama_supplier' => 'required|min:3|max:120',
            'nomor_telepon' => 'required|min:3|max:120',

        ]);

        // Create new instance of the model
        $supplier = new Supplier;

        $supplier ->nama_supplier  = $request->input('nama_supplier');
        $supplier ->nomor_telepon  = $request->input('nomor_telepon');

        // Save the new model
        $supplier->save();

        // Return to index with success message
        return redirect('/suppliers')->with('success', 'supplier berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show($supplier_id)
    {
        // get Supplier
        $supplier = Supplier::find($supplier_id);
        

        // return view
        return view('suppliers.show')->with('suppliers', $supplier);
    }


    public function edit($supplier)
    {
        // Get the supplier to edit
        $supplier = Supplier::find($supplier);

        // Return the edit view
        return view('suppliers.edit')->with('suppliers', $supplier);
    }


    public function update(Request $request, $supplier)
    {
        // Get supplier
        $supplier = Supplier::find($supplier);

        // Validate the user input
        $this->validate($request, [
            'nama_supplier' => 'required|min:3|max:120',
            'nomor_telepon' => 'required|min:3|max:120',


        ]);

        // Edit Supplier
        $supplier ->nama_supplier  = $request->input('nama_supplier');
        $supplier ->nomor_telepon  = $request->input('nomor_telepon');

        // Save the changes
        $supplier->save();

        // Return to index page with success message
        return redirect('/suppliers')->with('success', 'Supplier berhasil diedit!');
    }


    public function destroy(Supplier $supplier)
    {
        //
    }
}
