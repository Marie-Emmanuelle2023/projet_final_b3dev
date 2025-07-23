<x-app-layout>
    <div class="max-w-4xl mx-auto mt-10 bg-white p-8 rounded shadow">
        <h2 class="text-2xl font-semibold mb-6">Liste des coordinateurs</h2>
        <table class="w-full table-auto border-collapse">
            <thead>
                <tr class="bg-gray-100 text-left">
                    <th class="border px-4 py-2">#</th>
                    <th class="border px-4 py-2">Photo</th>
                    <th class="border px-4 py-2">Nom</th>
                    <th class="border px-4 py-2">Prénom</th>
                    <th class="border px-4 py-2">Identifiant</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($coordinateurs as $coordinateur)
                    <tr>
                        <td class="border px-4 py-2">{{ $loop->iteration }}</td>
                        <td class="border px-4 py-2">
                            @if ($coordinateur->user->photo)
                                <img src="{{ asset('storage/' . $coordinateur->user->photo) }}" alt="Photo"
                                    class="w-10 h-10 rounded-full object-cover">
                            @else
                                <span class="text-gray-400 italic">Aucune</span>
                            @endif
                        </td>
                        <td class="border px-4 py-2">{{ $coordinateur->user->nom ?? '-' }}</td>
                        <td class="border px-4 py-2">{{ $coordinateur->user->prenom ?? '-' }}</td>
                        <td class="border px-4 py-2">{{ $coordinateur->user->identifiant ?? '-' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center py-4 text-gray-500">Aucun coordinateur trouvé.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <a href="{{ route('users.index') }}" class="bg-blue-600 text-white px-4 py-2 rounded mt-4 inline-block">Retour</a>
    </div>
</x-app-layout>
