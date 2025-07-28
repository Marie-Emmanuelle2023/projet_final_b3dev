<x-app-layout>
    <div class="container mx-auto py-8">
        <h1 class="text-2xl font-bold mb-6">Modifier le parent</h1>

        @if ($errors->any())
            <div class="bg-red-100 text-red-800 p-2 mb-4 rounded">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('parent_models.update', $parentModel) }}" class="space-y-4">
            @csrf
            @method('PUT')
            <div>
                <label for="user_id" class="block font-semibold">Utilisateur</label>
                <select name="user_id" id="user_id" class="w-full border rounded px-3 py-2" required>
                    <option value="">Sélectionner un utilisateur</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" @if(old('user_id', $parentModel->user_id) == $user->id) selected @endif>{{ $user->nom }} {{ $user->prenom }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Mettre à jour</button>
        </form>
    </div>
</x-app-layout>
