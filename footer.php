<?php
/**
 * footer template
 * 
 * @package ArnabWP
 */

$copyright_text = get_theme_mod('arnabwp_footer_copyright_text', '© ' . date('Y') . ' ArnabWP. All rights reserved.');
$show_widgets       = get_theme_mod('arnabwp_footer_show_widgets', true);
$show_copyright     = get_theme_mod('arnabwp_footer_show_copyright', true);
$text_align     = get_theme_mod('arnabwp_footer_text_alignment', 'center');
$align_class    = 'align-' . esc_attr($text_align);
?>
<?php \ARNABWP_THEME\Inc\Helpers\Customizer_Shortcut::arnabwp_display_shortcut( 'arnabwp_footer_section' ); ?>
<footer class="site-footer">
  
  <?php if ($show_widgets) : ?>
    <div class="site-container">
      <div class="row">
        <?php for ($i = 1; $i <= 4; $i++) : ?>
          <div class="col-md-6 col-lg-3 footer-column">
            <?php if (is_active_sidebar('footer-' . $i)) : ?>
              <div class="footer-widget">
                <?php dynamic_sidebar('footer-' . $i); ?>
              </div>
            <?php endif; ?>
          </div>
        <?php endfor; ?>
      </div>
    </div>
    <?php endif; ?>
   
    <?php if ($show_copyright) : ?>
      <div class="site-container">
      <div class="footer-bottom <?php echo esc_attr($align_class); ?>">
        <div class="footer-copy">
          <?php echo wp_kses_post($copyright_text); ?>
        </div>
      </div>
      </div>
    <?php endif; ?>

</footer>


</div>
</div>
<?php if ( get_theme_mod( 'enable_scroll_to_top', '1' ) == '1' ) : ?>
    <!-- Scroll to Top Button -->
    <button id="scrollToTop" class="scroll-to-top" aria-label="Scroll to top">
        <i class="fas fa-arrow-up"></i> <!-- You can use a FontAwesome icon for the arrow -->
    </button>
<?php endif; ?>
<?php wp_footer(); ?>
</body>
</html>