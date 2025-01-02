<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kokab;
use App\Models\Kecamatan;
use App\Models\Stokis;

class StokisController extends Controller
{
    public function index(Request $request)
    {
        $kokabs = Kokab::all();
        $kecamatans = Kecamatan::all();
        $stokisQuery = Stokis::query();

        if ($request->has('kecamatan_id') && $request->kecamatan_id != '') {
            $stokisQuery->where('kecamatan_id', $request->kecamatan_id);
        }

        if ($request->has('search') && $request->search != '') {
            $searchTerm = '%' . $request->search . '%';

            $stokisQuery->where(function ($query) use ($searchTerm) {
                $query->where('nama_stokis', 'like', $searchTerm)
                    ->orWhere('no_hp', 'like', $searchTerm)
                    ->orWhere('member', 'like', $searchTerm)
                    ->orWhere('nama_member', 'like', $searchTerm)
                    ->orWhereHas('kokab', function ($query) use ($searchTerm) {
                        $query->where('nama_kokab', 'like', $searchTerm);
                    })
                    ->orWhereHas('kecamatan', function ($query) use ($searchTerm) {
                        $query->where('nama_kecamatan', 'like', $searchTerm);
                    });
            });
        }

        $stokis = $stokisQuery->with(['kokab', 'kecamatan'])->get();

        return view('dashboard.stokis.index', compact('stokis', 'kokabs', 'kecamatans'));
    }

    public function create()
    {
        $kokabs = Kokab::all();
        $kecamatans = Kecamatan::all();
        return view('dashboard.stokis.create', compact('kokabs', 'kecamatans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kokab_id' => 'required|exists:kokab,id',
            'kecamatan_id' => 'required|exists:kecamatan,id',
            'nama_stokis' => 'required|max:255',
            'no_hp' => 'required|max:20',
            'member' => 'required|max:50',
            'nama_member' => 'required|max:255',
        ]);

        Stokis::create($request->all());

        return redirect()->route('stokis.index')->with('success', 'Berhasil menambahkan data Stokis!');
    }

    public function edit($id)
    {
        $stokis = Stokis::findOrFail($id);
        $kokabs = Kokab::all();
        $kecamatans = Kecamatan::all();
        return view('dashboard.stokis.edit', compact('stokis', 'kokabs', 'kecamatans'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kokab_id' => 'required|exists:kokab,id',
            'kecamatan_id' => 'required|exists:kecamatan,id',
            'nama_stokis' => 'required|max:255',
            'no_hp' => 'required|max:20',
            'member' => 'required|max:50',
            'nama_member' => 'required|max:255',
        ]);

        $stokis = Stokis::findOrFail($id);
        $stokis->update($request->all());
        return redirect()->route('stokis.index')->with('success', 'Data stokis berhasil diupdate!');
    }

    public function destroy($id)
    {
        $stokis = Stokis::findOrFail($id);
        $stokis->delete();

        return redirect()->route('stokis.index')->with('success', 'Data stokis berhasil dihapus!');
    }
}
