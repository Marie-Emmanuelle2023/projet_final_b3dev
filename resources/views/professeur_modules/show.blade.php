
<x-app-layout>
    <div class="max-w-lg mx-auto py-8">
        <h2 class="text-2xl font-bold mb-6 text-blue-700">Détail de l'affectation Professeur - Module</h2>
        <div class="bg-white rounded shadow p-6 mb-6">
            @php
                $nom = $professeurModule->professeur->user->nom ?? '';
                $prenom = $professeurModule->professeur->user->prenom ?? '';
                $nomComplet = trim($nom . ' ' . $prenom);
            @endphp
            <div class="mb-4">
                <span class="font-semibold text-gray-700">Professeur :</span>
                <span class="text-gray-900">{{ $nomComplet ?: 'Nom inconnu' }}</span>
            </div>
            <div class="mb-4">
                <span class="font-semibold text-gray-700">Module :</span>
                <span class="text-gray-900">{{ $professeurModule->module->nom ?? 'Nom inconnu' }}</span>
            </div>
        </div>
        <a href="{{ route('professeur_modules.index') }}" class="inline-block px-4 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400">Retour à la liste</a>
    </div>
</x-app-layout>
