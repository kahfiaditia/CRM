<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubMenuModel extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'table_submenu';
    protected $guarded = [];
}
