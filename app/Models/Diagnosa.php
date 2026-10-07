<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Diagnosa extends Model
{
       protected $fillable = ['user_id', 'penyakit_id', 'cf_result', 'gejala_terpilih', 'hasil_diagnosa'];

protected $casts = [
    'gejala_terpilih' => 'array',
];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function penyakit()
    {
        return $this->belongsTo(Penyakit::class);
    }
}
