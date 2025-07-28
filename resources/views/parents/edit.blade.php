<x-app-layout>
    <div class="container mx-auto py-8">
        <h1 class="text-2xl font-bold mb-6">Modifier le parent d'étudiant</h1>

        @if ($errors->any())
            <div class="bg-red-100 text-red-800 p-2 mb-4 rounded">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('parents.update', $parentEtudiant) }}" class="space-y-4">
            @csrf
            @method('PUT')
            <div>
                <label for="parent_model_id" class="block font-semibold">Parent</label>
                <select name="parent_model_id" id="parent_model_id" class="w-full border rounded px-3 py-2" required>
                    <option value="">Sélectionner un parent</option>
                    @foreach($parents as $parent)
                        <option value="{{ $parent->id }}" @if(old('parent_model_id', $parentEtudiant->parent_model_id) == $parent->id) selected @endif>{{ $parent->nom }} {{ $parent->prenom }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="etudiant_id" class="block font-semibold">Étudiant</label>
                <select name="etudiant_id" id="etudiant_id" class="w-full border rounded px-3 py-2" required>
                    <option value="">Sélectionner un étudiant</option>
                    @foreach($etudiants as $etudiant)
                        <option value="{{ $etudiant->id }}" @if(old('etudiant_id', $parentEtudiant->etudiant_id) == $etudiant->id) selected @endif>{{ $etudiant->user->nom ?? '' }} {{ $etudiant->user->prenom ?? '' }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Mettre à jour</button>
        </form>
    </div>
</x-app-layout>
