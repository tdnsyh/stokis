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

        $penjualan = Penjualan::updateOrCreate(
            ['stokis_id' => $request->stokis_id, 'tahun' => $request->tahun],
            [
                'jan' => $request->quartal === 'Q1' ? $request->jan : 0,
                'feb' => $request->quartal === 'Q1' ? $request->feb : 0,
                'mar' => $request->quartal === 'Q1' ? $request->mar : 0,
                'apr' => $request->quartal === 'Q2' ? $request->apr : 0,
                'mei' => $request->quartal === 'Q2' ? $request->mei : 0,
                'jun' => $request->quartal === 'Q2' ? $request->jun : 0,
                'jul' => $request->quartal === 'Q3' ? $request->jul : 0,
                'agt' => $request->quartal === 'Q3' ? $request->agt : 0,
                'sep' => $request->quartal === 'Q3' ? $request->sep : 0,
                'okt' => $request->quartal === 'Q4' ? $request->okt : 0,
                'nov' => $request->quartal === 'Q4' ? $request->nov : 0,
                'des' => $request->quartal === 'Q4' ? $request->des : 0,
            ]
        );

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
