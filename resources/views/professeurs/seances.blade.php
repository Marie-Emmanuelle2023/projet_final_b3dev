<x-app-layout>
    <div class="container mx-auto py-8">
        <h1 class="text-2xl font-bold mb-6">Mes séances</h1>

        @if($seances->isEmpty())
            <p class="text-gray-600">Aucune séance trouvée.</p>
        @else
            <table class="min-w-full bg-white shadow rounded">
                <thead>
                    <tr>
                        <th class="px-4 py-2">Date</th>
                        <th class="px-4 py-2">Heure</th>
                        <th class="px-4 py-2">Module</th>
                        <th class="px-4 py-2">Classe</th>
                        <th class="px-4 py-2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($seances as $seance)
                        <tr class="border-t">
                            <td class="px-4 py-2">{{ \Carbon\Carbon::parse($seance->date)->translatedFormat('l d F') }}</td>
                            <td class="px-4 py-2">{{ \Carbon\Carbon::parse($seance->date)->format('H:i') }}</td>
                            <td class="px-4 py-2">{{ $seance->module->nom }}</td>
                            <td class="px-4 py-2">{{ $seance->classe->nom }}</td>
                            <td class="px-4 py-2">
                                <a href="{{ route('professeurs.marquer', $seance) }}"
                                   class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700">
                                    Marquer la présence
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
     <div class="mt-6">
        <a href="{{ route('professeur.dashboard') }}" class="inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Retour au tableau de bord</a>
    </div>

</x-app-layout>

