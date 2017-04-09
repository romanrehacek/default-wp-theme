<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Theme_name_Autoloader {

	/**
	 * Path to the includes directory.
	 *
	 * @var string
	 */
	private $include_path = '';

	/**
	 * The Constructor.
	 */
	public function __construct() {
		if ( function_exists( "__autoload" ) ) {
			spl_autoload_register( "__autoload" );
		}

		spl_autoload_register( array( $this, 'autoload' ) );

		$this->include_path = untrailingslashit( get_stylesheet_directory() ) . '/includes/';
	}

	/**
	 * Take a class name and turn it into a file name.
	 *
	 * @param  string $class
	 * @return string
	 */
	private function get_file_name_from_class( $class ) {
		return 'class-' . str_replace( '_', '-', $class ) . '.php';
	}

	/**
	 * Include a class file.
	 *
	 * @param  string $path
	 * @return bool successful or not
	 */
	private function load_file( $path ) {
		if ( $path && is_readable( $path ) ) {
			include_once( $path );
			return true;
		}
		return false;
	}

	/**
	 * Auto-load WC classes on demand to reduce memory consumption.
	 *
	 * @param string $class
	 */
	public function autoload( $class ) {
		$class = strtolower( $class );

		if ( 0 !== strpos( $class, 'theme_name_' ) ) {
			return;
		}

		$file  = $this->get_file_name_from_class( $class );
		$path  = '';

		if ( strpos( $class, 'theme_name_walker_' ) === 0 ) {
			$path = $this->include_path . 'walkers/';
		} elseif ( strpos( $class, 'theme_name_widget_' ) === 0 ) {
			$path = $this->include_path . 'widgets/';
		} elseif ( strpos( $class, 'theme_name_customizer' ) === 0 ) {
			$path = $this->include_path . 'customizer/';
		}

		if ( empty( $path ) || ! $this->load_file( $path . $file ) ) {
			$this->load_file( $this->include_path . $file );
		}
	}
}

new Theme_name_Autoloader();
