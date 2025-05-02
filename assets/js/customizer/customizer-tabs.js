/**
 * Handles tab navigation interaction.
 * 
 * Binds click events to tab navigation list items inside the `.arnabwp-tab-nav` class.
 * When a tab is clicked, it sets the clicked tab as active and updates a hidden input's value.
 * 
 * @requires jQuery
 */
jQuery(document).ready(function($) {
  
	/**
	 * On click of a tab item inside .arnabwp-tab-nav:
	 * - Activates the selected tab
	 * - Deactivates other tabs
	 * - Updates a hidden input field with the selected tab's value
	 */
	$('.arnabwp-tab-nav li').on('click', function() {
	  const $tab = $(this); // The clicked tab
	  const value = $tab.data('tab'); // The data-tab value
	  const $control = $tab.closest('.arnabwp-tab-control'); // Container holding the tab control
  
	  console.log("Tab clicked:", value);
  
	  $control.find('li').removeClass('active'); // Remove active class from all tabs
	  $tab.addClass('active'); // Add active class to clicked tab
  
	  $control.find('input[type="hidden"]').val(value).trigger('change'); // Update hidden input with selected tab value
	});
  });