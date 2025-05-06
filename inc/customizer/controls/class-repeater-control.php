<?php

/**
 * Repeater control Class
 *
 * 
 * @package ArnabWP
 */

namespace ARNABWP_THEME\Inc\Customizer\Controls;



if ( class_exists( 'WP_Customize_Control' ) ) {
class Repeater_Control extends \WP_Customize_Control
{
	public $type = 'repeater';
	public $button_label = 'Add Item';
	public $fields = [];

	public function enqueue()
	{
		wp_enqueue_script(
			'arnabwp-customizer-repeater',
			ARNABWP_TEMP_DIR_URI . '/assets/js/customizer/customizer-repeater.js',
			['jquery', 'customize-controls','media-editor', 'media-views'],
			false,
			true
		);
		wp_enqueue_style(
			'arnabwp-customizer-repeater-style',
			ARNABWP_TEMP_DIR_URI . '/assets/css/customizer/customizer-repeater.css'
		);
		wp_enqueue_media(); // For image upload
		wp_enqueue_style('wp-mediaelement');
	}

	public function to_json()
	{
		parent::to_json();
		$this->json['fields'] = $this->fields;
		$this->json['button_label'] = $this->button_label;
	}

	public function render_content()
	{
?>
		<label>
			<span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
			<span class="description customize-control-description"><?php echo esc_html($this->description); ?></span>
		</label>
		<div class="repeater-control" data-fields='<?php echo wp_json_encode($this->fields); ?>'></div>
		<button type="button" class="button add-repeater"><?php echo esc_html($this->button_label); ?></button>
		<input type="hidden" <?php $this->link(); ?> value="<?php echo esc_attr($this->value()); ?>" class="repeater-hidden-field" />
<?php
	}


	
}
}