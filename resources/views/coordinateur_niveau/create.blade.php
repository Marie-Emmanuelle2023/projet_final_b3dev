{{-- Vue : Formulaire d'affectation d'un coordinateur à un niveau pour une année académique --}}
{{-- Sélection coordinateur, niveau, année académique --}}
<x-app-layout>
    <div class="container mx-auto py-8 px-4">
        <h1 class="text-2xl font-bold mb-6">Nouvelle affectation</h1>
        <form method="POST" action="{{ route('coordinateur_niveau.store') }}">
            @csrf
            <div class="mb-4">
                <label class="block mb-1 font-medium">Coordinateur</label>
                <select name="coordinateur_id" class="border rounded p-2 w-full" required>
                    <option value="">-- Choisir --</option>
                    @foreach($coordinateurs as $c)
                        <option value="{{ $c->id }}">{{ $c->user->prenom ?? '' }} {{ $c->user->nom ?? '' }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label class="block mb-1 font-medium">Niveau</label>
                <select name="niveau_id" class="border rounded p-2 w-full" required>
                    <option value="">-- Choisir --</option>
                    @foreach($niveaux as $n)
                        <option value="{{ $n->id }}">{{ $n->nom }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label class="block mb-1 font-medium">Année académique</label>
                <select name="annee_academique_id" class="border rounded p-2 w-full" required>
                    <option value="">-- Choisir --</option>
                    @foreach($annees as $a)
                        <option value="{{ $a->id }}">{{ $a->nom }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Enregistrer</button>
            <a href="{{ route('coordinateur_niveau.index') }}" class="ml-2 text-gray-600">Annuler</a>
        </form>
    </div>
</x-app-layout>
