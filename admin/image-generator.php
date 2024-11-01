<?php
/**
 * Image Generator
 *
 * @link       https://wegarh.com
 * @since      1.0.0
 *
 * @package    Smart Content Generator
 * @subpackage Smart Content Generator/admin
 */

$deepaibrain_wpai_art_file     = plugin_dir_url( __DIR__ ) . 'admin/data/art.json';
$deepaibrain_wpai_art_data     = wp_remote_get( $deepaibrain_wpai_art_file );
$body              = wp_remote_retrieve_body( $deepaibrain_wpai_art_data );
$deepaibrain_wpai_painter_data = json_decode( $body, true );

$deepaibrain_wpai_photo_file = plugin_dir_url( __DIR__ ) . 'admin/data/photo.json';
$deepaibrain_wpai_photo_data = wp_remote_get( $deepaibrain_wpai_photo_file );
$body            = wp_remote_retrieve_body( $deepaibrain_wpai_photo_data );
$deepaibrain_wpai_photo_data = json_decode( $body, true );

if ( isset( $_SERVER['SERVER_NAME'] ) ) {
	$domain_name = sanitize_text_field( wp_unslash( $_SERVER['SERVER_NAME'] ) );
}

$headers = array(
	'Content-Type' => 'application/json',
);

if ( deepaibrain_wpai_is_pro() ) {
	$tabs_action = array(
		'dall-e'           => __( 'DALL-E', 'smart-content-generator' ),
		'stable-diffusion' => __( 'Stable Diffusion', 'smart-content-generator' ),
	);
} else {
	$tabs_action = array(
		'dall-e' => __( 'DALL-E', 'smart-content-generator' ),
	);
}
if ( ! empty( $_GET['action'] ) && isset( $_GET['action'] ) && isset( $_GET['tabs_nonce'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_GET['tabs_nonce'] ) ), 'tabs_nonce' ) ) {
	$current = sanitize_text_field( wp_unslash( $_GET['action'] ) );
}

if ( ! empty( $_GET['tab'] ) ) {
	$tab_main = sanitize_text_field( wp_unslash( $_GET['tab'] ) );
}

if ( 'images' === $tab_main && 'stable-diffusion' !== $current ) {
	$current = 'dall-e';
}

$html_action = '';

$html_action .= '<h2 class="nav-tab-wrapper" style="margin-top: 20px;">';
foreach ( $tabs_action as $tab_action => $name ) {
	$class        = ( $tab_action === $current ) ? 'nav-tab-active' : '';
	$tabs_nonce   = wp_create_nonce( 'tabs_nonce' );
	$html_action .= '<a class="nav-tab ' . esc_html( $class ) . '" href="?page=smart_content_generator&tab=' . esc_html( $tab_main ) . '&action=' . esc_html( $tab_action ) . '&tabs_nonce=' . esc_html( $tabs_nonce ) . '">' . esc_html( $name ) . '</a>';
}
$html_action .= '</h2>';
$allowed_html = array(
	'a'  => array(
		'href'  => array(),
		'class' => array(),
	),
	'h2' => array(
		'class' => array(),
		'style' => array(),
	),
);

echo wp_kses( $html_action, $allowed_html );

$tab_action = ( ! empty( $_GET['action'] ) ) ? sanitize_text_field( wp_unslash( $_GET['action'] ) ) : 'dall-e';

if ( 'dall-e' === $tab_action ) {
	?>
	<div id="filter_action" class="filter-wrapper">
		<div class="deepaibrain_wpai-mb-5">
			<?php
			echo '<label for="artist" class="deepaibrain_wpai-form-label">' . esc_html__( 'Artist', 'smart-content-generator' ) . '</label>';
			echo '<select class="deepaibrain_wpai-input" name="artist" id="artist">';
			foreach ( $deepaibrain_wpai_painter_data['painters'] as $key => $value ) {
				echo '<option' . ( isset( $deepaibrain_wpai_image_settings['artist'] ) && $deepaibrain_wpai_image_settings['artist'] === $value ? ' selected' : '' ) . ' value="' . esc_html( $value ) . '">' . esc_html( $value ) . '</option>';
			}
			echo '</select>';
			?>
		</div>
		<div class="deepaibrain_wpai-mb-5">
			<?php
			echo '<label for="art_style" class="deepaibrain_wpai-form-label">' . esc_html__( 'Style', 'smart-content-generator' ) . '</label>';
			echo '<select class="deepaibrain_wpai-input" name="art_style" id="art_style">';
			foreach ( $deepaibrain_wpai_painter_data['styles'] as $key => $value ) {
				echo '<option' . ( isset( $deepaibrain_wpai_image_settings['art_style'] ) && $deepaibrain_wpai_image_settings['art_style'] === $value ? ' selected' : '' ) . ' value="' . esc_html( $value ) . '">' . esc_html( $value ) . '</option>';
			}
			echo '</select>';
			?>
		</div>
		<div class="deepaibrain_wpai-mb-5">
			<?php
			echo '<label for="photography_style" class="deepaibrain_wpai-form-label">' . esc_html__( 'Photography', 'smart-content-generator' ) . '</label>';
			echo '<select class="deepaibrain_wpai-input" name="photography_style" id="photography_style">';
			foreach ( $deepaibrain_wpai_photo_data['photography_style'] as $key => $value ) {
				echo '<option' . ( isset( $deepaibrain_wpai_image_settings['photography_style'] ) && $deepaibrain_wpai_image_settings['photography_style'] === $value ? ' selected' : '' ) . ' value="' . esc_html( $value ) . '">' . esc_html( $value ) . '</option>';
			}
			echo '</select>';
			?>
		</div>
		<div class="deepaibrain_wpai-mb-5">
			<?php
			echo '<label for="lighting" class="deepaibrain_wpai-form-label">' . esc_html__( 'Lighting', 'smart-content-generator' ) . '</label>';
			echo '<select class="deepaibrain_wpai-input" name="lighting" id="lighting">';
			foreach ( $deepaibrain_wpai_photo_data['lighting'] as $key => $value ) {
				echo '<option' . ( isset( $deepaibrain_wpai_image_settings['lighting'] ) && $deepaibrain_wpai_image_settings['lighting'] === $value ? ' selected' : '' ) . ' value="' . esc_html( $value ) . '">' . esc_html( $value ) . '</option>';
			}
			echo '</select>';
			?>
		</div>
		<div class="deepaibrain_wpai-mb-5">
			<?php
			echo '<label for="subject" class="deepaibrain_wpai-form-label">' . esc_html__( 'Subject', 'smart-content-generator' ) . '</label>';
			echo '<select class="deepaibrain_wpai-input" name="subject" id="subject">';
			foreach ( $deepaibrain_wpai_photo_data['subject'] as $key => $value ) {
				echo '<option' . ( isset( $deepaibrain_wpai_image_settings['subject'] ) && $deepaibrain_wpai_image_settings['subject'] === $value ? ' selected' : '' ) . ' value="' . esc_html( $value ) . '">' . esc_html( $value ) . '</option>';
			}
			echo '</select>';
			?>
		</div>
		<div class="deepaibrain_wpai-mb-5">
			<?php
			echo '<label for="camera_settings" class="deepaibrain_wpai-form-label">' . esc_html__( 'Camera', 'smart-content-generator' ) . '</label>';
			echo '<select class="deepaibrain_wpai-input" name="camera_settings" id="camera_settings">';
			foreach ( $deepaibrain_wpai_photo_data['camera_settings'] as $key => $value ) {
				echo '<option' . ( isset( $deepaibrain_wpai_image_settings['camera_settings'] ) && $deepaibrain_wpai_image_settings['camera_settings'] === $value ? ' selected' : '' ) . ' value="' . esc_html( $value ) . '">' . esc_html( $value ) . '</option>';
			}
			echo '</select>';
			?>
		</div>
		<div class="deepaibrain_wpai-mb-5">
			<?php
			echo '<label for="composition" class="deepaibrain_wpai-form-label">' . esc_html__( 'Composition', 'smart-content-generator' ) . '</label>';
			echo '<select class="deepaibrain_wpai-input" name="composition" id="composition">';
			foreach ( $deepaibrain_wpai_photo_data['composition'] as $key => $value ) {
				echo '<option' . ( isset( $deepaibrain_wpai_image_settings['composition'] ) && $deepaibrain_wpai_image_settings['composition'] === $value ? ' selected' : '' ) . ' value="' . esc_html( $value ) . '">' . esc_html( $value ) . '</option>';
			}
			echo '</select>';
			?>
		</div>
		<div class="deepaibrain_wpai-mb-5">
			<?php
			echo '<label for="resolution" class="deepaibrain_wpai-form-label">' . esc_html__( 'Resolution', 'smart-content-generator' ) . '</label>';
			echo '<select class="deepaibrain_wpai-input" name="resolution" id="resolution">';
			foreach ( $deepaibrain_wpai_photo_data['resolution'] as $key => $value ) {
				echo '<option' . ( isset( $deepaibrain_wpai_image_settings['resolution'] ) && $deepaibrain_wpai_image_settings['resolution'] === $value ? ' selected' : '' ) . ' value="' . esc_html( $value ) . '">' . esc_html( $value ) . '</option>';
			}
			echo '</select>';
			?>
		</div>
		<div class="deepaibrain_wpai-mb-5">
			<?php
			echo '<label for="color" class="deepaibrain_wpai-form-label">' . esc_html__( 'Color', 'smart-content-generator' ) . '</label>';
			echo '<select class="deepaibrain_wpai-input" name="color" id="color">';
			foreach ( $deepaibrain_wpai_photo_data['color'] as $key => $value ) {
				echo '<option' . ( isset( $deepaibrain_wpai_image_settings['color'] ) && $deepaibrain_wpai_image_settings['color'] === $value ? ' selected' : '' ) . ' value="' . esc_html( $value ) . '">' . esc_html( $value ) . '</option>';
			}
			echo '</select>';
			?>
		</div>
		<div class="deepaibrain_wpai-mb-5">
			<?php
			echo '<label for="special_effects" class="deepaibrain_wpai-form-label">' . esc_html__( 'Special Effects', 'smart-content-generator' ) . '</label>';
			echo '<select class="deepaibrain_wpai-input" name="special_effects" id="special_effects">';
			foreach ( $deepaibrain_wpai_photo_data['special_effects'] as $key => $value ) {
				echo '<option' . ( isset( $deepaibrain_wpai_image_settings['special_effects'] ) && $deepaibrain_wpai_image_settings['special_effects'] === $value ? ' selected' : '' ) . ' value="' . esc_html( $value ) . '">' . esc_html( $value ) . '</option>';
			}
			echo '</select>';
			?>
		</div>

		<div class="deepaibrain_wpai-mb-5">
			<?php
			echo '<label for="img_size" class="deepaibrain_wpai-form-label">' . esc_html__( 'Size', 'smart-content-generator' ) . '</label>';
			echo '<select class="deepaibrain_wpai-input" name="img_size" id="img_size">';

			echo '<option value="256x256">' . esc_html__( '256x256', 'smart-content-generator' ) . '</option>';
			echo '<option value="512x512">' . esc_html__( '512x512', 'smart-content-generator' ) . '</option>';
			echo '<option value="1024x1024">' . esc_html__( '1024x1024', 'smart-content-generator' ) . '</option>';

			echo '</select>';
			?>
		</div>


		<div class="photos_tab_content">
			<form method="POST" class="data-form" style="margin: 12px 0px 0px 0px;">
				<table class="form-table">
					<tbody>               
						<tr>
							<td style="padding: 0;">
								<label><?php echo esc_html__( 'Prompt', 'smart-content-generator' ); ?></label>                  
								<textarea name="ai_generator_image_title" id="ai_generator_image_title" rows="2" cols="50"><?php echo esc_html( $deepaibrain_wpai_painter_data['prompts'][ array_rand( $deepaibrain_wpai_painter_data['prompts'] ) ] ); ?></textarea>
							</td> 
						</tr>
					</tbody>
				</table>
				<p class="submit">
					<button class="button button-primary deepaibrain_wpai-button" type="button" onclick="getRandomPromptAi()"><?php echo esc_html__( 'Surprise Me', 'smart-content-generator' ); ?></button>
					<button type="button" id="generate_ai_images" class="button button-primary"><?php echo esc_html__( 'Generate', 'smart-content-generator' ); ?></button>
					<img class="loading_spinner" src="<?php echo esc_url( plugin_dir_url( __FILE__ ) . 'img/spinner-2x.gif' ); ?>">
				</p>
			</form>


			<p class="success_msg" style="display: none;">Successfully Saved!</p>
			<div class="wrapper" id="ai_images_data">

			</div>
			<p class="submit save_to_media" style="width: 100%;">
				<?php $save_to_media_nonce = wp_create_nonce( 'save_to_media_nonce' ); ?> 
				<input type="hidden" id="save_to_media_nonce" value="<?php echo esc_attr( $save_to_media_nonce ); ?>">
				<button type="button" id="save_to_media" class="button button-primary"><?php echo esc_html__( 'Save', 'smart-content-generator' ); ?></button>
				<img class="spinner_save_media" src="<?php echo esc_url( plugin_dir_url( __FILE__ ) . 'img/spinner-2x.gif' ); ?>">
			</p> 

		</div>

	</div>

<?php } elseif ( 'stable-diffusion' === $tab_action && deepaibrain_wpai_is_pro() ) { ?>

	<div id="filter_action" class="filter-wrapper">
		<div class="deepaibrain_wpai-mb-5">
			<?php
			echo '<label for="artist" class="deepaibrain_wpai-form-label">' . esc_html__( 'Artist', 'smart-content-generator' ) . '</label>';
			echo '<select class="deepaibrain_wpai-input" name="artist" id="artist">';
			foreach ( $deepaibrain_wpai_painter_data['painters'] as $key => $value ) {
				echo '<option' . ( isset( $deepaibrain_wpai_image_settings['artist'] ) && $deepaibrain_wpai_image_settings['artist'] === $value ? ' selected' : '' ) . ' value="' . esc_html( $value ) . '">' . esc_html( $value ) . '</option>';
			}
			echo '</select>';
			?>
		</div>
		<div class="deepaibrain_wpai-mb-5">
			<?php
			echo '<label for="art_style" class="deepaibrain_wpai-form-label">' . esc_html__( 'Style', 'smart-content-generator' ) . '</label>';
			echo '<select class="deepaibrain_wpai-input" name="art_style" id="art_style">';
			foreach ( $deepaibrain_wpai_painter_data['styles'] as $key => $value ) {
				echo '<option' . ( isset( $deepaibrain_wpai_image_settings['art_style'] ) && $deepaibrain_wpai_image_settings['art_style'] === $value ? ' selected' : '' ) . ' value="' . esc_html( $value ) . '">' . esc_html( $value ) . '</option>';
			}
			echo '</select>';
			?>
		</div>
		<div class="deepaibrain_wpai-mb-5">
			<?php
			echo '<label for="photography_style" class="deepaibrain_wpai-form-label">' . esc_html__( 'Photography', 'smart-content-generator' ) . '</label>';
			echo '<select class="deepaibrain_wpai-input" name="photography_style" id="photography_style">';
			foreach ( $deepaibrain_wpai_photo_data['photography_style'] as $key => $value ) {
				echo '<option' . ( isset( $deepaibrain_wpai_image_settings['photography_style'] ) && $deepaibrain_wpai_image_settings['photography_style'] === $value ? ' selected' : '' ) . ' value="' . esc_html( $value ) . '">' . esc_html( $value ) . '</option>';
			}
			echo '</select>';
			?>
		</div>
		<div class="deepaibrain_wpai-mb-5">
			<?php
			echo '<label for="lighting" class="deepaibrain_wpai-form-label">' . esc_html__( 'Lighting', 'smart-content-generator' ) . '</label>';
			echo '<select class="deepaibrain_wpai-input" name="lighting" id="lighting">';
			foreach ( $deepaibrain_wpai_photo_data['lighting'] as $key => $value ) {
				echo '<option' . ( isset( $deepaibrain_wpai_image_settings['lighting'] ) && $deepaibrain_wpai_image_settings['lighting'] === $value ? ' selected' : '' ) . ' value="' . esc_html( $value ) . '">' . esc_html( $value ) . '</option>';
			}
			echo '</select>';
			?>
		</div>
		<div class="deepaibrain_wpai-mb-5">
			<?php
			echo '<label for="subject" class="deepaibrain_wpai-form-label">' . esc_html__( 'Subject', 'smart-content-generator' ) . '</label>';
			echo '<select class="deepaibrain_wpai-input" name="subject" id="subject">';
			foreach ( $deepaibrain_wpai_photo_data['subject'] as $key => $value ) {
				echo '<option' . ( isset( $deepaibrain_wpai_image_settings['subject'] ) && $deepaibrain_wpai_image_settings['subject'] === $value ? ' selected' : '' ) . ' value="' . esc_html( $value ) . '">' . esc_html( $value ) . '</option>';
			}
			echo '</select>';
			?>
		</div>
		<div class="deepaibrain_wpai-mb-5">
			<?php
			echo '<label for="camera_settings" class="deepaibrain_wpai-form-label">' . esc_html__( 'Camera', 'smart-content-generator' ) . '</label>';
			echo '<select class="deepaibrain_wpai-input" name="camera_settings" id="camera_settings">';
			foreach ( $deepaibrain_wpai_photo_data['camera_settings'] as $key => $value ) {
				echo '<option' . ( isset( $deepaibrain_wpai_image_settings['camera_settings'] ) && $deepaibrain_wpai_image_settings['camera_settings'] === $value ? ' selected' : '' ) . ' value="' . esc_html( $value ) . '">' . esc_html( $value ) . '</option>';
			}
			echo '</select>';
			?>
		</div>
		<div class="deepaibrain_wpai-mb-5">
			<?php
			echo '<label for="composition" class="deepaibrain_wpai-form-label">' . esc_html__( 'Composition', 'smart-content-generator' ) . '</label>';
			echo '<select class="deepaibrain_wpai-input" name="composition" id="composition">';
			foreach ( $deepaibrain_wpai_photo_data['composition'] as $key => $value ) {
				echo '<option' . ( isset( $deepaibrain_wpai_image_settings['composition'] ) && $deepaibrain_wpai_image_settings['composition'] === $value ? ' selected' : '' ) . ' value="' . esc_html( $value ) . '">' . esc_html( $value ) . '</option>';
			}
			echo '</select>';
			?>
		</div>
		<div class="deepaibrain_wpai-mb-5">
			<?php
			echo '<label for="resolution" class="deepaibrain_wpai-form-label">' . esc_html__( 'Resolution', 'smart-content-generator' ) . '</label>';
			echo '<select class="deepaibrain_wpai-input" name="resolution" id="resolution">';
			foreach ( $deepaibrain_wpai_photo_data['resolution'] as $key => $value ) {
				echo '<option' . ( isset( $deepaibrain_wpai_image_settings['resolution'] ) && $deepaibrain_wpai_image_settings['resolution'] === $value ? ' selected' : '' ) . ' value="' . esc_html( $value ) . '">' . esc_html( $value ) . '</option>';
			}
			echo '</select>';
			?>
		</div>
		<div class="deepaibrain_wpai-mb-5">
			<?php
			echo '<label for="color" class="deepaibrain_wpai-form-label">' . esc_html__( 'Color', 'smart-content-generator' ) . '</label>';
			echo '<select class="deepaibrain_wpai-input" name="color" id="color">';
			foreach ( $deepaibrain_wpai_photo_data['color'] as $key => $value ) {
				echo '<option' . ( isset( $deepaibrain_wpai_image_settings['color'] ) && $deepaibrain_wpai_image_settings['color'] === $value ? ' selected' : '' ) . ' value="' . esc_html( $value ) . '">' . esc_html( $value ) . '</option>';
			}
			echo '</select>';
			?>
		</div>
		<div class="deepaibrain_wpai-mb-5">
			<?php
			echo '<label for="special_effects" class="deepaibrain_wpai-form-label">' . esc_html__( 'Special Effects', 'smart-content-generator' ) . '</label>';
			echo '<select class="deepaibrain_wpai-input" name="special_effects" id="special_effects">';
			foreach ( $deepaibrain_wpai_photo_data['special_effects'] as $key => $value ) {
				echo '<option' . ( isset( $deepaibrain_wpai_image_settings['special_effects'] ) && $deepaibrain_wpai_image_settings['special_effects'] === $value ? ' selected' : '' ) . ' value="' . esc_html( $value ) . '">' . esc_html( $value ) . '</option>';
			}
			echo '</select>';
			?>
		</div>

		<div class="deepaibrain_wpai-mb-5">
			<?php
			echo '<label for="img_size" class="deepaibrain_wpai-form-label">' . esc_html__( 'Size', 'smart-content-generator' ) . '</label>';
			echo '<select class="deepaibrain_wpai-input" name="img_size" id="img_size">';

			echo '<option value="256x256">' . esc_html__( '256x256', 'smart-content-generator' ) . '</option>';
			echo '<option value="512x512">' . esc_html__( '512x512', 'smart-content-generator' ) . '</option>';
			echo '<option value="1024x1024">' . esc_html__( '1024x1024', 'smart-content-generator' ) . '</option>';

			echo '</select>';
			?>
		</div>

		<div class="deepaibrain_wpai-mb-5">
			<label class="deepaibrain_wpai-form-label"><?php echo esc_html__( 'Prompt Strength', 'smart-content-generator' ); ?></label>
			<input class="deepaibrain_wpai_input prompt_strength" type="text" name="prompt_strength" id="prompt_strength" value="0.8">
		</div>

		<div class="deepaibrain_wpai-mb-5">
			<label class="deepaibrain_wpai-form-label"><?php echo esc_html__( 'Number of Inference Steps', 'smart-content-generator' ); ?></label>
			<input class="deepaibrain_wpai_input num_inference_steps" type="number" name="num_inference_steps" id="num_inference_steps" value="50">
		</div>
		<div class="deepaibrain_wpai-mb-5">
			<label class="deepaibrain_wpai-form-label"><?php echo esc_html__( 'Guidance Scale', 'smart-content-generator' ); ?></label>
			<input class="deepaibrain_wpai_input guidance_scale" type="text" name="guidance_scale" id="guidance_scale" value="7.5">
		</div>
		<div class="deepaibrain_wpai-mb-5">
			<label class="deepaibrain_wpai-form-label"><?php echo esc_html__( 'Scheduler', 'smart-content-generator' ); ?></label>
			<select name="scheduler" id="scheduler">
				<?php
				foreach ( array( 'DDIM', 'K_EULER', 'DPMSolverMultistep', 'K_EULER_ANCESTRAL', 'PNDM', 'KLMS' ) as $scheduler ) {
					echo '<option' . ( ( isset( $deepaibrain_wpai_image_settings['scheduler'] ) && $deepaibrain_wpai_image_settings['scheduler'] === $scheduler ) || ( ! isset( $deepaibrain_wpai_image_settings['scheduler'] ) && 'DPMSolverMultistep' === $scheduler ) ? ' selected' : '' ) . ' value="' . esc_html( $scheduler ) . '">' . esc_html( $scheduler ) . '</option>';
				}
				?>
			</select>
		</div>

		<div class="photos_tab_content">
			<form method="POST" class="data-form" style="margin: 12px 0px 0px 0px;">
				<table class="form-table">
					<tbody>

						<tr>
							<td style="padding: 0;">
								<label><?php echo esc_html__( 'Prompt', 'smart-content-generator' ); ?></label>
								<textarea name="ai_generator_image_title" id="ai_generator_image_title" rows="2" cols="50"><?php echo esc_html( $deepaibrain_wpai_painter_data['prompts'][ array_rand( $deepaibrain_wpai_painter_data['prompts'] ) ] ); ?></textarea>
							</td> 
						</tr>
					</tbody>
				</table>
				<p class="submit">
					<button class="button button-primary deepaibrain_wpai-button" type="button" onclick="getRandomPromptAi()"><?php echo esc_html__( 'Surprise Me', 'smart-content-generator' ); ?></button>
					<button type="button" id="generate_stable_diffusion_images" class="button button-primary"><?php echo esc_html__( 'Generate', 'smart-content-generator' ); ?></button>
					<img class="loading_spinner" src="<?php echo esc_url( plugin_dir_url( __FILE__ ) . 'img/spinner-2x.gif' ); ?>">
				</p>
			</form>


			<p class="success_msg" style="display: none;"><?php echo esc_html__( 'Successfully Saved!', 'smart-content-generator' ); ?></p>
			<div class="wrapper" id="ai_images_data">

			</div>
			<p class="submit save_to_media" style="width: 100%;">
				<?php $save_to_media_nonce = wp_create_nonce( 'save_to_media_nonce' ); ?> 
				<input type="hidden" id="save_to_media_nonce" value="<?php echo esc_attr( $save_to_media_nonce ); ?>">
				<button type="button" id="save_to_media" class="button button-primary"><?php echo esc_html__( 'Save', 'smart-content-generator' ); ?></button>
				<img class="spinner_save_media" src="<?php echo esc_url( plugin_dir_url( __FILE__ ) . 'img/spinner-2x.gif' ); ?>">
			</p> 

		</div>

	</div>
<?php } ?>

<style type="text/css">
	.deepaibrain_wpai_modal{
		top: 5%;
		height: 90%;
	}
	.deepaibrain_wpai_modal_content{
		height: calc(100% - 50px);
		overflow-y: auto;
	}
	.deepaibrain_wpai-overlay {
		left: 0px;
	}
	span.deepaibrain_wpai_modal_close {
		position: absolute;
		top: 10px;
		right: 10px;
		font-size: 30px;
		font-weight: bold;
		cursor: pointer;
	}
</style>


<div class="deepaibrain_wpai-overlay" id="image-popup-overlay" style="display: none;">
	<div class="deepaibrain_wpai_modal" id="image-popup" style="display: none;">
		<div class="deepaibrain_wpai_modal_head">
			<span class="deepaibrain_wpai_modal_title"><?php echo esc_html__( 'Edit/Save', 'smart-content-generator' ); ?></span>
			<span class="deepaibrain_wpai_modal_close"><?php echo esc_html__( '×', 'smart-content-generator' ); ?></span>
		</div>
		<div class="deepaibrain_wpai_modal_content">
			<div class="deepaibrain_wpai_grid_form">
				<div class="deepaibrain_wpai_grid_form_2">
					<img src="" style="width: 98%;height: 540px;">
				</div>
				<div class="deepaibrain_wpai_grid_form_1">
					<p><label><?php echo esc_html__( 'Alternative Text', 'smart-content-generator' ); ?></label><input type="text" class="deepaibrain_wpai_edit_item_alt" style="width: 100%" value=""></p>
					<p><label><?php echo esc_html__( 'Title', 'smart-content-generator' ); ?></label><input type="text" class="deepaibrain_wpai_edit_item_title" style="width: 100%" value=""></p>
					<p><label><?php echo esc_html__( 'Caption', 'smart-content-generator' ); ?></label><input type="text" class="deepaibrain_wpai_edit_item_caption" style="width: 100%" value=""></p>
					<p><label><?php echo esc_html__( 'Description', 'smart-content-generator' ); ?></label><textarea class="deepaibrain_wpai_edit_item_description" style="width: 100%"></textarea></p>
					<?php $edit_image_save_nonce = wp_create_nonce( 'edit_image_save_nonce' ); ?> 
					<input type="hidden" id="edit_image_save_nonce" value="<?php echo esc_attr( $edit_image_save_nonce ); ?>">
					<button class="button button-primary deepaibrain_wpai_edit_image_save" type="button"><?php echo esc_html__( 'Save', 'smart-content-generator' ); ?></button>
					<img class="spinner_modal_image_save" src="<?php echo esc_url( plugin_dir_url( __FILE__ ) . 'img/spinner-2x.gif' ); ?>">
					<p class="success_msg_modal"><?php echo esc_html__( 'Successfully Saved !', 'smart-content-generator' ); ?></p>
				</div>
			</div>
		</div>
	</div>
</div>

