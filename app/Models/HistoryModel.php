<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HistoryModel extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'history';
    protected $guarded = [];
}
