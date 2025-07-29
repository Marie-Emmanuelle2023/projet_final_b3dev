
<x-app-layout>
    <div class="max-w-lg mx-auto py-8">
        <h2 class="text-2xl font-bold mb-6 text-blue-700">Nouvelle affectation Professeur - Module</h2>
        <form action="{{ route('professeur_modules.store') }}" method="POST" class="space-y-6 bg-white p-6 rounded shadow">
            @csrf
            <div>
                <label for="professeur_id" class="block font-semibold mb-2">Professeur</label>
                <select name="professeur_id" id="professeur_id" class="w-full border rounded px-3 py-2" required>
                    <option value="">Sélectionner un professeur</option>
                    @foreach($professeurs as $professeur)
                        <option value="{{ $professeur->id }}">
                            @php
                                $nom = $professeur->user->nom ?? '';
                                $prenom = $professeur->user->prenom ?? '';
                                $nomComplet = trim($nom . ' ' . $prenom);
                            @endphp
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
                        <option value="{{ $module->id }}">{{ $module->nom }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Affecter</button>
        </form>
    </div>
</x-app-layout>
