
<x-app-layout>
    <div class="max-w-lg mx-auto py-8">
        <h2 class="text-2xl font-bold mb-6 text-blue-700">Modifier l'affectation Professeur - Module</h2>
        <form action="{{ route('professeur_modules.update', $professeurModule) }}" method="POST" class="space-y-6 bg-white p-6 rounded shadow">
            @csrf
            @method('PUT')
            <div>
                <label for="professeur_id" class="block font-semibold mb-2">Professeur</label>
                <select name="professeur_id" id="professeur_id" class="w-full border rounded px-3 py-2" required>
                    <option value="">Sélectionner un professeur</option>
                    @foreach($professeurs as $professeur)
                        @php
                            $nom = $professeur->user->nom ?? '';
                            $prenom = $professeur->user->prenom ?? '';
                            $nomComplet = trim($nom . ' ' . $prenom);
                        @endphp
                        <option value="{{ $professeur->id }}" @if($professeurModule->professeur_id == $professeur->id) selected @endif>
                            {{ $nomComplet ?: 'Nom inconnu' }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="module_id" class="block font-semibold mb-2">Module</label>
                <select name="module_id" id="module_id" class="w-full border rounded px-3 py-2" required>
                    <option value="">Sélectionner un module</option>
                    @foreach($modules as $module)
                        <option value="{{ $module->id }}" @if($professeurModule->module_id == $module->id) selected @endif>{{ $module->nom }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Mettre à jour</button>
        </form>
        <a href="{{ route('professeur_modules.index') }}" class="inline-block mt-4 px-4 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400">Annuler</a>
    </div>
</x-app-layout>
