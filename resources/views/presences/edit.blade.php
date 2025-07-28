<x-app-layout>
    <div class="container mx-auto py-8">
        <h1 class="text-2xl font-bold mb-6">Modifier la présence</h1>

        @if ($errors->any())
            <div class="bg-red-100 text-red-800 p-2 mb-4 rounded">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('presences.update', $presence) }}" class="space-y-4">
            @csrf
            @method('PUT')
            <div>
                <label for="etudiant_id" class="block font-semibold">Étudiant</label>
                <select name="etudiant_id" id="etudiant_id" class="w-full border rounded px-3 py-2" required>
                    <option value="">Sélectionner un étudiant</option>
                    @foreach($etudiants as $etudiant)
                        <option value="{{ $etudiant->id }}" @if(old('etudiant_id', $presence->etudiant_id) == $etudiant->id) selected @endif>{{ $etudiant->user->nom ?? '' }} {{ $etudiant->user->prenom ?? '' }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="seance_id" class="block font-semibold">Séance</label>
                <select name="seance_id" id="seance_id" class="w-full border rounded px-3 py-2" required>
                    <option value="">Sélectionner une séance</option>
                    @foreach($seances as $seance)
                        <option value="{{ $seance->id }}" @if(old('seance_id', $presence->seance_id) == $seance->id) selected @endif>{{ $seance->date }} - {{ $seance->salle }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="statut_id" class="block font-semibold">Statut</label>
                <select name="statut_id" id="statut_id" class="w-full border rounded px-3 py-2" required>
                    <option value="">Sélectionner un statut</option>
                    @foreach($statuts as $statut)
                        <option value="{{ $statut->id }}" @if(old('statut_id', $presence->statut_id) == $statut->id) selected @endif>{{ $statut->libelle }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Mettre à jour</button>
        </form>
    </div>
</x-app-layout>
