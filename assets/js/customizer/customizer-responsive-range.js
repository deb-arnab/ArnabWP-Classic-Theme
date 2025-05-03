jQuery(document).ready(function ($) {
    $('.arnabwp-responsive-range-control').each(function () {
      const $control = $(this);
      const $hidden = $control.find('.responsive-range-hidden');
      const initial = JSON.parse($hidden.val() || '{}');
  
      const updateHiddenValue = () => {
        let values = {};
        $control.find('.range-slider').each(function () {
          const device = $(this).data('device');
          values[device] = $(this).val();
        });
        $hidden.val(JSON.stringify(values)).trigger('change');
      };
  
      // Sync slider and text input
      $control.find('.range-slider').on('input', function () {
        const val = $(this).val();
        $(this).siblings('.range-value').val(val);
        updateHiddenValue();
      });
  
      // Tab switcher
      $control.find('.device-tab').on('click', function () {
        const device = $(this).data('device');
  
        // Highlight tab
        $control.find('.device-tab').removeClass('active');
        $(this).addClass('active');
  
        // Show only current device's range group
        $control.find('.device-range-group').hide();
        $control.find('.device-' + device).show();
      });
  
      // Init: show desktop by default
      $control.find('.device-tab[data-device="desktop"]').click();
    });
  });
  
  wp.customize.bind('preview-ready', function () {
    wp.customize.preview.bind('device', function (device) {
        console.log('Customizer preview changed to:', device);

        // Optional: highlight selected range input for device
        jQuery('.arnabwp-range-control').removeClass('active-desktop active-tablet active-mobile');
        jQuery('.arnabwp-range-control').addClass('active-' + device);
        
        // Optionally, you can show/hide different range sliders for each device if you use per-device controls
    });
});

jQuery(document).ready(function ($) {
  $('.arnabwp-responsive-range-control').each(function () {
    const $control = $(this);
    const $hidden = $control.find('.responsive-range-hidden');

    // Attach reset event
    $control.find('.arnabwp-range-reset').on('click', function () {
      // Find active device
      const activeDevice = $control.find('.device-tab.active').data('device');
      const $range = $control.find('.device-' + activeDevice + ' input[type="range"]');
      const $value = $control.find('.device-' + activeDevice + ' input[type="text"]');
      
      // Get default value from range input
      const defaultVal = $range.data('default-value');

      if (typeof defaultVal !== 'undefined') {
        $range.val(defaultVal).trigger('input');
        $value.val(defaultVal).trigger('input');
      }

      // Update hidden field for Customizer
      let values = {};
      $control.find('.range-slider').each(function () {
        const device = $(this).data('device');
        values[device] = $(this).val();
      });
      $hidden.val(JSON.stringify(values)).trigger('change');
    });
  });
});