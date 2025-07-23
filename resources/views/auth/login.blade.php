<x-guest-layout>

    <div class="min-h-screen flex flex-col justify-center items-center bg-[#F7F7F7]">
        <!-- Logo (affiché via le layout guest) -->

        <!-- Titre -->
        <h1 class="mb-8 font-manrope font-semibold text-3xl md:text-4xl text-[#202149] text-center">Bienvenue sur ton espace IFRAN</h1>
        <!-- Formulaire -->
        <form method="POST" action="{{ route('login') }}" class="p-8 flex flex-col gap-6">
            @csrf
            <!-- Identifiant -->
            <div>
                <label for="identifiant" class="block font-manrope text-lg text-[#202149] mb-2">Identifiant</label>
                <input id="identifiant" name="identifiant" type="text" required autofocus autocomplete="username" value="{{ old('identifiant') }}" class="w-[580px] h-12 px-4 py-2 border border-[#202149] rounded-lg focus:outline-none focus:ring-2 focus:ring-[#202149] font-manrope text-lg text-[#202149] bg-white" />
                <x-input-error :messages="$errors->get('identifiant')" class="mt-2 text-red-500 text-sm" />
            </div>
            <!-- Mot de passe -->
            <div>
                <label for="password" class="block font-manrope text-lg text-black mb-2">Mot de passe</label>
                <input id="password" name="password" type="password" required autocomplete="current-password" class="w-[580px] h-12 px-4 py-2 border border-[#202149] rounded-lg focus:outline-none focus:ring-2 focus:ring-[#202149] font-manrope text-lg text-black bg-white" />
                <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500 text-sm" />
            </div>
            <!-- Se connecter -->
            <button type="submit" class="w-full h-12 bg-[#E61945] rounded-full font-inter font-semibold text-lg text-white flex items-center justify-center">Se connecter</button>
            <!-- Mot de passe oublié? -->
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="block text-center font-inter text-lg text-[#E61945] hover:underline">Mot de passe oublié?</a>
            @endif
        </form>

    </div>
</x-guest-layout>
