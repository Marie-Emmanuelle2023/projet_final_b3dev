<x-app-layout>
    <div class="container mx-auto py-8">
        <h1 class="text-2xl font-bold mb-6">Détail du parent</h1>
        <div class="bg-white rounded shadow p-6">
            <p><span class="font-semibold">Nom :</span> {{ $parentModel->user->nom ?? '' }}</p>
            <p><span class="font-semibold">Prénom :</span> {{ $parentModel->user->prenom ?? '' }}</p>
        </div>
        <a href="{{ route('parent_models.index') }}" class="mt-4 inline-block px-4 py-2 bg-gray-300 rounded">Retour à la liste</a>
    </div>
</x-app-layout>
