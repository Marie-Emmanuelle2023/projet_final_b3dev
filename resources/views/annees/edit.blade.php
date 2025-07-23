<x-app-layout>
<div class="container mx-auto py-4">
    <h1 class="text-2xl font-bold mb-4">Modifier l'année</h1>
    <form action="{{ route('annees.update', $annee) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')
        <div>
            <label for="nom" class="block">Nom</label>
            <input type="text" name="nom" id="nom" class="border rounded w-full p-2" value="{{ old('nom', $annee->nom) }}">
            @error('nom')<div class="text-red-500 text-sm">{{ $message }}</div>@enderror
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Mettre à jour</button>
        <a href="{{ route('annees.index') }}" class="ml-2 text-gray-600">Annuler</a>
    </form>
</div>
</x-app-layout>
