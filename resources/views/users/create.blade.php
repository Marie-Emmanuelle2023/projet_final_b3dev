<x-app-layout>

    <div class="max-w-xl mx-auto mt-10 bg-white p-8 rounded shadow">
        <h2 class="text-2xl font-semibold mb-6">Créer un nouvel utilisateur</h2>

        <form method="POST" action="{{ route('users.store') }}" enctype="multipart/form-data">
            @csrf

            <!-- Nom -->
            <div class="mb-4">
                <label for="nom" class="block text-gray-700">Nom</label>
                <input type="text" name="nom" id="nom" value="{{ old('nom') }}" required
                    class="w-full border rounded px-3 py-2">
            </div>

            <!-- Prénom -->
            <div class="mb-4">
                <label for="prenom" class="block text-gray-700">Prénom</label>
                <input type="text" name="prenom" id="prenom" value="{{ old('prenom') }}" required
                    class="w-full border rounded px-3 py-2">
            </div>

            <!-- Identifiant -->
            <div class="mb-4">
                <label for="identifiant" class="block text-gray-700">Identifiant</label>
                <input type="text" name="identifiant" id="identifiant" value="{{ old('identifiant') }}" required
                    class="w-full border rounded px-3 py-2">
            </div>

            <!-- Mot de passe -->
            <div class="mb-4">
                <label for="password" class="block text-gray-700">Mot de passe</label>
                <input type="password" name="password" id="password" required class="w-full border rounded px-3 py-2">
            </div>

            <!-- Rôle -->
            <div class="mb-4">
                <label for="role_id" class="block text-gray-700">Rôle</label>
                <select name="role_id" id="role_id" required class="w-full border rounded px-3 py-2">
                    <option value="">-- Sélectionnez un rôle --</option>
                    @foreach ($roles as $role)
                        <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>
                            {{ $role->libelle }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Classe (affiché uniquement si le rôle est étudiant) -->
            <div class="mb-4" id="classe_field" style="display: none;">
                <label for="classe_id" class="block text-gray-700">Classe</label>
                <select name="classe_id" id="classe_id" class="w-full border rounded px-3 py-2">
                    <option value="">-- Sélectionnez une classe --</option>
                    @foreach ($classes as $classe)
                        <option value="{{ $classe->id }}" {{ old('classe_id') == $classe->id ? 'selected' : '' }}>
                            {{ $classe->nom }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Photo -->
            <div class="mb-4">
                <label for="photo" class="block text-gray-700">Photo</label>
                <input type="file" name="photo" id="photo" class="w-full border rounded px-3 py-2">
            </div>

            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded">Créer</button>

            @if ($errors->any())
                <div class="mb-4 p-4 bg-red-100 text-red-800 rounded">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>• {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </form>
    </div>

    <!-- Script pour afficher/masquer la classe -->
    <script>
        const roleSelect = document.getElementById('role_id');
        const classeField = document.getElementById('classe_field');

        function toggleClasseField() {
            const selectedText = roleSelect.options[roleSelect.selectedIndex]?.text?.toLowerCase() || '';
            classeField.style.display = selectedText === 'etudiant' ? 'block' : 'none';
        }

        roleSelect.addEventListener('change', toggleClasseField);
        window.addEventListener('DOMContentLoaded', toggleClasseField); // initialise dès le chargement (utile en cas d'erreur old())
    </script>

</x-app-layout>
