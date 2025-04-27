<?php

namespace App\Http\Controllers;

use App\Models\TPK;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TPKController extends Controller
{
    // Tampilkan semua data TPK
    public function index()
    {
        $tpks = TPK::all();
        return view('tpk.index', compact('tpks'));
    }

    // Tampilkan form buat tambah TPK
    public function create()
    {
        return view('tpk.create');
    }

    // Simpan data TPK baru
    public function store(Request $request)
{
    $rules = [
        'NIK' => 'required|digits:16|unique:_t_p_k,NIK',
        'nama' => 'required',
        'tanggal_lahir' => 'required|date',
        'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
        'kecamatan' => 'required',
        'kelurahan' => 'required',
        'no_hp' => 'required',
        'password' => 'required|min:6',
    ];

    $messages = [
        'NIK.required' => 'NIK wajib diisi.',
        'NIK.digits' => 'NIK harus tepat 16 angka.',
        'NIK.unique' => 'NIK sudah digunakan, silakan cek kembali.',
        'nama.required' => 'Nama wajib diisi.',
        'tanggal_lahir.required' => 'Tanggal lahir wajib diisi.',
        'tanggal_lahir.date' => 'Format tanggal lahir tidak valid.',
        'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih.',
        'jenis_kelamin.in' => 'Jenis kelamin harus Laki-laki atau Perempuan.',
        'kecamatan.required' => 'Kecamatan wajib dipilih.',
        'kelurahan.required' => 'Kelurahan wajib dipilih.',
        'no_hp.required' => 'Nomor HP wajib diisi.',
        'password.required' => 'Password wajib diisi.',
        'password.min' => 'Password minimal 6 karakter.',
    ];

    $request->validate($rules, $messages);

    TPK::create([
        'NIK' => $request->NIK,
        'nama' => $request->nama,
        'tanggal_lahir' => $request->tanggal_lahir,
        'jenis_kelamin' => $request->jenis_kelamin,
        'kecamatan' => $request->kecamatan,
        'kelurahan' => $request->kelurahan,
        'no_hp' => $request->no_hp,
        'password' => \Hash::make($request->password),
    ]);

    return redirect()->route('tpk.index')->with('success', 'Data TPK berhasil ditambahkan.');
}


    // Tampilkan form edit data TPK
    public function edit(TPK $tpk)
    {
        return view('tpk.edit', compact('tpk'));
    }

    // Update data TPK
    public function update(Request $request, TPK $tpk)
    {
        $request->validate([
            'NIK' => 'required|unique:_t_p_k,NIK,' . $tpk->id,
            'nama' => 'required',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'kecamatan' => 'required',
            'kelurahan' => 'required',
            'no_hp' => 'required',
            // password opsional diupdate
        ]);

        $data = $request->only([
            'NIK', 'nama', 'tanggal_lahir', 'jenis_kelamin', 'kecamatan', 'kelurahan', 'no_hp'
        ]);

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $tpk->update($data);

        return redirect()->route('tpk.index')->with('success', 'Data TPK berhasil diupdate.');
    }

    // Hapus data TPK
    public function destroy(TPK $tpk)
    {
        $tpk->delete();
        return redirect()->route('tpk.index')->with('success', 'Data TPK berhasil dihapus.');
    }
}