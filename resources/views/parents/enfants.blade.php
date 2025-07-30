<x-app-layout>
    <div class="flex min-h-screen bg-gray-100">
        @include('components.navbar-parent')
        <main class="flex-1 p-8">
            <div class="container mx-auto py-8">
                <h1 class="text-3xl font-bold mb-6">Mes enfants inscrits</h1>

                @if ($enfants->isEmpty())
                    <p class="text-gray-600">Aucun enfant enregistré pour le moment.</p>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($enfants as $enfant)
                            <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition">
                                <h2 class="text-xl font-bold">{{ $enfant->user->prenom }} {{ $enfant->user->nom }}</h2>
                                <p class="mt-2 text-gray-600">Classe : {{ $enfant->classe->nom ?? 'Non assignée' }}</p>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </main>
    </div>

</x-app-layout>
