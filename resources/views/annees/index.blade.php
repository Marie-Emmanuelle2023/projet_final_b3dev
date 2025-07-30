<x-app-layout>
    <div class="flex min-h-screen bg-gray-100">
        <!-- Sidebar -->
        @include('components.navbar-admin')
        <main class="flex-1 p-8">
            <div class="container mx-auto py-4">
                <h1 class="text-2xl font-bold mb-4">Liste des années</h1>
                @if (session('success'))
                    <div class="bg-green-100 text-green-800 p-2 mb-4 rounded">{{ session('success') }}</div>
                @endif
                <a href="{{ route('annees.create') }}"
                    class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">Ajouter une année</a>
                <table class="min-w-full bg-white border">
                    <thead>
                        <tr>
                            <th class="py-2 px-4 border">Nom</th>
                            <th class="py-2 px-4 border">Début</th>
                            <th class="py-2 px-4 border">Fin</th>
                            <th class="py-2 px-4 border">En cours</th>
                            <th class="py-2 px-4 border">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($annees as $annee)
                            <tr>
                                <td class="py-2 px-4 border">{{ $annee->nom }}</td>
                                <td class="py-2 px-4 border">{{ $annee->debut }}</td>
                                <td class="py-2 px-4 border">{{ $annee->fin }}</td>
                                <td class="py-2 px-4 border">
                                    @if ($annee->en_cours)
                                        <span class="text-green-600 font-bold">Oui</span>
                                    @else
                                        Non
                                    @endif
                                </td>
                                <td class="py-2 px-4 border flex gap-2">
                                    <a href="{{ route('annees.edit', $annee) }}"
                                        class="bg-yellow-400 text-white px-2 py-1 rounded">Modifier</a>
                                    <button data-modal-target="modal-{{ $annee->id }}"
                                        data-modal-toggle="modal-{{ $annee->id }}"
                                        class="bg-red-500 text-white px-2 py-1 rounded"
                                        type="button">Supprimer</button>
                                    <!-- Modal Flowbite Suppression -->
                                    <div id="modal-{{ $annee->id }}" tabindex="-1"
                                        class="hidden fixed top-0 left-0 right-0 z-50 w-full p-4 overflow-x-hidden overflow-y-auto h-[calc(100%)] bg-black bg-opacity-50 items-center justify-center">
                                        <div class="bg-white rounded-lg shadow p-6 w-full max-w-md">
                                            <h3 class="mb-4 text-lg font-semibold">Confirmer la suppression</h3>
                                            <p class="mb-6">Voulez-vous vraiment supprimer cette année ?</p>
                                            <form method="POST" action="{{ route('annees.destroy', $annee) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="px-4 py-2 bg-red-600 text-white rounded mr-2">Supprimer</button>
                                                <button type="button" data-modal-hide="modal-{{ $annee->id }}"
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
