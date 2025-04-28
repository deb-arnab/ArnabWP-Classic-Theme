<?php
/**
 * Sidebar Template
 * 
 * @package ArnabWP
 */

?>

<aside id="secondary" class="sidebar">
    <?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
        <?php dynamic_sidebar( 'sidebar-1' ); ?>
    <?php else : ?>
        <p><?php esc_html_e( 'No widgets found. Add some widgets in the sidebar!', 'arnabwp' ); ?></p>
    <?php endif; ?>
</aside>

