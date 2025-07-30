<x-app-layout>
    <div class="flex min-h-screen bg-gray-100">
        @include('components.navbar-parent')
        <main class="flex-1 p-8">
            <div class="container mx-auto py-8">
                <h1 class="text-2xl font-bold mb-4">Absences de l’enfant</h1>

                <form method="GET" action="{{ route('parent.absences') }}" class="mb-6">
                    <label for="etudiant_id" class="block mb-2">Choisir un enfant :</label>
                    <select name="etudiant_id" id="etudiant_id" onchange="this.form.submit()" class="p-2 border rounded">
                        @foreach ($enfants as $enfant)
                            <option value="{{ $enfant->id }}" {{ $selectedChildId == $enfant->id ? 'selected' : '' }}>
                                {{ $enfant->user->prenom }} {{ $enfant->user->nom }}
                            </option>
                        @endforeach
                    </select>
                </form>

                @if ($absences->isEmpty())
                    <p class="text-gray-500">Aucune absence enregistrée.</p>
                @else
                    <ul class="space-y-4">
                        @foreach ($absences as $absence)
                            <li class="p-4 bg-white shadow rounded">
                                {{ $absence->seance->module->nom }} - {{ $absence->seance->date->format('d/m/Y') }}
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </main>
    </div>
</x-app-layout>
