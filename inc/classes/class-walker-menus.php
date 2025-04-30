<?php

/**
 * Adds Walker Menus to the Theme
 * 
 * @package ArnabWP
 */


namespace ARNABWP_THEME\Inc;

use Walker_Nav_Menu;
use ARNABWP_THEME\Inc\Traits\Singleton;

/**
 * Class Walker_Menus
 */
class Walker_Menus extends Walker_Nav_Menu
{
	use Singleton;

	/**
	 * Starts the list before the elements are added.
	 *
	 * @param string   $output Passed by reference. Used to append additional content.
	 * @param int      $depth  Depth of menu item. Used for padding.
	 * @param stdClass $args   An object of wp_nav_menu() arguments.
	 */
	public function start_lvl(&$output, $depth = 0, $args = null): void
	{
		$indent = str_repeat("\t", $depth);
		$submenu_class = $depth > 0 ? ' dropdown-submenu' : '';

		$output .= "\n{$indent}<ul class=\"dropdown-menu{$submenu_class}\">\n";
	}

	/**
	 * Starts the element output.
	 *
	 * @param string   $output Used to append additional content (passed by reference).
	 * @param WP_Post  $item   Menu item data object.
	 * @param int      $depth  Depth of menu item.
	 * @param stdClass $args   An object of wp_nav_menu() arguments.
	 * @param int      $id     Current item ID.
	 */
	public function start_el(&$output, $item, $depth = 0, $args = null, $id = 0): void
	{
		$classes     = empty($item->classes) ? [] : (array) $item->classes;
		$is_dropdown = in_array('menu-item-has-children', $classes, true);

		// Add Bootstrap classes to <li>
		if ($is_dropdown) {
			$classes[] = 'dropdown';
		}

		if ($depth > 0) {
			$classes[] = 'dropdown-submenu';
		}

		$class_names = implode(' ', array_filter($classes));
		$class_attr  = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';

		$output .= '<li id="menu-item-' . esc_attr($item->ID) . '"' . $class_attr . '>';

		$atts = [
			'title'        => ! empty($item->attr_title) ? $item->attr_title : '',
			'target'       => ! empty($item->target) ? $item->target : '',
			'rel'          => ! empty($item->xfn) ? $item->xfn : '',
			'href'         => ! empty($item->url) ? $item->url : '',
			'class'        => '',
			'role'         => '',
			'data-bs-toggle' => '',
			'aria-expanded'  => '',
		];

		// Add Bootstrap nav link classes
		if ($depth === 0 && $is_dropdown) {
			$atts['class'] = 'nav-link dropdown-toggle';
			$atts['data-bs-toggle'] = 'dropdown';
			$atts['aria-expanded']  = 'false';
			$atts['role'] = 'button';
		} elseif ($depth === 0) {
			$atts['class'] = 'nav-link';
		} else {
			$atts['class'] = 'dropdown-item';
		}

		// Clean empty attributes
		$attributes = '';
		foreach ($atts as $attr => $value) {
			if (! empty($value)) {
				$attributes .= ' ' . esc_attr($attr) . '="' . esc_attr($value) . '"';
			}
		}

		// Menu title
		$title = apply_filters('the_title', $item->title, $item->ID);

		// Output HTML
		$item_output  = $args->before ?? '';
		$item_output .= '<a' . $attributes . '>';
		$item_output .= ($args->link_before ?? '') . esc_html($title) . ($args->link_after ?? '');
		$item_output .= '</a>';
		$item_output .= $args->after ?? '';

		$output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
	}
}
