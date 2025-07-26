<x-app-layout>
    <div class="container mx-auto py-8">
        <h1 class="text-2xl font-bold mb-4">Détail du coordinateur</h1>
        <div class="mb-3">
            <strong>ID :</strong> {{ $coordinateur->id }}
        </div>
        <div class="mb-3">
            <strong>Nom :</strong> {{ $coordinateur->user->nom ?? '' }}
        </div>
        <div class="mb-3">
            <strong>Prénom :</strong> {{ $coordinateur->user->prenom ?? '' }}
        </div>
        <div class="mb-3">
            <strong>Niveaux :</strong>
            <ul>
                @foreach($coordinateur->niveaux as $niveau)
                    <li>{{ $niveau->nom }}</li>
                @endforeach
            </ul>
        </div>
        <a href="{{ route('coordinateurs.index') }}" class="btn btn-secondary">Retour à la liste</a>
        <a href="{{ route('coordinateurs.edit', $coordinateur) }}" class="btn btn-warning">Modifier</a>
    </div>
</x-app-layout>
