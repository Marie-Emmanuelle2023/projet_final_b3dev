{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout> --}}

{{-- resources/views/dashboard.blade.php --}}

<x-app-layout>
    <div class="flex min-h-screen bg-gray-100">

        <!-- Sidebar -->
        <aside class="w-72 bg-gray-100 border-r border-gray-300 p-6 flex flex-col space-y-6">

            <!-- Logo -->
            <div class="w-32 h-16 bg-[url('/images/logo-ifran.jpg')] bg-contain bg-no-repeat"></div>

            <!-- Menu Tableau de bord -->
            <div class="flex items-center gap-3 p-2 rounded-full bg-indigo-900 text-white w-full max-w-xs">
                <div class="w-6 h-6 bg-white rounded"></div>
                <span class="font-medium text-sm">Tableau de bord</span>
            </div>

            <!-- Menu liens -->
            <nav class="flex flex-col space-y-2 mt-4">
                @foreach ([
                    'Étudiants' => '#',
                    'Enseignants' => '#',
                    'Modules' => '#',
                    'Classes' => '#',
                    'Emploi du temps' => '#',
                    'Coordinateurs' => '#',
                ] as $label => $url)
                    <a href="{{ $url }}"
                       class="block px-4 py-2 rounded bg-white shadow-sm text-gray-900 font-medium hover:bg-gray-200 transition">
                        {{ $label }}
                    </a>
                @endforeach
            </nav>

        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-8">

            <!-- Header -->
            <header class="flex justify-between items-center mb-10">
                <h1 class="text-4xl font-extrabold font-manrope text-black leading-tight">Bonjour, Admin</h1>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="w-12 h-12 bg-red-600 rounded-full flex justify-center items-center text-white hover:bg-red-700 transition"
                        title="Déconnexion"
                    >
                        {{-- Icon logout SVG --}}
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                            <polyline points="16 17 21 12 16 7"/>
                        </svg>
                    </button>
                </form>
            </header>

            <!-- Dashboard Cards -->
            <section class="grid grid-cols-3 gap-8">
                @foreach (range(1, 6) as $i)
                    <div class="bg-gray-300 rounded-lg shadow-md h-32 flex items-center justify-center font-semibold text-lg text-gray-700">
                        Carte {{ $i }}
                    </div>
                @endforeach
            </section>

        </main>

    </div>
</x-app-layout>

