<?php
/**
 * Functions
 *
 * @link       https://wegarh.com
 * @since      1.0.0
 *
 * @package    Smart Content Generator
 * @subpackage Smart Content Generator/admin
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! function_exists( 'deepaibrain_wpai_myselective_css_or_js' ) ) {
	/**
	 * Admin Js
	 */
	function deepaibrain_wpai_myselective_css_or_js() {
				$deepaibrain_wpai_art_file    = plugin_dir_url( __DIR__ ) . 'admin/data/art.json';
		        $deepaibrain_wpai_prompt_data = wp_remote_get( $deepaibrain_wpai_art_file );
		        $body             = wp_remote_retrieve_body( $deepaibrain_wpai_prompt_data );
		        $deepaibrain_wpai_prompt_data = json_decode( $body, true );

		        // Sanitize the randomly selected prompt before assigning it
		        $randomIndex      = mt_rand( 0, count( $deepaibrain_wpai_prompt_data['prompts'] ) - 1 );
		        $sanitizedPrompt = sanitize_text_field( $deepaibrain_wpai_prompt_data['prompts'][ $randomIndex ] );
		  		/*wp_add_inline_script( 'my-smart-content Generator', 'function getRandomPromptAi() { 
		    	var randomIndex = Math.floor( Math.random() * '.esc_html( count( $deepaibrain_wpai_prompt_data['prompts'] ) ) .');
		        document.getElementById( "ai_generator_image_title" ).value = '.wp_json_encode( $sanitizedPrompt ).';
		    	}' );*/
		?>
	
		<script type="text/javascript">
		    function getRandomPromptAi() { 
		        var randomIndex = Math.floor( Math.random() * <?php echo esc_html( count( $deepaibrain_wpai_prompt_data['prompts'] ) ); ?> );
		        document.getElementById( "ai_generator_image_title" ).value = <?php echo wp_json_encode( $sanitizedPrompt ); ?>;
		    }
		</script>

		<?php
	}
}
add_action( 'admin_enqueue_scripts', 'deepaibrain_wpai_myselective_css_or_js' );

if ( ! function_exists( 'deepaibrain_wpai_insert_attachment_from_url' ) ) {
	/**
	 * Insert image from image url
	 *
	 * @param string|int $image_url      The source file.
	 * @param string     $alt            The File Alternative Text.
	 * @param string     $title          The File Title.
	 * @param string     $caption        The File Caption.
	 * @param string     $description    The File Description.
	 */
	function deepaibrain_wpai_insert_attachment_from_url( $image_url, $alt, $title, $caption, $description ) {
		// Use File System.
		WP_Filesystem();
		global $wp_filesystem;
		// Include file.php.
		require_once ABSPATH . 'wp-admin/includes/file.php';
		$get_url   = wp_remote_get( $image_url );
		$raw_image = wp_remote_retrieve_body( $get_url );
		if ( $raw_image ) {
			$file_name = pathinfo( wp_parse_url( $image_url )['path'], PATHINFO_FILENAME ) . '.' . pathinfo( wp_parse_url( $image_url )['path'], PATHINFO_EXTENSION );

			$wp_upload_dir = wp_upload_dir();
			$filename_out  = $wp_upload_dir['path'] . '/';
			$file_path     = $wp_upload_dir['path'] . '/' . $file_name;
			$wp_filesystem->put_contents( $filename_out . $file_name, $raw_image );
			$file_type        = 'image/' . pathinfo( wp_parse_url( $image_url )['path'], PATHINFO_EXTENSION );
			$attachment_title = sanitize_file_name( $title );
			$post_info        = array(
				'guid'           => $wp_upload_dir['url'] . '/' . $file_name,
				'post_mime_type' => $file_type,
				'post_title'     => $title,
				'post_content'   => $description,
				'post_excerpt'   => $caption,
				'post_status'    => 'inherit',
			);

			$parent_post_id = null;

			// Create the attachment.
			$attach_id = wp_insert_attachment( $post_info, $file_path, $parent_post_id );

			// Include image.php.
			require_once ABSPATH . 'wp-admin/includes/image.php';

			// Generate the attachment metadata.
			$attach_data = wp_generate_attachment_metadata( $attach_id, $file_path );

			// Assign metadata to attachment.
			wp_update_attachment_metadata( $attach_id, $attach_data );

			update_post_meta( $attach_id, '_wp_attachment_image_alt', $alt );

			return $attach_id;
			// Image Saved.
		} else {
			echo 'Error Occured';
		}
	}
}


if ( ! function_exists( 'deepaibrain_wpai_save_ai_res_to_draft' ) ) {
	/**
	 * Save Ai response to the draft Post
	 */
	function deepaibrain_wpai_save_ai_res_to_draft() {
		if ( ! isset( $_POST['save_ai_res_nonce'] ) && ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['save_ai_res_nonce'] ) ), 'save_ai_res_nonce' ) ) {
			exit;
		}

		if ( ! current_user_can( 'edit_posts' ) ) {
			exit;
		}

		if ( isset( $_POST['ai_generated_title'] ) ) {
			$express_content_title = sanitize_text_field( wp_unslash( $_POST['ai_generated_title'] ) );
		}
		if ( isset( $_POST['deepaibrain_wpai_language'] ) ) {
			$deepaibrain_wpai_language = sanitize_text_field( wp_unslash( $_POST['wpai_language'] ) );
		}
		if ( isset( $_POST['ai_generated_content'] ) ) {
			$ai_generated_content = wp_kses_post( wp_unslash( $_POST['ai_generated_content'] ) );
		}
		if ( isset( $_POST['deepaibrain_wpai_post_tags'] ) ) {
			$deepaibrain_wpai_post_tags = sanitize_text_field( wp_unslash( $_POST['deepaibrain_wpai_post_tags'] ) );
		}
		if ( isset( $_POST['ai_generated_seo_desc'] ) ) {
			$ai_generated_seo_desc = sanitize_text_field( wp_unslash( $_POST['ai_generated_seo_desc'] ) );
		}
		if ( isset( $_POST['deepaibrain_wpai_featured_image_source'] ) ) {
			$deepaibrain_wpai_featured_image_source = sanitize_text_field( wp_unslash( $_POST['deepaibrain_wpai_featured_image_source'] ) );
		}
		if ( isset( $_POST['ai_custom_prompt_enable'] ) ) {
			$ai_custom_prompt_enable = sanitize_text_field( wp_unslash( $_POST['ai_custom_prompt_enable'] ) );
		}
		if ( isset( $_POST['ai_custom_prompt'] ) ) {
			$ai_custom_prompt = sanitize_text_field( wp_unslash( $_POST['ai_custom_prompt'] ) );
		}
		if ( isset( $_POST['deepaibrain_wpai_item_alt'] ) ) {
			$deepaibrain_wpai_item_alt = sanitize_text_field( wp_unslash( $_POST['deepaibrain_wpai_item_alt'] ) );
		}
		if ( isset( $_POST['deepaibrain_wpai_item_title'] ) ) {
			$deepaibrain_wpai_item_title = sanitize_text_field( wp_unslash( $_POST['deepaibrain_wpai_item_title'] ) );
		}
		if ( isset( $_POST['deepaibrain_wpai_item_caption'] ) ) {
			$deepaibrain_wpai_item_caption = sanitize_text_field( wp_unslash( $_POST['deepaibrain_wpai_item_caption'] ) );
		}
		if ( isset( $_POST['deepaibrain_wpai_item_description'] ) ) {
			$deepaibrain_wpai_item_description = sanitize_text_field( wp_unslash( $_POST['deepaibrain_wpai_item_description'] ) );
		}
		if ( isset( $_POST['generated_image_ai'] ) ) {
			$generated_image_ai = sanitize_url(wp_unslash( $_POST['generated_image_ai'] ));
		}
		if ( isset( $_POST['generated_image_pexel'] ) ) {
			$generated_image_pexel = sanitize_url(wp_unslash( $_POST['generated_image_pexel'] ));
		}

		$ai_post = array(
			'post_title'   => $express_content_title,
			'post_content' => $ai_generated_content,
			'post_status'  => 'draft',
			'post_author'  => 1,
		);

		$post_id = wp_insert_post( $ai_post );

		if ( $deepaibrain_wpai_post_tags ) {
			update_post_meta( $post_id, '_deepaibrain_wpai_post_tags', $deepaibrain_wpai_post_tags );
			if ( ! empty( sanitize_text_field( wp_unslash( $_POST['deepaibrain_wpai_post_tags'] ) ) ) ) {
				$deepaibrain_wpai_tags = array_map( 'trim', explode( ',', $deepaibrain_wpai_post_tags ) );
				if ( $deepaibrain_wpai_tags && is_array( $deepaibrain_wpai_tags ) && count( $deepaibrain_wpai_tags ) ) {
					wp_set_post_tags( $post_id, $deepaibrain_wpai_tags );
				}
			}
		}

		if ( $ai_custom_prompt_enable ) {
			update_post_meta( $post_id, 'ai_custom_prompt_enable', $ai_custom_prompt_enable );
		}

		if ( $ai_custom_prompt ) {
			update_post_meta( $post_id, 'ai_custom_prompt', $ai_custom_prompt );
		}

		if ( 'dalle' === $deepaibrain_wpai_featured_image_source ) {
			$attachment_id = wpai_insert_attachment_from_url( $generated_image_ai, $deepaibrain_wpai_item_alt, $deepaibrain_wpai_item_title, $deepaibrain_wpai_item_caption, $deepaibrain_wpai_item_description );

			set_post_thumbnail( $post_id, $attachment_id );

		} elseif ( 'pexels' === $deepaibrain_wpai_featured_image_source ) {
			$attachment_id = wpai_insert_attachment_from_url( $generated_image_pexel, $deepaibrain_wpai_item_alt, $deepaibrain_wpai_item_title, $deepaibrain_wpai_item_caption, $deepaibrain_wpai_item_description );

			set_post_thumbnail( $post_id, $attachment_id );
		}

		if ( $ai_generated_seo_desc ) {
			wpai_save_seo_description_to_post( $post_id, $ai_generated_seo_desc );
		}

		echo esc_url( get_site_url() ) . '/wp-admin/post.php?post=' . esc_attr( $post_id ) . '&action=edit';

		wp_die();
	}
}
add_action( 'wp_ajax_deepaibrain_wpai_save_ai_res_to_draft', 'deepaibrain_wpai_save_ai_res_to_draft' );
add_action( 'wp_ajax_nopriv_deepaibrain_wpai_save_ai_res_to_draft', 'deepaibrain_wpai_save_ai_res_to_draft' );


if ( ! function_exists( 'deepaibrain_wpai_seo_plugin_activated_check' ) ) {
	/**
	 * Check Seo Plugin activation
	 */
	function deepaibrain_wpai_seo_plugin_activated_check() {
		$activated = false;
		if ( is_plugin_active( 'wordpress-seo/wp-seo.php' ) ) {
			$activated = '_yoast_wpseo_metadesc';
		} elseif ( is_plugin_active( 'all-in-one-seo-pack/all_in_one_seo_pack.php' ) ) {
			$activated = '_aioseo_description';
		} elseif ( is_plugin_active( 'seo-by-rank-math/rank-math.php' ) ) {
			$activated = 'rank_math_description';
		}
		return $activated;
	}
}


if ( ! function_exists( 'deepaibrain_wpai_save_seo_description_to_post' ) ) {
	/**
	 * Save Seo Description
	 *
	 * @param int    $post_id        The Post ID.
	 * @param string $description    The Seo Description.
	 */
	function deepaibrain_wpai_save_seo_description_to_post( $post_id, $description ) {
		global $wpdb;
		update_post_meta( $post_id, '_deepaibrain_wpai_meta_description', $description );

		$seo_plugin_activated = wpai_seo_plugin_activated_check();
		if ( '_yoast_wpseo_metadesc' === $seo_plugin_activated ) {
			update_post_meta( $post_id, $seo_plugin_activated, $description );
		}

		if ( '_aioseo_description' === $seo_plugin_activated ) {
			update_post_meta( $post_id, $seo_plugin_activated, $description );
			$cache_key = 'prefix_post_' . $post_id;
				$check = wp_cache_get( $cache_key );
			if ( false === $check ) {
				$check = $wpdb->get_row( $wpdb->prepare( 'SELECT * FROM ' . $wpdb->prefix . 'aioseo_posts WHERE post_id=%d', $post_id ) );
				if ( $check ) {
					$wpdb->update(
						$wpdb->prefix . 'aioseo_posts',
						array(
							'description' => $description,
						),
						array(
							'post_id' => $post_id,
						)
					);
				} else {
					$wpdb->insert(
						$wpdb->prefix . 'aioseo_posts',
						array(
							'post_id'     => $post_id,
							'description' => $description,
							'created'     => gmdate( 'Y-m-d H:i:s' ),
							'updated'     => gmdate( 'Y-m-d H:i:s' ),
						)
					);
				}
				wp_cache_set( $cache_key, $check );
			}
		}

		if ( 'rank_math_description' === $seo_plugin_activated ) {
			update_post_meta( $post_id, $seo_plugin_activated, $description );
		}
	}
}


if ( ! function_exists( 'deepaibrain_wpai_add_custom_meta_box' ) ) {
	/**
	 * Create meta Box in Post
	 */
	function deepaibrain_wpai_add_custom_meta_box() {
		add_meta_box( 'custom-prompt-meta-box', 'Custom Prompt Meta Box', 'deepaibrain_wpai_custom_meta_box_markup', 'post' );
	}
}
add_action( 'add_meta_boxes', 'deepaibrain_wpai_add_custom_meta_box' );


if ( ! function_exists( 'deepaibrain_wpai_custom_meta_box_markup' ) ) {
	/**
	 * Create meta Box fields in post
	 *
	 * @param string|int $object    The Object.
	 */
	function deepaibrain_wpai_custom_meta_box_markup( $object ) {
		wp_nonce_field( basename( __FILE__ ), 'meta-box-nonce' );
		$ai_custom_prompt_enable = get_post_meta( $object->ID, 'ai_custom_prompt_enable', true );
		$ai_custom_prompt        = get_post_meta( $object->ID, 'ai_custom_prompt', true );

		?>
		<div class="mb-5">
			<label><input type="checkbox" class="ai_custom_prompt_enable" name="ai_custom_prompt_enable" 
				<?php
				if ( '1' === $ai_custom_prompt_enable ) {
					echo esc_html( 'checked' ); }
				?>
					>&nbsp;<?php esc_html_e( 'Enable', 'smart-content-generator' ); ?></label>
				</div>

				<div class="meta_custom_prompt_box" style="display: 
				<?php
				if ( '1' === $ai_custom_prompt_enable ) {
					echo 'block';
				} else {
					echo 'none'; }
				?>
					">
					<label><?php esc_html_e( 'Custom Prompt', 'smart-content-generator' ); ?></label>
					<textarea rows="8" class="ai_custom_prompt" name="ai_custom_prompt"><?php echo esc_html( $ai_custom_prompt ); ?> </textarea>
					<div class="deepaibrain_wpai_meta_custom_prompt_auto_error"></div>
				</div>
				<?php
	}
}


if ( ! function_exists( 'deepaibrain_wpai_save_custom_meta_box' ) ) {
	/**
	 * Save Meta Boxes
	 *
	 * @param int        $post_id    The Post ID.
	 * @param string|int $post       The Post.
	 * @param string|int $update     The Update.
	 */
	function deepaibrain_wpai_save_custom_meta_box( $post_id, $post, $update ) {
		if ( ! isset( $_POST['meta-box-nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['meta-box-nonce'] ) ), basename( __FILE__ ) ) ) {
			return $post_id;
		}

		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return $post_id;
		}

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return $post_id;
		}

		$slug = 'post';
		if ( $slug !== $post->post_type ) {
			return $post_id;
		}

		$ai_custom_prompt_enable = '';
		$ai_custom_prompt        = '';

		if ( isset( $_POST['ai_custom_prompt_enable'] ) ) {
			$ai_custom_prompt_enable = sanitize_text_field( wp_unslash( $_POST['ai_custom_prompt_enable'] ) );
		}
		update_post_meta( $post_id, 'ai_custom_prompt_enable', $ai_custom_prompt_enable );

		if ( isset( $_POST['ai_custom_prompt'] ) ) {
			$ai_custom_prompt = sanitize_text_field( wp_unslash( $_POST['ai_custom_prompt'] ) );
		}
		update_post_meta( $post_id, 'ai_custom_prompt', $ai_custom_prompt );

	}
}
add_action( 'save_post', 'deepaibrain_wpai_save_custom_meta_box', 10, 3 );


if ( ! function_exists( 'deepaibrain_wpai_generated_ai_image_to_save' ) ) {
	/**
	 * Save Ai generated images
	 */
	function deepaibrain_wpai_generated_ai_image_to_save() {
		if ( ! isset( $_POST['save_to_media_nonce'] ) && ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['save_to_media_nonce'] ), 'save_to_media_nonce' ) ) ) {
			exit;
		}
		if ( isset( $_POST['generated_ai_image'] ) ) {
			$generated_ai_image = map_deep( sanitize_url(wp_unslash( $_POST['generated_ai_image'] )), 'esc_url_raw' );
		}
		if ( isset( $_POST['deepaibrain_wpai_item_alt'] ) ) {
			$deepaibrain_wpai_item_alt = sanitize_text_field( wp_unslash( $_POST['deepaibrain_wpai_item_alt'] ) );
		}
		if ( isset( $_POST['deepaibrain_wpai_item_title'] ) ) {
			$deepaibrain_wpai_item_title = sanitize_text_field( wp_unslash( $_POST['deepaibrain_wpai_item_title'] ) );
		}
		if ( isset( $_POST['deepaibrain_wpai_item_caption'] ) ) {
			$deepaibrain_wpai_item_caption = sanitize_text_field( wp_unslash( $_POST['deepaibrain_wpai_item_caption'] ) );
		}
		if ( isset( $_POST['deepaibrain_wpai_item_description'] ) ) {
			$deepaibrain_wpai_item_description = sanitize_text_field( wp_unslash( $_POST['deepaibrain_wpai_item_description'] ) );
		}

		if ( $generated_ai_image ) {
			foreach ( $generated_ai_image as $key => $value ) {
				deepaibrain_wpai_insert_attachment_from_url( $value, $deepaibrain_wpai_item_alt, $deepaibrain_wpai_item_title, $deepaibrain_wpai_item_caption, $deepaibrain_wpai_item_description );
			}
		}
		wp_die();
	}
}
add_action( 'wp_ajax_deepaibrain_wpai_generated_ai_image_to_save', 'deepaibrain_wpai_generated_ai_image_to_save' );
add_action( 'wp_ajax_nopriv_deepaibrain_wpai_generated_ai_image_to_save', 'deepaibrain_wpai_generated_ai_image_to_save' );



if ( ! function_exists( 'deepaibrain_wpai_modal_image_save_function' ) ) {
	/**
	 * Save modal image
	 */
	function deepaibrain_wpai_modal_image_save_function() {
		if ( ! isset( $_POST['edit_image_save_nonce'] ) && ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['edit_image_save_nonce'] ), 'edit_image_save_nonce' ) ) ) {
			exit;
		}
		if ( isset( $_POST['image_edit_src'] ) ) {
			$image_edit_src = sanitize_url(wp_unslash( $_POST['image_edit_src'] ));
		}
		if ( isset( $_POST['deepaibrain_wpai_edit_item_alt'] ) ) {
			$deepaibrain_wpai_edit_item_alt = sanitize_text_field( wp_unslash( $_POST['deepaibrain_wpai_edit_item_alt'] ) );
		}
		if ( isset( $_POST['deepaibrain_wpai_edit_item_title'] ) ) {
			$deepaibrain_wpai_edit_item_title = sanitize_text_field( wp_unslash( $_POST['deepaibrain_wpai_edit_item_title'] ) );
		}
		if ( isset( $_POST['deepaibrain_wpai_edit_item_caption'] ) ) {
			$deepaibrain_wpai_edit_item_caption = sanitize_text_field( wp_unslash( $_POST['deepaibrain_wpai_edit_item_caption'] ) );
		}
		if ( isset( $_POST['deepaibrain_wpai_edit_item_description'] ) ) {
			$deepaibrain_wpai_edit_item_description = sanitize_text_field( wp_unslash( $_POST['deepaibrain_wpai_edit_item_description'] ) );
		}

		if ( $image_edit_src ) {
			deepaibrain_wpai_insert_attachment_from_url( $image_edit_src, $deepaibrain_wpai_edit_item_alt, $deepaibrain_wpai_edit_item_title, $deepaibrain_wpai_edit_item_caption, $deepaibrain_wpai_edit_item_description );
		}
		wp_die();
	}
}
add_action( 'wp_ajax_deepaibrain_wpai_modal_image_save_function', 'deepaibrain_wpai_modal_image_save_function' );
add_action( 'wp_ajax_nopriv_deepaibrain_wpai_modal_image_save_function', 'deepaibrain_wpai_modal_image_save_function' );



if ( ! function_exists( 'deepaibrain_wpai_is_pro' ) ) {
	/**
	 * Check is plan premium Only
	 */
	function deepaibrain_wpai_is_pro() {
		return deepaibrain_wpai_ag_fs()->is_plan__premium_only( 'premium' );
	}
}

if ( deepaibrain_wpai_is_pro() ) {
	$get_data = get_option( 'deepaibrain_premium_plugin_data' );
	if ( empty( $get_data ) ) {
		$new_list = array(
			'paip'    => 'paipv',
			'paipn'   => 'paipnv',
			'created' => gmdate( 'Y-m-d H:i:s' ),
		);
		update_option( 'deepaibrain_premium_plugin_data', $new_list );

		$get_data = get_option( 'deepaibrain_premium_plugin_data' );
		if ( isset( $_SERVER['SERVER_NAME'] ) ) {
			$domain_name = sanitize_text_field( wp_unslash( $_SERVER['SERVER_NAME'] ) );
		}

		$headers = array(
			'Content-Type' => 'application/json',
		);

		$body = array(
			'domain'  => $domain_name,
			'status'  => 'activate',
			'paip'    => $get_data['paip'],
			'paipn'   => $get_data['paipn'],
			'created' => $get_data['created'],
		);

		wp_remote_post(
			DEEPAIBRAIN_BASE_URL_REST_API . '/rest-api/items/update.php',
			array(
				'headers' => $headers,
				'body'    => wp_json_encode( $body ),
			)
		);
	}
}

