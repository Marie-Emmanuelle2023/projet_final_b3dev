<x-app-layout>
    <div class="container mx-auto py-8">
        <h1 class="text-2xl font-bold mb-4">Emploi du temps</h1>

        <form method="GET" action="{{ route('parent.emploi') }}" class="mb-6">
            <label for="etudiant_id" class="block mb-2">Choisir un enfant :</label>
            <select name="etudiant_id" id="etudiant_id" onchange="this.form.submit()" class="p-2 border rounded">
                @foreach ($enfants as $enfant)
                    <option value="{{ $enfant->id }}" {{ $selectedChildId == $enfant->id ? 'selected' : '' }}>
                        {{ $enfant->user->prenom }} {{ $enfant->user->nom }}
                    </option>
                @endforeach
            </select>
        </form>

        @if ($seances->isEmpty())
            <p class="text-gray-500">Aucune séance prévue pour cet enfant cette semaine.</p>
        @else
            <table class="table-auto w-full bg-white shadow rounded overflow-hidden">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="px-4 py-2">Date</th>
                        <th class="px-4 py-2">Heure</th>
                        <th class="px-4 py-2">Module</th>
                        <th class="px-4 py-2">Professeur</th>
                        <th class="px-4 py-2">Type</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($seances as $seance)
                        <tr class="border-b">
                            <td class="px-4 py-2">{{ \Carbon\Carbon::parse($seance->date)->format('d/m/Y') }}</td>
                            <td class="px-4 py-2">{{ $seance->heure_debut }} - {{ $seance->heure_fin }}</td>
                            <td class="px-4 py-2">{{ $seance->module->nom }}</td>
                            <td class="px-4 py-2">
                                {{ $seance->professeur->user->nom ?? '-' }} {{ $seance->professeur->user->prenom ?? '-' }}
                            </td>
                            <td class="px-4 py-2">{{ $seance->typeCours->libelle }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</x-app-layout>
