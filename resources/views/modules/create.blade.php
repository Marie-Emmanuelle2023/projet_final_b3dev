{{-- Vue : Formulaire pour ajouter un module (nom du module) --}}
<x-app-layout>
    <div class="max-w-md mx-auto mt-10 bg-white p-8 rounded shadow">
        <h2 class="text-2xl font-semibold mb-6">Ajouter un module</h2>

        @if ($errors->any())
            <div class="bg-red-100 text-red-800 p-2 mb-4 rounded">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('modules.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="nom" class="block text-gray-700">Nom du module</label>
                <input type="text" name="nom" id="nom" value="{{ old('nom') }}" class="w-full border rounded px-3 py-2 mt-1" required>
                @error('nom')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Enregistrer</button>
            <a href="{{ route('modules.index') }}" class="ml-2 text-gray-600">Annuler</a>
        </form>
    </div>
</x-app-layout>
