function selectTab(tabIndex) {
 //Hide All Tabs
 document.getElementById("tab1Content").style.display = "none";
  document.getElementById("tab2Content").style.display = "none";
  document.getElementById("tab3Content").style.display = "none";
  document.getElementById("tab4Content").style.display = "none";
  document.getElementById("tab5Content").style.display = "none";
  document.getElementById("tab6Content").style.display = "none";
 //Show the Selected Tab
 document.getElementById("tab" + tabIndex + "Content").style.display = "block";
  
}

jQuery(function ($) {

  var prompt_api_url = 'https://app.deepaibrain.com/aigeneration/chatgpt/prompt-functions.php';

$( document ).on('click', '.all_tabs', function() {
  $('.all_tabs').removeClass("active");
  $(this).addClass("active");
});

$( document ).on('click', '#generate_content', function() {
var express_content_title = $('#express_content_title').val();
var deepaibrain_openapi_api_key = $('#deepaibrain_openapi_api_key').val();

if( express_content_title == '' ) {
  alert('Please Enter Title.');
  return false;
}
var deepaibrain_wpai_language = $('#deepaibrain_wpai_language').val();
var deepaibrain_wpai_writing_style = $('#deepaibrain_wpai_writing_style').val();
var deepaibrain_wpai_writing_tone = $('#deepaibrain_wpai_writing_tone').val();
var deepaibrain_wpai_number_of_heading = $('#deepaibrain_wpai_number_of_heading').val();
var deepaibrain_wpai_heading_tag = $('#deepaibrain_wpai_heading_tag').val();

var deepaibrain_wpai_modify_headings = $('#deepaibrain_wpai_modify_headings').val();

var deepaibrain_wpai_pexels_orientation = $('#deepaibrain_wpai_pexels_orientation').val();
var _wporg_img_style = $('#_wporg_img_style').val();
var deepaibrain_wpai_pexels_size = $('#deepaibrain_wpai_pexels_size').val();
var deepaibrain_wpai_image_source = $('#deepaibrain_wpai_image_source').val();

if ($('#deepaibrain_wpai_add_tagline2').is(':checked')) {
var deepaibrain_wpai_add_tagline = $('#deepaibrain_wpai_add_tagline').val();
}

if ($('#deepaibrain_wpai_add_intro2').is(':checked')) {
  var deepaibrain_wpai_add_intro = $('#deepaibrain_wpai_add_intro').val();
  var deepaibrain_wpai_intro_title_tag = $('#deepaibrain_wpai_intro_title_tag').val();
}

if ($('#deepaibrain_wpai_add_conclusion2').is(':checked')) {
  var deepaibrain_wpai_add_conclusion = $('#deepaibrain_wpai_add_conclusion').val();
  var deepaibrain_wpai_conclusion_title_tag = $('#deepaibrain_wpai_conclusion_title_tag').val();
}

if ($('#deepaibrain_wpai_toc').is(':checked')) {
  var deepaibrain_wpai_toc = $('#deepaibrain_wpai_toc').val();
  var deepaibrain_wpai_toc_title = $('#deepaibrain_wpai_toc_title').val();
  var deepaibrain_wpai_toc_title_tag = $('#deepaibrain_wpai_toc_title_tag').val();
}

var deepaibrain_wpai_anchor_text = $('#deepaibrain_wpai_anchor_text').val();
var deepaibrain_wpai_target_url = $('#deepaibrain_wpai_target_url').val();
var deepaibrain_wpai_target_url_cta = $('#deepaibrain_wpai_target_url_cta').val();
var deepaibrain_wpai_cta_pos = $('#deepaibrain_wpai_cta_pos').val();

var deepaibrain_wpai_keywords = $('#deepaibrain_wpai_keywords').val();
var domain_name = $('#domain_name').val();
var deepaibrain_wpai_exclude_keywords = $('#deepaibrain_wpai_exclude_keywords').val();
var deepaibrain_wpai_format_keywords = $('#deepaibrain_wpai_format_keywords').val();
if ($('#deepaibrain_wpai_seo_meta_desc').is(':checked')) {
var deepaibrain_wpai_seo_meta_desc = $('#deepaibrain_wpai_seo_meta_desc').val();
}


if ($('.ai_custom_prompt_enable').is(':checked')) {
var ai_custom_prompt = $('.ai_custom_prompt').val();  

   $.ajax({
      type: 'POST',
      url: prompt_api_url,
      data: {
        type: 'generate-custom-prompt',
        ai_custom_prompt: ai_custom_prompt,
        express_content_title: express_content_title,
        deepaibrain_wpai_seo_meta_desc: deepaibrain_wpai_seo_meta_desc,                        
        domain: openapi_api_key,                       
      },

      beforeSend: function() {
           $('.loading_spinner').css('display', 'inline-block');
        },
    
      success: function(res) {
        $('.tabOneContent textarea').val(res);
        $('.loading_spinner').css('display', 'none');
        $("#post_save").removeAttr("disabled", "disabled"); 
      }
    })

}else{
 
$.ajax({
  type: 'POST',
  url: prompt_api_url,
  data: {
    type: 'generate_heading_for_outline',
    express_content_title: express_content_title,
    deepaibrain_wpai_language: deepaibrain_wpai_language,
    deepaibrain_wpai_number_of_heading: deepaibrain_wpai_number_of_heading,            
    deepaibrain_wpai_keywords: deepaibrain_wpai_keywords,  
    domain: deepaibrain_openapi_api_key,      
  },
  beforeSend: function() {
     $('.loading_spinner').css('display', 'inline-block');
  },
  success: function(res) {
    if (deepaibrain_wpai_modify_headings == 1) {
      var json = $.parseJSON(res);         
      $.each(json, function (key, value) {
       
        value = value.replace("'", "&#39;");
        var randomnum = Math.floor((Math.random() * 100000) + 1);
        var itemTemplate = "<li><div>";
        itemTemplate += "<input class='modify_text' type='text' id='text' value='" + value + "' style='width: 90%;'/>";
        itemTemplate += "<span class='deepaibrain_wpai_sort_heading'><i class='fa fa-bars'></i></span>";
        itemTemplate += "<span id='deepaibrain_wpai_remove_heading'><i class='fa fa-trash-o'></i></span>";
        itemTemplate += "<div style='display: none;'><span id='identifier'>" + randomnum + "</span>";
        itemTemplate += "</div>";
        itemTemplate += "</div></li>";
        $(".deepaibrain_wpai_menu_editor").prepend(itemTemplate);
      });
      $('#myModal').show();
      $('.modal-backdrop').show();
   }else{

 $.ajax({
      type: 'POST',
      url: prompt_api_url,
      data: {
        type: 'generate-content',
        express_content_title: express_content_title,
        deepaibrain_wpai_language: deepaibrain_wpai_language,
        deepaibrain_wpai_writing_style: deepaibrain_wpai_writing_style,
        deepaibrain_wpai_writing_tone: deepaibrain_wpai_writing_tone,
        deepaibrain_wpai_number_of_heading: deepaibrain_wpai_number_of_heading,
        deepaibrain_wpai_heading_tag: deepaibrain_wpai_heading_tag,
        deepaibrain_wpai_image_source: deepaibrain_wpai_image_source,           
        _wporg_img_style: _wporg_img_style,           
        deepaibrain_wpai_pexels_orientation: deepaibrain_wpai_pexels_orientation,           
        deepaibrain_wpai_pexels_size: deepaibrain_wpai_pexels_size, 
        deepaibrain_wpai_add_tagline: deepaibrain_wpai_add_tagline, 
        deepaibrain_wpai_add_intro: deepaibrain_wpai_add_intro, 
        deepaibrain_wpai_intro_title_tag: deepaibrain_wpai_intro_title_tag, 
        deepaibrain_wpai_add_conclusion: deepaibrain_wpai_add_conclusion, 
        deepaibrain_wpai_conclusion_title_tag: deepaibrain_wpai_conclusion_title_tag, 
        deepaibrain_wpai_toc: deepaibrain_wpai_toc, 
        deepaibrain_wpai_toc_title: deepaibrain_wpai_toc_title, 
        deepaibrain_wpai_toc_title_tag: deepaibrain_wpai_toc_title_tag, 
        deepaibrain_wpai_anchor_text: deepaibrain_wpai_anchor_text, 
        deepaibrain_wpai_target_url: deepaibrain_wpai_target_url, 
        deepaibrain_wpai_target_url_cta: deepaibrain_wpai_target_url_cta, 
        deepaibrain_wpai_cta_pos: deepaibrain_wpai_cta_pos, 
        deepaibrain_wpai_keywords: deepaibrain_wpai_keywords, 
        deepaibrain_wpai_exclude_keywords: deepaibrain_wpai_exclude_keywords, 
        deepaibrain_wpai_format_keywords: deepaibrain_wpai_format_keywords, 
        deepaibrain_wpai_seo_meta_desc: deepaibrain_wpai_seo_meta_desc, 
        domain: deepaibrain_openapi_api_key, 
        domain_name: domain_name,                        
      },
    
      success: function(res) {  
        var json = $.parseJSON(res);
        var generated_seo_content = json.generate_content_seo;                                                                              
        $('.tabOneContent textarea').val(json.generate_content);
        if (generated_seo_content) {
           $('.tabTwoContent textarea').val(generated_seo_content);
         }else{
           $('.tabTwoContent textarea').val(json.error_seo_text);
         }
         $('.loading_spinner').css('display', 'none');
        $("#post_save").removeAttr("disabled", "disabled"); 
      }
    })
    
   }
  }
})
}
});


$( document ).on('click', '#post_save', function() {

var ai_generated_title = $('#express_content_title').val();
var deepaibrain_wpai_language = $('#deepaibrain_wpai_language').val();
var ai_generated_content = $('.tabOneContent textarea').val();
var deepaibrain_wpai_featured_image_source = $('#deepaibrain_wpai_featured_image_source').val();
var deepaibrain_wpai_post_tags = $('#deepaibrain_wpai_post_tags').val();
var ai_generated_seo_desc = $('.tabTwoContent textarea').val();
var _wporg_img_style = $('#_wporg_img_style').val();
var deepaibrain_wpai_pexels_size = $('#deepaibrain_wpai_pexels_size').val();
var deepaibrain_wpai_pexels_orientation = $('#deepaibrain_wpai_pexels_orientation').val();
var deepaibrain_openapi_api_key = $('#deepaibrain_openapi_api_key').val();
var save_ai_res_nonce = $('#save_ai_res_nonce').val();

if ($('.ai_custom_prompt_enable').is(':checked')) {
var ai_custom_prompt_enable = $('.ai_custom_prompt_enable').val();
var ai_custom_prompt = $('.ai_custom_prompt').val();
}

var deepaibrain_wpai_item_alt = ai_generated_title;
var deepaibrain_wpai_item_title = ai_generated_title;
var deepaibrain_wpai_item_caption = ai_generated_title;
var deepaibrain_wpai_item_description = ai_generated_title;

if(ai_generated_title !== '' && ai_generated_content !== '') {
  $.ajax({
    type: 'POST',
    url: prompt_api_url,
    data: {
      type: 'get_image_for_thumbnail',
      express_content_title: ai_generated_title,
     _wporg_img_style: _wporg_img_style,
     deepaibrain_wpai_pexels_size: deepaibrain_wpai_pexels_size,
     deepaibrain_wpai_pexels_orientation: deepaibrain_wpai_pexels_orientation,
     deepaibrain_wpai_language: deepaibrain_wpai_language,
     domain: deepaibrain_openapi_api_key,            
     save_ai_res_nonce: save_ai_res_nonce,            
    },
    beforeSend: function() {
       $('.post_save_spinner').css('display', 'inline-block');
    },
  success: function(res) {
    var json = $.parseJSON(res); 
    var generated_image_ai = json.generated_image_ai;
    var generated_image_pexel = json.generated_image_pexel;

    $.ajax({
        type: 'POST',
        url: obj.ajaxurl,
        data: {
          action: 'deepaibrain_wpai_save_ai_res_to_draft',
          ai_generated_title: ai_generated_title,
          ai_generated_content: ai_generated_content,
          deepaibrain_wpai_featured_image_source: deepaibrain_wpai_featured_image_source,
          deepaibrain_wpai_post_tags: deepaibrain_wpai_post_tags,  
          ai_generated_seo_desc: ai_generated_seo_desc,
          ai_custom_prompt_enable: ai_custom_prompt_enable,
          ai_custom_prompt: ai_custom_prompt,
          deepaibrain_wpai_language: deepaibrain_wpai_language,
          deepaibrain_wpai_item_alt: deepaibrain_wpai_item_alt,
          deepaibrain_wpai_item_title: deepaibrain_wpai_item_title,
          deepaibrain_wpai_item_caption: deepaibrain_wpai_item_caption,
          deepaibrain_wpai_item_description: deepaibrain_wpai_item_description,
          generated_image_ai: generated_image_ai,
          generated_image_pexel: generated_image_pexel,
          save_ai_res_nonce: save_ai_res_nonce,
          
        },
        beforeSend: function() {
           $('.post_save_spinner').css('display', 'inline-block');
        },
        success: function(res) {
          console.log(res);
           $('.post_save_spinner').css('display', 'none');
              window.location=res;
        }
      })
    }
  })
 }
});


let tabs = document.querySelectorAll(".tabs h3");
let tabContents = document.querySelectorAll(".tab-content div");

tabs.forEach((tab, index) => {
  tab.addEventListener("click", () => {
    tabContents.forEach((content) => {
      content.classList.remove("active");
    });
    tabs.forEach((tab) => {
      tab.classList.remove("active");
    });
    tabContents[index].classList.add("active");
    tabs[index].classList.add("active");
  });
});

$( document ).on('click', '.ai_custom_prompt_enable', function() {
$(".meta_custom_prompt_box").toggle();
});

$(".ai_custom_prompt_enable").change(function() {
    if(this.checked){
        $('.ai_custom_prompt_enable').attr('value', 1);
    }else{
        $('.ai_custom_prompt_enable').attr('value', 0);
    }
});

$("#deepaibrain_wpai_add_tagline2").change(function() {
    if(this.checked){
        $('#deepaibrain_wpai_add_tagline').attr('value', 1);
    }else{
        $('#deepaibrain_wpai_add_tagline').attr('value', 0);
    }
});

$("#deepaibrain_wpai_add_intro2").change(function() {
    if(this.checked){
        $('#deepaibrain_wpai_add_intro').attr('value', 1);
    }else{
        $('#deepaibrain_wpai_add_intro').attr('value', 0);
    }
});

$("#deepaibrain_wpai_add_conclusion2").change(function() {
    if(this.checked){
        $('#deepaibrain_wpai_add_conclusion').attr('value', 1);
    }else{
        $('#deepaibrain_wpai_add_conclusion').attr('value', 0);
    }
});


$("#deepaibrain_wpai_toc").change(function() {
    if(this.checked){
        $(this).attr('value', 1);
    }else{
        $(this).attr('value', 0);
    }
});

$( document ).on('click', '#ai_images_data img', function() {
var ai_images_data =  $(this).attr('src');
var deepaibrain_wpai_item_alt = $('.deepaibrain_wpai_item_alt').val();
var deepaibrain_wpai_item_title = $('.deepaibrain_wpai_item_title').val();
var deepaibrain_wpai_item_caption = $('.deepaibrain_wpai_item_caption').val();
var deepaibrain_wpai_item_description = $('.deepaibrain_wpai_item_description').val();

 $('.deepaibrain_wpai_grid_form_2 img').attr('src', ai_images_data);
 $('.deepaibrain_wpai_edit_item_alt').val(deepaibrain_wpai_item_alt);
 $('.deepaibrain_wpai_edit_item_title').val(deepaibrain_wpai_item_title);
 $('.deepaibrain_wpai_edit_item_caption').val(deepaibrain_wpai_item_caption);
 $('.deepaibrain_wpai_edit_item_description').val(deepaibrain_wpai_item_description);
 $('#image-popup-overlay').show();
 $('#image-popup').show();

});

$( document ).on('click', '.deepaibrain_wpai_modal_close', function() {
 $('#image-popup-overlay').hide();
 $('#image-popup').hide();
});

$( document ).on('click', '.deepaibrain_wpai_meta_custom_prompt_reset', function() {
    var data_prompt = $(this).attr('data-prompt');
    $('.ai_custom_prompt').val(data_prompt);
});


$( document ).on('click', '#generate_ai_images', function() {
var ai_generator_image_title = $('#ai_generator_image_title').val();
var artist = $('#artist').val();
var art_style = $('#art_style').val();
var photography_style = $('#photography_style').val();
var lighting = $('#lighting').val();
var subject = $('#subject').val();
var camera_settings = $('#camera_settings').val();
var composition = $('#composition').val();
var resolution = $('#resolution').val();
var color = $('#color').val();
var special_effects = $('#special_effects').val();
var img_size = $('#img_size').val();
var deepaibrain_openapi_api_key = $('#deepaibrain_openapi_api_key').val();

if( ai_generator_image_title == '' ) {
  alert('Please Enter Title.');
  return false;
}

$.ajax({
  type: 'POST',
  url: prompt_api_url,
  data: {
    type: 'generate_ai_images',
    ai_generator_image_title: ai_generator_image_title,
    artist: artist,
    art_style: art_style,
    photography_style: photography_style,
    lighting: lighting,
    subject: subject,
    camera_settings: camera_settings,
    composition: composition,
    resolution: resolution,
    color: color,
    special_effects: special_effects,
    img_size: img_size,
    domain: deepaibrain_openapi_api_key, 
  },
   beforeSend: function() {
     $('.loading_spinner').css('display', 'inline-block');
  },
  success: function(res) {
     var json = $.parseJSON(res);
     
      var itemTemplate='';
      $.each(json, function (key, value) {              
            itemTemplate += "<div class='container'>";
            itemTemplate += "<input type='checkbox' name='generated_ai_image[]' id='generated_ai_image' data-image_url='"+value+"'>";
            itemTemplate += "<label for='dessert-3'>";
            itemTemplate += "<img src='"+value+"'>";
            itemTemplate += "</label>";
            itemTemplate += "<input type='hidden' class='deepaibrain_wpai_item_alt' value='"+ai_generator_image_title+"'>";
            itemTemplate += "<input type='hidden' class='deepaibrain_wpai_item_title' value='"+ai_generator_image_title+"'>";
            itemTemplate += "<input type='hidden' class='deepaibrain_wpai_item_caption' value='"+ai_generator_image_title+"'>";
            itemTemplate += "<input type='hidden' class='deepaibrain_wpai_item_description' value='"+ai_generator_image_title+"'>";
            itemTemplate += "</div>";
            
        });
     
    $('#ai_images_data').html(itemTemplate);
    $('.submit.save_to_media').css('display', 'block');
    $('.loading_spinner').css('display', 'none');
    
  }
})
});


$( document ).on('click', '#generate_stable_diffusion_images', function() {

var ai_generator_image_title = $('#ai_generator_image_title').val();
var artist = $('#artist').val();
var art_style = $('#art_style').val();
var photography_style = $('#photography_style').val();
var lighting = $('#lighting').val();
var subject = $('#subject').val();
var camera_settings = $('#camera_settings').val();
var composition = $('#composition').val();
var resolution = $('#resolution').val();
var color = $('#color').val();
var special_effects = $('#special_effects').val();
var img_size = $('#img_size').val();
var prompt_strength = $('#prompt_strength').val();
var num_inference_steps = $('#num_inference_steps').val();
var guidance_scale = $('#guidance_scale').val();
var scheduler = $('#scheduler').val();
var deepaibrain_openapi_api_key = $('#deepaibrain_openapi_api_key').val();
var domain_name = $('#domain_name').val();

if( ai_generator_image_title == '' ) {
  alert('Please Enter Title.');
  return false;
}

$.ajax({
  type: 'POST',
  url: prompt_api_url,
  data: {
    type: 'generate_stable_diffusion_images',
    ai_generator_image_title: ai_generator_image_title,
    artist: artist,
    art_style: art_style,
    photography_style: photography_style,
    lighting: lighting,
    subject: subject,
    camera_settings: camera_settings,
    composition: composition,
    resolution: resolution,
    color: color,
    special_effects: special_effects,
    img_size: img_size,
    prompt_strength: prompt_strength,
    num_inference_steps: num_inference_steps,
    guidance_scale: guidance_scale,
    scheduler: scheduler,
    domain: deepaibrain_openapi_api_key, 
    domain_name: domain_name, 
  },
   beforeSend: function() {
     $('.loading_spinner').css('display', 'inline-block');
  },
  success: function(res) {
      var result = $.parseJSON(res);
      var result_img = result.stable_diffusion_images;
      var itemTemplate='';
      if (result_img) {
      $.each(result_img, function (key, value) {
        itemTemplate += "<div class='container'>";
        itemTemplate += "<input type='checkbox' name='generated_ai_image[]' id='generated_ai_image' data-image_url='"+value+"'>";
        itemTemplate += "<label for='dessert-3'>";
        itemTemplate += "<img src='"+value+"'>";
        itemTemplate += "</label>";
        itemTemplate += "<input type='hidden' class='deepaibrain_wpai_item_alt' value='"+ai_generator_image_title+"'>";
        itemTemplate += "<input type='hidden' class='deepaibrain_wpai_item_title' value='"+ai_generator_image_title+"'>";
        itemTemplate += "<input type='hidden' class='deepaibrain_wpai_item_caption' value='"+ai_generator_image_title+"'>";
        itemTemplate += "<input type='hidden' class='deepaibrain_wpai_item_description' value='"+ai_generator_image_title+"'>";
        itemTemplate += "</div>";
            
        });
       $('.submit.save_to_media').css('display', 'block');
    }else{
      itemTemplate += result.error_text;
    }           
      $('#ai_images_data').html(itemTemplate);
      $('.loading_spinner').css('display', 'none');
   }
})
});

$( document ).on('click', '#save_to_media', function() {
var deepaibrain_wpai_item_alt = $('.deepaibrain_wpai_item_alt').val();
var deepaibrain_wpai_item_title = $('.deepaibrain_wpai_item_title').val();
var deepaibrain_wpai_item_caption = $('.deepaibrain_wpai_item_caption').val();
var deepaibrain_wpai_item_description = $('.deepaibrain_wpai_item_description').val();
var save_to_media_nonce = $('#save_to_media_nonce').val();

var generated_ai_image = [];

$('#generated_ai_image:checked').each(function(i){
    generated_ai_image[i] = $(this).attr('data-image_url');         
  });

    $.ajax({
      type: 'POST',
      url: obj.ajaxurl,
      data: {
        action: 'deepaibrain_wpai_generated_ai_image_to_save',
        generated_ai_image: generated_ai_image,
        deepaibrain_wpai_item_alt: deepaibrain_wpai_item_alt,
        deepaibrain_wpai_item_title: deepaibrain_wpai_item_title,
        deepaibrain_wpai_item_caption: deepaibrain_wpai_item_caption,
        deepaibrain_wpai_item_description: deepaibrain_wpai_item_description,
        save_to_media_nonce: save_to_media_nonce,
      },
      beforeSend: function() {
         $('.spinner_save_media').css('display', 'inline-block');
      },
      success: function(res) {
        $('#ai_images_data').css('display', 'none');
        $('.submit.save_to_media').css('display', 'none');
        $('.success_msg').css('display', 'block');
        $('.spinner_save_media').css('display', 'none');
      }
    })
});

$( document ).on('click', '.deepaibrain_wpai_edit_image_save', function() {
var image_edit_src = $('.deepaibrain_wpai_grid_form_2 img').attr('src');
var deepaibrain_wpai_edit_item_alt = $('.deepaibrain_wpai_edit_item_alt').val();
var deepaibrain_wpai_edit_item_title = $('.deepaibrain_wpai_edit_item_title').val();
var deepaibrain_wpai_edit_item_caption = $('.deepaibrain_wpai_edit_item_caption').val();
var deepaibrain_wpai_edit_item_description = $('.deepaibrain_wpai_edit_item_description').val();
var edit_image_save_nonce = $('#edit_image_save_nonce').val();

    $.ajax({
      type: 'POST',
      url: obj.ajaxurl,
      data: {
        action: 'deepaibrain_wpai_modal_image_save_function',
        image_edit_src: image_edit_src,
        deepaibrain_wpai_edit_item_alt: deepaibrain_wpai_edit_item_alt,
        deepaibrain_wpai_edit_item_title: deepaibrain_wpai_edit_item_title,
        deepaibrain_wpai_edit_item_caption: deepaibrain_wpai_edit_item_caption,
        deepaibrain_wpai_edit_item_description: deepaibrain_wpai_edit_item_description,
        edit_image_save_nonce: edit_image_save_nonce,
      },
      beforeSend: function() {
         $('.spinner_modal_image_save').css('display', 'inline-block');
      },
      success: function(res) {
        $('.spinner_modal_image_save').css('display', 'none');
        $('.success_msg_modal').css('display', 'block');
      }
    })
});

$("#deepaibrain_wpai_modify_headings2").change(function() {
    if(this.checked){
        $('#wpai_modify_headings').attr('value', 1);
    }else{
        $('#wpai_modify_headings').attr('value', 0);
    }
});


$(".content_generate").on("click", function(e) {
 var express_content_title = $('#express_content_title').val();
 var deepaibrain_openapi_api_key = $('#deepaibrain_openapi_api_key').val();
 var domain_name = $('#domain_name').val();
 
 if( express_content_title == '' ) {
    alert('Please Enter Title.');
    return false;
 }
 var deepaibrain_wpai_language = $('#deepaibrain_wpai_language').val();
 var deepaibrain_wpai_writing_style = $('#deepaibrain_wpai_writing_style').val();
 var deepaibrain_wpai_writing_tone = $('#deepaibrain_wpai_writing_tone').val();
 var deepaibrain_wpai_number_of_heading = $('#deepaibrain_wpai_number_of_heading').val();
 var deepaibrain_wpai_heading_tag = $('#deepaibrain_wpai_heading_tag').val();
 var deepaibrain_wpai_modify_headings = $('#deepaibrain_wpai_modify_headings').val();
 var deepaibrain_wpai_pexels_orientation = $('#deepaibrain_wpai_pexels_orientation').val();
 var _wporg_img_style = $('#_wporg_img_style').val();
 var deepaibrain_wpai_pexels_size = $('#deepaibrain_wpai_pexels_size').val();
 var deepaibrain_wpai_image_source = $('#deepaibrain_wpai_image_source').val();

if ($('#deepaibrain_wpai_add_tagline2').is(':checked')) {
  var deepaibrain_wpai_add_tagline = $('#deepaibrain_wpai_add_tagline').val();
}

if ($('#deepaibrain_wpai_add_intro2').is(':checked')) {
  var deepaibrain_wpai_add_intro = $('#deepaibrain_wpai_add_intro').val();
  var deepaibrain_wpai_intro_title_tag = $('#deepaibrain_wpai_intro_title_tag').val();
}

if ($('#deepaibrain_wpai_add_conclusion2').is(':checked')) {
  var deepaibrain_wpai_add_conclusion = $('#deepaibrain_wpai_add_conclusion').val();
  var deepaibrain_wpai_conclusion_title_tag = $('#deepaibrain_wpai_conclusion_title_tag').val();
}

  if ($('#deepaibrain_wpai_toc').is(':checked')) {
    var deepaibrain_wpai_toc = $('#deepaibrain_wpai_toc').val();
    var deepaibrain_wpai_toc_title = $('#deepaibrain_wpai_toc_title').val();
    var deepaibrain_wpai_toc_title_tag = $('#deepaibrain_wpai_toc_title_tag').val();
  }

  var deepaibrain_wpai_anchor_text = $('#deepaibrain_wpai_anchor_text').val();
  var deepaibrain_wpai_target_url = $('#deepaibrain_wpai_target_url').val();
  var deepaibrain_wpai_target_url_cta = $('#deepaibrain_wpai_target_url_cta').val();
  var deepaibrain_wpai_cta_pos = $('#deepaibrain_wpai_cta_pos').val();

  var deepaibrain_wpai_keywords = $('#deepaibrain_wpai_keywords').val();
  var deepaibrain_wpai_exclude_keywords = $('#deepaibrain_wpai_exclude_keywords').val();
  var deepaibrain_wpai_format_keywords = $('#deepaibrain_wpai_format_keywords').val();
  
  if ($('#deepaibrain_wpai_seo_meta_desc').is(':checked')) {
   var deepaibrain_wpai_seo_meta_desc = $('#deepaibrain_wpai_seo_meta_desc').val();
  }

  var menu_data = $(".deepaibrain_wpai_menu_editor").children();
  var firstli = menu_data;
  var modify_title = [];
  firstli.each(function (i) {
    modify_title[i] = $(this).find("#text").val();
  });                
        
   $.ajax({
      type: 'POST',
      url: prompt_api_url,
      data: {
        type: 'generate-content',
        modify_title: modify_title,           
        express_content_title: express_content_title,           
        deepaibrain_wpai_language: deepaibrain_wpai_language,
        deepaibrain_wpai_writing_style: deepaibrain_wpai_writing_style,
        deepaibrain_wpai_writing_tone: deepaibrain_wpai_writing_tone,
        deepaibrain_wpai_number_of_heading: deepaibrain_wpai_number_of_heading,
        deepaibrain_wpai_heading_tag: deepaibrain_wpai_heading_tag,
        deepaibrain_wpai_image_source: deepaibrain_wpai_image_source,           
        _wporg_img_style: _wporg_img_style,           
        deepaibrain_wpai_pexels_orientation: deepaibrain_wpai_pexels_orientation,           
        deepaibrain_wpai_pexels_size: deepaibrain_wpai_pexels_size, 
        deepaibrain_wpai_add_tagline: deepaibrain_wpai_add_tagline, 
        deepaibrain_wpai_add_intro: deepaibrain_wpai_add_intro, 
        deepaibrain_wpai_intro_title_tag: deepaibrain_wpai_intro_title_tag, 
        deepaibrain_wpai_add_conclusion: deepaibrain_wpai_add_conclusion, 
        deepaibrain_wpai_conclusion_title_tag: deepaibrain_wpai_conclusion_title_tag, 
        deepaibrain_wpai_toc: deepaibrain_wpai_toc, 
        deepaibrain_wpai_toc_title: deepaibrain_wpai_toc_title, 
        deepaibrain_wpai_toc_title_tag: deepaibrain_wpai_toc_title_tag, 
        deepaibrain_wpai_anchor_text: deepaibrain_wpai_anchor_text, 
        deepaibrain_wpai_target_url: deepaibrain_wpai_target_url, 
        deepaibrain_wpai_target_url_cta: deepaibrain_wpai_target_url_cta, 
        deepaibrain_wpai_cta_pos: deepaibrain_wpai_cta_pos, 
        deepaibrain_wpai_keywords: deepaibrain_wpai_keywords, 
        deepaibrain_wpai_exclude_keywords: deepaibrain_wpai_exclude_keywords, 
        deepaibrain_wpai_seo_meta_desc: deepaibrain_wpai_seo_meta_desc, 
        deepaibrain_wpai_format_keywords: deepaibrain_wpai_format_keywords,                  
        domain: deepaibrain_openapi_api_key,                  
        domain_name: domain_name,                   
      },
      beforeSend: function() {
              $('#myModal').fadeOut('deepaibrain_wpai_hide');                       
              $('.loading_spinner').css('display', 'inline-block');
              e.stopPropagation();
      },
      success: function(res) {
           var json = $.parseJSON(res);   
           $('.tabOneContent textarea').val(json.generate_content);
           $('.tabTwoContent textarea').val(json.generate_content_seo);
           $('.loading_spinner').css('display', 'none');
           $("#post_save").removeAttr("disabled", "disabled");     
                             
      }
      });
    });

$("body").on('click', '#deepaibrain_wpai_add_new_heading', function (e) {
  if($('#myModal .deepaibrain_wpai_menu_editor li').length >= 10){
      alert('Limited 10 headings')
  }
  else{
      var randomnum = Math.floor((Math.random() * 100000) + 1);

      var itemTemplate = "<li><div>";

      itemTemplate += "<input type='text' id='text' value='' placeholder='Type heading text...' style='width: 90%;' />";

      itemTemplate += "<span class='wpai_sort_heading'><i class='fa fa-bars'></i></span>";

      itemTemplate += "<span id='wpai_remove_heading'><i class='fa fa-trash-o'></i></span>";

      itemTemplate += "<div style='display: none;'><span id='identifier'>" + randomnum + "</span>";
      itemTemplate += "</div>";
      itemTemplate += "</div></li>";
      $(".deepaibrain_wpai_menu_editor").append(itemTemplate);
  }
});

var menuHolder = $('.deepaibrain_wpai_menu_editor');
menuHolder.sortable({
    handle: 'div',
    items: 'li',
    toleranceElement: '> div',
    maxLevels: 2,
    isTree: true,
    tolerance: 'pointer'
});

$("body").on('click', '#deepaibrain_wpai_remove_heading', function () {
      var p = $(this).parent().parent();
      $(p).remove();
});

$("body").on('click', '.m_close', function (e) {
     $('#myModal').fadeOut('deepaibrain_wpai_hide'); 
     location.reload();
     e.stopPropagation();
});


});



