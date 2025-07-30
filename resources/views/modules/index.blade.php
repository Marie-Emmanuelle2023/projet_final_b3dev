<x-app-layout>
    <div class="flex min-h-screen bg-gray-100">
        <main class="flex-1 p-8">
            <div class="max-w-4xl mx-auto mt-10 bg-white p-8 rounded shadow">
                <h2 class="text-2xl font-semibold mb-6">Liste des modules</h2>
                <a href="{{ route('modules.create') }}"
                    class="bg-blue-600 text-white px-4 py-2 rounded mb-4 inline-block">Ajouter
                    un module</a>
                <table class="w-full table-auto border-collapse">
                    <thead>
                        <tr class="bg-gray-100 text-left">
                            <th class="border px-4 py-2">#</th>
                            <th class="border px-4 py-2">Nom</th>
                            <th class="border px-4 py-2">Professeurs</th>
                            <th class="border px-4 py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($modules as $module)
                            <tr>
                                <td class="border px-4 py-2">{{ $loop->iteration }}</td>
                                <td class="border px-4 py-2">{{ $module->nom }}</td>
                                <td class="border px-4 py-2">
                                    @if ($module->professeurs && $module->professeurs->count())
                                        {{ $module->professeurs->map(function ($prof) {return ($prof->user->nom ?? '') . ' ' . ($prof->user->prenom ?? '');})->join(', ') }}
                                    @else
                                        <span class="text-gray-400 italic">Aucun</span>
                                    @endif
                                </td>
                                <td class="border px-4 py-2">
                                    <a href="{{ route('modules.show', $module) }}" class="btn btn-info btn-sm">Voir</a>
                                    <a href="{{ route('modules.edit', $module) }}"
                                        class="btn btn-warning btn-sm">Modifier</a>
                                    <button data-modal-target="module-modal-{{ $module->id }}"
                                        data-modal-toggle="module-modal-{{ $module->id }}"
                                        class="btn btn-danger btn-sm" type="button">Supprimer</button>
                                    <!-- Flowbite Modal -->
                                    <div id="module-modal-{{ $module->id }}" tabindex="-1"
                                        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                        <div class="relative p-4 w-full max-w-md max-h-full">
                                            <div class="relative bg-white rounded-lg shadow-sm">
                                                <button type="button"
                                                    class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                                                    data-modal-hide="module-modal-{{ $module->id }}">
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
                                                        supprimer le module <span
                                                            class="font-bold">{{ $module->nom }}</span>
                                                        ?</h3>
                                                    <form action="{{ route('modules.destroy', $module) }}"
                                                        method="POST" class="inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button data-modal-hide="module-modal-{{ $module->id }}"
                                                            type="submit"
                                                            class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">Oui,
                                                            je confirme</button>
                                                    </form>
                                                    <button data-modal-hide="module-modal-{{ $module->id }}"
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
                                <td colspan="3" class="text-center py-4 text-gray-500">Aucun module trouvé.</td>
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
</x-app-layout>
