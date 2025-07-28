<x-app-layout>
    <div class="max-w-xl mx-auto mt-10 bg-white p-6 rounded shadow">
        <h2 class="text-2xl font-semibold mb-4">Ajouter une classe</h2>

        @if ($errors->any())
            <div class="bg-red-100 text-red-800 p-2 mb-4 rounded">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('classes.store') }}">
            @csrf

            <div class="mb-4">
                <label for="nom" class="block">Nom</label>
                <input type="text" name="nom" id="nom" class="w-full border rounded px-3 py-2" required>
            </div>

            <div class="mb-4">
                <label for="niveau_id" class="block">Niveau</label>
                <select name="niveau_id" id="niveau_id" class="w-full border rounded px-3 py-2" required>
                    <option value="">-- Sélectionnez --</option>
                    @foreach($niveaux as $niveau)
                        <option value="{{ $niveau->id }}">{{ $niveau->nom }}</option>
                    @endforeach
                </select>
            </div>

            <button class="bg-blue-600 text-white px-6 py-2 rounded">Créer</button>
        </form>
    </div>
</x-app-layout>
