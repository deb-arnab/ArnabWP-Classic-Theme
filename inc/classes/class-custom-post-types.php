<?php

/**
 * Add Custom Posts to the theme
 * 
 * @package ArnabWP
 */

namespace ARNABWP_THEME\Inc;

use ARNABWP_THEME\Inc\Traits\Singleton;

class Custom_Post_Types
{
    use Singleton;

    protected function __construct()
    {
        // Load class hooks or setup if needed
        $this->setup_hooks();
    }

    protected function setup_hooks()
    {

        add_action('init', [$this, 'register_service_post_type']);
        add_action('init', [$this, 'register_testimonial_post_type']);
        add_action('init', [$this, 'register_employee_post_type']);
        add_action('init', [$this, 'register_client_post_type']);
    }

    public function register_service_post_type()
    {
        register_post_type('service', [
            'labels' => [
                'name'                  => __('Services', 'arnabwp'),
                'singular_name'         => __('Service', 'arnabwp'),
                'menu_name'             => __('Services', 'arnabwp'),
                'name_admin_bar'        => __('Service', 'arnabwp'),
                'add_new'               => __('Add New', 'arnabwp'),
                'add_new_item'          => __('Add New Service', 'arnabwp'),
                'edit_item'             => __('Edit Service', 'arnabwp'),
                'new_item'              => __('New Service', 'arnabwp'),
                'view_item'             => __('View Service', 'arnabwp'),
                'all_items'             => __('All Services', 'arnabwp'),
                'search_items'          => __('Search Services', 'arnabwp'),
                'not_found'             => __("Sorry, we couldn't find the service you are looking for.", 'arnabwp'),
                'featured_image'        => __('Service Icon', 'arnabwp'),
                'set_featured_image'    => __('Set Service Icon', 'arnabwp'),
                'remove_featured_image' => __('Remove Service Icon', 'arnabwp'),
                'use_featured_image'    => __('Use as Service Icon', 'arnabwp'),
            ],
            'menu_icon'             => 'dashicons-portfolio',
            'public'                => true,
            'publicly_queryable'    => true,
            'hierarchical'          => false,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'menu_position'         => 5,
            'capability_type'       => 'post',
            'has_archive'           => true,
            'rewrite'               => ['slug' => 'services'],
            'supports'              => ['title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'],
            'show_in_rest'          => true,
            'show_in_nav_menus'     => true,
            'show_in_admin_bar'     => true,
            // 'taxonomies'         => ['category', 'post_tag'], // Uncomment if needed
        ]);
    }


    public function register_testimonial_post_type()
    {
        register_post_type('testimonial', [
            'labels' => [
                'name'                  => __('Testimonials', 'arnabwp'),
                'singular_name'         => __('Testimonial', 'arnabwp'),
                'menu_name'             => __('Testimonials', 'arnabwp'),
                'name_admin_bar'        => __('Testimonial', 'arnabwp'),
                'add_new'               => __('Add New', 'arnabwp'),
                'add_new_item'          => __('Add New Testimonial', 'arnabwp'),
                'edit_item'             => __('Edit Testimonial', 'arnabwp'),
                'new_item'              => __('New Testimonial', 'arnabwp'),
                'view_item'             => __('View Testimonial', 'arnabwp'),
                'all_items'             => __('All Testimonials', 'arnabwp'),
                'search_items'          => __('Search Testimonials', 'arnabwp'),
                'not_found'             => __("Sorry, we couldn't find the testimonial you are looking for.", 'arnabwp'),
                'featured_image'        => __('Client Photo', 'arnabwp'),
                'set_featured_image'    => __('Set Client Photo', 'arnabwp'),
                'remove_featured_image' => __('Remove Client Photo', 'arnabwp'),
                'use_featured_image'    => __('Use as Client Photo', 'arnabwp'),
            ],
            'menu_icon'             => 'dashicons-format-quote',
            'public'                => true,
            'publicly_queryable'    => true,
            'hierarchical'          => false,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'menu_position'         => 6,
            'capability_type'       => 'post',
            'has_archive'           => false,
            'rewrite'               => ['slug' => 'testimonials'],
            'supports'              => ['title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'],
            'show_in_rest'          => true,
            'show_in_nav_menus'     => true,
            'show_in_admin_bar'     => true,
        ]);
    }


    public function register_employee_post_type()
    {
        register_post_type('employee', [
            'labels' => [
                'name'                  => __('Employees', 'arnabwp'),
                'singular_name'         => __('Employee', 'arnabwp'),
                'menu_name'             => __('Employees', 'arnabwp'),
                'name_admin_bar'        => __('Employee', 'arnabwp'),
                'add_new'               => __('Add New', 'arnabwp'),
                'add_new_item'          => __('Add New Employee', 'arnabwp'),
                'edit_item'             => __('Edit Employee', 'arnabwp'),
                'new_item'              => __('New Employee', 'arnabwp'),
                'view_item'             => __('View Employee', 'arnabwp'),
                'all_items'             => __('All Employees', 'arnabwp'),
                'search_items'          => __('Search Employees', 'arnabwp'),
                'not_found'             => __("Sorry, we couldn't find the employee you're looking for.", 'arnabwp'),
                'featured_image'        => __('Employee Photo', 'arnabwp'),
                'set_featured_image'    => __('Set Employee Photo', 'arnabwp'),
                'remove_featured_image' => __('Remove Employee Photo', 'arnabwp'),
                'use_featured_image'    => __('Use as Employee Photo', 'arnabwp'),
            ],
            'menu_icon'             => 'dashicons-groups',
            'public'                => true,
            'publicly_queryable'    => true,
            'hierarchical'          => false,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'menu_position'         => 7,
            'capability_type'       => 'post',
            'has_archive'           => false,
            'rewrite'               => ['slug' => 'employees'],
            'supports'              => ['title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'],
            'show_in_rest'          => true,
            'show_in_nav_menus'     => true,
            'show_in_admin_bar'     => true,
        ]);
    }

    public function register_client_post_type()
    {
        register_post_type('client', [
            'labels' => [
                'name'                  => __('Clients', 'arnabwp'),
                'singular_name'         => __('Client', 'arnabwp'),
                'menu_name'             => __('Clients', 'arnabwp'),
                'name_admin_bar'        => __('Client', 'arnabwp'),
                'add_new'               => __('Add New', 'arnabwp'),
                'add_new_item'          => __('Add New Client', 'arnabwp'),
                'edit_item'             => __('Edit Client', 'arnabwp'),
                'new_item'              => __('New Client', 'arnabwp'),
                'view_item'             => __('View Clients', 'arnabwp'),
                'all_items'             => __('All Clients', 'arnabwp'),
                'search_items'          => __('Search Clients', 'arnabwp'),
                'not_found'             => __("Sorry, we couldn't find the client you're looking for.", 'arnabwp'),
                'featured_image'        => __('Employee Logo', 'arnabwp'),
                'set_featured_image'    => __('Set Client Logo', 'arnabwp'),
                'remove_featured_image' => __('Remove Client Logo', 'arnabwp'),
                'use_featured_image'    => __('Use as Client Logo', 'arnabwp'),
            ],
            'menu_icon'             => 'dashicons-star-filled',
            'public'                => true,
            'publicly_queryable'    => true,
            'hierarchical'          => false,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'menu_position'         => 8,
            'capability_type'       => 'post',
            'has_archive'           => false,
            'rewrite'               => ['slug' => 'clients'],
            'supports'              => ['title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'],
            'show_in_rest'          => true,
            'show_in_nav_menus'     => true,
            'show_in_admin_bar'     => true,
        ]);
    }
}
