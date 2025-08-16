document
    .querySelector("#signup_form")
    .addEventListener("submit", async (event) => {
        event.preventDefault();

        console.log("yes");

        const form = event.target;
        const data = {
            name: form.name.value,
            email: form.email.value,
            password: form.password.value,
        };

        console.log(data);

        try {
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

            console.log(response);

            if (response.ok) {
                const res = await response.json();
                window.location.href = "/dashboard";
            } else {
                const errorData = await response.json();
                document.querySelector(".err.name").innerHTML =
                    errorData.errors.name[0];
                document.querySelector(".err.email").innerHTML =
                    errorData.errors.email[0];
                document.querySelector(".err.password").innerHTML =
                    errorData.errors.password[0];
            }
        } catch (error) {}
    });
