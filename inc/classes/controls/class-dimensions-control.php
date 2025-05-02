<?php
/**
 * Responsive Dimensions control class for WordPress Customizer
 *
 * @package ArnabWP
 */

namespace ARNABWP_THEME\Inc\Controls;

use WP_Customize_Control;

if ( class_exists( 'WP_Customize_Control' ) ) {

    class Dimensions_Control extends WP_Customize_Control {

        public $type = 'arnabwp-responsive-dimensions';
        public $devices = ['desktop', 'tablet', 'mobile'];

        public function enqueue() {
            wp_enqueue_script(
                'arnabwp-customizer-dimensions',
                ARNABWP_TEMP_DIR_URI . '/assets/js/customizer/customizer-dimensions.js',
                ['jquery', 'customize-controls'],
                false,
                true
            );

            wp_enqueue_style(
                'arnabwp-customizer-dimensions-style',
                ARNABWP_TEMP_DIR_URI . '/assets/css/customizer/customizer-dimensions.css'
            );
        }

        public function render_content() {
            ?>
    <label>
        <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
        <?php if ( $this->description ) : ?>
            <span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
        <?php endif; ?>
        <div class="arnabwp-dimension-control">
            <ul class="device-tabs">
                <?php foreach ( $this->devices as $device ) : ?>
                    <li class="device-tab" data-device="<?php echo esc_attr( $device ); ?>">
                        <span class="dashicons dashicons-<?php echo $device === 'desktop' ? 'desktop' : ( $device === 'tablet' ? 'tablet' : 'smartphone' ); ?>"></span>
                    </li>
                <?php endforeach; ?>
            </ul>
            <div class="dimension-inputs">
                <?php foreach ( $this->devices as $device ) : ?>
                    <input type="text"
       class="dimension-field dimension-<?php echo esc_attr( $device ); ?>"
       data-device="<?php echo esc_attr( $device ); ?>"
       placeholder="e.g. 18px"
       value="<?php echo esc_attr( $this->get_device_value( $device ) ); ?>">
                <?php endforeach; ?>
            </div>
        </div>
    </label>
    <?php
        }

      
        public function get_device_value( $device ) {
            $val = json_decode( $this->value(), true );
            return is_array( $val ) && isset( $val[ $device ] ) ? $val[ $device ] : '';
        }
    }
}