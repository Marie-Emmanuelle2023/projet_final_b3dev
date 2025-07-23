<x-app-layout>
<div class="container mx-auto py-4">
    <h1 class="text-2xl font-bold mb-4">Détail de l'année</h1>
    <div class="mb-4">
        <strong>Nom :</strong> {{ $annee->nom }}
    </div>
    <a href="{{ route('annees.index') }}" class="text-blue-500">Retour à la liste</a>
</div>
</x-app-layout>
