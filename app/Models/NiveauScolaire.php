<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NiveauScolaire extends Model
{
    use HasFactory;
    protected $table = 'niveau_scolaires';
    protected $fillable = ['nom'];
    public function etudiants(){
        return $this->hasMany(etudiant::class);
    }
}
