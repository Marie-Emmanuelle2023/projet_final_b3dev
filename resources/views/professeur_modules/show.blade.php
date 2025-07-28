
<x-app-layout>
    <div class="container py-4">
        <h2 class="mb-4">Détail de l'affectation Professeur - Module</h2>
        <div class="card">
            <div class="card-body">
                @php
                    $nom = $professeurModule->professeur->user->nom ?? '';
                    $prenom = $professeurModule->professeur->user->prenom ?? '';
                    $nomComplet = trim($nom . ' ' . $prenom);
                @endphp
                <p><strong>Professeur :</strong> {{ $nomComplet ?: 'Nom inconnu' }}</p>
                <p><strong>Module :</strong> {{ $professeurModule->module->nom ?? 'Nom inconnu' }}</p>
            </div>
        </div>
        <a href="{{ route('professeur_modules.index') }}" class="btn btn-secondary mt-3">Retour à la liste</a>
    </div>
</x-app-layout>
