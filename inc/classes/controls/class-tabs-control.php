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
if ( class_exists( 'WP_Customize_Control' ) ) {

     /**
     * Custom range slider control class
     */
    class Tabs_Control extends WP_Customize_Control {

        // Define the control type
        public $type = 'arnabwp-tab';
        public $tabs = [];

        /**
         * Enqueue custom scripts and styles required for the range control
         */
        public function enqueue()
        {
            // Enqueue the custom JavaScript file for range control behavior
            wp_enqueue_script(
                'customizer-tabs',
                ARNABWP_TEMP_DIR_URI . '/assets/js/customizer-tabs.js',
                ['jquery', 'customize-controls'],
                false,
                true
            );

            // Enqueue the custom CSS styles for the range control
            wp_enqueue_style(
                'customizer-tabs-style',
                ARNABWP_TEMP_DIR_URI . '/assets/css/customizer-tabs.css'
            );
        }

        /**
         * Render the HTML content for the control
         */
        public function render_content() {
			if ( empty( $this->tabs ) || ! is_array( $this->tabs ) ) {
				return;
			}
			?>
			<div class="arnabwp-tab-control">
				<?php if ( $this->label ) : ?>
					<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<?php endif; ?>
				<?php if ( $this->description ) : ?>
					<span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
				<?php endif; ?>

				<ul class="arnabwp-tab-nav">
					<?php foreach ( $this->tabs as $key => $tab ) : ?>
						<li data-tab="<?php echo esc_attr( $key ); ?>" class="<?php echo $key === $this->value() ? 'active' : ''; ?>">
							<?php echo esc_html( $tab ); ?>
						</li>
					<?php endforeach; ?>
				</ul>

				<input type="hidden" <?php $this->link(); ?> value="<?php echo esc_attr( $this->value() ); ?>" />
			</div>
			<?php
		}
	}
}