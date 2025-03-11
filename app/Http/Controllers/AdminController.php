<?php

namespace App\Http\Controllers;

use App\Models\BPJS;
use App\Models\Divisi;
use App\Models\Jabatan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title = 'Dashboard';
        $link = 'admin.dashboard';
        $query = $request->input('search');

        $users = User::with('divisi', 'jabatan', 'bpjs')->when($query, function ($karyawan) use ($query) {
            $karyawan->where(function ($q) use ($query) {
                $q->where('name', 'LIKE', "%{$query}%")
                    ->orWhere('email', 'LIKE', "%{$query}%");
            });
        })->latest()->paginate(10);

        return view('admin.dashboard', compact('users'), ['title' => $title, 'link' => $link]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Tambah Karyawan';
        $link = '/admin/dashboard';

        $divisis = Divisi::all();
        $jabatans = Jabatan::all();
        $bpjss = BPJS::all();
        return view('karyawan.create', compact('divisis', 'jabatans', 'bpjss'), ['title' => $title, 'link' => $link]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'name' => ['required', 'string', 'max:255'],
            'jenis_kelamin' => ['required', 'string', 'max:255'],
            'bpjs_id' => ['integer'],
            'divisi_id' => ['integer'],
            'jabatan_id' => ['integer'],
            'alamat' => ['required', 'string', 'max:255'],
            'no_hp' => ['required', 'string ', 'max:2000'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
        ]);

        $image = $request->file('image');
        $filename = date('YmdHi') . $image->getClientOriginalName();
        $image->move(public_path('/images/user/'), $filename);

        User::create([
            'image' => $filename,
            'name' => $request->name,
            'jenis_kelamin' => $request->jenis_kelamin,
            'bpjs_id' => $request->bpjs_id,
            'divisi_id' => $request->divisi_id,
            'jabatan_id' => $request->jabatan_id,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
            'password' => Hash::make('hello1234'),
        ]);
        return redirect()->route('admin.dashboard');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::find($id);
        return view('karyawan.show', compact('user'), ['title' => 'Profile Karyawan']);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::find($id);
        $divisis = Divisi::all();
        $jabatans = Jabatan::all();
        $bpjss = BPJS::all();
        return view('karyawan.edit', compact('user', 'divisis', 'jabatans', 'bpjss'), ['title' => 'Edit Karyawan']);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::find($id);

        if ($request->hasFile('image')) {

            $image = $request->file('image');
            $filename = date('YmdHi') . $image->getClientOriginalName();
            $image->move(public_path('/images/user/'), $filename);
            $imagePath = public_path('images/user/' . $user->image);
            File::delete($imagePath);

            $user->update([
                'image' => $filename,
                'name' => $request->name,
                'jenis_kelamin' => $request->jenis_kelamin,
                'bpjs_id' => $request->bpjs_id,
                'divisi_id' => $request->divisi_id,
                'jabatan_id' => $request->jabatan_id,
                'alamat' => $request->alamat,
                'no_hp' => $request->no_hp,
                'email' => $request->email,
                'password' => Hash::make('hello1234'),
            ]);
        } else {

            $user->update([
                'name' => $request->name,
                'bpjs_id' => $request->bpjs_id,
                'jenis_kelamin' => $request->jenis_kelamin,
                'divisi_id' => $request->divisi_id,
                'jabatan_id' => $request->jabatan_id,
                'alamat' => $request->alamat,
                'no_hp' => $request->no_hp,
                'email' => $request->email,
                'password' => Hash::make('hello1234'),
            ]);
        }

        return redirect()->route('admin.dashboard');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);

        $imagePath = public_path('images/user/' . $user->image);
        if (File::exists($imagePath)) {
            File::delete($imagePath);
        }
        $user->delete();
        return redirect()->route('admin.dashboard');
    }
}
