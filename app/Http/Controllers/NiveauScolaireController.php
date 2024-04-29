<?php

namespace App\Http\Controllers;

use App\Models\NiveauScolaire;
use Illuminate\Http\Request;
use Inertia\Inertia;

class NiveauScolaireController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()

    { $niveauscolaires = NiveauScolaire::orderBy('nom', 'asc')->paginate(5);

        return Inertia::render('NiveauScolaire/indexNiveauScolaire', ['niveauscolaires'=>$niveauscolaires]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

       $request->validate([
           'nom' => 'required|string|min:3|unique:niveau_scolaires,nom'

         ]);
        $model = new NiveauScolaire();
        $model->nom = $request->input('nom');
        $model->save();
        return redirect()->route('niveauScolaire.index')->with('success', 'Niveau scolaire ajouté avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(NiveauScolaire $niveauScolaire)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(NiveauScolaire $niveauScolaire)
    {

        return response()->json(['NiveauScolaire' => $niveauScolaire]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, NiveauScolaire $niveauScolaire)
    {
        $request->validate([
            'nom' => 'required|string|min:3|unique:niveau_scolaires,nom,'.$niveauScolaire->id
        ]);
       if($request->input('nom')!= $niveauScolaire->nom) {
           $niveauScolaire->nom = $request->input('nom');
           $niveauScolaire->save();
       }
        return redirect()->route('niveauScolaire.index')->with('success', 'Niveau scolaire modifié avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(NiveauScolaire $niveauScolaire)
    {
        if ($niveauScolaire->etudiants->count() > 0) {
            return redirect()->route('niveauScolaire.index')->with('error', 'Impossible de supprimer ce niveau scolaire car il est associé à des étudiants');
        };
        $niveauScolaire->delete();
        return redirect()->route('niveauScolaire.index')->with('success', 'Niveau scolaire supprimé avec succès');
    }
}
