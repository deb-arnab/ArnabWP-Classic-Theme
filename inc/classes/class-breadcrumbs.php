<?php

/**
 * Breadcrumbs Class
 *
 * Dynamically generates breadcrumb navigation for various page types.
 * 
 * @package ArnabWP
 */

namespace ARNABWP_THEME\Inc;

use ARNABWP_THEME\Inc\Traits\Singleton;

/**
 * Class Breadcrumbs
 */
class Breadcrumbs
{
	use Singleton;

	/**
	 * Constructor.
	 * Sets up hooks.
	 */
	protected function __construct()
	{
		$this->setup_hooks();
	}

	/**
	 * Placeholder for any breadcrumb-related hooks in the future.
	 *
	 * @return void
	 */
	protected function setup_hooks()
	{
		// Reserved for future use if needed.
	}

	/**
	 * Render breadcrumb navigation based on the current page context.
	 *
	 * @return void
	 */
	public function arnabwp_breadcrumb()
	{
		if (is_front_page()) {
			// Do not show breadcrumbs on the front page
			return;
		}

		echo '<nav aria-label="breadcrumb">';
		$separator = get_theme_mod('arnabwp_breadcrumb_separator', '>');

		echo '<div class="arnabwp-breadcrumb">';

		$breadcrumb_items = [];

		// Home
		$breadcrumb_items[] = '<a href="' . esc_url(home_url()) . '">' . esc_html__('Home', 'arnabwp') . '</a>';

		if (is_category() || is_single()) {
			$category = get_the_category();
			if (! empty($category) && isset($category[0])) {
				$breadcrumb_items[] = '<a href="' . esc_url(get_category_link($category[0]->term_id)) . '">' . esc_html($category[0]->name) . '</a>';
			}
			if (is_single()) {
				$breadcrumb_items[] = esc_html(get_the_title());
			}
		} elseif (is_page()) {
			$breadcrumb_items[] = esc_html(get_the_title());
		} elseif (is_search()) {
			$breadcrumb_items[] = esc_html__('Search Results for:', 'arnabwp') . ' ' . esc_html(get_search_query());
		} elseif (is_archive()) {
			$breadcrumb_items[] = esc_html(post_type_archive_title('', false));
		} elseif (is_404()) {
			$breadcrumb_items[] = esc_html__('404 Page Not Found', 'arnabwp');
		}

		// Output the final breadcrumb trail with custom separator
		echo implode(' <span class="arnabwp-breadcrumb-separator">' . esc_html($separator) . '</span> ', $breadcrumb_items);

		echo '</div>';
		echo '</nav>';
	}
}
