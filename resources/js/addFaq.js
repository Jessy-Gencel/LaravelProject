document.addEventListener('DOMContentLoaded', function() {
    const categorySelect = document.getElementById('category-select');
    const categoryInput = document.getElementById('category-input');
    const categoryContainer = document.getElementById('category-container');

    function showCategoryInput() {
        categorySelect.classList.add('hidden');
        categoryInput.classList.remove('hidden');
        categoryInput.focus();
    }

    function showCategorySelect() {
        categoryInput.classList.add('hidden');
        categorySelect.classList.remove('hidden');
        categorySelect.value = '';
    }
    function validateCategory() {
        const existingCategories = Array.from(categorySelect.options).map(option => option.value);
        if (existingCategories.includes(categoryInput.value.trim())) {
            alert('This category already exists.');
            categoryInput.value = '';
            categoryInput.focus();
            return false;
        }
        return true;
    } 
    function capitalizeFirstLetter(string) {
        return string.charAt(0).toUpperCase() + string.slice(1);
    }

    function createCategoryBox(category) {
        const box = document.createElement('div');
        box.classList.add('bg-gray-800', 'text-white', 'p-2', 'rounded', 'flex', 'items-center', 'space-x-2', 'mt-2');
        box.innerHTML = `
            <span>${category}</span>
            <button type="button" class="text-red-500 hover:text-red-700 focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-10.707a1 1 0 00-1.414-1.414L10 8.586 7.707 6.293a1 1 0 00-1.414 1.414L8.586 10l-2.293 2.293a1 1 0 001.414 1.414L10 11.414l2.293 2.293a1 1 0 001.414-1.414L11.414 10l2.293-2.293z" clip-rule="evenodd" />
                </svg>
            </button>
        `;
        categoryContainer.appendChild(box);

        box.querySelector('button').addEventListener('click', function() {
            box.remove();
            if (categorySelect.options.length === 1) {
                showCategoryInput();
            } else {
                showCategorySelect();
            }
        });

        categorySelect.classList.add('hidden');
        categoryInput.classList.add('hidden');
    }

    categorySelect.addEventListener('change', function() {
        if (categorySelect.value === 'add-new') {
            showCategoryInput();
            categoryInput.value = ''
        }
        else{
            categoryInput.value = categorySelect.value;
        }
    });
    categoryInput.addEventListener('input', function() {
        categoryInput.value = capitalizeFirstLetter(categoryInput.value);
    });

    categoryInput.addEventListener('blur', function() {
        if (categoryInput.value.trim() === '') {
            showCategorySelect();
        } else {
            if (validateCategory()) {
                createCategoryBox(categoryInput.value.trim());
            }
        }
    });

    if (categorySelect.options.length === 1) {
        showCategoryInput();
    }
});