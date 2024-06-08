<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RelationModel extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "relation";
    protected $guarded = [];

    public function aplikasi()
    {
        return $this->belongsTo(AplikasiModel::class, 'id_aplikasi');
    }

    public function customer()
    {
        return $this->belongsTo(PelangganModel::class, 'id_customer');
    }
}
