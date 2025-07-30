<x-app-layout>
    <div class="flex min-h-screen bg-gray-100">
        
        <main class="flex-1 p-8">
            <div class="max-w-4xl mx-auto mt-10 bg-white p-8 rounded shadow">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-semibold">Liste des classes</h2>
                    <a href="{{ route('classes.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">+ Ajouter une
                        classe</a>
                </div>
                @if (session('success'))
                    <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                        {{ session('success') }}
                    </div>
                @endif
                <table class="w-full table-auto border-collapse">
                    <thead>
                        <tr class="bg-gray-100 text-left">
                            <th class="border px-4 py-2">#</th>
                            <th class="border px-4 py-2">Nom</th>
                            <th class="border px-4 py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($classes as $classe)
                            <tr>
                                <td class="border px-4 py-2">{{ $loop->iteration }}</td>
                                <td class="border px-4 py-2">
                                    {{ $classe->nom }}
                                    <span class="text-xs text-gray-500 block">Niveau :
                                        {{ $classe->niveau->nom ?? '-' }}</span>
                                </td>
                                <td class="border px-4 py-2 flex gap-2">
                                    <a href="{{ route('classes.show', $classe) }}"
                                        class="text-blue-600 hover:underline">Voir</a>
                                    <a href="{{ route('classes.edit', $classe) }}"
                                        class="text-blue-600 hover:underline">Modifier</a>
                                    <button data-modal-target="popup-modal-{{ $classe->id }}"
                                        data-modal-toggle="popup-modal-{{ $classe->id }}"
                                        class="text-red-600 hover:underline" type="button">
                                        Supprimer
                                    </button>
                                    <!-- Flowbite Modal pour confirmer la supression d'une classe -->
                                    <div id="popup-modal-{{ $classe->id }}" tabindex="-1"
                                        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                        <div class="relative p-4 w-full max-w-md max-h-full">
                                            <div class="relative bg-white rounded-lg shadow-sm">
                                                <button type="button"
                                                    class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                                                    data-modal-hide="popup-modal-{{ $classe->id }}">
                                                    <svg class="w-3 h-3" aria-hidden="true"
                                                        xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 14 14">
                                                        <path stroke="currentColor" stroke-linecap="round"
                                                            stroke-linejoin="round" stroke-width="2"
                                                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                    </svg>
                                                    <span class="sr-only">Fermer</span>
                                                </button>
                                                <div class="p-4 md:p-5 text-center">
                                                    <svg class="mx-auto mb-4 text-gray-400 w-12 h-12" aria-hidden="true"
                                                        xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 20 20">
                                                        <path stroke="currentColor" stroke-linecap="round"
                                                            stroke-linejoin="round" stroke-width="2"
                                                            d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                                    </svg>
                                                    <h3 class="mb-5 text-lg font-normal text-gray-500">Voulez-vous
                                                        vraiment
                                                        supprimer la classe <span
                                                            class="font-bold">{{ $classe->nom }}</span>
                                                        ?</h3>
                                                    <form action="{{ route('classes.destroy', $classe) }}"
                                                        method="POST" class="inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button data-modal-hide="popup-modal-{{ $classe->id }}"
                                                            type="submit"
                                                            class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                                            Oui, je confirme
                                                        </button>
                                                    </form>
                                                    <button data-modal-hide="popup-modal-{{ $classe->id }}"
                                                        type="button"
                                                        class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100">Non,
                                                        annuler</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center py-4 text-gray-500">Aucune classe trouvée.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class= "flex justify-between items-center ">
                    <a href="{{ route('dashboard') }}" class="bg-blue-600 text-white px-4 py-2 rounded mt-4">Retour au
                        dashboard</a>
                </div>
            </div>
        </main>
    </div>
    <script>
        function openModal(id) {
            document.getElementById('modal-' + id).classList.remove('hidden');
        }

        function closeModal(id) {
            document.getElementById('modal-' + id).classList.add('hidden');
        }
    </script>
</x-app-layout>
