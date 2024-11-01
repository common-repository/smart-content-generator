<?php

/**
 * Fired during plugin deactivation
 *
 * @link       https://webgarh.com/
 * @since      1.0.0
 *
 * @package    Smart Content Generator
 * @subpackage Smart Content Generator/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Smart Content Generator
 * @subpackage Smart Content Generator/includes
 * @author     webgarh <info@cwebconsultants.com>
 */
class deepaibrain_wpai_product_Deactivator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate() {

		$get_data = get_option('deepaibrain_premium_plugin_data');

		if (!empty($get_data)) {
			$paip = $get_data['paip'];
			$paipn = $get_data['paipn'];
			$created = $get_data['created'];
		}else {
			$paip = 'paipf';
			$paipn = 'paipf';
			$created = gmdate('Y-m-d H:i:s');
		}

        $domain_name = sanitize_text_field($_SERVER['SERVER_NAME']);

        $headers = array(
                'Content-Type' => 'application/json'
            );

         $body = array(
            'domain' => $domain_name,
            'status' => 'deactivate',
            'paip'   => $paip,
            'paipn' => $paipn,              
            'created' => $created             
            );
       

       wp_remote_post(DEEPAIBRAIN_BASE_URL_REST_API.'/rest-api/items/update.php', array(
            'headers' => $headers,
            'body' => json_encode($body)
        ));

	}

}
