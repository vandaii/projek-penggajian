<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Divisi;
use Illuminate\Http\Request;

class DivisiController extends Controller
{
    public function index()
    {

        $divisis = Divisi::all();
        return view('divisi.index', compact('divisis'), ['title' => 'Divisi']);
    }

    public function create()
    {

        return view('divisi.create', ['title' => 'Tambah Divisi']);
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'deskripsi' => ['required', 'string'],
        ]);

        Divisi::create([
            'name' => $request->name,
            'deskripsi' => $request->deskripsi,
        ]);
        return redirect()->route('divisi.index')->with('success', 'Divisi berhasil ditambahkan');
    }

    public function show(string $id)
    {

        $divisi = Divisi::find($id);
        $users = User::where('jabatan_id', $id)->paginate(10);
        return view('divisi.show', compact('divisi', 'users'), ['title' => 'Lihat Divisi']);
    }

    public function edit(string $id)
    {

        $divisi = Divisi::find($id);
        return view('divisi.edit', compact('divisi'), ['title' => 'Edit Divisi']);
    }

    public function update(Request $request, string $id)
    {

        $divisi = Divisi::find($id);
        $divisi->update($request->all());
        return redirect()->route('divisi.index')->with('success', 'Divisi berhasil diupdate');
    }

    public function destroy(string $id)
    {

        $divisi = Divisi::find($id);
        $divisi->delete();
        return redirect()->route('divisi.index')->with('success', 'Divisi berhasil dihapus');
    }
}
