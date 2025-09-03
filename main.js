
document.addEventListener("DOMContentLoaded", () => {
    // Loads the current year
    const yearElement = document.getElementById("year");
    if (yearElement) {
        yearElement.textContent = new Date().getFullYear();
    }
});