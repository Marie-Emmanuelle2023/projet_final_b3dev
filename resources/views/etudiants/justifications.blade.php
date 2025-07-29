<x-app-layout>
    <div class="container mx-auto py-8">
        <h1 class="text-2xl font-bold mb-6">Mes justifications d’absence</h1>

        @if ($justifications->isEmpty())
            <p class="text-gray-600">Aucune justification soumise.</p>
        @else
            <table class="w-full table-auto bg-white rounded shadow">
                <thead>
                    <tr class="bg-gray-100 text-left">
                        <th class="px-4 py-2">Date de l’absence</th>
                        <th class="px-4 py-2">Module</th>
                        <th class="px-4 py-2">Statut</th>
                        <th class="px-4 py-2">Motif</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($justifications as $justification)
                        <tr class="border-b">
                            <td class="px-4 py-2">{{ \Carbon\Carbon::parse($justification->presence->seance->date)->format('d/m/Y') }}</td>
                            <td class="px-4 py-2">{{ $justification->presence->seance->module->nom }}</td>
                            <td class="px-4 py-2">{{ $justification->presence->statut->libelle }}</td>
                            <td class="px-4 py-2">{{ $justification->motif }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

        <div class="mt-6">
            <a href="{{ route('dashboard') }}" class="inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Retour au tableau de bord</a>
        </div>
    </div>
</x-app-layout>
