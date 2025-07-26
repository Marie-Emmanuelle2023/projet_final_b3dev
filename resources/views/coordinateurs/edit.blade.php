<x-app-layout>
    <div class="container mx-auto py-8">
        <h1 class="text-2xl font-bold mb-4">Modifier le coordinateur</h1>
        <form action="{{ route('coordinateurs.update', $coordinateur) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="user_id" class="form-label">Utilisateur (coordinateur)</label>
                <select name="user_id" id="user_id" class="form-control" required>
                    <option value="">Sélectionner un utilisateur</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ $coordinateur->user_id == $user->id ? 'selected' : '' }}>{{ $user->nom }} {{ $user->prenom }}</option>
                    @endforeach
                </select>
                @error('user_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="niveaux" class="form-label">Niveaux</label>
                <select name="niveaux[]" id="niveaux" class="form-control" multiple required>
                    @foreach($niveaux as $niveau)
                        <option value="{{ $niveau->id }}" {{ $coordinateur->niveaux->contains($niveau->id) ? 'selected' : '' }}>{{ $niveau->nom }}</option>
                    @endforeach
                </select>
                @error('niveaux')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="annee_academique_id" class="form-label">Année académique</label>
                <select name="annee_academique_id" id="annee_academique_id" class="form-control" required>
                    <option value="">Sélectionner une année</option>
                    @foreach($annees as $annee)
                        <option value="{{ $annee->id }}">{{ $annee->libelle }}</option>
                    @endforeach
                </select>
                @error('annee_academique_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-success">Mettre à jour</button>
            <a href="{{ route('coordinateurs.index') }}" class="btn btn-secondary">Annuler</a>
        </form>
    </div>
</x-app-layout>
