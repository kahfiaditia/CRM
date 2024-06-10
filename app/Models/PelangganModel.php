<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PelangganModel extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'pelanggan';
    protected $guarded = [];

    public function nama_ar()
    {
        return $this->belongsTo(User::class, 'ar');
    }

    // public function nama_aplikasi()
    // {
    //     return $this->belongsTo(AplikasiModel::class, 'ar');
    // }
}
