<x-app-layout>
    <div class="container mx-auto py-8">
        <h1 class="text-2xl font-bold mb-6">Détail de la présence</h1>
        <div class="bg-white rounded shadow p-6">
            <p><span class="font-semibold">Étudiant :</span> {{ $presence->etudiant->user->nom ?? '' }} {{ $presence->etudiant->user->prenom ?? '' }}</p>
            <p><span class="font-semibold">Séance :</span> {{ $presence->seance->date ?? '' }}</p>
            <p><span class="font-semibold">Statut :</span> {{ $presence->statut->libelle ?? '' }}</p>
        </div>
        <a href="{{ route('presences.index') }}" class="mt-4 inline-block px-4 py-2 bg-gray-300 rounded">Retour à la liste</a>
    </div>
</x-app-layout>
