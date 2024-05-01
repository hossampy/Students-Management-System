<?php

namespace App\Http\Controllers;

use App\Models\etudiant;
use App\Models\NiveauScolaire;
use Illuminate\Http\Request;
use Inertia\Inertia;

class EtudiantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $search = $request->search;
        $filter = $request->filter;
        $per_page = $request->per_page;
        $etudiants = etudiant::with( 'niveau_scolaire')
            ->when($search, function ($query, $search) {
               $query->where('nom', 'LIKE', '%'.$search.'%')
                    ->orWhere('prenom', 'LIKE', '%'.$search.'%');
            })->when($filter, function ($query, $filter) {
                $query->where('niveau_scolaire_id', $filter);
            })->paginate($per_page);

        $niveauScolaires =NiveauScolaire::all();
        return Inertia::render('Etudiant/index', [
            'etudiants' => $etudiants,
            'niveauScolaires' => $niveauScolaires,
            'filter' => $request->all("search", "filter", "per_page"),
        ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Etudiant/create');    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     */
    public function show(etudiant $student)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(etudiant $student)
    {
        return Inertia::render('Etudiant/edit');

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, etudiant $student)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(etudiant $student)
    {
        //
    }
}
