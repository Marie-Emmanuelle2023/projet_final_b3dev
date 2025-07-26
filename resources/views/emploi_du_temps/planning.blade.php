<x-app-layout>
    <div class="max-w-6xl mx-auto mt-10 bg-gray-100 p-8 rounded shadow">
        <h2 class="text-3xl font-bold mb-8 text-[#202149]" style="font-family: 'Manrope'">Emploi du temps</h2>
        @foreach($emplois as $emploi)
            <div class="mb-10">
                <div class="mb-2 text-xl font-semibold text-[#202149]">Classe : {{ $emploi->classe->nom ?? '-' }}</div>
                <div class="bg-[#F7F7F7] border border-[#D9D9D9] rounded-lg overflow-hidden">
                    <div class="bg-[#F7F7F7] border-b border-[#D9D9D9] px-6 py-3 flex font-bold text-[#202149]" style="font-family: 'Manrope'">
                        <div class="w-1/4">Cours</div>
                        <div class="w-1/4">Horaire</div>
                        <div class="w-1/4">Salle</div>
                        <div class="w-1/4">Professeur</div>
                    </div>
                    @forelse($emploi->seances as $seance)
                        <div class="flex px-6 py-4 border-b border-[#D9D9D9] items-center" style="font-family: 'Manrope'">
                            <div class="w-1/4 font-medium">
                                @if(!empty($seance->module))
                                    {{ $seance->module->nom }}
                                @elseif(!empty($seance->typeCours))
                                    {{ $seance->typeCours->libelle }}
                                @else
                                    -
                                @endif
                            </div>
                            <div class="w-1/4">{{ $seance->date }} {{ $seance->horaire ?? '' }}</div>
                            <div class="w-1/4">{{ $seance->salle }}</div>
                            <div class="w-1/4">{{ $seance->professeur->nom ?? '...' }}</div>
                        </div>
                    @empty
                        <div class="px-6 py-4 text-gray-500">Aucune séance prévue.</div>
                    @endforelse
                </div>
            </div>
        @endforeach
    </div>
</x-app-layout>
