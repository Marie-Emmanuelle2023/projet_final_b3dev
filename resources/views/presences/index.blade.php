<x-app-layout>
    <div class="flex min-h-screen bg-gray-100">
        <!-- Sidebar -->
        @include('components.navbar-coordi')
        <main class="flex-1 p-8">
            <div class="container mx-auto py-8">
                <h1 class="text-2xl font-bold mb-6">Liste des présences</h1>
                <a href="{{ route('presences.create') }}"
                    class="mb-4 inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Ajouter une
                    présence</a>
                <table class="min-w-full bg-white border">
                    <thead>
                        <tr>
                            <th class="py-2 px-4 border">Étudiant</th>
                            <th class="py-2 px-4 border">Séance</th>
                            <th class="py-2 px-4 border">Statut</th>
                            <th class="py-2 px-4 border">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($presences as $presence)
                            <tr>
                                <td class="py-2 px-4 border">{{ $presence->etudiant->user->nom ?? '' }}
                                    {{ $presence->etudiant->user->prenom ?? '' }}</td>
                                <td class="py-2 px-4 border"> {{ $presence->seance->module->nom ?? '-' }}
                                    {{ $presence->seance->date ?? '' }}</td>
                                <td class="py-2 px-4 border">{{ $presence->statut->libelle ?? '' }}</td>
                                <td class="py-2 px-4 border flex gap-2">
                                    <a href="{{ route('presences.show', $presence) }}"
                                        class="px-2 py-1  text-blue-600 rounded">Voir</a>
                                    <a href="{{ route('presences.edit', $presence) }}"
                                        class="px-2 py-1  text-blue-600 rounded">Modifier</a>
                                    <!-- Modal Flowbite Suppression -->
                                    <button data-modal-target="modal-{{ $presence->id }}"
                                        data-modal-toggle="modal-{{ $presence->id }}"
                                        class="px-2 py-1  text-red-600 rounded">Supprimer</button>
                                    <div id="modal-{{ $presence->id }}" tabindex="-1"
                                        class="hidden fixed top-0 left-0 right-0 z-50 w-full p-4 overflow-x-hidden overflow-y-auto h-[calc(100%)] bg-black bg-opacity-50 items-center justify-center">
                                        <div class="bg-white rounded-lg shadow p-6 w-full max-w-md">
                                            <h3 class="mb-4 text-lg font-semibold">Confirmer la suppression</h3>
                                            <p class="mb-6">Voulez-vous vraiment supprimer cette présence ?</p>
                                            <form method="POST" action="{{ route('presences.destroy', $presence) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="px-4 py-2 bg-red-600 text-white rounded mr-2">Supprimer</button>
                                                <button type="button" data-modal-hide="modal-{{ $presence->id }}"
                                                    class="px-4 py-2 bg-gray-300 rounded">Annuler</button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class= "flex justify-between items-center ">
                    <a href="{{ route('dashboard') }}" class="bg-blue-600 text-white px-4 py-2 rounded mt-4">Retour au
                        dashboard</a>
                </div>
            </div>
        </main>
    </div>
</x-app-layout>
