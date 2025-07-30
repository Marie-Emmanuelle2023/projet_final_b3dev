<x-app-layout>
    <div class="flex min-h-screen bg-gray-100">
        @include('components.navbar-etudiant')
        <main class="flex-1 p-8">
            <div class="container mx-auto py-8">
                <h1 class="text-2xl font-bold mb-6 text-[#202149]">Mon emploi du temps</h1>

                {{-- Boutons de sélection --}}
                <div class="flex space-x-4 mb-6">
                    <button id="jourBtn" class="text-[#202149] font-bold text-sm">Jour</button>
                    <button id="semaineBtn"
                        class="text-[#E61945] font-bold text-sm border-b-2 border-[#E61945] pb-1">Semaine</button>
                </div>

                {{-- Table d’emploi du temps --}}
                <table class="w-full table-auto bg-white rounded shadow">
                    <thead class="bg-gray-100 text-left">
                        <tr>
                            <th class="px-4 py-2">Jour</th>
                            <th class="px-4 py-2">Heure</th>
                            <th class="px-4 py-2">Module</th>
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

                <div class="mt-6">
                    <a href="{{ route('dashboard') }}"
                        class="inline-block px-4 py-2 bg-[#E61945] text-white rounded hover:bg-red-600">← Retour au
                        tableau de bord</a>
                </div>
            </div>
        </main>
    </div>
    <div class="container mx-auto py-8">
        <h1 class="text-2xl font-bold mb-6 text-[#202149]">Mon emploi du temps</h1>

        {{-- Boutons de sélection --}}
        <div class="flex space-x-4 mb-6">
            <button id="jourBtn" class="text-[#202149] font-bold text-sm">Jour</button>
            <button id="semaineBtn"
                class="text-[#E61945] font-bold text-sm border-b-2 border-[#E61945] pb-1">Semaine</button>
        </div>

        {{-- Table d’emploi du temps --}}
        <table class="w-full table-auto bg-white rounded shadow">
            <thead class="bg-gray-100 text-left">
                <tr>
                    <th class="px-4 py-2">Jour</th>
                    <th class="px-4 py-2">Heure</th>
                    <th class="px-4 py-2">Module</th>
                    <th class="px-4 py-2">Type</th>
                    <th class="px-4 py-2">Salle</th>
                </tr>
            </thead>
            <tbody id="semaineView">
                @forelse ($seances as $seance)
                    <tr class="border-b">
                        <td class="px-4 py-2">
                            {{ \Carbon\Carbon::parse($seance->date)->locale('fr')->translatedFormat('l d/m') }}</td>
                        <td class="px-4 py-2">{{ $seance->heure }}</td>
                        <td class="px-4 py-2">{{ $seance->module->nom }}</td>
                        <td class="px-4 py-2">{{ $seance->typeCours->libelle }}</td>
                        <td class="px-4 py-2">{{ $seance->salle ?? '-' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-gray-500 py-4">Aucune séance prévue cette semaine.
                        </td>
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
                            {{ \Carbon\Carbon::parse($seance->date)->locale('fr')->translatedFormat('l d/m') }}</td>
                        <td class="px-4 py-2">{{ $seance->heure }}</td>
                        <td class="px-4 py-2">{{ $seance->module->nom }}</td>
                        <td class="px-4 py-2">{{ $seance->typeCours->libelle }}</td>
                        <td class="px-4 py-2">{{ $seance->salle ?? '-' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-gray-500 py-4">Aucun cours prévu aujourd’hui.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-6">
            <a href="{{ route('dashboard') }}"
                class="inline-block px-4 py-2 bg-[#E61945] text-white rounded hover:bg-red-600">← Retour au tableau de
                bord</a>
        </div>
    </div>

    {{-- Script JS --}}
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
