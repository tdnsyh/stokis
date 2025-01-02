<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kokab;

class KokabController extends Controller
{
    public function index()
    {
        $kokabs = Kokab::all();
        return view('dashboard.kokab.index', compact('kokabs'));
    }

    public function create()
    {
        return view('dashboard.kokab.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kokab' => 'required|max:255',
        ]);

        Kokab::create($request->all());
        return redirect()->route('kokab.index')->with('success', 'Berhasil menambahkan data Kota/Kabupaten!');
    }

    public function edit(Kokab $kokab)
    {
        return view('dashboard.kokab.edit', compact('kokab'));
    }

    public function update(Request $request, Kokab $kokab)
    {
        $request->validate([
            'nama_kokab' => 'required|max:255',
        ]);

        $kokab->update($request->all());

        return redirect()->route('kokab.index')->with('success', 'Berhasil memperbarui data Kota/Kabupaten!');
    }

    public function destroy(Kokab $kokab)
    {
        $kokab->delete();
        return redirect()->route('kokab.index')->with('success', 'Berhasil menghapus data Kota/Kabupaten!');
    }
}
