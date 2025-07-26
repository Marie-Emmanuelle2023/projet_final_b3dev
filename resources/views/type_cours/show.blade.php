<x-app-layout>
    <div class="container mx-auto py-8">
        <h1 class="text-2xl font-bold mb-4">Détail du type de cours</h1>
        <div class="mb-3">
            <strong>ID :</strong> {{ $typeCours->id }}
        </div>
        <div class="mb-3">
            <strong>Nom :</strong> {{ $typeCours->nom }}
        </div>
        <a href="{{ route('type_cours.index') }}" class="btn btn-secondary">Retour à la liste</a>
        <a href="{{ route('type_cours.edit', $typeCours) }}" class="btn btn-warning">Modifier</a>
    </div>
</x-app-layout>
