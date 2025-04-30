<?php

/**
 * toggle control Class
 *
 * 
 * @package ArnabWP
 */

namespace ARNABWP_THEME\Inc\Controls;




if ( class_exists( 'WP_Customize_Control' ) ) {
class Toggle_Control extends \WP_Customize_Control {

	public $type = 'toggle';

	public function enqueue() {
		wp_enqueue_style( 'arnabwp-toggle-control', ARNABWP_TEMP_DIR_URI . '/assets/css/customizer/customizer-toggle.css' );
	}

	public function render_content() {
		?>
		<label class="arnabwp-toggle-control">
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<div class="toggle-switch">
				<input type="checkbox" id="<?php echo esc_attr( $this->id ); ?>" <?php $this->link(); checked( $this->value(), true ); ?> />
				<label for="<?php echo esc_attr( $this->id ); ?>"></label>
			</div>
			<?php if ( $this->description ) : ?>
				<span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
			<?php endif; ?>
		</label>
		<?php
	}
}}