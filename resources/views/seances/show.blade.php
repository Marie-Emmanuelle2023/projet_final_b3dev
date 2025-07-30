<x-app-layout>
    <div class="max-w-md mx-auto mt-10 bg-white p-8 rounded shadow">
        <h2 class="text-2xl font-semibold mb-6">Détail de la séance</h2>
        <div class="mb-4">
            <span class="font-bold">Date :</span> {{ $seance->date }}
        </div>
        <div class="mb-4">
            <span class="font-bold">Salle :</span> {{ $seance->salle }}
        </div>
        <div class="mb-4">
            <span class="font-bold">Type de cours :</span> {{ $seance->typeCours->libelle ?? '-' }}
        </div>
        <div class="mb-4">
            <span class="font-bold">Classe :</span> {{ $seance->classe->nom ?? '-' }}
        </div>
        <div class="mb-4">
            <span class="font-bold">Emploi du temps :</span> {{ $seance->emploiDuTemps->id ?? '-' }}
        </div>
        <div class="mb-4">
            <span class="font-bold">Module :</span> {{ $seance->module->nom ?? '-' }}
        </div>
        <div class="mb-4">
            <span class="font-bold">Professeur :</span> {{ $seance->professeur->user->nom ?? '-' }} {{ $seance->professeur->user->prenom ?? '-' }}
        </div>
        <a href="{{ route('seances.index') }}" class="ml-2 text-gray-600">Retour</a>
        <a href="{{ route('seances.edit', $seance) }}" class="bg-yellow-500 text-white px-4 py-2 rounded">Modifier</a>
    </div>
</x-app-layout>
