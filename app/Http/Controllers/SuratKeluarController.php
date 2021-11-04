<?php

namespace App\Http\Controllers;

use App\Models\SuratKeluar;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SuratKeluarController extends Controller
{
    public function index()
    {
        // Get Data
        $data = SuratKeluar::get();

        return view('kelola.surat.keluar.index', [
            'data' => $data,
        ]);
    }

    public function tambahindex()
    {
        $conf_tglkeluar= [
            'locale' => 'id',
        ];
        $conf_tglsurat= [
            'format' => 'DD/MM/YYYY',
            'locale' => 'id',
        ];
        $user = Auth::user();

        return view('kelola.surat.keluar.tambah', [
            'conf_tglkeluar' => $conf_tglkeluar,
            'conf_tglsurat' => $conf_tglsurat,
            'user' => $user,
        ]);
    }

    public function editindex(int $id)
    {
        $conf_tglkeluar= [
            'locale' => 'id',
        ];
        $conf_tglsurat= [
            'format' => 'DD/MM/YYYY',
            'locale' => 'id',
        ];

        // Get Data
        $data = SuratKeluar::find($id);

        // Konversi Tanggal
        $tanggal_keluar = Carbon::parse($data->tanggal_keluar)->format('d/m/Y H.m');
        $tanggal_surat = Carbon::parse($data->tanggal_surat)->format('d/m/Y');

        return view('kelola.surat.keluar.edit', [
            'data' => $data,
            'conf_tglkeluar' => $conf_tglkeluar,
            'conf_tglsurat' => $conf_tglsurat,
            'tanggal_keluar' => $tanggal_keluar,
            'tanggal_surat' => $tanggal_surat,
        ]);
    }

    public function lihat(int $id)
    {
        $conf_tglkeluar= [
            'locale' => 'id',
        ];
        $conf_tglsurat= [
            'format' => 'DD/MM/YYYY',
            'locale' => 'id',
        ];

        // Get Data
        $data = SuratKeluar::find($id);

        // Konversi Tanggal
        $tanggal_keluar = Carbon::parse($data->tanggal_keluar)->format('d/m/Y H.m');
        $tanggal_surat = Carbon::parse($data->tanggal_surat)->format('d/m/Y');

        return view('kelola.surat.keluar.lihat', [
            'data' => $data,
            'conf_tglkeluar' => $conf_tglkeluar,
            'conf_tglsurat' => $conf_tglsurat,
            'tanggal_keluar' => $tanggal_keluar,
            'tanggal_surat' => $tanggal_surat,
        ]);
    }

    public function tambah(Request $request)
    {
        $request->validate([
            'tanggal_keluar' => 'required',
            'kode' => 'required|unique:surat_keluars',
            'nomor_surat' => 'required|unique:surat_keluars',
            'tanggal_surat' => 'required',
            'kepada' => 'required',
            'perihal' => 'required',
            'file' => 'file|mimes:pdf',
            'operator' => 'required',
        ]);

        // Konversi Tanggal
        $tanggal_keluar = Carbon::parse($request->input('tanggal_keluar'))->format('Y-m-d h:i');
        $tanggal_surat = Carbon::parse($request->input('tanggal_surat'))->format('Y-m-d');

        // Kirim Data ke Database
        $data = new SuratKeluar;
        $data->tanggal_keluar = $tanggal_keluar;
        $data->kode = $request->input('kode');
        $data->nomor_surat = $request->input('nomor_surat');
        $data->tanggal_surat = $tanggal_surat;
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
        $data = SuratKeluar::find($id);

        $request->validate([
            'tanggal_keluar' => 'required',
            'kode' => 'required|unique:surat_keluars,kode,'.$data->id,
            'nomor_surat' => 'required|unique:surat_keluars,nomor_surat,'.$data->id,
            'tanggal_surat' => 'required',
            'kepada' => 'required',
            'perihal' => 'required',
            'file' => 'file|mimes:pdf',
            'operator' => 'required',
        ]);

        // Konversi Tanggal
        $tanggal_keluar = Carbon::parse($request->input('tanggal_keluar'))->format('Y-m-d h:i');
        $tanggal_surat = Carbon::parse($request->input('tanggal_surat'))->format('Y-m-d');

        $data->tanggal_keluar = $tanggal_keluar;
        $data->kode = $request->input('kode');
        $data->nomor_surat = $request->input('nomor_surat');
        $data->tanggal_surat = $tanggal_surat;
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
        $data = SuratKeluar::find($id);
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
        $data = SuratKeluar::find($id);
        $namaberkas = $data->file;

        // Hapus Berkas Lama ()
        unlink(public_path('file') . '/' . $namaberkas);
        $data->file = null;
        $data->save();

        return back()
            ->with('success', 'Berkas Berhasil Dihapus!');
    }
}
