document.addEventListener("DOMContentLoaded", function () {
    // Creating variables for the radio buttons and tables
    const radios = document.querySelectorAll('input[name="radio"]');
    const tables = document.querySelectorAll(".user-table");
    // Loop through each radio button
    radios.forEach(radio => {
        // Add a change event listener to handle when a radio button is selected
        radio.addEventListener("change", function () {
            // Hide all tables
            tables.forEach(table => {
                table.style.display = "none";
            });
            // Show the table whose ID matches the value of the selected radio button
            document.getElementById(this.value + "Table").style.display = "table";
        });
    });
});
