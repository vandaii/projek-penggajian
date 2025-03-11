<?php

namespace App\Http\Controllers;

use App\Models\Penggajian;
use App\Models\User;
use App\Models\KomponenGaji;
use App\Models\Absen;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class PenggajianController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $month = $request->input('month', Carbon::now()->month);
        $year = $request->input('year', Carbon::now()->year);

        if ($user->role == 'admin') {
            $users = User::whereHas('jabatan')->where('role', '!=', 'admin')->with('jabatan')->paginate(10);
        } else {
            $users = User::where('id', $user->id)->whereHas('jabatan')->with('jabatan')->paginate(10);
        }

        $penggajians = Penggajian::whereMonth('tanggal', $month)
            ->whereYear('tanggal', $year)
            ->get()
            ->keyBy('user_id');

        // Calculate total salary for each user
        foreach ($users as $user) {
            $komponenGaji = KomponenGaji::where('user_id', $user->id)->first();
            if ($komponenGaji) {
                $user->total_gaji = $komponenGaji->gaji_pokok + $komponenGaji->tunjangan - $komponenGaji->potongan - $komponenGaji->pph - $komponenGaji->bpjs;
                $user->total_potongan = $komponenGaji->potongan + $komponenGaji->pph + $komponenGaji->bpjs;
            } else {
                $user->total_gaji = 0;
                $user->total_potongan = 0;
            }
        }

        return view('penggajian.index', compact('users', 'penggajians', 'month', 'year'), ['title' => 'Gaji Karyawan']);
    }

    public function gajiSemua()
    {
        $bulan = Carbon::now()->startOfMonth();

        // Check if salaries have already been added for this month
        $existingPenggajian = Penggajian::whereMonth('tanggal', $bulan->month)
            ->whereYear('tanggal', $bulan->year)
            ->exists();

        if ($existingPenggajian) {
            return redirect()->route('penggajian.index')->with('error', 'Gaji sudah diisi untuk bulan ini.');
        }

        $users = User::whereHas('jabatan')->with('jabatan')->get();

        foreach ($users as $user) {
            $komponenGaji = KomponenGaji::where('user_id', $user->id)->first();
            if ($komponenGaji) {
                // Check if the user has any absences in the current month
                $absences = Absen::where('user_id', $user->id)
                    ->whereMonth('tanggal', $bulan->month)
                    ->whereYear('tanggal', $bulan->year)
                    ->where('keterangab', '=', 'Hadir')
                    ->count();

                // Deduct 100000 for each absence
                $absence_deduction = $absences * 200000;

                $total_gaji = ($komponenGaji->gaji_pokok * 0) + $komponenGaji->tunjangan - $komponenGaji->potongan - $komponenGaji->pph - $komponenGaji->bpjs + $absence_deduction;

                Penggajian::create([
                    'user_id' => $user->id,
                    'komponen_id' => $komponenGaji->id,
                    'gaji_pokok' => $komponenGaji->gaji_pokok,
                    'tanggal' => $bulan,
                    'tunjangan' => $komponenGaji->tunjangan,
                    'potongan' => $komponenGaji->potongan,
                    'pph' => $komponenGaji->pph,
                    'bpjs' => $komponenGaji->bpjs,
                    'gaji_bersih' => $total_gaji,
                ]);
            }
        }

        return redirect()->route('penggajian.index')->with('success', 'Gaji semua karyawan berhasil ditambahkan');
    }

    public function gajiKaryawan($id)
    {
        $bulan = Carbon::now()->startOfMonth();

        // Check if salary has already been added for this user for this month
        $existingPenggajian = Penggajian::where('user_id', $id)
            ->whereMonth('tanggal', $bulan->month)
            ->whereYear('tanggal', $bulan->year)
            ->exists();

        if ($existingPenggajian) {
            return redirect()->route('penggajian.index')->with('error', 'Gaji sudah diisi untuk karyawan ini pada bulan ini.');
        }

        $user = User::find($id);
        if (!$user) {
            return redirect()->route('penggajian.index')->with('error', 'Karyawan tidak ditemukan.');
        }

        $komponenGaji = KomponenGaji::where('user_id', $user->id)->first();
        if (!$komponenGaji) {
            return redirect()->route('penggajian.index')->with('error', 'Komponen gaji tidak ditemukan untuk karyawan ini.');
        }

        // Check if the user has any absences in the current month
        $absences = Absen::where('user_id', $user->id)
            ->whereMonth('tanggal', $bulan->month)
            ->whereYear('tanggal', $bulan->year)
            ->where('keterangab', '=', 'Hadir')
            ->count();

        // Deduct 100000 for each absence
        $absence_deduction = $absences * 200000;

        $total_gaji = ($komponenGaji->gaji_pokok * 0) + $komponenGaji->tunjangan - $komponenGaji->potongan - $komponenGaji->pph - $komponenGaji->bpjs + $absence_deduction;

        Penggajian::create([
            'user_id' => $user->id,
            'komponen_id' => $komponenGaji->id,
            'gaji_pokok' => $komponenGaji->gaji_pokok,
            'tanggal' => $bulan,
            'tunjangan' => $komponenGaji->tunjangan,
            'potongan' => $komponenGaji->potongan,
            'pph' => $komponenGaji->pph,
            'bpjs' => $komponenGaji->bpjs,
            'gaji_bersih' => $total_gaji,
        ]);

        return redirect()->route('penggajian.index')->with('success', 'Gaji karyawan berhasil ditambahkan');
    }

    public function slipGajiSemua()
    {
        $penggajians = Penggajian::with(['user' => function ($query) {
            $query->where('role', '!=', 'admin');
        }, 'komponenGaji'])->get();

        $pdf = PDF::loadView('penggajian.semua', compact('penggajians'));
        return $pdf->download('penggajian_semua.pdf');
    }

    public function slipGaji(string $id)
    {
        $month = Carbon::now()->month;
        $year = Carbon::now()->year;

        $penggajian = Penggajian::with('user', 'komponenGaji')
            ->where('user_id', $id)
            ->whereMonth('tanggal', $month)
            ->whereYear('tanggal', $year)
            ->first();

        if (!$penggajian) {
            return redirect()->route('penggajian.index')->with('error', 'Data penggajian tidak ditemukan.');
        }

        $pdf = PDF::loadView('penggajian.pdf', compact('penggajian'));
        return $pdf->download('slip_gaji.pdf');
    }
}
