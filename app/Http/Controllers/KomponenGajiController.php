<?php

namespace App\Http\Controllers;

use App\Models\KomponenGaji;
use App\Models\User;
use Illuminate\Http\Request;

class KomponenGajiController extends Controller
{
    public function index()
    {

        $komponens = KomponenGaji::with('user')->orderBy('id')->paginate(10);

        foreach ($komponens as $komponen) {
            $komponen->total_potongan = $komponen->potongan + $komponen->pph + $komponen->bpjs;
        }

        return view('komponen_gaji.index', compact('komponens'), ['title' => 'Komponen Gaji']);
    }

    public function create()
    {

        $users = User::all();
        return view('komponen_gaji.create', compact('users'), ['title' => 'Tambah Komponen Gaji']);
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => ['required'],
            'gaji_pokok' => ['required'],
            'tunjangan' => ['required'],
            'potongan' => ['required'],
            'pph' => ['required'],
            'bpjs' => ['required'],
            'gaji_bersih' => ['required'],
        ]);

        KomponenGaji::create([
            'user_id' => $request->user_id,
            'gaji_pokok' => $request->gaji_pokok,
            'tunjangan' => $request->tunjangan,
            'potongan' => $request->potongan,
            'pph' => $request->pph,
            'bpjs' => $request->bpjs,
            'gaji_bersih' => $request->gaji_bersih,
        ]);

        return redirect()->route('komponen_gaji.index')->with('success, Absen berhasil');
    }

    public function edit(string $id)
    {

        $komponen = KomponenGaji::findOrFail($id);
        $users = User::all();

        return view('komponen_gaji.edit', compact('users', 'komponen'), ['title' => 'Edit Komponen Gaji']);
    }

    public function update(Request $request, string $id)
    {

        $komponen = KomponenGaji::findOrFail($id);
        $request->validate([
            'user_id' => ['required'],
            'gaji_pokok' => ['required'],
            'tunjangan' => ['required'],
            'potongan' => ['required'],
            'pph' => ['required'],
            'bpjs' => ['required'],
            'gaji_bersih' => ['required'],
        ]);

        $komponen->update($request->all());
        return redirect()->route('komponen_gaji.index')->with('success', 'Komponen gaji berhasil diubah');
    }

    public function destroy(string $id) {
        $komponen = KomponenGaji::find($id);
        $komponen->delete();

        return redirect()->route('komponen_gaji.index')->with('success', 'Komponen gaji berhasil dihapus');
    }
}
