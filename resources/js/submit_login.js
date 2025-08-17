document
    .querySelector("#login_form")
    .addEventListener("submit", async (event) => {
        event.preventDefault();

        const form = event.target;
        const submitButton = form.querySelector("button[type='submit']");
        const indicator = form.querySelector(".indicator");

        const data = {
            email: form.email.value,
            password: form.password.value,
        };

        document.querySelector(".err.email").innerHTML = '';
        document.querySelector(".err.password").innerHTML = '';

        try {

            submitButton.disabled = true;
            indicator.classList.remove("hidden");
            submitButton.classList.remove("bg-gray-800");
            submitButton.classList.add("bg-gray-400", "cursor-not-allowed");

            const response = await fetch("/login", {
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
                const res = await response.json();
                window.location.href = "/dashboard";
            } else {
                const errorData = await response.json();
                document.querySelector(".err.email").innerHTML = errorData.errors.email[0];
                document.querySelector(".err.password").innerHTML = errorData.errors.password[0];
            }
        } catch (error) {
            console.error("Login failed:", error);
        } finally {
            submitButton.disabled = false;
            indicator.classList.add("hidden");
            submitButton.classList.remove("bg-gray-400", "cursor-not-allowed");
            submitButton.classList.add("bg-gray-800");
        }
    });
