<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PenjualanDetilModel extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'penjualan_detil';
    protected $guarded = [];

    public function nama()
    {
        return $this->belongsTo(ObatModel::class, 'obat_id');
    }
}
