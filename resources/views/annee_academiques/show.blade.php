<x-app-layout>
<div class="container mx-auto py-4">
    <h1 class="text-2xl font-bold mb-4">Détail de l'année académique</h1>
    <div class="mb-2"><strong>Nom :</strong> {{ $anneeAcademique->nom }}</div>
    <div class="mb-2"><strong>Année :</strong> {{ $anneeAcademique->annee->nom ?? '' }}</div>
    <div class="mb-2"><strong>Classe :</strong> {{ $anneeAcademique->classe->nom ?? '' }}</div>
    <a href="{{ route('annee_academiques.index') }}" class="text-blue-500">Retour à la liste</a>
</div>
</x-app-layout>
