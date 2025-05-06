<?php

/**
 * Range control class for WordPress Customizer
 *
 * This class adds a custom range slider control with an associated numeric value display and reset button.
 * It extends the default WP_Customize_Control to provide additional UI components for range input.
 *
 * @package ArnabWP
 */

namespace ARNABWP_THEME\Inc\Customizer\Controls;

use WP_Customize_Control;

// Ensure WP_Customize_Control exists before extending it
if ( class_exists( 'WP_Customize_Control' ) ) {

     /**
     * Custom range slider control class
     */
    class Radio_Control extends WP_Customize_Control {

        // Define the control type
        public $type = 'arnabwp-radio';

        /**
         * Enqueue custom scripts and styles required for the range control
         */
        public function enqueue()
        {
           
            // Enqueue the custom CSS styles for the range control
            wp_enqueue_style(
                'arnabwp-customizer-radio-style',
                ARNABWP_TEMP_DIR_URI . '/assets/css/customizer/customizer-radio.css'
            );
        }

        /**
         * Render the HTML content for the control
         */
        public function render_content() {
		
            if ( empty( $this->choices ) ) return;
			?>
			<div class="arnabwp-radio-wrapper">
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<div class="arnabwp-radio-buttons">
					<?php foreach ( $this->choices as $value => $icon ) : ?>
						
                        <label class="arnabwp-radio-label">
							<input type="radio"
								   name="<?php echo esc_attr( $this->id ); ?>"
								   value="<?php echo esc_attr( $value ); ?>"
								   <?php $this->link(); checked( $this->value(), $value ); ?> />
							<span class="dashicons <?php echo esc_attr( $icon ); ?>"></span>
                            
						</label>
					<?php endforeach; ?>
				</div>
			</div>
			<?php
		}
	}
}