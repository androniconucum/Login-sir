![pics](https://github.com/user-attachments/assets/fa82625f-c4bb-4c67-9d11-4202e7f55474)
code for new js  - - -- - -- -- -  document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('registerForm');

    form.addEventListener('submit', function(e) {
        e.preventDefault();
        alert("Form submitted!"); // Confirm form submission

        const username = document.querySelector('input[name="username"]').value; // Ensure this selector is correct
        const password = document.querySelector('input[name="password"]').value; // Ensure this selector is correct

        const formData = new FormData(form);

        fetch('register.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            alert(data.message); // Show response message
        });
    });
});
