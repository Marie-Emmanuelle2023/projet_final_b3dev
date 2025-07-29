@php
    use Carbon\Carbon;

    $today = Carbon::now();
    $daysOfWeek = ['Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam', 'Dim'];
    \Carbon\Carbon::setLocale('fr');
    $currentMonth = ucfirst($today->translatedFormat('F Y'));
@endphp
{{--
<div class="bg-white rounded-2xl shadow p-6 w-full">
    <h2 class="text-xl font-bold text-gray-800 mb-4">Semaine en cours</h2>
    <div class="grid grid-cols-7 gap-4 text-center">
        @foreach ($daysOfWeek as $i => $day)
            @php
                $currentDay = $today->copy()->startOfWeek()->addDays($i);
                $isToday = $currentDay->isSameDay($today);
            @endphp
            <div class="{{ $isToday ? 'border-2 border-[#E8144A] bg-[#FDECEF] text-[#E8144A] font-bold' : 'bg-gray-100 text-gray-700' }}
                        rounded-xl py-3 transition duration-300 ease-in-out">
                <div class="text-sm uppercase">{{ $day }}</div>
                <div class="text-lg mt-1">{{ $currentDay->format('d') }}</div>
            </div>
        @endforeach
    </div>
</div> --}}

<div class="flex flex-col items-start p-0 gap-2 w-[336px] h-[338px]">
    {{-- Header du mois --}}
    <div class="flex justify-between items-center p-1 w-full h-[48px]">
        <button>&lt;</button>
        <h2 class="text-[16px] font-bold text-[#1C0D12] text-center w-full">{{ $currentMonth }}</h2>
        <button>&gt;</button>
    </div>

    {{-- Jours de la semaine --}}
    <div class="flex w-full justify-between text-[#1C0D12] font-bold text-[13px]">
        @foreach(['D', 'L', 'M', 'M', 'J', 'V', 'S'] as $day)
            <div class="w-[48px] h-[48px] flex items-center justify-center">
                {{ $day }}
            </div>
        @endforeach
    </div>

    {{-- Jours du mois --}}
    @php
        $today = now()->day;
    @endphp

    @for ($week = 0; $week < 5; $week++)
        <div class="flex w-full">
            @for ($day = 1; $day <= 7; $day++)
                @php $date = $week * 7 + $day; @endphp
                <div class="w-[48px] h-[48px] flex items-center justify-center rounded-full
                    {{ $date == $today ? 'bg-[#E8144A] text-white' : 'text-[#1C0D12]' }}">
                    {{ $date <= 31 ? $date : '' }}
                </div>
            @endfor
        </div>
    @endfor
</div>
