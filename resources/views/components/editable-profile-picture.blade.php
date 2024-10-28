<div class="relative inline-block">
    <label class="block text-gray-700 font-medium mb-1">{{ $label }}</label>
    <div class="relative inline-block cursor-pointer" id="profileContainer">
        <img src="{{ $imageUrl }}" alt="Profile Picture" class="w-24 h-24 rounded-full border border-gray-300" id="profileImage">
        
        <div class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-50 rounded-full transition-opacity duration-300" id="uploadOverlay" style="opacity: 0;">
            <span class="text-white text-2xl">+</span>
        </div>
    </div>
    
    <input name="profile_picture" type="file" id="fileInput" class="hidden" accept="image/*" onchange="uploadProfilePicture(event)">
</div>
@vite('resources/js/EditPFP.js')