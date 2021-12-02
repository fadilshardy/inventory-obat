<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\Pelayanan;
use App\GudangObat;
use App\DataPasien;
use App\Apotek;
use App\PelayananDetail;
use Carbon\Carbon;
use App\LaporanStok;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $pelayanan = Pelayanan::take(10)->get();
        $gudangobat = GudangObat::take(10)->get();

        $startdate = Carbon::now()->StartOfDay();
        $enddate = Carbon::now()->EndOfDay();



        $jumlah = [
            'jumlah_gudang' => GudangObat::all()->count(),
            'jumlah_apotek' => Apotek::all()->count(),
            'jumlah_pasien' => DataPasien::all()->count(),
            'jumlah_pelayanan' => Pelayanan::all()->count()
        ];

        $laporanharian = [
            'jumlah_transaksi' => Pelayanan::WhereBetween('created_at', [new Carbon($startdate), new Carbon($enddate)])->count(),
            'jumlah_obat_keluar' => PelayananDetail::WhereBetween('created_at', [new Carbon($startdate), new Carbon($enddate)])->sum('qty'),
            'jumlah_obat_masuk' => GudangObat::WhereBetween('created_at', [new Carbon($startdate), new Carbon($enddate)])->sum('stok_awal')

        ];

        $notification = [
            'safety_stock' => LaporanStok::Where('status', '=', 'warning')->count(),
            'reorder_point' => LaporanStok::where('status', '=', 'restock')->count()
           

        ];


        return view('home')->with('pelayanan', $pelayanan)
            ->with('gudangobat', $gudangobat)
            ->with('jumlah', $jumlah)
            ->with('laporanharian', $laporanharian)
            ->with('notification', $notification);
    }
}
