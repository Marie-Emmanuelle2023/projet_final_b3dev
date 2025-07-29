<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with('role')->get();
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        $classes = Classe::all();
        return view('users.create', compact('roles', 'classes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'identifiant' => 'required|string|unique:users,identifiant',
            'password' => 'required|string|min:8',
            'role_id' => 'required|exists:roles,id',
            'photo' => 'nullable|image|max:2048',
        ]);

        // Vérification si rôle est étudiant, et validation du champ classe_id
        $roleEtudiant = Role::where('libelle', 'etudiant')->first();
        if ($roleEtudiant && $validated['role_id'] == $roleEtudiant->id) {
            $request->validate([
                'classe_id' => 'required|exists:classes,id'
            ]);
            $classeId = $request->input('classe_id');
        } else {
            $classeId = null;
        }

        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('photos', 'public');
        }

        $user = User::create([
            'nom' => $validated['nom'],
            'prenom' => $validated['prenom'],
            'identifiant' => $validated['identifiant'],
            'password' => Hash::make($validated['password']),
            'role_id' => $validated['role_id'],
            'photo' => $photoPath,
        ]);

        // Créer automatiquement les rôles
        $roleCoordinateur = Role::where('libelle', 'coordinateur')->first();
        if ($roleCoordinateur && $validated['role_id'] == $roleCoordinateur->id) {
            \App\Models\Coordinateur::create(['user_id' => $user->id]);
        }

        $roleProfesseur = Role::where('libelle', 'professeur')->first();
        if ($roleProfesseur && (int)$validated['role_id'] === (int)$roleProfesseur->id) {
            if (!\App\Models\Professeur::where('user_id', $user->id)->exists()) {
                \App\Models\Professeur::create(['user_id' => $user->id]);
            }
        }


        if ($roleEtudiant && $validated['role_id'] == $roleEtudiant->id && $classeId) {
            \App\Models\Etudiant::create([
                'user_id' => $user->id,
                'classe_id' => $classeId,
                'is_dropped' => false
            ]);
        }

        $roleParent = Role::where('libelle', 'parent')->first();
        if ($roleParent && $validated['role_id'] == $roleParent->id) {
            \App\Models\ParentModel::create(['user_id' => $user->id]);
        }

        return redirect()->route('users.index')->with('success', 'Utilisateur ajouté avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        return view('users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'identifiant' => 'required|string|unique:users,identifiant,' . $user->id,
            'password' => 'nullable|string|min:8',
            'role_id' => 'required|exists:roles,id',
            'photo' => 'nullable|image|max:2048',
        ]);

        // Mise à jour de la photo
        if ($request->hasFile('photo')) {
            if ($user->photo) {
                Storage::disk('public')->delete($user->photo);
            }
            $user->photo = $request->file('photo')->store('photos', 'public');
        }

        $user->update([
            'nom' => $validated['nom'],
            'prenom' => $validated['prenom'],
            'identifiant' => $validated['identifiant'],
            'role_id' => $validated['role_id'],
            'photo' => $user->photo ?? null,
        ]);
        if ($validated['password']) {
            $user->update(['password' => Hash::make($validated['password'])]);
        }

        return redirect()->route('users.index')->with('success', 'Utilisateur mis à jour.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        if ($user->photo) {
            Storage::disk('public')->delete($user->photo);
        }

        $user->delete();
        return redirect()->route('users.index')->with('success', 'Utilisateur supprimé.');
    }
}
