<?php

/**
 * The template for if there is no posts found
 * 
 * @package ArnabWP
 */
?>

<section class="no-content py-5">
    <div class="container text-center">
        <header class="mb-4">
            <h1 class="display-5 text-muted"><?php esc_html_e('Nothing Found', 'arnabwp'); ?></h1>
        </header>

        <div class="page-content">
            <?php if (is_home() && current_user_can('publish_posts')) : ?>

        <!-- <p class="lead">
          <?php esc_html_e('Ready to publish your first post?', 'arnabwp'); ?>
          <a class="btn btn-primary" href="<?php echo esc_url(admin_url('post-new.php')); ?>">
            <?php esc_html_e('Get started here', 'arnabwp'); ?>
          </a>
        </p> -->

                <p class="lead">
                    <?php
                    printf(
                        wp_kses(
                            __('Ready to publish your first post? <a class="btn btn-primary" href="%s"> Get started here </a>', 'arnabwp'),
                            ['a' => ['href' => [], 'class' => []]]
                        ),
                        esc_url(admin_url('post-new.php'))
                    );
                    ?>
                </p>

            <?php elseif (is_search()) : ?>
                <p class="lead mb-4"><?php esc_html_e('Sorry, no results matched your search. Try different keywords.', 'arnabwp'); ?></p>
                <div class="d-flex justify-content-center">
                    <?php get_search_form(); ?>
                </div>

            <?php else : ?>
                <p class="lead mb-4"><?php esc_html_e('We couldn’t find what you’re looking for. Try searching below.', 'arnabwp'); ?></p>
                <div class="d-flex justify-content-center">
                    <?php get_search_form(); ?>
                </div>

            <?php endif; ?>
        </div>
    </div>
</section>