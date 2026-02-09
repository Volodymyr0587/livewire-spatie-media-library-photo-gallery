<div class="mt-12 bg-white rounded-lg shadow-md overflow-hidden max-w-4xl mx-auto">
    <div x-data="{ fullscreen: false, imageSrc: '' }">
        <!-- Your image thumbnail -->
        <img
            src="{{  $photo->getFirstMediaUrl('photos') }}"
            @click="fullscreen = true; imageSrc = $event.target.src"
            class="cursor-pointer hover:opacity-80 transition"
            alt="Click to view fullscreen"
        >
        <!-- Fullscreen overlay -->
        <div
            x-show="fullscreen"
            x-cloak
            @click="fullscreen = false"
            class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-90"
        >
            <img :src="imageSrc" class="max-h-screen max-w-screen p-4" @click.stop>
            <!-- Close button -->
            <button
                @click="fullscreen = false"
                class="absolute top-4 right-4 text-white text-4xl hover:text-gray-300"
            >
                &times;
            </button>
        </div>
    </div>

    <div class="p-4">
        <h3 class="text-lg font-semibold text-center">{{ $photo->title }}</h3>
        <div class="mt-2 text-center">
            @foreach($photo->categories as $category)
                <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">
                    {{ $category->name }}
                </span>
            @endforeach
        </div>
        @if($photo->description)
            <p class="text-sm text-gray-500 mt-2 text-center">{{ $photo->description }}</p>
        @endif
        <div>
            <button type="button" wire:click="download" class="bg-blue-500 text-white hover:bg-blue-700 font-bold py-2 px-4 rounded">
                Download
            </button>
        </div>
    </div>
</div>
