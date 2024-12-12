document.addEventListener('DOMContentLoaded', function () {
  // Initialize date and time pickers
  flatpickr("#event-date", {
      altInput: true,
      altFormat: "F j, Y",
      dateFormat: "Y-m-d",
      defaultDate: new Date(), // Set default date to today
      onChange: fetchVenues // Call fetchVenues on date change

  });

  flatpickr("#event-time", {
      enableTime: true,
      noCalendar: true,
      dateFormat: "h:i K",
      altInput: true,
      altFormat: "h:i K",
      time_24hr: false,
      defaultDate: roundToNext30Minutes(),
            minuteIncrement: 30,
      onChange: fetchVenues, // Call fetchVenues on time change
      formatDate: function (date, format, locale) {
        // Custom formatting function to add leading zeros
        let hours = date.getHours();
        let minutes = date.getMinutes();
        const ampm = hours >= 12 ? 'PM' : 'AM';
        hours = hours % 12;
        hours = hours ? hours : 12; // the hour '0' should be '12'
        const formattedTime = `${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')} ${ampm}`;
        return formattedTime;

      }
  });

  // Initial call to fetch venues
  fetchVenues();

  // Add event listeners to reserve buttons
  addEventListenersToReserveButtons();
});

document.getElementById('event-date').addEventListener('change', fetchVenues);
document.getElementById('event-time').addEventListener('change', fetchVenues);

function convertTo24HourFormat(time12h) {
  const [time, modifier] = time12h.split(' ');

  let [hours, minutes] = time.split(':');
  hours = parseInt(hours, 10);
  minutes = parseInt(minutes, 10);

  if (modifier === 'PM' && hours !== 12) {
      hours += 12;
  }
  if (modifier === 'AM' && hours === 12) {
      hours = 0;
  }

  // Format to HH:mm:ss
  const hoursStr = hours.toString().padStart(2, '0');
  const minutesStr = minutes.toString().padStart(2, '0');
  return `${hoursStr}:${minutesStr}:00`;
}

function fetchVenues() {
  const eventDate = document.getElementById('event-date').value;
  const eventTime12h = document.getElementById('event-time').value;
  const eventTime = convertTo24HourFormat(eventTime12h);

  if (eventDate && eventTime) {
      const xhr = new XMLHttpRequest();
      xhr.open('GET', `fetch_venue.php?eventdate=${eventDate}&eventtime=${eventTime}`, true);
      xhr.onload = function () {
          if (xhr.status === 200) {
              document.getElementById('venues-container').innerHTML = xhr.responseText;
              addEventListenersToReserveButtons(); // Re-attach event listeners to new buttons
          } else {
              console.error("Failed to fetch venues");
          }
      };
      xhr.send();
  }
}

const confirmationModal = document.getElementById('confirmation-modal');
function addEventListenersToReserveButtons() {
  const reserveButtons = document.querySelectorAll('.reserve-btn');
  const reservationForm = document.getElementById('reservation-form');
  const reservationVenueName = document.getElementById('reservation-venue-name');

  reserveButtons.forEach(button => {
      button.addEventListener('click', () => {
          const venueName = button.getAttribute('data-venue-name');
          reservationVenueName.textContent = `${venueName}`;
          reservationForm.style.display = 'block';
          const venueId = button.getAttribute('data-venue-id');
          document.getElementById('hidden-venue-id').value = venueId;
      });
  });

  const closeIcon = document.querySelector('.close-form-icon');
  if (closeIcon) {
      closeIcon.addEventListener('click', () => {
          reservationForm.style.display = 'none';
          document.getElementById('reservation-form-data').reset();
      });
  }
}

function submitForm(event) {
  event.preventDefault(); // Prevent the form from submitting normally

  // Get form data
  var formData = new FormData(document.getElementById('reservation-form-data'));

  // Send AJAX request
  var xhr = new XMLHttpRequest();
  xhr.open('POST', 'reserve_form.php', true);
  xhr.onload = function () {
      if (xhr.status === 200) {
          // Show confirmation modal
          confirmationModal.style.display = 'block';
          // Clear form fields if needed
          document.getElementById('reservation-form-data').reset();
          // Refresh the venues to disable the reserved button
          fetchVenues();
      } else {
          // Handle errors
          alert("Error: " + xhr.responseText);
      }
  };
  xhr.send(formData);
}

const closeConfirmation = document.querySelector('.close');
if (closeConfirmation) {
  closeConfirmation.addEventListener('click', () => {
      confirmationModal.style.display = 'none';
  });
}
  

function roundToNext30Minutes() {
  const now = new Date();
  const minutes = now.getMinutes();
  const roundedMinutes = (Math.ceil(minutes / 30) * 30) % 60;
  now.setMinutes(roundedMinutes, 0, 0);
  return now;
}

flatpickr("#start-time", {
  enableTime: true,
  noCalendar: true,
  dateFormat: "h:i K", // Display format (12-hour)
  minuteIncrement: 30,
  altInput: true,
  altFormat: "h:i K",
  time_24hr: false, // Display format (12-hour)
  onChange: function (selectedDates, dateStr, instance) {
      // Get the selected date
      const selectedDate = selectedDates[0];
      if (selectedDate) {
          // Get hours and minutes
          const hours = selectedDate.getHours();
          const minutes = selectedDate.getMinutes();
          // Format hours and minutes to 24-hour format
          const formattedTime = `${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}:00`;
          // Set the value of the hidden input
          document.getElementById('hidden-start-time').value = formattedTime;
      }
  },
  formatDate: function (date, format, locale) {
    // Custom formatting function to add leading zeros
    let hours = date.getHours();
    let minutes = date.getMinutes();
    const ampm = hours >= 12 ? 'PM' : 'AM';
    hours = hours % 12;
    hours = hours ? hours : 12; // the hour '0' should be '12'
    const formattedTime = `${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')} ${ampm}`;
    return formattedTime;

  }
});
flatpickr("#date", { 
  altInput: true,
  altFormat: "F j, Y",
  dateFormat: "Y-m-d",
  });
flatpickr("#end-time", {
  enableTime: true,
  noCalendar: true,
  dateFormat: "h:i K", // Display format (12-hour)
  minuteIncrement: 30,
  altInput: true,
  altFormat: "h:i K",
  time_24hr: false, // Display format (12-hour)
  onChange: function (selectedDates, dateStr, instance) {
      // Get the selected date
      const selectedDate = selectedDates[0];
      if (selectedDate) {
          // Get hours and minutes
          const hours = selectedDate.getHours();
          const minutes = selectedDate.getMinutes();
          // Format hours and minutes to 24-hour format
          const formattedTime = `${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}:00`;
          // Set the value of the hidden input
          document.getElementById('hidden-end-time').value = formattedTime;
      }
  },
  formatDate: function (date, format, locale) {
    // Custom formatting function to add leading zeros
    let hours = date.getHours();
    let minutes = date.getMinutes();
    const ampm = hours >= 12 ? 'PM' : 'AM';
    hours = hours % 12;
    hours = hours ? hours : 12; // the hour '0' should be '12'
    const formattedTime = `${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')} ${ampm}`;
    return formattedTime;

  }
});

//search js
// Function to filter venues based on the search input
  const searchInput = document.getElementById('searchInput');

  searchInput.addEventListener('input', handleSearch);

  function handleSearch() {
    const searchValue = searchInput.value.toLowerCase();
    const venueCards = document.querySelectorAll('.venue_card');
    let anyResultsFound = false;

    venueCards.forEach(card => {
      const venueNameElement = card.querySelector('.venue-name');
      if (venueNameElement && venueNameElement.textContent) {
        const venueName = venueNameElement.textContent.toLowerCase();
        if (venueName.includes(searchValue)) {
          card.style.display = 'block';
          anyResultsFound = true;
        } else {
          card.style.display = 'none';
        }
      }
    });

    const noResultsMessage = document.getElementById('no-results-message');
    if (anyResultsFound) {
      noResultsMessage.classList.add('hidden');
    } else {
      noResultsMessage.classList.remove('hidden');
    }
  }




