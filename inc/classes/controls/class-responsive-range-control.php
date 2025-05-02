<?php

namespace ARNABWP_THEME\Inc\Controls;

use WP_Customize_Control;

if ( class_exists( 'WP_Customize_Control' ) ) {

    class Responsive_Range_Control extends WP_Customize_Control {

        public $type = 'arnabwp-responsive-range';
        public $devices = ['desktop', 'tablet', 'mobile'];

        public function enqueue() {
            wp_enqueue_script(
                'arnabwp-customizer-responsive-range',
                ARNABWP_TEMP_DIR_URI . '/assets/js/customizer/customizer-responsive-range.js',
                ['jquery', 'customize-controls'],
                false,
                true
            );

            wp_enqueue_style(
                'arnabwp-customizer-responsive-range-style',
                ARNABWP_TEMP_DIR_URI . '/assets/css/customizer/customizer-responsive-range.css'
            );
        }

        public function render_content() {
            ?>
            <label>
                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                <?php if ( $this->description ) : ?>
                    <span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
                <?php endif; ?>
                <div class="arnabwp-responsive-range-control">
                    <ul class="device-tabs">
                        <?php foreach ( $this->devices as $device ) : ?>
                            <li class="device-tab" data-device="<?php echo esc_attr( $device ); ?>">
                                <span class="dashicons dashicons-<?php echo esc_attr( $device === 'desktop' ? 'desktop' : ( $device === 'tablet' ? 'tablet' : 'smartphone' ) ); ?>"></span>
                            </li>
                        <?php endforeach; ?>
                    </ul>

                    <div class="device-range-inputs">
                        <?php 
                        $values = json_decode( $this->value(), true );
                        foreach ( $this->devices as $device ) : 
                            $val = isset( $values[ $device ] ) ? $values[ $device ] : '';
                        ?>
                            <div class="device-range-group device-<?php echo esc_attr( $device ); ?>">
                                <input type="range"
                                    min="<?php echo esc_attr( $this->input_attrs['min'] ?? 0 ); ?>"
                                    max="<?php echo esc_attr( $this->input_attrs['max'] ?? 100 ); ?>"
                                    step="<?php echo esc_attr( $this->input_attrs['step'] ?? 1 ); ?>"
                                    value="<?php echo esc_attr( $val ); ?>"
                                    data-device="<?php echo esc_attr( $device ); ?>"
                                    class="range-slider"
                                />
                                <input type="text" 
                                    value="<?php echo esc_attr( $val ); ?>"
                                    class="range-value"
                                    readonly
                                />
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <input type="hidden" <?php $this->link(); ?> value="<?php echo esc_attr( $this->value() ); ?>" class="responsive-range-hidden" />
                </div>
            </label>
            <?php
        }
    }
}