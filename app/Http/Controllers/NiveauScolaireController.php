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
           'nom' => 'required|string|min:3',

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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, NiveauScolaire $niveauScolaire)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(NiveauScolaire $niveauScolaire)
    {
        //
    }
}
