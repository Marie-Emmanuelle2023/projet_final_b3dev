{{-- Vue : Formulaire pour modifier une affectation coordinateur / niveau --}}
{{-- Permet de changer le coordinateur ou le niveau liés --}}
<x-app-layout>
    <div class="container mx-auto py-8 px-4">
        <h1 class="text-2xl font-bold mb-6">Modifier l'affectation</h1>
        <form method="POST" action="{{ route('coordinateur_niveau.update', $affectation->id) }}">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label class="block mb-1 font-medium">Coordinateur</label>
                <select name="coordinateur_id" class="border rounded p-2 w-full" required>
                    @foreach($coordinateurs as $c)
                        <option value="{{ $c->id }}" @if($affectation->coordinateur_id == $c->id) selected @endif>{{ $c->user->prenom ?? '' }} {{ $c->user->nom ?? '' }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label class="block mb-1 font-medium">Niveau</label>
                <select name="niveau_id" class="border rounded p-2 w-full" required>
                    @foreach($niveaux as $n)
                        <option value="{{ $n->id }}" @if($affectation->niveau_id == $n->id) selected @endif>{{ $n->nom }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Mettre à jour</button>
            <a href="{{ route('coordinateur_niveau.index') }}" class="ml-2 text-gray-600">Annuler</a>
        </form>
    </div>
</x-app-layout>
