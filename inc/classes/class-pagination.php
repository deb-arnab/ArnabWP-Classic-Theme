<?php

/**
 * Adds pagination to the Theme
 * 
 * @package ArnabWP
 */


namespace ARNABWP_THEME\Inc;

use ARNABWP_THEME\Inc\Traits\Singleton;

class Pagination
{
    use Singleton;


    protected function __construct()
    {

        //Load Class

        $this->setup_hooks();
    }

    protected function setup_hooks()
    {

        // Add filter to style pagination output with Bootstrap
        add_filter('paginate_links_output', [$this, 'bootstrapify_paginate_links']);
    }

    public function arnabwp_page_nav()
    {

        global $wp_query;

        $max = $wp_query->max_num_pages;
        $current = max(1, get_query_var('paged'));

        if ($max <= 1) {
            return;
        }

        $args = [
            'base'      => str_replace(999999999, '%#%', get_pagenum_link(999999999)),
            'total'     => $max,
            'current'   => $current,
            'prev_text' => __('« Previous', 'arnabwp'),
            'next_text' => __('Next »', 'arnabwp'),
            'type'      => 'list',
            'mid_size'  => 2,
        ];

        $links = paginate_links($args);

        if ($links) {
            echo '<nav class="pagination-wrapper mt-5 d-flex justify-content-center">' . $links . '</nav>';
        }
    }


    public function bootstrapify_paginate_links($output)
    {
        $output = str_replace(
            ['<ul class=\'page-numbers\'>', 'class="page-numbers', 'class=\'page-numbers'],
            ['<ul class="pagination">', 'class="page-link', 'class="page-link'],
            $output
        );

        // Add Bootstrap classes to <li>
        $output = str_replace('<li><span', '<li class="page-item active"><span', $output);
        $output = str_replace('<li><a', '<li class="page-item"><a', $output);

        return $output;
    }
}
