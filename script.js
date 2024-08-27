document.addEventListener('DOMContentLoaded', function() {
    const passwordInput = document.getElementById('password');
    const requirements = {
        length: document.getElementById('length'),
        uppercase: document.getElementById('uppercase'),
        lowercase: document.getElementById('lowercase'),
        number: document.getElementById('number'),
        special: document.getElementById('special')
    };

    function checkPassword(password) {
        const checks = {
            length: password.length >= 8,
            uppercase: /[A-Z]/.test(password),
            lowercase: /[a-z]/.test(password),
            number: /\d/.test(password),
            special: /[!@#$%^&*(),.?":{}|<>]/.test(password)
        };

        for (let req in checks) {
            if (checks[req]) {
                requirements[req].classList.add('valid');
            } else {
                requirements[req].classList.remove('valid');
            }
        }

        return Object.values(checks).every(Boolean);
    }

    passwordInput.addEventListener('input', function() {
        checkPassword(this.value);
    });

    document.getElementById('registerForm').addEventListener('submit', function(e) {
        if (!checkPassword(passwordInput.value)) {
            e.preventDefault();
            alert('Please meet all password requirements before submitting.');
        }
    });
});