<x-app-layout>
<div class="container mx-auto py-4">
    <h1 class="text-2xl font-bold mb-4">Ajouter une année</h1>
    <form action="{{ route('annees.store') }}" method="POST" class="space-y-4">
        @csrf
        <div>
            <label for="nom" class="block">Nom</label>
            <input type="text" name="nom" id="nom" class="border rounded w-full p-2" value="{{ old('nom') }}">
            @error('nom')<div class="text-red-500 text-sm">{{ $message }}</div>@enderror
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Enregistrer</button>
        <a href="{{ route('annees.index') }}" class="ml-2 text-gray-600">Annuler</a>
    </form>
</div>
</x-app-layout>
