<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ObatModel extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "obat";
    protected $guarded = [];

    public function jenis()
    {
        return $this->belongsTo(JenisModel::class, 'jenis_id');
    }
}
