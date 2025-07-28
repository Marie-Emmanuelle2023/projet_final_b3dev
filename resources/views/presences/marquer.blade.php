<x-app-layout>
    <div class="max-w-4xl mx-auto py-8">
        <h1 class="text-2xl font-bold mb-6 text-indigo-800">Marquer la présence - {{ $seance->date }}/ {{$seance->module->nom}} / {{ $seance->classe->nom }}</h1>

        @if (session('success'))
            <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('presences.enregistrer', $seance->id) }}">
            @csrf

            <table class="w-full border border-gray-300">
                <thead class="bg-gray-100 text-left">
                    <tr>
                        <th class="border px-4 py-2">Nom</th>
                        <th class="border px-4 py-2">Prénom</th>
                        <th class="border px-4 py-2">Statut</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($etudiants as $etudiant)
                        <tr>
                            <td class="border px-4 py-2">{{ $etudiant->user->nom }}</td>
                            <td class="border px-4 py-2">{{ $etudiant->user->prenom }}</td>
                            <td class="border px-4 py-2">
                                <select name="presences[{{ $etudiant->id }}]" class="border px-2 py-1 rounded w-full">
                                    @foreach($statuts as $statut)
                                        <option value="{{ $statut->id }}"
                                            @if(isset($presences[$etudiant->id]) && $presences[$etudiant->id] == $statut->id) selected @endif>
                                            {{ $statut->libelle }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-6">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                    Enregistrer les présences
                </button>
                <a href="{{ route('seances.index') }}" class="ml-4 text-gray-600 hover:underline">Retour</a>
            </div>
        </form>
    </div>
</x-app-layout>
