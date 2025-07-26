<x-app-layout>
    <div class="max-w-md mx-auto mt-10 bg-white p-8 rounded shadow">
        <h2 class="text-2xl font-semibold mb-6">Modifier l'emploi du temps</h2>
        <form action="{{ route('emploi_du_temps.update', $emploiDuTemps) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="classe_id" class="block text-gray-700">Classe</label>
                <select name="classe_id" id="classe_id" class="w-full border rounded px-3 py-2 mt-1" required>
                    <option value="">Sélectionner une classe</option>
                    @foreach($classes as $classe)
                        <option value="{{ $classe->id }}" {{ old('classe_id', $emploiDuTemps->classe_id) == $classe->id ? 'selected' : '' }}>{{ $classe->nom }}</option>
                    @endforeach
                </select>
                @error('classe_id')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Mettre à jour</button>
            <a href="{{ route('emploi_du_temps.index') }}" class="ml-2 text-gray-600">Annuler</a>
        </form>
    </div>
</x-app-layout>
