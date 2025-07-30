<x-app-layout>
<div class="container mx-auto py-4">
    <h1 class="text-2xl font-bold mb-4">Ajouter une année</h1>

    @if ($errors->any())
        <div class="bg-red-100 text-red-800 p-2 mb-4 rounded">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('annees.store') }}" method="POST" class="space-y-4">
        @csrf
        <div>
            <label for="nom" class="block">Nom</label>
            <input type="text" name="nom" id="nom" class="border rounded w-full p-2" value="{{ old('nom') }}">
            @error('nom')<div class="text-red-500 text-sm">{{ $message }}</div>@enderror
        </div>
         <div>
            <label for="debut" class="block">Début</label>
            <input type="date" name="debut" id="debut" class="border rounded w-full p-2" value="{{ old('debut') }}">
            @error('debut')<div class="text-red-500 text-sm">{{ $message }}</div>@enderror
        </div>
        <div>
            <label for="fin" class="block">Fin</label>
            <input type="date" name="fin" id="fin" class="border rounded w-full p-2" value="{{ old('fin') }}">
            @error('fin')<div class="text-red-500 text-sm">{{ $message }}</div>@enderror
        </div>
        <div class="flex items-center">
            <input type="checkbox" name="en_cours" id="en_cours" value="1" @if(old('en_cours')) checked @endif>
            <label for="en_cours" class="ml-2">Année en cours</label>
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Enregistrer</button>
        <a href="{{ route('annees.index') }}" class="ml-2 text-gray-600">Annuler</a>
    </form>
</div>
</x-app-layout>
