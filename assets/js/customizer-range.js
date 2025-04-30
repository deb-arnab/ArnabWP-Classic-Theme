jQuery(document).ready(function ($) {
    $('.arnabwp-range-slider').each(function () {
        var rangeInput = $(this);
        var id = rangeInput.attr('id').replace('_range', '');
        var valueInput = $('#' + id + '_value');

        rangeInput.on('input change', function () {
            valueInput.val($(this).val());
        });
    });
});



jQuery(document).ready(function ($) {
    // Function to update the value of text input based on the range slider
    function updateSliderValue(range, value) {
        value.val(range.val());
    }

    // Function to reset to default value
    function resetSlider(range, value) {
        var defaultValue = range.data('default-value'); // Get the default value from data attribute
        range.val(defaultValue).trigger('input');
        value.val(defaultValue).trigger('input');
        range.change(); // Trigger change for live preview update
    }

    // Handle each slider with different customizations
    $('.arnabwp-range-control').each(function() {
        var range = $(this).find('input[type="range"]');
        var value = $(this).find('input[type="text"]');
        var reset = $(this).find('button');

        // Set initial value of the text input based on the range slider
        updateSliderValue(range, value);

        // Update the text field when range moves
        range.on('input change', function() {
            updateSliderValue(range, value);
        });

        // Reset to default value when reset button is clicked
        reset.on('click', function() {
            resetSlider(range, value);
        });
    });
});