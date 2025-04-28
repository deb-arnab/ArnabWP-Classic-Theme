<?php

/**
 * Repeater control Class
 *
 * 
 * @package ArnabWP
 */

namespace ARNABWP_THEME\Inc\Controls;

use WP_Customize_Control;

if ( class_exists( 'WP_Customize_Control' ) ) {
    class Range_Control extends WP_Customize_Control {
        public $type = 'arnabwp-range';

        public function enqueue()
        {
            wp_enqueue_script(
                'customizer-range',
                ARNABWP_TEMP_DIR_URI . '/assets/js/customizer-range.js',
                ['jquery', 'customize-controls'],
                false,
                true
            );
            wp_enqueue_style(
                'customizer-range-style',
                ARNABWP_TEMP_DIR_URI . '/assets/css/customizer-range.css'
            );
            
        }

        public function render_content() {
            ?>
            <label>
                <?php if ( ! empty( $this->label ) ) : ?>
                    <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                <?php endif; ?>
        
                <div class="arnabwp-range-control" style="display: flex; align-items: center; gap: 10px;">
                    <input 
                        type="range" 
                        class="arnabwp-range-slider"
                        id="<?php echo esc_attr( $this->id ); ?>_range" 
                        value="<?php echo esc_attr( $this->value() ); ?>" 
                          data-default-value="<?php echo esc_attr( $this->setting->default ); ?>"
                        min="<?php echo esc_attr( $this->input_attrs['min'] ); ?>" 
                        max="<?php echo esc_attr( $this->input_attrs['max'] ); ?>" 
                        step="<?php echo esc_attr( $this->input_attrs['step'] ); ?>"
                        <?php $this->link(); ?>
                        style="flex: 1;"
                    />
                    <input 
    type="text" 
    id="<?php echo esc_attr( $this->id ); ?>_value" 
    value="<?php echo esc_attr( $this->value() ); ?>" 
    readonly 
    class="arnabwp-range-value"
/>
<button 
    type="button"
    class="button button-small arnabwp-range-reset"
    id="<?php echo esc_attr( $this->id ); ?>_reset"
>
    Reset
</button>
                </div>
            </label>
            <?php
        }
    }
}