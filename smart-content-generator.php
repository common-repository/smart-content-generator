<?php
/**
 * Smart Content Generator
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://8peak.net/
 * @since             1.0.0
 * @package          smart-content-generator
 *
 * @wordpress-plugin
 * Plugin Name:       Smart Content Generator
 * Description:       Smart Content Generator, Content Writer, Auto Content Writer, Image Generator, SEO optimizer.
 * Version:           1.0.0
 * Author:            8peaks VOF
 * Author URI:        https://8peak.net/
 * License:           GPL-2.0+
 * License URI:       https://8peak.net/
 * Text Domain:       smart-content-generator
 * Domain Path:       /languages
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( 'Invalid request.' );
}

define( 'DEEPAIBRAIN_BASE_URL_REST_API', 'https://app.deepaibrain.com/aigeneration/chatgpt' );

if ( ! function_exists( 'deepaibrain_wpai_ag_fs' ) ) {
	/**
	 * Create a helper function for easy SDK access.
	 */
	function deepaibrain_wpai_ag_fs() {
		global $deepaibrain_wpai_ag_fs;

		if ( ! isset( $deepaibrain_wpai_ag_fs ) ) {
			/**
			 * Include Freemius SDK.
			 */
			require_once dirname( __FILE__ ) . '/freemius/start.php';

			$deepaibrain_wpai_ag_fs = fs_dynamic_init(
				array(
					'id'                  => '12792',
					'slug'                => 'ai-generator',
					'type'                => 'plugin',
					'public_key'          => 'pk_885cd4f2fa3cb53a136c9e6bf21ee',
					'is_premium'          => true,
					'premium_suffix'      => 'Premium',
					// If your plugin is a serviceware, set this option to false.
					'has_premium_version' => true,
					'has_addons'          => false,
					'has_paid_plans'      => true,
					'menu'                => array(
						'slug'    => 'smart_content_generator',
						'support' => false,
					),
					'is_live'             => true,
				)
			);
		}
		return $deepaibrain_wpai_ag_fs;
	}

	/**
	* Init Freemius.
	*/
	deepaibrain_wpai_ag_fs();
	/**
	* Signal that SDK was initiated.
	*/
	do_action( 'deepaibrain_wpai_ag_fs_loaded' );
}

if ( ! function_exists( 'deepaibrain_wpai_product_activate' ) ) {
	/**
	 * The code that runs during plugin activation.
	 */
	function deepaibrain_wpai_product_activate() {
		require_once plugin_dir_path( __FILE__ ) . 'includes/class-deepaibrain_wpai-product-activator.php';
		deepaibrain_wpai_product_Activator::activate();
	}
}

if ( ! function_exists( 'deepaibrain_wpai_product_deactivate' ) ) {
	/**
	 * The code that runs during plugin deactivation.
	 */
	function deepaibrain_wpai_product_deactivate() {
		require_once plugin_dir_path( __FILE__ ) . 'includes/class-deepaibrain_wpai-product-deactivator.php';
		deepaibrain_wpai_product_Deactivator::deactivate();
	}
}

register_activation_hook( __FILE__, 'deepaibrain_wpai_product_activate' );
register_deactivation_hook( __FILE__, 'deepaibrain_wpai_product_deactivate' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-deepaibrain_wpai-product.php';
require plugin_dir_path( __FILE__ ) . 'admin/functions.php';

if ( ! function_exists( 'run_deepaibrain_wpai_product' ) ) {
	/**
	 * Begins execution of the plugin.
	 *
	 * Since everything within the plugin is registered via hooks,
	 * then kicking off the plugin from this point in the file does
	 * not affect the page life cycle.
	 *
	 * @since    1.0.0
	 */
	function run_deepaibrain_wpai_product() {
		$plugin = new deepaibrain_wpai_product();
		$plugin->run();
	}
}
run_deepaibrain_wpai_product();

