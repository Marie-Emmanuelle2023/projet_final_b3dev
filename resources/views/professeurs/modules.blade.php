<x-app-layout>
    <div class="flex min-h-screen bg-gray-100">
        @include('components.navbar-prof')
        <main class="flex-1 p-8">
            <div class="container mx-auto py-8">
                <h1 class="text-2xl font-bold mb-6">Mes modules enseignés</h1>

                @if ($modules->isEmpty())
                    <p class="text-gray-600">Aucun module assigné pour l’instant.</p>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($modules as $module)
                            <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition">
                                <h2 class="text-lg font-semibold mb-2">{{ $module->nom }}</h2>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
            <div class="mt-6">
                <a href="{{ route('professeur.dashboard') }}"
                    class="inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Retour au tableau de
                    bord</a>
            </div>
        </main>
    </div>
</x-app-layout>
