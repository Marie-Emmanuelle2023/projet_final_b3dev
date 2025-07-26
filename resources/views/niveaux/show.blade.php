<x-app-layout>
    <div class="max-w-md mx-auto mt-10 bg-white p-8 rounded shadow">
        <h2 class="text-2xl font-semibold mb-6">Détail du niveau</h2>
        <div class="mb-4">
            <strong>Nom :</strong> {{ $niveau->nom }}
        </div>
        <a href="{{ route('niveaux.index') }}" class="bg-blue-600 text-white px-4 py-2 rounded">Retour à la liste</a>
        <a href="{{ route('niveaux.edit', $niveau) }}" class="ml-2 bg-yellow-500 text-white px-4 py-2 rounded">Modifier</a>
    </div>
</x-app-layout>
