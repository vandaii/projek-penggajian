<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Absen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AbsenController extends Controller
{
    public function index(Request $request)
    {

        $user = Auth::user();
        $today = Carbon::today()->toDateString();
        $selectedDate = $request->input('tanggal', $today);
        if ($user->role == 'admin') {
            $absens = Absen::with('user')->whereDate('tanggal', $selectedDate)->paginate(10);
        } else {
            $absens = Absen::with('user')->where('user_id', $user->id)->whereDate('tanggal', $selectedDate)->paginate(10);
        }

        $hasAbsenToday = Absen::where('user_id', $user->id)->whereDate('tanggal', $today)->exists();

        if (!$hasAbsenToday && $selectedDate == $today) {
            $absens->prepend(new Absen([
                'user_id' => $user->id,
                'tanggal' => $today,
                'jam_masuk' => null,
                'jam_keluar' => null,
                'status' => 'Aktif',
                'keterangan' => 'Tidak Hadir'
            ]));
        }

        $users = User::all();

        return view('absen.index', compact('absens', 'users', 'selectedDate'), ['title' => 'Absen']);
    }

    public function create()
    {

        if (Auth::user()->role != 'admin') {
            $users = User::where('id', Auth::user()->id)->get();
        } else {
            $users = User::all();
        }

        return view('absen.create', compact('users'), ['title' => 'Isi Absen']);
    }

    public function store(Request $request)
    {

        $user = Auth::user();
        $hari = date('Y-m-d');

        if ($user->role != 'admin') {

            $existingAbsen = Absen::where('user_id', $user->id)->whereDate('tanggal', $hari)->first();

            if ($existingAbsen) {
                return redirect()->route('absen.index')->with('error', 'Anda sudah absen hari ini');
            }
        }

        $request->validate([
            'user_id' => ['required'],
            'status' => ['required'],
            'tanggal' => ['required', 'date'],
            'jam_masuk' => ['required'],
            'jam_keluar' => ['required'],
            'keterangab' => ['string', 'nullable'],
        ]);

        Absen::create([
            'user_id' => $request->user_id,
            'status' => $request->status,
            'tanggal' => $request->tanggal,
            'jam_masuk' => $request->jam_masuk,
            'jam_keluar' => $request->jam_keluar,
            'keterangab' => $request->keterangab,
        ]);

        return redirect()->route('absen.index')->with('success', 'Absen berhasil');
    }

    public function show(string $id)
    {

        $absen = Absen::find($id);

        return view('absen.show', compact('absen'), ['title' => 'Detail Absen']);
    }

    public function edit(string $id)
    {

        $absen = Absen::find($id);
        $users = User::all();

        return view('absen.edit', compact('absen', 'users'), ['title' => 'Edit Absen']);
    }

    public function update(string $id, Request $request)
    {

        $absen = Absen::find($id);

        $request->validate([
            'user_id' => ['required'],
            'status' => ['required'],
            'tanggal' => ['required', 'date'],
            'jam_masuk' => ['required'],
            'jam_keluar' => ['required'],
            'keterangab' => ['string', 'nullable'],
        ]);

        $absen->update($request->all());

        return redirect()->route('absen.index')->with('success', 'Absen berhasil diubah');
    }

    public function destroy(string $id)
    {

        $absen = Absen::find($id);
        $absen->delete();

        return redirect()->route('absen.index')->with('success', 'Absen berhasil dihapus');
    }
}
