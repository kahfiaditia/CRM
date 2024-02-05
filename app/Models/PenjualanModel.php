<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PenjualanModel extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'penjualan';
    protected $guarded = [];

    public function pelanggan()
    {
        return $this->belongsTo(PelangganModel::class, 'pelanggan_id');
    }
}
