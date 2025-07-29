<x-app-layout>
    <div class="container mx-auto py-8">
        <h1 class="text-2xl font-bold mb-6">Présence pour {{ $seance->module->nom }} - {{ $seance->classe->nom }}</h1>

        <form method="POST" action="{{ route('professeurs.enregistrer', $seance) }}">
            @csrf
            <table class="w-full table-auto mb-4">
                <thead>
                    <tr>
                        <th class="px-4 py-2">Nom de l’étudiant</th>
                        <th class="px-4 py-2">Statut</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($etudiants as $etudiant)
                        <tr>
                            <td class="border px-4 py-2">{{ $etudiant->nom }} {{ $etudiant->prenom }}</td>
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

            <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">Enregistrer</button>
        </form>
    </div>
</x-app-layout>
