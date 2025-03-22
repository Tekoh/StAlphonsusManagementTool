document.addEventListener("DOMContentLoaded", function () {
    const radios = document.querySelectorAll('input[name="tableOption"]');
    const hiddenElements = document.querySelectorAll(".notinuse");

    // Function to hide all elements with class 'notinuse'
    function hideAllHiddenElements() {
        hiddenElements.forEach(element => element.style.display = "none");
    }
    // Hide all tables initially
    hideAllHiddenElements();

    // Add event listener to each radio button
    radios.forEach(radio => {
        radio.addEventListener("change", function () {
            hideAllHiddenElements(); // Hide all hidden elements first
            const selectedElement = document.getElementById(this.value);
            if (selectedElement) {
                selectedElement.style.display = "block"; // Show selected element
            }
            localStorage.setItem('selectedTableOption', this.value); // Save selected option
        });
    });

    // Retrieve and apply the saved radio button state
    const savedOption = localStorage.getItem('selectedTableOption');
    if (savedOption) {
        const savedRadio = document.querySelector(`input[name="tableOption"][value="${savedOption}"]`);
        if (savedRadio) {
            savedRadio.checked = true;
            savedRadio.dispatchEvent(new Event("change"));
        }
    } else if (radios.length > 0) {
        radios[0].checked = true;
        radios[0].dispatchEvent(new Event("change"));
    }
});