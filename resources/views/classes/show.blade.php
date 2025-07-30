<x-app-layout>
    <div class="max-w-xl mx-auto mt-10 bg-white p-8 rounded shadow">
        <h2 class="text-2xl font-semibold mb-6">Détails de la classe</h2>
        <div class="mb-4">
            <strong>Nom :</strong> {{ $classe->nom }}
        </div>
        <div class="mb-4">
            <strong>Niveau :</strong> {{ $classe->niveau->nom ?? 'Aucun niveau' }}
        </div>
        <div class="mb-6">
            <strong>Étudiants :</strong>
            @if($classe->etudiants && $classe->etudiants->count())
                <table class="min-w-full bg-white border mt-2">
                    <thead>
                        <tr>
                            <th class="py-2 px-4 border">Nom</th>
                            <th class="py-2 px-4 border">Prénom</th>
                            <th class="py-2 px-4 border">Statut</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($classe->etudiants as $etudiant)
                            <tr>
                                <td class="py-2 px-4 border">{{ $etudiant->user->nom }}</td>
                                <td class="py-2 px-4 border">{{ $etudiant->user->prenom }}</td>
                                <td class="py-2 px-4 border">
                                    @if($etudiant->is_dropped)
                                        <span class="text-red-600 font-semibold">Éjecté</span>
                                    @else
                                        <span class="text-green-600 font-semibold">Actif</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="mt-2 text-gray-500">Aucun étudiant dans cette classe.</p>
            @endif
        </div>
        <a href="{{ route('classes.index') }}" class="bg-blue-600 text-white px-4 py-2 rounded">Retour</a>
        <a href="{{ route('classes.edit', $classe) }}" class="ml-4 bg-yellow-500 text-white px-4 py-2 rounded">Modifier</a>
    </div>
</x-app-layout>
