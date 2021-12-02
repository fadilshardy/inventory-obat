<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Session;
use Illuminate\Http\Request;
use App\Http\Controllers;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\GudangObat;
use App\HistoriGudang;
use App\Masterobat;
use App\PelayananDetail;
use App\Apotek;
use Carbon\Carbon;
use DataTables;

class KartuStokController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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
        $data = MasterObat::all();
        DataTables::of($data)->addColumn('action', function ($data) {
            $first = date("Y-m-d", strtotime("first day of this month"));
            $last = date("Y-m-d", strtotime("last day of this month"));
            $data->stok_masuk = DB::table('gudang_obat')
                ->whereBetween('created_at', [new Carbon($first), new Carbon($last)])
                ->where('id_obat', $data->id)
                ->sum('stok_awal');
            $data->stok_keluar = DB::table('histori_gudang')
                ->whereBetween('created_at', [new Carbon($first), new Carbon($last)])
                ->where('id_obat', $data->id)
                ->sum('jumlah');
            $data->stok_akhir = DB::table('gudang_obat')
                ->where('id_obat', $data->id)
                ->sum('jumlah');
        })->make(true);

        view()->share('startDate', $startDate);
        view()->share('endDate', $endDate);
        view()->share('mode', $mode);
        return view('kartustok.laporan_kartu',  ['data' => $data]);
    }



    public function histori_gudang_keluar($id)
    {
        $first = date("Y-m-d", strtotime("first day of this month"));
        $last = date("Y-m-d", strtotime("last day of this month"));
        $dataobat = Masterobat::find($id);
        $data = Apotek::
        whereBetween('created_at', [new Carbon($first), new Carbon($last)])
            ->where('id_obat', $id)
            ->get();

            

    
        return view('kartustok.histori_keluar_gudang',  ['data' => $data],  ['dataobat' => $dataobat]);
    }
    public function histori_gudang_masuk($id)
    {
        $dataobat = Masterobat::find($id);
        $data = GudangObat::where('id_obat', $id)->get();
        return view('kartustok.histori_masuk_gudang',  ['data' => $data],  ['dataobat' => $dataobat]);
    }
}
