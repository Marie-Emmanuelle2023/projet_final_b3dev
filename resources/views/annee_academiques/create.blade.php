<x-app-layout>
<div class="container mx-auto py-4">
    <h1 class="text-2xl font-bold mb-4">Ajouter une année académique</h1>

    @if ($errors->any())
        <div class="bg-red-100 text-red-800 p-2 mb-4 rounded">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('annee_academiques.store') }}" method="POST" class="space-y-4">
        @csrf
        <div>
            <label for="nom" class="block">Nom</label>
            <input type="text" name="nom" id="nom" class="border rounded w-full p-2" value="{{ old('nom') }}">
            @error('nom')<div class="text-red-500 text-sm">{{ $message }}</div>@enderror
        </div>
        <div>
            <label for="annee_id" class="block">Année</label>
            <select name="annee_id" id="annee_id" class="border rounded w-full p-2">
                <option value="">Sélectionner</option>
                @foreach($annees as $annee)
                    <option value="{{ $annee->id }}" @if(old('annee_id') == $annee->id) selected @endif>{{ $annee->nom }}</option>
                @endforeach
            </select>
            @error('annee_id')<div class="text-red-500 text-sm">{{ $message }}</div>@enderror
        </div>
        <div>
            <label for="classe_id" class="block">Classe</label>
            <select name="classe_id" id="classe_id" class="border rounded w-full p-2">
                <option value="">Sélectionner</option>
                @foreach($classes as $classe)
                    <option value="{{ $classe->id }}" @if(old('classe_id') == $classe->id) selected @endif>{{ $classe->nom }}</option>
                @endforeach
            </select>
            @error('classe_id')<div class="text-red-500 text-sm">{{ $message }}</div>@enderror
        </div>
       
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Enregistrer</button>
        <a href="{{ route('annee_academiques.index') }}" class="ml-2 text-gray-600">Annuler</a>
    </form>
</div>
</x-app-layout>
