<div x-data="{ imagePreview: '{{ old('image', $currentImage ?? '') }}', fileChosen(event) {
    const file = event.target.files[0];
    if (file) {
        this.imagePreview = URL.createObjectURL(file);
    }
}}">
    <div class="flex items-center relative">
        <input type="file" id="image" name="image" class="hidden" @change="fileChosen">
        
        <template x-if="!imagePreview">
            <label id="image-label" class="w-64 flex flex-col items-center px-4 py-6 bg-gray-900 text-white rounded-lg shadow-lg tracking-wide uppercase border border-gray-700 cursor-pointer hover:bg-gray-700 hover:text-white" @click="document.getElementById('image').click()">
                <svg class="w-8 h-8" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path d="M16.88 9.94l-3.76-3.76a1 1 0 00-1.41 0L9 8.88 5.29 5.17a1 1 0 00-1.41 0L.88 8.17a1 1 0 000 1.41l3.76 3.76a1 1 0 001.41 0L11 11.12l3.71 3.71a1 1 0 001.41 0l3.76-3.76a1 1 0 000-1.41z"/>
                </svg>
                <span class="mt-2 text-base leading-normal">Select a file</span>
            </label>
        </template>
        
        <template x-if="imagePreview">
            <div class="relative w-64 h-64 cursor-pointer" @click="document.getElementById('image').click()">
                <img :src="imagePreview" class="w-full h-full object-cover rounded-lg shadow-lg border border-gray-700" />
                <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center rounded-lg opacity-0 hover:opacity-100 transition-opacity">
                    <span class="text-white text-lg">Click to change image</span>
                </div>
            </div>
        </template>
    </div>
</div>