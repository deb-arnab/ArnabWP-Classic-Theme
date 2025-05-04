<?php
/**
 * Autoloader file for ArnabWP theme.
 *
 * @package ArnabWP
 */

namespace ARNABWP_THEME\Inc\Helpers;

/**
 * PSR-4 compatible autoloader function for the ARNABWP_THEME namespace.
 *
 * This function dynamically includes PHP class files based on the namespace and class name.
 * It supports classes located in:
 * - inc/classes/
 * - inc/helpers/
 * - inc/traits/
 *
 * Example:
 * - Namespace: ARNABWP_THEME\Inc\Helpers\Font_Output
 *   Will map to: inc/helpers/class-font-output.php
 *
 * @param string $resource Fully qualified class name with namespace.
 *
 * @return void
 */
function autoloader( $resource = '' ) {
	$resource_path  = false;
	$namespace_root = 'ARNABWP_THEME\\';
	$resource       = trim( $resource, '\\' );

	if ( empty( $resource ) || strpos( $resource, '\\' ) === false || strpos( $resource, $namespace_root ) !== 0 ) {
		// Not part of our namespace, skip loading.
		return;
	}

	// Remove the root namespace prefix.
	$resource = str_replace( $namespace_root, '', $resource );

	// Convert namespace separators and underscores to lowercase path format.
	$path = explode(
		'\\',
		str_replace( '_', '-', strtolower( $resource ) )
	);

	/**
	 * Determine path based on type of class (traits, helpers, or general classes).
	 */
	if ( empty( $path[0] ) || empty( $path[1] ) ) {
		return;
	}

	$directory = '';
	$file_name = '';

	if ( 'inc' === $path[0] ) {

		switch ( $path[1] ) {
			case 'traits':
				$directory = 'traits';
				$file_name = sprintf( 'trait-%s', trim( strtolower( $path[2] ) ) );
				break;

			case 'helpers':
				$directory = 'helpers';
				$file_name = sprintf( 'class-%s', trim( strtolower( $path[2] ) ) );
				break;

			default:
				// Check if a subdirectory class exists (e.g., inc/classes/some-folder/class-example.php).
				if ( ! empty( $path[2] ) ) {
					$directory = sprintf( 'classes/%s', $path[1] );
					$file_name = sprintf( 'class-%s', trim( strtolower( $path[2] ) ) );
				} else {
					$directory = 'classes';
					$file_name = sprintf( 'class-%s', trim( strtolower( $path[1] ) ) );
				}
				break;
		}

		$resource_path = sprintf(
			'%s/inc/%s/%s.php',
			untrailingslashit( ARNABWP_DIR_PATH ),
			$directory,
			$file_name
		);
	}

	/**
	 * Validate file path and require it if valid and exists.
	 * validate_file() returns:
	 * - 0: valid file
	 * - 2: valid file with Windows drive path
	 */
	$is_valid_file = validate_file( $resource_path );

	if ( ! empty( $resource_path ) && file_exists( $resource_path ) && ( 0 === $is_valid_file || 2 === $is_valid_file ) ) {
		require_once( $resource_path ); // phpcs:ignore WordPressVIPMinimum.Files.IncludingFile.UsingVariable
	}
}

// Register the autoloader function.
spl_autoload_register( '\ARNABWP_THEME\Inc\Helpers\autoloader' );
