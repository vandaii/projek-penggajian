<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use App\Models\User;
use Illuminate\Http\Request;

class JabatanController extends Controller
{
    public function index()
    {

        $jabatans = Jabatan::orderBy('id')->latest()->paginate(10);
        return view('jabatan.index', compact('jabatans'), ['title' => 'Jabatan']);
    }

    public function create()
    {

        return view('jabatan.create', ['title' => 'Tambah Jabatan']);
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'gaji_pokok' => ['required', 'string', 'max:255'],
            'tunjangan' => ['required', 'string', 'max:255'],
        ]);

        Jabatan::create([
            'name' => $request->name,
            'gaji_pokok' => $request->gaji_pokok,
            'tunjangan' => $request->tunjangan,
        ]);
        return redirect()->route('jabatan.index')->with('success', 'Jabatan berhasil ditambahkan');
    }

    public function show(string $id)
    {

        $jabatan = Jabatan::find($id);
        $users = User::where('jabatan_id', $id)->paginate(10);
        return view('jabatan.show', compact('jabatan', 'users'), ['title' => 'Lihat Jabatan']);
    }

    public function edit(string $id)
    {

        $jabatan = Jabatan::find($id);
        return view('jabatan.edit', compact('jabatan'), ['title' => 'Edit Jabatan']);
    }

    public function update(Request $request, string $id)
    {

        $jabatan = Jabatan::find($id);
        $jabatan->update($request->all());
        return redirect()->route('jabatan.index')->with('success', 'Jabatan berhasil diubah');
    }

    public function destroy(string $id)
    {

        $jabatan = Jabatan::find($id);
        $jabatan->delete();
        return redirect()->route('jabatan.index')->with('success', 'Jabatan berhasil dihapus');
    }
}
