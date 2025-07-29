<x-app-layout>
    <div class="flex min-h-screen bg-gray-100">
        <!-- Sidebar -->
       @include('components.navbar-etudiant')
        <main class="flex-1 p-8">
            <header class="flex justify-between items-center mb-10">
                <h1 class="text-4xl font-extrabold font-manrope text-black leading-tight">Bonjour, Étudiant</h1>
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
                <div class=" flex items-center justify-center col-span-3 mb-2">
                    @include('components.calendar')
                </div>
                <div class="bg-gray-300 rounded-lg shadow-md h-32 flex flex-col items-center justify-center font-semibold text-lg text-gray-700">
                    <span class="text-3xl font-bold">{{ $absencesCount ?? '-' }}</span>
                    <span>Absences enregistrées</span>
                </div>
                <div class="bg-gray-300 rounded-lg shadow-md h-32 flex flex-col items-center justify-center font-semibold text-lg text-gray-700">
                    <span class="text-3xl font-bold">{{ $justificationsCount ?? '-' }}</span>
                    <span>Justifications envoyées</span>
                </div>
            </section>
        </main>
    </div>
</x-app-layout>
