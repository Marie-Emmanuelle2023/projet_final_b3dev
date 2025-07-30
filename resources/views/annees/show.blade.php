<x-app-layout>
    <div class="container mx-auto py-4">
        <h1 class="text-2xl font-bold mb-4">Détail de l'année</h1>
        <div class="mb-4">
            <strong>Nom :</strong> {{ $annee->nom }}
            <div class="mb-2"><strong>Début :</strong> {{ $annee->debut }}</div>
            <div class="mb-2"><strong>Fin :</strong> {{ $annee->fin }}</div>
            <div class="mb-2"><strong>En cours :</strong>
                @if ($annee->en_cours)
                    Oui
                @else
                    Non
                @endif
            </div>
        </div>
        <a href="{{ route('annees.index') }}" class="text-blue-500">Retour à la liste</a>
    </div>
</x-app-layout>
