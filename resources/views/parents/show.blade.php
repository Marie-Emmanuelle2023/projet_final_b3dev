<x-app-layout>
    <div class="container mx-auto py-8">
        <h1 class="text-2xl font-bold mb-6">Détail du parent d'étudiant</h1>
        <div class="bg-white rounded shadow p-6">
            <p><span class="font-semibold">Parent :</span> {{ $parentEtudiant->parentModel->nom ?? '' }} {{ $parentEtudiant->parentModel->prenom ?? '' }}</p>
            <p><span class="font-semibold">Étudiant :</span> {{ $parentEtudiant->etudiant->user->nom ?? '' }} {{ $parentEtudiant->etudiant->user->prenom ?? '' }}</p>
        </div>
        <a href="{{ route('parents.index') }}" class="mt-4 inline-block px-4 py-2 bg-gray-300 rounded">Retour à la liste</a>
    </div>
</x-app-layout>
