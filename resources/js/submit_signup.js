
document.addEventListener('DOMContentLoaded', function() {
  
    const togglePassword = document.getElementById('togglePassword');
    const passwordField = document.getElementById('password');
    
    if (togglePassword && passwordField) {
        togglePassword.addEventListener('click', function() {
            const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordField.setAttribute('type', type);
            const icon = this.querySelector('i');
            icon.className = type === 'password' ? 'fas fa-eye' : 'fas fa-eye-slash';
        });
    }
    
    const password = document.getElementById('password');
    const strengthIndicator = document.getElementById('passwordStrength');
    
    if (password && strengthIndicator) {
        password.addEventListener('input', (event)=> {
            const value = event.target.value;
            const strength = calculatePasswordStrength(value);

            if (strength === 0) {
                strengthIndicator.textContent = '';
            } else if (strength <= 2) {
                strengthIndicator.textContent = 'weak';
            } else if (strength <= 4) {
                strengthIndicator.textContent = 'medium';
            } else {
                strengthIndicator.textContent = 'strong';
            }
        });
    }
    
    function calculatePasswordStrength(password) {
        let strength = 0;
        if (password.length >= 8) strength++;
        if (/[a-z]/.test(password)) strength++;
        if (/[A-Z]/.test(password)) strength++;
        if (/[0-9]/.test(password)) strength++;
        if (/[^A-Za-z0-9]/.test(password)) strength++;
        return strength;
    }
    
    const confirmPassword = document.getElementById('confirmPassword');
    const confirmError = document.querySelector('.err.confirmPassword');
    
    if (confirmPassword && confirmError) {
        confirmPassword.addEventListener('input', function() {
            if (password.value && this.value && password.value !== this.value) {
                confirmError.textContent = 'Passwords do not match';
            } else {
                confirmError.textContent = '';
            }
        });
    }

    document
    .querySelector("#signup_form")
    .addEventListener("submit", async (event) => {
        event.preventDefault();

        const form = event.target;
        const submitButton = form.querySelector("button[type='submit']");
        const indicator = form.querySelector(".indicator");
        const data = {
            name: form.name.value,
            email: form.email.value,
            password: form.password.value,
        };

        document.querySelector(".err.name").textContent = "";
        document.querySelector(".err.email").textContent = "";
        document.querySelector(".err.password").textContent = "";

        try {
            submitButton.disabled = true;
            indicator.classList.remove("hidden");
            submitButton.classList.remove("bg-gray-800");
            submitButton.classList.add("bg-gray-400", "cursor-not-allowed");

            const response = await fetch("/signup", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    Accept: "application/json",
                    "X-CSRF-TOKEN": document.querySelector(
                        'meta[name="csrf-token"]'
                    ).content,
                },
                body: JSON.stringify(data),
            });

            if (response.ok) {
                window.location.href = "/dashboard";
            } else {
                document.querySelector(".err.name").textContent = errorData.errors?.name?.[0] || "";
                document.querySelector(".err.email").textContent = errorData.errors?.email?.[0] || "";
                document.querySelector(".err.password").textContent = errorData.errors?.password?.[0] || "";
            }
        } catch (error) {
            console.error("Signup failed:", error);
        } finally {
            submitButton.disabled = false;
            indicator.classList.add("hidden");
            submitButton.classList.remove("bg-gray-400", "cursor-not-allowed");
            submitButton.classList.add("bg-gray-800");
        }
    });

});

