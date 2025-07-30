{{-- Vue : Liste des affectations coordinateur / niveau --}}
{{-- Affiche chaque niveau avec ses coordinateurs, possibilité de retirer ou d'affecter --}}
<x-app-layout>
    <div class="container mx-auto py-8 px-4">
        <h1 class="text-2xl font-bold mb-6">Affectations Coordinateur / Niveau</h1>
        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
        @endif
        <div class="mb-4">
            <a href="{{ route('coordinateur_niveau.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">+ Nouvelle affectation</a>
        </div>
        <table class="w-full table-auto border-collapse">
            <thead>
                <tr class="bg-gray-100 text-left">
                    <th class="border px-4 py-2">Niveau</th>
                    <th class="border px-4 py-2">Coordinateurs affectés</th>
                    <th class="border px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($niveaux as $niveau)
                    <tr>
                        <td class="border px-4 py-2 font-semibold">{{ $niveau->nom }}</td>
                        <td class="border px-4 py-2">
                            @forelse($niveau->coordinateurs as $coord)
                                <div class="flex items-center gap-2 mb-1">
                                    <span>{{ $coord->user->prenom ?? '' }} {{ $coord->user->nom ?? '' }}</span>
                                    <form action="{{ route('coordinateur_niveau.destroy', $coord->id) }}" method="POST" onsubmit="return confirm('Retirer ce coordinateur ?');">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="coordinateur_id" value="{{ $coord->id }}">
                                        <input type="hidden" name="niveau_id" value="{{ $niveau->id }}">
                                        <button type="submit" class="text-red-600 hover:underline">Retirer</button>
                                    </form>
                                </div>
                            @empty
                                <span class="text-gray-400">Aucun coordinateur</span>
                            @endforelse
                        </td>
                        <td class="border px-4 py-2">
                            <a href="{{ route('coordinateur_niveau.create') }}" class="text-blue-600 hover:underline">Affecter</a>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="3" class="text-center py-4 text-gray-500">Aucun niveau trouvé.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-app-layout>
