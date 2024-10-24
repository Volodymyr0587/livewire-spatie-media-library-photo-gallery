<div class="py-4 sm:py-6 md:py-12"> <!-- Adjusted padding for mobile -->
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h2 class="text-2xl font-semibold mb-4">Welcome back, {{ auth()->user()->name }}!</h2>

                <div class="mb-8">
                    <div class="bg-blue-100 p-4 rounded-lg">
                        <p class="text-lg">You have {{ $totalPhotos }} photos in your collection</p>
                        <a href="{{ route('photos.upload') }}" wire:navigate class="inline-block mt-2 bg-blue-500 text-white hover:bg-blue-700 font-bold py-2 px-4 rounded">
                            Upload New Photo
                        </a>
                    </div>
                </div>

                @if($recentPhotos->count() > 0)
                    <h3 class="text-xl font-semibold mb-4">Your Recent Photos</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4"> <!-- Adjusted grid for responsive -->
                        @foreach($recentPhotos as $photo)
                            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                                <img src="{{ $photo->getFirstMediaUrl('photos') }}" alt="{{ $photo->title }}" class="w-full h-48 object-cover">
                                <div class="p-4">
                                    <h4 class="font-semibold">{{ $photo->title }}</h4>
                                    <div class="mt-2">
                                        @foreach($photo->categories as $category)
                                            <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">
                                                {{ $category->name }}
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-4">
                        <a href="{{ route('photos.index') }}" class="text-blue-500 hover:text-blue-700">
                            View All Photos →
                        </a>
                    </div>
                @else
                    <div class="text-center py-8">
                        <p class="text-gray-500 mb-4">You haven't uploaded any photos yet.</p>
                        <a href="{{ route('photos.upload') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                            Upload Your First Photo
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
