<?php
/**
 * Template Part: Hero Section
 * 
 * Displays a customizable Hero section with background image or slider, 
 * title, subtitle, and dynamic call-to-action buttons from the theme customizer.
 * 
 * @package ArnabWP
 */

// Get hero type: 'image' or 'slider'
$hero_type = esc_attr( get_theme_mod( 'hero_type', 'image' ) );

// Get text content from customizer
$hero_title    = esc_html( get_theme_mod( 'hero_title', 'Welcome to Our Site' ) );
$hero_subtitle = esc_html( get_theme_mod( 'hero_subtitle', 'We provide awesome solutions.' ) );

// Get hero image URL if type is image
$hero_image = esc_url( get_theme_mod( 'hero_image' ) );

// Get CTA buttons (repeater-style array as JSON, decode it after)
$hero_buttons_raw = get_theme_mod( 'hero_cta_buttons', '[]' );
$hero_buttons = json_decode($hero_buttons_raw, true);
if (!is_array($hero_buttons)) {
    $hero_buttons = []; // Fallback to empty array if decode fails
}

// Get hero slider images (repeater-style JSON)
$hero_slider_raw = get_theme_mod('hero_slider', '[]');
$hero_slider = json_decode($hero_slider_raw, true);
if (!is_array($hero_slider)) {
    $hero_slider = []; // Fallback to empty array if decode fails
}
?>


<section class="hero-section"  role="banner" aria-label="Hero Section">

<?php 
// If hero type is image and a valid image is set
if ($hero_type === 'image' && $hero_image) :
    ?>
    <!-- Hero Image Background -->
    <div class="hero-image" style="background-image: url('<?php echo esc_url($hero_image); ?>');">
        <div class="hero-overlay"></div>

        <!-- SEO-friendly hidden image for background -->
        <img src="<?php echo esc_url( $hero_image ); ?>" alt="Hero Background Image" loading="lazy" class="visually-hidden">

        <!-- Hero Content -->
        <div class="hero-content site-container">
            <h1><?php echo esc_html($hero_title); ?></h1>
            <p><?php echo esc_html($hero_subtitle); ?></p>

            <!-- CTA Buttons -->
            <?php if (!empty($hero_buttons) && is_array($hero_buttons)) : ?>
                <div class="hero-buttons">
                    <?php foreach ($hero_buttons as $button) :
                        $text = isset($button['text']) ? $button['text'] : '';
                        $url = isset($button['url']) ? $button['url'] : '#';
                        $target = isset($button['target']) && $button['target'] ? ' target="_blank" rel="noopener noreferrer"' : '';
                        $aria   = 'aria-label="' . esc_attr( $text ) . '"';
                        ?>
                        <a href="<?php echo esc_url($url); ?>" class="hero-btn" <?php echo $target; ?> <?php echo $aria; ?>>
                            <?php echo esc_html($text); ?>
                        </a>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>


<?php
// If hero type is slider and slides exist
elseif ($hero_type === 'slider' && !empty($hero_slider)) :
?>

    <!-- Owl Carousel Wrapper -->
    <div class="owl-carousel hero-slider" aria-live="polite">
        <?php foreach ($hero_slider as $slide) :
            $img = isset($slide['image']) ? $slide['image'] : '';
            if (!$img) continue; // Skip if no image set
            ?>
            <div class="hero-slide" style="background-image: url('<?php echo esc_url($img); ?>');">
                <div class="hero-overlay"></div>

                        <!-- SEO hidden image -->
                        <img src="<?php echo esc_url( $img ); ?>" alt="<?php echo esc_attr( $hero_title ); ?> Background Image <?php foreach ( $hero_slider as $index => $slide ) :
                            echo esc_attr( $index + 1 ); 
                        endforeach;?>" loading="lazy" class="visually-hidden">

                <!-- Slider Content (same as image section) -->
                <div class="hero-content site-container">
                    <h1><?php echo esc_html($hero_title); ?></h1>
                    <p><?php echo esc_html($hero_subtitle); ?></p>

                    <!-- CTA Buttons -->
                    <?php if (!empty($hero_buttons) && is_array($hero_buttons)) : ?>
                        <div class="hero-buttons">
                            <?php foreach ($hero_buttons as $button) :
                                $text = isset($button['text']) ? $button['text'] : '';
                                $url = isset($button['url']) ? $button['url'] : '#';
                                $target = isset($button['target']) && $button['target'] ? ' target="_blank" rel="noopener noreferrer"' : '';
                                $aria   = 'aria-label="' . esc_attr( $text ) . '"';
                                ?>
                                <a href="<?php echo esc_url($url); ?>" class="hero-btn" <?php echo $target; ?> <?php echo $aria; ?>>
                                    <?php echo esc_html($text); ?>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>
</section>
