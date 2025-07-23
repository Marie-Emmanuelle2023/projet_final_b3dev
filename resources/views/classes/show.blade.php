<x-app-layout>
    <div class="max-w-xl mx-auto mt-10 bg-white p-8 rounded shadow">
        <h2 class="text-2xl font-semibold mb-6">Détails de la classe</h2>
        <div class="mb-4">
            <strong>Nom :</strong> {{ $classe->nom }}
        </div>
        <div class="mb-4">
            <strong>Niveau :</strong> {{ $classe->niveau->nom ?? 'Aucun niveau' }}
        </div>
        <a href="{{ route('classes.index') }}" class="bg-blue-600 text-white px-4 py-2 rounded">Retour</a>
    </div>
</x-app-layout>
