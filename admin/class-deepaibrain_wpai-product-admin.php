<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://wegarh.com
 * @since      1.0.0
 *
 * @package    Smart Content Generator
 * @subpackage Smart Content Generator/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Smart Content Generator
 * @subpackage Smart Content Generator/admin
 * @author     webgarh <info@cwebconsultants.com>
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Product Admin Class
 */
class deepaibrain_wpai_Product_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param    string    $plugin_name       The name of this plugin.
	 * @param    string    $plugin_domain       The domain of this plugin.
	 * @var      string    $version    The current version of this plugin.
	 */

	private $plugin_domain;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string $plugin_name       The name of this plugin.
	 * @param      string $version    The version of this plugin.
	 * @param      string $plugin_domain    The domain of this plugin.
	 */
	public function __construct( $plugin_name, $version, $plugin_domain ) {
		$this->plugin_name   = $plugin_name;
		$this->version       = $version;
		$this->plugin_domain = $plugin_domain;
		add_action( 'admin_menu', array( $this, 'deepaibrain_wpai_product_admin_menu' ) );
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function deepaibrain_wpai_product_enqueue_styles() {
		wp_enqueue_style( 'admin-css', plugin_dir_url( __FILE__ ) . 'css/admin.css', array(), $this->version, 'all' );
		wp_enqueue_style( 'ai-content-generator', plugins_url( 'css/ai-content-generator-admin.css', __FILE__ ), false, $this->version, 'all' );
		wp_enqueue_style( 'font-awesome', plugins_url( 'css/font-awesome.min.css', __FILE__ ), false, $this->version, 'all' );
		wp_enqueue_style( 'jquery-ui', plugins_url( 'css/jquery-ui.css', __FILE__ ), false, $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function deepaibrain_wpai_product_enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Video_Uploader_For_Tutorlms_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Video_Uploader_For_Tutorlms_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/admin.js', array( 'jquery' ), $this->version, false );
			$arr = array(
				'ajaxurl' => admin_url( 'admin-ajax.php' ),
			);
			wp_localize_script( $this->plugin_name, 'obj', $arr );
			wp_enqueue_script( $this->plugin_name );

			wp_enqueue_script( 'jquery-ui-sortable' );

	}

	/**
	 * Admin Page
	 */
	public function deepaibrain_wpai_product_admin_menu() {
		add_menu_page( __( 'Smart Content Generator', 'smart_content_generator' ), __( 'Smart Content Generator', 'smart_content_generator' ), 'manage_options', 'smart_content_generator', array( $this, 'deepaibrain_wpai_product_settings_page_contents' ), 'dashicons-welcome-write-blog', 5 );
	}

	/****************Admin settings page content*********************/
	public function deepaibrain_wpai_product_settings_page_contents() {

		if ( isset( $_POST['save_settings_info'] ) && isset( $_POST['save_settings_nonce'] ) ) {
			if ( ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['save_settings_nonce'] ) ), 'save_settings_nonce' ) ) {
				exit;
			}
			if ( isset( $_POST['deepaibrain_openapi_api'] ) ) {
				$deepaibrain_openapi_api = sanitize_text_field( wp_unslash( $_POST['deepaibrain_openapi_api'] ) );
				update_option( 'deepaibrain_openapi_api', $deepaibrain_openapi_api );
			}
		}

		$deepaibrain_openapi_api = get_option( 'deepaibrain_openapi_api' );
		if ( isset( $_SERVER['SERVER_NAME'] ) ) {
			$domain_name = sanitize_text_field( wp_unslash( $_SERVER['SERVER_NAME'] ) );
		}

		$tabs = array(
			'configure' => __( 'Configure', 'smart-content-generator' ),
			'content'   => __( 'Content', 'smart-content-generator' ),
			'images'    => __( 'Images', 'smart-content-generator' ),
		);
		if ( ! empty( $_GET['tab'] ) && isset( $_GET['tab'] ) ) {
			$current = sanitize_text_field( wp_unslash( $_GET['tab'] ) );
		}
		if ( empty( $current ) ) {
			$current = 'configure';
		}
		$html  = '<h2>Smart Content Generator</h2>';
		$html .= '<h2 class="nav-tab-wrapper">';
		foreach ( $tabs as $tab => $name ) {
			$class = ( $tab === $current ) ? 'nav-tab-active' : '';
			$html .= '<a class="nav-tab ' . $class . '" href="?page=smart_content_generator&tab=' . $tab . '">' . $name . '</a>';
		}
		$html        .= '</h2>';
		$allowed_html = array(
			'a'  => array(
				'href'  => array(),
				'class' => array(),
			),
			'h2' => array(
				'class' => array(),
			),
		);

		echo wp_kses( $html, $allowed_html );

		$tab            = ( ! empty( $_GET['tab'] ) ) ? sanitize_text_field( wp_unslash( $_GET['tab'] ) ) : 'configure';
		$ciphering      = 'AES-128-CTR';
		$iv_length      = openssl_cipher_iv_length( $ciphering );
		$options        = 0;
		$encryption_iv  = '1234567891011121';
		$encryption_key = 'AiGeneration';
		$encoded_api    = openssl_encrypt( $deepaibrain_openapi_api, $ciphering, $encryption_key, $options, $encryption_iv );
		?>
<input type="hidden" name="deepaibrain_openapi_api_key" id="deepaibrain_openapi_api_key" value="<?php echo esc_attr( $encoded_api ); ?>">
<input type="hidden" name="domain_name" id="domain_name" value="<?php echo esc_attr( $domain_name ); ?>">

		<?php if ( 'configure' === $tab ) { ?>
	<form method="POST" class="setting-form">
		<table class="form-table">
		<tbody>   
			<tr>
			<th scope="row" class="th-row">
			<label for="deepaibrain_openapi_api"><?php echo esc_html__( 'OPEN AI - API Key', 'smart-content-generator' ); ?></label>
			</th>
			<td>
			<input type="text" class="regular-text" id="deepaibrain_openapi_api" name="deepaibrain_openapi_api" value="<?php echo esc_attr( $deepaibrain_openapi_api ); ?> ">
				<a class="deepaibrain_wpai_help_link" href="https://platform.openai.com/docs/api-reference/introduction" target="_blank"><i><?php echo esc_html__( 'Get Your Open Api Key', 'smart-content-generator' ); ?></i></a>
			</td> 
			</tr>        
		</tbody>
		</table>
		<p class="submit">
			<?php $save_settings_nonce = wp_create_nonce( 'save_settings_nonce' ); ?> 
			<input type="hidden" name="save_settings_nonce" value="<?php echo esc_attr( $save_settings_nonce ); ?>">
			<input type="submit" name="save_settings_info" id="submit" class="button button-primary" value="<?php echo esc_html__( 'Save', 'smart-content-generator' ); ?>">
		</p>
	</form>
			<?php
		} elseif ( 'content' === $tab ) {
			require plugin_dir_path( dirname( __FILE__ ) ) . 'admin/content-generator.php';
		} elseif ( 'images' === $tab ) {
			require plugin_dir_path( dirname( __FILE__ ) ) . 'admin/image-generator.php';
		}
	}
}
