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
                    "Emploi du temps de l'enfant" => route('emploi_du_temps.index'),
                    "Présences de l'enfant" => route('presences.index'),
                    "Justifications envoyées" => route('justifications.index'),
                    "Modules suivis" => route('modules.index'),
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
                <h1 class="text-4xl font-extrabold font-manrope text-black leading-tight">Bonjour, Parent</h1>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="w-12 h-12 bg-red-600 rounded-full flex justify-center items-center text-white hover:bg-red-700 transition"
                        title="Déconnexion"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                            <polyline points="16 17 21 12 16 7"/>
                        </svg>
                    </button>
                </form>
            </header>
            <section class="grid grid-cols-3 gap-8">
                <div class="bg-gray-300 rounded-lg shadow-md h-32 flex flex-col items-center justify-center font-semibold text-lg text-gray-700">
                    <span class="text-3xl font-bold">{{ $childAbsencesCount ?? '-' }}</span>
                    <span>Absences de l'enfant</span>
                </div>
                <div class="bg-gray-300 rounded-lg shadow-md h-32 flex flex-col items-center justify-center font-semibold text-lg text-gray-700">
                    <span class="text-3xl font-bold">{{ $childJustificationsCount ?? '-' }}</span>
                    <span>Justifications envoyées</span>
                </div>
                <div class="bg-gray-300 rounded-lg shadow-md h-32 flex flex-col items-center justify-center font-semibold text-lg text-gray-700">
                    <span class="text-3xl font-bold">{{ $childModulesCount ?? '-' }}</span>
                    <span>Modules suivis</span>
                </div>
            </section>
        </main>
    </div>
</x-app-layout>
