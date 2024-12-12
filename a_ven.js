document.addEventListener("DOMContentLoaded", function() {
    const newvenue = document.getElementById("AddNew");
    const reservationForm = document.getElementById("NEWVenue-form");
    
    newvenue.addEventListener("click", function(event) {
        const buttonRect = event.target.getBoundingClientRect();
        const formTop = buttonRect.top + window.scrollY + 10; // Adjust offset as needed
        reservationForm.style.top = `${formTop}px`; // Use backticks for template literals
        reservationForm.style.display = "block";
    });
  
    const closeFormButton = document.querySelector(".close-form-icon");
    closeFormButton.addEventListener("click", function(event) {
        event.preventDefault(); // Add event parameter
        reservationForm.style.display = "none";
    });

    function submit() {
        document.getElementById('NEWVenue-form').submit();
    }
  
    window.submit = submit;
});
