<x-app-layout>
    <div class="flex min-h-screen bg-gray-100">
        <!-- Sidebar -->
        @include('components.navbar-admin')
        <main class="flex-1 p-8">
            <header class="flex justify-between items-center mb-10">
                <h1 class="text-4xl font-extrabold font-manrope text-black leading-tight">Bonjour, Administrateur</h1>
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
            <section class="grid grid-cols-4 gap-8">
                <div
                    class="bg-gray-300 rounded-lg shadow-md h-32 flex flex-col items-center justify-center font-semibold text-lg text-gray-700">
                    <span class="text-3xl font-bold">{{ $usersCount ?? '-' }}</span>
                    <span>Utilisateurs</span>
                </div>
                <div
                    class="bg-gray-300 rounded-lg shadow-md h-32 flex flex-col items-center justify-center font-semibold text-lg text-gray-700">
                    <span class="text-3xl font-bold">{{ $classesCount ?? '-' }}</span>
                    <span>Classes</span>
                </div>
                <div
                    class="bg-gray-300 rounded-lg shadow-md h-32 flex flex-col items-center justify-center font-semibold text-lg text-gray-700">
                    <span class="text-3xl font-bold">{{ $professeursCount ?? '-' }}</span>
                    <span>Professeurs</span>
                </div>
                <div
                    class="bg-gray-300 rounded-lg shadow-md h-32 flex flex-col items-center justify-center font-semibold text-lg text-gray-700">
                    <span class="text-3xl font-bold">{{ $coordinateursCount ?? '-' }}</span>
                    <span>Coordinateurs</span>
                </div>
            </section>
            <section class="grid grid-cols-2 gap-8 mt-8">
                <div
                    class="bg-gray-300 rounded-lg shadow-md h-32 flex flex-col items-center justify-center font-semibold text-lg text-gray-700">
                    <span class="text-3xl font-bold">{{ $modulesCount ?? '-' }}</span>
                    <span>Modules</span>
                </div>
                <div
                    class="bg-gray-300 rounded-lg shadow-md h-32 flex flex-col items-center justify-center font-semibold text-lg text-gray-700">
                    <span class="text-3xl font-bold">{{ $typeCoursCount ?? '-' }}</span>
                    <span>Types de cours</span>
                </div>
                <div
                    class="bg-gray-300 rounded-lg shadow-md h-32 flex flex-col items-center justify-center font-semibold text-lg text-gray-700">
                    <span class="text-3xl font-bold">{{ $niveauxCount ?? '-' }}</span>
                    <span>Niveaux</span>
                </div>
                <div
                    class="bg-gray-300 rounded-lg shadow-md h-32 flex flex-col items-center justify-center font-semibold text-lg text-gray-700">
                    <span class="text-3xl font-bold">{{ $anneesCount ?? '-' }}</span>
                    <span>Années</span>
                </div>

                <div
                    class="bg-gray-300 rounded-lg shadow-md h-32 flex flex-col items-center justify-center font-semibold text-lg text-gray-700">
                    <span class="text-3xl font-bold">{{ $parentsCount ?? '-' }}</span>
                    <span>Parents</span>
                </div>
                <div
                    class="bg-gray-300 rounded-lg shadow-md h-32 flex flex-col items-center justify-center font-semibold text-lg text-gray-700">
                    <span class="text-3xl font-bold">{{ $etudiantsCount ?? '-' }}</span>
                    <span>Étudiants</span>
                </div>
            </section>
        </main>
    </div>
</x-app-layout>
