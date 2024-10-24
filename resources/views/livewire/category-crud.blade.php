<div class="max-w-2xl mx-auto p-4">
    <h2 class="text-xl font-semibold mb-4">{{ $isEditing ? 'Edit Category' : 'Add Category' }}</h2>

    <form wire:submit.prevent="{{ $isEditing ? 'updateCategory' : 'createCategory' }}">
        <div class="mb-4">
            <input type="text" wire:model="name" class="w-full p-2 border border-gray-300 rounded-md" placeholder="Category name">
            @error('name') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">
            {{ $isEditing ? 'Update Category' : 'Add Category' }}
        </button>

        @if($isEditing)
            <button type="button" wire:click="resetInputFields" class="bg-gray-500 text-white px-4 py-2 rounded-md ml-2">
                Cancel
            </button>
        @endif
    </form>

    <h2 class="text-xl font-semibold my-4">Your Categories</h2>

    <ul>
        @foreach($categories as $category)
            <li class="mb-2 flex justify-between">
                <span>{{ $category->name }}</span>
                <div>
                    <button wire:click="editCategory({{ $category->id }})" class="bg-yellow-500 text-white px-2 py-1 rounded-md mr-2">
                        Edit
                    </button>
                    <button wire:click="deleteCategory({{ $category->id }})" class="bg-red-500 text-white px-2 py-1 rounded-md">
                        Delete
                    </button>
                </div>
            </li>
        @endforeach
    </ul>

    @if (session()->has('message'))
        <div class="mt-4 text-green-600">
            {{ session('message') }}
        </div>
    @endif
</div>

