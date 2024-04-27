<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class etudiant extends Model
{
    use HasFactory;
    protected $table = 'etudiants';
    protected $fillable = ['nom','prenom','date_naissance','lieu_naissance','niveau_scolaire_id'];
    public function niveau_scolaire(){
        return $this->belongsTo(NiveauScolaire::class);
    }
}
