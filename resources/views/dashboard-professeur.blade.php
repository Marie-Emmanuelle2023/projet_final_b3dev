<x-app-layout>
    <div class="flex min-h-screen bg-gray-100">
        <!-- Sidebar -->
        <aside class="w-72 bg-gray-100 border-r border-gray-300 p-6 flex flex-col space-y-6">
            <div class="w-32 h-16 bg-[url('/images/logo-ifran.jpg')] bg-contain bg-no-repeat"></div>
            <div class="flex items-center gap-3 p-2 rounded-full bg-indigo-900 text-white w-full max-w-xs">
                <div class="w-6 h-6 bg-white rounded"></div>
                <span class="font-medium text-sm"><a href="{{ route('dashboard') }}">Tableau de bord</a></span>
            </div>
            <nav class="flex flex-col space-y-2 mt-4">
                @foreach ([
        'Mes séances' => route('seances.index'),
        'Présences' => route('presences.index'),
        'Emploi du temps' => route('emploi_du_temps.index'),
        'Modules' => route('modules.index'),
    ] as $label => $url)
                    <a href="{{ $url }}"
                        class="block px-4 py-2 rounded bg-white shadow-sm text-gray-900 font-medium hover:bg-gray-200 transition">
                        {{ $label }}
                    </a>
                @endforeach
            </nav>
        </aside>
        <main class="flex-1 p-8">
            <header class="flex justify-between items-center mb-10">
                <h1 class="text-4xl font-extrabold font-manrope text-black leading-tight">Bonjour à vous M(me), {{ Auth::user()->nom }} {{ Auth::user()->prenom }}</h1>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="w-12 h-12 bg-red-600 rounded-full flex justify-center items-center text-white hover:bg-red-700 transition"
                        title="Déconnexion">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
                            <polyline points="16 17 21 12 16 7" />
                        </svg>
                    </button>
                </form>
            </header>
            <section class="grid grid-cols-3 gap-8">
                <div
                    class="bg-gray-300 rounded-lg shadow-md h-32 flex flex-col items-center justify-center font-semibold text-lg text-gray-700">
                    <span class="text-3xl font-bold">{{ $seancesCount ?? '-' }}</span>
                    <span>Mes séances cette semaine</span>
                </div>
                <div
                    class="bg-gray-300 rounded-lg shadow-md h-32 flex flex-col items-center justify-center font-semibold text-lg text-gray-700">
                    <span class="text-3xl font-bold">{{ $modulesCount ?? '-' }}</span>
                    <span>Modules enseignés</span>
                </div>
                <div
                    class="bg-red-200 rounded-lg shadow-md h-32 flex flex-col items-center justify-center font-semibold text-lg text-red-700">
                    <span class="text-3xl font-bold">{{ $absencesCount ?? '-' }}</span>
                    <span>Absences dans mes cours</span>
                </div>
            </section>
            <section class="mt-10">
                <h2 class="text-xl font-bold mb-4">Séances à venir</h2>
                <ul class="bg-white rounded shadow divide-y">
                    @forelse ($seancesProchaines as $seance)
                        <li class="p-4">
                            <strong>{{ $seance->module->nom ?? 'Module inconnu' }}</strong><br>
                            {{ \Carbon\Carbon::parse($seance->date)->format('d/m/Y H:i') }} – {{ $seance->salle }}
                        </li>
                    @empty
                        <li class="p-4 text-gray-500">Aucune séance à venir.</li>
                    @endforelse
                </ul>
            </section>


        </main>
    </div>
</x-app-layout>
