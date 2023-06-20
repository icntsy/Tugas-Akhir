<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Familyplanning extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'age',
        'address',
        'husbands_name',
        'entry_date',
    ];

    public function familyplanningexamination()
{
    return $this->belongsToMany("App\Models\FamilyPlanningExamination", "familyplanning_id", "id");
}
}

