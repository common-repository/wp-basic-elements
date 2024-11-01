// Select all H2 elements with the class "toggle-table"
const toggleTables = document.querySelectorAll('.settings_page_wpbe_settings_page form h2');

// Check if there are any H2 elements with the class "toggle-table"
if (toggleTables.length > 0) {
   // Loop over all H2 elements with the class "toggle-table"
   toggleTables.forEach((h2, index) => {

      // Add a click event listener to each H2 element
      h2.addEventListener('click', () => {

         // Select the table element that comes immediately after the clicked H2 element
         const table = h2.nextElementSibling;

         // Select all table elements that are currently visible
         const otherTables = document.querySelectorAll('table.show-table');

         // Select all H2 elements except for the one that was clicked
         const otherH2s = document.querySelectorAll('.settings_page_wpbe_settings_page form h2:not(:nth-of-type(' + (index + 1) + '))');

         // Hide all other visible table elements
         otherTables.forEach(table => {
            if (table !== h2.nextElementSibling) {
               table.classList.remove('show-table');
            }
         });

         // Remove the "animate-margin-top" class from all other H2 elements and reset icon rotation
         otherH2s.forEach(otherH2 => {
            otherH2.classList.remove('animate-margin-top');
            otherH2.querySelector('.section-head-icon').classList.remove('rotate-icon');
         });

         // Toggle the visibility of the target table element
         table.classList.toggle('show-table');

         // Toggle the section head icon
         h2.querySelector('.section-head-icon').classList.toggle('rotate-icon');

         // Apply margin-top animation to the clicked H2 element
         if (index !== 0) {
            if (!h2.classList.contains('animate-margin-top')) {
               h2.classList.add('animate-margin-top');
            } else {
               h2.classList.remove('animate-margin-top');
            }
         }
      });

      // Add a double-click event listener to each H2 element
      h2.addEventListener('dblclick', () => {
         // Select the table element that comes immediately after the clicked H2 element
         const table = h2.nextElementSibling;

         // Toggle the visibility of the target table element
         table.classList.toggle('show-table');
      });
   });
}