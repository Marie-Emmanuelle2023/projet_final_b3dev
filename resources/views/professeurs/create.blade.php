<x-app-layout>
    <div class="max-w-md mx-auto mt-10 bg-white p-8 rounded shadow">
        <h2 class="text-2xl font-semibold mb-6">Ajouter un professeur</h2>

        @if ($errors->any())
            <div class="bg-red-100 text-red-800 p-2 mb-4 rounded">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('professeurs.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="user_id" class="block text-gray-700">Utilisateur</label>
                <select name="user_id" id="user_id" class="w-full border rounded px-3 py-2 mt-1" required>
                    <option value="">Sélectionner un utilisateur</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>{{ $user->nom }} {{ $user->prenom }} ({{ $user->identifiant }})</option>
                    @endforeach
                </select>
                @error('user_id')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Enregistrer</button>
            <a href="{{ route('professeurs.index') }}" class="ml-2 text-gray-600">Annuler</a>
        </form>
    </div>
</x-app-layout>
