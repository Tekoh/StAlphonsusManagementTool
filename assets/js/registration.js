document.addEventListener("DOMContentLoaded", function () {
    const radios = document.querySelectorAll('input[name="formOption"]');
    const forms = document.querySelectorAll("form");

    // Function to hide all forms
    function hideAllForms() {
        forms.forEach(form => form.style.display = "none");
    }
    // Hide all tables initially
    hideAllForms();

    // Add event listener to each radio button
    radios.forEach(radio => {
        radio.addEventListener("change", function () {
            hideAllForms(); // Hide all forms first
            const selectedForm = document.getElementById(this.value);
            if (selectedForm) {
                selectedForm.style.display = "block"; // Show selected form
            }
            localStorage.setItem("selectedFormOption", this.value); // Save selected option
        });
    });

    // Retrieve and apply the saved option
    const savedOption = localStorage.getItem("selectedFormOption");
    if (savedOption) {
        const savedRadio = document.querySelector(`input[name="formOption"][value="${savedOption}"]`);
        if (savedRadio) {
            savedRadio.checked = true;
            savedRadio.dispatchEvent(new Event("change"));
        }
    } else if (radios.length > 0) {
        radios[0].checked = true;
        radios[0].dispatchEvent(new Event("change"));
    }
});