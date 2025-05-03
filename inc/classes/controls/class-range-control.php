<?php

/**
 * Range control class for WordPress Customizer
 *
 * This class adds a custom range slider control with an associated numeric value display and reset button.
 * It extends the default WP_Customize_Control to provide additional UI components for range input.
 *
 * @package ArnabWP
 */

namespace ARNABWP_THEME\Inc\Controls;

use WP_Customize_Control;

// Ensure WP_Customize_Control exists before extending it
if (class_exists('WP_Customize_Control')) {

    /**
     * Custom range slider control class
     */
    class Range_Control extends WP_Customize_Control
    {

        // Define the control type
        public $type = 'arnabwp-range';

        /**
         * Enqueue custom scripts and styles required for the range control
         */
        public function enqueue()
        {
            // Enqueue the custom JavaScript file for range control behavior
            wp_enqueue_script(
                'arnabwp-customizer-range',
                ARNABWP_TEMP_DIR_URI . '/assets/js/customizer/customizer-range.js',
                ['jquery', 'customize-controls'],
                false,
                true
            );

            // Enqueue the custom CSS styles for the range control
            wp_enqueue_style(
                'arnabwp-customizer-range-style',
                ARNABWP_TEMP_DIR_URI . '/assets/css/customizer/customizer-range.css'
            );
        }

        /**
         * Render the HTML content for the control
         */
        public function render_content()
        {
?>
            <label>
                <?php if (! empty($this->label)) : ?>
                    <!-- Display the control's label -->
                    <span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
                <?php endif; ?>

                <!-- Main container for the range control elements -->
                <div class="arnabwp-range-control">

                    <!-- Range slider input -->
                    <input
                        type="range"
                        class="arnabwp-range-slider"
                        id="<?php echo esc_attr($this->id); ?>_range"
                        value="<?php echo esc_attr($this->value()); ?>"
                        data-default-value="<?php echo esc_attr($this->setting->default); ?>"
                        min="<?php echo esc_attr($this->input_attrs['min']); ?>"
                        max="<?php echo esc_attr($this->input_attrs['max']); ?>"
                        step="<?php echo esc_attr($this->input_attrs['step']); ?>"
                        <?php $this->link(); ?> />

                    <!-- Readonly input to display current range value -->
                    <input
                        type="text"
                        id="<?php echo esc_attr($this->id); ?>_value"
                        value="<?php echo esc_attr($this->value()); ?>"
                        readonly
                        class="arnabwp-range-value" />

                    <!-- Button to reset range value to default -->
                    <button
                        type="button"
                        class="button button-small arnabwp-range-reset"
                        id="<?php echo esc_attr($this->id); ?>_reset">
                        <span style='font-size:18px; color:#db007c'>&#10226;</span>
                    </button>
                </div>
            </label>
<?php
        }
    }
}
