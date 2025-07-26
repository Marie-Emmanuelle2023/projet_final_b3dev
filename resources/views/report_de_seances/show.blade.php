
<x-app-layout>
    <div class="container mx-auto py-8">
        <h1 class="text-2xl font-bold mb-6">Détail du report de séance</h1>
        <div class="bg-white rounded shadow p-6">
            <p><span class="font-semibold">Séance à reporter :</span> {{ $reportDeSeance->seanceReportee->date ?? '' }} - {{ $reportDeSeance->seanceReportee->module->nom ?? '' }}</p>
            <p><span class="font-semibold">Séance de report :</span> {{ $reportDeSeance->seanceReport->date ?? '' }} - {{ $reportDeSeance->seanceReport->module->nom ?? '' }}</p>
            <p><span class="font-semibold">Date du report :</span> {{ $reportDeSeance->date }}</p>
        </div>
        <a href="{{ route('report_de_seances.index') }}" class="mt-4 inline-block px-4 py-2 bg-gray-300 rounded">Retour à la liste</a>
    </div>
</x-app-layout>
