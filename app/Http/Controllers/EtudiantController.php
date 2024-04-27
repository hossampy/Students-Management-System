<?php

namespace App\Http\Controllers;

use App\Models\etudiant;
use Illuminate\Http\Request;
use Inertia\Inertia;

class EtudiantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Etudiant/index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Etudiant/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(etudiant $student)
    {
        //
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
