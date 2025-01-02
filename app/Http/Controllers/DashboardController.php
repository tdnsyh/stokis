<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use App\Models\Stokis;
use App\Models\Kokab;
use App\Models\Kecamatan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalKokab = Kokab::count();
        $totalKecamatan = Kecamatan::count();
        $totalStokis = Stokis::count();

        $penjualanPerTahun = Penjualan::selectRaw('tahun, sum(total) as total_penjualan')
            ->groupBy('tahun')
            ->orderBy('tahun')
            ->get();
        $penjualanPerTahunn = Penjualan::selectRaw('tahun, sum(jan) as jan, sum(feb) as feb, sum(mar) as mar, sum(apr) as apr, sum(mei) as mei, sum(jun) as jun, sum(jul) as jul, sum(agt) as agt, sum(sep) as sep, sum(okt) as okt, sum(nov) as nov, sum(des) as des')
            ->groupBy('tahun')
            ->orderBy('tahun')
            ->get();

        $totalPenjualanKeseluruhan = Penjualan::sum('total');

        $topStokis = Stokis::withSum('penjualan', 'total')
            ->orderByDesc('penjualan_sum_total')
            ->limit(3)
            ->get();

        return view('dashboard.index', compact('totalKokab', 'totalKecamatan', 'totalStokis', 'totalPenjualanKeseluruhan', 'penjualanPerTahun', 'penjualanPerTahunn', 'topStokis'));
    }
}
