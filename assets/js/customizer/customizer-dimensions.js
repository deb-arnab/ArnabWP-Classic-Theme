wp.customize.controlConstructor['arnabwp-responsive-dimensions'] = wp.customize.Control.extend({
    ready: function () {
        const control = this;
        const container = this.container;

        console.log('Dimensions control ready');

        const values = JSON.parse(control.setting.get() || '{}');
        console.log('Loaded values:', values);

        // Set input values
        container.find('.dimension-desktop').val(values.desktop || '');
        container.find('.dimension-tablet').val(values.tablet || '');
        container.find('.dimension-mobile').val(values.mobile || '');

        // Handle tab switch
        container.find('.device-tab').on('click', function () {
            const device = jQuery(this).data('device');
            console.log('Switching to device:', device);

            container.find('.device-tab').removeClass('active');
            jQuery(this).addClass('active');

            container.find('.dimension-field').hide();
            container.find('.dimension-' + device).show();
        });

        container.find('.device-tab').first().trigger('click'); // default to first tab

        // Handle input change
        container.find('.dimension-field').on('input', function () {
            const newValues = {
                desktop: container.find('.dimension-desktop').val(),
                tablet: container.find('.dimension-tablet').val(),
                mobile: container.find('.dimension-mobile').val()
            };

            console.log('Saving new values:', newValues);

            control.setting.set(JSON.stringify(newValues));
        });
    }
});