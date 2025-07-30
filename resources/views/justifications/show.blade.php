<x-app-layout>
    <div class="container mx-auto py-8">
        <h1 class="text-2xl font-bold mb-6">Détail de la justification d'absence</h1>
        <div class="bg-white rounded shadow p-6">
            <p><span class="font-semibold">Étudiant :</span> {{ $justification->etudiant->user->nom ?? '' }} {{ $justification->etudiant->user->prenom ?? '' }}</p>
            <p><span class="font-semibold">Motif :</span> {{ $justification->motif }}</p>
            <p><span class="font-semibold">Preuve :</span> {{ $justification->preuve }}</p>
            <p><span class="font-semibold">Date :</span> {{ $justification->date }}</p>
        </div>
        <a href="{{ route('justifications.index') }}" class="mt-4 inline-block px-4 py-2 bg-gray-300 rounded">Retour à la liste</a>
        <a href="{{ route('justifications.edit', $justification) }}" class="ml-4 inline-block px-4 py-2 bg-yellow-500 text-white rounded">Modifier</a>
    </div>
</x-app-layout>
