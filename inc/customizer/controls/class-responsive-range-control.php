<?php
/**
 * Responsive Range Control for WordPress Customizer
 *
 * Adds a custom responsive range input for desktop, tablet, and mobile views.
 *
 * @package ArnabWP
 */

namespace ARNABWP_THEME\Inc\Customizer\Controls;

use WP_Customize_Control;

if (class_exists('WP_Customize_Control')) {

    /**
     * Class Responsive_Range_Control
     *
     * Extends WP_Customize_Control to add device-specific range sliders.
     *
     * @package ArnabWP
     */
    class Responsive_Range_Control extends WP_Customize_Control
    {
        /**
         * Control type identifier.
         *
         * @var string
         */
        public $type = 'arnabwp-responsive-range';

        /**
         * Supported responsive devices.
         *
         * @var array
         */
        public $devices = ['desktop', 'tablet', 'mobile'];

        /**
         * Enqueue JS and CSS specific to this control.
         *
         * @return void
         */
        public function enqueue()
        {
            // Load control script
            wp_enqueue_script(
                'arnabwp-customizer-responsive-range',
                ARNABWP_TEMP_DIR_URI . '/assets/js/customizer/customizer-responsive-range.js',
                ['jquery', 'customize-controls'],
                false,
                true
            );

            // Load control styles
            wp_enqueue_style(
                'arnabwp-customizer-responsive-range-style',
                ARNABWP_TEMP_DIR_URI . '/assets/css/customizer/customizer-responsive-range.css'
            );
        }

        /**
         * Render the control UI in the customizer.
         *
         * @return void
         */
        public function render_content()
        {
?>
            <label>
                <!-- Control Title -->
                <span class="customize-control-title"><?php echo esc_html($this->label); ?></span>

                <!-- Optional Description -->
                <?php if ($this->description) : ?>
                    <span class="description customize-control-description"><?php echo esc_html($this->description); ?></span>
                <?php endif; ?>

                <div class="arnabwp-responsive-range-control">

                    <!-- Device Tabs (Desktop / Tablet / Mobile) -->
                    <ul class="device-tabs">
                        <?php foreach ($this->devices as $device) : ?>
                            <li class="device-tab" data-device="<?php echo esc_attr($device); ?>">
                                <span class="dashicons dashicons-<?php echo esc_attr($device === 'desktop' ? 'desktop' : ($device === 'tablet' ? 'tablet' : 'smartphone')); ?>"></span>
                            </li>
                        <?php endforeach; ?>
                    </ul>

                    <!-- Range inputs for each device -->
                    <div class="device-range-inputs">
                        <?php
                        // Decode stored JSON value (per-device values)
                        $values = json_decode($this->value(), true);

                        foreach ($this->devices as $device) :
                            // Get current value or default to empty string
                            $val = isset($values[$device]) ? $values[$device] : '';
                        ?>
                            <div class="device-range-group device-<?php echo esc_attr($device); ?>">
                                <!-- Range Slider -->
                                <input type="range"
                                    min="<?php echo esc_attr($this->input_attrs['min'] ?? 0); ?>"
                                    max="<?php echo esc_attr($this->input_attrs['max'] ?? 100); ?>"
                                    step="<?php echo esc_attr($this->input_attrs['step'] ?? 1); ?>"
                                    value="<?php echo esc_attr($val); ?>"
                                    data-device="<?php echo esc_attr($device); ?>"
                                    class="range-slider"
                                    data-default-value="<?php echo esc_attr($this->input_attrs['default_' . $device] ?? ''); ?>" />

                                <!-- Read-only numeric value display -->
                                <input type="text"
                                    value="<?php echo esc_attr($val); ?>"
                                    class="range-value"
                                    readonly />

                                <!-- Reset Button -->
                                <button
                                    type="button"
                                    class="button button-small arnabwp-range-reset"
                                    data-device="<?php echo esc_attr($device); ?>">
                                    <span style='font-size:18px; color:#db007c'>&#10226;</span>
                                </button>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <!-- Hidden input to store all device values as JSON -->
                    <input type="hidden" <?php $this->link(); ?> value="<?php echo esc_attr($this->value()); ?>" class="responsive-range-hidden" />
                </div>
            </label>
<?php
        }
    }
}
