<x-app-layout>
    <div class="container mx-auto py-8">
        <h1 class="text-2xl font-bold mb-4">Modifier le type de cours</h1>
        <form action="{{ route('type_cours.update', $typeCours) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="nom" class="form-label">Nom</label>
                <input type="text" name="nom" id="nom" class="form-control" value="{{ old('nom', $typeCours->nom) }}" required>
                @error('nom')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-success">Mettre à jour</button>
            <a href="{{ route('type_cours.index') }}" class="btn btn-secondary">Annuler</a>
        </form>
    </div>
</x-app-layout>
