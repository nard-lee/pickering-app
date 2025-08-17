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

        // Clear previous errors
        document.querySelector(".err.name").textContent = "";
        document.querySelector(".err.email").textContent = "";
        document.querySelector(".err.password").textContent = "";

        try {
            // Disable button and show loading
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
                const errorData = await response.json();
                document.querySelector(".err.name").textContent = errorData.errors?.name?.[0]     || "";
                document.querySelector(".err.email").textContent = errorData.errors?.email?.[0]    || "";
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
