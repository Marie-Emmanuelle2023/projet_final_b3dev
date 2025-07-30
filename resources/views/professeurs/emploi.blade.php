<x-app-layout>
    <div class="flex min-h-screen bg-gray-100">
        @include('components.navbar-prof')
        <main class="flex-1 p-8">
            <div class="container mx-auto py-8">
                <h1 class="text-2xl font-bold mb-6">Mon emploi du temps de la semaine</h1>

                @if ($seances->isEmpty())
                    <p class="text-gray-600">Aucune séance prévue cette semaine.</p>
                @else
                    <table class="min-w-full bg-white shadow rounded">
                        <thead>
                            <tr>
                                <th class="px-4 py-2">Jour</th>
                                <th class="px-4 py-2">Heure</th>
                                <th class="px-4 py-2">Module</th>
                                <th class="px-4 py-2">Classe</th>
                                <th class="px-4 py-2">Type de cours</th>
                                <th class="px-4 py-2">Salle</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($seances as $seance)
                                <tr class="border-t">
                                    <td class="px-4 py-2">
                                        {{ \Carbon\Carbon::parse($seance->date)->translatedFormat('l d F') }}</td>
                                    <td class="px-4 py-2">{{ \Carbon\Carbon::parse($seance->date)->format('H:i') }}</td>
                                    <td class="px-4 py-2">{{ $seance->module->nom }}</td>
                                    <td class="px-4 py-2">{{ $seance->classe->nom }}</td>
                                    <td class="px-4 py-2">{{ $seance->typeCours->libelle }}</td>
                                    <td class="px-4 py-2">{{ $seance->salle }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
            <div class="mt-6">
                <a href="{{ route('professeur.dashboard') }}"
                    class="inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Retour au tableau de
                    bord</a>
            </div>
        </main>
    </div>

</x-app-layout>
