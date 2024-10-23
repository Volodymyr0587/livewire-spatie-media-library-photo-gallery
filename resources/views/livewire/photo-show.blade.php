{{-- <div class="bg-white rounded-lg shadow-md overflow-hidden">
    <div>
        <img src="{{ $photo->getFirstMediaUrl('photos') }}" alt="{{ $photo->title }}" class="w-1/2 h-48 object-cover">
    </div>
    <div class="p-4">
        <h3 class="text-lg font-semibold">{{ $photo->title }}</h3>
        <div class="mt-2">
            @foreach($photo->categories as $category)
                <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">
                    {{ $category->name }}
                </span>
            @endforeach
        </div>
        @if($photo->description)
            <p class="text-sm text-gray-500 mt-2">{{ $photo->description }}</p>
        @endif
    </div>
</div> --}}

<div class="bg-white rounded-lg shadow-md overflow-hidden max-w-md mx-auto">
    <div class="flex justify-center ">
        <img src="{{ $photo->getFirstMediaUrl('photos') }}" alt="{{ $photo->title }}" class="h-auto max-w-full">
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
    </div>
</div>
