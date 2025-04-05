document.addEventListener("DOMContentLoaded", () => {
    const form = document.querySelector(".form");
    const errorMessageContainer = document.getElementById("errormessage");
    const alertBox = document.querySelector(".erroralert");

    const fields = {
        fname: {
            element: form.querySelector("input[name='fname']"),
            validate: (value) => /^[a-zA-Z]{4,}$/.test(value),
            errorMessage: "First name must be at least 4 alphabets long and contain no numbers or special characters."
        },
        sname: {
            element: form.querySelector("input[name='sname']"),
            validate: (value) => /^[a-zA-Z]{4,}$/.test(value),
            errorMessage: "Last name must be at least 4 alphabets long and contain no numbers or special characters."
        },
        username: {
            element: form.querySelector("input[name='username']"),
            validate: (value) => value.length >= 4,
            errorMessage: "Username must be at least 4 characters long."
        },
        person_id: {
            element: form.querySelector("input[name='person_id']"),
            validate: (value) => /^P-00/.test(value),
            errorMessage: "Person ID must start with 'P-00'."
        },
        password: {
            element: form.querySelector("input[name='password']"),
            validate: (value) => /(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{1,}/.test(value),
            errorMessage: "Password must contain at least 1 uppercase letter, 1 lowercase letter, 1 number, and 1 special character."
        },
        reppassword: {
            element: form.querySelector("input[name='reppassword']"),
            validate: (value) => value === form.querySelector("input[name='password']").value,
            errorMessage: "Passwords do not match."
        }
    };

    // Add real-time validation for each field
    Object.values(fields).forEach(({ element, validate, errorMessage }) => {
        element.addEventListener("input", () => {
            const value = element.value.trim();
            if (!validate(value)) {
                errorMessageContainer.textContent = errorMessage;
                errorMessageContainer.style.display = "block";
                alertBox.style.display = "block";
            } else {
                errorMessageContainer.textContent = "";
                errorMessageContainer.style.display = "none";
                alertBox.style.display = "none";
            }
        });
    });

    // Prevent form submission if there are errors
    form.addEventListener("submit", (event) => {
        let hasError = false;

        Object.values(fields).forEach(({ element, validate, errorMessage }) => {
            const value = element.value.trim();
            if (!validate(value)) {
                hasError = true;
                errorMessageContainer.textContent = errorMessage;
                errorMessageContainer.style.display = "block";
                alertBox.style.display = "block";
            }
        });

        if (hasError) {
            event.preventDefault();
        }
    });
});