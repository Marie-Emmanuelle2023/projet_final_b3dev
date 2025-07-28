<x-app-layout>
    <div class="max-w-md mx-auto mt-10 bg-white p-8 rounded shadow">
        <h2 class="text-2xl font-semibold mb-6">Modifier une séance</h2>

        @if ($errors->any())
            <div class="bg-red-100 text-red-800 p-2 mb-4 rounded">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('seances.update', $seance) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="date" class="block text-gray-700">Date</label>
                <input type="datetime-local" name="date" id="date" class="w-full border rounded px-3 py-2 mt-1"
                    required value="{{ old('date', \Carbon\Carbon::parse($seance->date)->format('Y-m-d\TH:i')) }}">
                @error('date')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label for="salle" class="block text-gray-700">Salle</label>
                <input type="text" name="salle" id="salle" class="w-full border rounded px-3 py-2 mt-1"
                    required value="{{ old('salle', $seance->salle) }}">
                @error('salle')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label for="type_cours_id" class="block text-gray-700">Type de cours</label>
                <select name="type_cours_id" id="type_cours_id" class="w-full border rounded px-3 py-2 mt-1" required>
                    <option value="">Sélectionner un type</option>
                    @foreach ($typeCours as $type)
                        <option value="{{ $type->id }}"
                            {{ old('type_cours_id', $seance->type_cours_id) == $type->id ? 'selected' : '' }}>
                            {{ $type->nom }}</option>
                    @endforeach
                </select>
                @error('type_cours_id')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label for="classe_id" class="block text-gray-700">Classe</label>
                <select name="classe_id" id="classe_id" class="w-full border rounded px-3 py-2 mt-1" required>
                    <option value="">Sélectionner une classe</option>
                    @foreach ($classes as $classe)
                        <option value="{{ $classe->id }}"
                            {{ old('classe_id', $seance->classe_id) == $classe->id ? 'selected' : '' }}>
                            {{ $classe->nom }}</option>
                    @endforeach
                </select>
                @error('classe_id')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label for="emploi_du_temps_id" class="block text-gray-700">Emploi du temps</label>
                <select name="emploi_du_temps_id" id="emploi_du_temps_id" class="w-full border rounded px-3 py-2 mt-1"
                    required>
                    <option value="">Sélectionner</option>
                    @foreach ($emplois as $emploi)
                        <option value="{{ $emploi->id }}"
                            {{ old('emploi_du_temps_id', $seance->emploi_du_temps_id) == $emploi->id ? 'selected' : '' }}>
                            {{ $emploi->id }}</option>
                    @endforeach
                </select>
                @error('emploi_du_temps_id')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label for="module_id" class="block text-gray-700">Module</label>
                <select name="module_id" id="module_id" class="w-full border rounded px-3 py-2 mt-1">
                    <option value="">Sélectionner un module</option>
                    @foreach ($modules as $module)
                        <option value="{{ $module->id }}"
                            {{ old('module_id', $seance->module_id) == $module->id ? 'selected' : '' }}>
                            {{ $module->nom }}</option>
                    @endforeach
                </select>
                @error('module_id')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label for="professeur_id" class="block text-gray-700">Professeur</label>
                <select name="professeur_id" id="professeur_id" class="w-full border rounded px-3 py-2 mt-1">
                    <option value="">-- Choisir un professeur --</option>
                    @foreach ($professeurs as $professeur)
                        <option value="{{ $professeur->id }}"
                            {{ old('professeur_id', $seance->professeur_id ?? '') == $professeur->id ? 'selected' : '' }}>
                            {{ $professeur->user->nom }} {{ $professeur->user->prenom }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Enregistrer</button>
            <a href="{{ route('seances.index') }}" class="ml-2 text-gray-600">Annuler</a>
        </form>
    </div>
</x-app-layout>
