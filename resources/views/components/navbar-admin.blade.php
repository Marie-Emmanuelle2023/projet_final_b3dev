<aside class="w-72 bg-gray-100 border-r border-gray-300 p-6 flex flex-col space-y-6">
            <div class="flex items-center gap-3 p-2 rounded-full bg-indigo-900 text-white w-full max-w-xs">
                <div class="w-6 h-6 bg-white rounded"></div>
                <span class="font-medium text-sm"> <a href="{{ route('dashboard') }}">Tableau de bord</a> </span>
            </div>
            <nav class="flex flex-col space-y-2 mt-2">
                @foreach ([
        'Utilisateurs' => route('users.index'),
        'Coordinateurs' => route('coordinateurs.index'),
        'Professeurs' => route('professeurs.index'),
        'Étudiants' => route('etudiants.index'),
        'Parents' => route('parent_models.index'),
        'Années Académiques' => route('annee_academiques.index'),
        'Années' => route('annees.index'),
        'Classes' => route('classes.index'),
        'Niveaux' => route('niveaux.index'),
        'Modules' => route('modules.index'),
        'Affectations Modules' => route('professeur_modules.index'),
        'Types de cours' => route('type_cours.index'),
        'Liens Parents-Étudiants' => route('parents.index'),
    ] as $label => $url)
                    <a href="{{ $url }}"
                        class="block px-4 py-2 rounded bg-white shadow-sm text-gray-900 font-medium hover:bg-gray-200 transition">
                        {{ $label }}
                    </a>
                @endforeach
            </nav>

        </aside>
