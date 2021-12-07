<?php

namespace App\Http\Controllers;

use App\Models\User;
use Crypt;
use Hash;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        // Get Data
        $data = User::with('roles')->get();

        return view('kelola.users.index', [
            'data' => $data,
        ]);
    }

    public function tambahindex()
    {
        // Get Data
        $roles = Role::all();
        $bidang = [
            'Tata Usaha',
            'Pembinaan',
            'Intellijen',
            'Tindak Pidana Umum',
            'Tindak Pidana Khusus',
            'Perdata dan TUN',
            'Pengawasan'
        ];

        return view('kelola.users.tambah', [
            'roles' => $roles,
            'bidang' => $bidang,
        ]);
    }

    public function editindex(int $id)
    {
        // Get Data
        $data = User::with('roles')->find($id);
        $roles = Role::all();
        $bidang = [
            'Tata Usaha',
            'Pembinaan',
            'Intellijen',
            'Tindak Pidana Umum',
            'Tindak Pidana Khusus',
            'Perdata dan TUN',
            'Pengawasan'
        ];

        return view('kelola.users.edit', [
            'data' => $data,
            'roles' => $roles,
            'bidang' => $bidang,
        ]);
    }

    public function tambah(Request $request)
    {
        $request->validate([
            'username' => 'required|string|unique:users',
            'nama' => 'required|string',
            'nip' => 'required|unique:users',
            'peran' => 'required|string',
            'bidang' => 'required|string',
        ]);

        // Get Request
        $get_status = Crypt::decrypt($request->input('peran'));

        // Kirim Data ke Database
        $user = new User;
        $user->username = $request->input('username');
        $user->nama = $request->input('nama');
        $user->nip = $request->input('nip');
        $user->bidang = $request->input('bidang');
        $user->password = bcrypt($request->input('password'));
        $user->save();
        $user->assignRole($get_status);

        return back()->with('success', 'Data Berhasil Ditambahkan!');
    }

    public function edit(Request $request, int $id)
    {
        $data = User::firstWhere('id', $id);

        $request->validate([
            'username' => 'required|string|unique:users,username,'.$data->id,
            'nama' => 'required|string',
            'nip' => 'required|unique:users,nip,'.$data->id,
            'peran' => 'required|string',
            'bidang' => 'required|string',
        ]);

        // Get Request
        $get_status = Crypt::decrypt($request->input('peran'));

        // Edit Data
        if ($request->filled('password')) {
            $data->password = Hash::make($request->input('password'));
        }
        $data->username =$request->input('username');
        $data->nama = $request->input('nama');
        $data->nip = $request->input('nip');
        $data->bidang = $request->input('bidang');
        $data->save();
        $data->assignRole($get_status);

        return back()->with('success', 'Data Berhasil Diubah!');
    }

    public function hapus(int $id)
    {
        User::find($id)->delete();

        return redirect()->route('index.user');
    }
}
