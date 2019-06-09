<?php

namespace App\Http\Controllers;

use App\GudangObat;
use App\Apotek;
use App\HistoriGudang;
use App\KategoriObat;
use App\Supplier;
use App\BentukSediaan;
use App\LaporanStok;
use App\MasterObat;
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
        endforeach;
    }


    public function index()
    {
        // Get all the stok in gudang obat
        $apotek = Apotek::all();



        // Return the index view
        return view('apotek.index')->with('apotek', $apotek);
    }



    public function search_gudangobat(Request $request)
    {
        if ($request->has('q')) {
            $cari = $request->q;
            $data = DB::table('gudang_obat')->where('instock', '!=', 0)->where('nama_obat', 'LIKE', '%' . $cari . '%')->get();
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
        // $gudangobat = GudangObat::all();
        $kategoriobat = KategoriObat::all();

        $supplier = Supplier::all();
        $bentuksediaan = BentukSediaan::all();


        // Return the create view
        return view('apotek.create')->with('kategoriobat', $kategoriobat)->with('supplier', $supplier)->with('bentuksediaan', $bentuksediaan);

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
        $data->nama_obat = $request->input('nama_obat');
        $data->no_batch = $request->input('no_batch');
        $data->keterangan = $request->input('keterangan');
        $data->dosis = $request->input('dosis');
        $data->bentuk_sediaan = $request->input('bentuk_sediaan');
        $data->supplier = $request->input('supplier');
        $data->harga_satuan = $request->input('harga_satuan');
        $data->jumlah = $request->input('jumlah');
        $data->expiry_date = $request->input('expiry_date');
        $data->instock = 1;
        $data->stok_awal = $request->input('jumlah');
        $data->active = 1;


        //validator
        $stokgudang = GudangObat::find($data->id_gudang);
        if ($data->jumlah >  $stokgudang->jumlah) {
            $messages = "Penarikan jumlah melebihi stok gudang";
            return back()->withErrors($messages);
        } else {
            if ($data->save()) {
                $histori = new HistoriGudang();
                $histori->id_gudang = $data->id_gudang;
                $histori->id_obat = $data->id_obat;
                $histori->jumlah = $data->jumlah;
                $histori->harga_satuan = $data->harga_satuan;
                $histori->save();
            }
            $id_histori = $histori->id;
            $id_gudang = $data->id_gudang;

            $data = HistoriGudang::where('id', '=',  $id_histori)->orderBy('id', 'ASC')->get();
            foreach ($data as $data) :
                $detail = GudangObat::find($id_gudang);
                $detail->jumlah = $detail->jumlah - $data->jumlah;
                if ($detail->jumlah == 0) {
                    $detail->instock = 0;
                }
                $detail->save();

            endforeach;


            return Redirect::to('/apotek')->with('success', "Data telah tersimpan!")->with('mode', 'success');
        }
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
            'no_batch' => 'required|min:3|max:150',
            'keterangan' => 'required|min:3|max:150',
            'dosis' => 'required|min:3|max:50',
            'bentuk_sediaan' => 'required|min:3|max:150',
            'supplier' => 'required|min:3|max:150',
            'harga_satuan' => 'required|numeric',
            'jumlah' => 'required|numeric',
            'expiry_date' => 'required|min:3|max:150',
            'instock' => 'required|numeric|between:0,1',
        ]);

        $gudangobat->nama_obat = $request->input('nama_obat');
        $gudangobat->nama_obat = $request->input('no_batch');

        $gudangobat->keterangan = $request->input('keterangan');
        $gudangobat->dosis = $request->input('dosis');
        $gudangobat->bentuk_sediaan = $request->input('bentuk_sediaan');
        $gudangobat->supplier = $request->input('supplier');
        $gudangobat->harga_satuan = $request->input('harga_satuan');
        $gudangobat->jumlah = $request->input('jumlah');
        $gudangobat->expiry_date = $request->input('expiry_date');
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
    public function destroy(GudangObat $gudangobat)
    {
        //
    }

    public function popup_media_obat($id_count = null)
    {
        $data = GudangObat::latest()->get();
        return Datatables::of($data)
            ->addIndexColumn()
            ->make(true);


        return view('pelayanan.view_test')->with('id_count', $id_count);
    }
}
