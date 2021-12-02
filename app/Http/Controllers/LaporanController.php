<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\GudangObat;
use App\MasterObat;
use App\Apotek;
use DataTables;
use DB;
use Carbon\Carbon;
use App\LaporanStok;
use Excel;

use App\Exports\StokObatExport;


class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /*
        |--------------------------------------------------------------------------
        |  Laporan apotek
        |--------------------------------------------------------------------------
        */

    public function index_apotek()
    {
        $startDate = "01" . "-" . date('m-Y');
        $endDate = date('d-m-Y');
        $mode = "all";
        if (isset($_GET["startDate"]) || isset($_GET["endDate"]) || isset($_GET["mode"])) {
            if ((isset($_GET['startDate'])) && ($_GET['startDate'] != "")) {
                $startDate = $_GET["startDate"];
            }
            if ((isset($_GET['endDate'])) && ($_GET['endDate'] != "")) {
                $endDate = $_GET["endDate"];
            }
            if (!isset($_GET["mode"])) {
                $mode = "limited";
            }
        }
        if ($mode == "all") {
            $data = Apotek::all();
            DataTables::of($data)->addColumn('action', function ($data) {
                $data->keluarapotek = DB::table('pelayanan_detail')
                    ->where('id_apotek', $data->id)
                    ->sum('qty');
            })->make(true);
        } else
            if ($mode == "limited") {
            $data = GudangObat::all();
            DataTables::of($data)->addColumn('action', function ($data) {
                $startDate = $_GET["startDate"];
                $endDate = $_GET["endDate"];
                $data->keluargudang = DB::table('pelayanan_detail')
                    ->whereBetween('created_at', [new Carbon($startDate), new Carbon($endDate)])
                    ->where('id_apotek', $data->id)
                    ->sum('jumlah');
            })->make(true);
        }

        view()->share('startDate', $startDate);
        view()->share('endDate', $endDate);
        view()->share('mode', $mode);
        return view('laporan.laporan_apotek')->with('data', $data);
    }


    /*
        |--------------------------------------------------------------------------
        | Laporan gudang 
        |--------------------------------------------------------------------------
        */
    public function index_gudangobat()
    {
        $startDate = "01" . "-" . date('m-Y');
        $endDate = date('d-m-Y');
        $mode = "all";
        if (isset($_GET["startDate"]) || isset($_GET["endDate"]) || isset($_GET["mode"])) {
            if ((isset($_GET['startDate'])) && ($_GET['startDate'] != "")) {
                $startDate = $_GET["startDate"];
            }
            if ((isset($_GET['endDate'])) && ($_GET['endDate'] != "")) {
                $endDate = $_GET["endDate"];
            }
            if (!isset($_GET["mode"])) {
                $mode = "limited";
            }
        }
        if ($mode == "all") {
            $data = GudangObat::all();
            DataTables::of($data)->addColumn('action', function ($data) {
                $data->keluargudang = DB::table('apotek')
                    ->where('id_gudang', $data->id)
                    ->sum('stok_awal');
            })->make(true);
        } else
            if ($mode == "limited") {
            $data = GudangObat::all();
            DataTables::of($data)->addColumn('action', function ($data) {
                $startDate = $_GET["startDate"];
                $endDate = $_GET["endDate"];
                $data->keluargudang = DB::table('histori_gudang')
                    ->whereBetween('created_at', [new Carbon($startDate), new Carbon($endDate)])
                    ->where('id_gudang', $data->id)
                    ->sum('jumlah');
            })->make(true);
        }

        view()->share('startDate', $startDate);
        view()->share('endDate', $endDate);
        view()->share('mode', $mode);
        return view('laporan.laporan_gudang')->with('data', $data);
    }

    /*
        |--------------------------------------------------------------------------
        | Laporan semua
        |--------------------------------------------------------------------------
        */

    public function index_stokobat()
    {
            $data = MasterObat::all();
            DataTables::of($data)->addColumn('action', function ($data) {
                $data->stok_gudang = DB::table('gudang_obat')
                ->where('id_obat', $data->id)
                ->where('active', 1)
                ->sum('jumlah');
                $data->stok_apotek = DB::table('apotek')
                    ->where('id_obat', $data->id)
                    ->sum('jumlah_apotek');
                  $start = new Carbon('first day of last month');
                $end = new Carbon('last day of last month');

                $data->total_pemakaian = DB::table('pelayanan_detail')
                ->whereBetween('created_at', [new Carbon($start), new Carbon($end)])
                     ->where('id_obat', $data->id)
                     ->sum('qty');
                $data->stok_total = $data->stok_gudang + $data->stok_apotek;
                $data->harga_total = $data->stok_total * $data->harga_satuan;
                $lead_time = 2; // 2 hari
                $daily_usage = $data->total_pemakaian / 30;
                $safety_stock =   $daily_usage * $lead_time;
                $order = $daily_usage * $lead_time;
                $reorder_point = $order + $safety_stock;


                $data->safety_stock =  $safety_stock;
                $data->reorder_point =  $reorder_point;
                $data->daily_usage =  $daily_usage;
     
                $data->safety_stock = $safety_stock;
                $data->reorder_point = $reorder_point;
                return $data;
            })->make(true);
      

        // UPDATE TABLE LAPORAN STOCK 
        $laporanstok = MasterObat::get();
        foreach ($laporanstok as $laporan):

            $stok_gudang = DB::table('gudang_obat')
                ->where('id_obat', $laporan->id)
                ->sum('jumlah');
            $stok_loker = DB::table('apotek')
                ->where('id_obat', $laporan->id)
                ->sum('jumlah_apotek');
                $laporan->stok_total =   $stok_gudang +  $stok_loker;
                $laporan->harga_total = $laporan->stok_total * $laporan->harga_satuan;
$pemakaian = $laporan->stok_total;
                $start = new Carbon('first day of last month');
                $end = new Carbon('last day of last month');

                $laporan->total_pemakaian = DB::table('pelayanan_detail')
                ->whereBetween('created_at', [new Carbon($start), new Carbon($end)])
                     ->where('id_obat', $laporan->id)
                     ->sum('qty');

                $lead_time = 2; // 2 hari
                $daily_usage = $laporan->total_pemakaian / 30;
                $safety_stock =   $daily_usage * 2;
                $order = $daily_usage * $lead_time;
                $reorder_point = $order + $safety_stock;


                $laporan->safety_stock =  $safety_stock;
                $laporan->reorder_point =  $reorder_point;
                $laporan->daily_usage =  $daily_usage;
     
                $laporan->safety_stock = $safety_stock;
                $laporan->reorder_point = $reorder_point;
if($pemakaian  < $laporan->reorder_point && $pemakaian  > $laporan->safety_stock){
    $laporan->status = "restock";
} elseif(    $pemakaian  <  $laporan->safety_stock){
    $laporan->status = "warning";
}else{
    $laporan->status = "safe";
}



            LaporanStok::updateOrCreate(
                ['nama_obat' => $laporan->nama_obat, 'dosis' => $laporan->dosis],
                [
                    'harga_satuan' => $laporan->harga_satuan,
                    'stok_gudang' => $stok_gudang,
                    'stok_loker' => $stok_loker,
                    'jumlah' =>      $pemakaian,
                    'harga' =>  $laporan->harga_total,
                    'safety_stock' => $laporan->safety_stock,
                    'reorder_point' => $laporan->reorder_point,
                    'status' => $laporan->status
            ]
            );
        endforeach;

    
        return view('laporan.laporan_stokobat')->with('data', $data);
    }

    public function export_stokobat()
    {
        $dataobat = MasterObat::all();
        foreach ($dataobat as $data) :
            $year = $data->id;
        endforeach;
        return Excel::download(new StokObatExport($year), 'LaporanStokObat.xlsx');
    }
}
