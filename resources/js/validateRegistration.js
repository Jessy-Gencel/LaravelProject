const validateRegistration = () =>{
    document.addEventListener('DOMContentLoaded', () => {
        const usernameField = document.getElementById('username');
        const emailField = document.getElementById('email');
        const passwordField = document.getElementById('password');
        const confirmPasswordField = document.getElementById('password_confirmation');
        function validateField(field, isValid, message) {
            if (isValid) {
                field.classList.remove('border-red-600');
                field.classList.add('border-gray-600');
                if (field.nextElementSibling) field.nextElementSibling.remove();
            } else {
                field.classList.remove('border-gray-600');
                field.classList.add('border-red-600');
                if (!field.nextElementSibling) {
                    const errorDiv = document.createElement('div');
                    errorDiv.classList.add('text-red-600', 'text-sm', 'mt-1');
                    errorDiv.textContent = message;
                    field.parentNode.appendChild(errorDiv);
                }
            }
        }
        if (usernameField) {
            usernameField.addEventListener('blur', () => {
                const isValid = usernameField.value.length >= 3 && usernameField.value.length <= 50;
                validateField(usernameField, isValid, 'Username must be between 3 and 50 characters.');
            });
        }
        emailField.addEventListener('blur', () => {
            const isValid = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(emailField.value);
            validateField(emailField, isValid, 'Please enter a valid email address.');
        });
        passwordField.addEventListener('blur', () => {
            const isValid = /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&]).{8,}$/.test(passwordField.value);
            validateField(passwordField, isValid, 'Password must be at least 8 characters and include upper/lowercase letters, a number, and a special character.');
        });
        confirmPasswordField.addEventListener('blur', () => {
            const isValid = confirmPasswordField.value === passwordField.value;
            validateField(confirmPasswordField, isValid, 'Passwords do not match.');
        });
    });
}
validateRegistration();

