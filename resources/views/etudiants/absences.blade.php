<x-app-layout>
    <div class="container mx-auto py-8">
        <h1 class="text-2xl font-bold mb-6">Mes absences</h1>

        @if ($absences->isEmpty())
            <p class="text-gray-600">Aucune absence enregistrée pour le moment.</p>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach ($absences as $absence)
                    <div class="bg-white p-4 shadow rounded">
                        <h2 class="text-lg font-semibold text-gray-800">
                            {{ $absence->seance->module->nom }} — {{ $absence->seance->classe->nom }}
                        </h2>
                        <p class="text-sm text-gray-600">
                            {{ \Carbon\Carbon::parse($absence->seance->date)->translatedFormat('l d F Y') }} à {{ $absence->seance->heure_debut }}
                        </p>
                        <p class="text-sm text-red-600 mt-1 font-semibold">Absent</p>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
     <div class="mt-6">
            <a href="{{ route('dashboard') }}" class="inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Retour au tableau de bord</a>
        </div>
</x-app-layout>
