<div class="p-4 sm:py-6 md:py-12"> <!-- Changed padding for mobile -->
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Photos') }}
        </h2>
    </x-slot>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                @if (session()->has('message'))
                    <div x-data="{ show: true }"
                         x-init="setTimeout(() => show = false, 5000)"
                         x-show="show"
                         class="mb-4 text-green-600 font-bold text-xl">
                        {{ session('message') }}
                    </div>
                @endif
                @if ($editMode)
                    <div class="max-w-2xl mx-auto mb-4">
                        <form wire:submit.prevent="update" class="space-y-4">
                            <!-- Form elements remain unchanged -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Title</label>
                                <input type="text" wire:model="title" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                @error('title') <span class="text-red-500">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Description</label>
                                <textarea wire:model="description" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" rows="3">{{ $description }}</textarea>
                                @error('description') <span class="text-red-500">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Categories</label>
                                <div class="mt-2 space-y-2">
                                    @foreach($categories as $category)
                                        <label class="inline-flex items-center">
                                            <input type="checkbox" wire:model="selectedCategories" value="{{ $category->id }}"
                                                class="rounded border-gray-300 text-blue-600 shadow-sm">
                                            <span class="ml-2">{{ $category->name }}</span>
                                        </label>
                                    @endforeach
                                </div>
                                @error('selectedCategories') <span class="text-red-500">{{ $message }}</span> @enderror
                            </div>

                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Update Photo
                            </button>

                            <button type="button" wire:click="$set('editMode', false)" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                Cancel
                            </button>
                        </form>
                    </div>
                @else
                <div class="mb-4">
                    <select wire:model.live="selectedCategory" class="rounded-md border-gray-300 shadow-sm">
                        <option value="">All Categories</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach($photos as $photo)
                        <div class="bg-white rounded-lg shadow-md overflow-hidden">
                            <a href="{{ route('photos.show', $photo->id) }}" wire:navigate>
                                <img src="{{ $photo->getFirstMediaUrl('photos') }}" alt="{{ $photo->title }}" class="w-full h-48 object-cover">
                            </a>
                            <div class="p-4">
                                <h3 class="text-lg font-semibold">{{ $photo->title }}</h3>
                                <div class="mt-2">
                                    @foreach($photo->categories as $category)
                                        <span wire:click="filterByCategory({{ $category->id }})" class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2 cursor-pointer hover:bg-gray-300">
                                            {{ $category->name }}
                                        </span>
                                    @endforeach
                                </div>
                                @if($photo->description)
                                    <p class="text-sm text-gray-500 mt-2">{{ $photo->description }}</p>
                                @endif
                                <button wire:click="edit({{ $photo->id }})" class="text-blue-500 hover:text-blue-700">Edit</button>
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
                @endif
            </div>
        </div>
    </div>
</div>
