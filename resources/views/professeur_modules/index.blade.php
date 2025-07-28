
<x-app-layout>
    <div class="container py-4">
        <h2 class="mb-4">Liste des affectations Professeur - Module</h2>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <a href="{{ route('professeur_modules.create') }}" class="btn btn-success mb-3">Nouvelle affectation</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Professeur</th>
                    <th>Module</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($professeurModules as $affectation)
                    <tr>
                        <td>{{ $affectation->id }}</td>
                        <td>
                            @php
                                $nom = $affectation->professeur->user->nom ?? '';
                                $prenom = $affectation->professeur->user->prenom ?? '';
                                $nomComplet = trim($nom . ' ' . $prenom);
                            @endphp
                            {{ $nomComplet ?: 'Nom inconnu' }}
                        </td>
                        <td>{{ $affectation->module->nom ?? 'Nom inconnu' }}</td>
                        <td>
                            <a href="{{ route('professeur_modules.show', $affectation) }}" class="btn btn-info btn-sm">Voir</a>
                            <a href="{{ route('professeur_modules.edit', $affectation) }}" class="btn btn-warning btn-sm">Modifier</a>
                            <form action="{{ route('professeur_modules.destroy', $affectation) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Confirmer la suppression ?')">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
