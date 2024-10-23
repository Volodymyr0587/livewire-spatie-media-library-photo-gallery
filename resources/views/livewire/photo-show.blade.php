<div class="mt-12 bg-white rounded-lg shadow-md overflow-hidden max-w-4xl mx-auto">
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
