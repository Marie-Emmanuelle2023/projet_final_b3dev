<x-app-layout>
    <h2 class="text-2xl text-gray-200 font-semibold mt-6 text-center">Liste des emplois du temps</h2>

    <div class="container mx-auto p-4">

        {{-- Filtrage par classe --}}
        @if (Auth::user()->role->libelle === 'coordinateur')
            <form method="GET" class="mb-6">
                <label for="classe_id" class="block text-sm font-medium text-gray-200 mb-1">Filtrer par classe :</label>
                <select name="classe_id" id="classe_id"
                    class="border border-gray-300 rounded-md shadow-sm px-3 py-2 w-64">
                    <option value="">-- Toutes les classes --</option>
                    @foreach ($classes as $classe)
                        <option value="{{ $classe->id }}" {{ $classeId == $classe->id ? 'selected' : '' }}>
                            {{ $classe->nom }}
                        </option>
                    @endforeach
                </select>
                <button type="submit"
                    class="ml-2 bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 transition">
                    Filtrer
                </button>
            </form>
        @endif

        {{-- Tableau des séances --}}
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg bg-white">
            <table class="w-full text-sm text-left text-gray-700">
                <thead class="text-xs uppercase bg-gray-100 text-gray-700">
                    <tr>
                        <th class="px-6 py-3">Jour</th>
                        <th class="px-6 py-3">Heure</th>
                        <th class="px-6 py-3">Classe</th>
                        <th class="px-6 py-3">Module</th>
                        <th class="px-6 py-3">Professeur</th>
                        <th class="px-6 py-3">Type de cours</th>
                        <th class="px-6 py-3">Salle</th>
                        <th class="px-6 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($emplois as $emploi)
                        @foreach ($emploi->seances as $seance)
                            <tr class="bg-white border-b hover:bg-gray-50">
                                <td class="px-6 py-4">
                                    {{ \Carbon\Carbon::parse($seance->date)->locale('fr')->isoFormat('dddd D MMMM YYYY') }}
                                </td>
                                <td class="px-6 py-4">{{ \Carbon\Carbon::parse($seance->date)->format('H:i') }}</td>
                                <td class="px-6 py-4">{{ $emploi->classe->nom }}</td>
                                <td class="px-6 py-4">{{ $seance->module->nom }}</td>
                                <td class="px-6 py-4">{{ $seance->professeur->user->nom ?? '-' }}
                                    {{ $seance->professeur->user->prenom ?? '-' }}</td>
                                <td class="px-6 py-4">{{ $seance->typeCours->nom }}</td>
                                <td class="px-6 py-4">{{ $seance->salle }}</td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('seances.show', $seance->id) }}"
                                        class="text-blue-600 hover:underline">Voir</a>
                                    <a href="{{ route('seances.edit', $seance->id) }}"
                                        class="text-blue-600 hover:underline">Modifier</a>
                                    <button data-modal-target="emploi-modal-{{ $emploi->id }}"
                                        data-modal-toggle="emploi-modal-{{ $emploi->id }}"
                                        class="btn text-red-500 btn-sm" type="button">Supprimer</button>
                                    <!-- Flowbite Modal -->
                                    <div id="emploi-modal-{{ $emploi->id }}" tabindex="-1"
                                        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                        <div class="relative p-4 w-full max-w-md max-h-full">
                                            <div class="relative bg-white rounded-lg shadow-sm">
                                                <button type="button"
                                                    class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                                                    data-modal-hide="emploi-modal-{{ $emploi->id }}">
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
                                                    <svg class="mx-auto mb-4 text-gray-400 w-12 h-12"
                                                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                        fill="none" viewBox="0 0 20 20">
                                                        <path stroke="currentColor" stroke-linecap="round"
                                                            stroke-linejoin="round" stroke-width="2"
                                                            d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                                    </svg>
                                                    <h3 class="mb-5 text-lg font-normal text-gray-500">Voulez-vous
                                                        vraiment
                                                        supprimer cet emploi du temps ?</h3>
                                                    <form
                                                        action="{{ route('emploi_du_temps.destroy', ['emploi_du_temp' => $emploi->id]) }}"
                                                        method="POST" class="inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button data-modal-hide="emploi-modal-{{ $emploi->id }}"
                                                            type="submit"
                                                            class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">Oui,
                                                            je confirme</button>
                                                    </form>
                                                    <button data-modal-hide="emploi-modal-{{ $emploi->id }}"
                                                        type="button"
                                                        class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100">Non,
                                                        annuler</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </td>
                            </tr>
                        @endforeach
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-4 text-center text-gray-500">Aucune séance trouvée.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="flex justify-between items-center mt-4">
            <div class= "flex justify-between items-center ">
                <a href="{{ route('dashboard') }}" class="bg-blue-600 text-white px-4 py-2 rounded mt-4">Retour au
                    dashboard</a>
            </div>
            <div>
                <a href="{{ route('emploi_du_temps.create') }}"
                    class="bg-blue-600 text-white px-4 py-2 rounded mb-4 inline-block">Ajouter un emploi du temps</a>
            </div>
        </div>
    </div>

</x-app-layout>
