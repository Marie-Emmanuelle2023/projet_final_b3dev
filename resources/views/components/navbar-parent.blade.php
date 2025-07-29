<aside class="w-72 bg-gray-100 border-r border-gray-300 p-6 flex flex-col space-y-6">
            <div class="w-32 h-16 bg-[url('/images/logo-ifran.jpg')] bg-contain bg-no-repeat"></div>
            <div class="flex items-center gap-3 p-2 rounded-full bg-indigo-900 text-white w-full max-w-xs">
                <div class="w-6 h-6 bg-white rounded"></div>
                <span class="font-medium text-sm"><a href="{{ route('dashboard') }}">Tableau de bord</a></span>
            </div>
            <nav class="flex flex-col space-y-2 mt-4">
                @foreach ([
                    "Emploi du temps" => route('parent.emploi'),
                    "Absences" => route('parent.absences'),
                    "Justifications envoyées" => route('parent.justifications'),
                    "Mes Enfants" => route('parent.enfants'),
                ] as $label => $url)
                    <a href="{{ $url }}"
                       class="block px-4 py-2 rounded bg-white shadow-sm text-gray-900 font-medium hover:bg-gray-200 transition">
                        {{ $label }}
                    </a>
                @endforeach
            </nav>
        </aside>
