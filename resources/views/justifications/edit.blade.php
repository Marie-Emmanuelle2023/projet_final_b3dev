<x-app-layout>
    <div class="container mx-auto py-8">
        <h1 class="text-2xl font-bold mb-6">Modifier la justification d'absence</h1>

        @if ($errors->any())
            <div class="bg-red-100 text-red-800 p-2 mb-4 rounded">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('justifications.update', $justification) }}" class="space-y-4">
            @csrf
            @method('PUT')
            <div>
                <label for="etudiant_id" class="block font-semibold">Étudiant</label>
                <select name="etudiant_id" id="etudiant_id" class="w-full border rounded px-3 py-2" required>
                    <option value="">Sélectionner un étudiant</option>
                    @foreach($etudiants as $etudiant)
                        <option value="{{ $etudiant->id }}" @if(old('etudiant_id', $justification->etudiant_id) == $etudiant->id) selected @endif>{{ $etudiant->user->nom ?? '' }} {{ $etudiant->user->prenom ?? '' }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="motif" class="block font-semibold">Motif</label>
                <input type="text" name="motif" id="motif" value="{{ old('motif', $justification->motif) }}" class="w-full border rounded px-3 py-2" required>
            </div>
            <div>
                <label for="preuve" class="block font-semibold">Preuve (PDF ou image)</label>
                <input type="file" name="preuve" id="preuve" value="{{ old('preuve', $justification->preuve) }}" class="w-full border rounded px-3 py-2" accept="image/*,.pdf">
            </div>
            <div>
                <label for="date" class="block font-semibold">Date</label>
                <input type="date" name="date" id="date" value="{{ old('date', $justification->date) }}" class="w-full border rounded px-3 py-2" required>
            </div>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Mettre à jour</button>
        </form>
    </div>
</x-app-layout>
