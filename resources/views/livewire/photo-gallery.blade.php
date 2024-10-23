<div class="max-w-7xl mx-auto p-4">
    <div class="mb-4">
        <select wire:model.live="selectedCategory" class="rounded-md border-gray-300 shadow-sm">
            <option value="">All Categories</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
        @foreach($photos as $photo)
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <a href="{{ route('photos.show', $photo->id) }}" wire:navigate>
                    <img src="{{ $photo->getFirstMediaUrl('photos') }}" alt="{{ $photo->title }}" class="w-full h-48 object-cover">
                </a>
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
                    <button wire:click="delete({{ $photo->id }})" class="mt-2 text-red-600 hover:text-red-800" wire:confirm='Are you sure you want to delete this photo?'>
                        Delete
                    </button>
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-4">
        {{ $photos->links() }}
    </div>
</div>

