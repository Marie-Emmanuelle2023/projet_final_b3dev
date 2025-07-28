
<x-app-layout>
    <div class="container py-4">
        <h2 class="mb-4">Nouvelle affectation Professeur - Module</h2>
        <form action="{{ route('professeur_modules.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="professeur_id" class="form-label">Professeur</label>
                <select name="professeur_id" id="professeur_id" class="form-control" required>
                    <option value="">Sélectionner un professeur</option>
                    @foreach($professeurs as $professeur)
                        <option value="{{ $professeur->id }}">
                            @php
                                $nom = $professeur->user->nom ?? '';
                                $prenom = $professeur->user->prenom ?? '';
                                $nomComplet = trim($nom . ' ' . $prenom);
                            @endphp
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
                        <option value="{{ $module->id }}">{{ $module->nom }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Affecter</button>
        </form>
    </div>
</x-app-layout>
