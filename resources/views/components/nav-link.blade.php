@props(['active'])

@php
$classes = ($active ?? false)
? '
relative inline-flex items-center
my-3
px-3 py-1.5
text-sm font-medium
rounded-md
bg-blue/25
backdrop-blur-md
shadow-sm
ring-1 ring-blue/30

transition
duration-300
ease-out
'
: '
relative inline-flex items-center
my-3
px-3 py-1.5
text-sm font-medium
rounded-md
backdrop-blur-md

transition
duration-300
ease-out

hover:bg-white/20
hover:-translate-y-0.5
hover:shadow-lg
hover:shadow-black/20
hover:ring-1
hover:ring-white/30
';
@endphp

<a {{ $attributes->merge(['class' => 'relative overflow-hidden ' . $classes]) }}>
    @if ($active)
    <span class="inline-block -ml-2 animate-pulse">
        <svg width="20" height="20" viewBox="0 0 100 100"
            class="fill-yellow-600 drop-shadow-[0_0_8px_rgba(251,191,36,0.8)]">
            <path
                d="M50 5 L55 45 L95 50 L55 55 L50 95 L45 55 L5 50 L45 45 Z M50 15 L58 42 L85 50 L58 58 L50 85 L42 58 L15 50 L42 42 Z"
                class="animate-[flicker_2s_ease-in-out_infinite]" />
        </svg>

        <style>
            @keyframes flicker {

                0%,
                100% {
                    opacity: 1;
                }

                25% {
                    opacity: 0.4;
                }

                50% {
                    opacity: 0.8;
                }

                75% {
                    opacity: 0.3;
                }
            }
        </style>
    </span>
    @endif
    <span class="relative z-10">
        {{ $slot }}
    </span>
</a>
