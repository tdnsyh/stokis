<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kecamatan;
use App\Models\Kokab;

class KecamatanController extends Controller
{
    public function index()
    {
        $kecamatans = Kecamatan::with('kokab')->get();
        return view('dashboard.kecamatan.index', compact('kecamatans'));
    }

    public function create()
    {
        $kokabs = Kokab::all();
        return view('dashboard.kecamatan.create', compact('kokabs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kokab_id' => 'required|exists:kokab,id',
            'nama_kecamatan' => 'required|max:255',
        ]);

        Kecamatan::create($request->all());

        return redirect()->route('kecamatan.index')->with('success', 'Berhasil menambahkan data Kecamatan!');
    }

    public function edit(Kecamatan $kecamatan)
    {
        $kokabs = Kokab::all();
        return view('dashboard.kecamatan.edit', compact('kecamatan', 'kokabs'));
    }

    public function update(Request $request, Kecamatan $kecamatan)
    {
        $request->validate([
            'kokab_id' => 'required|exists:kokab,id',
            'nama_kecamatan' => 'required|max:255',
        ]);

        $kecamatan->update($request->all());

        return redirect()->route('kecamatan.index')->with('success', 'Berhasil memperbarui data Kecamatan!');
    }

    public function destroy(Kecamatan $kecamatan)
    {
        $kecamatan->delete();
        return redirect()->route('kecamatan.index')->with('success', 'Berhasil menghapus data Kecamatan!');
    }
}
