<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryMcu extends Model
{
    use HasFactory;
    protected $table = "history_mcu";

    protected $guarded = [''];

}
