
<?php
/**
 * Top Bar Template
 *
 * @package ArnabWP
 */



// Fetch top bar settings
$phone   = get_theme_mod('arnabwp_topbar_phone');
$email   = get_theme_mod('arnabwp_topbar_email');
$address = get_theme_mod('arnabwp_topbar_address');

// Bail early if all fields are empty
if (!$phone && !$email && !$address) {
    return;
}
?>

<!-- Topbar Section -->
<div class="topbar py-1" role="banner" aria-label="Top Contact Information">
    <div class="site-container d-flex justify-content-between align-items-center flex-wrap">

        <?php if ($phone) : ?>
            <div class="topbar-left" aria-label="Phone Number">
                <small>
                    <i class="fas fa-phone" aria-hidden="true"></i>
                    <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', $phone)); ?>" class="text-decoration-none">
                        <?php echo esc_html($phone); ?>
                    </a>
                </small>
            </div>
        <?php endif; ?>

        <?php if ($email) : ?>
            <div class="topbar-center" aria-label="Email Address">
                <small>
                    <i class="fas fa-envelope" aria-hidden="true"></i>
                    <a href="mailto:<?php echo sanitize_email($email); ?>" class="text-decoration-none">
                        <?php echo esc_html($email); ?>
                    </a>
                </small>
            </div>
        <?php endif; ?>

        <?php if ($address) : ?>
            <div class="topbar-right" aria-label="Physical Address">
                <small>
                    <i class="fas fa-map-marker-alt" aria-hidden="true"></i>
                    <?php echo esc_html($address); ?>
                </small>
            </div>
        <?php endif; ?>

    </div>
</div>