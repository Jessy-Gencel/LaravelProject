document.addEventListener('DOMContentLoaded', function() {
    function toggleEdit(name) {
        var displayElement = document.getElementById('display-' + name);
        var inputElement = document.getElementById('input-' + name);
        
        if (displayElement.style.display === 'none') {
            displayElement.style.display = 'block';
            inputElement.style.display = 'none';
        } else {
            displayElement.style.display = 'none';
            inputElement.style.display = 'block';
            inputElement.focus();
        }
    }

    function validateInput(name) {
        var input = document.getElementById('input-' + name);
        var errorMessage = '';
        var isValid = true;

        if (input.classList.contains('username')) {
            isValid = input.value.length >= 3 && input.value.length <= 50;
            errorMessage = 'Username must be between 3 and 50 characters.';
        } else if (input.classList.contains('email')) {
            isValid = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(input.value);
            errorMessage = 'Please enter a valid email address.';
        } else if (input.classList.contains('password')) {
            isValid = /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&]).{8,}$/.test(input.value);
            errorMessage = 'Password must be at least 8 characters and include upper/lowercase letters, a number, and a special character.';
        } else if (input.classList.contains('password_confirmation')) {
            var passwordField = document.getElementById('input-password');
            isValid = input.value === passwordField.value;
            errorMessage = 'Passwords do not match.';
        }

        var existingErrorDiv = input.nextElementSibling;
        if (existingErrorDiv && existingErrorDiv.classList.contains('error-message')) {
            existingErrorDiv.remove();
        }

        if (!isValid) {
            var errorDiv = document.createElement('div');
            errorDiv.classList.add('error-message', 'text-red-600', 'text-sm', 'mt-1');
            errorDiv.textContent = errorMessage;
            input.parentNode.insertBefore(errorDiv, input.nextSibling);
        }

        return isValid;
    }

    function saveInput(name) {
        var displayElement = document.getElementById('display-' + name);
        var inputElement = document.getElementById('input-' + name);
        
        if (validateInput(name)) {
            displayElement.style.borderColor = 'green'; 
            displayElement.style.borderWidth = '2px';
            displayElement.style.borderStyle = 'solid';
            displayElement.innerText = inputElement.value;
            displayElement.style.display = 'block';
            inputElement.style.display = 'none';
        } else {
            displayElement.style.borderColor = 'red';
            displayElement.style.borderWidth = '2px';
            displayElement.style.borderStyle = 'solid';
        }
    }

    document.querySelectorAll('input[id^="input-"], textarea[id^="input-"]').forEach(input => {
        input.addEventListener('keydown', function(event) {
            if (event.key === 'Enter' && !event.shiftKey) {
                saveInput(input.name);
            }
        });

        input.addEventListener('blur', function() {
            saveInput(input.name);
        });
    });

    document.querySelectorAll('[id^="display-"]').forEach(display => {
        display.addEventListener('click', function() {
            toggleEdit(display.id.replace('display-', ''));
        });
    });

    document.querySelectorAll('a[id^="editButton-"]').forEach(button => {
        button.addEventListener('click', function(event) {
            event.preventDefault();
            var name = button.id.replace('editButton-', '');
            toggleEdit(name);
        });
    });
});