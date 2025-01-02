<?php

namespace App\Http\Controllers;

use App\Models\Stokis;
use Illuminate\Http\Request;
use App\Models\Penjualan;

class PenjualanController extends Controller
{
    public function index(Request $request)
    {
        $tahun = $request->get('tahun', now()->year);

        $stokis = Stokis::leftJoin('penjualan', function ($join) use ($tahun) {
            $join->on('stokis.id', '=', 'penjualan.stokis_id')
                ->where('penjualan.tahun', '=', $tahun);
        })->select(
            'stokis.id',
            'stokis.nama_stokis',
            'stokis.member',
            'stokis.nama_member',
            'penjualan.jan',
            'penjualan.feb',
            'penjualan.mar',
            'penjualan.apr',
            'penjualan.mei',
            'penjualan.jun',
            'penjualan.jul',
            'penjualan.agt',
            'penjualan.sep',
            'penjualan.okt',
            'penjualan.nov',
            'penjualan.des',
            'penjualan.total',
            'penjualan.updated_at',
            'penjualan.tahun'
        )->get();

        return view('dashboard.penjualan.index', compact('stokis', 'tahun'));
    }


    public function create()
    {
        $stokis = Stokis::with(['kokab', 'kecamatan'])->get();
        $currentYear = now()->year;
        $years = range($currentYear - 5, $currentYear + 5);
        return view('dashboard.penjualan.create', compact('stokis', 'years'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'stokis_id' => 'required|exists:stokis,id',
            'tahun' => 'required|integer|min:2000|max:' . (now()->year + 5),
            'quartal' => 'required|in:Q1,Q2,Q3,Q4',
            'jan' => 'nullable|integer|min:0',
            'feb' => 'nullable|integer|min:0',
            'mar' => 'nullable|integer|min:0',
            'apr' => 'nullable|integer|min:0',
            'mei' => 'nullable|integer|min:0',
            'jun' => 'nullable|integer|min:0',
            'jul' => 'nullable|integer|min:0',
            'agt' => 'nullable|integer|min:0',
            'sep' => 'nullable|integer|min:0',
            'okt' => 'nullable|integer|min:0',
            'nov' => 'nullable|integer|min:0',
            'des' => 'nullable|integer|min:0',
        ]);

        $penjualan = Penjualan::firstOrNew(['stokis_id' => $request->stokis_id, 'tahun' => $request->tahun]);

        $penjualan->jan = $request->quartal === 'Q1' ? $request->jan : ($penjualan->jan ?? 0);
        $penjualan->feb = $request->quartal === 'Q1' ? $request->feb : ($penjualan->feb ?? 0);
        $penjualan->mar = $request->quartal === 'Q1' ? $request->mar : ($penjualan->mar ?? 0);
        $penjualan->apr = $request->quartal === 'Q2' ? $request->apr : ($penjualan->apr ?? 0);
        $penjualan->mei = $request->quartal === 'Q2' ? $request->mei : ($penjualan->mei ?? 0);
        $penjualan->jun = $request->quartal === 'Q2' ? $request->jun : ($penjualan->jun ?? 0);
        $penjualan->jul = $request->quartal === 'Q3' ? $request->jul : ($penjualan->jul ?? 0);
        $penjualan->agt = $request->quartal === 'Q3' ? $request->agt : ($penjualan->agt ?? 0);
        $penjualan->sep = $request->quartal === 'Q3' ? $request->sep : ($penjualan->sep ?? 0);
        $penjualan->okt = $request->quartal === 'Q4' ? $request->okt : ($penjualan->okt ?? 0);
        $penjualan->nov = $request->quartal === 'Q4' ? $request->nov : ($penjualan->nov ?? 0);
        $penjualan->des = $request->quartal === 'Q4' ? $request->des : ($penjualan->des ?? 0);

        $penjualan->total = $penjualan->jan + $penjualan->feb + $penjualan->mar
            + $penjualan->apr + $penjualan->mei + $penjualan->jun
            + $penjualan->jul + $penjualan->agt + $penjualan->sep
            + $penjualan->okt + $penjualan->nov + $penjualan->des;

        $penjualan->save();

        return redirect()->route('penjualan.index')->with('success', 'Penjualan berhasil ditambahkan.');
    }

    public function detail($stokis_id)
    {
        $stokis = Stokis::with(['kokab', 'kecamatan'])->findOrFail($stokis_id);
        $penjualan = Penjualan::where('stokis_id', $stokis_id)->get();

        return view('dashboard.penjualan.detail', compact('stokis', 'penjualan'));
    }
}
