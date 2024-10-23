<div class="max-w-2xl mx-auto p-4">
    <form wire:submit="save" class="space-y-4">
        <div>
            <label class="block text-sm font-medium text-gray-700">Photo</label>
            <input type="file" wire:model="photo" class="mt-1 block w-full">
            @error('photo') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Title</label>
            <input type="text" wire:model="title" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            @error('title') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Categories</label>
            <div class="mt-2 space-y-2">
                @foreach($categories as $category)
                    <label class="inline-flex items-center">
                        <input type="checkbox" wire:model="selectedCategories" value="{{ $category->id }}"
                               class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                        <span class="ml-2">{{ $category->name }}</span>
                    </label>
                @endforeach
            </div>
            @error('selectedCategories') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Description</label>
            <textarea wire:model="description" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" rows="3"></textarea>
            @error('description') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="bg-blue-500 hover:bg-blue-700 font-bold py-2 px-4 rounded">
            Upload Photo
        </button>
    </form>
</div>
