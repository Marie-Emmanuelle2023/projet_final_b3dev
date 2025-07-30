<x-app-layout>
    <div class="flex min-h-screen bg-gray-100">
        @include('components.navbar-parent')
        <main class="flex-1 p-8">
            <div class="container mx-auto py-8 px-4">
                <h1 class="text-3xl font-bold text-[#202149] mb-6">Emploi du temps</h1>

                <form method="GET" action="{{ route('parent.emploi') }}" class="mb-6">
                    <label for="etudiant_id" class="block mb-2 font-medium">Choisir un enfant :</label>
                    <select name="etudiant_id" id="etudiant_id" onchange="this.form.submit()"
                        class="p-2 border border-gray-300 rounded">
                        @foreach ($enfants as $enfant)
                            <option value="{{ $enfant->id }}" {{ $selectedChildId == $enfant->id ? 'selected' : '' }}>
                                {{ $enfant->user->prenom }} {{ $enfant->user->nom }}
                            </option>
                        @endforeach
                    </select>
                </form>

                <div class="flex space-x-4 mb-6">
                    <button id="jourBtn" class="text-[#202149] font-bold text-sm">Jour</button>
                    <button id="semaineBtn"
                        class="text-[#E61945] font-bold text-sm border-b-2 border-[#E61945] pb-1">Semaine</button>
                </div>


                <table class="w-full table-auto bg-white rounded shadow">
                    <thead class="bg-gray-100 text-left">
                        <tr>
                            <th class="px-4 py-2">Jour</th>
                            <th class="px-4 py-2">Heure</th>
                            <th class="px-4 py-2">Module</th>
                            <th class="px-4 py-2">Professeur</th>
                            <th class="px-4 py-2">Type</th>
                            <th class="px-4 py-2">Salle</th>
                        </tr>
                    </thead>
                    <tbody id="semaineView">
                        @forelse ($seances as $seance)
                            <tr class="border-b">
                                <td class="px-4 py-2">
                                    {{ \Carbon\Carbon::parse($seance->date)->locale('fr')->translatedFormat('l d/m') }}
                                </td>
                                <td class="px-4 py-2">{{ $seance->heure }}</td>
                                <td class="px-4 py-2">{{ $seance->module->nom }}</td>
                                <td class="px-4 py-2">{{ $seance->professeur->user->nom ?? '-' }}
                                    {{ $seance->professeur->user->prenom ?? '-' }}</td>
                                <td class="px-4 py-2">{{ $seance->typeCours->libelle }}</td>
                                <td class="px-4 py-2">{{ $seance->salle ?? '-' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-gray-500 py-4">Aucune séance prévue cette
                                    semaine.</td>
                            </tr>
                        @endforelse
                    </tbody>

                    <tbody id="jourView" class="hidden">
                        @php
                            $aujourdhui = \Carbon\Carbon::now()->format('Y-m-d');
                            $seancesDuJour = $seances->filter(fn($s) => $s->date === $aujourdhui);
                        @endphp

                        @forelse ($seancesDuJour as $seance)
                            <tr class="border-b">
                                <td class="px-4 py-2">
                                    {{ \Carbon\Carbon::parse($seance->date)->locale('fr')->translatedFormat('l d/m') }}
                                </td>
                                <td class="px-4 py-2">{{ $seance->heure }}</td>
                                <td class="px-4 py-2">{{ $seance->module->nom }}</td>
                                <td class="px-4 py-2">{{ $seance->typeCours->libelle }}</td>
                                <td class="px-4 py-2">{{ $seance->salle ?? '-' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-gray-500 py-4">Aucun cours prévu aujourd’hui.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>
        </main>
    </div>



    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const jourBtn = document.getElementById('jourBtn');
            const semaineBtn = document.getElementById('semaineBtn');
            const jourView = document.getElementById('jourView');
            const semaineView = document.getElementById('semaineView');



            jourBtn.addEventListener('click', function() {
                jourView.classList.remove('hidden');
                semaineView.classList.add('hidden');

                // Style actif
                jourBtn.classList.add('text-[#E61945]', 'border-b-2', 'border-[#E61945]', 'pb-1');
                jourBtn.classList.remove('text-[#202149]');
                semaineBtn.classList.remove('text-[#E61945]', 'border-b-2', 'border-[#E61945]', 'pb-1');
                semaineBtn.classList.add('text-[#202149]');
            });

            semaineBtn.addEventListener('click', function() {
                semaineView.classList.remove('hidden');
                jourView.classList.add('hidden');

                // Style actif
                semaineBtn.classList.add('text-[#E61945]', 'border-b-2', 'border-[#E61945]', 'pb-1');
                semaineBtn.classList.remove('text-[#202149]');
                jourBtn.classList.remove('text-[#E61945]', 'border-b-2', 'border-[#E61945]', 'pb-1');
                jourBtn.classList.add('text-[#202149]');
            });
        });
    </script>

</x-app-layout>
