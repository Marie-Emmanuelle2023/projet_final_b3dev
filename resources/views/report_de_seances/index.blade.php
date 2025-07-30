{{-- Vue : Liste des reports de séance (affiche, actions, modale suppression) --}}
<x-app-layout>
    <div class="flex min-h-screen bg-gray-100">
        <!-- Sidebar -->
        @include('components.navbar-coordi')
        <main class="flex-1 p-8">
            <div class="container mx-auto py-8">
                <h1 class="text-2xl font-bold mb-6">Liste des reports de séance</h1>
                <a href="{{ route('report_de_seances.create') }}"
                    class="mb-4 inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Ajouter un
                    report</a>
                <table class="min-w-full bg-white border">
                    <thead>
                        <tr>
                            <th class="py-2 px-4 border">Séance à reporter</th>
                            <th class="py-2 px-4 border">Séance de report</th>
                            <th class="py-2 px-4 border">Date du report</th>
                            <th class="py-2 px-4 border">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reportDeSeances as $report)
                            <tr>
                                <td class="py-2 px-4 border">{{ $report->seanceReportee->date ?? '' }} -
                                    {{ $report->seanceReportee->module->nom ?? '' }}</td>
                                <td class="py-2 px-4 border">{{ $report->seanceReport->date ?? '' }} -
                                    {{ $report->seanceReport->module->nom ?? '' }}</td>
                                <td class="py-2 px-4 border">{{ $report->date }}</td>
                                <td class="py-2 px-4 border flex gap-2">
                                    <a href="{{ route('report_de_seances.show', $report) }}"
                                        class="px-2 py-1 bg-green-500 text-white rounded">Voir</a>
                                    <a href="{{ route('report_de_seances.edit', $report) }}"
                                        class="px-2 py-1 bg-yellow-500 text-white rounded">Modifier</a>
                                    <!-- Modal Flowbite Suppression -->
                                    <button data-modal-target="modal-{{ $report->id }}"
                                        data-modal-toggle="modal-{{ $report->id }}"
                                        class="px-2 py-1 bg-red-600 text-white rounded">Supprimer</button>
                                    <div id="modal-{{ $report->id }}" tabindex="-1"
                                        class="hidden fixed top-0 left-0 right-0 z-50 w-full p-4 overflow-x-hidden overflow-y-auto h-[calc(100%)] bg-black bg-opacity-50 flex items-center justify-center">
                                        <div class="bg-white rounded-lg shadow p-6 w-full max-w-md">
                                            <h3 class="mb-4 text-lg font-semibold">Confirmer la suppression</h3>
                                            <p class="mb-6">Voulez-vous vraiment supprimer ce report ?</p>
                                            <form method="POST"
                                                action="{{ route('report_de_seances.destroy', $report) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="px-4 py-2 bg-red-600 text-white rounded mr-2">Supprimer</button>
                                                <button type="button" data-modal-hide="modal-{{ $report->id }}"
                                                    class="px-4 py-2 bg-gray-300 rounded">Annuler</button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class= "flex justify-between items-center ">
                    <a href="{{ route('dashboard') }}" class="bg-blue-600 text-white px-4 py-2 rounded mt-4">Retour au
                        dashboard</a>
                </div>
            </div>
        </main>
    </div>
</x-app-layout>
