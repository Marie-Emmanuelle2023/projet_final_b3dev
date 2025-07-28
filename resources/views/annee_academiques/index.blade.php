<x-app-layout>
<div class="container mx-auto py-4">
    <h1 class="text-2xl font-bold mb-4">Liste des années académiques</h1>
    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-2 mb-4 rounded">{{ session('success') }}</div>
    @endif
    <a href="{{ route('annee_academiques.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">Ajouter une année académique</a>
    <table class="min-w-full bg-white border">
        <thead>
            <tr>
                <th class="py-2 px-4 border">Nom</th>
                <th class="py-2 px-4 border">Année</th>
                <th class="py-2 px-4 border">Classe</th>
                <th class="py-2 px-4 border">Début</th>
                <th class="py-2 px-4 border">Fin</th>
                <th class="py-2 px-4 border">En cours</th>
                <th class="py-2 px-4 border">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($anneesAcademiques as $aa)
            <tr>
                <td class="py-2 px-4 border">{{ $aa->nom }}</td>
                <td class="py-2 px-4 border">{{ $aa->annee->nom ?? '' }}</td>
                <td class="py-2 px-4 border">{{ $aa->classe->nom ?? '' }}</td>
                <td class="py-2 px-4 border">{{ $aa->debut }}</td>
                <td class="py-2 px-4 border">{{ $aa->fin }}</td>
                <td class="py-2 px-4 border">@if($aa->en_cours) <span class="text-green-600 font-bold">Oui</span> @else Non @endif</td>
                <td class="py-2 px-4 border flex gap-2">
                    <a href="{{ route('annee_academiques.edit', $aa) }}" class="bg-yellow-400 text-white px-2 py-1 rounded">Modifier</a>
                    <form action="{{ route('annee_academiques.destroy', $aa) }}" method="POST" onsubmit="return false;" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="button" onclick="openModal({{ $aa->id }})" class="bg-red-500 text-white px-2 py-1 rounded">Supprimer</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class= "flex justify-between items-center ">
            <a href="{{ route('dashboard') }}" class="bg-blue-600 text-white px-4 py-2 rounded mt-4">Retour au
                dashboard</a>
        </div>
    <!-- Modal de confirmation -->
    <div id="deleteModal" class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white p-6 rounded shadow">
            <p class="mb-4">Confirmer la suppression ?</p>
            <div class="flex justify-end gap-2">
                <button onclick="closeModal()" class="bg-gray-300 px-4 py-2 rounded">Annuler</button>
                <form id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded">Supprimer</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    let deleteUrl = '';
    function openModal(id) {
        deleteUrl = `{{ url('annee_academiques') }}/${id}`;
        document.getElementById('deleteForm').setAttribute('action', deleteUrl);
        document.getElementById('deleteModal').classList.remove('hidden');
    }
    function closeModal() {
        document.getElementById('deleteModal').classList.add('hidden');
    }
</script>
</x-app-layout>
