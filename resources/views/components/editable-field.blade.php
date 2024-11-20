<div>
    <label class="block text-gray-700 font-medium">{{ $label }}</label>
    <div class="flex items-center space-x-2 mt-1">
        @if($type === 'textarea')
            <p id="display-{{ $name }}" class="text-black p-2 w-full" style="display: block;">{{ $value }}</p>
            <textarea id="input-{{ $name }}" name="{{ $name }}" 
                      class="border rounded p-2 w-full text-black {{ $validationType }}" style="display: none;">{{ $value }}</textarea>
        @else
            <p id="display-{{ $name }}" class="text-black p-2 w-full" style="display: block;">{{ $value }}</p>
            <input type="text" id="input-{{ $name }}" name="{{ $name }}" value="{{ $value }}" 
                   class="border rounded p-2 w-full text-black {{ $validationType }}" style="display: none;">
        @endif
        
        @if ($editable)
            <a id="editButton-{{ $name }}" href="#" class="edit-button text-blue-500 hover:text-blue-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825L21 11.7l-2.7-2.7-7.125 7.125M15.3 3l3 3-10.5 10.5H5.25v-4.125L15.3 3z" />
                </svg>
            </a>
            @vite('resources/js/EditFields.js')
        @endif
    </div>
</div>

