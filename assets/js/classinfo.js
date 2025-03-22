document.addEventListener("DOMContentLoaded", function () {
    const radios = document.querySelectorAll('input[name="tableOption"]');
    const tables = document.querySelectorAll("table");

    // Function to hide all tables
    function hideAllTables() {
        tables.forEach(table => table.style.display = "none");
    }
    // Hide all tables initially
    hideAllTables();

    // Add event listener to each radio button
    radios.forEach(radio => {
        radio.addEventListener("change", function () {
            hideAllTables(); // Hide all tables first
            const selectedTable = document.getElementById(this.value);
            if (selectedTable) {
                selectedTable.style.display = "table"; // Show selected table
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