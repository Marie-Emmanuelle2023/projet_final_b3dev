<x-app-layout>
    <div class="container mx-auto py-8">
        <h1 class="text-2xl font-bold mb-6">Détail de l'étudiant</h1>
        <div class="bg-white rounded shadow p-6">
            <p><span class="font-semibold">Nom :</span> {{ $etudiant->user->name ?? '' }}</p>
            <p><span class="font-semibold">Classe :</span> {{ $etudiant->classe->nom ?? '' }}</p>
        </div>
        <a href="{{ route('etudiants.index') }}" class="mt-4 inline-block px-4 py-2 bg-gray-300 rounded">Retour à la liste</a>
    </div>
</x-app-layout>
