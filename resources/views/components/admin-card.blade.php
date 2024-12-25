<div class="col">
    <div class="bg-white shadow-md rounded-lg p-6 text-center hover:shadow-lg transition-shadow duration-300">
        <div class="mb-4">
            <i class="{{ $icon }} text-4xl {{ $iconColor }}"></i>
        </div>
        <h3 class="text-xl font-bold text-gray-800">{{ $title }}</h3>
        <p class="text-gray-600 mt-2">{{ $description }}</p>
        <a href="{{ $route }}" 
           class="inline-block mt-4 bg-blue-500 text-white font-semibold py-2 px-4 rounded-lg hover:bg-blue-600 transition-colors">
            {{ $buttonText }}
        </a>
    </div>
</div>
