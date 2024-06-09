<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProdukModel extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "produk";
    protected $guarded = [];

    public function jenis()
    {
        return $this->belongsTo(SatuanModel::class, 'satuan_id');
    }
}