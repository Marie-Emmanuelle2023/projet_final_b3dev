
<x-app-layout>
    <div class="container mx-auto py-8">
        <h2 class="text-2xl font-bold mb-6 text-blue-700">Liste des affectations Professeur - Module</h2>
        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-2 mb-4 rounded">{{ session('success') }}</div>
        @endif
        <a href="{{ route('professeur_modules.create') }}" class="mb-4 inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Nouvelle affectation</a>
        <div class="overflow-x-auto shadow rounded-lg">
            <table class="min-w-full bg-white border border-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="py-2 px-4 border">ID</th>
                        <th class="py-2 px-4 border">Professeur</th>
                        <th class="py-2 px-4 border">Module</th>
                        <th class="py-2 px-4 border">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($professeurModules as $affectation)
                        <tr class="hover:bg-gray-50">
                            <td class="py-2 px-4 border">{{ $affectation->id }}</td>
                            <td class="py-2 px-4 border">
                                @php
                                    $nom = $affectation->professeur->user->nom ?? '';
                                    $prenom = $affectation->professeur->user->prenom ?? '';
                                    $nomComplet = trim($nom . ' ' . $prenom);
                                @endphp
                                <span class="font-semibold text-gray-800">{{ $nomComplet ?: 'Nom inconnu' }}</span>
                            </td>
                            <td class="py-2 px-4 border">{{ $affectation->module->nom ?? 'Nom inconnu' }}</td>
                            <td class="py-2 px-4 border flex gap-2">
                                <a href="{{ route('professeur_modules.show', $affectation) }}" class="px-2 py-1 bg-green-500 text-white rounded hover:bg-green-600">Voir</a>
                                <a href="{{ route('professeur_modules.edit', $affectation) }}" class="px-2 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600">Modifier</a>
                                <form action="{{ route('professeur_modules.destroy', $affectation) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-2 py-1 bg-red-600 text-white rounded hover:bg-red-700" onclick="return confirm('Confirmer la suppression ?')">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="py-4 px-4 text-center text-gray-500">Aucune affectation trouvée.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
