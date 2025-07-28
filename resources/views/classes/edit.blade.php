<x-app-layout>
    <div class="max-w-xl mx-auto mt-10 bg-white p-8 rounded shadow">
        <h2 class="text-2xl font-semibold mb-6">Modifier la classe</h2>
        @if ($errors->any())
            <div class="bg-red-100 text-red-800 p-2 mb-4 rounded">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="POST" action="{{ route('classes.update', $classe) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="nom" class="block text-gray-700">Nom de la classe</label>
                <input type="text" name="nom" id="nom" value="{{ old('nom', $classe->nom) }}" required class="w-full border rounded px-3 py-2">
            </div>
            <div class="mb-4">
                <label for="niveau_id" class="block text-gray-700">Niveau</label>
                <select name="niveau_id" id="niveau_id" required class="w-full border rounded px-3 py-2">
                    <option value="">-- Sélectionner --</option>
                    @foreach ($niveaux as $niveau)
                        <option value="{{ $niveau->id }}" {{ old('niveau_id', $classe->niveau_id) == $niveau->id ? 'selected' : '' }}>{{ $niveau->nom }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded">Modifier</button>
        </form>
    </div>
</x-app-layout>
