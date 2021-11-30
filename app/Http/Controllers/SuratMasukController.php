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

    public function editindex(int $id)
    {
        $conf_tglsurat= [
            'format' => 'DD/MM/YYYY',
            'locale' => 'id',
        ];

        // Get Data
        $data = SuratMasuk::find($id);

        // Konversi Tanggal
        $tanggal_masuk = Carbon::parse($data->tanggal_masuk)->format('d/m/Y');
        $tanggal_surat = Carbon::parse($data->tanggal_surat)->format('d/m/Y');

        return view('kelola.surat.masuk.edit', [
            'data' => $data,
            'conf_tglsurat' => $conf_tglsurat,
            'tanggal_masuk' => $tanggal_masuk,
            'tanggal_surat' => $tanggal_surat,
        ]);
    }

    public function lihat(int $id)
    {
        $conf_tglsurat= [
            'format' => 'DD/MM/YYYY',
            'locale' => 'id',
        ];

        // Get Data
        $data = SuratMasuk::find($id);

        // Konversi Tanggal
        $tanggal_masuk = Carbon::parse($data->tanggal_masuk)->format('d/m/Y');
        $tanggal_surat = Carbon::parse($data->tanggal_surat)->format('d/m/Y');

        return view('kelola.surat.masuk.lihat', [
            'data' => $data,
            'conf_tglsurat' => $conf_tglsurat,
            'tanggal_masuk' => $tanggal_masuk,
            'tanggal_surat' => $tanggal_surat,
        ]);
    }

    public function tambah(Request $request)
    {
        $request->validate([
            'tanggal_masuk' => 'required',
            'bidang' => 'required',
            'nomor_surat' => 'required|unique:surat_masuks',
            'tanggal_surat' => 'required',
            'pengirim' => 'required',
            'kepada' => 'required',
            'perihal' => 'required',
            'file' => 'file|mimes:pdf',
            'operator' => 'required',
        ]);

        // Konversi Tanggal
        $tanggal_masuk = Carbon::createFromFormat('d/m/Y', $request->input('tanggal_masuk'))->format('Y-m-d');
        $tanggal_surat = Carbon::createFromFormat('d/m/Y', $request->input('tanggal_surat'))->format('Y-m-d');

        // Kirim Data ke Database
        $data = new SuratMasuk;
        $data->tanggal_masuk = $tanggal_masuk;
        $data->bidang = $request->input('bidang');
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
        $simpan = $data->save();

        if($simpan){
            return back()->with('success', 'Data Berhasil Ditambahkan!');
        }

        return back()->with('error', 'Data Gagal Ditambahkan!');
    }

    public function edit(Request $request, int $id)
    {
        $data = SuratMasuk::find($id);

        $request->validate([
            'tanggal_masuk' => 'required',
            'bidang' => 'required',
            'nomor_surat' => 'required|unique:surat_masuks,nomor_surat,'.$data->id,
            'tanggal_surat' => 'required',
            'pengirim' => 'required',
            'kepada' => 'required',
            'perihal' => 'required',
            'file' => 'file|mimes:pdf',
            'operator' => 'required',
        ]);

        // Konversi Tanggal
        $tanggal_masuk = Carbon::createFromFormat('d/m/Y', $request->input('tanggal_masuk'))->format('Y-m-d');
        $tanggal_surat = Carbon::createFromFormat('d/m/Y', $request->input('tanggal_surat'))->format('Y-m-d');

        $data->tanggal_masuk = $tanggal_masuk;
        $data->bidang = $request->input('bidang');
        $data->nomor_surat = $request->input('nomor_surat');
        $data->tanggal_surat = $tanggal_surat;
        $data->pengirim = $request->input('pengirim');
        $data->kepada = $request->input('kepada');
        $data->perihal = $request->input('perihal');
        $data->operator = $request->input('operator');

        // Cek apakah ada berkas?
        if ($request->hasFile('file')) {
            // Hapus Berkas Lama (Jika Ada)
            $namaberkas = $data->file;
            if (is_file(public_path('file') . '/' . $namaberkas)) {
                unlink(public_path('file') . '/' . $namaberkas);
            }
            // Upload File Baru
            $fileName = time() . '_' . $request->file->getClientOriginalName();
            $request->file->move(public_path('file'), $fileName);
            $data->file = $fileName;
        }
        $simpan = $data->save();

        if($simpan){
            return back()->with('success', 'Data Berhasil Ditambahkan!');
        }

        return back()->with('error', 'Data Gagal Ditambahkan!');
    }

    public function hapus(int $id)
    {
        $data = SuratMasuk::find($id);
        $namaberkas = $data->file;

        // Hapus Berkas Lama (Jika Ada)
        if (is_file(public_path('file') . '/' . $namaberkas)) {
            unlink(public_path('file') . '/' . $namaberkas);
        }
        $data->delete();

        return back()
            ->with('success', 'Data Berhasil Dihapus!');
    }

    public function hapus_berkas(int $id)
    {
        $data = SuratMasuk::find($id);
        $namaberkas = $data->file;

        // Hapus Berkas Lama ()
        unlink(public_path('file') . '/' . $namaberkas);
        $data->file = null;
        $data->save();

        return back()
            ->with('success', 'Berkas Berhasil Dihapus!');
    }
}
