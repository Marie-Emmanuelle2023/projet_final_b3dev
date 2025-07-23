<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCoordinateurRequest;
use App\Http\Requests\UpdateCoordinateurRequest;
use App\Models\Coordinateur;

class CoordinateurController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $coordinateurs = Coordinateur::with('user')->get();
        return view('coordinateurs.index', compact('coordinateurs'));
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
    public function store(StoreCoordinateurRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Coordinateur $coordinateur)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Coordinateur $coordinateur)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCoordinateurRequest $request, Coordinateur $coordinateur)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Coordinateur $coordinateur)
    {
        //
    }
}
