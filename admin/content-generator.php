<?php
/**
 * Content Generator
 *
 * @link       https://wegarh.com
 * @since      1.0.0
 *
 * @package    Smart Content Generator
 * @subpackage Smart Content Generator/admin
 */

?>
<div class="all_tabs active" onClick="JavaScript:selectTab(1);"><?php echo esc_html__( 'General', 'smart-content-generator' ); ?></div>
<div class="all_tabs" onClick="JavaScript:selectTab(2);"><?php echo esc_html__( 'Format', 'smart-content-generator' ); ?></div>
<div class="all_tabs" onClick="JavaScript:selectTab(3);"><?php echo esc_html__( 'Custom Prompt', 'smart-content-generator' ); ?></div>
<?php if ( deepaibrain_wpai_is_pro() ) { ?>
<div class="all_tabs" onClick="JavaScript:selectTab(4);"><?php echo esc_html__( 'SEO', 'smart-content-generator' ); ?></div>
<?php } ?>
<div class="all_tabs" onClick="JavaScript:selectTab(5);"><?php echo esc_html__( 'Quick Images', 'smart-content-generator' ); ?></div>
<?php if ( deepaibrain_wpai_is_pro() ) { ?>
<div class="all_tabs" onClick="JavaScript:selectTab(6);"><?php echo esc_html__( 'Advanced', 'smart-content-generator' ); ?></div> 
<?php } ?>
<br />
<div id="tab1Content" class="filter-wrapper">
	<div class="mb-5">
		<label class="deepaibrain_wpai-form-label" for="label_title"><?php echo esc_html__( 'Language', 'smart-content-generator' ); ?></label>
		<select class="deepaibrain_wpai-input" name="_wporg_language" id="deepaibrain_wpai_language">
			<option value="en" selected=""><?php echo esc_html__( 'English', 'smart-content-generator' ); ?></option>
			<option value="af"><?php echo esc_html__( 'Afrikaans', 'smart-content-generator' ); ?></option>
			<option value="ar"><?php echo esc_html__( 'Arabic', 'smart-content-generator' ); ?></option>
			<option value="an"><?php echo esc_html__( 'Armenian', 'smart-content-generator' ); ?></option>
			<option value="bs"><?php echo esc_html__( 'Bosnian', 'smart-content-generator' ); ?></option>
			<option value="bg"><?php echo esc_html__( 'Bulgarian', 'smart-content-generator' ); ?></option>
			<option value="zh"><?php echo esc_html__( 'Chinese (Simplified)', 'smart-content-generator' ); ?></option>
			<option value="zt"><?php echo esc_html__( 'Chinese (Traditional)', 'smart-content-generator' ); ?></option>
			<option value="hr"><?php echo esc_html__( 'Croatian', 'smart-content-generator' ); ?></option>
			<option value="cs"><?php echo esc_html__( 'Czech', 'smart-content-generator' ); ?></option>
			<option value="da"><?php echo esc_html__( 'Danish', 'smart-content-generator' ); ?></option>
			<option value="nl"><?php echo esc_html__( 'Dutch', 'smart-content-generator' ); ?></option>
			<option value="et"><?php echo esc_html__( 'Estonian', 'smart-content-generator' ); ?></option>
			<option value="fil"><?php echo esc_html__( 'Filipino', 'smart-content-generator' ); ?></option>
			<option value="fi"><?php echo esc_html__( 'Finnish', 'smart-content-generator' ); ?></option>
			<option value="fr"><?php echo esc_html__( 'French', 'smart-content-generator' ); ?></option>
			<option value="de"><?php echo esc_html__( 'German', 'smart-content-generator' ); ?></option>
			<option value="el"><?php echo esc_html__( 'Greek', 'smart-content-generator' ); ?></option>
			<option value="he"><?php echo esc_html__( 'Hebrew', 'smart-content-generator' ); ?></option>
			<option value="hu"><?php echo esc_html__( 'Hungarian', 'smart-content-generator' ); ?></option>
			<option value="id"><?php echo esc_html__( 'Indonesian', 'smart-content-generator' ); ?></option>
			<option value="it"><?php echo esc_html__( 'Italian', 'smart-content-generator' ); ?></option>
			<option value="ja"><?php echo esc_html__( 'Japanese', 'smart-content-generator' ); ?></option>
			<option value="ko"><?php echo esc_html__( 'Korean', 'smart-content-generator' ); ?></option>
			<option value="lv"><?php echo esc_html__( 'Latvian', 'smart-content-generator' ); ?></option>
			<option value="lt"><?php echo esc_html__( 'Lithuanian', 'smart-content-generator' ); ?></option>
			<option value="ms"><?php echo esc_html__( 'Malay', 'smart-content-generator' ); ?></option>
			<option value="no"><?php echo esc_html__( 'Norwegian', 'smart-content-generator' ); ?></option>
			<option value="fa"><?php echo esc_html__( 'Persian', 'smart-content-generator' ); ?></option>
			<option value="pl"><?php echo esc_html__( 'Polish', 'smart-content-generator' ); ?></option>
			<option value="pt"><?php echo esc_html__( 'Portuguese', 'smart-content-generator' ); ?></option>
			<option value="ro"><?php echo esc_html__( 'Romanian', 'smart-content-generator' ); ?></option>
			<option value="ru"><?php echo esc_html__( 'Russian', 'smart-content-generator' ); ?></option>
			<option value="sr"><?php echo esc_html__( 'Serbian', 'smart-content-generator' ); ?></option>
			<option value="sk"><?php echo esc_html__( 'Slovak', 'smart-content-generator' ); ?></option>
			<option value="sl"><?php echo esc_html__( 'Slovenian', 'smart-content-generator' ); ?></option>
			<option value="es"><?php echo esc_html__( 'Spanish', 'smart-content-generator' ); ?></option>
			<option value="sv"><?php echo esc_html__( 'Swedish', 'smart-content-generator' ); ?></option>
			<option value="th"><?php echo esc_html__( 'Thai', 'smart-content-generator' ); ?></option>
			<option value="tr"><?php echo esc_html__( 'Turkish', 'smart-content-generator' ); ?></option>
			<option value="uk"><?php echo esc_html__( 'Ukranian', 'smart-content-generator' ); ?></option>
			<option value="vi"><?php echo esc_html__( 'Vietnamese', 'smart-content-generator' ); ?></option>
		</select>
	</div>

	<div class="mb-5">
		<label class="deepaibrain_wpai-form-label" for="deepaibrain_wpai_writing_style"><?php echo esc_html__( 'Style', 'smart-content-generator' ); ?></label>
		<select name="_wporg_writing_style" id="deepaibrain_wpai_writing_style" class="deepaibrain_wpai-input">
			<option value="infor" selected=""><?php echo esc_html__( 'Informative', 'smart-content-generator' ); ?></option>
			<option value="conve"><?php echo esc_html__( 'Conversational', 'smart-content-generator' ); ?></option>
			<option value="formal"><?php echo esc_html__( 'Formal', 'smart-content-generator' ); ?></option>
			<option value="casua"><?php echo esc_html__( 'Casual', 'smart-content-generator' ); ?></option>
			<option value="humor"><?php echo esc_html__( 'Humorous', 'smart-content-generator' ); ?></option>
			<option value="empathe"><?php echo esc_html__( 'Empathetic', 'smart-content-generator' ); ?></option>
			<option value="persu"><?php echo esc_html__( 'Persuasive', 'smart-content-generator' ); ?></option>
			<option value="creat"><?php echo esc_html__( 'Creative', 'smart-content-generator' ); ?></option>
			<option value="Instru"><?php echo esc_html__( 'Instructional', 'smart-content-generator' ); ?></option>
			<option value="refle"><?php echo esc_html__( 'Reflective', 'smart-content-generator' ); ?>Reflective</option>   
		</select>
	</div>

	<div class="mb-5">
		<label class="deepaibrain_wpai-form-label" for="deepaibrain_wpai_writing_tone"><?php echo esc_html__( 'Tone', 'smart-content-generator' ); ?></label>
		<select name="_wporg_writing_tone" id="deepaibrain_wpai_writing_tone" class="deepaibrain_wpai-input">
			<option value="formal" selected=""><?php echo esc_html__( 'Formal', 'smart-content-generator' ); ?></option>
			<option value="surpr"><?php echo esc_html__( 'Surprised', 'smart-content-generator' ); ?></option>
			<option value="nostalgic"><?php echo esc_html__( 'Nostalgic', 'smart-content-generator' ); ?></option>
			<option value="hopeful"><?php echo esc_html__( 'Hopeful', 'smart-content-generator' ); ?></option>
			<option value="empathe"><?php echo esc_html__( 'Empathetic', 'smart-content-generator' ); ?></option>           
		</select>
	</div>

</div>
<div id="tab2Content" class="filter-wrapper">	
	<div class="mb-5">
		<label class="deepaibrain_wpai-form-label" for="deepaibrain_wpai_number_of_heading"><?php echo esc_html__( 'Headings', 'smart-content-generator' ); ?></label>
		<select id="deepaibrain_wpai_number_of_heading" name="_wporg_number_of_heading">
			<option selected="" value="1">1</option>
			<option value="2"><?php echo esc_html__( '2', 'smart-content-generator' ); ?></option>
			<option value="3"><?php echo esc_html__( '3', 'smart-content-generator' ); ?></option>
			<option value="4"><?php echo esc_html__( '4', 'smart-content-generator' ); ?></option>
			<option value="5"><?php echo esc_html__( '5', 'smart-content-generator' ); ?></option>
			<option value="6"><?php echo esc_html__( '6', 'smart-content-generator' ); ?></option>
			<option value="7"><?php echo esc_html__( '7', 'smart-content-generator' ); ?></option>
			<option value="8"><?php echo esc_html__( '8', 'smart-content-generator' ); ?></option>
			<option value="9"><?php echo esc_html__( '9', 'smart-content-generator' ); ?></option>
			<option value="10"><?php echo esc_html__( '10', 'smart-content-generator' ); ?></option>
		</select>
	</div>

	<div class="mb-5">
		<label class="deepaibrain_wpai-form-label" for="deepaibrain_wpai_heading_tag"><?php echo esc_html__( 'Heading Tag', 'smart-content-generator' ); ?></label>
		<select name="_wporg_heading_tag" id="deepaibrain_wpai_heading_tag" class="deepaibrain_wpai-input">
			<option value="h1" selected=""><?php echo esc_html__( 'h1', 'smart-content-generator' ); ?></option>
			<option value="h2"><?php echo esc_html__( 'h2', 'smart-content-generator' ); ?></option>
			<option value="h3"><?php echo esc_html__( 'h3', 'smart-content-generator' ); ?></option>
			<option value="h4"><?php echo esc_html__( 'h4', 'smart-content-generator' ); ?></option>
			<option value="h5"><?php echo esc_html__( 'h5', 'smart-content-generator' ); ?></option>
		</select>
	</div>

	<div class="mb-5 checkbox_inline">
		<label class="deepaibrain_wpai-form-label" for="deepaibrain_wpai_modify_headings2"><?php echo esc_html__( 'Outline Editor', 'smart-content-generator' ); ?></label>
		<input style="margin: 0px 10px;" type="checkbox" id="deepaibrain_wpai_modify_headings2" name="_wporg_modify_headings2" class="deepaibrain_wpai-content-title-input" value="0">

		<input type="hidden" id="deepaibrain_wpai_modify_headings" name="_wporg_modify_headings" class="deepaibrain_wpai-content-title-input" value="0">

		<input type="hidden" id="hfHeadings" name="hfHeadings">
		<input type="hidden" id="is_generate_continue" name="is_generate_continue" value="0">
	</div>
</div>


<!-- Outline Popup -->

<div class="modal fade" id="myModal" role="dialog" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="deepaibrain_wpai_modal-content">
			<div class="deepaibrain_wpai_modal-header">
				<h4 class="deepaibrain_wpai_modal-title"><?php echo esc_html__( 'Outline Editor', 'smart-content-generator' ); ?></h4>
				<span><?php echo esc_html__( 'You can modify, sort, add or delete headings.', 'smart-content-generator' ); ?></span>
			</div>
			<div class="deepaibrain_wpai_modal-body">
				<ol class="deepaibrain_wpai_menu_editor"></ol>
				<a href="javascript:;" id="deepaibrain_wpai_add_new_heading">+ <?php echo esc_html__( 'Add new heading', 'smart-content-generator' ); ?></a>
			</div>
			<div class="deepaibrain_wpai_modal-footer">
				<button type="button" class="button button-secondary button-large m_close"><?php echo esc_html__( 'CANCEL', 'smart-content-generator' ); ?></button>
				<button type="button" class="button button-primary button-large content_generate"><?php echo esc_html__( 'GENERATE', 'smart-content-generator' ); ?></button>
			</div>
		</div>

	</div>
</div>

<!-- Outline Popup end -->


<div id="tab3Content" class="filter-wrapper">
	<div class="mb-5">
		<label><input type="checkbox" class="ai_custom_prompt_enable" name="ai_custom_prompt_enable" value="0">&nbsp;<?php echo esc_html__( 'Enable', 'smart-content-generator' ); ?></label>
	</div>

	<div class="meta_custom_prompt_box" style="display: none;">
		<h3><?php echo esc_html__( 'Best Practices and Tips', 'smart-content-generator' ); ?></h3>
		<ol>
			<li><?php echo esc_html__( 'Ensure <code>[title]</code> is included in your prompt.', 'smart-content-generator' ); ?></li>
			<li><?php echo esc_html__( 'You can add your language to the prompt. Just replace "in English" with your language.', 'smart-content-generator' ); ?></li>
			<li><?php echo esc_html__( 'This works best with gpt-4 and gpt-3.5-turbo. Please note that GPT-4 is currently in limited beta, which means that access to the GPT-4 API from OpenAI is available only through a waiting list and is not open to everyone yet. You can sign up for the waiting list at', 'smart-content-generator' ); ?> <a href="https://openai.com/waitlist/gpt-4-api" target="_blank"><?php echo esc_html__( 'here', 'smart-content-generator' ); ?></a>.</li>
			<li><?php echo esc_html__( 'Please note that if custom prompt is enabled the plugin will bypass language, style, tone etc settings. You need to specify them in your prompt.', 'smart-content-generator' ); ?></li>
		</ol>
		<label><?php echo esc_html__( 'Custom Prompt', 'smart-content-generator' ); ?></label>
		<textarea rows="8" class="ai_custom_prompt" name="ai_custom_prompt"><?php echo esc_html__( 'Create a compelling and well-researched article of at least 500 words on the topic of [title] in English. Structure the article with clear headings enclosed within the appropriate heading tags (e.g., <h1>, <h2>, etc.) and engaging subheadings. Ensure that the content is informative and provides valuable insights to the reader. Incorporate relevant examples, case studies, and statistics to support your points. Organize your ideas using unordered lists with <ul> and <li> tags where appropriate. Conclude with a strong summary that ties together the key takeaways of the article. Remember to enclose headings in the specified heading tags to make parsing the content easier. Additionally, wrap even paragraphs in <p> tags for improved readability.', 'smart-content-generator' ); ?></textarea>
			<div><?php echo esc_html__( 'Ensure <code>[title]</code> is included in your prompt.', 'smart-content-generator' ); ?></div>
			<button style="color: #fff;background: #df0707;border-color: #df0707;margin-top: 15px;" data-prompt="Create a compelling and well-researched article of at least 500 words on the topic of [title] in English. Structure the article with clear headings enclosed within the appropriate heading tags (e.g., <h1>, <h2>, etc.) and engaging subheadings. Ensure that the content is informative and provides valuable insights to the reader. Incorporate relevant examples, case studies, and statistics to support your points. Organize your ideas using unordered lists with <ul> and <li> tags where appropriate. Conclude with a strong summary that ties together the key takeaways of the article. Remember to enclose headings in the specified heading tags to make parsing the content easier. Additionally, wrap even paragraphs in <p> tags for improved readability." class="button deepaibrain_wpai_meta_custom_prompt_reset" type="button"><?php echo esc_html__( 'Reset', 'smart-content-generator' ); ?></button>
				<div class="deepaibrain_wpai_meta_custom_prompt_auto_error"></div>
			</div>


		</div>

		<div id="tab4Content" class="filter-wrapper">
			<div class="mb-5" style="display: inline-flex; margin-left: 10px; vertical-align: top;  margin-top: 30px;">
				<label class="deepaibrain_wpai-form-label" for="deepaibrain_wpai_seo_meta_desc"><?php echo esc_html__( 'Meta Description', 'smart-content-generator' ); ?></label>
				<input style="margin: 3px 15px;" type="checkbox" name="deepaibrain_wpai_seo_meta_desc" id="deepaibrain_wpai_seo_meta_desc" class="deepaibrain_wpai-content-title-input" value="1">
			</div>

			<div class="mb-5">
				<label class="deepaibrain_wpai-form-label" for="deepaibrain_wpai_seo_meta_desc"><?php echo esc_html__( 'Tags', 'smart-content-generator' ); ?></label>
				<input style="width: 100%;" type="text" name="deepaibrain_wpai_post_tags" id="deepaibrain_wpai_post_tags" class="deepaibrain_wpai_input" value="">
				<p class="deepaibrain_wpai-help-text"><?php echo esc_html__( '(Use comma to seperate tags)', 'smart-content-generator' ); ?></p>
			</div>

		</div>

		<div id="tab5Content" class="filter-wrapper">    
			<div class="mb-5">
				<label class="deepaibrain_wpai-form-label"><?php echo esc_html__( 'Image', 'smart-content-generator' ); ?></label>
				<select class="regular-text" id="deepaibrain_wpai_image_source" name="deepaibrain_wpai_image_source">
					<option value=""><?php echo esc_html__( 'None', 'smart-content-generator' ); ?></option>
					<option value="dalle"><?php echo esc_html__( 'DALL-E', 'smart-content-generator' ); ?></option>
					<option value="pexels"><?php echo esc_html__( 'Pexels', 'smart-content-generator' ); ?></option>
				</select>
			</div>

			<div class="mb-5">
				<label class="deepaibrain_wpai-form-label"><?php echo esc_html__( 'Featured Image', 'smart-content-generator' ); ?></label>
				<select class="regular-text" id="deepaibrain_wpai_featured_image_source" name="deepaibrain_wpai_featured_image_source">
					<option value=""><?php echo esc_html__( 'None', 'smart-content-generator' ); ?></option>
					<option value="dalle"><?php echo esc_html__( 'DALL-E', 'smart-content-generator' ); ?></option>
					<option value="pexels"><?php echo esc_html__( 'Pexels', 'smart-content-generator' ); ?></option>
				</select>
			</div>

			<div class="mb-5 deepaibrain_wpai-d-flex">
				<label class="deepaibrain_wpai-form-label" for="_wporg_img_style"><?php echo esc_html__( 'Image Style', 'smart-content-generator' ); ?></label>
				<select class="regular-text" id="_wporg_img_style" name="_wporg_img_style">
					<option value=""><?php echo esc_html__( 'None', 'smart-content-generator' ); ?></option>
					<option value="abstract"><?php echo esc_html__( 'Abstract', 'smart-content-generator' ); ?></option>
					<option value="modern"><?php echo esc_html__( 'Modern', 'smart-content-generator' ); ?></option>
					<option value="impressionist"><?php echo esc_html__( 'Impressionist', 'smart-content-generator' ); ?></option>
					<option value="popart"><?php echo esc_html__( 'Pop Art', 'smart-content-generator' ); ?></option>
					<option value="cubism"><?php echo esc_html__( 'Cubism', 'smart-content-generator' ); ?></option>
					<option value="surrealism"><?php echo esc_html__( 'Surrealism', 'smart-content-generator' ); ?></option>
					<option value="contemporary"><?php echo esc_html__( 'Contemporary', 'smart-content-generator' ); ?></option>
					<option value="cantasy"><?php echo esc_html__( 'Fantasy', 'smart-content-generator' ); ?></option>
					<option value="graffiti"><?php echo esc_html__( 'Graffiti', 'smart-content-generator' ); ?></option>
				</select>
			</div>

			<div class="mb-5">
				<label class="deepaibrain_wpai-form-label"><?php echo esc_html__( 'Size', 'smart-content-generator' ); ?></label>
				<select class="regular-text" id="deepaibrain_wpai_pexels_size" name="deepaibrain_wpai_pexels_size">            
					<option value="large"><?php echo esc_html__( 'Large', 'smart-content-generator' ); ?></option>
					<option value="medium" selected><?php echo esc_html__( 'Medium', 'smart-content-generator' ); ?></option>
					<option value="small"><?php echo esc_html__( 'Small', 'smart-content-generator' ); ?></option>
				</select>
			</div>

			<div class="mb-5">
				<label class="deepaibrain_wpai-form-label"><?php echo esc_html__( 'Orientation', 'smart-content-generator' ); ?></label>
				<select class="regular-text" id="deepaibrain_wpai_pexels_orientation" name="deepaibrain_wpai_pexels_orientation">
					<option value=""><?php echo esc_html__( 'None', 'smart-content-generator' ); ?></option>
					<option value="landscape"><?php echo esc_html__( 'Landscape', 'smart-content-generator' ); ?></option>
					<option value="portrait"><?php echo esc_html__( 'Portrait', 'smart-content-generator' ); ?></option>
					<option value="square"><?php echo esc_html__( 'Square', 'smart-content-generator' ); ?></option>
				</select>
			</div>
		</div>

		<div id="tab6Content" class="filter-wrapper">
			<div class="mb-5">
				<label class="deepaibrain_wpai-form-label" for="label_keywords"><?php echo esc_html__( 'Add Keywords', 'smart-content-generator' ); ?></label>
				<input type="text" class="deepaibrain_wpai_input" id="deepaibrain_wpai_keywords" name="deepaibrain_wpai_keywords">
				<p class="deepaibrain_wpai-help-text"><?php echo esc_html__( '(Use comma to seperate keywords)', 'smart-content-generator' ); ?></p>
			</div>
			<div class="mb-5">
				<label class="deepaibrain_wpai-form-label" for="label_words_to_avoid"><?php echo esc_html__( 'Exclude words', 'smart-content-generator' ); ?></label>
				<input type="text" class="deepaibrain_wpai_input" id="deepaibrain_wpai_exclude_keywords" name="deepaibrain_wpai_exclude_keywords">
				<p class="deepaibrain_wpai-help-text"><?php echo esc_html__( '(Use comma to seperate keywords)', 'smart-content-generator' ); ?></p>
			</div>

			<div class="mb-5">
				<label class="deepaibrain_wpai-form-label" for="deepaibrain_wpai_intro_title_tag"><?php echo esc_html__( 'Format Keywords', 'smart-content-generator' ); ?></label>
				<select name="deepaibrain_wpai_format_keywords" id="deepaibrain_wpai_format_keywords">
					<option value="italic"><?php echo esc_html__( 'Italic', 'smart-content-generator' ); ?></option>
					<option value="bold" selected=""><?php echo esc_html__( 'Bold', 'smart-content-generator' ); ?></option>
					<option value="underline"><?php echo esc_html__( 'Underline', 'smart-content-generator' ); ?></option>                    
				</select>
			</div>

			<div class="mb-5 checkbox_inline">
				<label class="deepaibrain_wpai-form-label" for="deepaibrain_wpai_add_tagline2"><?php echo esc_html__( 'Add Tagline?', 'smart-content-generator' ); ?></label>
				<input type="checkbox" id="deepaibrain_wpai_add_tagline2" name="_wporg_add_tagline2" class="deepaibrain_wpai-content-title-input" value="0">
				<input type="hidden" id="deepaibrain_wpai_add_tagline" name="_wporg_add_tagline" class="deepaibrain_wpai-content-title-input" value="0">
			</div>

			<div class="mb-5 checkbox_inline">
				<label class="deepaibrain_wpai-form-label" for="deepaibrain_wpai_add_intro2"><?php echo esc_html__( 'Add Introduction?', 'smart-content-generator' ); ?></label>
				<input type="checkbox" id="deepaibrain_wpai_add_intro2" name="_wporg_add_intro2" class="deepaibrain_wpai-content-title-input" value="0">
				<input type="hidden" id="deepaibrain_wpai_add_intro" name="_wporg_add_intro" class="deepaibrain_wpai-content-title-input" value="0">
			</div>

			<div class="mb-5">
				<label class="deepaibrain_wpai-form-label" for="deepaibrain_wpai_intro_title_tag"><?php echo esc_html__( 'Intro Title Tag', 'smart-content-generator' ); ?></label>
				<select name="deepaibrain_wpai_intro_title_tag" id="deepaibrain_wpai_intro_title_tag">
					<option value="h2" selected=""><?php echo esc_html__( 'h2', 'smart-content-generator' ); ?></option>
					<option value="h3"><?php echo esc_html__( 'h3', 'smart-content-generator' ); ?></option>
					<option value="h4"><?php echo esc_html__( 'h4', 'smart-content-generator' ); ?></option>
					<option value="h5"><?php echo esc_html__( 'h5', 'smart-content-generator' ); ?></option>
				</select>
			</div>
			<div class="mb-5 checkbox_inline">
				<label class="deepaibrain_wpai-form-label" for="deepaibrain_wpai_add_conclusion2"><?php echo esc_html__( 'Add Conclusion?', 'smart-content-generator' ); ?></label>
				<input type="checkbox" id="deepaibrain_wpai_add_conclusion2" name="_wporg_add_conclusion2" class="deepaibrain_wpai-content-title-input" value="0">
				<input type="hidden" id="deepaibrain_wpai_add_conclusion" name="_wporg_add_conclusion" class="deepaibrain_wpai-content-title-input" value="0">
			</div>
			<div class="mb-5">
				<label class="deepaibrain_wpai-form-label" for="deepaibrain_wpai_conclusion_title_tag"><?php echo esc_html__( 'Conclusion Title Tag', 'smart-content-generator' ); ?></label>
				<select name="deepaibrain_wpai_conclusion_title_tag" id="deepaibrain_wpai_conclusion_title_tag">
					<option value="h2" selected=""><?php echo esc_html__( 'h2', 'smart-content-generator' ); ?></option>
					<option value="h3"><?php echo esc_html__( 'h3', 'smart-content-generator' ); ?></option>
					<option value="h4"><?php echo esc_html__( 'h4', 'smart-content-generator' ); ?></option>
					<option value="h5"><?php echo esc_html__( 'h5', 'smart-content-generator' ); ?></option>
				</select>
			</div>

			<div class="mb-5 checkbox_inline">  
				<label class="deepaibrain_wpai-form-label" for="deepaibrain_wpai_toc"><?php echo esc_html__( 'Add Table of Contents?', 'smart-content-generator' ); ?></label>
				<input type="checkbox" value="0" name="deepaibrain_wpai_toc" id="deepaibrain_wpai_toc">
			</div>

			<div class="mb-5">
				<label class="deepaibrain_wpai-form-label" for="deepaibrain_wpai_toc_title"><?php echo esc_html__( 'ToC Title', 'smart-content-generator' ); ?></label>
				<input type="text" class="regular-text" value="Table of Contents" name="deepaibrain_wpai_toc_title" id="deepaibrain_wpai_toc_title">
			</div>

			<div class="mb-5">
				<label class="deepaibrain_wpai-form-label" for="deepaibrain_wpai_toc_title_tag"><?php echo esc_html__( 'ToC Title Tag', 'smart-content-generator' ); ?></label>
				<select name="deepaibrain_wpai_toc_title_tag" id="deepaibrain_wpai_toc_title_tag">
					<option value="h1"><?php echo esc_html__( 'h1', 'smart-content-generator' ); ?></option>
					<option value="h2" selected=""><?php echo esc_html__( 'h2', 'smart-content-generator' ); ?></option>
					<option value="h3"><?php echo esc_html__( 'h3', 'smart-content-generator' ); ?></option>
					<option value="h4"><?php echo esc_html__( 'h4', 'smart-content-generator' ); ?></option>
					<option value="h5"><?php echo esc_html__( 'h5', 'smart-content-generator' ); ?></option>
					<option value="h6"><?php echo esc_html__( 'h6', 'smart-content-generator' ); ?></option>
				</select>
			</div>

			<div class="mb-5">
				<label class="deepaibrain_wpai-form-label" for="deepaibrain_wpai_anchor_text"><?php echo esc_html__( 'Anchor Text?', 'smart-content-generator' ); ?></label>
				<input type="text" id="deepaibrain_wpai_anchor_text" placeholder="e.g. battery life" class="deepaibrain_wpai-input" name="_wporg_anchor_text" value="">
			</div>
			<div class="mb-5">
				<label class="deepaibrain_wpai-form-label" for="deepaibrain_wpai_target_url"><?php echo esc_html__( 'Target URL?', 'smart-content-generator' ); ?></label>
				<input type="url" id="deepaibrain_wpai_target_url" placeholder="https://..." class="deepaibrain_wpai-input" name="_wporg_target_url" value="">
			</div>
			<div class="mb-5">
				<label class="deepaibrain_wpai-form-label" for="deepaibrain_wpai_target_url_cta"><?php echo esc_html__( 'Add Call-to-Action?', 'smart-content-generator' ); ?></label>
				<input type="url" id="deepaibrain_wpai_target_url_cta" placeholder="https://..." class="deepaibrain_wpai-input" name="_wporg_target_url_cta" value="">
				<p class="deepaibrain_wpai-help-text"><?php echo esc_html__( 'Enter target URL.', 'smart-content-generator' ); ?></p>
			</div>
			<div class="mb-5">
				<label class="deepaibrain_wpai-form-label" for="deepaibrain_wpai_cta_pos"><?php echo esc_html__( 'CTA Position?', 'smart-content-generator' ); ?></label>
				<select class="deepaibrain_wpai-input" name="_wporg_cta_pos" id="deepaibrain_wpai_cta_pos">
					<option value="beg" selected=""><?php echo esc_html__( 'Beginning', 'smart-content-generator' ); ?></option>
					<option value="end"><?php echo esc_html__( 'End', 'smart-content-generator' ); ?></option>
				</select>
			</div>
		</div>

		<div class="main-content-wrapper">
			<div class="content-wrapper content">
				<form method="POST" class="data-form">
					<table class="form-table">
						<tbody>           
							<tr>
								<td>
									<input type="text" class="regular-text" id="express_content_title" name="express_content_title" value="">
								</td> 
							</tr>

							<tr>
								<td style="padding: 0px;">
									<p class="submit" style="padding: 0">
										<button type="button" id="generate_content" class="button button-primary"><?php echo esc_html__( 'Generate', 'smart-content-generator' ); ?></button>
										<img class="loading_spinner" src="<?php echo esc_url( plugin_dir_url( __FILE__ ) . 'img/spinner-2x.gif' ); ?>">
									</p>
								</td> 
							</tr>

							<tr>
								<td>
									<div class="container-wrapper">
										<div class="tabs">
											<h3 class="active"><?php echo esc_html__( 'Content', 'smart-content-generator' ); ?></h3>
											<?php if ( deepaibrain_wpai_is_pro() ) { ?>
											<h3><?php echo esc_html__( 'Seo', 'smart-content-generator' ); ?></h3>
											<?php } ?>
										</div>
										<div class="tab-content">
											<div class="tabOneContent active"> <textarea></textarea> </div>
											<?php if ( deepaibrain_wpai_is_pro() ) { ?>
											<div class="tabTwoContent">   <textarea></textarea>  </div>
											<?php } ?>
										</div>
									</div>
								</td> 
							</tr>
						</tbody>
					</table>

					<p class="submit">
						<?php $save_ai_res_nonce = wp_create_nonce( 'save_ai_res_nonce' ); ?> 
						<input type="hidden" id="save_ai_res_nonce" value="<?php echo esc_attr( $save_ai_res_nonce ); ?>">
						<button type="button" id="post_save" class="button button-primary" disabled="disabled"><?php echo esc_html__( 'Save Draft', 'smart-content-generator' ); ?></button>
						<img class="post_save_spinner" src="<?php echo esc_url( plugin_dir_url( __FILE__ ) . 'img/spinner-2x.gif' ); ?>">
					</p>
				</form>
			</div>
		</div>
