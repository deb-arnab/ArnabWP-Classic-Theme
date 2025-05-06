<?php

/**
 * Custom Meta Boxes Class
 *
 * Adds and manages custom meta boxes for Testimonial and Employee post types.
 *
 * @package ArnabWP
 */

namespace ARNABWP_THEME\Inc;

use ARNABWP_THEME\Inc\Traits\Singleton;

class Custom_Meta_Boxes
{

	use Singleton;

	/**
	 * Constructor
	 *
	 * Initializes hooks for registering and saving meta boxes.
	 */
	protected function __construct()
	{
		$this->setup_hooks();
	}

	/**
	 * Set up WordPress action hooks
	 *
	 * - Registers meta boxes
	 * - Saves meta box data
	 */
	protected function setup_hooks()
	{
		add_action('add_meta_boxes', [$this, 'register_meta_boxes']);
		add_action('save_post', [$this, 'save_meta_box_data']);
	}

	/**
	 * Register meta boxes for custom post types
	 *
	 * Adds:
	 * - Testimonial Details meta box for 'testimonial' post type
	 * - Employee Details meta box for 'employee' post type
	 */
	public function register_meta_boxes()
	{

		add_meta_box(
			'service_meta_box',
			__('Service Details', 'arnabwp'),
			[$this, 'render_service_meta_box'],
			'service',
			'side',
			'default'
		);

		add_meta_box(
			'testimonial_meta_box',
			__('Testimonial Details', 'arnabwp'),
			[$this, 'render_testimonial_meta_box'],
			'testimonial',
			'side',
			'default'
		);

		add_meta_box(
			'employee_meta_box',
			__('Employee Details', 'arnabwp'),
			[$this, 'render_employee_meta_box'],
			'employee',
			'side',
			'default'
		);

		add_meta_box(
			'client_meta_box',
			__('Client Details', 'arnabwp'),
			[$this, 'render_client_meta_box'],
			'client',
			'side',
			'default'
		);
	}


	/**
	 * Render the Service Meta Box in the admin post editor screen.
	 *
	 * @param WP_Post $post The current post object.
	 */
	public function render_service_meta_box($post)
	{
		// Output a nonce field for security to verify on save.
		wp_nonce_field('save_service_meta_box', 'service_meta_box_nonce');

		// Retrieve existing values from the database, if available.
		$service_name        = get_post_meta($post->ID, '_service_name', true);
		$service_description = get_post_meta($post->ID, '_service_description', true);
?>

		<!-- Input field for Service Name -->
		<p>
			<label for="service_name"><?php _e('Service Name:', 'arnabwp'); ?></label>
			<input type="text"
				id="service_name"
				name="service_name"
				class="widefat"
				value="<?php echo esc_attr($service_name); ?>">
		</p>

		<!-- Textarea for Service Description -->
		<p>
			<label for="service_description"><?php _e('Service Description:', 'arnabwp'); ?></label>
			<textarea id="service_description"
				name="service_description"
				class="widefat"
				rows="4"><?php echo esc_textarea($service_description); ?></textarea>
		</p>

	<?php
	}


	/**
	 * Render fields for Testimonial meta box
	 *
	 * @param WP_Post $post Current post object.
	 */
	public function render_testimonial_meta_box($post)
	{
		// Security nonce
		wp_nonce_field('save_testimonial_meta_box', 'testimonial_meta_box_nonce');

		// Retrieve existing meta data
		$client_name  = get_post_meta($post->ID, '_testimonial_client_name', true);
		$client_title = get_post_meta($post->ID, '_testimonial_client_title', true);
		$comment         = get_post_meta($post->ID, '_testimonial_comment', true);
		$rating       = get_post_meta($post->ID, '_testimonial_rating', true);
		$social_links = get_post_meta($post->ID, '_testimonial_social_links', true);

		// Output form fields
	?>
		<p>
			<label><?php _e('Client Name:', 'arnabwp'); ?></label>
			<input type="text" name="testimonial_client_name" class="widefat" value="<?php echo esc_attr($client_name); ?>">
		</p>
		<p>
			<label><?php _e('Client Title:', 'arnabwp'); ?></label>
			<input type="text" name="testimonial_client_title" class="widefat" value="<?php echo esc_attr($client_title); ?>">
		</p>
		<p>
			<label><?php _e('Comment:', 'arnabwp'); ?></label>
			<textarea id="testimonial_comment" name="testimonial_comment" class="widefat" rows="6"><?php echo esc_html($comment); ?></textarea>
		</p>
		<p>
			<label><?php _e('Rating (1–5):', 'arnabwp'); ?></label>
			<input type="number" name="testimonial_rating" class="small-text" min="1" max="5" value="<?php echo esc_attr($rating); ?>">
		</p>
		<h4><?php _e('Social Links', 'arnabwp'); ?></h4>
		<p><input type="url" name="testimonial_social_links[facebook]" class="widefat" placeholder="Facebook URL" value="<?php echo esc_url($social_links['facebook'] ?? ''); ?>"></p>
		<p><input type="url" name="testimonial_social_links[twitter]" class="widefat" placeholder="Twitter URL" value="<?php echo esc_url($social_links['twitter'] ?? ''); ?>"></p>
		<p><input type="url" name="testimonial_social_links[linkedin]" class="widefat" placeholder="LinkedIn URL" value="<?php echo esc_url($social_links['linkedin'] ?? ''); ?>"></p>
	<?php
	}

	/**
	 * Render fields for Employee meta box
	 *
	 * @param WP_Post $post Current post object.
	 */
	public function render_employee_meta_box($post)
	{
		// Security nonce
		wp_nonce_field('save_employee_meta_box', 'employee_meta_box_nonce');

		// Retrieve existing meta data
		$name         = get_post_meta($post->ID, '_employee_name', true);
		// $comment         = get_post_meta($post->ID, '_employee_comment', true);
		$position     = get_post_meta($post->ID, '_employee_position', true);
		$email        = get_post_meta($post->ID, '_employee_email', true);
		$social_links = get_post_meta($post->ID, '_employee_social_links', true);

		// Output form fields
	?>
		<p>
			<label><?php _e('Name:', 'arnabwp'); ?></label>
			<input type="text" name="employee_name" class="widefat" value="<?php echo esc_attr($name); ?>">
		</p>
	
			<label><?php _e('Position:', 'arnabwp'); ?></label>
			<input type="text" name="employee_position" class="widefat" value="<?php echo esc_attr($position); ?>">
		</p>
		<p>
			<label><?php _e('Email:', 'arnabwp'); ?></label>
			<input type="email" name="employee_email" class="widefat" value="<?php echo esc_attr($email); ?>">
		</p>
		<h4><?php _e('Social Links', 'arnabwp'); ?></h4>
		<p><input type="url" name="employee_social_links[facebook]" class="widefat" placeholder="Facebook URL" value="<?php echo esc_url($social_links['facebook'] ?? ''); ?>"></p>
		<p><input type="url" name="employee_social_links[twitter]" class="widefat" placeholder="Twitter URL" value="<?php echo esc_url($social_links['twitter'] ?? ''); ?>"></p>
		<p><input type="url" name="employee_social_links[linkedin]" class="widefat" placeholder="LinkedIn URL" value="<?php echo esc_url($social_links['linkedin'] ?? ''); ?>"></p>
	<?php
	}

	/**
	 * Render fields for Client meta box
	 *
	 * @param WP_Post $post Current post object.
	 */
	public function render_client_meta_box($post)
	{
		wp_nonce_field('save_client_meta_box', 'client_meta_box_nonce');

		$client_name = get_post_meta($post->ID, '_client_name', true);
		$client_website = get_post_meta($post->ID, '_client_website', true);
	?>
		<p>
			<label><?php _e('Client Name:', 'arnabwp'); ?></label>
			<input type="text" name="client_name" class="widefat" value="<?php echo esc_attr($client_name); ?>">
		</p>
		<p>
			<label><?php _e('Client Website:', 'arnabwp'); ?></label>
			<input type="url" name="client_website" class="widefat" value="<?php echo esc_url($client_website); ?>">
		</p>
<?php
	}

	/**
	 * Save meta box data on post save
	 *
	 * @param int $post_id Post ID.
	 */
	public function save_meta_box_data($post_id)
	{
		// Prevent saving during autosave
		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

		// Get post type
		$post_type = get_post_type($post_id);


		// Handle service meta saving
		if ($post_type === 'service') {
			if (! isset($_POST['service_meta_box_nonce']) || ! wp_verify_nonce($_POST['service_meta_box_nonce'], 'save_service_meta_box')) return;

			if (current_user_can('edit_post', $post_id)) {
				update_post_meta($post_id, '_service_name', sanitize_text_field($_POST['service_name'] ?? ''));
				update_post_meta($post_id, '_service_description', sanitize_textarea_field($_POST['service_description'] ?? ''));
			}
		}

		// Handle testimonial meta saving
		if ($post_type === 'testimonial') {
			// Verify nonce
			if (! isset($_POST['testimonial_meta_box_nonce']) || ! wp_verify_nonce($_POST['testimonial_meta_box_nonce'], 'save_testimonial_meta_box')) return;

			// Check user capability
			if (current_user_can('edit_post', $post_id)) {
				update_post_meta($post_id, '_testimonial_client_name', sanitize_text_field($_POST['testimonial_client_name'] ?? ''));
				update_post_meta($post_id, '_testimonial_client_title', sanitize_text_field($_POST['testimonial_client_title'] ?? ''));
				update_post_meta($post_id, '_testimonial_comment', sanitize_textarea_field($_POST['testimonial_comment'] ?? ''));
				update_post_meta($post_id, '_testimonial_rating', max(1, min(5, intval($_POST['testimonial_rating'] ?? 0))));

				$social_links = $_POST['testimonial_social_links'] ?? [];
				update_post_meta($post_id, '_testimonial_social_links', array_map('esc_url_raw', $social_links));
			}
		}

		// Handle employee meta saving
		if ($post_type === 'employee') {
			// Verify nonce
			if (! isset($_POST['employee_meta_box_nonce']) || ! wp_verify_nonce($_POST['employee_meta_box_nonce'], 'save_employee_meta_box')) return;

			// Check user capability
			if (current_user_can('edit_post', $post_id)) {
				update_post_meta($post_id, '_employee_name', sanitize_text_field($_POST['employee_name'] ?? ''));
				// update_post_meta($post_id, '_employee_comment', sanitize_textarea_field($_POST['employee_comment'] ?? ''));
				update_post_meta($post_id, '_employee_position', sanitize_text_field($_POST['employee_position'] ?? ''));
				update_post_meta($post_id, '_employee_email', sanitize_email($_POST['employee_email'] ?? ''));

				$social_links = $_POST['employee_social_links'] ?? [];
				update_post_meta($post_id, '_employee_social_links', array_map('esc_url_raw', $social_links));
			}
		}

		// Handle client meta saving
		if ($post_type === 'client') {
			if (! isset($_POST['client_meta_box_nonce']) || ! wp_verify_nonce($_POST['client_meta_box_nonce'], 'save_client_meta_box')) return;

			if (current_user_can('edit_post', $post_id)) {
				update_post_meta($post_id, '_client_name', sanitize_text_field($_POST['client_name'] ?? ''));
				update_post_meta($post_id, '_client_website', esc_url_raw($_POST['client_website'] ?? ''));
			}
		}
	}
}
