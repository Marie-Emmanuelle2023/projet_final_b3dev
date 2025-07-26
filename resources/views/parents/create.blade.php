<x-app-layout>
    <div class="container mx-auto py-8">
        <h1 class="text-2xl font-bold mb-6">Ajouter un parent d'étudiant</h1>
        <form method="POST" action="{{ route('parents.store') }}" class="space-y-4">
            @csrf
            <div>
                <label for="parent_model_id" class="block font-semibold">Parent</label>
                <select name="parent_model_id" id="parent_model_id" class="w-full border rounded px-3 py-2" required>
                    <option value="">Sélectionner un parent</option>
                    @foreach($parents as $parent)
                        <option value="{{ $parent->id }}">{{ $parent->nom }} {{ $parent->prenom }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="etudiant_id" class="block font-semibold">Étudiant</label>
                <select name="etudiant_id" id="etudiant_id" class="w-full border rounded px-3 py-2" required>
                    <option value="">Sélectionner un étudiant</option>
                    @foreach($etudiants as $etudiant)
                        <option value="{{ $etudiant->id }}">{{ $etudiant->user->nom ?? '' }} {{ $etudiant->user->prenom ?? '' }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Enregistrer</button>
        </form>
    </div>
</x-app-layout>
