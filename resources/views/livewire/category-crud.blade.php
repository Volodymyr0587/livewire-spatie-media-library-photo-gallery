<div class="py-12">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Categories') }}
        </h2>
    </x-slot>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h2 class="text-xl font-semibold mb-4">{{ $isEditing ? 'Edit Category' : 'Add Category' }}</h2>

                <form wire:submit.prevent="{{ $isEditing ? 'updateCategory' : 'createCategory' }}">
                    <div class="mb-4">
                        <input type="text" wire:model="name" class="w-full p-2 border border-gray-300 rounded-md" placeholder="Category name">
                        @error('name') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>

                    <button type="submit" class="bg-blue-500 text-white hover:bg-blue-700 font-bold py-2 px-4 rounded">
                        {{ $isEditing ? 'Update Category' : 'Add Category' }}
                    </button>

                    @if($isEditing)
                        <button type="button" wire:click="resetInputFields" class="bg-gray-500 text-white px-4 py-2 rounded-md ml-2">
                            Cancel
                        </button>
                    @endif
                </form>

                <h2 class="text-xl font-semibold my-4">My Categories</h2>

                <ul>
                    @foreach($categories as $category)
                    <li class="flex justify-between items-center my-2">
                        <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2">
                            {{ $category->name }}
                        </span>
                        <div>
                            <button wire:click="editCategory({{ $category->id }})" class="bg-yellow-500 text-white hover:bg-yellow-700 font-bold px-2 py-1 rounded-md">
                                Edit
                            </button>
                            <button wire:click="deleteCategory({{ $category->id }})" wire:confirm='Are you sure you want to delete this category?' class="bg-red-500 text-white hover:bg-red-700 font-bold px-2 py-1 rounded-md">
                                Delete
                            </button>
                        </div>
                    </li>
                    <hr class="h-px bg-gray-300 border-0 ">

                    @endforeach
                </ul>

                @if (session()->has('message'))
                    <div x-data="{ show: true }"
                         x-init="setTimeout(() => show = false, 5000)"
                         x-show="show"
                         class="mb-4 text-green-600 font-bold text-xl">
                        {{ session('message') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

