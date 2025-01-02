<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penjualan;
use App\Models\Stokis;
use App\Exports\StokisPenjualanExport;
use Maatwebsite\Excel\Facades\Excel;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $tahun = $request->get('tahun');
        $kecamatan = $request->get('kecamatan');
        $kokab = $request->get('kokab');
        $stokis = $request->get('stokis');

        $stokisQuery = Stokis::with(['penjualan' => function ($query) use ($tahun) {
            if ($tahun) {
                $query->where('tahun', $tahun);
            }
        }, 'kokab', 'kecamatan']);

        if ($kecamatan) {
            $stokisQuery->where('kecamatan_id', $kecamatan);
        }
        if ($kokab) {
            $stokisQuery->where('kokab_id', $kokab);
        }
        if ($stokis) {
            $stokisQuery->where('id', $stokis);
        }

        $stokis = $stokisQuery->get();

        $filterOptions = [
            'tahun' => $stokis->pluck('penjualan.*.tahun')->flatten()->unique(),
            'kecamatan' => Stokis::with('kecamatan')->get()->pluck('kecamatan.nama_kecamatan', 'kecamatan_id'),
            'kokab' => Stokis::with('kokab')->get()->pluck('kokab.nama_kokab', 'kokab_id'),
            'stokis' => Stokis::all()
        ];

        return view('dashboard.laporan.index', compact('stokis', 'filterOptions', 'tahun', 'kecamatan', 'kokab', 'stokis'));
    }
}
