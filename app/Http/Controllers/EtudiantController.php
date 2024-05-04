<?php

namespace App\Http\Controllers;

use App\Models\etudiant;
use App\Models\NiveauScolaire;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
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
        $etudiants = etudiant::with('niveau_scolaire')
            ->when($search, function ($query, $search) {
                $query->where('nom', 'LIKE', '%' . $search . '%')
                    ->orWhere('prenom', 'LIKE', '%' . $search . '%');
            })->when($filter, function ($query, $filter) {
                $query->where('niveau_scolaire_id', $filter);
            })->paginate($per_page);

        $niveauScolaires = NiveauScolaire::all();
        return Inertia::render('Etudiant/index', [
            'etudiants' => $etudiants,
            'niveauScolaires' => $niveauScolaires,
            'filter' => $request->all("search", "filter", "per_page"),
        ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request, NiveauScolaire $niveauScolaire)
    {

        $niveauScolaires = NiveauScolaire::all();
        return Inertia::render('Etudiant/create', ['niveauScolaires' => $niveauScolaires]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            "nom" => "required",
            "prenom" => "required",
            "sexe" => "required",
            "age" => "required",
            "niveauScolaire" => "required|",
        ]);
        try {
            DB::beginTransaction();

            $etudiant = etudiant::create(["nom" => $request->nom, "prenom" => $request->prenom, "sexe" => $request->sexe, "age" => $request->age, "niveau_scolaire_id" => $request->niveauScolaire]);
            if ($request->hasFile("photo")) {
                $photo = $request->photo;
                $fileName = $photo->getClientOriginalName();
                $filePath = $photo->storeAs("photos", $fileName, "public");
                $etudiant->photo = $filePath;
                $etudiant->save();
            }

            DB::commit();

        } catch (Exception $e) {
            DB::rollback();
        }

        return redirect()->route('etudiant.index');
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
    public function edit(etudiant $etudiant)
    {
        $nivelScolaires = NiveauScolaire::all();

        return Inertia::render('Etudiant/edit', [
            'etudiant' => $etudiant,
            'niveauScolaires' => $nivelScolaires

        ]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, etudiant $etudiant)
    {
        $validatedData = $request->validate([
            "nom" => "required",
            "prenom" => "required",
            "sexe" => "required",
            "age" => "required",
            "niveauScolaire" => "required|",
        ]);
        try {
            DB::beginTransaction();

            $etudiant->update(["nom" => $request->nom, "prenom" => $request->prenom, "sexe" => $request->sexe, "age" => $request->age, "niveau_scolaire_id" => $request->niveauScolaire]);
            $etudiant->save();
            if ($request->hasFile("photo")) {
                $photo = $request->photo;
                $fileName = $photo->getClientOriginalName();
                $filePath = $photo->storeAs("photos", $fileName, "public");
                $etudiant->photo = $filePath;
                $etudiant->save();
            }

            DB::commit();

        } catch (Exception $e) {
            DB::rollback();
        }

        return redirect()->route('etudiant.index');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(etudiant $etudiant)
    {
        if ($etudiant->photo) {
            if (Storage::exists($etudiant->photo)) {
                Storage::delete($etudiant->photo);
            }
        }
        $etudiant->delete();
        return redirect()->back();
    }


}
