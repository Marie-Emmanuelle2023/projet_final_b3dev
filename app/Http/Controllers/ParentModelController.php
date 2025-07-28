<?php

namespace App\Http\Controllers;
use App\Models\ParentModel;
use App\Models\User;
use Illuminate\Http\Request;

class ParentModelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $parentModels = ParentModel::with('user')->get();
        return view('parent_models.index', compact('parentModels'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        return view('parent_models.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);
        ParentModel::create($validated);
        return redirect()->route('parent_models.index')->with('success', "Parent ajouté avec succès.");
    }

    /**
     * Display the specified resource.
     */
    public function show(ParentModel $parentModel)
    {
        $parentModel->load('user');
        return view('parent_models.show', compact('parentModel'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ParentModel $parentModel)
    {
        $users = User::all();
        return view('parent_models.edit', compact('parentModel', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ParentModel $parentModel)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);
        $parentModel->update($validated);
        return redirect()->route('parent_models.index')->with('success', "Parent modifié avec succès.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ParentModel $parentModel)
    {
        $parentModel->delete();
        return redirect()->route('parent_models.index')->with('success', "Parent supprimé avec succès.");
    }
}
