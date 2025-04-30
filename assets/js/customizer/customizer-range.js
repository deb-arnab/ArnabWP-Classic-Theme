/**
 * Syncs range sliders with corresponding text inputs for live value display.
 * 
 * @file Customizer Range Slider Script
 * @requires jQuery
 */

jQuery(document).ready(function ($) {
    /**
     * Handles range input sliders with matching text input fields.
     * Automatically updates the text input when the range slider changes.
     */
    $('.arnabwp-range-slider').each(function () {
        var rangeInput = $(this);
        var id = rangeInput.attr('id').replace('_range', ''); // Base ID to find related text input
        var valueInput = $('#' + id + '_value'); // Matching text input

        // Update text input value as the slider moves
        rangeInput.on('input change', function () {
            valueInput.val($(this).val());
        });
    });
});



jQuery(document).ready(function ($) {
    /**
     * Updates the text input value based on the given range slider value.
     * 
     * @param {jQuery} range - The range input element.
     * @param {jQuery} value - The text input element to sync with the slider.
     */
    function updateSliderValue(range, value) {
        value.val(range.val());
    }

    /**
     * Resets the range slider and text input to their default value.
     * 
     * @param {jQuery} range - The range input element.
     * @param {jQuery} value - The text input element to reset.
     */
    function resetSlider(range, value) {
        var defaultValue = range.data('default-value'); // Get default value from data attribute
        range.val(defaultValue).trigger('input');
        value.val(defaultValue).trigger('input');
        range.change(); // Trigger change for live preview update in the Customizer
    }

    /**
     * Initializes each range control block.
     * Syncs range and text input values, and handles reset button functionality.
     */
    $('.arnabwp-range-control').each(function () {
        var range = $(this).find('input[type="range"]'); // The range slider
        var value = $(this).find('input[type="text"]'); // Associated text input
        var reset = $(this).find('button'); // Reset button

        // Set initial text input value
        updateSliderValue(range, value);

        // Update text input when slider changes
        range.on('input change', function () {
            updateSliderValue(range, value);
        });

        // Reset to default on button click
        reset.on('click', function () {
            resetSlider(range, value);
        });
    });
});