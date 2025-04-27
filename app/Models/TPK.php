<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class TPK extends Authenticatable
{
    // Tentukan nama tabel yang digunakan oleh model ini
    protected $table = '_t_p_k';

    // Kolom yang boleh diisi secara mass-assignment
    protected $fillable = [
        'NIK',
        'nama',
        'tanggal_lahir',
        'jenis_kelamin',
        'kecamatan',
        'kelurahan',
        'no_hp',
        'password',
        'role' // Jika ada kolom role, pastikan kolom ini ada di tabel _t_p_k
    ];

    // Kolom yang harus disembunyikan (seperti password)
    protected $hidden = [
        'password', // Jangan tampilkan password dalam array atau JSON
    ];

    // Definisikan atribut yang akan digunakan untuk autentikasi
    public function getAuthIdentifierName()
    {
        return 'NIK'; // Gantilah ini dengan 'NIK' agar login menggunakan NIK, bukan email
    }

    public function getAuthIdentifier()
    {
        return $this->NIK; // Ambil NIK sebagai identifier
    }

    public function getAuthPassword()
    {
        return $this->password; // Ambil password untuk verifikasi login
    }
}
