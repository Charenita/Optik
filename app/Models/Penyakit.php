<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penyakit extends Model
{
        protected $fillable = ['kode_penyakit', 'nama_penyakit', 'deskripsi', 'gejala_umum', 'saran_penanganan'];

    public function rules()
    {
        return $this->hasMany(Rule::class);
    }

    public function diagnosas()
    {
        return $this->hasMany(Diagnosa::class);
    }
}
