<x-app-layout>
    <div class="container mx-auto py-8">
        <h1 class="text-2xl font-bold mb-6">Modifier le report de séance</h1>

        @if ($errors->any())
            <div class="bg-red-100 text-red-800 p-2 mb-4 rounded">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('report_de_seances.update', $reportDeSeance) }}" class="space-y-4">
            @csrf
            @method('PUT')
            <div>
                <label for="seance_reportee_id" class="block font-semibold">Séance à reporter</label>
                <select name="seance_reportee_id" id="seance_reportee_id" class="w-full border rounded px-3 py-2" required>
                    <option value="">-- Sélectionner --</option>
                    @foreach($seances as $seance)
                        <option value="{{ $seance->id }}" @if(old('seance_reportee_id', $reportDeSeance->seance_reportee_id) == $seance->id) selected @endif>{{ $seance->date }} - {{ $seance->module->nom ?? '' }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="seance_report_id" class="block font-semibold">Séance de report</label>
                <select name="seance_report_id" id="seance_report_id" class="w-full border rounded px-3 py-2" required>
                    <option value="">-- Sélectionner --</option>
                    @foreach($seances as $seance)
                        <option value="{{ $seance->id }}" @if(old('seance_report_id', $reportDeSeance->seance_report_id) == $seance->id) selected @endif>{{ $seance->date }} - {{ $seance->module->nom ?? '' }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="date" class="block font-semibold">Date du report</label>
                <input type="date" name="date" id="date" value="{{ old('date', $reportDeSeance->date) }}" class="w-full border rounded px-3 py-2" required>
            </div>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Mettre à jour</button>
        </form>
    </div>
</x-app-layout>
