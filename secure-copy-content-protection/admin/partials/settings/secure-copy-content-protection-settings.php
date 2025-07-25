<?php
$actions = $this->settings_obj;

if (isset($_REQUEST['ays_submit'])) {
	$actions->store_data($_REQUEST);
}
if (isset($_GET['ays_sccp_tab'])) {
	$ays_sccp_tab = sanitize_text_field($_GET['ays_sccp_tab']);
} else {
	$ays_sccp_tab = 'tab1';
}
$db_data = $actions->get_db_data();

$options = ($actions->ays_get_setting('options') === false) ? array() : json_decode( stripcslashes( $actions->ays_get_setting('options') ), true);

$subscribe = ($actions->ays_get_setting('subscribe') === false) ? array() : json_decode( stripcslashes( $actions->ays_get_setting('subscribe') ), true);

$block_content = ($actions->ays_get_setting('block_content') === false) ? array() : json_decode( stripcslashes( $actions->ays_get_setting('block_content') ), true);

$mailchimp_res      = ($actions->ays_get_setting('mailchimp') === false) ? json_encode(array()) : $actions->ays_get_setting('mailchimp');
$mailchimp          = json_decode($mailchimp_res, true);
$mailchimp_username = isset($mailchimp['username']) ? esc_attr(stripslashes($mailchimp['username'])) : '';
$mailchimp_api_key  = isset($mailchimp['apiKey']) ? esc_attr(stripslashes($mailchimp['apiKey'])) : '';

$sub_icon_image_text = __('Add Icon', 'secure-copy-content-protection');
$bc_icon_image_text = __('Add Icon', 'secure-copy-content-protection');
$sub_bg_image_text = __('Add Image', 'secure-copy-content-protection');
$bc_bg_image_text = __('Add Image', 'secure-copy-content-protection');

// WP Editor height
$sccp_wp_editor_height = (isset($options['sccp_wp_editor_height']) && $options['sccp_wp_editor_height'] != '' && $options['sccp_wp_editor_height'] != 0) ? absint( sanitize_text_field($options['sccp_wp_editor_height']) ) : 150 ;

// Block content box width
$ays_sccp_bc_width = (isset($block_content['sccp_bc_width']) && $block_content['sccp_bc_width'] != '' && $block_content['sccp_bc_width'] != 0) ? absint( sanitize_text_field($block_content['sccp_bc_width']) ) : '' ;

// Block content box width by percentage or pixels
$sccp_bc_width_by_percentage_px = (isset($block_content['sccp_bc_width_by_percentage_px']) && $block_content['sccp_bc_width_by_percentage_px'] != '') ? $block_content['sccp_bc_width_by_percentage_px'] : 'pixels';

// Block content box text color
$ays_sccp_bc_text_color = (isset($block_content['sccp_bc_text_color']) && $block_content['sccp_bc_text_color'] != '') ? stripslashes( esc_attr($block_content['sccp_bc_text_color']) ) : '#000';

// Block content box background color
$ays_sccp_bc_bg_color = (isset($block_content['sccp_bc_bg_color']) && $block_content['sccp_bc_bg_color'] != '') ? stripslashes( esc_attr($block_content['sccp_bc_bg_color']) ) : '#fff';

// Block content box background image
$sccp_bc_bg_image = isset($block_content["bc_bg_image"]) || !empty($block_content["bc_bg_image"]) ? $block_content["bc_bg_image"] : '';

// Block content Bg image positioning
$sccp_bc_bg_image_position = (isset($block_content["bc_bg_image_position"]) && $block_content["bc_bg_image_position"] != '') ? $block_content["bc_bg_image_position"] : "center center";

// Block content box button text
$ays_sccp_bc_button_text = (isset($block_content['sccp_bc_button_text']) && $block_content['sccp_bc_button_text'] != '') ? stripslashes( esc_attr($block_content['sccp_bc_button_text']) ) : 'Submit' ;

// Block content box password placeholder text
$sccp_bc_psw_place_text = (isset($block_content['sccp_bc_psw_place_text']) && $block_content['sccp_bc_psw_place_text'] != '') ? stripslashes( esc_attr($block_content['sccp_bc_psw_place_text']) ) : 'Password' ;

// Block content Container border style
$ays_sccp_bc_cont_border_style = (isset($block_content['bc_cont_border_style']) && $block_content['bc_cont_border_style'] != '') ? $block_content['bc_cont_border_style'] : 'double';

// Block content Container border color
$ays_sccp_bc_cont_border_color = (isset($block_content['bc_cont_border_color']) && $block_content['bc_cont_border_color'] != '') ? stripslashes( esc_attr( $block_content['bc_cont_border_color'] ) ) : '#c5c5c5';

// Block content Container border width
$ays_sccp_bc_cont_border_width = (isset($block_content['bc_cont_border_width']) && $block_content['bc_cont_border_width'] != '') ? $block_content['bc_cont_border_width'] : '4';

// Block content icon image
$sccp_bc_icon_image = isset($block_content["bc_icon_image"]) || !empty($block_content["bc_icon_image"]) ? $block_content["bc_icon_image"] : '';

// Block content input width
$ays_sccp_bc_input_width = (isset($block_content['bc_cont_input_width']) && $block_content['bc_cont_input_width'] != '' && $block_content['bc_cont_input_width'] != 0) ? absint( sanitize_text_field($block_content['bc_cont_input_width'])) : '';

// Block content box text alignment
$ays_sccp_bc_text_alignment = (isset($block_content['bc_text_alignment']) && sanitize_text_field( $block_content['bc_text_alignment'] ) != '') ? sanitize_text_field( $block_content['bc_text_alignment'] ) : 'center';

// Block content button style
$block_content['enable_bc_btn_style'] = (isset($block_content['enable_bc_btn_style']) && $block_content['enable_bc_btn_style'] == 'on') ? 'on' : 'off'; 
$ays_sccp_enable_bc_btn_style = (isset($block_content['enable_bc_btn_style']) && $block_content['enable_bc_btn_style'] == 'on') ? true : false;
$ays_sccp_bc_btn_color = (isset($block_content['bc_btn_color']) && $block_content['bc_btn_color'] != '') ? stripslashes( esc_attr( $block_content['bc_btn_color'] ) ) : 'rgba(255,255,255,0)';
$ays_sccp_bc_btn_text_color = (isset($block_content['bc_btn_text_color']) && $block_content['bc_btn_text_color'] != '') ? stripslashes( esc_attr( $block_content['bc_btn_text_color'] ) ) : '#000000';

$ays_sccp_bc_btn_size = (isset($block_content['bc_btn_size']) && $block_content['bc_btn_size'] != '') ? stripslashes( esc_attr( $block_content['bc_btn_size'] ) ) : '14';
$ays_sccp_bc_mobile_btn_size = (isset($block_content['bc_mobile_btn_size']) && $block_content['bc_mobile_btn_size'] != '') ? stripslashes( esc_attr( $block_content['bc_mobile_btn_size'] ) ) : '14';

$ays_sccp_bc_btn_radius = (isset($block_content['bc_btn_radius']) && $block_content['bc_btn_radius'] != '') ? $block_content['bc_btn_radius'] : '3';

// Block content Buttons border width
$ays_sccp_bc_btn_border_width = (isset($block_content['bc_btn_border_width']) && $block_content['bc_btn_border_width'] != '') ? $block_content['bc_btn_border_width'] : '1';

// Block content Buttons border style
$ays_sccp_bc_btn_border_style = (isset($block_content['bc_btn_border_style']) && $block_content['bc_btn_border_style'] != '') ? $block_content['bc_btn_border_style'] : 'solid';

// Block content Buttons border color
$ays_sccp_bc_btn_border_color = (isset($block_content['bc_btn_border_color']) && $block_content['bc_btn_border_color'] != '') ? stripslashes( esc_attr( $block_content['bc_btn_border_color'] ) ) : '#c5c5c5';

// Block content Buttons Left / Right padding
$ays_bc_buttons_left_right_padding = (isset($block_content['bc_btn_left_right_padding']) && $block_content['bc_btn_left_right_padding'] != '') ? $block_content['bc_btn_left_right_padding'] : '10';

// Block content Buttons Top / Bottom padding
$ays_bc_buttons_top_bottom_padding = (isset($block_content['bc_btn_top_bottom_padding']) && $block_content['bc_btn_top_bottom_padding'] != '') ? $block_content['bc_btn_top_bottom_padding'] : '10';

// Subscribe box width
$ays_sccp_sub_width = (isset($subscribe['sccp_sub_width']) && $subscribe['sccp_sub_width'] != '' && $subscribe['sccp_sub_width'] != 0) ? absint( sanitize_text_field($subscribe['sccp_sub_width']) ) : '' ;

// Subscribe box width by percentage or pixels
$sccp_sub_width_by_percentage_px = (isset($subscribe['sccp_sub_width_by_percentage_px']) && $subscribe['sccp_sub_width_by_percentage_px'] != '') ? $subscribe['sccp_sub_width_by_percentage_px'] : 'pixels';

// Subscribe box width mobile
$ays_sccp_sub_width_mobile = (isset($subscribe['sccp_sub_width_mobile']) && $subscribe['sccp_sub_width_mobile'] != '' && $subscribe['sccp_sub_width_mobile'] != 0) ? absint( sanitize_text_field($subscribe['sccp_sub_width_mobile']) ) : '' ;

// Subscribe box width mobile by percentage or pixels
$sccp_sub_width_mobile_by_percentage_px = (isset($subscribe['sccp_sub_width_mobile_by_percentage_px']) && $subscribe['sccp_sub_width_by_percentage_px'] != '') ? $subscribe['sccp_sub_width_mobile_by_percentage_px'] : 'pixels';

// Subscribe box title font size
$sccp_sub_title_size = (isset($subscribe['sccp_sub_title_size']) && $subscribe['sccp_sub_title_size'] != '' && $subscribe['sccp_sub_title_size'] != 0) ? absint( sanitize_text_field($subscribe['sccp_sub_title_size']) ) : 18 ;

// Enable Subscribe box title font size Mobile
$subscribe['enable_sccp_sub_title_size_mobile'] = isset( $subscribe['enable_sccp_sub_title_size_mobile'] ) && $subscribe['enable_sccp_sub_title_size_mobile'] == 'off' ? 'off' : 'on';
$enable_sccp_sub_title_size_mobile = $subscribe['enable_sccp_sub_title_size_mobile'] == 'on' ?  true : false;

// Subscribe box title font size Mobile
$sccp_sub_title_size_mobile = isset( $subscribe['sccp_sub_title_size_mobile'] ) && $subscribe['sccp_sub_title_size_mobile'] != 0 ? esc_attr( $subscribe['sccp_sub_title_size_mobile'] ) : $sccp_sub_title_size;

// Subscribe box description font size
$sccp_sub_desc_size = (isset($subscribe['sccp_sub_desc_size']) && $subscribe['sccp_sub_desc_size'] != '' && $subscribe['sccp_sub_desc_size'] != 0) ? absint( sanitize_text_field($subscribe['sccp_sub_desc_size']) ) : 18 ;

// Enable Subscribe box description font size Mobile
$subscribe['enable_sccp_sub_desc_size_mobile'] = isset( $subscribe['enable_sccp_sub_desc_size_mobile'] ) && $subscribe['enable_sccp_sub_desc_size_mobile'] == 'off' ? 'off' : 'on';
$enable_sccp_sub_desc_size_mobile = $subscribe['enable_sccp_sub_desc_size_mobile'] == 'on' ?  true : false;

// Subscribe box description font size Mobile
$sccp_sub_desc_size_mobile = isset( $subscribe['sccp_sub_desc_size_mobile'] ) && $subscribe['sccp_sub_desc_size_mobile'] != 0 ? esc_attr( $subscribe['sccp_sub_desc_size_mobile'] ) : $sccp_sub_desc_size;

// Subscribe box text color
$ays_sccp_sub_text_color = ( isset( $subscribe['sccp_sub_text_color'] ) && $subscribe['sccp_sub_text_color'] != '' ) ? stripslashes( esc_attr($subscribe['sccp_sub_text_color']) ) : '#000';

// Enable Subscribe box Text Color Mobile
$subscribe['enable_sccp_sub_text_color_mobile'] = isset( $subscribe['enable_sccp_sub_text_color_mobile'] ) && $subscribe['enable_sccp_sub_text_color_mobile'] == 'off' ? 'off' : 'on';
$enable_ays_sccp_sub_text_color_mobile = $subscribe['enable_sccp_sub_text_color_mobile'] == 'on' ?  true : false;

// Subscribe box Text Color Mobile
$ays_sccp_sub_text_color_mobile = isset( $subscribe['sccp_sub_text_color_mobile'] ) && $subscribe['sccp_sub_text_color_mobile'] != '' ? esc_attr( $subscribe['sccp_sub_text_color_mobile'] ) : $ays_sccp_sub_text_color;

// Subscribe box Background color
$ays_sccp_sub_bg_color = (isset($subscribe['sccp_sub_bg_color']) && $subscribe['sccp_sub_bg_color'] != '') ? stripslashes( esc_attr($subscribe['sccp_sub_bg_color']) ) : '#fff';

// Enable Subscribe box Background Color Mobile
$subscribe['enable_sccp_sub_bg_color_mobile'] = isset( $subscribe['enable_sccp_sub_bg_color_mobile'] ) && $subscribe['enable_sccp_sub_bg_color_mobile'] == 'off' ? 'off' : 'on';
$enable_ays_sccp_sub_bg_color_mobile = $subscribe['enable_sccp_sub_bg_color_mobile'] == 'on' ?  true : false;

// Subscribe box Background Color Mobile
$ays_sccp_sub_bg_color_mobile = isset( $subscribe['sccp_sub_bg_color_mobile'] ) && $subscribe['sccp_sub_bg_color_mobile'] != '' ? esc_attr( $subscribe['sccp_sub_bg_color_mobile'] ) : $ays_sccp_sub_bg_color;

// Subscribe description text color
$ays_sccp_sub_desc_text_color = (isset($subscribe['sccp_sub_desc_text_color']) && $subscribe['sccp_sub_desc_text_color'] != '') ? stripslashes( esc_attr($subscribe['sccp_sub_desc_text_color']) ) : '#000';

// Enable Subscribe description text color Mobile
$subscribe['enable_sccp_sub_desc_text_color_mobile'] = isset( $subscribe['enable_sccp_sub_desc_text_color_mobile'] ) && $subscribe['enable_sccp_sub_desc_text_color_mobile'] == 'off' ? 'off' : 'on';
$enable_ays_sccp_sub_desc_text_color_mobile = $subscribe['enable_sccp_sub_desc_text_color_mobile'] == 'on' ?  true : false;

// Subscribe box description text color Mobile
$ays_sccp_sub_desc_text_color_mobile = isset( $subscribe['sccp_sub_desc_text_color_mobile'] ) && $subscribe['sccp_sub_desc_text_color_mobile'] != '' ? esc_attr( $subscribe['sccp_sub_desc_text_color_mobile'] ) : $ays_sccp_sub_desc_text_color;

// Subscribe box title transformation
$sub_title_transformation = (isset($subscribe['sub_title_transformation']) && sanitize_text_field($subscribe['sub_title_transformation']) != "") ? sanitize_text_field($subscribe['sub_title_transformation']) : 'none';

// Enable Subscribe title transformation Mobile
$subscribe['enable_sub_title_transformation_mobile'] = isset( $subscribe['enable_sub_title_transformation_mobile'] ) && $subscribe['enable_sub_title_transformation_mobile'] == 'off' ? 'off' : 'on';
$enable_sub_title_transformation_mobile = $subscribe['enable_sub_title_transformation_mobile'] == 'on' ?  true : false;

// Subscribe box title transformation Mobile
$sub_title_transformation_mobile = isset( $subscribe['sub_title_transformation_mobile'] ) && $subscribe['sub_title_transformation_mobile'] != '' ? esc_attr( $subscribe['sub_title_transformation_mobile'] ) : $sub_title_transformation;

// Subscribe box button text
$ays_sccp_sub_button_text = (isset($subscribe['sccp_sub_button_text']) && $subscribe['sccp_sub_button_text'] != '') ? stripslashes( esc_attr($subscribe['sccp_sub_button_text']) ) : 'Subscribe' ;

// Enable Subscribe box button text Mobile
$subscribe['enable_sccp_sub_button_text_mobile'] = isset( $subscribe['enable_sccp_sub_button_text_mobile'] ) && $subscribe['enable_sccp_sub_button_text_mobile'] == 'off' ? 'off' : 'on';
$enable_ays_sccp_sub_button_text_mobile = $subscribe['enable_sccp_sub_button_text_mobile'] == 'on' ?  true : false;

// Subscribe box button text Mobile
$ays_sccp_sub_button_text_mobile = isset( $subscribe['sccp_sub_button_text_mobile'] ) && $subscribe['sccp_sub_button_text_mobile'] != '' ? stripslashes( esc_attr( $subscribe['sccp_sub_button_text_mobile'] ) ) : $ays_sccp_sub_button_text;

// Subscribe box email placeholder text
$sccp_sub_email_place_text = (isset($subscribe['sccp_sub_email_place_text']) && $subscribe['sccp_sub_email_place_text'] != '') ? stripslashes( esc_attr($subscribe['sccp_sub_email_place_text']) ) : 'Type your email address' ;

// Subscribe box name placeholder text
$sccp_sub_name_place_text = (isset($subscribe['sccp_sub_name_place_text']) && $subscribe['sccp_sub_name_place_text'] != '') ? stripslashes( esc_attr($subscribe['sccp_sub_name_place_text']) ) : 'Type your name' ;

// Do not store IP adressess
$options['sccp_disable_user_ip'] = isset($options['sccp_disable_user_ip']) ? $options['sccp_disable_user_ip'] : 'off';
$sccp_disable_user_ip = (isset($options['sccp_disable_user_ip']) && $options['sccp_disable_user_ip'] == "on") ? true : false;

// Subscribe button style
$subscribe['enable_sub_btn_style'] = (isset($subscribe['enable_sub_btn_style']) && $subscribe['enable_sub_btn_style'] == 'on') ? 'on' : 'off'; 
$ays_sccp_enable_sub_btn_style = (isset($subscribe['enable_sub_btn_style']) && $subscribe['enable_sub_btn_style'] == 'on') ? true : false;

// Subscribe Button color color
$ays_sccp_sub_btn_color = (isset($subscribe['sub_btn_color']) && $subscribe['sub_btn_color'] != '') ? stripslashes( esc_attr( $subscribe['sub_btn_color'] ) ) : 'rgba(255,255,255,0)';

// Enable Subscribe Button color color Mobile
$subscribe['enable_sub_btn_color_mobile'] = isset( $subscribe['enable_sub_btn_color_mobile'] ) && $subscribe['enable_sub_btn_color_mobile'] == 'off' ? 'off' : 'on';
$enable_ays_sccp_sub_btn_color_mobile = $subscribe['enable_sub_btn_color_mobile'] == 'on' ?  true : false;

// Subscribe Button color color Mobile
$ays_sccp_sub_btn_color_mobile = isset( $subscribe['sub_btn_color_mobile'] ) && $subscribe['sub_btn_color_mobile'] != '' ? esc_attr( $subscribe['sub_btn_color_mobile'] ) : $ays_sccp_sub_btn_color;

$ays_sccp_sub_btn_text_color = (isset($subscribe['sub_btn_text_color']) && $subscribe['sub_btn_text_color'] != '') ? stripslashes( esc_attr( $subscribe['sub_btn_text_color'] ) ) : '#000000';
$ays_sccp_sub_btn_size = (isset($subscribe['sub_btn_size']) && $subscribe['sub_btn_size'] != '') ? stripslashes( esc_attr( $subscribe['sub_btn_size'] ) ) : '14';
$ays_sccp_sub_mobile_btn_size = (isset($subscribe['sub_mobile_btn_size']) && $subscribe['sub_mobile_btn_size'] != '') ? stripslashes( esc_attr( $subscribe['sub_mobile_btn_size'] ) ) : '14';
$ays_sccp_sub_btn_radius = (isset($subscribe['sub_btn_radius']) && $subscribe['sub_btn_radius'] != '') ? $subscribe['sub_btn_radius'] : '3';

// Buttons border width
$ays_sccp_sub_btn_border_width = (isset($subscribe['sub_btn_border_width']) && $subscribe['sub_btn_border_width'] != '') ? $subscribe['sub_btn_border_width'] : '1';

// Buttons border style
$ays_sccp_sub_btn_border_style = (isset($subscribe['sub_btn_border_style']) && $subscribe['sub_btn_border_style'] != '') ? $subscribe['sub_btn_border_style'] : 'solid';

// Subscribe Container border style
$ays_sccp_sub_cont_border_style = (isset($subscribe['sub_cont_border_style']) && $subscribe['sub_cont_border_style'] != '') ? $subscribe['sub_cont_border_style'] : 'solid';

// Enable Subscribe Container border style Mobile
$subscribe['enable_sub_cont_border_style_mobile'] = isset( $subscribe['enable_sub_cont_border_style_mobile'] ) && $subscribe['enable_sub_cont_border_style_mobile'] == 'off' ? 'off' : 'on';
$enable_ays_sccp_sub_cont_border_style_mobile = $subscribe['enable_sub_cont_border_style_mobile'] == 'on' ?  true : false;

// Subscribe Container border style Mobile
$ays_sccp_sub_cont_border_style_mobile = isset( $subscribe['sub_cont_border_style_mobile'] ) && $subscribe['sub_cont_border_style_mobile'] != '' ? esc_attr( $subscribe['sub_cont_border_style_mobile'] ) : $ays_sccp_sub_cont_border_style;

// Container border width
$ays_sccp_sub_cont_border_width = (isset($subscribe['sub_cont_border_width']) && $subscribe['sub_cont_border_width'] != '') ? $subscribe['sub_cont_border_width'] : '1';

// Enable Subscribe Container border width Mobile
$subscribe['enable_sub_cont_border_width_mobile'] = isset( $subscribe['enable_sub_cont_border_width_mobile'] ) && $subscribe['enable_sub_cont_border_width_mobile'] == 'off' ? 'off' : 'on';
$enable_ays_sccp_sub_cont_border_width_mobile = $subscribe['enable_sub_cont_border_width_mobile'] == 'on' ?  true : false;

// Subscribe box Container border width Mobile
$ays_sccp_sub_cont_border_width_mobile = isset( $subscribe['sub_cont_border_width_mobile'] ) && $subscribe['sub_cont_border_width_mobile'] != '' ? esc_attr( $subscribe['sub_cont_border_width_mobile'] ) : $ays_sccp_sub_cont_border_width;

// Subscribe Container input width
$ays_sccp_sub_input_width = (isset($subscribe['sub_cont_input_width']) && $subscribe['sub_cont_input_width'] != '' && $subscribe['sub_cont_input_width'] != 0) ? absint( sanitize_text_field($subscribe['sub_cont_input_width'])) : '';

// Enable Subscribe Container input width Mobile
$subscribe['enable_sub_cont_input_width_mobile'] = isset( $subscribe['enable_sub_cont_input_width_mobile'] ) && $subscribe['enable_sub_cont_input_width_mobile'] == 'off' ? 'off' : 'on';
$enable_ays_sccp_sub_input_width_mobile = $subscribe['enable_sub_cont_input_width_mobile'] == 'on' ?  true : false;

// Subscribe Container input width Mobile
$ays_sccp_sub_input_width_mobile = isset( $subscribe['sub_cont_input_width_mobile'] ) && $subscribe['sub_cont_input_width_mobile'] != '' ? esc_attr( $subscribe['sub_cont_input_width_mobile'] ) : $ays_sccp_sub_input_width;

// Buttons border color
$ays_sccp_sub_btn_border_color = (isset($subscribe['sub_btn_border_color']) && $subscribe['sub_btn_border_color'] != '') ? stripslashes( esc_attr( $subscribe['sub_btn_border_color'] ) ) : '#000000';

// Subscribe Container border color
$ays_sccp_sub_cont_border_color = (isset($subscribe['sub_cont_border_color']) && $subscribe['sub_cont_border_color'] != '') ? stripslashes( esc_attr( $subscribe['sub_cont_border_color'] ) ) : '#000000';

// Enable Subscribe Container border color Mobile
$subscribe['enable_sub_cont_border_color_mobile'] = isset( $subscribe['enable_sub_cont_border_color_mobile'] ) && $subscribe['enable_sub_cont_border_color_mobile'] == 'off' ? 'off' : 'on';
$enable_ays_sccp_sub_cont_border_color_mobile = $subscribe['enable_sub_cont_border_color_mobile'] == 'on' ?  true : false;

// Subscribe box Container border color Mobile
$ays_sccp_sub_cont_border_color_mobile = isset( $subscribe['sub_cont_border_color_mobile'] ) && $subscribe['sub_cont_border_color_mobile'] != '' ? esc_attr( $subscribe['sub_cont_border_color_mobile'] ) : $ays_sccp_sub_cont_border_color;

// Buttons Left / Right padding
$buttons_left_right_padding = (isset($subscribe['sub_btn_left_right_padding']) && $subscribe['sub_btn_left_right_padding'] != '') ? $subscribe['sub_btn_left_right_padding'] : '20';

// Buttons Top / Bottom padding
$buttons_top_bottom_padding = (isset($subscribe['sub_btn_top_bottom_padding']) && $subscribe['sub_btn_top_bottom_padding'] != '') ? $subscribe['sub_btn_top_bottom_padding'] : '10';
 
// Subscribe box text alignment
$ays_sccp_sub_text_alignment = (isset($subscribe['sccp_sub_text_alignment']) && sanitize_text_field( $subscribe['sccp_sub_text_alignment'] ) != '') ? sanitize_text_field( $subscribe['sccp_sub_text_alignment'] ) : 'center';

// Enable Subscribe box text alignment Mobile
$subscribe['enable_sccp_sub_text_alignment_mobile'] = isset( $subscribe['enable_sccp_sub_text_alignment_mobile'] ) && $subscribe['enable_sccp_sub_text_alignment_mobile'] == 'off' ? 'off' : 'on';
$enable_ays_sccp_sub_text_alignment_mobile = $subscribe['enable_sccp_sub_text_alignment_mobile'] == 'on' ?  true : false;

// Subscribe box text alignment Mobile
$ays_sccp_sub_text_alignment_mobile = isset( $subscribe['sccp_sub_text_alignment_mobile'] ) && $subscribe['sccp_sub_text_alignment_mobile'] != '' ? esc_attr( $subscribe['sccp_sub_text_alignment_mobile'] ) : $ays_sccp_sub_text_alignment;

$loader_iamge = "<span class='ays_display_none ays_sccp_loader_box'><img src='". SCCP_ADMIN_URL ."/images/loaders/loading.gif'></span>";

$sccp_sub_icon_image = isset($subscribe["sub_icon_image"]) || !empty($subscribe["sub_icon_image"]) ? $subscribe["sub_icon_image"] : '';

$sccp_sub_bg_image = isset($subscribe["sub_bg_image"]) || !empty($subscribe["sub_bg_image"]) ? $subscribe["sub_bg_image"] : '';

// Subscribe Bg image positioning
$sccp_sub_bg_image_position = (isset($subscribe["sub_bg_image_position"]) && $subscribe["sub_bg_image_position"] != '') ? $subscribe["sub_bg_image_position"] : "center center";

// Enable Subscribe Bg image positioning Mobile
$subscribe['enable_sub_bg_image_position_mobile'] = isset( $subscribe['enable_sub_bg_image_position_mobile'] ) && $subscribe['enable_sub_bg_image_position_mobile'] == 'off' ? 'off' : 'on';
$enable_sccp_sub_bg_image_position_mobile = $subscribe['enable_sub_bg_image_position_mobile'] == 'on' ?  true : false;

// Subscribe Bg image positioning Mobile
$sccp_sub_bg_image_position_mobile = isset( $subscribe['sub_bg_image_position_mobile'] ) && $subscribe['sub_bg_image_position_mobile'] != '' ? stripslashes ( esc_attr( $subscribe['sub_bg_image_position_mobile'] ) ) : $sccp_sub_bg_image_position;

?>
<div class="wrap" style="position:relative;">
    <div class="ays-sccp-heading-box">
        <div class="ays-sccp-wordpress-user-manual-box">
            <a href="https://ays-pro.com/wordpress-copy-content-protection-user-manual" target="_blank" style="text-decoration: none;font-size: 13px;">
                <i class="ays_fa ays_fa_file_text"></i>
                <span style="margin-left: 3px;text-decoration: underline;"><?php echo __("View Documentation", 'secure-copy-content-protection'); ?></span>
            </a>
        </div>
    </div>
    <div class="container-fluid">
        <form method="post" class="ays-sccp-general-settings-form" id="ays-sccp-general-settings-form">
            <input type="hidden" name="ays_sccp_tab" value="<?php echo htmlentities($ays_sccp_tab); ?>">
            <h1 class="wp-heading-inline">
				<?php
				echo __('Settings', 'secure-copy-content-protection');
				?>
            </h1>
			<?php
			if (isset($_REQUEST['status'])) {
				$actions->sccp_settings_notices($_REQUEST['status']);
			}
			?>
            <hr/>
            <div class="ays-gen-settings-wrapper">
                <div>
                    <div class="nav-tab-wrapper" style="position:sticky; top:35px;">
                        <a href="#tab1" data-tab="tab1"
                           class="nav-tab <?php echo ($ays_sccp_tab == 'tab1') ? 'nav-tab-active' : ''; ?>">                           
							<?php echo __("General", 'secure-copy-content-protection'); ?>
                        </a>  
                        <a href="#tab2" data-tab="tab2"
                           class="nav-tab <?php echo ($ays_sccp_tab == 'tab2') ? 'nav-tab-active' : ''; ?>">                                                                                                    
                            <?php echo __("Integrations", 'secure-copy-content-protection'); ?>
                        </a>
                        <a href="#tab3" data-tab="tab3" class="nav-tab <?php echo ($ays_sccp_tab == 'tab3') ? 'nav-tab-active' : ''; ?>">
                            <?php echo __("Message variables", 'secure-copy-content-protection');?>
                        </a>
                        <a href="#tab4" data-tab="tab4" class="nav-tab <?php echo ($ays_sccp_tab == 'tab4') ? 'nav-tab-active' : ''; ?>">
                            <?php echo __("Shortcodes", 'secure-copy-content-protection');?>
                        </a> 
                        <a href="#tab5" data-tab="tab5" class="nav-tab <?php echo ($ays_sccp_tab == 'tab5') ? 'nav-tab-active' : ''; ?>">
                            <?php echo __("Subscribe to view settings", 'secure-copy-content-protection');?>
                        </a>   
                        <a href="#tab6" data-tab="tab6" class="nav-tab <?php echo ($ays_sccp_tab == 'tab6') ? 'nav-tab-active' : ''; ?>">
                            <?php echo __("Block content to view settings", 'secure-copy-content-protection');?>
                        </a>                 
                    </div>
                </div>
                <div class="ays-sccp-tabs-wrapper">
                    <div id="tab1"
                         class="ays-sccp-tab-content <?php echo ($ays_sccp_tab == 'tab1') ? 'ays-sccp-tab-content-active' : ''; ?>">
                        <p class="ays-subtitle"><?php echo __('General Settings','secure-copy-content-protection')?></p>
                        <hr/>                        
                        <fieldset>
                            <legend>
                                <strong style="font-size:30px;"><i class="ays_fa ays_fa_question_circle"></i></strong>
                                <h5><?php echo __('Default parameters for copy protection','secure-copy-content-protection')?></h5>
                            </legend>
                           <div class="form-group row">
                                <div class="col-sm-4">
                                    <label for="ays_sccp_wp_editor_height">
                                        <?php echo __( "WP Editor height", 'secure-copy-content-protection' ); ?>
                                        <a class="ays_help" data-toggle="tooltip" title="<?php echo __('Give the default value to the height of the WP Editor. It will apply to all WP Editors within the plugin on the dashboard.','secure-copy-content-protection'); ?>">
                                            <i class="ays_fa ays_fa_info_circle"></i>
                                        </a>
                                    </label>
                                </div>
                                <div class="col-sm-8">
                                    <input type="number" name="ays_sccp_wp_editor_height" id="ays_sccp_wp_editor_height" class="ays-text-input" value="<?php echo $sccp_wp_editor_height; ?>">
                                </div>
                            </div>
                        </fieldset>
                        <hr>
                        <fieldset>
                            <legend>
                                <strong style="font-size:30px;"><i class="ays_fa ays_fa_user_ip"></i></strong>
                                <h5><?php echo __('Users IP adressess','secure-copy-content-protection')?></h5>
                            </legend>
                            <div class="form-group row">
                                <div class="col-sm-4">
                                    <label for="ays_sccp_disable_user_ip">
                                        <?php echo __( "Do not store IP adressess", 'secure-copy-content-protection' ); ?>
                                        <a class="ays_help" data-toggle="tooltip" title="<?php echo __('After enabling this option, IP address of the users will not be stored in database.','secure-copy-content-protection')?>">
                                            <i class="ays_fa ays_fa_info_circle"></i>
                                        </a>
                                    </label>
                                </div>
                                <div class="col-sm-8">
                                    <input type="checkbox" class="ays-checkbox-input" id="ays_sccp_disable_user_ip" name="ays_sccp_disable_user_ip" value="on" <?php echo $sccp_disable_user_ip ? 'checked' : ''; ?> />
                                </div>
                            </div>
                        </fieldset> <!-- Users IP adressess -->                        
                    </div>                    
                    <div id="tab2"
                         class="ays-sccp-tab-content <?php echo ($ays_sccp_tab == 'tab2') ? 'ays-sccp-tab-content-active' : ''; ?>">
                         <p class="ays-subtitle"><?php echo __('Integrations','secure-copy-content-protection')?></p>
                        <hr/>                            
                        <fieldset>
                            <legend>
                                <img class="ays_integration_logo" src="<?php echo SCCP_ADMIN_URL; ?>/images/integrations/mailchimp_logo.png" alt="">
                                <h5><?php echo __('Mailchimp','secure-copy-content-protection')?></h5>
                            </legend>
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <div class="form-group row" aria-describedby="aaa">
                                        <div class="col-sm-3">
                                            <label for="ays_mailchimp_username">
                                                <?php echo __('Mailchimp Username','secure-copy-content-protection')?>
                                            </label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text"
                                                   class="ays-text-input"
                                                   id="ays_mailchimp_username"
                                                   name="ays_mailchimp_username"
                                                   value="<?php echo $mailchimp_username; ?>"
                                            />
                                        </div>
                                    </div>
                                    <hr/>
                                    <div class="form-group row" aria-describedby="aaa">
                                        <div class="col-sm-3">
                                            <label for="ays_mailchimp_api_key">
                                                <?php echo __('Mailchimp API Key','secure-copy-content-protection')?>
                                            </label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text"
                                                   class="ays-text-input"
                                                   id="ays_mailchimp_api_key"
                                                   name="ays_mailchimp_api_key"
                                                   value="<?php echo $mailchimp_api_key; ?>"
                                            />
                                        </div>
                                    </div>
                                    <blockquote>
                                        <?php echo sprintf( __( "You can get your API key from your ", 'secure-copy-content-protection' ) . "<a href='%s' target='_blank'> %s.</a>", "https://us20.admin.mailchimp.com/account/api/", __( "Account Extras menu", 'secure-copy-content-protection' ) ); ?>
                                    </blockquote>
                                </div>
                            </div>
                        </fieldset>                        
                    </div>
                     <div id="tab3" class="ays-sccp-tab-content <?php echo ($ays_sccp_tab == 'tab3') ? 'ays-sccp-tab-content-active' : ''; ?>">
                        <p class="ays-subtitle">
                            <?php echo __('Message variables','secure-copy-content-protection')?>
                            <a class="ays_help" data-toggle="tooltip" data-html="true" title="<p style='margin-bottom:3px;'><?php echo __( 'You can copy these variables and paste them in the following options from the copy protection settings', 'secure-copy-content-protection' ); ?>:</p>
                                <p style='padding-left:10px;margin:0;'>- <?php echo __( 'Notification text', 'secure-copy-content-protection' ); ?></p>">
                                <i class="ays_fa ays_fa_info_circle"></i>
                            </a>
                        </p>
                        <blockquote>
                            <p><?php echo __( "You can copy these variables and paste them in the following options from the copy protection settings", 'secure-copy-content-protection' ); ?>:</p>
                            <p style="text-indent:10px;margin:0;">- <?php echo __( "Notification text", 'secure-copy-content-protection' ); ?></p>                            
                        </blockquote>
                        <hr>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <p class="vmessage">
                                    <strong>
                                        <input type="text" onClick="this.setSelectionRange(0, this.value.length)" readonly value="%%user_first_name%%" />
                                    </strong>
                                    <span> - </span>
                                    <span style="font-size:18px;">
                                        <?php echo __( "The user's first name that was filled in their WordPress site during registration.", 'secure-copy-content-protection'); ?>
                                    </span>
                                </p>
                                <p class="vmessage">
                                    <strong>
                                        <input type="text" onClick="this.setSelectionRange(0, this.value.length)" readonly value="%%user_last_name%%" />
                                    </strong>
                                    <span> - </span>
                                    <span style="font-size:18px;">
                                        <?php echo __( "The user's last name that was filled in their WordPress site during registration.", 'secure-copy-content-protection'); ?>
                                    </span>
                                </p> 
                                <p class="vmessage">
                                    <strong>
                                        <input type="text" onClick="this.setSelectionRange(0, this.value.length)" readonly value="%%user_wordpress_email%%" />
                                    </strong>
                                    <span> - </span>
                                    <span style="font-size:18px;">
                                        <?php echo __( "The user's email that was filled in their WordPress profile.", 'secure-copy-content-protection'); ?>
                                    </span>
                                </p>
                                <p class="vmessage">
                                    <strong>
                                        <input type="text" onClick="this.setSelectionRange(0, this.value.length)" readonly value="%%user_display_name%%" />
                                    </strong>
                                    <span> - </span>
                                    <span style="font-size:18px;">
                                        <?php echo __( "The user's display name that was filled in their WordPress profile.", 'secure-copy-content-protection'); ?>
                                    </span>
                                </p> 
                                <p class="vmessage">
                                    <strong>
                                        <input type="text" onClick="this.setSelectionRange(0, this.value.length)" readonly value="%%user_nickname%%" />
                                    </strong>
                                    <span> - </span>
                                    <span style="font-size:18px;">
                                        <?php echo __( "The user's nickname that was filled in their WordPress profile.", 'secure-copy-content-protection'); ?>
                                    </span>
                                </p>
                                <p class="vmessage">
                                    <strong>
                                        <input type="text" onClick="this.setSelectionRange(0, this.value.length)" readonly value="%%user_wordpress_roles%%" />
                                    </strong>
                                    <span> - </span>
                                    <span style="font-size:18px;">
                                        <?php echo __( "The user's role(s) when logged-in. In case the user is not logged-in, the field will be empty.", 'secure-copy-content-protection'); ?>
                                    </span>
                                </p>
                                <p class="vmessage">
                                    <strong>
                                        <input type="text" onClick="this.setSelectionRange(0, this.value.length)" readonly value="%%user_id%%" />
                                    </strong>
                                    <span> - </span>
                                    <span style="font-size:18px;">
                                        <?php echo esc_attr( __( "The ID of the current user.", 'secure-copy-content-protection') ); ?>
                                    </span>
                                </p>
                                <p class="vmessage">
                                    <strong>
                                        <input type="text" onClick="this.setSelectionRange(0, this.value.length)" readonly value="%%admin_email%%" />
                                    </strong>
                                    <span> - </span>
                                    <span style="font-size:18px;">
                                        <?php echo esc_attr( __( "Shows the admin's email that was filled in their WordPress profile.", 'secure-copy-content-protection') ); ?>
                                    </span>
                                </p>
                                <p class="vmessage">
                                    <strong>
                                        <input type="text" onClick="this.setSelectionRange(0, this.value.length)" readonly value="%%post_author_nickname%%" />
                                    </strong>
                                    <span> - </span>
                                    <span style="font-size:18px;">
                                        <?php echo esc_attr( __( "Shows the post author's nickname that was filled in their WordPress profile.", 'secure-copy-content-protection') ); ?>
                                    </span>
                                </p>
                                <p class="vmessage">
                                    <strong>
                                        <input type="text" onClick="this.setSelectionRange(0, this.value.length)" readonly value="%%post_author_email%%" />
                                    </strong>
                                    <span> - </span>
                                    <span style="font-size:18px;">
                                        <?php echo esc_attr( __( "The Email of the author of the post.", 'secure-copy-content-protection') ); ?>
                                    </span>
                                </p>
                                <p class="vmessage">
                                    <strong>
                                        <input type="text" onClick="this.setSelectionRange(0, this.value.length)" readonly value="%%post_author_display_name%%" />
                                    </strong>
                                    <span> - </span>
                                    <span style="font-size:18px;">
                                        <?php echo esc_attr( __( "The Display name of the author of the post.", 'secure-copy-content-protection') ); ?>
                                    </span>
                                </p>
                                <p class="vmessage">
                                    <strong>
                                        <input type="text" onClick="this.setSelectionRange(0, this.value.length)" readonly value="%%post_author_first_name%%" />
                                    </strong>
                                    <span> - </span>
                                    <span style="font-size:18px;">
                                        <?php echo esc_attr( __( "The Last name of the author of the post.", 'secure-copy-content-protection') ); ?>
                                    </span>
                                </p>
                                <p class="vmessage">
                                    <strong>
                                        <input type="text" onClick="this.setSelectionRange(0, this.value.length)" readonly value="%%post_author_last_name%%" />
                                    </strong>
                                    <span> - </span>
                                    <span style="font-size:18px;">
                                        <?php echo esc_attr( __( "The Last name of the author of the post.", 'secure-copy-content-protection') ); ?>
                                    </span>
                                </p>
                                <p class="vmessage">
                                    <strong>
                                        <input type="text" onClick="this.setSelectionRange(0, this.value.length)" readonly value="%%post_id%%" />
                                    </strong>
                                    <span> - </span>
                                    <span style="font-size:18px;">
                                        <?php echo esc_attr( __( "The ID of the current post.", 'secure-copy-content-protection') ); ?>
                                    </span>
                                </p>
                                <p class="vmessage">
                                    <strong>
                                        <input type="text" onClick="this.setSelectionRange(0, this.value.length)" readonly value="%%post_title%%" />
                                    </strong>
                                    <span> - </span>
                                    <span style="font-size:18px;">
                                        <?php echo __( "The Post title of the current post.", 'secure-copy-content-protection'); ?>
                                    </span>
                                </p>
                                <p class="vmessage">
                                    <strong>
                                        <input type="text" onClick="this.setSelectionRange(0, this.value.length)" readonly value="%%current_date%%" />
                                    </strong>
                                    <span> - </span>
                                    <span style="font-size:18px;">
                                        <?php echo esc_attr( __( "It will show the current date.", 'secure-copy-content-protection') ); ?>
                                    </span>
                                </p>
                                <p class="vmessage">
                                    <strong>
                                        <input type="text" onClick="this.setSelectionRange(0, this.value.length)" readonly value="%%current_page_title%%" />
                                    </strong>
                                    <span> - </span>
                                    <span style="font-size:18px;">
                                        <?php echo esc_attr( __( "Prints a title to the web page on which the tooltip is running.", 'secure-copy-content-protection') ); ?>
                                    </span>
                                </p>
                                <p class="vmessage">
                                    <strong>
                                        <input type="text" onClick="this.setSelectionRange(0, this.value.length)" readonly value="%%site_title%%" />
                                    </strong>
                                    <span> - </span>
                                    <span style="font-size:18px;">
                                        <?php echo esc_attr( __( "The title of the website.", 'secure-copy-content-protection') ); ?>
                                    </span>
                                </p>
                                <p class="vmessage">
                                    <strong>
                                        <input type="text" onClick="this.setSelectionRange(0, this.value.length)" readonly value="%%current_user_ip%%" />
                                    </strong>
                                    <span> - </span>
                                    <span style="font-size:18px;">
                                        <?php echo esc_attr( __( "Shows the current user's IP no matter whether they are a logged-in user or a guest. Please note, that this message variable will return empty, if 'Do not store IP addresses' is ticked from General Settings>General>Users IP addresses.", 'secure-copy-content-protection') ); ?>
                                    </span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div id="tab4" class="ays-sccp-tab-content <?php echo ($ays_sccp_tab == 'tab4') ? 'ays-sccp-tab-content-active' : ''; ?>">
                        <p class="ays-subtitle"><?php echo __('Shortcodes','secure-copy-content-protection')?></p>
                        <hr/>
                        <fieldset>
                            <legend>
                                <strong style="font-size:30px;">[ ]</strong>
                                <h5><?php echo __('Extra shortcodes','secure-copy-content-protection'); ?></h5>
                            </legend>
                            <div class="form-group row" style="padding:0px;margin:0;">
                                <div class="col-sm-12" style="padding:20px;">
                                    <div class="form-group row">
                                        <div class="col-sm-4">
                                            <label for="ays_sccp_subs_count">
                                                <?php echo __( "Subscribers count", 'secure-copy-content-protection' ); ?>
                                                <a class="ays_help" data-toggle="tooltip" title="<?php echo __('Copy the following shortcode and paste it into any posts. Insert the Block ID to receive the current number of subscribers of the block.','secure-copy-content-protection'); ?>">
                                                    <i class="ays_fa ays_fa_info_circle"></i>
                                                </a>
                                            </label>
                                        </div>
                                        <div class="col-sm-8">
                                            <input type="text" id="ays_sccp_subs_count" class="ays-text-input" onclick="this.setSelectionRange(0, this.value.length)" readonly="" value='[ays_sccp_subscribers_count id="YOUR_BLOCK_ID"]'>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="form-group row" style="padding:0px;margin:0;">
                                <div class="col-sm-12" style="padding:20px;">
                                    <div class="form-group row">
                                        <div class="col-sm-4">
                                            <label for="ays_sccp_user_first_name">
                                                <?php echo __( "Show User First Name", 'secure-copy-content-protection' ); ?>
                                                <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_attr( __("Shows the logged-in user's First Name. If the user is not logged-in, the shortcode will be empty.",'secure-copy-content-protection') ); ?>">
                                                    <i class="ays_fa ays_fa_info_circle"></i>
                                                </a>
                                            </label>
                                        </div>
                                        <div class="col-sm-8">
                                            <input type="text" id="ays_sccp_user_first_name" class="ays-text-input" onclick="this.setSelectionRange(0, this.value.length)" readonly="" value='[ays_sccp_user_first_name]'>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="form-group row" style="padding:0px;margin:0;">
                                <div class="col-sm-12" style="padding:20px;">
                                    <div class="form-group row">
                                        <div class="col-sm-4">
                                            <label for="ays_sccp_user_last_name">
                                                <?php echo __( "Show User Last Name", 'secure-copy-content-protection' ); ?>
                                                <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_attr( __("Shows the logged-in user's Last Name. If the user is not logged-in, the shortcode will be empty.",'secure-copy-content-protection') ); ?>">
                                                    <i class="ays_fa ays_fa_info_circle"></i>
                                                </a>
                                            </label>
                                        </div>
                                        <div class="col-sm-8">
                                            <input type="text" id="ays_sccp_user_last_name" class="ays-text-input" onclick="this.setSelectionRange(0, this.value.length)" readonly="" value='[ays_sccp_user_last_name]'>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="form-group row" style="padding:0px;margin:0;">
                                <div class="col-sm-12" style="padding:20px;">
                                    <div class="form-group row">
                                        <div class="col-sm-4">
                                            <label for="ays_sccp_user_email">
                                                <?php echo __( "Show User Email", 'secure-copy-content-protection' ); ?>
                                                <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_attr( __("Shows the logged-in user's Email. If the user is not logged-in, the shortcode will be empty.",'secure-copy-content-protection') ); ?>">
                                                    <i class="ays_fa ays_fa_info_circle"></i>
                                                </a>
                                            </label>
                                        </div>
                                        <div class="col-sm-8">
                                            <input type="text" id="ays_sccp_user_email" class="ays-text-input" onclick="this.setSelectionRange(0, this.value.length)" readonly="" value='[ays_sccp_user_email]'>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="form-group row" style="padding:0px;margin:0;">
                                <div class="col-sm-12" style="padding:20px;">
                                    <div class="form-group row">
                                        <div class="col-sm-4">
                                            <label for="ays_sccp_user_roles">
                                                <?php echo __( "Show User roles", 'secure-copy-content-protection' ); ?>
                                                <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_attr( __("Shows the logged-in user's role(s). If the user is not logged-in, the shortcode will be empty.",'secure-copy-content-protection') ); ?>">
                                                    <i class="ays_fa ays_fa_info_circle"></i>
                                                </a>
                                            </label>
                                        </div>
                                        <div class="col-sm-8">
                                            <input type="text" id="ays_sccp_user_roles" class="ays-text-input" onclick="this.setSelectionRange(0, this.value.length)" readonly="" value='[ays_sccp_user_roles]'>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="form-group row" style="padding:0px;margin:0;">
                                <div class="col-sm-12" style="padding:20px;">
                                    <div class="form-group row">
                                        <div class="col-sm-4">
                                            <label for="ays_sccp_user_display_name">
                                                <?php echo __( "Show User Display name", 'secure-copy-content-protection' ); ?>
                                                <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_attr( __("Shows the logged-in user's Display name. If the user is not logged-in, the shortcode will be empty.",'secure-copy-content-protection') ); ?>">
                                                    <i class="ays_fa ays_fa_info_circle"></i>
                                                </a>
                                            </label>
                                        </div>
                                        <div class="col-sm-8">
                                            <input type="text" id="ays_sccp_user_display_name" class="ays-text-input" onclick="this.setSelectionRange(0, this.value.length)" readonly="" value='[ays_sccp_user_display_name]'>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="form-group row" style="padding:0px;margin:0;">
                                <div class="col-sm-12" style="padding:20px;">
                                    <div class="form-group row">
                                        <div class="col-sm-4">
                                            <label for="ays_sccp_user_nickname">
                                                <?php echo __( "Show User Nickname", 'secure-copy-content-protection' ); ?>
                                                <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_attr( __("Shows the logged-in user's Nickname. If the user is not logged-in, the shortcode will be empty.",'secure-copy-content-protection') ); ?>">
                                                    <i class="ays_fa ays_fa_info_circle"></i>
                                                </a>
                                            </label>
                                        </div>
                                        <div class="col-sm-8">
                                            <input type="text" id="ays_sccp_user_nickname" class="ays-text-input" onclick="this.setSelectionRange(0, this.value.length)" readonly="" value='[ays_sccp_user_nickname]'>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                    <div id="tab5" class="ays-sccp-tab-content <?php echo ($ays_sccp_tab == 'tab5') ? 'ays-sccp-tab-content-active' : ''; ?>">
                        <p class="ays-subtitle"><?php echo __('Styles','secure-copy-content-protection')?></p>
                        <hr>
                        <div class="form-group row">
                            <div class="col-sm-4">
                                <label for="ays_sccp_sub_width">
                                    <?php echo __( "Subscribe box width", 'secure-copy-content-protection' ); ?>
                                    <a class="ays_help" data-toggle="tooltip" title="<?php echo __('Set the default value for the width of the subscription field in pixels or as a percentage. This will apply to all subscription boxes in the frontend plugin.','secure-copy-content-protection'); ?>">
                                        <i class="ays_fa ays_fa_info_circle"></i>
                                    </a>
                                </label>
                            </div>                            
                            <div class="col-sm-8 ays_divider_left">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <label for='ays_sccp_sub_width'>
                                            <?php echo __('On PC', 'secure-copy-content-protection'); ?>
                                            <a class="ays_help" data-toggle="tooltip" title="<?php echo __('Define the width for desktop devices. If you put 0 or leave it blank, the width will be 100%. It accepts only numerical values and you can choose whether to define the value by percentage or in pixels.','secure-copy-content-protection'); ?>">
                                                <i class="ays_fa ays_fa_info_circle"></i>
                                            </a>
                                        </label>
                                    </div>
                                    <div class="col-sm-9 ays_divider_left ays_sccp_display_flex">
                                        <div>
                                            <input type="number" class="ays-text-input ays-text-input-short" id='ays_sccp_sub_width' name='ays_sccp_sub_width' value="<?php echo $ays_sccp_sub_width; ?>"/>
                                        </div>
                                        <div class="ays_sccp_dropdown_max_width">
                                            <select id="sccp_sub_width_by_percentage_px" name="ays_sccp_sub_width_by_percentage_px" class="ays-text-input ays-text-input-short" style="display:inline-block; width: 60px;">
                                                <option value="pixels" <?php echo $sccp_sub_width_by_percentage_px == "pixels" ? "selected" : ""; ?>><?php echo __( "px", 'secure-copy-content-protection' ); ?></option>
                                                <option value="percentage" <?php echo $sccp_sub_width_by_percentage_px == "percentage" ? "selected" : ""; ?>><?php echo __( "%", 'secure-copy-content-protection' ); ?></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <label for='ays_sccp_sub_width_mobile'>
                                            <?php echo __('On Mobile', 'secure-copy-content-protection'); ?>
                                            <a class="ays_help" data-toggle="tooltip" title="<?php echo __('Define the width for mobile devices in percentage. Note: This option works for the screens with less than 768 pixels width.','secure-copy-content-protection'); ?>">
                                                <i class="ays_fa ays_fa_info_circle"></i>
                                            </a>
                                        </label>
                                    </div>
                                    <div class="col-sm-9 ays_divider_left ays_sccp_display_flex">
                                        <div>
                                            <input type="number" class="ays-text-input ays-text-input-short" id='ays_sccp_sub_width_mobile' name='ays_sccp_sub_width_mobile' value="<?php echo $ays_sccp_sub_width_mobile; ?>"/>
                                        </div>
                                        <div class="ays_sccp_dropdown_max_width">
                                            <select id="sccp_sub_width_mobile_by_percentage_px" name="ays_sccp_sub_width_mobile_by_percentage_px" class="ays-text-input ays-text-input-short" style="display:inline-block; width: 60px;">
                                                <option value="pixels" <?php echo $sccp_sub_width_mobile_by_percentage_px == "pixels" ? "selected" : ""; ?>><?php echo __( "px", 'secure-copy-content-protection' ); ?></option>
                                                <option value="percentage" <?php echo $sccp_sub_width_mobile_by_percentage_px == "percentage" ? "selected" : ""; ?>><?php echo __( "%", 'secure-copy-content-protection' ); ?></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                
                            </div>
                        </div>
                        <hr/>
                        <div class="form-group row">
                            <div class="col-sm-4">
                                <label for="sub_text_color"><?= __('Subscribe text color', 'secure-copy-content-protection'); ?></label>
                                <a class="ays_help" data-toggle="tooltip"
                                   title="<?= __('Set the default text color of the Subscribe Box. It will apply to all Subscribe Boxes within the plugin on the front-end.', 'secure-copy-content-protection') ?>">
                                    <i class="ays_fa ays_fa_info_circle"></i>
                                </a>
                            </div>
                            <div class="col-sm-8 ays_divider_left">
                                <div class="ays_toggle_mobile_parent">
                                    <div>
                                        <div class="ays_sccp_current_device_name ays_sccp_current_device_name_pc_default_on ays_sccp_current_device_name_pc show ays_toggle_target" style="<?php echo ($enable_ays_sccp_sub_text_color_mobile) ? '' : 'display: none;' ?> text-align: center; margin-bottom: 10px; max-width: 100px;"><?php echo __('PC', 'secure-copy-content-protection') ?></div>
                                        <input type="text" id="sub_text_color" name="sub_text_color" data-alpha="true" value="<?php echo $ays_sccp_sub_text_color; ?>">
                                    </div>
                                    <div class="ays_toggle_target ays_sccp_text_color_mobile_container" style=" <?php echo ( $enable_ays_sccp_sub_text_color_mobile ) ? '' : 'display:none'; ?>">
                                        <hr>
                                        <div class="ays_sccp_current_device_name show" style="text-align: center; margin-bottom: 10px; max-width: 100px;"><?php echo __('Mobile', 'secure-copy-content-protection') ?></div>
                                        <input type="text" id="sub_text_color_mobile" name="sub_text_color_mobile" data-alpha="true" value="<?php echo $ays_sccp_sub_text_color_mobile; ?>">
                                    </div>
                                    <div class="ays_sccp_mobile_settings_container">
                                        <input type="checkbox" class="ays_toggle_mobile_checkbox" id="enable_sub_text_color_mobile" name="enable_sub_text_color_mobile" <?php echo $enable_ays_sccp_sub_text_color_mobile ? 'checked' : '' ?>>
                                        <label for="enable_sub_text_color_mobile" ><?php echo __('Use a different setting for Mobile', 'secure-copy-content-protection') ?></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr/>
                        <div class="form-group row">
                            <div class="col-sm-4">
                                <label for="sub_bg_color"><?= __('Subscribe box background color', 'secure-copy-content-protection'); ?></label>
                                <a class="ays_help" data-toggle="tooltip"
                                   title="<?= __('Set the default background color of the Subscribe Box. It will apply to all Subscribe Boxes within the plugin on the front-end.', 'secure-copy-content-protection') ?>">
                                    <i class="ays_fa ays_fa_info_circle"></i>
                                </a>
                            </div>
                            <div class="col-sm-8 ays_divider_left">
                                <div class="ays_toggle_mobile_parent">
                                    <div>
                                        <div class="ays_sccp_current_device_name ays_sccp_current_device_name_pc_default_on ays_sccp_current_device_name_pc show ays_toggle_target" style="<?php echo ($enable_ays_sccp_sub_bg_color_mobile) ? '' : 'display: none;' ?> text-align: center; margin-bottom: 10px; max-width: 100px;"><?php echo __('PC', 'secure-copy-content-protection') ?></div>
                                        <input type="text" id="sub_bg_color" name="sub_bg_color" data-alpha="true" value="<?php echo $ays_sccp_sub_bg_color; ?>">
                                    </div>
                                    <div class="ays_toggle_target ays_sccp_bg_color_mobile_container" style=" <?php echo ( $enable_ays_sccp_sub_bg_color_mobile ) ? '' : 'display:none'; ?>">
                                        <hr>
                                        <div class="ays_sccp_current_device_name show" style="text-align: center; margin-bottom: 10px; max-width: 100px;"><?php echo __('Mobile', 'secure-copy-content-protection') ?></div>
                                        <input type="text" id="sub_bg_color_mobile" name="sub_bg_color_mobile" data-alpha="true" value="<?php echo $ays_sccp_sub_bg_color_mobile; ?>">
                                    </div>
                                    <div class="ays_sccp_mobile_settings_container">
                                        <input type="checkbox" class="ays_toggle_mobile_checkbox" id="enable_sub_bg_color_mobile" name="enable_sub_bg_color_mobile" <?php echo $enable_ays_sccp_sub_bg_color_mobile ? 'checked' : '' ?>>
                                        <label for="enable_sub_bg_color_mobile" ><?php echo __('Use a different setting for Mobile', 'secure-copy-content-protection') ?></label>
                                    </div>
                                </div>
                            </div>                            
                        </div>
                        <hr/>
                        <div class="form-group row copy_protection_container">
                            <div class="col-sm-4">
                                <label for="sccp_sub_bg_image">
                                    <?php echo __('Subscribe box background image','secure-copy-content-protection')?>
                                    <a class="ays_help" data-toggle="tooltip" title="<?php echo __('Add background image for Subscribe Box.','secure-copy-content-protection')?>">
                                        <i class="ays_fa ays_fa_info_circle"></i>
                                    </a>
                                </label>
                            </div>                                    
                            <div class="col-sm-8 ays_divider_left">
                                <a href="javascript:void(0)" id="sccp_sub_bg_image" style="<?php echo !isset($sccp_sub_bg_image) || empty($sccp_sub_bg_image) ? 'display:inline-block;' : 'display:none;'; ?>" class="add-sccp-sub-bg-image"><?php echo $sub_bg_image_text; ?></a>
                                <input type="hidden" id="ays_sccp_sub_bg_image" name="ays_sccp_sub_bg_image"
                                       value="<?php echo $sccp_sub_bg_image; ?>"/>
                                <div id="sccp_sub_bg-image_container" class="ays-sccp-sub-bg-image-container" style="<?php echo !isset($sccp_sub_bg_image) || empty($sccp_sub_bg_image) ? 'display:none' : 'display:block'; ?>">
                                    <span class="ays-edit-sccp-sub-bg-img">
                                        <i class="ays_fa ays_fa_pencil_square_o"></i>
                                    </span>
                                    <span class="ays-remove-sccp-sub-bg-img"></span>
                                    <img src="<?php echo $sccp_sub_bg_image; ?>" id="ays-sccp-sub-bg-img"/>
                                </div>
                            </div>
                        </div>
                        <hr/>
                        <!-- Subscribe BG Image Position Start -->
                        <div class="form-group row ays-sub-bg-pos-block <?php echo ! isset( $sccp_sub_bg_image ) || empty( $sccp_sub_bg_image ) ? '' : 'active'; ?>">
                            <div class="col-sm-4">
                                <label for="ays_sub_bg_image_position">
                                    <?php echo __( "Subscribe box background image position", 'secure-copy-content-protection' ); ?>
                                    <a class="ays_help" data-toggle="tooltip" title="<?php echo __('The position of background image for Subscribe Box','secure-copy-content-protection')?>">
                                        <i class="ays_fa ays_fa_info_circle"></i>
                                    </a>
                                </label>
                            </div>
                            <div class="sccp_position_block col-sm-8 ays_divider_left ays_toggle_mobile_parent">
                            	<div class="ays_sccp_img_position_tables_container" style="display: flex;">
	                                <div>
	                                    <div class="ays_sccp_current_device_name ays_sccp_current_device_name_pc_default_on ays_sccp_current_device_name_pc show ays_toggle_target" style="<?php echo ($enable_sccp_sub_bg_image_position_mobile) ? '' : 'display: none;' ?> text-align: center; margin-bottom: 10px; max-width: 200px;"><?php echo __('PC', 'secure-copy-content-protection') ?></div>
	                                    <table id="ays-sccp-position-table" data-flag="sccp_image_position">
	                                        <tr>
	                                            <td data-value="left top" data-id='1' title="Left Top"></td>
	                                            <td data-value="top center"data-id='2' title="Top Center"></td>
	                                            <td data-value="right top" data-id='3' title="Right Top"></td>
	                                        </tr>
	                                        <tr>
	                                            <td data-value="left center" data-id='4' title="Left Center"></td>
	                                            <td data-value="center center" data-id='5' title="Center Center"></td>
	                                            <td data-value="right center" data-id='6' title="Right Center"></td>
	                                        </tr>
	                                        <tr>
	                                            <td data-value="left bottom" data-id='7' title="Left Bottom"></td>
	                                            <td data-value="center bottom" data-id='8' title="Center Bottom"></td>
	                                            <td data-value="right bottom" data-id='9' title="Right Bottom"></td>
	                                        </tr>
	                                    </table>
	                                	<input type="hidden" name="ays_sub_bg_image_position" id="ays-sccp-position-val" value="<?php echo $sccp_sub_bg_image_position; ?>" class="ays-sccp-position-val-class">
	                                </div>
	                                <div class="ays_toggle_target ays_divider_left ays_sccp_sub_bg_image_position_mobile_container" style=" <?php echo ( $enable_sccp_sub_bg_image_position_mobile ) ? '' : 'display:none'; ?>">
	                                	<div class="ays_sccp_current_device_name show" style="text-align: center; margin-bottom: 10px; max-width: 200px;"><?php echo __('Mobile', 'secure-copy-content-protection') ?></div>
	                                    <table id="ays-sccp-position-table-mobile" data-flag="sccp_image_position_mobile">
	                                        <tr>
	                                            <td data-value="left top" data-id='1'></td>
	                                            <td data-value="top center"data-id='2'></td>
	                                            <td data-value="right top" data-id='3'></td>
	                                        </tr>
	                                        <tr>
	                                            <td data-value="left center" data-id='4'></td>
	                                            <td data-value="center center" data-id='5'></td>
	                                            <td data-value="right center" data-id='6'></td>
	                                        </tr>
	                                        <tr>
	                                            <td data-value="left bottom" data-id='7'></td>
	                                            <td data-value="center bottom" data-id='8'></td>
	                                            <td data-value="right bottom" data-id='9'></td>
	                                        </tr>
	                                    </table>
	                                    <input type="hidden" name="ays_sub_bg_image_position_mobile" id="ays-sccp-position-mobile-val" value="<?php echo $sccp_sub_bg_image_position_mobile; ?>" class="ays-sccp-position-mobile-val-class">
	                                </div>
                                </div>
                                <div class="ays_sccp_mobile_settings_container">
                                    <input type="checkbox" class="ays_toggle_mobile_checkbox" id="enable_ays_sub_bg_image_position_mobile" name="enable_ays_sub_bg_image_position_mobile" <?php echo $enable_sccp_sub_bg_image_position_mobile ? 'checked' : '' ?>>
                                    <label for="enable_ays_sub_bg_image_position_mobile" ><?php echo __('Use a different setting for Mobile', 'secure-copy-content-protection') ?></label>
                                </div>
                            </div>
                        </div>
                        <!-- Subscribe BG Image Position End -->
                        <hr/>
                        <div class="form-group row">
                            <div class="col-sm-4">
                                <label for="sub_desc_text_color"><?= __('Subscribe description text color', 'secure-copy-content-protection'); ?></label>
                                <a class="ays_help" data-toggle="tooltip"
                                   title="<?= __('Set the default description text color of the Subscribe Box. It will apply to all Subscribe Boxes within the plugin on the front-end.', 'secure-copy-content-protection') ?>">
                                    <i class="ays_fa ays_fa_info_circle"></i>
                                </a>
                            </div>
                            <div class="col-sm-8 ays_divider_left">
                                <div class="ays_toggle_mobile_parent">
                                    <div>
                                        <div class="ays_sccp_current_device_name ays_sccp_current_device_name_pc_default_on ays_sccp_current_device_name_pc show ays_toggle_target" style="<?php echo ($enable_ays_sccp_sub_desc_text_color_mobile) ? '' : 'display: none;' ?> text-align: center; margin-bottom: 10px; max-width: 100px;"><?php echo __('PC', 'secure-copy-content-protection') ?></div>
                                        <input type="text" id="sub_desc_text_color" name="sub_desc_text_color" data-alpha="true" value="<?php echo $ays_sccp_sub_desc_text_color; ?>">
                                    </div>
                                    <div class="ays_toggle_target ays_sccp_sub_desc_text_color_mobile_container" style=" <?php echo ( $enable_ays_sccp_sub_desc_text_color_mobile ) ? '' : 'display:none'; ?>">
                                        <hr>
                                        <div class="ays_sccp_current_device_name show" style="text-align: center; margin-bottom: 10px; max-width: 100px;"><?php echo __('Mobile', 'secure-copy-content-protection') ?></div>
                                        <input type="text" id="sub_desc_text_color_mobile" name="sub_desc_text_color_mobile" data-alpha="true" value="<?php echo $ays_sccp_sub_desc_text_color_mobile; ?>">
                                    </div>
                                    <div class="ays_sccp_mobile_settings_container">
                                        <input type="checkbox" class="ays_toggle_mobile_checkbox" id="enable_sub_desc_text_color_mobile" name="enable_sub_desc_text_color_mobile" <?php echo $enable_ays_sccp_sub_desc_text_color_mobile ? 'checked' : '' ?>>
                                        <label for="enable_sub_desc_text_color_mobile" ><?php echo __('Use a different setting for Mobile', 'secure-copy-content-protection') ?></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr/>
                        <div class="form-group row">
                            <div class="col-sm-4">
                                <label for="ays_sub_title_transformation">
                                    <?php echo __('Subscribe title transformation', 'secure-copy-content-protection' ); ?>
                                    <a class="ays_help" data-toggle="tooltip" data-html="true" data-placement="top" title="<?php
                                        echo __("Specify how to capitalize a title text of your Subscribe box.", 'secure-copy-content-protection') .
                                            "<ul style='list-style-type: circle;padding-left: 20px;'>".
                                                "<li>". __('Uppercase – Transforms all characters to uppercase','secure-copy-content-protection') ."</li>".
                                                "<li>". __('Lowercase – Transforms all characters to lowercase','secure-copy-content-protection') ."</li>".
                                                "<li>". __('Capitalize – Transforms the first character of each word to uppercase','secure-copy-content-protection') ."</li>".
                                            "</ul>";
                                        ?>">
                                        <i class="ays_fa ays_fa_info_circle"></i>
                                    </a>
                                </label>
                            </div>
                            <div class="col-sm-8 ays_divider_left">
                                <div class="ays_toggle_mobile_parent">
                                    <div>
                                        <div class="ays_sccp_current_device_name ays_sccp_current_device_name_pc_default_on ays_sccp_current_device_name_pc show ays_toggle_target" style="<?php echo ($enable_sub_title_transformation_mobile) ? '' : 'display: none;' ?> text-align: center; margin-bottom: 10px; max-width: 100px;"><?php echo __('PC', 'secure-copy-content-protection') ?></div>
                                        <div>
                                        	<select name="ays_sub_title_transformation" id="ays_sub_title_transformation" class="ays-text-input ays-text-input-short" style="display:block;">
			                                    <option value="uppercase" <?php echo $sub_title_transformation == 'uppercase' ? 'selected' : ''; ?>><?php echo __( "Uppercase", 'secure-copy-content-protection' ); ?></option>
			                                    <option value="lowercase" <?php echo $sub_title_transformation == 'lowercase' ? 'selected' : ''; ?>><?php echo __( "Lowercase", 'secure-copy-content-protection' ); ?></option>
			                                    <option value="capitalize" <?php echo $sub_title_transformation == 'capitalize' ? 'selected' : ''; ?>><?php echo __( "Capitalize", 'secure-copy-content-protection' ); ?></option>
			                                    <option value="none" <?php echo $sub_title_transformation == 'none' ? 'selected' : ''; ?>><?php echo __( "None", 'secure-copy-content-protection' ); ?></option>
			                                </select>
                                        </div>                                        
                                    </div>
                                    <div class="ays_toggle_target ays_sccp_sub_desc_text_color_mobile_container" style=" <?php echo ( $enable_sub_title_transformation_mobile ) ? '' : 'display:none'; ?>">
                                        <hr>
                                        <div class="ays_sccp_current_device_name show" style="text-align: center; margin-bottom: 10px; max-width: 100px;"><?php echo __('Mobile', 'secure-copy-content-protection') ?></div>
                                        <div>
                                        	<select name="ays_sub_title_transformation_mobile" id="ays_sub_title_transformation_mobile" class="ays-text-input ays-text-input-short" style="display:block;">
			                                    <option value="uppercase" <?php echo $sub_title_transformation_mobile == 'uppercase' ? 'selected' : ''; ?>><?php echo __( "Uppercase", 'secure-copy-content-protection' ); ?></option>
			                                    <option value="lowercase" <?php echo $sub_title_transformation_mobile == 'lowercase' ? 'selected' : ''; ?>><?php echo __( "Lowercase", 'secure-copy-content-protection' ); ?></option>
			                                    <option value="capitalize" <?php echo $sub_title_transformation_mobile == 'capitalize' ? 'selected' : ''; ?>><?php echo __( "Capitalize", 'secure-copy-content-protection' ); ?></option>
			                                    <option value="none" <?php echo $sub_title_transformation_mobile == 'none' ? 'selected' : ''; ?>><?php echo __( "None", 'secure-copy-content-protection' ); ?></option>
			                                </select>
                                        </div>    
                                    </div>
                                    <div class="ays_sccp_mobile_settings_container">
                                        <input type="checkbox" class="ays_toggle_mobile_checkbox" id="enable_ays_sub_title_transformation_mobile" name="enable_ays_sub_title_transformation_mobile" <?php echo $enable_sub_title_transformation_mobile ? 'checked' : '' ?>>
                                        <label for="enable_ays_sub_title_transformation_mobile" ><?php echo __('Use a different setting for Mobile', 'secure-copy-content-protection') ?></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr/>
                        <div class="form-group row">
                            <div class="col-sm-4">
                                <label for='ays_sccp_sub_cont_border_style'>
                                    <?php echo __('Subscribe container border style', 'secure-copy-content-protection'); ?>
                                    <a class="ays_help" data-toggle="tooltip" title="<?php echo __('Specify container border style.','secure-copy-content-protection')?>">
                                        <i class="ays_fa ays_fa_info_circle"></i>
                                    </a>
                                </label>
                            </div>
                            <div class="col-sm-8 ays_divider_left">
                                <div class="ays_toggle_mobile_parent">
                                    <div>
                                        <div class="ays_sccp_current_device_name ays_sccp_current_device_name_pc_default_on ays_sccp_current_device_name_pc show ays_toggle_target" style="<?php echo ($enable_ays_sccp_sub_cont_border_style_mobile) ? '' : 'display: none;' ?> text-align: center; margin-bottom: 10px; max-width: 100px;"><?php echo __('PC', 'secure-copy-content-protection') ?></div>
                                        <div>
                                        	<select id="ays_sccp_sub_cont_border_style" name="ays_sccp_sub_cont_border_style" class="ays-text-input ays-text-input-short">
			                                    <option <?php echo ($ays_sccp_sub_cont_border_style == 'solid') ? 'selected' : ''; ?> value="solid">Solid</option>
			                                    <option <?php echo ($ays_sccp_sub_cont_border_style == 'dashed') ? 'selected' : ''; ?> value="dashed">Dashed</option>
			                                    <option <?php echo ($ays_sccp_sub_cont_border_style == 'dotted') ? 'selected' : ''; ?> value="dotted">Dotted</option>
			                                    <option <?php echo ($ays_sccp_sub_cont_border_style == 'double') ? 'selected' : ''; ?> value="double">Double</option>
			                                    <option <?php echo ($ays_sccp_sub_cont_border_style == 'groove') ? 'selected' : ''; ?> value="groove">Groove</option>
			                                    <option <?php echo ($ays_sccp_sub_cont_border_style == 'ridge') ? 'selected' : ''; ?> value="ridge">Ridge</option>
			                                    <option <?php echo ($ays_sccp_sub_cont_border_style == 'inset') ? 'selected' : ''; ?> value="inset">Inset</option>
			                                    <option <?php echo ($ays_sccp_sub_cont_border_style == 'outset') ? 'selected' : ''; ?> value="outset">Outset</option>
			                                    <option <?php echo ($ays_sccp_sub_cont_border_style == 'none') ? 'selected' : ''; ?> value="none">None</option>
			                                </select>
                                        </div>                                        
                                    </div>
                                    <div class="ays_toggle_target ays_sccp_sub_cont_border_style_mobile_container" style=" <?php echo ( $enable_ays_sccp_sub_cont_border_style_mobile ) ? '' : 'display:none'; ?>">
                                        <hr>
                                        <div class="ays_sccp_current_device_name show" style="text-align: center; margin-bottom: 10px; max-width: 100px;"><?php echo __('Mobile', 'secure-copy-content-protection') ?></div>
                                        <div>
                                        	<select id="ays_sccp_sub_cont_border_style_mobile" name="ays_sccp_sub_cont_border_style_mobile" class="ays-text-input ays-text-input-short">
			                                    <option <?php echo ($ays_sccp_sub_cont_border_style_mobile == 'solid') ? 'selected' : ''; ?> value="solid">Solid</option>
			                                    <option <?php echo ($ays_sccp_sub_cont_border_style_mobile == 'dashed') ? 'selected' : ''; ?> value="dashed">Dashed</option>
			                                    <option <?php echo ($ays_sccp_sub_cont_border_style_mobile == 'dotted') ? 'selected' : ''; ?> value="dotted">Dotted</option>
			                                    <option <?php echo ($ays_sccp_sub_cont_border_style_mobile == 'double') ? 'selected' : ''; ?> value="double">Double</option>
			                                    <option <?php echo ($ays_sccp_sub_cont_border_style_mobile == 'groove') ? 'selected' : ''; ?> value="groove">Groove</option>
			                                    <option <?php echo ($ays_sccp_sub_cont_border_style_mobile == 'ridge') ? 'selected' : ''; ?> value="ridge">Ridge</option>
			                                    <option <?php echo ($ays_sccp_sub_cont_border_style_mobile == 'inset') ? 'selected' : ''; ?> value="inset">Inset</option>
			                                    <option <?php echo ($ays_sccp_sub_cont_border_style_mobile == 'outset') ? 'selected' : ''; ?> value="outset">Outset</option>
			                                    <option <?php echo ($ays_sccp_sub_cont_border_style_mobile == 'none') ? 'selected' : ''; ?> value="none">None</option>
			                                </select>
                                        </div>    
                                    </div>
                                    <div class="ays_sccp_mobile_settings_container">
                                        <input type="checkbox" class="ays_toggle_mobile_checkbox" id="enable_ays_sccp_sub_cont_border_style_mobile" name="enable_ays_sccp_sub_cont_border_style_mobile" <?php echo $enable_ays_sccp_sub_cont_border_style_mobile ? 'checked' : '' ?>>
                                        <label for="enable_ays_sccp_sub_cont_border_style_mobile" ><?php echo __('Use a different setting for Mobile', 'secure-copy-content-protection') ?></label>
                                    </div>
                                </div>
                            </div>                            
                        </div>
                        <hr/>
                        <div class="form-group row">
                            <div class="col-sm-4">
                                <label for='ays_sccp_sub_cont_border_color'>
                                    <?php echo __('Subscribe container border color', 'secure-copy-content-protection'); ?>
                                    <a class="ays_help" data-toggle="tooltip" title="<?php echo __('Specify container border color.','secure-copy-content-protection')?>">
                                        <i class="ays_fa ays_fa_info_circle"></i>
                                    </a>
                                </label>
                            </div>
                            <div class="col-sm-8 ays_divider_left">
                                <div class="ays_toggle_mobile_parent">
                                    <div>
                                        <div class="ays_sccp_current_device_name ays_sccp_current_device_name_pc_default_on ays_sccp_current_device_name_pc show ays_toggle_target" style="<?php echo ($enable_ays_sccp_sub_cont_border_color_mobile) ? '' : 'display: none;' ?> text-align: center; margin-bottom: 10px; max-width: 100px;"><?php echo __('PC', 'secure-copy-content-protection') ?></div>
                                        <input type="text" class="ays-text-input" id='ays_sccp_sub_cont_border_color' data-alpha="true" name='ays_sccp_sub_cont_border_color' value="<?php echo $ays_sccp_sub_cont_border_color; ?>"/>
                                    </div>
                                    <div class="ays_toggle_target ays_sccp_sub_cont_border_color_mobile_container" style=" <?php echo ( $enable_ays_sccp_sub_cont_border_color_mobile ) ? '' : 'display:none'; ?>">
                                        <hr>
                                        <div class="ays_sccp_current_device_name show" style="text-align: center; margin-bottom: 10px; max-width: 100px;"><?php echo __('Mobile', 'secure-copy-content-protection') ?></div>
                                        <input type="text" class="ays-text-input" id='ays_sccp_sub_cont_border_color_mobile' data-alpha="true" name='ays_sccp_sub_cont_border_color_mobile' value="<?php echo $ays_sccp_sub_cont_border_color_mobile; ?>"/>
                                    </div>
                                    <div class="ays_sccp_mobile_settings_container">
                                        <input type="checkbox" class="ays_toggle_mobile_checkbox" id="enable_ays_sccp_sub_cont_border_color_mobile" name="enable_ays_sccp_sub_cont_border_color_mobile" <?php echo $enable_ays_sccp_sub_cont_border_color_mobile ? 'checked' : '' ?>>
                                        <label for="enable_ays_sccp_sub_cont_border_color_mobile" ><?php echo __('Use a different setting for Mobile', 'secure-copy-content-protection') ?></label>
                                    </div>
                                </div>
                            </div>                            
                        </div>
                        <hr/>
                        <div class="form-group row">
                            <div class="col-sm-4">
                                <label for='ays_sccp_sub_cont_border_width'>
                                    <?php echo __('Subscribe container border width', 'secure-copy-content-protection'); ?>
                                    <a class="ays_help" data-toggle="tooltip" title="<?php echo __('Subscribe container border width in pixels. It accepts only numeric values.','secure-copy-content-protection')?>">
                                        <i class="ays_fa ays_fa_info_circle"></i>
                                    </a>
                                </label>
                            </div>
                            <div class="col-sm-8 ays_divider_left">
                                <div class="ays_toggle_mobile_parent">
                                    <div>
                                        <div class="ays_sccp_current_device_name ays_sccp_current_device_name_pc_default_on ays_sccp_current_device_name_pc show ays_toggle_target" style="<?php echo ($enable_ays_sccp_sub_cont_border_width_mobile) ? '' : 'display: none;' ?> text-align: center; margin-bottom: 10px; max-width: 100px;"><?php echo __('PC', 'secure-copy-content-protection') ?></div>
                                        <div class="ays_sccp_display_flex">
			                                <div>
			                                   <input type="number" class="ays-text-input ays-text-input-short" id='ays_sccp_sub_cont_border_width' data-alpha="true" name='ays_sccp_sub_cont_border_width' value="<?php echo $ays_sccp_sub_cont_border_width; ?>"/>
			                                </div>
			                                <div class="ays_sccp_dropdown_max_width">
			                                    <input type="text" value="px" class="ays-sccp-form-hint-for-size" disabled="">
			                                </div>
			                            </div>
                                    </div>
                                    <div class="ays_toggle_target ays_sccp_sub_cont_border_width_mobile_container" style=" <?php echo ( $enable_ays_sccp_sub_cont_border_width_mobile ) ? '' : 'display:none'; ?>">
                                        <hr>
                                        <div class="ays_sccp_current_device_name show" style="text-align: center; margin-bottom: 10px; max-width: 100px;"><?php echo __('Mobile', 'secure-copy-content-protection') ?></div>
                                        <div class="ays_sccp_display_flex">
			                                <div>
			                                   <input type="number" class="ays-text-input ays-text-input-short" id='ays_sccp_sub_cont_border_width_mobile' data-alpha="true" name='ays_sccp_sub_cont_border_width_mobile' value="<?php echo $ays_sccp_sub_cont_border_width_mobile; ?>"/>
			                                </div>
			                                <div class="ays_sccp_dropdown_max_width">
			                                    <input type="text" value="px" class="ays-sccp-form-hint-for-size" disabled="">
			                                </div>
			                            </div>
                                    </div>
                                    <div class="ays_sccp_mobile_settings_container">
                                        <input type="checkbox" class="ays_toggle_mobile_checkbox" id="enable_ays_sccp_sub_cont_border_width_mobile" name="enable_ays_sccp_sub_cont_border_width_mobile" <?php echo $enable_ays_sccp_sub_cont_border_width_mobile ? 'checked' : '' ?>>
                                        <label for="enable_ays_sccp_sub_cont_border_width_mobile" ><?php echo __('Use a different setting for Mobile', 'secure-copy-content-protection') ?></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr/>
                        <div class="form-group row">
                            <div class="col-sm-4">
                                <label for='ays_sccp_sub_input_width'>
                                    <?php echo __('Subscribe container input width', 'secure-copy-content-protection'); ?>
                                    <a class="ays_help" data-toggle="tooltip" title="<?php echo __('Subscribe container input width in pixels. It accepts only numeric values.','secure-copy-content-protection')?>">
                                        <i class="ays_fa ays_fa_info_circle"></i>
                                    </a>
                                </label>
                            </div>
                            <div class="col-sm-8 ays_divider_left">
                                <div class="ays_toggle_mobile_parent">
                                    <div>
                                        <div class="ays_sccp_current_device_name ays_sccp_current_device_name_pc_default_on ays_sccp_current_device_name_pc show ays_toggle_target" style="<?php echo ($enable_ays_sccp_sub_input_width_mobile) ? '' : 'display: none;' ?> text-align: center; margin-bottom: 10px; max-width: 100px;"><?php echo __('PC', 'secure-copy-content-protection') ?></div>
                                        <div class="ays_sccp_display_flex">
			                                <div>			                                   
			                                   <input type="number" class="ays-text-input ays-text-input-short" id='ays_sccp_sub_input_width' data-alpha="true" name='ays_sccp_sub_input_width' value="<?php echo $ays_sccp_sub_input_width; ?>"/>
			                                </div>
			                                <div class="ays_sccp_dropdown_max_width">
			                                    <input type="text" value="px" class="ays-sccp-form-hint-for-size" disabled="">
			                                </div>
			                            </div>
                                    </div>
                                    <div class="ays_toggle_target ays_sccp_sub_input_width_mobile_container" style=" <?php echo ( $enable_ays_sccp_sub_input_width_mobile ) ? '' : 'display:none'; ?>">
                                        <hr>
                                        <div class="ays_sccp_current_device_name show" style="text-align: center; margin-bottom: 10px; max-width: 100px;"><?php echo __('Mobile', 'secure-copy-content-protection') ?></div>
                                        <div class="ays_sccp_display_flex">
			                                <div>
			                                   <input type="number" class="ays-text-input ays-text-input-short" id='ays_sccp_sub_input_width_mobile' data-alpha="true" name='ays_sccp_sub_input_width_mobile' value="<?php echo $ays_sccp_sub_input_width_mobile; ?>"/>
			                                </div>
			                                <div class="ays_sccp_dropdown_max_width">
			                                    <input type="text" value="px" class="ays-sccp-form-hint-for-size" disabled="">
			                                </div>
			                            </div>
                                    </div>
                                    <div class="ays_sccp_mobile_settings_container">
                                        <input type="checkbox" class="ays_toggle_mobile_checkbox" id="enable_ays_sccp_sub_input_width_mobile" name="enable_ays_sccp_sub_input_width_mobile" <?php echo $enable_ays_sccp_sub_input_width_mobile ? 'checked' : '' ?>>
                                        <label for="enable_ays_sccp_sub_input_width_mobile" ><?php echo __('Use a different setting for Mobile', 'secure-copy-content-protection') ?></label>
                                    </div>
                                </div>
                            </div>                                                       
                        </div>
                        <hr/>
                        <div class="form-group row">
                            <div class="col-sm-4">
                                <label for="ays_sccp_sub_button_text">
                                    <?php echo __( "Subscribe button text", 'secure-copy-content-protection' ); ?>
                                    <a class="ays_help" data-toggle="tooltip" title="<?php echo __('Set the default value to the button text of the Subscribe Box. It will apply to all Subscribe Boxes within the plugin on the front-end.','secure-copy-content-protection'); ?>">
                                        <i class="ays_fa ays_fa_info_circle"></i>
                                    </a>
                                </label>
                            </div>
                            <div class="col-sm-8 ays_divider_left">
                            	<div class="ays_toggle_mobile_parent">
                                    <div>
                                        <div class="ays_sccp_current_device_name ays_sccp_current_device_name_pc_default_on ays_sccp_current_device_name_pc show ays_toggle_target" style="<?php echo ($enable_ays_sccp_sub_button_text_mobile) ? '' : 'display: none;' ?> text-align: center; margin-bottom: 10px; max-width: 100px;"><?php echo __('PC', 'secure-copy-content-protection') ?></div>
                                        <input type="text" name="ays_sccp_sub_button_text" id="ays_sccp_sub_button_text" class="ays-text-input" value="<?php echo $ays_sccp_sub_button_text; ?>">
                                    </div>
                                    <div class="ays_toggle_target ays_sccp_sub_button_text_mobile_container" style=" <?php echo ( $enable_ays_sccp_sub_button_text_mobile ) ? '' : 'display:none'; ?>">
                                        <hr>
                                        <div class="ays_sccp_current_device_name show" style="text-align: center; margin-bottom: 10px; max-width: 100px;"><?php echo __('Mobile', 'secure-copy-content-protection') ?></div>
                                        <input type="text" name="ays_sccp_sub_button_text_mobile" id="ays_sccp_sub_button_text_mobile" class="ays-text-input" value="<?php echo $ays_sccp_sub_button_text_mobile; ?>">
                                    </div>
                                    <div class="ays_sccp_mobile_settings_container">
                                        <input type="checkbox" class="ays_toggle_mobile_checkbox" id="enable_ays_sccp_sub_button_text_mobile" name="enable_ays_sccp_sub_button_text_mobile" <?php echo $enable_ays_sccp_sub_button_text_mobile ? 'checked' : '' ?>>
                                        <label for="enable_ays_sccp_sub_button_text_mobile" ><?php echo __('Use a different setting for Mobile', 'secure-copy-content-protection') ?></label>
                                    </div>
                                </div>                                
                            </div>
                        </div>                        
                        <hr/>
                        <div class="form-group row copy_protection_container">
                            <div class="col-sm-4">
                                <label for="sccp_sub_icon_image">
                                    <?php echo __('Subscribe Icon','secure-copy-content-protection')?>
                                    <a class="ays_help" data-toggle="tooltip" title="<?php echo __('Add icon image for Subscribe Box. Advisable size for image is 50x50.','secure-copy-content-protection')?>">
                                        <i class="ays_fa ays_fa_info_circle"></i>
                                    </a>
                                </label>
                            </div>                                    
                            <div class="col-sm-8 ays_divider_left">
                                <a href="javascript:void(0)" id="sccp_sub_icon_image" style="<?php echo !isset($sccp_sub_icon_image) || empty($sccp_sub_icon_image) ? 'display:inline-block;' : 'display:none;'; ?>" class="add-sccp-sub-icon-image"><?php echo $sub_icon_image_text; ?></a>
                                <input type="hidden" id="ays_sccp_sub_icon_image" name="ays_sccp_sub_icon_image"
                                       value="<?php echo $sccp_sub_icon_image; ?>"/>
                                <div id="sccp_sub_image_container" class="ays-sccp-sub-image-container" style="<?php echo !isset($sccp_sub_icon_image) || empty($sccp_sub_icon_image) ? 'display:none' : 'display:block'; ?>">
                                    <span class="ays-edit-sccp-sub-img">
                                        <i class="ays_fa ays_fa_pencil_square_o"></i>
                                    </span>
                                    <span class="ays-remove-sccp-sub-img"></span>
                                    <img src="<?php echo $sccp_sub_icon_image; ?>" id="ays-sccp-sub-img"/>
                                </div>
                            </div>
                        </div>
                        <hr/>
                        <div class="form-group row">
                            <div class="col-sm-4">
                                <label for="ays_sccp_sub_email_place_text">
                                    <?php echo __( "Subscribe email placeholder text", 'secure-copy-content-protection' ); ?>
                                    <a class="ays_help" data-toggle="tooltip" title="<?php echo __('Set the default value to the email placeholder text of the Subscribe Box. It will apply to all Subscribe Boxes within the plugin on the front-end.','secure-copy-content-protection'); ?>">
                                        <i class="ays_fa ays_fa_info_circle"></i>
                                    </a>
                                </label>
                            </div>
                            <div class="col-sm-8 ays_divider_left">
                                <input type="text" name="ays_sccp_sub_email_place_text" id="ays_sccp_sub_email_place_text" class="ays-text-input" value="<?php echo $sccp_sub_email_place_text; ?>">
                            </div>
                        </div>  
                        <hr>
                        <div class="form-group row">
                            <div class="col-sm-4">
                                <label for="ays_sccp_sub_name_place_text">
                                    <?php echo __( "Subscribe name placeholder text", 'secure-copy-content-protection' ); ?>
                                    <a class="ays_help" data-toggle="tooltip" title="<?php echo __('Set the default value to the name placeholder text of the Subscribe Box. It will apply to all Subscribe Boxes within the plugin on the front-end.','secure-copy-content-protection'); ?>">
                                        <i class="ays_fa ays_fa_info_circle"></i>
                                    </a>
                                </label>
                            </div>
                            <div class="col-sm-8 ays_divider_left">
                                <input type="text" name="ays_sccp_sub_name_place_text" id="ays_sccp_sub_name_place_text" class="ays-text-input" value="<?php echo $sccp_sub_name_place_text; ?>">
                            </div>
                        </div>
                        <hr>
                        <div class="form-group row">
                            <div class="col-sm-4">
                                <label for="ays_sccp_sub_title_size">
                                    <?php echo __( "Subscribe title Font size", 'secure-copy-content-protection' ); ?>
                                    <a class="ays_help" data-toggle="tooltip" title="<?php echo __('Set the default value to the Font size of the Subscribe Box title in pixels. It will apply to all Subscribe Boxes within the plugin on the front-end.','secure-copy-content-protection'); ?>">
                                        <i class="ays_fa ays_fa_info_circle"></i>
                                    </a>
                                </label>
                            </div>
                            <div class="col-sm-8 ays_divider_left">
                                <div class="ays_toggle_mobile_parent">
                                    <div>
                                        <div class="ays_sccp_current_device_name ays_sccp_current_device_name_pc_default_on ays_sccp_current_device_name_pc show ays_toggle_target" style="<?php echo ( $enable_sccp_sub_title_size_mobile ) ? '' : 'display: none;' ?> text-align: center; margin-bottom: 10px; max-width: 100px;"><?php echo __('PC', 'secure-copy-content-protection') ?></div>
                                        <div class="ays_sccp_display_flex">
			                                <div>			                                   
			                                   <input type="number" name="ays_sccp_sub_title_size" id="ays_sccp_sub_title_size" class="ays-text-input ays-text-input-short" value="<?php echo $sccp_sub_title_size; ?>">
			                                </div>
			                                <div class="ays_sccp_dropdown_max_width">
			                                    <input type="text" value="px" class="ays-sccp-form-hint-for-size" disabled="">
			                                </div>
			                            </div>
                                    </div>
                                    <div class="ays_toggle_target ays_sccp_sub_input_width_mobile_container" style=" <?php echo ( $enable_sccp_sub_title_size_mobile ) ? '' : 'display:none'; ?>">
                                        <hr>
                                        <div class="ays_sccp_current_device_name show" style="text-align: center; margin-bottom: 10px; max-width: 100px;"><?php echo __('Mobile', 'secure-copy-content-protection') ?></div>
                                        <div class="ays_sccp_display_flex">
			                                <div>
			                                   <input type="number" name="ays_sccp_sub_title_size_mobile" id="ays_sccp_sub_title_size_mobile" class="ays-text-input ays-text-input-short" value="<?php echo $sccp_sub_title_size_mobile; ?>">
			                                </div>
			                                <div class="ays_sccp_dropdown_max_width">
			                                    <input type="text" value="px" class="ays-sccp-form-hint-for-size" disabled="">
			                                </div>
			                            </div>
                                    </div>
                                    <div class="ays_sccp_mobile_settings_container">
                                        <input type="checkbox" class="ays_toggle_mobile_checkbox" id="enable_ays_sccp_sub_title_size_mobile" name="enable_ays_sccp_sub_title_size_mobile" <?php echo $enable_sccp_sub_title_size_mobile ? 'checked' : '' ?>>
                                        <label for="enable_ays_sccp_sub_title_size_mobile" ><?php echo __('Use a different setting for Mobile', 'secure-copy-content-protection') ?></label>
                                    </div>
                                </div>
                            </div>                            
                        </div>
                        <hr>
                        <div class="form-group row">
                            <div class="col-sm-4">
                                <label for="ays_sccp_sub_desc_size">
                                    <?php echo __( "Subscribe description Font size", 'secure-copy-content-protection' ); ?>
                                    <a class="ays_help" data-toggle="tooltip" title="<?php echo __('Set the default value to the Font size of the Subscribe Box description in pixels. It will apply to all Subscribe Boxes within the plugin on the front-end.','secure-copy-content-protection'); ?>">
                                        <i class="ays_fa ays_fa_info_circle"></i>
                                    </a>
                                </label>
                            </div>
                            <div class="col-sm-8 ays_divider_left ays_sccp_display_flex">
                            	<div class="ays_toggle_mobile_parent">
                                    <div>
                                        <div class="ays_sccp_current_device_name ays_sccp_current_device_name_pc_default_on ays_sccp_current_device_name_pc show ays_toggle_target" style="<?php echo ( $enable_sccp_sub_desc_size_mobile ) ? '' : 'display: none;' ?> text-align: center; margin-bottom: 10px; max-width: 100px;"><?php echo __('PC', 'secure-copy-content-protection') ?></div>
                                        <div class="ays_sccp_display_flex">
			                                <div>
			                                <input type="number" name="ays_sccp_sub_desc_size" id="ays_sccp_sub_desc_size" class="ays-text-input ays-text-input-short" value="<?php echo $sccp_sub_desc_size; ?>">
			                                </div>
			                                <div class="ays_sccp_dropdown_max_width">
			                                    <input type="text" value="px" class="ays-sccp-form-hint-for-size" disabled="">
			                                </div>
			                            </div>
                                    </div>
                                    <div class="ays_toggle_target ays_sccp_sub_input_width_mobile_container" style=" <?php echo ( $enable_sccp_sub_desc_size_mobile ) ? '' : 'display:none'; ?>">
                                        <hr>
                                        <div class="ays_sccp_current_device_name show" style="text-align: center; margin-bottom: 10px; max-width: 100px;"><?php echo __('Mobile', 'secure-copy-content-protection') ?></div>
                                        <div class="ays_sccp_display_flex">
			                                <div>
			                                   <input type="number" name="ays_sccp_sub_desc_size_mobile" id="ays_sccp_sub_desc_size_mobile" class="ays-text-input ays-text-input-short" value="<?php echo $sccp_sub_desc_size_mobile; ?>">
			                                </div>
			                                <div class="ays_sccp_dropdown_max_width">
			                                    <input type="text" value="px" class="ays-sccp-form-hint-for-size" disabled="">
			                                </div>
			                            </div>
                                    </div>
                                    <div class="ays_sccp_mobile_settings_container">
                                        <input type="checkbox" class="ays_toggle_mobile_checkbox" id="enable_ays_sccp_sub_desc_size_mobile" name="enable_ays_sccp_sub_desc_size_mobile" <?php echo $enable_sccp_sub_desc_size_mobile ? 'checked' : '' ?>>
                                        <label for="enable_ays_sccp_sub_desc_size_mobile" ><?php echo __('Use a different setting for Mobile', 'secure-copy-content-protection') ?></label>
                                    </div>
                                </div>                                
                            </div>                            
                        </div>
                        <hr>
                        <div class="form-group row">
                            <div class="col-sm-4">
                                <label for="ays_sccp_sub_text_alignment">
                                    <?php echo __( "Subscribe box text alignment", 'secure-copy-content-protection' ); ?>
                                    <a class="ays_help" data-toggle="tooltip" title="<?php echo __('Align the text of Subscribe box to the left, center, or right.','secure-copy-content-protection'); ?>">
                                        <i class="ays_fa ays_fa_info_circle"></i>
                                    </a>
                                </label>
                            </div>
                            <div class="col-sm-8 ays_divider_left">

                            	<div class="ays_toggle_mobile_parent">
                                    <div>
                                        <div class="ays_sccp_current_device_name ays_sccp_current_device_name_pc_default_on ays_sccp_current_device_name_pc show ays_toggle_target" style="<?php echo ( $enable_ays_sccp_sub_text_alignment_mobile ) ? '' : 'display: none;' ?> text-align: center; margin-bottom: 10px; max-width: 250px;"><?php echo __('PC', 'secure-copy-content-protection') ?></div>
                                        <div class="ays_sccp_display_flex">
			                                <div class="form-check form-check-inline checkbox_ays">
			                                    <input type="radio" id="ays_sccp_sub_text_alignment_left" class="form-check-input" name="ays_sccp_sub_text_alignment" value="left" <?php echo ( $ays_sccp_sub_text_alignment == 'left' ) ? 'checked' : ''; ?>/>
			                                    <label class="form-check-label" for="ays_sccp_sub_text_alignment_left"><?php echo __( 'Left', 'secure-copy-content-protection' ); ?></label>
			                                </div>
			                                <div class="form-check form-check-inline checkbox_ays">
			                                    <input type="radio" id="ays_sccp_sub_text_alignment_center" class="form-check-input" name="ays_sccp_sub_text_alignment" value="center" <?php echo ($ays_sccp_sub_text_alignment == 'center') ? 'checked' : ''; ?>/>
			                                    <label class="form-check-label" for="ays_sccp_sub_text_alignment_center"><?php echo __( 'Center', 'secure-copy-content-protection' ); ?></label>
			                                </div>
			                                <div class="form-check form-check-inline checkbox_ays">
			                                    <input type="radio" id="ays_sccp_sub_text_alignment_right" class="form-check-input" name="ays_sccp_sub_text_alignment" value="right" <?php echo ($ays_sccp_sub_text_alignment == 'right') ? 'checked' : ''; ?>/>
			                                    <label class="form-check-label" for="ays_sccp_sub_text_alignment_right"><?php echo __( 'Right', 'secure-copy-content-protection' ); ?></label>
			                                </div>
			                            </div>
                                    </div>
                                    <div class="ays_toggle_target ays_sccp_sub_input_width_mobile_container" style=" <?php echo ( $enable_ays_sccp_sub_text_alignment_mobile ) ? '' : 'display:none'; ?>">
                                        <hr>
                                        <div class="ays_sccp_current_device_name show" style="text-align: center; margin-bottom: 10px; max-width: 250px;"><?php echo __('Mobile', 'secure-copy-content-protection') ?></div>
                                        <div class="ays_sccp_display_flex">
			                                <div class="form-check form-check-inline checkbox_ays">
			                                    <input type="radio" id="ays_sccp_sub_text_alignment_left_mobile" class="form-check-input" name="ays_sccp_sub_text_alignment_mobile" value="left" <?php echo ( $ays_sccp_sub_text_alignment_mobile == 'left') ? 'checked' : ''; ?>/>
			                                    <label class="form-check-label" for="ays_sccp_sub_text_alignment_left_mobile"><?php echo __( 'Left', 'secure-copy-content-protection' ); ?></label>
			                                </div>
			                                <div class="form-check form-check-inline checkbox_ays">
			                                    <input type="radio" id="ays_sccp_sub_text_alignment_center_mobile" class="form-check-input" name="ays_sccp_sub_text_alignment_mobile" value="center" <?php echo ( $ays_sccp_sub_text_alignment_mobile == 'center') ? 'checked' : ''; ?>/>
			                                    <label class="form-check-label" for="ays_sccp_sub_text_alignment_center_mobile"><?php echo __( 'Center', 'secure-copy-content-protection' ); ?></label>
			                                </div>
			                                <div class="form-check form-check-inline checkbox_ays">
			                                    <input type="radio" id="ays_sccp_sub_text_alignment_right_mobile" class="form-check-input" name="ays_sccp_sub_text_alignment_mobile" value="right" <?php echo ( $ays_sccp_sub_text_alignment_mobile == 'right' ) ? 'checked' : ''; ?>/>
			                                    <label class="form-check-label" for="ays_sccp_sub_text_alignment_right_mobile"><?php echo __( 'Right', 'secure-copy-content-protection' ); ?></label>
			                                </div>
			                            </div>
                                    </div>
                                    <div class="ays_sccp_mobile_settings_container">
                                        <input type="checkbox" class="ays_toggle_mobile_checkbox" id="enable_ays_sccp_sub_text_alignment_mobile" name="enable_ays_sccp_sub_text_alignment_mobile" <?php echo $enable_ays_sccp_sub_text_alignment_mobile ? 'checked' : '' ?>>
                                        <label for="enable_ays_sccp_sub_text_alignment_mobile" ><?php echo __('Use a different setting for Mobile', 'secure-copy-content-protection') ?></label>
                                    </div>
                                </div>                                                                
                            </div>
                        </div>
                        <hr>
                        <div class="form-group row">
                            <div class="col-sm-4">
                                <label for="ays_sccp_enable_sub_btn_style">
                                    <?php echo __('Subscribe button style','secure-copy-content-protection')?>
                                    <a class="ays_help" data-toggle="tooltip" title="<?php echo __('Change Subscribe button  styles.','secure-copy-content-protection')?>">
                                        <i class="ays_fa ays_fa_info_circle"></i>
                                    </a>
                                </label>
                            </div>
                            <div class="col-sm-8 ays_divider_left">
                                <input type="checkbox" class="ays_toggle ays_toggle_slide" id="ays_sccp_enable_sub_btn_style" name="ays_sccp_enable_sub_btn_style" <?php echo ($ays_sccp_enable_sub_btn_style) ? 'checked' : ''; ?>/>
                                <label for="ays_sccp_enable_sub_btn_style" class="ays_switch_toggle">Toggle</label>
                                <div class="form-group ays_toggle_target" style="margin: 10px 0 0 0; padding-top: 10px; <?php echo ($ays_sccp_enable_sub_btn_style) ? '' : 'display:none;' ?>">
                                    <div class="form-group row">
                                        <div class="col-sm-5">
                                            <label for='ays_sccp_sub_btn_color'>
                                                <?php echo __('Button color', 'secure-copy-content-protection'); ?>
                                                <a class="ays_help" data-toggle="tooltip" title="<?php echo __('Specify button color.','secure-copy-content-protection')?>">
                                                    <i class="ays_fa ays_fa_info_circle"></i>
                                                </a>
                                            </label>
                                        </div>

                                        <div class="col-sm-7 ays_divider_left">
                                        	<div class="ays_toggle_mobile_parent">
			                                    <div>
			                                        <div class="ays_sccp_current_device_name ays_sccp_current_device_name_pc_default_on ays_sccp_current_device_name_pc show ays_toggle_target" style="<?php echo ($enable_ays_sccp_sub_btn_color_mobile) ? '' : 'display: none;' ?> text-align: center; margin-bottom: 10px; max-width: 100px;"><?php echo __('PC', 'secure-copy-content-protection') ?></div>

			                                        <input type="text" class="ays-text-input" id='ays_sccp_sub_btn_color' data-alpha="true" name='ays_sccp_sub_btn_color' value="<?php echo $ays_sccp_sub_btn_color; ?>"/>
			                                    </div>
			                                    <div class="ays_toggle_target ays_sccp_sub_cont_border_color_mobile_container" style=" <?php echo ( $enable_ays_sccp_sub_btn_color_mobile ) ? '' : 'display:none'; ?>">
			                                        <hr>
			                                        <div class="ays_sccp_current_device_name show" style="text-align: center; margin-bottom: 10px; max-width: 100px;"><?php echo __('Mobile', 'secure-copy-content-protection') ?></div>
			                                        <input type="text" class="ays-text-input" id='ays_sccp_sub_btn_color_mobile' data-alpha="true" name='ays_sccp_sub_btn_color_mobile' value="<?php echo $ays_sccp_sub_btn_color_mobile; ?>"/>
			                                    </div>
			                                    <div class="ays_sccp_mobile_settings_container">
			                                        <input type="checkbox" class="ays_toggle_mobile_checkbox" id="enable_ays_sccp_sub_btn_color_mobile" name="enable_ays_sccp_sub_btn_color_mobile" <?php echo $enable_ays_sccp_sub_btn_color_mobile ? 'checked' : '' ?>>
			                                        <label for="enable_ays_sccp_sub_btn_color_mobile" ><?php echo __('Use a different setting for Mobile', 'secure-copy-content-protection') ?></label>
			                                    </div>
			                                </div>                                            
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <div class="col-sm-5">
                                            <label for='ays_sccp_sub_btn_text_color'>
                                                <?php echo __('Button text color', 'secure-copy-content-protection'); ?>
                                                <a class="ays_help" data-toggle="tooltip" title="<?php echo __('Specify button text color.','secure-copy-content-protection')?>">
                                                    <i class="ays_fa ays_fa_info_circle"></i>
                                                </a>
                                            </label>
                                        </div>
                                        <div class="col-sm-7 ays_divider_left">
                                            <input type="text" class="ays-text-input" id='ays_sccp_sub_btn_text_color' data-alpha="true" name='ays_sccp_sub_btn_text_color' value="<?php echo $ays_sccp_sub_btn_text_color; ?>"/>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <div class="col-sm-5">
                                            <label for='ays_sccp_sub_btn_font_size'>
                                                <?php echo __('Button size', 'secure-copy-content-protection'); ?>
                                                <a class="ays_help" data-toggle="tooltip" title="<?php echo __('Specify button size.','secure-copy-content-protection')?>">
                                                    <i class="ays_fa ays_fa_info_circle"></i>
                                                </a>
                                            </label>
                                        </div>
                                        <div class="col-sm-7 ays_divider_left">
                                            <div class="row">
                                                <div class="col-sm-5">
                                                    <label for='ays_sccp_sub_btn_size'>
                                                        <?php echo __('On PC', 'secure-copy-content-protection'); ?>
                                                        <a class="ays_help" data-toggle="tooltip" title="<?php echo __('Define the button font size for PC devices.','secure-copy-content-protection'); ?>">
                                                            <i class="ays_fa ays_fa_info_circle"></i>
                                                        </a>
                                                    </label>
                                                </div>
                                                <div class="col-sm-7 ays_divider_left ays_sccp_display_flex">
                                                    <div>
                                                       <input type="number" class="ays-text-input ays-text-input-short" id='ays_sccp_sub_btn_size' data-alpha="true" name='ays_sccp_sub_btn_size' value="<?php echo $ays_sccp_sub_btn_size; ?>"/>
                                                    </div>
                                                    <div class="ays_sccp_dropdown_max_width">
                                                        <input type="text" value="px" class="ays-sccp-form-hint-for-size" disabled="">
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-sm-5">
                                                    <label for='ays_sccp_sub_mobile_btn_size'>
                                                        <?php echo __('On mobile', 'secure-copy-content-protection'); ?>
                                                        <a class="ays_help" data-toggle="tooltip" title="<?php echo __('Define the button font size for mobile devices.','secure-copy-content-protection'); ?>">
                                                            <i class="ays_fa ays_fa_info_circle"></i>
                                                        </a>
                                                    </label>
                                                </div>
                                                <div class="col-sm-7 ays_divider_left ays_sccp_display_flex">
                                                    <div>
                                                       <input type="number" class="ays-text-input ays-text-input-short" id='ays_sccp_sub_mobile_btn_size' name='ays_sccp_sub_mobile_btn_size' value="<?php echo $ays_sccp_sub_mobile_btn_size; ?>"/>
                                                    </div>
                                                    <div class="ays_sccp_dropdown_max_width">
                                                        <input type="text" value="px" class="ays-sccp-form-hint-for-size" disabled="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>                                        
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <div class="col-sm-5">
                                            <label for='ays_sccp_sub_btn_radius'>
                                                <?php echo __('Button border-radius', 'secure-copy-content-protection'); ?>
                                                <a class="ays_help" data-toggle="tooltip" title="<?php echo __('Subscribe buttons border-radius in pixels. It accepts only numeric values.','secure-copy-content-protection')?>">
                                                    <i class="ays_fa ays_fa_info_circle"></i>
                                                </a>
                                            </label>
                                        </div>
                                        <div class="col-sm-7 ays_divider_left ays_sccp_display_flex">
                                            <div>
                                               <input type="number" class="ays-text-input" id='ays_sccp_sub_btn_radius' data-alpha="true" name='ays_sccp_sub_btn_radius' value="<?php echo $ays_sccp_sub_btn_radius; ?>"/>
                                            </div>
                                            <div class="ays_sccp_dropdown_max_width">
                                                <input type="text" value="px" class="ays-sccp-form-hint-for-size" disabled="">
                                            </div>
                                        </div>                                        
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <div class="col-sm-5">
                                            <label for='ays_sccp_sub_btn_border_width'>
                                                <?php echo __('Button border width', 'secure-copy-content-protection'); ?>
                                                <a class="ays_help" data-toggle="tooltip" title="<?php echo __('Subscribe buttons border width in pixels. It accepts only numeric values.','secure-copy-content-protection')?>">
                                                    <i class="ays_fa ays_fa_info_circle"></i>
                                                </a>
                                            </label>
                                        </div>
                                        <div class="col-sm-7 ays_divider_left ays_sccp_display_flex">
                                            <div>
                                               <input type="number" class="ays-text-input" id='ays_sccp_sub_btn_border_width' data-alpha="true" name='ays_sccp_sub_btn_border_width' value="<?php echo $ays_sccp_sub_btn_border_width; ?>"/>
                                            </div>
                                            <div class="ays_sccp_dropdown_max_width">
                                                <input type="text" value="px" class="ays-sccp-form-hint-for-size" disabled="">
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <div class="col-sm-5">
                                            <label for='ays_sccp_sub_btn_border_style'>
                                                <?php echo __('Button border style', 'secure-copy-content-protection'); ?>
                                                <a class="ays_help" data-toggle="tooltip" title="<?php echo __('Specify button border style.','secure-copy-content-protection')?>">
                                                    <i class="ays_fa ays_fa_info_circle"></i>
                                                </a>
                                            </label>
                                        </div>
                                        <div class="col-sm-7 ays_divider_left">
                                            <select id="ays_sccp_sub_btn_border_style" name="ays_sccp_sub_btn_border_style" class="ays-text-input ays-text-input-short">
                                                <option <?php echo ($ays_sccp_sub_btn_border_style == 'solid') ? 'selected' : ''; ?> value="solid">Solid</option>
                                                <option <?php echo ($ays_sccp_sub_btn_border_style == 'dashed') ? 'selected' : ''; ?> value="dashed">Dashed</option>
                                                <option <?php echo ($ays_sccp_sub_btn_border_style == 'dotted') ? 'selected' : ''; ?> value="dotted">Dotted</option>
                                                <option <?php echo ($ays_sccp_sub_btn_border_style == 'double') ? 'selected' : ''; ?> value="double">Double</option>
                                                <option <?php echo ($ays_sccp_sub_btn_border_style == 'groove') ? 'selected' : ''; ?> value="groove">Groove</option>
                                                <option <?php echo ($ays_sccp_sub_btn_border_style == 'ridge') ? 'selected' : ''; ?> value="ridge">Ridge</option>
                                                <option <?php echo ($ays_sccp_sub_btn_border_style == 'inset') ? 'selected' : ''; ?> value="inset">Inset</option>
                                                <option <?php echo ($ays_sccp_sub_btn_border_style == 'outset') ? 'selected' : ''; ?> value="outset">Outset</option>
                                                <option <?php echo ($ays_sccp_sub_btn_border_style == 'none') ? 'selected' : ''; ?> value="none">None</option>
                                            </select>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <div class="col-sm-5">
                                            <label for='ays_sccp_sub_btn_border_color'>
                                                <?php echo __('Button border color', 'secure-copy-content-protection'); ?>
                                                <a class="ays_help" data-toggle="tooltip" title="<?php echo __('Specify button border color.','secure-copy-content-protection')?>">
                                                    <i class="ays_fa ays_fa_info_circle"></i>
                                                </a>
                                            </label>
                                        </div>
                                        <div class="col-sm-7 ays_divider_left">
                                            <input type="text" class="ays-text-input" id='ays_sccp_sub_btn_border_color' data-alpha="true" name='ays_sccp_sub_btn_border_color' value="<?php echo $ays_sccp_sub_btn_border_color; ?>"/>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <div class="col-sm-5">
                                            <label for='ays_sccp_sub_btn_padding'>
                                                <?php echo __('Button padding', 'secure-copy-content-protection'); ?>
                                                <a class="ays_help" data-toggle="tooltip" title="<?php echo __('Padding of buttons in pixels. It accepts only numeric values.','secure-copy-content-protection')?>">
                                                    <i class="ays_fa ays_fa_info_circle"></i>
                                                </a>
                                            </label>
                                        </div>
                                        <div class="col-sm-7 ays_divider_left">
                                            <div class="col-sm-3" style="display: inline-flex; flex-direction: column; padding-left: 0;">
                                                <span class="ays_sccp_small_hint_text"><?php echo __('Left / Right','secure-copy-content-protection')?></span>
                                                <input type="number" class="ays-text-input" id='ays_sub_btn_left_right_padding' name='ays_sub_btn_left_right_padding' value="<?php echo $buttons_left_right_padding; ?>" style="width: 100px;" />
                                            </div>
                                            <div class="col-sm-3 ays_divider_left ays-buttons-top-bottom-padding-box" style="display: inline-flex;flex-direction: column;">
                                                <span class="ays_sccp_small_hint_text"><?php echo __('Top / Bottom','secure-copy-content-protection')?></span>
                                                <input type="number" class="ays-text-input" id='ays_sub_btn_top_bottom_padding' name='ays_sub_btn_top_bottom_padding' value="<?php echo $buttons_top_bottom_padding; ?>" style="width: 100px;" />
                                            </div>
                                        </div>
                                    </div>
                                </div>                                
                            </div>
                        </div>
                        <hr>
                        <div class="form-group row">
                            <div class="col-sm-4">
                                <label for="sub_reset_to_default">
                                    <?php echo __('Subscribe reset styles', 'secure-copy-content-protection') ?>
                                    <a class="ays_help" data-toggle="tooltip"
                                       title="<?php echo __('Reset tooltip styles to default values', 'secure-copy-content-protection') ?>">
                                        <i class="ays_fa ays_fa_info_circle"></i>
                                    </a>
                                </label>
                            </div>
                            <div class="col-sm-8 ays_divider_left">
                                <button type="button" class="ays-button button-secondary"
                                        id="sub_reset_to_default"><?php echo __("Reset", 'secure-copy-content-protection') ?>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div id="tab6" class="ays-sccp-tab-content <?php echo ($ays_sccp_tab == 'tab6') ? 'ays-sccp-tab-content-active' : ''; ?>">
                        <p class="ays-subtitle"><?php echo __('Styles','secure-copy-content-protection')?></p>
                        <hr>
                        <div class="form-group row">
                            <div class="col-sm-4">
                                <label for="ays_sccp_bc_width">
                                    <?php echo __( "Block content box width", 'secure-copy-content-protection' ); ?>
                                    <a class="ays_help" data-toggle="tooltip" title="<?php echo __('Set the default value for the width of the block content field in pixels or as a percentage. This will apply to all block content boxes in the frontend plugin.','secure-copy-content-protection'); ?>">
                                        <i class="ays_fa ays_fa_info_circle"></i>
                                    </a>
                                </label>
                            </div>
                            <div class="col-sm-8 ays_divider_left ays_sccp_display_flex">
                                <div>   
                                    <input type="number" class="ays-text-input ays-text-input-short" id='ays_sccp_bc_width' name='ays_sccp_bc_width' value="<?php echo $ays_sccp_bc_width; ?>"/>
                                </div>
                                <div class="ays_sccp_dropdown_max_width">
                                    <select id="sccp_bc_width_by_percentage_px" name="ays_sccp_bc_width_by_percentage_px" class="ays-text-input ays-text-input-short" style="display:inline-block; width: 60px;">
                                        <option value="pixels" <?php echo $sccp_bc_width_by_percentage_px == "pixels" ? "selected" : ""; ?>><?php echo __( "px", 'secure-copy-content-protection' ); ?></option>
                                        <option value="percentage" <?php echo $sccp_bc_width_by_percentage_px == "percentage" ? "selected" : ""; ?>><?php echo __( "%", 'secure-copy-content-protection' ); ?></option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group row">
                            <div class="col-sm-4">
                                <label for="bc_text_color"><?= __('Block content text color', 'secure-copy-content-protection'); ?></label>
                                <a class="ays_help" data-toggle="tooltip"
                                   title="<?= __('Set the default text color of the Block content Box. It will apply to all Block content Boxes within the plugin on the front-end.', 'secure-copy-content-protection') ?>">
                                    <i class="ays_fa ays_fa_info_circle"></i>
                                </a>
                            </div>
                            <div class="col-sm-8 ays_divider_left">
                                <input type="text" id="bc_text_color" data-alpha="true" name="bc_text_color" value="<?php echo $ays_sccp_bc_text_color; ?>"/>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group row">
                            <div class="col-sm-4">
                                <label for="bc_bg_color"><?= __('Block content box background color', 'secure-copy-content-protection'); ?></label>
                                <a class="ays_help" data-toggle="tooltip"
                                   title="<?= __('Set the default background color of the Block content Box. It will apply to all Block content Boxes within the plugin on the front-end.', 'secure-copy-content-protection') ?>">
                                    <i class="ays_fa ays_fa_info_circle"></i>
                                </a>
                            </div>
                            <div class="col-sm-8 ays_divider_left">
                                <input type="text" id="bc_bg_color" data-alpha="true" name="bc_bg_color" value="<?php echo $ays_sccp_bc_bg_color; ?>"/>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group row copy_protection_container">
                            <div class="col-sm-4">
                                <label for="sccp_bc_bg_image">
                                    <?php echo __('Block content box background image', 'secure-copy-content-protection')?>
                                    <a class="ays_help" data-toggle="tooltip" title="<?php echo __('Add background image for Block content Box.','secure-copy-content-protection')?>">
                                        <i class="ays_fa ays_fa_info_circle"></i>
                                    </a>
                                </label>
                            </div>                                    
                            <div class="col-sm-8 ays_divider_left">
                                <a href="javascript:void(0)" id="sccp_bc_bg_image" style="<?php echo !isset($sccp_bc_bg_image) || empty($sccp_bc_bg_image) ? 'display:inline-block;' : 'display:none;'; ?>" class="add-sccp-bc-bg-image"><?php echo $bc_bg_image_text; ?></a>
                                <input type="hidden" id="ays_sccp_bc_bg_image" name="ays_sccp_bc_bg_image"
                                       value="<?php echo $sccp_bc_bg_image; ?>"/>
                                <div id="sccp_bc_bg-image_container" class="ays-sccp-bc-bg-image-container" style="<?php echo !isset($sccp_bc_bg_image) || empty($sccp_bc_bg_image) ? 'display:none' : 'display:block'; ?>">
                                    <span class="ays-edit-sccp-bc-bg-img">
                                        <i class="ays_fa ays_fa_pencil_square_o"></i>
                                    </span>
                                    <span class="ays-remove-sccp-bc-bg-img"></span>
                                    <img src="<?php echo $sccp_bc_bg_image; ?>" id="ays-sccp-bc-bg-img"/>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <!-- Block content BG Image Position Start -->
                        <div class="form-group row">
                            <div class="col-sm-4">
                                <label for="ays_bc_bg_image_position">
                                    <?php echo __( "Block content box background image position", 'secure-copy-content-protection' ); ?>
                                    <a class="ays_help" data-toggle="tooltip" title="<?php echo __('The position of background image for Block content Box','secure-copy-content-protection')?>">
                                        <i class="ays_fa ays_fa_info_circle"></i>
                                    </a>
                                </label>
                            </div>
                            <div class="col-sm-8 ays_divider_left">
                                <select id="ays_bc_bg_image_position" name="ays_bc_bg_image_position" class="ays-text-input ays-text-input-short">
                                    <option value="left top" <?php echo $sccp_bc_bg_image_position == "left top" ? "selected" : ""; ?>><?php echo __( "Left Top", 'secure-copy-content-protection' ); ?></option>
                                    <option value="left center" <?php echo $sccp_bc_bg_image_position == "left center" ? "selected" : ""; ?>><?php echo __( "Left Center", 'secure-copy-content-protection' ); ?></option>
                                    <option value="left bottom" <?php echo $sccp_bc_bg_image_position == "left bottom" ? "selected" : ""; ?>><?php echo __( "Left Bottom", 'secure-copy-content-protection' ); ?></option>
                                    <option value="center top" <?php echo $sccp_bc_bg_image_position == "center top" ? "selected" : ""; ?>><?php echo __( "Center Top", 'secure-copy-content-protection' ); ?></option>
                                    <option value="center center" <?php echo $sccp_bc_bg_image_position == "center center" ? "selected" : ""; ?>><?php echo __( "Center Center", 'secure-copy-content-protection' ); ?></option>
                                    <option value="center bottom" <?php echo $sccp_bc_bg_image_position == "center bottom" ? "selected" : ""; ?>><?php echo __( "Center Bottom", 'secure-copy-content-protection' ); ?></option>
                                    <option value="right top" <?php echo $sccp_bc_bg_image_position == "right top" ? "selected" : ""; ?>><?php echo __( "Right Top", 'secure-copy-content-protection' ); ?></option>
                                    <option value="right center" <?php echo $sccp_bc_bg_image_position == "right center" ? "selected" : ""; ?>><?php echo __( "Right Center", 'secure-copy-content-protection' ); ?></option>
                                    <option value="right bottom" <?php echo $sccp_bc_bg_image_position == "right bottom" ? "selected" : ""; ?>><?php echo __( "Right Bottom", 'secure-copy-content-protection' ); ?></option>
                                </select>
                            </div>
                        </div>
                        <!-- Block content BG Image Position End -->
                        <hr>
                        <div class="form-group row">
                            <div class="col-sm-4">
                                <label for="ays_sccp_bc_button_text">
                                    <?php echo __( "Block content button text", 'secure-copy-content-protection' ); ?>
                                    <a class="ays_help" data-toggle="tooltip" title="<?php echo __('Set the default value to the button text of the Block content Box. It will apply to all Block content Boxes within the plugin on the front-end.','secure-copy-content-protection'); ?>">
                                        <i class="ays_fa ays_fa_info_circle"></i>
                                    </a>
                                </label>
                            </div>
                            <div class="col-sm-8 ays_divider_left">
                                <input type="text" name="ays_sccp_bc_button_text" id="ays_sccp_bc_button_text" class="ays-text-input ays-text-input-short" value="<?php echo $ays_sccp_bc_button_text; ?>">
                            </div>
                        </div>
                        <hr>
                        <div class="form-group row">
                            <div class="col-sm-4">
                                <label for="ays_sccp_bc_psw_place_text">
                                    <?php echo __( "Block content password placeholder text", 'secure-copy-content-protection' ); ?>
                                    <a class="ays_help" data-toggle="tooltip" title="<?php echo __('Set the default value to the password placeholder text of the Block content Box. It will apply to all Block contents Boxes within the plugin on the front-end.','secure-copy-content-protection'); ?>">
                                        <i class="ays_fa ays_fa_info_circle"></i>
                                    </a>
                                </label>
                            </div>
                            <div class="col-sm-8 ays_divider_left">
                                <input type="text" name="ays_sccp_bc_psw_place_text" id="ays_sccp_bc_psw_place_text" class="ays-text-input ays-text-input-short" value="<?php echo $sccp_bc_psw_place_text; ?>">
                            </div>
                        </div>
                        <hr>
                        <div class="form-group row">
                            <div class="col-sm-4">
                                <label for='ays_sccp_bc_cont_border_style'>
                                    <?php echo __('Block content container border style', 'secure-copy-content-protection'); ?>
                                    <a class="ays_help" data-toggle="tooltip" title="<?php echo __('Specify container border style.','secure-copy-content-protection')?>">
                                        <i class="ays_fa ays_fa_info_circle"></i>
                                    </a>
                                </label>
                            </div>
                            <div class="col-sm-8 ays_divider_left">
                                <select id="ays_sccp_bc_cont_border_style" name="ays_sccp_bc_cont_border_style" class="ays-text-input ays-text-input-short">
                                    <option <?php echo ($ays_sccp_bc_cont_border_style == 'solid') ? 'selected' : ''; ?> value="solid">Solid</option>
                                    <option <?php echo ($ays_sccp_bc_cont_border_style == 'dashed') ? 'selected' : ''; ?> value="dashed">Dashed</option>
                                    <option <?php echo ($ays_sccp_bc_cont_border_style == 'dotted') ? 'selected' : ''; ?> value="dotted">Dotted</option>
                                    <option <?php echo ($ays_sccp_bc_cont_border_style == 'double') ? 'selected' : ''; ?> value="double">Double</option>
                                    <option <?php echo ($ays_sccp_bc_cont_border_style == 'groove') ? 'selected' : ''; ?> value="groove">Groove</option>
                                    <option <?php echo ($ays_sccp_bc_cont_border_style == 'ridge') ? 'selected' : ''; ?> value="ridge">Ridge</option>
                                    <option <?php echo ($ays_sccp_bc_cont_border_style == 'inset') ? 'selected' : ''; ?> value="inset">Inset</option>
                                    <option <?php echo ($ays_sccp_bc_cont_border_style == 'outset') ? 'selected' : ''; ?> value="outset">Outset</option>
                                    <option <?php echo ($ays_sccp_bc_cont_border_style == 'none') ? 'selected' : ''; ?> value="none">None</option>
                                </select>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group row">
                            <div class="col-sm-4">
                                <label for='ays_sccp_bc_cont_border_color'>
                                    <?php echo __('Block content container border color', 'secure-copy-content-protection'); ?>
                                    <a class="ays_help" data-toggle="tooltip" title="<?php echo __('Specify container border color.','secure-copy-content-protection')?>">
                                        <i class="ays_fa ays_fa_info_circle"></i>
                                    </a>
                                </label>
                            </div>
                            <div class="col-sm-8 ays_divider_left">
                                <input type="text" class="ays-text-input" id='ays_sccp_bc_cont_border_color' data-alpha="true" name='ays_sccp_bc_cont_border_color' value="<?php echo $ays_sccp_bc_cont_border_color; ?>"/>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group row">
                            <div class="col-sm-4">
                                <label for='ays_sccp_bc_cont_border_width'>
                                    <?php echo __('Block content container border width', 'secure-copy-content-protection'); ?>
                                    <a class="ays_help" data-toggle="tooltip" title="<?php echo __('Block content container border width in pixels. It accepts only numeric values.','secure-copy-content-protection')?>">
                                        <i class="ays_fa ays_fa_info_circle"></i>
                                    </a>
                                </label>
                            </div>
                            <div class="col-sm-8 ays_divider_left ays_sccp_display_flex">
                                <div>
                                   <input type="number" class="ays-text-input ays-text-input-short" id='ays_sccp_bc_cont_border_width' data-alpha="true" name='ays_sccp_bc_cont_border_width' value="<?php echo $ays_sccp_bc_cont_border_width; ?>"/>
                                </div>
                                <div class="ays_sccp_dropdown_max_width">
                                    <input type="text" value="px" class="ays-sccp-form-hint-for-size" disabled="">
                                </div>
                            </div>                            
                        </div>
                        <hr/>
                        <div class="form-group row">
                            <div class="col-sm-4">
                                <label for='ays_sccp_bc_input_width'>
                                    <?php echo __('Block content container input width', 'secure-copy-content-protection'); ?>
                                    <a class="ays_help" data-toggle="tooltip" title="<?php echo __('Block content container input width in pixels. It accepts only numeric values.','secure-copy-content-protection')?>">
                                        <i class="ays_fa ays_fa_info_circle"></i>
                                    </a>
                                </label>
                            </div>
                            <div class="col-sm-8 ays_divider_left ays_sccp_display_flex">
                                <div>
                                   <input type="number" class="ays-text-input ays-text-input-short" id='ays_sccp_bc_input_width' data-alpha="true" name='ays_sccp_bc_input_width' value="<?php echo $ays_sccp_bc_input_width; ?>"/>
                                </div>
                                <div class="ays_sccp_dropdown_max_width">
                                    <input type="text" value="px" class="ays-sccp-form-hint-for-size" disabled="">
                                </div>
                            </div>                            
                        </div>
                        <hr/>
                        <div class="form-group row copy_protection_container">
                            <div class="col-sm-4">
                                <label for="sccp_bc_icon_image">
                                    <?php echo __('Block content Icon','secure-copy-content-protection')?>
                                    <a class="ays_help" data-toggle="tooltip" title="<?php echo __('Add icon image for Block content Box. Advisable size for image is 50x50.','secure-copy-content-protection')?>">
                                        <i class="ays_fa ays_fa_info_circle"></i>
                                    </a>
                                </label>
                            </div>                                    
                            <div class="col-sm-8 ays_divider_left">
                                <a href="javascript:void(0)" id="sccp_bc_icon_image" style="<?php echo !isset($sccp_bc_icon_image) || empty($sccp_bc_icon_image) ? 'display:inline-block;' : 'display:none;'; ?>" class="add-sccp-bc-icon-image"><?php echo $bc_icon_image_text; ?></a>
                                <input type="hidden" id="ays_sccp_bc_icon_image" name="ays_sccp_bc_icon_image"
                                       value="<?php echo $sccp_bc_icon_image; ?>"/>
                                <div id="sccp_bc_image_container" class="ays-sccp-bc-image-container" style="<?php echo !isset($sccp_bc_icon_image) || empty($sccp_bc_icon_image) ? 'display:none' : 'display:block'; ?>">
                                    <span class="ays-edit-sccp-bc-img">
                                        <i class="ays_fa ays_fa_pencil_square_o"></i>
                                    </span>
                                    <span class="ays-remove-sccp-bc-img"></span>
                                    <img src="<?php echo $sccp_bc_icon_image; ?>" id="ays-sccp-bc-img"/>
                                </div>
                            </div>
                        </div>
                        <hr/>
                        <div class="form-group row">
                            <div class="col-sm-4">
                                <label for="ays_sccp_bc_text_alignment">
                                    <?php echo __( "Block content box text alignment", 'secure-copy-content-protection' ); ?>
                                    <a class="ays_help" data-toggle="tooltip" title="<?php echo __('Align the text of Block content box to the left, center, or right.','secure-copy-content-protection'); ?>">
                                        <i class="ays_fa ays_fa_info_circle"></i>
                                    </a>
                                </label>
                            </div>
                            <div class="col-sm-8 ays_divider_left">
                                <div class="form-check form-check-inline checkbox_ays">
                                    <input type="radio" id="ays_sccp_bc_text_alignment_left" class="form-check-input" name="ays_sccp_bc_text_alignment" value="left" <?php echo ($ays_sccp_bc_text_alignment == 'left') ? 'checked' : ''; ?>/>
                                    <label class="form-check-label" for="ays_sccp_bc_text_alignment_left"><?php echo __( 'Left', 'secure-copy-content-protection' ); ?></label>
                                </div>
                                <div class="form-check form-check-inline checkbox_ays">
                                    <input type="radio" id="ays_sccp_bc_text_alignment_center" class="form-check-input" name="ays_sccp_bc_text_alignment" value="center" <?php echo ($ays_sccp_bc_text_alignment == 'center') ? 'checked' : ''; ?>/>
                                    <label class="form-check-label" for="ays_sccp_bc_text_alignment_center"><?php echo __( 'Center', 'secure-copy-content-protection' ); ?></label>
                                </div>
                                <div class="form-check form-check-inline checkbox_ays">
                                    <input type="radio" id="ays_sccp_bc_text_alignment_right" class="form-check-input" name="ays_sccp_bc_text_alignment" value="right" <?php echo ($ays_sccp_bc_text_alignment == 'right') ? 'checked' : ''; ?>/>
                                    <label class="form-check-label" for="ays_sccp_bc_text_alignment_right"><?php echo __( 'Right', 'secure-copy-content-protection' ); ?></label>
                                </div>                                
                            </div>
                        </div>
                        <hr>
                        <div class="form-group row">
                            <div class="col-sm-4">
                                <label for="ays_sccp_enable_bc_btn_style">
                                    <?php echo __('Block content button style','secure-copy-content-protection')?>
                                    <a class="ays_help" data-toggle="tooltip" title="<?php echo __('Change Block content button  styles.','secure-copy-content-protection')?>">
                                        <i class="ays_fa ays_fa_info_circle"></i>
                                    </a>
                                </label>
                            </div>
                            <div class="col-sm-8 ays_divider_left">
                                <input type="checkbox" class="ays_toggle ays_toggle_slide" id="ays_sccp_enable_bc_btn_style" name="ays_sccp_enable_bc_btn_style" <?php echo ($ays_sccp_enable_bc_btn_style) ? 'checked' : ''; ?>/>
                                <label for="ays_sccp_enable_bc_btn_style" class="ays_switch_toggle">Toggle</label>
                                <div class="form-group ays_toggle_target" style="margin: 10px 0 0 0; padding-top: 10px; <?php echo ($ays_sccp_enable_bc_btn_style) ? '' : 'display:none;' ?>">
                                    <div class="form-group row">
                                        <div class="col-sm-5">
                                            <label for='ays_sccp_bc_btn_color'>
                                                <?php echo __('Button background color', 'secure-copy-content-protection'); ?>
                                                <a class="ays_help" data-toggle="tooltip" title="<?php echo __('Specify button background color.','secure-copy-content-protection')?>">
                                                    <i class="ays_fa ays_fa_info_circle"></i>
                                                </a>
                                            </label>
                                        </div>
                                        <div class="col-sm-7 ays_divider_left">
                                            <input type="text" class="ays-text-input" id='ays_sccp_bc_btn_color' data-alpha="true" name='ays_sccp_bc_btn_color' value="<?php echo $ays_sccp_bc_btn_color; ?>"/>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <div class="col-sm-5">
                                            <label for='ays_sccp_bc_btn_text_color'>
                                                <?php echo __('Button text color', 'secure-copy-content-protection'); ?>
                                                <a class="ays_help" data-toggle="tooltip" title="<?php echo __('Specify button text color.','secure-copy-content-protection')?>">
                                                    <i class="ays_fa ays_fa_info_circle"></i>
                                                </a>
                                            </label>
                                        </div>
                                        <div class="col-sm-7 ays_divider_left">
                                            <input type="text" class="ays-text-input" id='ays_sccp_bc_btn_text_color' data-alpha="true" name='ays_sccp_bc_btn_text_color' value="<?php echo $ays_sccp_bc_btn_text_color; ?>"/>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <div class="col-sm-5">
                                            <label for='ays_sccp_bc_btn_font_size'>
                                                <?php echo __('Button size', 'secure-copy-content-protection'); ?>
                                                <a class="ays_help" data-toggle="tooltip" title="<?php echo __('Specify button size.','secure-copy-content-protection')?>">
                                                    <i class="ays_fa ays_fa_info_circle"></i>
                                                </a>
                                            </label>
                                        </div>
                                        <div class="col-sm-7 ays_divider_left">
                                            <div class="row">
                                                <div class="col-sm-5">
                                                    <label for='ays_sccp_bc_btn_size'>
                                                        <?php echo __('On PC', 'secure-copy-content-protection'); ?>
                                                        <a class="ays_help" data-toggle="tooltip" title="<?php echo __('Define the button font size for PC devices.','secure-copy-content-protection'); ?>">
                                                            <i class="ays_fa ays_fa_info_circle"></i>
                                                        </a>
                                                    </label>
                                                </div>
                                                <div class="col-sm-7 ays_divider_left ays_sccp_display_flex">
                                                    <div>
                                                       <input type="number" class="ays-text-input ays-text-input-short" id='ays_sccp_bc_btn_size' data-alpha="true" name='ays_sccp_bc_btn_size' value="<?php echo $ays_sccp_bc_btn_size; ?>"/>
                                                    </div>
                                                    <div class="ays_sccp_dropdown_max_width">
                                                        <input type="text" value="px" class="ays-sccp-form-hint-for-size" disabled="">
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-sm-5">
                                                    <label for='ays_sccp_bc_mobile_btn_size'>
                                                        <?php echo __('On mobile', 'secure-copy-content-protection'); ?>
                                                        <a class="ays_help" data-toggle="tooltip" title="<?php echo __('Define the button font size for mobile devices.','secure-copy-content-protection'); ?>">
                                                            <i class="ays_fa ays_fa_info_circle"></i>
                                                        </a>
                                                    </label>
                                                </div>
                                                <div class="col-sm-7 ays_divider_left ays_sccp_display_flex">
                                                    <div>
                                                       <input type="number" class="ays-text-input ays-text-input-short" id='ays_sccp_bc_mobile_btn_size' name='ays_sccp_bc_mobile_btn_size' value="<?php echo $ays_sccp_bc_mobile_btn_size; ?>"/>
                                                    </div>
                                                    <div class="ays_sccp_dropdown_max_width">
                                                        <input type="text" value="px" class="ays-sccp-form-hint-for-size" disabled="">
                                                    </div>
                                                </div>                                                
                                            </div>
                                        </div>                                        
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <div class="col-sm-5">
                                            <label for='ays_sccp_bc_btn_radius'>
                                                <?php echo __('Button border-radius', 'secure-copy-content-protection'); ?>
                                                <a class="ays_help" data-toggle="tooltip" title="<?php echo __('Block content buttons border-radius in pixels. It accepts only numeric values.','secure-copy-content-protection')?>">
                                                    <i class="ays_fa ays_fa_info_circle"></i>
                                                </a>
                                            </label>
                                        </div>
                                        <div class="col-sm-7 ays_divider_left ays_sccp_display_flex">
                                            <div>
                                               <input type="number" class="ays-text-input" id='ays_sccp_bc_btn_radius' data-alpha="true" name='ays_sccp_bc_btn_radius' value="<?php echo $ays_sccp_bc_btn_radius; ?>"/>
                                            </div>
                                            <div class="ays_sccp_dropdown_max_width">
                                                <input type="text" value="px" class="ays-sccp-form-hint-for-size" disabled="">
                                            </div>
                                        </div>                                        
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <div class="col-sm-5">
                                            <label for='ays_sccp_bc_btn_border_width'>
                                                <?php echo __('Button border width', 'secure-copy-content-protection'); ?>
                                                <a class="ays_help" data-toggle="tooltip" title="<?php echo __('Block content buttons border width in pixels. It accepts only numeric values.','secure-copy-content-protection')?>">
                                                    <i class="ays_fa ays_fa_info_circle"></i>
                                                </a>
                                            </label>
                                        </div>
                                        <div class="col-sm-7 ays_divider_left ays_sccp_display_flex">
                                            <div>
                                               <input type="number" class="ays-text-input" id='ays_sccp_bc_btn_border_width' data-alpha="true" name='ays_sccp_bc_btn_border_width' value="<?php echo $ays_sccp_bc_btn_border_width; ?>"/>
                                            </div>
                                            <div class="ays_sccp_dropdown_max_width">
                                                <input type="text" value="px" class="ays-sccp-form-hint-for-size" disabled="">
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <div class="col-sm-5">
                                            <label for='ays_sccp_bc_btn_border_style'>
                                                <?php echo __('Button border style', 'secure-copy-content-protection'); ?>
                                                <a class="ays_help" data-toggle="tooltip" title="<?php echo __('Specify button border style.','secure-copy-content-protection')?>">
                                                    <i class="ays_fa ays_fa_info_circle"></i>
                                                </a>
                                            </label>
                                        </div>
                                        <div class="col-sm-7 ays_divider_left">
                                            <select id="ays_sccp_bc_btn_border_style" name="ays_sccp_bc_btn_border_style" class="ays-text-input ays-text-input-short">
                                                <option <?php echo ($ays_sccp_bc_btn_border_style == 'solid') ? 'selected' : ''; ?> value="solid">Solid</option>
                                                <option <?php echo ($ays_sccp_bc_btn_border_style == 'dashed') ? 'selected' : ''; ?> value="dashed">Dashed</option>
                                                <option <?php echo ($ays_sccp_bc_btn_border_style == 'dotted') ? 'selected' : ''; ?> value="dotted">Dotted</option>
                                                <option <?php echo ($ays_sccp_bc_btn_border_style == 'double') ? 'selected' : ''; ?> value="double">Double</option>
                                                <option <?php echo ($ays_sccp_bc_btn_border_style == 'groove') ? 'selected' : ''; ?> value="groove">Groove</option>
                                                <option <?php echo ($ays_sccp_sub_btn_border_style == 'ridge') ? 'selected' : ''; ?> value="ridge">Ridge</option>
                                                <option <?php echo ($ays_sccp_bc_btn_border_style == 'inset') ? 'selected' : ''; ?> value="inset">Inset</option>
                                                <option <?php echo ($ays_sccp_bc_btn_border_style == 'outset') ? 'selected' : ''; ?> value="outset">Outset</option>
                                                <option <?php echo ($ays_sccp_bc_btn_border_style == 'none') ? 'selected' : ''; ?> value="none">None</option>
                                            </select>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <div class="col-sm-5">
                                            <label for='ays_sccp_bc_btn_border_color'>
                                                <?php echo __('Button border color', 'secure-copy-content-protection'); ?>
                                                <a class="ays_help" data-toggle="tooltip" title="<?php echo __('Specify button border color.','secure-copy-content-protection')?>">
                                                    <i class="ays_fa ays_fa_info_circle"></i>
                                                </a>
                                            </label>
                                        </div>
                                        <div class="col-sm-7 ays_divider_left">
                                            <input type="text" class="ays-text-input" id='ays_sccp_bc_btn_border_color' data-alpha="true" name='ays_sccp_bc_btn_border_color' value="<?php echo $ays_sccp_bc_btn_border_color; ?>"/>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <div class="col-sm-5">
                                            <label for='ays_sccp_bc_btn_padding'>
                                                <?php echo __('Button padding', 'secure-copy-content-protection'); ?>
                                                <a class="ays_help" data-toggle="tooltip" title="<?php echo __('Padding of buttons in pixels. It accepts only numeric values.','secure-copy-content-protection')?>">
                                                    <i class="ays_fa ays_fa_info_circle"></i>
                                                </a>
                                            </label>
                                        </div>
                                        <div class="col-sm-7 ays_divider_left">
                                            <div class="col-sm-3" style="display: inline-flex; flex-direction: column; padding-left: 0;">
                                                <span class="ays_sccp_small_hint_text"><?php echo __('Left / Right','secure-copy-content-protection')?></span>
                                                <input type="number" class="ays-text-input" id='ays_bc_btn_left_right_padding' name='ays_bc_btn_left_right_padding' value="<?php echo $ays_bc_buttons_left_right_padding; ?>" style="width: 100px;" />
                                            </div>
                                            <div class="col-sm-3 ays_divider_left ays-buttons-top-bottom-padding-box" style="display: inline-flex;flex-direction: column;">
                                                <span class="ays_sccp_small_hint_text"><?php echo __('Top / Bottom','secure-copy-content-protection')?></span>
                                                <input type="number" class="ays-text-input" id='ays_bc_btn_top_bottom_padding' name='ays_bc_btn_top_bottom_padding' value="<?php echo $ays_bc_buttons_top_bottom_padding; ?>" style="width: 100px;" />
                                            </div>
                                        </div>
                                    </div>
                                </div>                                
                            </div>
                        </div>
                        <hr>
                        <div class="form-group row">
                            <div class="col-sm-4">
                                <label for="bc_reset_to_default">
                                    <?php echo __('Block content reset styles', 'secure-copy-content-protection') ?>
                                    <a class="ays_help" data-toggle="tooltip"
                                       title="<?php echo __('Reset tooltip styles to default values', 'secure-copy-content-protection') ?>">
                                        <i class="ays_fa ays_fa_info_circle"></i>
                                    </a>
                                </label>
                            </div>
                            <div class="col-sm-8 ays_divider_left">
                                <button type="button" class="ays-button button-secondary"
                                        id="bc_reset_to_default"><?php echo __("Reset", 'secure-copy-content-protection') ?>
                                </button>
                            </div>
                        </div>                       
                    </div>                       
                </div>
            </div>
            <hr/>
            <div class="ays-sccp-settings-form-save-button-wrap ays-sccp-save-button">
    			<?php
    			wp_nonce_field('settings_action', 'settings_action');
                $save_attributes = array(
                    'id' => 'ays-button',
                    'title' => 'Ctrl + s',
                    'data-toggle' => 'tooltip',
                    'data-delay'=> '{"show":"1000"}'
                );
    			submit_button(__('Save changes', 'secure-copy-content-protection'), 'primary ays-button ays-sccp-save-comp', 'ays_submit', false, $save_attributes);
                echo $loader_iamge;
    			?>
            </div>
        </form>
    </div>
</div>