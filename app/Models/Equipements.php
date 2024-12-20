<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Equipements extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'num_serie',
        'designation_equipement',
        'nom_equipement',
        'type_equipement',
        'etat_equipement',
        'date_acq',
        'site',
    ];
}
