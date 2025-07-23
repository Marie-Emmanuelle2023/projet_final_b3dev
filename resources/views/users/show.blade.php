<x-app-layout>
    <div class="max-w-xl mx-auto mt-10 bg-white p-8 rounded shadow">
        <h2 class="text-2xl font-semibold mb-6">Détails de l'utilisateur</h2>
        <div class="mb-4">
            <strong>Photo :</strong>
            @if ($user->photo)
                <img src="{{ asset('storage/' . $user->photo) }}" alt="Photo" class="w-24 h-24 rounded-full object-cover">
            @else
                <span class="text-gray-400 italic">Aucune</span>
            @endif
        </div>
        <div class="mb-4">
            <strong>Nom :</strong> {{ $user->nom }}
        </div>
        <div class="mb-4">
            <strong>Prénom :</strong> {{ $user->prenom }}
        </div>
        <div class="mb-4">
            <strong>Identifiant :</strong> {{ $user->identifiant }}
        </div>
        <div class="mb-4">
            <strong>Rôle :</strong> {{ $user->role->libelle ?? 'Aucun rôle' }}
        </div>

        <a href="{{ route('users.index') }}" class="bg-blue-600 text-white px-4 py-2 rounded">Retour</a>
    </div>
</x-app-layout>
