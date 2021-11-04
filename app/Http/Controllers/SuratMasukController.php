<?php

namespace App\Http\Controllers;

use App\Models\SuratMasuk;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SuratMasukController extends Controller
{
    public function index()
    {
        // Get Data
        $data = SuratMasuk::get();

        return view('kelola.surat.masuk.index', [
            'data' => $data,
        ]);
    }

    public function tambahindex()
    {
        $conf_tglmasuk= [
            'locale' => 'id',
        ];
        $conf_tglsurat= [
            'format' => 'DD/MM/YYYY',
            'locale' => 'id',
        ];
        $user = Auth::user();

        return view('kelola.surat.masuk.tambah', [
            'conf_tglmasuk' => $conf_tglmasuk,
            'conf_tglsurat' => $conf_tglsurat,
            'user' => $user,
        ]);
    }

    public function editindex(Request $request, int $id)
    {
        // Get Data
        $data = User::with('roles')->find($id);
        $roles = Role::all();

        return view('kelola.users.edit', [
            'data' => $data,
            'roles' => $roles,
        ]);
    }

    public function tambah(Request $request)
    {
        $request->validate([
            'tanggal_masuk' => 'required',
            'kode' => 'required|unique:surat_masuks',
            'nomor_urut' => 'required|unique:surat_masuks',
            'nomor_surat' => 'required|unique:surat_masuks',
            'tanggal_surat' => 'required',
            'pengirim' => 'required',
            'kepada' => 'required',
            'perihal' => 'required',
            'file' => 'file|mimes:pdf',
            'operator' => 'required',
        ]);

        // Konversi Tanggal
        $tanggal_masuk = Carbon::parse($request->input('tanggal_masuk'))->format('Y-m-d h:i');
        $tanggal_surat = Carbon::parse($request->input('tanggal_surat'))->format('Y-m-d');

        // Kirim Data ke Database
        $data = new SuratMasuk;
        $data->tanggal_masuk = $tanggal_masuk;
        $data->kode = $request->input('kode');
        $data->nomor_urut = $request->input('nomor_urut');
        $data->nomor_surat = $request->input('nomor_surat');
        $data->tanggal_surat = $tanggal_surat;
        $data->pengirim = $request->input('pengirim');
        $data->kepada = $request->input('kepada');
        $data->perihal = $request->input('perihal');
        $data->operator = $request->input('operator');
        if ($request->hasFile('file')) {
            $fileName = time() . '_' . $request->file->getClientOriginalName();
            $request->file->move(public_path('file'), $fileName);
            $data->file = $fileName;
        }
        $data->save();

        return back()->with('success', 'Data Berhasil Ditambahkan!');
    }
}
