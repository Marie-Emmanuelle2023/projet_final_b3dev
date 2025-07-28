
<x-app-layout>
    <div class="container py-4">
        <h2 class="mb-4">Modifier l'affectation Professeur - Module</h2>
        <form action="{{ route('professeur_modules.update', $professeurModule) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="professeur_id" class="form-label">Professeur</label>
                <select name="professeur_id" id="professeur_id" class="form-control" required>
                    <option value="">Sélectionner un professeur</option>
                    @foreach($professeurs as $professeur)
                        @php
                            $nom = $professeur->user->nom ?? '';
                            $prenom = $professeur->user->prenom ?? '';
                            $nomComplet = trim($nom . ' ' . $prenom);
                        @endphp
                        <option value="{{ $professeur->id }}" @if($professeurModule->professeur_id == $professeur->id) selected @endif>
                            {{ $nomComplet ?: 'Nom inconnu' }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="module_id" class="form-label">Module</label>
                <select name="module_id" id="module_id" class="form-control" required>
                    <option value="">Sélectionner un module</option>
                    @foreach($modules as $module)
                        <option value="{{ $module->id }}" @if($professeurModule->module_id == $module->id) selected @endif>{{ $module->nom }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Mettre à jour</button>
        </form>
        <a href="{{ route('professeur_modules.index') }}" class="btn btn-secondary mt-3">Annuler</a>
    </div>
</x-app-layout>
