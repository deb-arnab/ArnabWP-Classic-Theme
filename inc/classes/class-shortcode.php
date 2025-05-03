<?php

/**
 * Shortcodes
 *
 * @package ArnabWP
 */

namespace ARNABWP_THEME\Inc;

use ARNABWP_THEME\Inc\Traits\Singleton;

class Shortcode
{
    use Singleton;

    protected function __construct()
    {
        // Load class hooks.
        $this->setup_hooks();
    }

    /**
     * Set up action and shortcode hooks.
     */
    protected function setup_hooks()
    {
        // Register shortcode.
        add_shortcode('arnabwp_newsletter_form', [$this, 'arnabwp_newsletter_form_shortcode']);

        // Handle form submission.

        add_action('wp_ajax_arnabwp_newsletter_submit', [$this, 'arnabwp_newsletter_submit']);
        add_action('wp_ajax_nopriv_arnabwp_newsletter_submit', [$this, 'arnabwp_newsletter_submit']);
    }

    /**
     * Newsletter form shortcode callback.
     *
     * @param array  $atts Shortcode attributes.
     * @param string $content Shortcode content.
     * @return string
     */

    public function arnabwp_newsletter_form_shortcode($atts = [], $content = null)
    {
        ob_start();
?>
        <form id="newsletter_form" class="newsletter-form row g-2 justify-content-center">

            <div class="col-auto">
                <input type="email" name="newsletter_email" id="newsletter_email" class="form-control" placeholder="<?php echo esc_attr('Enter your email', 'arnabwp'); ?>" required>
            </div>

            <div class="col-auto">
                <button type="button" id="subscribe_button" class="btn btn-primary"><?php echo esc_html('Subscribe', 'arnabwp'); ?></button>
            </div>

            <div id="newsletter_result"></div>

        </form>
        <script>
            jQuery(function($) {
                $('#subscribe_button').on('click', function() {
                    var email = $('#newsletter_email').val();
                    var nonce = '<?php echo wp_create_nonce('arnabwp_newsletter_form'); ?>';

                    if (email) {
                        $.post('<?php echo admin_url('admin-ajax.php'); ?>', {
                            action: 'arnabwp_newsletter_submit',
                            email: email,
                            nonce: nonce
                        }, function(response) {
                            $('#newsletter_result').html(response);
                        });
                    } else {
                        $('#newsletter_result').html('<p class="error">Please enter a valid email.</p>');
                    }
                });
            });
        </script>
        <?php
        return ob_get_clean();
    }

    /**
     * Handle newsletter form submission.
     */
    public function arnabwp_newsletter_submit()
    {
        if (! isset($_POST['nonce']) || ! wp_verify_nonce($_POST['nonce'], 'arnabwp_newsletter_form')) {
            echo 'Invalid request';
            wp_die();
        }

        if (isset($_POST['email']) && is_email($_POST['email'])) {
            $email = sanitize_email($_POST['email']);
            $existing_emails = get_option('arnabwp_newsletter_emails', []);

            if (! in_array($email, $existing_emails, true)) {
                $existing_emails[] = $email;
                update_option('arnabwp_newsletter_emails', $existing_emails);
        ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?php esc_html_e('Thank you for subscribing!', 'arnabwp'); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php

            } else {
            ?>
                <div class="alert alert-info alert-dismissible fade show" role="alert">
                    <?php esc_html_e('You are already subscribed.', 'arnabwp'); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php

            }
        } else {
            ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?php esc_html_e('Please enter a valid email address.', 'arnabwp'); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            
<?php

        }

        wp_die();
    }
}
