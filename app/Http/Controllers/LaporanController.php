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
                $data->keluargudang = DB::table('histori_gudang')
                    ->where('id_gudang', $data->id)
                    ->sum('jumlah');
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

    public function index_stokobat()
    {

        $Leadtime = 30;
        $dailyusage =
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
            $data = MasterObat::all();
            DataTables::of($data)->addColumn('action', function ($data) {
                $data->stokgudang = DB::table('gudang_obat')
                    ->where('id_obat', $data->id)
                    ->sum('jumlah');
                $data->stokapotek = DB::table('apotek')
                    ->where('id_obat', $data->id)
                    ->sum('jumlah');
                $data->stokawalgudang = DB::table('gudang_obat')
                    ->where('id_obat', $data->id)
                    ->sum('stok_awal');
                $data->stokawalapotek = DB::table('apotek')
                    ->where('id_obat', $data->id)
                    ->sum('stok_awal');
                $data->keluargudang = DB::table('histori_gudang')
                    ->where('id_obat', $data->id)
                    ->sum('jumlah');
                $data->keluarapotek = DB::table('pelayanan_detail')
                    ->where('id_obat', $data->id)
                    ->sum('qty');
                $lt = 5;
                $dailyusage = $data->keluarapotek / 30;
                $safetystock =   $dailyusage * 14;
                $order = $dailyusage * $lt;
                $reorderpoint = $order + $safetystock;

                $data->safetystock = $safetystock;
                $data->reorderpoint = $reorderpoint;
                return $data->stokgudang;
            })->make(true);
        } else
            if ($mode == "limited") {
            $data = MasterObat::all();
            DataTables::of($data)->addColumn('action', function ($data) {
                $startDate = $_GET["startDate"];
                $endDate = $_GET["endDate"];
                $data->stokgudang = DB::table('gudang_obat')
                    ->where('id_obat', $data->id)
                    ->sum('jumlah');
                $data->stokapotek = DB::table('apotek')
                    ->where('id_obat', $data->id)
                    ->sum('jumlah');
                $data->stokawalgudang = DB::table('gudang_obat')
                    ->whereBetween('created_at', [new Carbon($startDate), new Carbon($endDate)])
                    ->where('id_obat', $data->id)
                    ->sum('stok_awal');
                $data->stokawalapotek = DB::table('apotek')
                    ->whereBetween('created_at', [new Carbon($startDate), new Carbon($endDate)])
                    ->where('id_obat', $data->id)
                    ->sum('stok_awal');
                $data->keluargudang = DB::table('histori_gudang')
                    ->whereBetween('created_at', [new Carbon($startDate), new Carbon($endDate)])
                    ->where('id_obat', $data->id)
                    ->sum('jumlah');
                $data->keluarapotek = DB::table('pelayanan_detail')
                    ->whereBetween('created_at', [new Carbon($startDate), new Carbon($endDate)])
                    ->where('id_obat', $data->id)
                    ->sum('qty');
                return $data->stokgudang . $data->stokapotek . $data->stokawalgudang;
            })->make(true);
        }

        // UPDATE TABLE LAPORAN STOCK 
        $laporanstok = MasterObat::get();
        foreach ($laporanstok as $datas) :

            $stok_gudang = DB::table('gudang_obat')
                ->where('id_obat', $datas->id)
                ->sum('jumlah');
            $stok_apotek = DB::table('apotek')
                ->where('id_obat', $datas->id)
                ->sum('jumlah');
            $stok_masuk_gudang  = DB::table('gudang_obat')
                ->whereBetween('created_at', [new Carbon($startDate), new Carbon($endDate)])
                ->where('id_obat', $datas->id)
                ->sum('stok_awal');
            $stok_masuk_apotek = DB::table('apotek')
                ->whereBetween('created_at', [new Carbon($startDate), new Carbon($endDate)])
                ->where('id_obat', $datas->id)
                ->sum('stok_awal');
            $stok_keluar_gudang = DB::table('histori_gudang')
                ->whereBetween('created_at', [new Carbon($startDate), new Carbon($endDate)])
                ->where('id_obat', $datas->id)
                ->sum('jumlah');
            $stok_keluar_apotek = DB::table('pelayanan_detail')
                ->whereBetween('created_at', [new Carbon($startDate), new Carbon($endDate)])
                ->where('id_obat', $datas->id)
                ->sum('qty');



            LaporanStok::updateOrCreate(
                ['nama_obat' => $datas->nama_obat, 'dosis' => $datas->dosis, 'bentuk_sediaan' => $datas->bentuk_sediaan],
                [
                    'stok_gudang' => $stok_gudang,
                    'stok_apotek' => $stok_apotek,
                    'stok_masuk_gudang' => $stok_masuk_gudang,
                    'stok_masuk_apotek' => $stok_masuk_apotek,
                    'stok_keluar_gudang' => $stok_keluar_gudang,
                    'stok_keluar_apotek' => $stok_keluar_apotek
                ]
            );
        endforeach;

        view()->share('startDate', $startDate);
        view()->share('endDate', $endDate);
        view()->share('mode', $mode);
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
