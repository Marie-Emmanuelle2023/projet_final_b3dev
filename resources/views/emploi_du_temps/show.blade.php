
<x-app-layout>
    <div class="max-w-3xl mx-auto mt-10 bg-white p-8 rounded shadow">
        <h2 class="text-2xl font-semibold mb-6">Détail de l'emploi du temps</h2>
        <div class="mb-4">
            <strong>Classe :</strong> {{ $emploiDuTemps->classe->nom ?? '-' }}
        </div>
        <h3 class="text-xl font-bold mt-8 mb-4 text-[#202149]">Séances associées</h3>
        <table class="w-full table-auto border-collapse mb-6">
            <thead>
                <tr class="bg-gray-100 text-left">
                    <th class="border px-4 py-2">Cours</th>
                    <th class="border px-4 py-2">Horaire</th>
                    <th class="border px-4 py-2">Salle</th>
                    <th class="border px-4 py-2">Professeur</th>
                </tr>
            </thead>
            <tbody>
                @forelse($emploiDuTemps->seances as $seance)
                    <tr>
                        <td class="border px-4 py-2 font-medium">
                            @if(!empty($seance->module))
                                {{ $seance->module->nom }}
                            @elseif(!empty($seance->typeCours))
                                {{ $seance->typeCours->libelle }}
                            @else
                                -
                            @endif
                        </td>
                        <td class="border px-4 py-2">{{ $seance->date }} {{ $seance->horaire ?? '' }}</td>
                        <td class="border px-4 py-2">{{ $seance->salle }}</td>
                        <td class="border px-4 py-2">{{ $seance->professeur->nom ?? '...' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center py-4 text-gray-500">Aucune séance prévue.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <a href="{{ route('emploi_du_temps.index') }}" class="bg-blue-600 text-white px-4 py-2 rounded">Retour à la liste</a>
        <a href="{{ route('emploi_du_temps.edit', $emploiDuTemps) }}" class="ml-2 bg-yellow-500 text-white px-4 py-2 rounded">Modifier</a>
    </div>
</x-app-layout>
