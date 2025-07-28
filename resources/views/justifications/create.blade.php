<x-app-layout>
    <div class="container mx-auto py-8">
        <h1 class="text-2xl font-bold mb-6">Ajouter une justification d'absence</h1>

        @if ($errors->any())
            <div class="bg-red-100 text-red-800 p-2 mb-4 rounded">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('justifications.store') }}" class="space-y-4">
            @csrf
            <div>
                <label for="etudiant_id" class="block font-semibold">Étudiant</label>
                <select name="etudiant_id" id="etudiant_id" class="w-full border rounded px-3 py-2" required>
                    <option value="">Sélectionner un étudiant</option>
                    @foreach($etudiants as $etudiant)
                        <option value="{{ $etudiant->id }}">{{ $etudiant->user->nom ?? '' }} {{ $etudiant->user->prenom ?? '' }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="motif" class="block font-semibold">Motif</label>
                <input type="text" name="motif" id="motif" class="w-full border rounded px-3 py-2" required>
            </div>
            <div>
                <label for="preuve" class="block font-semibold">Preuve</label>
                <input type="text" name="preuve" id="preuve" class="w-full border rounded px-3 py-2">
            </div>
            <div>
                <label for="date" class="block font-semibold">Date</label>
                <input type="date" name="date" id="date" class="w-full border rounded px-3 py-2" required>
            </div>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Enregistrer</button>
        </form>
    </div>
</x-app-layout>
