<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://ays-pro.com/
 * @since      1.0.0
 *
 * @package    Secure_Copy_Content_Protection
 * @subpackage Secure_Copy_Content_Protection/admin/partials
 */

if (isset($_GET['sccp_tab'])) {
    $sccp_tab = sanitize_text_field($_GET['sccp_tab']);
} else {
    $sccp_tab = 'tab1';
}

$args = array(
    'public'   => true
);

$all_post_types = get_post_types($args,'objects');
unset($all_post_types['attachment']);

$actions        = new Secure_Copy_Content_Protection_Actions($this->plugin_name);
if (isset($_REQUEST['ays_submit'])) {
    $actions->store_data($_REQUEST);
}

$data = $actions->get_data();
$data_lastIds = $actions->sccp_get_bc_last_id();
$data_lastId = (array) $data_lastIds;

$bc_last_id = $data_lastId['AUTO_INCREMENT'];

$tooltip_padding_top_bottom = isset($data["styles"]["tooltip_padding_top_bottom"]) ? $data["styles"]["tooltip_padding_top_bottom"] : '5';

$tooltip_padding_left_right = isset($data["styles"]["tooltip_padding_left_right"]) ? $data["styles"]["tooltip_padding_left_right"] : '5';

global $wp_roles;
$ays_users_roles = $wp_roles->roles;
$ays_user_guest = array('guest'=>
                    array('name'=>'Guest')
                  );
$ays_users_roles = array_merge($ays_users_roles,$ays_user_guest);
$sccp_bg_image = isset($data["styles"]["bg_image"]) || !empty($data["styles"]["bg_image"]) ? $data["styles"]["bg_image"] : '';

$bg_image_text = __('Add Image', 'secure-copy-content-protection');

// Custom class for tooltip container
$custom_class = (isset($data["styles"]['ays_sccp_custom_class']) && $data["styles"]['ays_sccp_custom_class'] != "") ? sanitize_text_field( $data["styles"]['ays_sccp_custom_class'] ) : '';

$exclude_css_selectors = (isset($data["styles"]['exclude_css_selectors']) && $data["styles"]['exclude_css_selectors'] != "") ? $data["styles"]['exclude_css_selectors'] : '';

$boxshadow_color = (isset($data["styles"]['boxshadow_color']) && $data["styles"]['boxshadow_color'] != "") ? stripslashes( esc_attr( $data["styles"]['boxshadow_color'] ) ) : 'rgba(0,0,0,0)';

//  Box Shadow X offset
$sccp_box_shadow_x_offset = (isset($data["styles"]['sccp_box_shadow_x_offset']) && ( $data["styles"]['sccp_box_shadow_x_offset'] ) != '' && ( $data["styles"]['sccp_box_shadow_x_offset'] ) != 0) ? intval( ( $data["styles"]['sccp_box_shadow_x_offset'] ) ) : 0;

//  Box Shadow Y offset
$sccp_box_shadow_y_offset = (isset($data["styles"]['sccp_box_shadow_y_offset']) && ( $data["styles"]['sccp_box_shadow_y_offset'] ) != '' && ( $data["styles"]['sccp_box_shadow_y_offset'] ) != 0) ? intval( ( $data["styles"]['sccp_box_shadow_y_offset'] ) ) : 0;

//  Box Shadow Z offset
$sccp_box_shadow_z_offset = (isset($data["styles"]['sccp_box_shadow_z_offset']) && ( $data["styles"]['sccp_box_shadow_z_offset'] ) != '' && ( $data["styles"]['sccp_box_shadow_z_offset'] ) != 0) ? intval( ( $data["styles"]['sccp_box_shadow_z_offset'] ) ) : 15;

$box_shadow_offsets = $sccp_box_shadow_x_offset . 'px ' . $sccp_box_shadow_y_offset . 'px ' . $sccp_box_shadow_z_offset . 'px ';

//  Text Shadow X offset
$sccp_text_shadow_x_offset = (isset($data["styles"]['sccp_text_shadow_x_offset']) && ( $data["styles"]['sccp_text_shadow_x_offset'] ) != '' && ( $data["styles"]['sccp_text_shadow_x_offset'] ) != 0) ? intval( ( $data["styles"]['sccp_text_shadow_x_offset'] ) ) : 0;

//  Text Shadow Y offset
$sccp_text_shadow_y_offset = (isset($data["styles"]['sccp_text_shadow_y_offset']) && ( $data["styles"]['sccp_text_shadow_y_offset'] ) != '' && ( $data["styles"]['sccp_text_shadow_y_offset'] ) != 0) ? intval( ( $data["styles"]['sccp_text_shadow_y_offset'] ) ) : 0;

//  Text Shadow Z offset
$sccp_text_shadow_z_offset = (isset($data["styles"]['sccp_text_shadow_z_offset']) && ( $data["styles"]['sccp_text_shadow_z_offset'] ) != '' && ( $data["styles"]['sccp_text_shadow_z_offset'] ) != 0) ? intval( ( $data["styles"]['sccp_text_shadow_z_offset'] ) ) : 15;

$text_shadow_offsets = $sccp_text_shadow_x_offset . 'px ' . $sccp_text_shadow_y_offset . 'px ' . $sccp_text_shadow_z_offset . 'px ';  

$bc_header_text = isset($data["options"]["bc_header_text"]) && !empty($data["options"]["bc_header_text"]) ? stripslashes($data["options"]["bc_header_text"]) : __('You need to Enter right password', 'secure-copy-content-protection');

//Block Content Button Position
$bc_button_position = (isset($data["options"]['sccp_bc_button_position']) && $data["options"]['sccp_bc_button_position'] != '') ? $data["options"]['sccp_bc_button_position'] : 'next-to';

//Subscribe to view Button Position
$sub_block_button_position = (isset($data["options"]['sccp_sub_block_button_position']) && $data["options"]['sccp_sub_block_button_position'] != '') ? $data["options"]['sccp_sub_block_button_position'] : 'next-to';

$subs_to_view_header_text = isset($data["options"]["subs_to_view_header_text"]) && !empty($data["options"]["subs_to_view_header_text"]) ? stripslashes($data["options"]["subs_to_view_header_text"]) : __('Subscribe', 'secure-copy-content-protection');

$disable_js_msg = isset($data["options"]["disable_js_msg"]) && !empty($data["options"]["disable_js_msg"]) ? stripslashes($data["options"]["disable_js_msg"]) : __('Javascript not detected. Javascript required for this site to function. Please enable it in your browser settings and refresh this page.', 'secure-copy-content-protection');

$enable_copyright_text = (isset($data["options"]["enable_copyright_text"]) &&  $data["options"]['enable_copyright_text'] == "on") ? "on" : "off";
$copyright_text = (isset($data["options"]["copyright_text"]) && $data["options"]['copyright_text']  != '') ? $data["options"]["copyright_text"] : "";
$copyright_include_url = (isset($data["options"]["copyright_include_url"]) &&  $data["options"]['copyright_include_url'] == "on") ? "on" : "off";

// Bg image positioning
$tooltip_bg_image_position = (isset($data["styles"]["tooltip_bg_image_position"]) && $data["styles"]["tooltip_bg_image_position"] != '') ? $data["styles"]["tooltip_bg_image_position"] : "center center";

$sccp_message_vars = array(  
    '%%user_first_name%%'               => __("User's First Name", 'secure-copy-content-protection'),
    '%%user_last_name%%'                => __("User's Last Name", 'secure-copy-content-protection'),
    '%%user_wordpress_email%%'          => __("User's WordPress profile email", 'secure-copy-content-protection'),
    '%%user_display_name%%'             => __("User's Display Name", 'secure-copy-content-protection'),
    '%%user_nickname%%'                 => __("User's Nickname", 'secure-copy-content-protection'),
    '%%user_wordpress_roles%%'          => __("User's Wordpress Roles", 'secure-copy-content-protection'),
    '%%user_id%%'                       => __("User's ID", 'secure-copy-content-protection'),
    '%%admin_email%%'                   => __("Admin Email", 'secure-copy-content-protection'),
    '%%admin_email%%'                   => __("Admin Email", 'secure-copy-content-protection'),
    '%%post_author_nickname%%'          => __("Post Author Nickname", 'secure-copy-content-protection'),
    '%%post_author_email%%'             => __("Post Author Email", 'secure-copy-content-protection'),
    '%%post_author_display_name%%'      => __("Post Author Display Name", 'secure-copy-content-protection'),
    '%%post_author_first_name%%'        => __("Post Author First Name", 'secure-copy-content-protection'),
    '%%post_author_last_name%%'         => __("Post Author Last Name", 'secure-copy-content-protection'),
    '%%post_id%%'                       => __("Post ID", 'secure-copy-content-protection'),
    '%%post_title%%'                    => __("Post Title", 'secure-copy-content-protection'),
    '%%current_user_ip%%'               => __("User's IP address", 'secure-copy-content-protection'),    
    '%%current_date%%'                  => __("Current Date", 'secure-copy-content-protection'),    
    '%%current_page_title%%'            => __("Current Page Title", 'secure-copy-content-protection'),
    '%%site_title%%'                    => __("Site Title", 'secure-copy-content-protection'),
);

$sccp_message_vars_html = $this->ays_sccp_generate_message_vars_html( $sccp_message_vars );

$sccp_settings = new Sccp_Settings_Actions($this->plugin_name);

$mailchimp_res = ($sccp_settings->ays_get_setting('mailchimp') === false) ? json_encode(array()) : $sccp_settings->ays_get_setting('mailchimp');
$mailchimp = json_decode($mailchimp_res, true);
$mailchimp_username = isset($mailchimp['username']) ? $mailchimp['username'] : '' ;
$mailchimp_api_key = isset($mailchimp['apiKey']) ? $mailchimp['apiKey'] : '' ;
$mailchimp_lists = $this->ays_get_mailchimp_lists($mailchimp_username, $mailchimp_api_key);

$mailchimp_select = array();
if(isset($mailchimp_lists['total_items']) && $mailchimp_lists['total_items'] > 0){
    foreach($mailchimp_lists['lists'] as $list){
        $mailchimp_select[] = array(
            'listId' => $list['id'],
            'listName' => $list['name']
        );
    }
}else{
    $mailchimp_select = __( "There are no lists", 'secure-copy-content-protection' );
}

// MailChimp
$enable_mailchimp = (isset($data["styles"]['enable_mailchimp']) && $data["styles"]['enable_mailchimp'] == 'on') ? true : false;
$mailchimp_list = (isset($data["styles"]['mailchimp_list'])) ? $data["styles"]['mailchimp_list'] : '';
$block_content_data = array_reverse($data['block_content_data']);

// Copyright word
$sccp_enable_copyright_word     = isset($data["options"]['enable_sccp_copyright_word']) && $data["options"]['enable_sccp_copyright_word'] == 'on' ? "checked" : "";
$sccp_copyright_word            = isset($data["options"]['sccp_copyright_word']) && $data["options"]['sccp_copyright_word'] != '' ? esc_attr($data["options"]['sccp_copyright_word']) : "";

// Mailchimp double opt-in
$sccp_mailchimp_optin           = isset($data["styles"]['sccp_enable_mailchimp_optin']) && $data["styles"]['sccp_enable_mailchimp_optin'] == 'on' ? "checked" : "";

// General Settings | options
$gen_options = ($this->settings_obj->ays_get_setting('options') === false) ? array() : json_decode( stripcslashes($this->settings_obj->ays_get_setting('options') ), true);


// WP Editor height
$sccp_wp_editor_height = (isset($gen_options['sccp_wp_editor_height']) && $gen_options['sccp_wp_editor_height'] != '') ? absint( sanitize_text_field($gen_options['sccp_wp_editor_height']) ) : 150 ;

//Tooltip image object fit 
$sccp_image_object_fit_arr = array(
    'cover'   => 'Cover',
    'contain' => 'Contain',
    'unset'   => 'Unset',
);

$tooltip_bg_image_object_fit = (isset($data["styles"]["tooltip_bg_image_object_fit"]) && $data["styles"]["tooltip_bg_image_object_fit"] != '') ? $data["styles"]["tooltip_bg_image_object_fit"] : "cover";

// Background gradient
$data["styles"]['enable_background_gradient'] = (!isset($data["styles"]['enable_background_gradient'])) ? 'off' : $data["styles"]['enable_background_gradient'];
$enable_background_gradient = (isset($data["styles"]['enable_background_gradient']) && $data["styles"]['enable_background_gradient'] == 'on') ? true : false;
$background_gradient_color_1 = (isset($data["styles"]['background_gradient_color_1']) && $data["styles"]['background_gradient_color_1'] != '') ? stripslashes( esc_attr(  $data["styles"]['background_gradient_color_1'] ) ) : '#000';
$background_gradient_color_2 = (isset($data["styles"]['background_gradient_color_2']) && $data["styles"]['background_gradient_color_2'] != '') ? stripslashes( esc_attr(  $data["styles"]['background_gradient_color_2'] ) ) : '#fff';
$sccp_gradient_direction = (isset($data["styles"]['sccp_gradient_direction']) && $data["styles"]['sccp_gradient_direction'] != '') ? $data["styles"]['sccp_gradient_direction'] : 'vertical';


// Title text shadow
$data["styles"]['enable_sccp_title_text_shadow'] = (isset($data["styles"]['enable_sccp_title_text_shadow']) && $data["styles"]['enable_sccp_title_text_shadow'] == 'on') ? 'on' : 'off'; 
$enable_sccp_title_text_shadow = (isset($data["styles"]['enable_sccp_title_text_shadow']) && $data["styles"]['enable_sccp_title_text_shadow'] == 'on') ? true : false; 
$sccp_title_text_shadow = (isset($data["styles"]['sccp_title_text_shadow']) && $data["styles"]['sccp_title_text_shadow'] != '') ? stripslashes( esc_attr( $data["styles"]['sccp_title_text_shadow'] ) ) : 'rgba(255,255,255,0)';
if($enable_sccp_title_text_shadow){
    $tooltip_title_shadow = 'text-shadow: '. $text_shadow_offsets .' '.$sccp_title_text_shadow;
}else{
    $tooltip_title_shadow = 'text-shadow: unset';
}

// Tooltip text transformation
$tooltip_text_transformation = (isset($data["styles"]['tooltip_text_transformation']) && sanitize_text_field($data["styles"]['tooltip_text_transformation']) != "") ? sanitize_text_field($data["styles"]['tooltip_text_transformation']) : 'none';

// Font size | On Desktop
$font_size = (isset($data["styles"]['font_size']) && sanitize_text_field($data["styles"]['font_size']) != "") ? absint( sanitize_text_field($data["styles"]['font_size']) ) : 12;
// Font size | On mobile
$mobile_font_size = (isset($data["styles"]['mobile_font_size']) && sanitize_text_field($data["styles"]['mobile_font_size']) != '') ? absint( sanitize_text_field($data["styles"]['mobile_font_size']) ) : 12;

// Tooltip background blur
$tooltip_bg_blur = (isset($data["styles"]['bg_blur']) && sanitize_text_field($data["styles"]['bg_blur']) != "") ? absint( sanitize_text_field($data["styles"]['bg_blur']) ) : 0;

$loader_iamge = "<span class='ays_display_none ays_sccp_loader_box'><img src='". SCCP_ADMIN_URL ."/images/loaders/loading.gif'></span>";

// Tooltip letter spacing
$tooltip_letter_spacing = (isset($data["styles"][ 'letter_spacing' ]) && $data["styles"][ 'letter_spacing' ] != '') ? stripslashes ( absint( $data["styles"][ 'letter_spacing' ] ) ) : 0;

$sccp_accordion_svg_html = '
<div class="ays-sccp-accordion-arrow-box">
    <svg class="ays-sccp-accordion-arrow ays-sccp-accordion-arrow-down" version="1.2" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" overflow="visible" preserveAspectRatio="none" viewBox="0 0 24 24" width="32" height="32">
        <g>
            <path xmlns:default="http://www.w3.org/2000/svg" d="M8.59 16.34l4.58-4.59-4.58-4.59L10 5.75l6 6-6 6z" fill="#008cff" vector-effect="non-scaling-stroke" />
        </g>
    </svg>
</div>';

$if_dismiss_cookie_exists = (isset( $_COOKIE['ays_sccp_fox_lms_pages_popup_dismiss_for_three_click'] ) && $_COOKIE['ays_sccp_fox_lms_pages_popup_dismiss_for_three_click'] >= 3) ? true : false;

$if_fox_lms_plugin_exists = ( in_array('fox-lms/fox-lms.php', apply_filters('active_plugins', get_option('active_plugins'))) ) ? true : false;

$if_fox_lms_plugin_installed_flag = get_option('ays_sccp_and_fox_lms_plugin_flag');

if ( !$if_fox_lms_plugin_installed_flag ) {
    update_option('ays_sccp_and_fox_lms_plugin_flag', 0);
}

if ( $if_fox_lms_plugin_exists ) {
    update_option('ays_sccp_and_fox_lms_plugin_flag', 1);
}

$if_fox_lms_plugin_installed_flag = get_option('ays_sccp_and_fox_lms_plugin_flag');

?>
<div class="wrap">
    <div class="ays-sccp-heading-box">
        <div class="ays-sccp-wordpress-user-manual-box">            
            <a href="https://ays-pro.com/wordpress-copy-content-protection-user-manual" target="_blank" style="text-decoration: none;font-size: 13px;">
                <i class="ays_fa ays_fa_file_text"></i>
                <span style="margin-left: 3px;text-decoration: underline;"><?php echo esc_html__("View Documentation", 'secure-copy-content-protection'); ?></span>
            </a>
        </div>
    </div>
    <div class="copy_protection_wrap container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <form autocomplete="off" method="post" enctype="multipart/form-data" id="ays_sccp_form">
                    <input type="hidden" class="sccp_wp_editor_height" value="<?php echo $sccp_wp_editor_height; ?>">
                    <h1 class="wp-heading-inline">
                        <?php echo  esc_html(get_admin_page_title()); ?>                        
                    </h1>
                    <?php
                        if (isset($_REQUEST['status'])) {
                            $actions->sccp_protection_notices();
                        }
                    ?>
                    <div class="ays-sccp-save-button">
                        <?php
                        $save_attributes = array(
                            'id' => 'ays-button-top',
                            'title' => 'Ctrl + s',
                            'data-toggle' => 'tooltip',
                            'data-delay'=> '{"show":"1000"}'
                        );
                        submit_button(__('Save changes', 'secure-copy-content-protection'), 'primary ays-button ays-sccp-save-comp', 'ays_submit', false, $save_attributes);
                        echo $loader_iamge;
                        ?>
                    </div>
                    <hr>
                    <input type="hidden" name="sccp_tab" value="<?php echo  htmlentities($sccp_tab); ?>">
                    <?php
                    wp_nonce_field('sccp_action', 'sccp_action');
                    ?>
                    <div class="ays-top-menu-wrapper">
                        <div class="ays_menu_left" data-scroll="0"><i class="ays_fa ays_fa_angle_left"></i></div>
                        <div class="ays-top-menu">
                            <div class="nav-tab-wrapper ays-top-tab-wrapper">
                                <a href="#tab1" data-tab="tab1"
                                class="nav-tab <?php echo  ($sccp_tab == 'tab1') ? 'nav-tab-active' : ''; ?>">
                                    <?php echo  esc_html__('General', 'secure-copy-content-protection'); ?>
                                </a>
                                <a href="#tab2" data-tab="tab2"
                                class="nav-tab <?php echo  ($sccp_tab == 'tab2') ? 'nav-tab-active' : ''; ?>">
                                    <?php echo  esc_html__('Options', 'secure-copy-content-protection'); ?>
                                </a>
                                <a href="#tab5" data-tab="tab5"
                                class="nav-tab <?php echo  ($sccp_tab == 'tab5') ? 'nav-tab-active' : ''; ?>">
                                    <?php echo  esc_html__('Styles', 'secure-copy-content-protection'); ?>
                                </a>
                                <a href="#tab8" data-tab="tab8"
                                class="nav-tab <?php echo  ($sccp_tab == 'tab8') ? 'nav-tab-active' : ''; ?>">
                                    <?php echo  esc_html__('Block Content', 'secure-copy-content-protection'); ?>
                                </a>
                                <a href="#tab3" data-tab="tab3"
                                class="nav-tab <?php echo  ($sccp_tab == 'tab3') ? 'nav-tab-active' : ''; ?>">
                                    <?php echo  esc_html__('Block IPs', 'secure-copy-content-protection'); ?>
                                </a>
                                <a href="#tab4" data-tab="tab4"
                                class="nav-tab <?php echo  ($sccp_tab == 'tab4') ? 'nav-tab-active' : ''; ?>">
                                    <?php echo  esc_html__('Block Country', 'secure-copy-content-protection'); ?>
                                </a>
                                <a href="#tab6" data-tab="tab6"
                                class="nav-tab <?php echo  ($sccp_tab == 'tab6') ? 'nav-tab-active' : ''; ?>">
                                    <?php echo  esc_html__('Page Blocker', 'secure-copy-content-protection'); ?>
                                </a>
                                <a href="#tab7" data-tab="tab7"
                                class="nav-tab <?php echo  ($sccp_tab == 'tab7') ? 'nav-tab-active' : ''; ?>">
                                    <?php echo  esc_html__('PayPal', 'secure-copy-content-protection'); ?>
                                </a>
                                <a href="#tab9" data-tab="tab9"
                                class="nav-tab <?php echo  ($sccp_tab == 'tab9') ? 'nav-tab-active' : ''; ?>">
                                    <?php echo  esc_html__('Integrations', 'secure-copy-content-protection'); ?>
                                </a>
                            </div>
                        </div>
                        <div class="ays_menu_right" data-scroll="-1"><i class="ays_fa ays_fa_angle_right"></i></div>
                    </div>

                    <div id="tab1" class="nav-tab-content <?php echo  ($sccp_tab == 'tab1') ? 'nav-tab-content-active' : ''; ?>">
                        <div class="copy_protection_header">
                            <h5><?php echo  esc_html__("General", 'secure-copy-content-protection'); ?></h5>
                        </div>
                        <hr>
                        <div class="copy_protection_container form-group row">
                            <div class="col-sm-4">
                                <label for="sccp_enable_all_posts"><?php echo  esc_html__("Enable copy protection in all post types", 'secure-copy-content-protection'); ?></label>
                                <a class="ays_help" data-toggle="tooltip"
                                   title="<?php echo  esc_attr__('Enable Options category of the plugin', 'secure-copy-content-protection') ?>">
                                    <i class="ays_fa ays_fa_info_circle"></i>
                                </a>
                            </div>
                            <div class="col-sm-8">
                                <input type="checkbox" class="modern-checkbox" id="sccp_enable_all_posts"
                                       name="sccp_enable_all_posts" <?php echo  $data["enable_protection"]; ?>
                                       value="true">
                                <label for="sccp_enable_all_posts"></label>
                            </div>
                        </div>
                        <hr>
                        <div class="copy_protection_container form-group row">
                            <div class="col-sm-4">
                                <label for="sccp_post_types"><?php echo  esc_html__("Except this", 'secure-copy-content-protection'); ?></label>
                                <a class="ays_help" data-toggle="tooltip"
                                   title="<?php echo  esc_attr__('Disable copy paste option for the website, except selected post types', 'secure-copy-content-protection') ?>">
                                    <i class="ays_fa ays_fa_info_circle"></i>
                                </a>
                            </div>
                            <div class="col-sm-8">
                                <select name="sccp_except_post_types[]" id="sccp_post_types" class="form-control"
                                        multiple="multiple">
                                    <?php
                                    foreach ( $all_post_types as $post_type ) {
                                        $checked = (in_array($post_type->name, isset($data["except_types"]) ? $data["except_types"] : array())) ? "selected" : "";
                                        echo "<option value='{$post_type->name}' {$checked}>{$post_type->label}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <hr>
                        <div class="copy_protection_container form-group row">
                            <div class="col-sm-4">
                                <label for="sccp_enable_text_selecting"><?php echo  esc_html__("Enable text selecting", 'secure-copy-content-protection'); ?></label>
                                <a class="ays_help" data-toggle="tooltip"
                                   title="<?php echo  esc_attr__('Enable text selecting. This option will work only on desktop, on mobile devices text selecting is always disabled.', 'secure-copy-content-protection') ?>">
                                    <i class="ays_fa ays_fa_info_circle"></i>
                                </a>
                            </div>
                            <div class="col-sm-8">
                                <input type="checkbox" class="modern-checkbox" id="sccp_enable_text_selecting"
                                       name="sccp_enable_text_selecting" <?php echo  isset($data["options"]["enable_text_selecting"]) ? $data["options"]["enable_text_selecting"] : "" ?>
                                       value="true">
                                <label for="sccp_enable_text_selecting"></label>
                            </div>
                        </div>
                        <hr>
                        <div class="copy_protection_container form-group row ays-sccp-desc-message-vars-parent">
                            <div class="col-sm-4">
                                <label for="sccp_notification_text"><?php echo  esc_html__("Notification text", 'secure-copy-content-protection'); ?></label>
                                <a class="ays_help" data-toggle="tooltip"
                                   title="<?php echo  esc_attr__('The warning text that appears after copy attempt. You can use Variables (General Settings) to insert user data here.', 'secure-copy-content-protection') ?>">
                                    <i class="ays_fa ays_fa_info_circle"></i>
                                </a>
                                <p class="ays_sccp_small_hint_text_for_message_variables">
                                    <span><?php echo esc_html__( "To see all Message Variables " , 'secure-copy-content-protection' ); ?></span>
                                    <a href="?page=secure-copy-content-protection-settings&ays_sccp_tab=tab3" target="_blank"><?php echo esc_html__( "click here" , 'secure-copy-content-protection' ); ?></a>
                                </p>
                            </div>
                            <div class="col-sm-8">
                                <?php
                                echo $sccp_message_vars_html;
                                $content   = stripslashes(wpautop($data["protection_text"]));
                                $editor_id = 'sccp_notification_text';
                                $settings = array(
                                    'editor_height' => $sccp_wp_editor_height,
                                    'editor_class' => 'ays-textarea', 
                                    'media_buttons' => true
                                );
                                wp_editor($content, $editor_id, $settings);
                                ?>
                            </div>
                        </div>
                        <hr>
                        <div class="copy_protection_container form-group row">
                            <div class="col-sm-4">
                                <label for="sccp_upload_audio"><?php echo  esc_html__("Upload Audio", 'secure-copy-content-protection'); ?></label>
                                <a class="ays_help" data-toggle="tooltip"
                                   title="<?php echo  esc_attr__('The audio that plays after copy attempt', 'secure-copy-content-protection') ?>">
                                    <i class="ays_fa ays_fa_info_circle"></i>
                                </a>
                            </div>
                            <div class="col-sm-3">
                                <a href="javascript:void(0)" class="btn btn-primary upload_audio"><?php echo  esc_html__("Upload Audio", 'secure-copy-content-protection'); ?></a>
                            </div>
                            <div class="col-sm-5">
                                <div class="sccp_upload_audio">
                                    <?php if (isset($data['audio']) && !empty($data['audio'])) { ?>
                                        <audio id="sccp_audio" controls>
                                            <source src="<?php echo  (isset($data['audio']) && !empty($data['audio'])) ? esc_url( $data['audio'] ) : ""; ?>"
                                                    type="audio/mpeg">
                                        </audio>
                                        <button type="button" class="close ays_close" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    <?php } ?>
                                </div>
                                <input type="hidden" class="upload_audio_url" name="upload_audio_url"
                                       value="<?php echo  (isset($data['audio']) && !empty($data['audio'])) ? esc_url( $data['audio'] ) : ""; ?>">
                            </div>
                        </div>
                        <hr>
                        <div class="copy_protection_container form-group row">
                            <div class="col-sm-4">
                                <label for="sccp_exclude_inp_textarea"><?php echo  esc_html__("Exclude input and textarea", 'secure-copy-content-protection'); ?></label>
                                <a class="ays_help" data-toggle="tooltip"
                                   title="<?php echo  esc_attr__('This option will exclude input and textarea', 'secure-copy-content-protection') ?>">
                                    <i class="ays_fa ays_fa_info_circle"></i>
                                </a>
                            </div>
                            <div class="col-sm-3">
                                <input type="checkbox" class="modern-checkbox-options exclude_inp_textarea"
                                       id="sccp_exclude_inp_textarea"
                                       name="sccp_exclude_inp_textarea" <?php echo  isset($data["options"]["exclude_inp_textarea"]) ? $data["options"]["exclude_inp_textarea"] : ''; ?>
                                       value="true">
                            </div>
                            <div class="col-sm-5"></div>
                        </div>
                        <hr>
                        <div class="copy_protection_container form-group row">
                            <div class="col-sm-4">
                                <label for="sccp_exclude_css_selector"><?php echo  esc_html__("Exclude certain CSS selector", 'secure-copy-content-protection'); ?></label>
                                <a class="ays_help" data-toggle="tooltip"
                                   title="<?php echo esc_attr__('Add your preferred CSS selector(s) and they will not be protected by the plugin.', 'secure-copy-content-protection') ?>">
                                    <i class="ays_fa ays_fa_info_circle"></i>
                                </a>
                            </div>
                            <div class="col-sm-1">
                                <input type="checkbox" class="modern-checkbox-options sccp_exclude_css_selector"
                                       id="sccp_exclude_css_selector"
                                       name="sccp_exclude_css_selector" <?php echo  isset($data["options"]["exclude_css_selector"]) ? $data["options"]["exclude_css_selector"] : ''; ?>
                                       value="true">
                            </div>
                            <div class="col-sm-7 if-ays-sccp-hide-css-input" <?php echo isset($data["options"]["exclude_css_selector"]) ? '' : 'style="display: none;"'; ?>>                                
                                <input type="text" class="ays-text-input" name="ays_sccp_exclude_css_selectors" id="ays_sccp_exclude_css_selectors" placeholder=".myClass, #myId, .myAnotherClass, ..." value="<?php echo $exclude_css_selectors; ?>">
                                
                            </div>
                        </div>
                        <hr>
                        <div class="copy_protection_container form-group row">
                            <div class="col-sm-4">
                                <label for="sccp_disable_sup_admin"><?php echo  esc_html__("Disable Copy Protection for Super admin", 'secure-copy-content-protection'); ?></label>
                                <a class="ays_help" data-toggle="tooltip"
                                   title="<?php echo  esc_attr__('In case of activating this option the super admin will not be able to use the plugin. Note: This option is disabled by default.', 'secure-copy-content-protection') ?>">
                                    <i class="ays_fa ays_fa_info_circle"></i>
                                </a>
                            </div>
                            <div class="col-sm-3">
                                <input type="checkbox" class="modern-checkbox-options disable_sup_admin"
                                       id="sccp_disable_sup_admin"
                                       name="sccp_disable_sup_admin" <?php echo  isset($data["options"]["disable_sup_admin"]) ? $data["options"]["disable_sup_admin"] : ''; ?>
                                       value="false">
                            </div>
                            <div class="col-sm-5"></div>
                        </div>
                        <hr>
                        <div class="sccp_pro only_pro" title="<?php echo  esc_attr__('This feature will available in PRO version', 'secure-copy-content-protection'); ?>">
                            <div class="pro_features sccp_general_pro">
                                <div>                                    
                                    <a href="https://ays-pro.com/wordpress/secure-copy-content-protection/" target="_blank" class="ays-sccp-new-upgrade-button-link">
                                        <div class="ays-sccp-new-upgrade-button-box">
                                            <div>
                                                <img src="<?php echo SCCP_ADMIN_URL.'/images/icons/sccp_locked_24x24.svg'?>">
                                                <img src="<?php echo SCCP_ADMIN_URL.'/images/icons/sccp_unlocked_24x24.svg'?>" class="ays-sccp-new-upgrade-button-hover">
                                            </div>
                                            <div class="ays-sccp-new-upgrade-button"><?php echo esc_html__("Upgrade", 'secure-copy-content-protection'); ?></div>
                                        </div>
                                    </a>
                                    <div class="ays-sccp-center-big-main-button-box ays-sccp-new-big-button-flex">
                                        <div class="ays-sccp-center-big-upgrade-button-box">
                                            <a href="https://ays-pro.com/wordpress/secure-copy-content-protection/" target="_blank" class="ays-sccp-new-upgrade-button-link">
                                                <div class="ays-sccp-center-new-big-upgrade-button">
                                                    <img src="<?php echo SCCP_ADMIN_URL.'/images/icons/sccp_locked_24x24.svg'?>" class="ays-sccp-new-button-img-hide">
                                                    <img src="<?php echo SCCP_ADMIN_URL.'/images/icons/sccp_unlocked_24x24.svg'?>" class="ays-sccp-new-upgrade-button-hover">  
                                                    <?php echo esc_html__("Upgrade", 'secure-copy-content-protection'); ?>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="pro_features_img">
                                <img src="<?php echo SCCP_ADMIN_URL . '/images/features/pro_version.PNG'; ?>">
                            </div>
                        </div>
                    </div>
                    <div id="tab2" class="nav-tab-content <?php echo  ($sccp_tab == 'tab2') ? 'nav-tab-content-active' : ''; ?>">
                        <div class="ays-sccp-accordion-options-main-container" data-collapsed="false">
                            <div class="ays-sccp-accordion-container">
                                <?php echo $sccp_accordion_svg_html; ?>
                                <p class="ays-subtitle" style="margin-top:0;"><?php echo esc_html__( 'Primary', 'secure-copy-content-protection' ); ?></p>
                            </div>
                            <hr class="ays-sccp-bolder-hr"/>
                            <div class="ays-sccp-accordion-options-box">
                                <div class="copy_protection_header row">
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-2">
                                       <label for="sccp_select_all"><h5><?php echo  esc_html__("ON/OFF", 'secure-copy-content-protection'); ?></h5></label> 
                                    </div>
                                    <div class="col-sm-2">
                                        <label for="sccp_select_all_mess"><h5><?php echo  esc_html__("Show Message", 'secure-copy-content-protection'); ?></h5></label>
                                    </div>
                                    <div class="col-sm-2">
                                        <label for="sccp_select_all_audio"><h5><?php echo  esc_html__("Play Audio", 'secure-copy-content-protection'); ?></h5></label> 
                                    </div>
                                    <div class="col-sm-3"></div>
                                </div>

                                <div class="copy_protection_container form-group row">
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-2">
                                        <input type="checkbox" class="modern-checkbox-options ays_all"
                                               id="sccp_select_all"
                                               name="sccp_select_all" <?php echo  isset($data["options"]["select_all"]) ? $data["options"]["select_all"] : ''; ?>
                                               value="true">
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="checkbox" class="modern-checkbox ays_all_mess"
                                               id="sccp_select_all_mess"
                                               name="sccp_select_all_mess" <?php echo  isset($data["options"]["select_all_mess"]) ? $data["options"]["select_all_mess"] : ""; ?>
                                               value="true">                                
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="checkbox" class="modern-checkbox ays_all_audio"
                                               id="sccp_select_all_audio"
                                               name="sccp_select_all_audio" <?php echo  isset($data["options"]["select_all_audio"]) ? $data["options"]["select_all_audio"] : ''; ?>
                                               value="true">                                
                                    </div>
                                    <div class="col-sm-3"></div>
                                </div>       

                                <hr>
                                <div class="copy_protection_container form-group row">
                                    <div class="col-sm-3">
                                        <label for="sccp_enable_context_menu"><?php echo  esc_html__("Disable right click", 'secure-copy-content-protection'); ?></label>
                                        <a class="ays_help" data-toggle="tooltip"
                                           title="<?php echo  esc_attr__('Right click is not allowed', 'secure-copy-content-protection') ?>">
                                            <i class="ays_fa ays_fa_info_circle"></i>
                                        </a>
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="checkbox" class="modern-checkbox-options right"
                                               id="sccp_enable_context_menu"
                                               name="sccp_enable_context_menu" <?php echo  isset($data["options"]["context_menu"]) ? $data["options"]["context_menu"] : 'checked'; ?>
                                               value="true">
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="checkbox" class="modern-checkbox modern_checkbox_mess right-mess"
                                               id="sccp_enable_context_menu_mess"
                                               name="sccp_enable_context_menu_mess" <?php echo  isset($data["options"]["context_menu_mess"]) ? $data["options"]["context_menu_mess"] : "checked"; ?>
                                               value="true">
                                        <label for="sccp_enable_context_menu_mess"></label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="checkbox" class="modern-checkbox modern_checkbox_audio right-audio"
                                               id="sccp_enable_right_click_audio"
                                               name="sccp_enable_right_click_audio" <?php echo  isset($data["options"]["right_click_audio"]) ? $data["options"]["right_click_audio"] : ''; ?>
                                               value="true">
                                        <label for="sccp_enable_right_click_audio"></label>
                                    </div>
                                    <div class="col-sm-3"></div>
                                </div>
                                <hr>
                                <div class="copy_protection_container form-group row">
                                    <div class="col-sm-3">
                                        <label for="sccp_disabled_rclick_img"><?php echo  esc_html__("Disable right click for images", 'secure-copy-content-protection'); ?></label>
                                        <a class="ays_help" data-toggle="tooltip"
                                           title="<?php echo  esc_attr__('By enabling the option, the right-click for the images will be not allowed in the copy protection enabled areas on the website.', 'secure-copy-content-protection') ?>">
                                            <i class="ays_fa ays_fa_info_circle"></i>
                                        </a>
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="checkbox" class="modern-checkbox-options right_img"
                                               id="sccp_disabled_rclick_img"
                                               name="sccp_disabled_rclick_img" <?php echo  isset($data["options"]["rclick_img"]) ? $data["options"]["rclick_img"] : 'checked'; ?>
                                               value="true">
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="checkbox" class="modern-checkbox modern_checkbox_mess right_img-mess"
                                               id="sccp_disabled_rclick_img_mess"
                                               name="sccp_disabled_rclick_img_mess" <?php echo  isset($data["options"]["rclick_img_mess"]) ? $data["options"]["rclick_img_mess"] : "checked"; ?>
                                               value="true">
                                        <label for="sccp_enable_context_menu_mess"></label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="checkbox" class="modern-checkbox modern_checkbox_audio right_img-audio"
                                               id="sccp_disabled_rclick_img_audio"
                                               name="sccp_disabled_rclick_img_audio" <?php echo  isset($data["options"]["rclick_img_audio"]) ? $data["options"]["rclick_img_audio"] : ''; ?>
                                               value="true">
                                        <label for="sccp_enable_right_click_audio"></label>
                                    </div>
                                    <div class="col-sm-3"></div>
                                </div>
                                <hr>
                                <div class="copy_protection_container form-group row">
                                    <div class="col-sm-3">
                                        <label for="sccp_disabled_rclick_link"><?php echo  esc_html__("Disable right click for links", 'secure-copy-content-protection'); ?></label>
                                        <a class="ays_help" data-toggle="tooltip"
                                           title="<?php echo  esc_attr__('By enabling the option, the right-click for the links will be not allowed in the copy protection enabled areas on the website.', 'secure-copy-content-protection') ?>">
                                            <i class="ays_fa ays_fa_info_circle"></i>
                                        </a>
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="checkbox" class="modern-checkbox-options right_link"
                                               id="sccp_disabled_rclick_link"
                                               name="sccp_disabled_rclick_link" <?php echo  isset($data["options"]["rclick_link"]) ? $data["options"]["rclick_link"] : 'checked'; ?>
                                               value="true">
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="checkbox" class="modern-checkbox modern_checkbox_mess right_link-mess"
                                               id="sccp_disabled_rclick_link_mess"
                                               name="sccp_disabled_rclick_link_mess" <?php echo  isset($data["options"]["rclick_link_mess"]) ? $data["options"]["rclick_link_mess"] : "checked"; ?>
                                               value="true">
                                        <label for="sccp_enable_context_menu_mess"></label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="checkbox" class="modern-checkbox modern_checkbox_audio right_link-audio"
                                               id="sccp_disabled_rclick_link_audio"
                                               name="sccp_disabled_rclick_link_audio" <?php echo  isset($data["options"]["rclick_link_audio"]) ? $data["options"]["rclick_link_audio"] : ''; ?>
                                               value="true">
                                        <label for="sccp_enable_right_click_audio"></label>
                                    </div>
                                    <div class="col-sm-3"></div>
                                </div>
                                <hr>
                                <div class="copy_protection_container form-group row">
                                    <div class="col-sm-3">
                                        <label for="sccp_enable_developer_tools"><?php echo  esc_html__("Disable Developer Tools Hot-keys", 'secure-copy-content-protection'); ?></label>
                                        <a class="ays_help" data-toggle="tooltip"
                                           title="<?php echo  esc_attr__('Not allowed to open developer tools by CTRL+SHIFT+C/CMD+OPT+C, CTRL+SHIFT+J/CMD+OPT+J, CTRL+SHIFT+I/CMD+OPT+I', 'secure-copy-content-protection') ?>">
                                            <i class="ays_fa ays_fa_info_circle"></i>
                                        </a>
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="checkbox" class="modern-checkbox-options devtool"
                                               id="sccp_enable_developer_tools"
                                               name="sccp_enable_developer_tools" <?php echo  isset($data["options"]["developer_tools"]) ? $data["options"]["developer_tools"] : 'checked'; ?>
                                               value="true">
                                        <label for="sccp_enable_developer_tools"></label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="checkbox" class="modern-checkbox modern_checkbox_mess devtool-mess"
                                               id="sccp_enable_developer_tools_mess"
                                               name="sccp_enable_developer_tools_mess" <?php echo  isset($data["options"]["developer_tools_mess"]) ? $data["options"]["developer_tools_mess"] : 'checked'; ?>
                                               value="true">
                                        <label for="sccp_enable_developer_tools_mess"></label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="checkbox" class="modern-checkbox modern_checkbox_audio devtool-audio"
                                               id="sccp_enable_developer_tools_audio"
                                               name="sccp_enable_developer_tools_audio" <?php echo  isset($data["options"]["developer_tools_audio"]) ? $data["options"]["developer_tools_audio"] : ''; ?>
                                               value="true">
                                        <label for="sccp_enable_developer_tools_audio"></label>
                                    </div>
                                    <div class="col-sm-3"></div>
                                </div>
                                <hr>
                                <div class="copy_protection_container form-group row">
                                    <div class="col-sm-3">
                                        <label for="sccp_enable_drag_start"><?php echo  esc_html__("Disable Drag & Drop", 'secure-copy-content-protection'); ?></label>
                                        <a class="ays_help" data-toggle="tooltip"
                                           title="<?php echo  esc_attr__('By enabling this option, the dragging of the texts and images will be not allowed in the copy protection enabled areas on the website.', 'secure-copy-content-protection') ?>">
                                            <i class="ays_fa ays_fa_info_circle"></i>
                                        </a>
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="checkbox" class="modern-checkbox-options dragstart"
                                               id="sccp_enable_drag_start"
                                               name="sccp_enable_drag_start" <?php echo  isset($data["options"]["drag_start"]) ? $data["options"]["drag_start"] : 'checked'; ?>
                                               value="true">
                                        <label for="sccp_enable_drag_start"></label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="checkbox" class="modern-checkbox modern_checkbox_mess dragstart-mess"
                                               id="sccp_enable_drag_start_mess"
                                               name="sccp_enable_drag_start_mess" <?php echo  isset($data["options"]["drag_start_mess"]) ? $data["options"]["drag_start_mess"] : 'checked'; ?>
                                               value="true">
                                        <label for="sccp_enable_drag_start_mess"></label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="checkbox" class="modern-checkbox modern_checkbox_audio dragstart-audio"
                                               id="sccp_enable_drag_start_audio"
                                               name="sccp_enable_drag_start_audio" <?php echo  isset($data["options"]["drag_start_audio"]) ? $data["options"]["drag_start_audio"] : ''; ?>
                                               value="true">
                                        <label for="sccp_enable_drag_start_audio"></label>
                                    </div>
                                    <div class="col-sm-3"></div>
                                </div>                        
                                <hr>
                                <div class="copy_protection_container form-group row">
                                    <div class="col-sm-3">
                                        <label for="sccp_enable_f12"><?php echo  esc_html__("Disable F12", 'secure-copy-content-protection'); ?></label>
                                        <a class="ays_help" data-toggle="tooltip"
                                           title="<?php echo  esc_attr__('Inspect element is not available to open by F12', 'secure-copy-content-protection') ?>">
                                            <i class="ays_fa ays_fa_info_circle"></i>
                                        </a>
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="checkbox" class="modern-checkbox-options f12" id="sccp_enable_f12"
                                               name="sccp_enable_f12" <?php echo  isset($data["options"]["f12"]) ? $data["options"]["f12"] : 'checked'; ?>
                                               value="true">
                                        <label for="sccp_enable_f12"></label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="checkbox" class="modern-checkbox modern_checkbox_mess f12-mess" id="sccp_enable_f12_mess"
                                               name="sccp_enable_f12_mess" <?php echo  isset($data["options"]["f12_mess"]) ? $data["options"]["f12_mess"] : 'checked'; ?>
                                               value="true">
                                        <label for="sccp_enable_f12_mess"></label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="checkbox" class="modern-checkbox modern_checkbox_audio f12-audio" id="sccp_enable_f12_audio"
                                               name="sccp_enable_f12_audio" <?php echo  isset($data["options"]["f12_audio"]) ? $data["options"]["f12_audio"] : ''; ?>
                                               value="true">
                                        <label for="sccp_enable_f12_audio"></label>
                                    </div>
                                    <div class="col-sm-3"></div>
                                </div>
                                <hr>
                                <div class="copy_protection_container form-group row">
                                    <div class="col-sm-3">
                                        <label for="sccp_enable_ctrlc"><?php echo  esc_html__("Disable CTRL-C/CMD-C", 'secure-copy-content-protection'); ?></label>
                                        <a class="ays_help" data-toggle="tooltip"
                                           title="<?php echo  esc_attr__('Not allowed to copy the highlighted text', 'secure-copy-content-protection') ?>">
                                            <i class="ays_fa ays_fa_info_circle"></i>
                                        </a>
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="checkbox" class="modern-checkbox-options ctrlc" id="sccp_enable_ctrlc"
                                               name="sccp_enable_ctrlc" <?php echo  isset($data["options"]["ctrlc"]) ? $data["options"]["ctrlc"] : 'checked'; ?>
                                               value="true">
                                        <label for="sccp_enable_ctrlc"></label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="checkbox" class="modern-checkbox modern_checkbox_mess ctrlc-mess" id="sccp_enable_ctrlc_mess"
                                               name="sccp_enable_ctrlc_mess" <?php echo  isset($data["options"]["ctrlc_mess"]) ? $data["options"]["ctrlc_mess"] : 'checked'; ?>
                                               value="true">
                                        <label for="sccp_enable_ctrlc_mess"></label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="checkbox" class="modern-checkbox modern_checkbox_audio ctrlc-audio" id="sccp_enable_ctrlc_audio"
                                               name="sccp_enable_ctrlc_audio" <?php echo  isset($data["options"]["ctrlc_audio"]) ? $data["options"]["ctrlc_audio"] : ''; ?>
                                               value="true">
                                        <label for="sccp_enable_ctrlc_audio"></label>
                                    </div>
                                    <div class="col-sm-3"></div>
                                </div>
                                <hr>
                                <div class="copy_protection_container form-group row">
                                    <div class="col-sm-3">
                                        <label for="sccp_enable_ctrlv"><?php echo  esc_html__("Disable CTRL-V/CMD-V", 'secure-copy-content-protection'); ?></label>
                                        <a class="ays_help" data-toggle="tooltip"
                                           title="<?php echo  esc_attr__('Not allowed to paste the highlighted text', 'secure-copy-content-protection') ?>">
                                            <i class="ays_fa ays_fa_info_circle"></i>
                                        </a>
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="checkbox" class="modern-checkbox-options ctrlv" id="sccp_enable_ctrlv"
                                               name="sccp_enable_ctrlv" <?php echo  isset($data["options"]["ctrlv"]) ? $data["options"]["ctrlv"] : 'checked'; ?>
                                               value="true">
                                        <label for="sccp_enable_ctrlv"></label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="checkbox" class="modern-checkbox modern_checkbox_mess ctrlv-mess" id="sccp_enable_ctrlv_mess"
                                               name="sccp_enable_ctrlv_mess" <?php echo  isset($data["options"]["ctrlv_mess"]) ? $data["options"]["ctrlv_mess"] : 'checked'; ?>
                                               value="true">
                                        <label for="sccp_enable_ctrlv_mess"></label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="checkbox" class="modern-checkbox modern_checkbox_audio ctrlv-audio" id="sccp_enable_ctrlv_audio"
                                               name="sccp_enable_ctrlv_audio" <?php echo  isset($data["options"]["ctrlv_audio"]) ? $data["options"]["ctrlv_audio"] : ''; ?>
                                               value="true">
                                        <label for="sccp_enable_ctrlv_audio"></label>
                                    </div>
                                    <div class="col-sm-3"></div>
                                </div>
                                <hr>
                                <div class="copy_protection_container form-group row">
                                    <div class="col-sm-3">
                                        <label for="sccp_enable_ctrls"><?php echo  esc_html__("Disable CTRL-S/CMD-S", 'secure-copy-content-protection'); ?></label>
                                        <a class="ays_help" data-toggle="tooltip"
                                           title="<?php echo  esc_attr__('Not allowed to save a copy of the page being viewed.', 'secure-copy-content-protection') ?>">
                                            <i class="ays_fa ays_fa_info_circle"></i>
                                        </a>
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="checkbox" class="modern-checkbox-options ctrls" id="sccp_enable_ctrls"
                                               name="sccp_enable_ctrls" <?php echo  isset($data["options"]["ctrls"]) ? $data["options"]["ctrls"] : 'checked'; ?>
                                               value="true">
                                        <label for="sccp_enable_ctrls"></label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="checkbox" class="modern-checkbox modern_checkbox_mess ctrls-mess" id="sccp_enable_ctrls_mess"
                                               name="sccp_enable_ctrls_mess" <?php echo  isset($data["options"]["ctrls_mess"]) ? $data["options"]["ctrls_mess"] : 'checked'; ?>
                                               value="true">
                                        <label for="sccp_enable_ctrls_mess"></label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="checkbox" class="modern-checkbox modern_checkbox_audio ctrls-audio" id="sccp_enable_ctrls_audio"
                                               name="sccp_enable_ctrls_audio" <?php echo  isset($data["options"]["ctrls_audio"]) ? $data["options"]["ctrls_audio"] : ''; ?>
                                               value="true">
                                        <label for="sccp_enable_ctrls_audio"></label>
                                    </div>
                                    <div class="col-sm-3"></div>
                                </div>
                                <hr>
                                <div class="copy_protection_container form-group row">
                                    <div class="col-sm-3">
                                        <label for="sccp_enable_ctrla"><?php echo  esc_html__("Disable CTRL-A/CMD-A", 'secure-copy-content-protection'); ?></label>
                                        <a class="ays_help" data-toggle="tooltip"
                                           title="<?php echo  esc_attr__('Not allowed to select all', 'secure-copy-content-protection') ?>">
                                            <i class="ays_fa ays_fa_info_circle"></i>
                                        </a>
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="checkbox" class="modern-checkbox-options ctrla" id="sccp_enable_ctrla"
                                               name="sccp_enable_ctrla" <?php echo  isset($data["options"]["ctrla"]) ? $data["options"]["ctrla"] : 'checked'; ?>
                                               value="true">
                                        <label for="sccp_enable_ctrla"></label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="checkbox" class="modern-checkbox modern_checkbox_mess ctrla-mess" id="sccp_enable_ctrla_mess"
                                               name="sccp_enable_ctrla_mess" <?php echo  isset($data["options"]["ctrla_mess"]) ? $data["options"]["ctrla_mess"] : 'checked'; ?>
                                               value="true">
                                        <label for="sccp_enable_ctrla_mess"></label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="checkbox" class="modern-checkbox modern_checkbox_audio ctrla-audio" id="sccp_enable_ctrla_audio"
                                               name="sccp_enable_ctrla_audio" <?php echo  isset($data["options"]["ctrla_audio"]) ? $data["options"]["ctrla_audio"] : ''; ?>
                                               value="true">
                                        <label for="sccp_enable_ctrla_audio"></label>
                                    </div>
                                    <div class="col-sm-3"></div>
                                </div>
                                <hr>
                                <div class="copy_protection_container form-group row">
                                    <div class="col-sm-3">
                                        <label for="sccp_enable_ctrlx"><?php echo  esc_html__("Disable CTRL-X/CMD-X", 'secure-copy-content-protection'); ?></label>
                                        <a class="ays_help" data-toggle="tooltip"
                                           title="<?php echo  esc_attr__('Not allowed to cut the highlighted text', 'secure-copy-content-protection') ?>">
                                            <i class="ays_fa ays_fa_info_circle"></i>
                                        </a>
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="checkbox" class="modern-checkbox-options ctrlx" id="sccp_enable_ctrlx"
                                               name="sccp_enable_ctrlx" <?php echo  isset($data["options"]["ctrlx"]) ? $data["options"]["ctrlx"] : 'checked'; ?>
                                               value="true">
                                        <label for="sccp_enable_ctrlx"></label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="checkbox" class="modern-checkbox modern_checkbox_mess ctrlx-mess" id="sccp_enable_ctrlx_mess"
                                               name="sccp_enable_ctrlx_mess" <?php echo  isset($data["options"]["ctrlx_mess"]) ? $data["options"]["ctrlx_mess"] : 'checked'; ?>
                                               value="true">
                                        <label for="sccp_enable_ctrlx_mess"></label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="checkbox" class="modern-checkbox modern_checkbox_audio ctrlx-audio" id="sccp_enable_ctrlx_audio"
                                               name="sccp_enable_ctrlx_audio" <?php echo  isset($data["options"]["ctrlx_audio"]) ? $data["options"]["ctrlx_audio"] : ''; ?>
                                               value="true">
                                        <label for="sccp_enable_ctrlx_audio"></label>
                                    </div>
                                    <div class="col-sm-3"></div>
                                </div>
                                <hr>
                                <div class="copy_protection_container form-group row">
                                    <div class="col-sm-3">
                                        <label for="sccp_enable_ctrlu"><?php echo  esc_html__("Disable CTRL-U/CMD-U", 'secure-copy-content-protection'); ?></label>
                                        <a class="ays_help" data-toggle="tooltip"
                                           title="<?php echo  esc_attr__('Not allowed to view source of the page', 'secure-copy-content-protection') ?>">
                                            <i class="ays_fa ays_fa_info_circle"></i>
                                        </a>
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="checkbox" class="modern-checkbox-options ctrlu" id="sccp_enable_ctrlu"
                                               name="sccp_enable_ctrlu" <?php echo  isset($data["options"]["ctrlu"]) ? $data["options"]["ctrlu"] : 'checked'; ?>
                                               value="true">
                                        <label for="sccp_enable_ctrlu"></label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="checkbox" class="modern-checkbox modern_checkbox_mess ctrlu-mess" id="sccp_enable_ctrlu_mess"
                                               name="sccp_enable_ctrlu_mess" <?php echo  isset($data["options"]["ctrlu_mess"]) ? $data["options"]["ctrlu_mess"] : 'checked'; ?>
                                               value="true">
                                        <label for="sccp_enable_ctrlu_mess"></label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="checkbox" class="modern-checkbox modern_checkbox_audio ctrlu-audio" id="sccp_enable_ctrlu_audio"
                                               name="sccp_enable_ctrlu_audio" <?php echo  isset($data["options"]["ctrlu_audio"]) ? $data["options"]["ctrlu_audio"] : ''; ?>
                                               value="true">
                                        <label for="sccp_enable_ctrlu_audio"></label>
                                    </div>
                                    <div class="col-sm-3"></div>
                                </div>
                                <hr>
                                <div class="copy_protection_container form-group row">
                                    <div class="col-sm-3">
                                        <label for="sccp_enable_ctrlf"><?php echo  esc_html__("Disable search hot-keys", 'secure-copy-content-protection'); ?></label>
                                        <a class="ays_help" data-toggle="tooltip"
                                           title="<?php echo  esc_attr__('Not allowed to find text on the page by CTRL+F/CMD+F, CTRL+G/CMD+G, CTRL+SHIFT+G/CMD+OPT+G', 'secure-copy-content-protection') ?>">
                                            <i class="ays_fa ays_fa_info_circle"></i>
                                        </a>
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="checkbox" class="modern-checkbox-options ctrlf" id="sccp_enable_ctrlf"
                                               name="sccp_enable_ctrlf" <?php echo  isset($data["options"]["ctrlf"]) ? $data["options"]["ctrlf"] : ''; ?>
                                               value="true">
                                        <label for="sccp_enable_ctrlf"></label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="checkbox" class="modern-checkbox modern_checkbox_mess ctrlf-mess" id="sccp_enable_ctrlf_mess"
                                               name="sccp_enable_ctrlf_mess" <?php echo  isset($data["options"]["ctrlf_mess"]) ? $data["options"]["ctrlf_mess"] : ''; ?>
                                               value="true">
                                        <label for="sccp_enable_ctrlf_mess"></label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="checkbox" class="modern-checkbox modern_checkbox_audio ctrlf-audio" id="sccp_enable_ctrlf_audio"
                                               name="sccp_enable_ctrlf_audio" <?php echo  isset($data["options"]["ctrlf_audio"]) ? $data["options"]["ctrlf_audio"] : ''; ?>
                                               value="true">
                                        <label for="sccp_enable_ctrlf_audio"></label>
                                    </div>
                                    <div class="col-sm-3"></div>
                                </div>
                                <hr>
                                <div class="copy_protection_container form-group row">
                                    <div class="col-sm-3">
                                        <label for="sccp_enable_ctrlp"><?php echo  esc_html__("Disable CTRL-P/CMD-P", 'secure-copy-content-protection'); ?></label>
                                        <a class="ays_help" data-toggle="tooltip"
                                           title="<?php echo  esc_attr__('Not allowed to print the page', 'secure-copy-content-protection') ?>">
                                            <i class="ays_fa ays_fa_info_circle"></i>
                                        </a>
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="checkbox" class="modern-checkbox-options ctrlp" id="sccp_enable_ctrlp"
                                               name="sccp_enable_ctrlp" <?php echo  isset($data["options"]["ctrlp"]) ? $data["options"]["ctrlp"] : ''; ?>
                                               value="true">
                                        <label for="sccp_enable_ctrlp"></label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="checkbox" class="modern-checkbox modern_checkbox_mess ctrlp-mess" id="sccp_enable_ctrlp_mess"
                                               name="sccp_enable_ctrlp_mess" <?php echo  isset($data["options"]["ctrlp_mess"]) ? $data["options"]["ctrlp_mess"] : ''; ?>
                                               value="true">
                                        <label for="sccp_enable_ctrlp_mess"></label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="checkbox" class="modern-checkbox modern_checkbox_audio ctrlp-audio" id="sccp_enable_ctrlp_audio"
                                               name="sccp_enable_ctrlp_audio" <?php echo  isset($data["options"]["ctrlp_audio"]) ? $data["options"]["ctrlp_audio"] : ''; ?>
                                               value="true">
                                        <label for="sccp_enable_ctrlp_audio"></label>
                                    </div>
                                    <div class="col-sm-3"></div>
                                </div>
                                <hr>
                                <div class="copy_protection_container form-group row">
                                    <div class="col-sm-3">
                                        <label for="sccp_enable_ctrlh"><?php echo  esc_html__("Disable CTRL-H/CMD-H", 'secure-copy-content-protection'); ?></label>
                                        <a class="ays_help" data-toggle="tooltip"
                                           title="<?php echo  esc_attr__('Does not allow to open history page', 'secure-copy-content-protection') ?>">
                                            <i class="ays_fa ays_fa_info_circle"></i>
                                        </a>
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="checkbox" class="modern-checkbox-options ctrlh" id="sccp_enable_ctrlh"
                                               name="sccp_enable_ctrlh" <?php echo  isset($data["options"]["ctrlh"]) ? $data["options"]["ctrlh"] : ''; ?>
                                               value="true">
                                        <label for="sccp_enable_ctrlh"></label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="checkbox" class="modern-checkbox modern_checkbox_mess ctrlh-mess" id="sccp_enable_ctrlh_mess"
                                               name="sccp_enable_ctrlh_mess" <?php echo  isset($data["options"]["ctrlh_mess"]) ? $data["options"]["ctrlh_mess"] : ''; ?>
                                               value="true">
                                        <label for="sccp_enable_ctrlh_mess"></label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="checkbox" class="modern-checkbox modern_checkbox_audio ctrlh-audio" id="sccp_enable_ctrlh_audio"
                                               name="sccp_enable_ctrlh_audio" <?php echo  isset($data["options"]["ctrlh_audio"]) ? $data["options"]["ctrlh_audio"] : ''; ?>
                                               value="true">
                                        <label for="sccp_enable_ctrlh_audio"></label>
                                    </div>
                                    <div class="col-sm-3"></div>
                                </div>
                                <hr>
                                <div class="copy_protection_container form-group row">
                                    <div class="col-sm-3">
                                        <label for="sccp_enable_ctrll"><?php echo  esc_html__("Disable CTRL-L/CMD-L", 'secure-copy-content-protection'); ?></label>
                                        <a class="ays_help" data-toggle="tooltip"
                                           title="<?php echo  esc_attr__('Does not allow to select the browser address bar', 'secure-copy-content-protection') ?>">
                                            <i class="ays_fa ays_fa_info_circle"></i>
                                        </a>
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="checkbox" class="modern-checkbox-options ctrll" id="sccp_enable_ctrll"
                                               name="sccp_enable_ctrll" <?php echo  isset($data["options"]["ctrll"]) ? $data["options"]["ctrll"] : ''; ?>
                                               value="true">
                                        <label for="sccp_enable_ctrll"></label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="checkbox" class="modern-checkbox modern_checkbox_mess ctrll-mess" id="sccp_enable_ctrll_mess"
                                               name="sccp_enable_ctrll_mess" <?php echo  isset($data["options"]["ctrll_mess"]) ? $data["options"]["ctrll_mess"] : ''; ?>
                                               value="true">
                                        <label for="sccp_enable_ctrll_mess"></label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="checkbox" class="modern-checkbox modern_checkbox_audio ctrll-audio" id="sccp_enable_ctrll_audio"
                                               name="sccp_enable_ctrll_audio" <?php echo  isset($data["options"]["ctrll_audio"]) ? $data["options"]["ctrll_audio"] : ''; ?>
                                               value="true">
                                        <label for="sccp_enable_ctrll_audio"></label>
                                    </div>
                                    <div class="col-sm-3"></div>
                                </div>
                                <hr>
                                <div class="copy_protection_container form-group row">
                                    <div class="col-sm-3">
                                        <label for="sccp_enable_ctrlk"><?php echo  esc_html__("Disable CTRL-K", 'secure-copy-content-protection'); ?></label>
                                        <a class="ays_help" data-toggle="tooltip"
                                           title="<?php echo  esc_attr__('Does not allow the user to move to the address bar and perform a google search.', 'secure-copy-content-protection') ?>">
                                            <i class="ays_fa ays_fa_info_circle"></i>
                                        </a>
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="checkbox" class="modern-checkbox-options ctrlk" id="sccp_enable_ctrlk"
                                               name="sccp_enable_ctrlk" <?php echo  isset($data["options"]["ctrlk"]) ? $data["options"]["ctrlk"] : ''; ?>
                                               value="true">
                                        <label for="sccp_enable_ctrlk"></label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="checkbox" class="modern-checkbox modern_checkbox_mess ctrlk-mess" id="sccp_enable_ctrlk_mess"
                                               name="sccp_enable_ctrlk_mess" <?php echo  isset($data["options"]["ctrlk_mess"]) ? $data["options"]["ctrlk_mess"] : ''; ?>
                                               value="true">
                                        <label for="sccp_enable_ctrlk_mess"></label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="checkbox" class="modern-checkbox modern_checkbox_audio ctrlk-audio" id="sccp_enable_ctrlk_audio"
                                               name="sccp_enable_ctrlk_audio" <?php echo  isset($data["options"]["ctrlk_audio"]) ? $data["options"]["ctrlk_audio"] : ''; ?>
                                               value="true">
                                        <label for="sccp_enable_ctrlk_audio"></label>
                                    </div>
                                    <div class="col-sm-3"></div>
                                </div>
                                <hr>
                                <div class="copy_protection_container form-group row">
                                    <div class="col-sm-3">
                                        <label for="sccp_enable_ctrlo"><?php echo  esc_html__("Disable CTRL-O", 'secure-copy-content-protection'); ?></label>
                                        <a class="ays_help" data-toggle="tooltip"
                                           title="<?php echo  esc_attr__('Does not allow to open file from your computer.', 'secure-copy-content-protection') ?>">
                                            <i class="ays_fa ays_fa_info_circle"></i>
                                        </a>
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="checkbox" class="modern-checkbox-options ctrlo" id="sccp_enable_ctrlo"
                                               name="sccp_enable_ctrlo" <?php echo  isset($data["options"]["ctrlo"]) ? $data["options"]["ctrlo"] : ''; ?>
                                               value="true">
                                        <label for="sccp_enable_ctrlo"></label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="checkbox" class="modern-checkbox modern_checkbox_mess ctrlo-mess" id="sccp_enable_ctrlo_mess"
                                               name="sccp_enable_ctrlo_mess" <?php echo  isset($data["options"]["ctrlo_mess"]) ? $data["options"]["ctrlo_mess"] : ''; ?>
                                               value="true">
                                        <label for="sccp_enable_ctrlo_mess"></label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="checkbox" class="modern-checkbox modern_checkbox_audio ctrlo-audio" id="sccp_enable_ctrlo_audio"
                                               name="sccp_enable_ctrlo_audio" <?php echo  isset($data["options"]["ctrlo_audio"]) ? $data["options"]["ctrlo_audio"] : ''; ?>
                                               value="true">
                                        <label for="sccp_enable_ctrlo_audio"></label>
                                    </div>
                                    <div class="col-sm-3"></div>
                                </div>
                                <hr>
                                <div class="copy_protection_container form-group row">
                                    <div class="col-sm-3">
                                        <label for="sccp_enable_f6"><?php echo  esc_html__("Disable F6", 'secure-copy-content-protection'); ?></label>
                                        <a class="ays_help" data-toggle="tooltip"
                                           title="<?php echo  esc_attr__('Does not allow to select the browser address bar', 'secure-copy-content-protection') ?>">
                                            <i class="ays_fa ays_fa_info_circle"></i>
                                        </a>
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="checkbox" class="modern-checkbox-options sccp_f6" id="sccp_enable_f6"
                                               name="sccp_enable_f6" <?php echo  isset($data["options"]["sccp_f6"]) ? $data["options"]["sccp_f6"] : ''; ?>
                                               value="true">
                                        <label for="sccp_enable_f6"></label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="checkbox" class="modern-checkbox modern_checkbox_mess sccp_f6-mess" id="sccp_enable_f6_mess"
                                               name="sccp_enable_f6_mess" <?php echo  isset($data["options"]["f6_mess"]) ? $data["options"]["f6_mess"] : ''; ?>
                                               value="true">
                                        <label for="sccp_enable_f6_mess"></label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="checkbox" class="modern-checkbox modern_checkbox_audio sccp_f6-audio" id="sccp_enable_f6_audio"
                                               name="sccp_enable_f6_audio" <?php echo  isset($data["options"]["f6_audio"]) ? $data["options"]["f6_audio"] : ''; ?>
                                               value="true">
                                        <label for="sccp_enable_f6_audio"></label>
                                    </div>
                                    <div class="col-sm-3"></div>
                                </div>
                                <hr>
                                <div class="copy_protection_container form-group row">
                                    <div class="col-sm-3">
                                        <label for="sccp_enable_f3"><?php echo  esc_html__("Disable F3", 'secure-copy-content-protection'); ?></label>
                                        <a class="ays_help" data-toggle="tooltip"
                                           title="<?php echo  esc_attr__('Does not allow to find text on the page.', 'secure-copy-content-protection') ?>">
                                            <i class="ays_fa ays_fa_info_circle"></i>
                                        </a>
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="checkbox" class="modern-checkbox-options sccp_f3" id="sccp_enable_f3"
                                               name="sccp_enable_f3" <?php echo  isset($data["options"]["sccp_f3"]) ? $data["options"]["sccp_f3"] : ''; ?>
                                               value="true">
                                        <label for="sccp_enable_f3"></label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="checkbox" class="modern-checkbox modern_checkbox_mess sccp_f3-mess" id="sccp_enable_f3_mess"
                                               name="sccp_enable_f3_mess" <?php echo  isset($data["options"]["f3_mess"]) ? $data["options"]["f3_mess"] : ''; ?>
                                               value="true">
                                        <label for="sccp_enable_f3_mess"></label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="checkbox" class="modern-checkbox modern_checkbox_audio sccp_f3-audio" id="sccp_enable_f3_audio"
                                               name="sccp_enable_f3_audio" <?php echo  isset($data["options"]["f3_audio"]) ? $data["options"]["f3_audio"] : ''; ?>
                                               value="true">
                                        <label for="sccp_enable_f3_audio"></label>
                                    </div>
                                    <div class="col-sm-3"></div>
                                </div>
                                <hr>
                                <div class="copy_protection_container form-group row">
                                    <div class="col-sm-3">
                                        <label for="sccp_enable_f9"><?php echo  esc_html__("Disable F9", 'secure-copy-content-protection'); ?></label>
                                        <a class="ays_help" data-toggle="tooltip"
                                           title="<?php echo  esc_attr__('By enabling this option, the reading mode will completely be deactivated on the Mozilla browser.', 'secure-copy-content-protection') ?>">
                                            <i class="ays_fa ays_fa_info_circle"></i>
                                        </a>
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="checkbox" class="modern-checkbox-options sccp_f9" id="sccp_enable_f9"
                                               name="sccp_enable_f9" <?php echo  isset($data["options"]["sccp_f9"]) ? $data["options"]["sccp_f9"] : ''; ?>
                                               value="true">
                                        <label for="sccp_enable_f9"></label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="checkbox" class="modern-checkbox modern_checkbox_mess sccp_f9-mess" id="sccp_enable_f9_mess"
                                               name="sccp_enable_f9_mess" <?php echo  isset($data["options"]["f9_mess"]) ? $data["options"]["f9_mess"] : ''; ?>
                                               value="true">
                                        <label for="sccp_enable_f9_mess"></label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="checkbox" class="modern-checkbox modern_checkbox_audio sccp_f9-audio" id="sccp_enable_f9_audio"
                                               name="sccp_enable_f9_audio" <?php echo  isset($data["options"]["f9_audio"]) ? $data["options"]["f9_audio"] : ''; ?>
                                               value="true">
                                        <label for="sccp_enable_f9_audio"></label>
                                    </div>
                                    <div class="col-sm-3"></div>
                                </div>
                                <hr>
                                <div class="copy_protection_container form-group row">
                                    <div class="col-sm-3">
                                        <label for="sccp_enable_altd"><?php echo  esc_html__("Disable ALT-D", 'secure-copy-content-protection'); ?></label>
                                        <a class="ays_help" data-toggle="tooltip"
                                           title="<?php echo  esc_attr__('Does not allow to select the browser address bar', 'secure-copy-content-protection') ?>">
                                            <i class="ays_fa ays_fa_info_circle"></i>
                                        </a>
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="checkbox" class="modern-checkbox-options sccp_altd" id="sccp_enable_altd"
                                               name="sccp_enable_altd" <?php echo  isset($data["options"]["sccp_altd"]) ? $data["options"]["sccp_altd"] : ''; ?>
                                               value="true">
                                        <label for="sccp_enable_altd"></label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="checkbox" class="modern-checkbox modern_checkbox_mess sccp_altd-mess" id="sccp_enable_altd_mess"
                                               name="sccp_enable_altd_mess" <?php echo  isset($data["options"]["altd_mess"]) ? $data["options"]["altd_mess"] : ''; ?>
                                               value="true">
                                        <label for="sccp_enable_altd_mess"></label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="checkbox" class="modern-checkbox modern_checkbox_audio sccp_altd-audio" id="sccp_enable_altd_audio"
                                               name="sccp_enable_altd_audio" <?php echo  isset($data["options"]["altd_audio"]) ? $data["options"]["altd_audio"] : ''; ?>
                                               value="true">
                                        <label for="sccp_enable_altd_audio"></label>
                                    </div>
                                    <div class="col-sm-3"></div>
                                </div>
                                <hr>
                                <div class="copy_protection_container form-group row">
                                    <div class="col-sm-3">
                                        <label for="sccp_enable_ctrle"><?php echo  esc_html__("Disable CTRL-E", 'secure-copy-content-protection'); ?></label>
                                        <a class="ays_help" data-toggle="tooltip"
                                           title="<?php echo  esc_attr__('Does not allow to select the browser address bar', 'secure-copy-content-protection') ?>">
                                            <i class="ays_fa ays_fa_info_circle"></i>
                                        </a>
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="checkbox" class="modern-checkbox-options sccp_ctrle" id="sccp_enable_ctrle"
                                               name="sccp_enable_ctrle" <?php echo  isset($data["options"]["sccp_ctrle"]) ? $data["options"]["sccp_ctrle"] : ''; ?>
                                               value="true">
                                        <label for="sccp_enable_ctrle"></label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="checkbox" class="modern-checkbox modern_checkbox_mess sccp_ctrle-mess" id="sccp_enable_ctrle_mess"
                                               name="sccp_enable_ctrle_mess" <?php echo  isset($data["options"]["ctrle_mess"]) ? $data["options"]["ctrle_mess"] : ''; ?>
                                               value="true">
                                        <label for="sccp_enable_ctrle_mess"></label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="checkbox" class="modern-checkbox modern_checkbox_audio sccp_ctrle-audio" id="sccp_enable_ctrle_audio"
                                               name="sccp_enable_ctrle_audio" <?php echo  isset($data["options"]["ctrle_audio"]) ? $data["options"]["ctrle_audio"] : ''; ?>
                                               value="true">
                                        <label for="sccp_enable_ctrle_audio"></label>
                                    </div>
                                    <div class="col-sm-3"></div>
                                </div>
                                <hr>
                                <?php  if (isset($data["options"]["printscreen"]) && $data["options"]["printscreen"] == 'checked') { ?>
                                <div class="copy_protection_container form-group row">
                                    <div class="col-sm-3">
                                        <label for="sccp_enable_printscreen"><?php echo  esc_html__("Disable Print Screen (PC only)", 'secure-copy-content-protection'); ?></label>
                                        <a class="ays_help" data-toggle="tooltip"
                                           title="<?php echo  esc_attr__('Not allowed to print screen', 'secure-copy-content-protection') ?>">
                                            <i class="ays_fa ays_fa_info_circle"></i>
                                        </a>
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="checkbox" class="modern-checkbox-options printscreen"
                                               id="sccp_enable_printscreen"
                                               name="sccp_enable_printscreen" <?php echo  isset($data["options"]["printscreen"]) ? $data["options"]["printscreen"] : 'checked'; ?>
                                               value="true">
                                        <label for="sccp_enable_printscreen"></label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="checkbox" class="modern-checkbox modern_checkbox_mess printscreen-mess"
                                               id="sccp_enable_printscreen_mess"
                                               name="sccp_enable_printscreen_mess" <?php echo  isset($data["options"]["printscreen_mess"]) ? $data["options"]["printscreen_mess"] : 'checked'; ?>
                                               value="true">
                                        <label for="sccp_enable_printscreen_mess"></label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="checkbox" class="modern-checkbox modern_checkbox_audio printscreen-audio"
                                               id="sccp_enable_printscreen_audio"
                                               name="sccp_enable_printscreen_audio" <?php echo  isset($data["options"]["printscreen_audio"]) ? $data["options"]["printscreen_audio"] : ''; ?>
                                               value="true">
                                        <label for="sccp_enable_printscreen_audio"></label>
                                    </div>
                                    <div class="col-sm-3"></div>
                                </div>
                                <hr>
                                <?php } ?>
                                <div class="copy_protection_container form-group row">
                                    <div class="col-sm-3">
                                        <label for="sccp_enable_left_click"><?php echo  esc_html__("Disable left click", 'secure-copy-content-protection'); ?>
                                            <span class="sccp_not_rec"><?php echo  esc_html__("( not recommended )", 'secure-copy-content-protection'); ?></span>
                                        </label>
                                        <a class="ays_help" data-toggle="tooltip"
                                           title="<?php echo  esc_attr__('Left click is not allowed', 'secure-copy-content-protection') ?>">
                                            <i class="ays_fa ays_fa_info_circle"></i>
                                        </a>
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="checkbox" class="modern-checkbox-options left" id="sccp_enable_left_click"
                                               name="sccp_enable_left_click" <?php echo  isset($data["options"]["left_click"]) ? $data["options"]["left_click"] : "" ?>
                                               value="true">
                                        <label for="sccp_enable_left_click"></label>
                                    </div>
                                    <div class="col-sm-2 ">
                                        <input type="checkbox" class="modern-checkbox modern_checkbox_mess left-mess"
                                               id="sccp_enable_left_click_mess"
                                               name="sccp_enable_left_click_mess" <?php echo  isset($data["options"]["left_click_mess"]) ? $data["options"]["left_click_mess"] : ''; ?>
                                               value="true">
                                        <label for="sccp_enable_left_click_mess"></label>
                                    </div>
                                    <div class="col-sm-2 ">
                                        <input type="checkbox" class="modern-checkbox modern_checkbox_audio left-audio"
                                               id="sccp_enable_left_click_audio"
                                               name="sccp_enable_left_click_audio" <?php echo  isset($data["options"]["left_click_audio"]) ? $data["options"]["left_click_audio"] : ''; ?>
                                               value="true">
                                        <label for="sccp_enable_left_click_audio"></label>
                                    </div>
                                    <div class="col-sm-3"></div>
                                </div>
                                <hr>
                                <div class="copy_protection_container form-group row">
                                    <div class="col-sm-3">
                                        <label for="sccp_enable_mobile_img"><?php echo  esc_html__("Disable scrolling over images (Mobile)", 'secure-copy-content-protection'); ?></label>
                                        <a class="ays_help" data-toggle="tooltip"
                                           title="<?php echo  esc_attr__('Not open images context menu in mobile browsers after taphold. But makes it impossible to scroll over the images.', 'secure-copy-content-protection') ?>">
                                            <i class="ays_fa ays_fa_info_circle"></i>
                                        </a>
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="checkbox" class="modern-checkbox-options mobile-img"
                                               id="sccp_enable_mobile_img"
                                               name="sccp_enable_mobile_img" <?php echo  isset($data["options"]["mobile_img"]) ? $data["options"]["mobile_img"] : ''; ?>
                                               value="true">
                                        <label for="sccp_enable_mobile_img"></label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="checkbox" class="modern-checkbox modern_checkbox_mess mobile-img-mess"
                                               id="sccp_enable_mobile_img_mess"
                                               name="sccp_enable_mobile_img_mess" <?php echo  isset($data["options"]["mobile_img_mess"]) ? $data["options"]["mobile_img_mess"] : ''; ?>
                                               value="true">
                                        <label for="sccp_enable_mobile_img_mess"></label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="checkbox" class="modern-checkbox modern_checkbox_audio mobile-img-audio"
                                               id="sccp_enable_mobile_img_audio"
                                               name="sccp_enable_mobile_img_audio" <?php echo  isset($data["options"]["mobile_img_audio"]) ? $data["options"]["mobile_img_audio"] : ''; ?>
                                               value="true">
                                        <label for="sccp_enable_mobile_img_audio"></label>
                                    </div>
                                    <div class="col-sm-3"></div>
                                </div>
                                <hr>
                                <div class="copy_protection_container form-group row">
                                    <div class="col-sm-3">
                                        <label for="sccp_show_msg_only_once"><?php echo  esc_html__("Show message only once", 'secure-copy-content-protection'); ?>
                                            <a class="ays_help" data-toggle="tooltip"
                                               title="<?php echo  esc_attr__('Enable to show the warning text once( only after the first attempt) when the user tries non-permitted actions in the copy protection enabled areas on the website.', 'secure-copy-content-protection') ?>">
                                                <i class="ays_fa ays_fa_info_circle"></i>
                                            </a>
                                        </label>
                                    </div>
                                    <div class="col-sm-2">
                                       <input type="checkbox" class="modern-checkbox-options"
                                               id="sccp_show_msg_only_once"
                                               name="sccp_show_msg_only_once" <?php echo  isset($data["options"]["msg_only_once"]) ? $data["options"]["msg_only_once"] : ''; ?>
                                               value="true">
                                        <label for="sccp_show_msg_only_once"></label>
                                    </div>
                                    <div class="col-sm-7"></div>
                                </div>
                                <hr>
                                <div class="copy_protection_container form-group row">
                                    <div class="col-sm-3">
                                        <label for="sccp_access_disable_js"><?php echo  esc_html__("Protect content when Javascript is disabled", 'secure-copy-content-protection'); ?>
                                            <a class="ays_help" data-toggle="tooltip"
                                               title="<?php echo  esc_attr__('It will block the site content if the user disabled browser Javascript. There will be a white screen with a message.', 'secure-copy-content-protection') ?>">
                                                <i class="ays_fa ays_fa_info_circle"></i>
                                            </a>
                                        </label>
                                    </div>
                                    <div class="col-sm-2">
                                       <input type="checkbox" class="modern-checkbox-options"
                                               id="sccp_access_disable_js"
                                               name="sccp_access_disable_js" <?php echo  isset($data["options"]["disable_js"]) ? $data["options"]["disable_js"] : ''; ?>
                                               value="true">
                                        <label for="sccp_access_disable_js"></label>
                                    </div>
                                    <div class="col-sm-7"></div>
                                </div>
                                <hr>
                                <div class="form-group row if-ays-sccp-hide-results">
                                    <div class="col-sm-3">
                                        <label for="ays_sccp_disabled_js_msg"><?php echo  esc_html__("Message while Javascript is disabled", 'secure-copy-content-protection'); ?>
                                        <a class="ays_help" data-toggle="tooltip"
                                           title="<?php echo  esc_attr__('Write the message which will be displayed when the Javascript is disabled', 'secure-copy-content-protection') ?>">
                                            <i class="ays_fa ays_fa_info_circle"></i>
                                        </a>
                                        </label>
                                    </div>
                                    <div class="col-sm-9 ays_wp_editor_pos">
                                        <?php
                                        $content   = wpautop(stripslashes($disable_js_msg));;
                                        $editor_id = 'ays_sccp_disabled_js_msg';
                                        $settings  = array(
                                            'editor_height'  => $sccp_wp_editor_height,
                                            'textarea_name'  => 'ays_disabled_js_msg',
                                            'editor_class'   => 'ays-textarea',
                                            'media_elements' => false
                                        );
                                        wp_editor($content, $editor_id, $settings);
                                        ?>
                                    </div>
                                </div>
                                <hr class="if-ays-sccp-hide-results">
                                <span id="outbox"></span>
                                <div class="copy_protection_container form-group row ays_toggle_parent">
                                    <div class="col-sm-3">
                                        <label for="sccp_enable_copyright_text">
                                            <?php echo esc_html__('Enable Copyright text','secure-copy-content-protection'); ?>
                                            <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_attr__('Enable copyright text.','secure-copy-content-protection'); ?>">
                                                <i class="ays_fa ays_fa_info_circle"></i>
                                            </a>
                                        </label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="checkbox" class="ays-enable-timer1 ays_toggle_checkbox" id="sccp_enable_copyright_text"
                                               name="sccp_enable_copyright_text"
                                               value="on" <?php echo $enable_copyright_text == "on" ? 'checked' : '' ?>/>
                                    </div>
                                    <div class="col-sm-6 ays_toggle_target ays_divider_left <?php echo $enable_copyright_text == 'on' ? '' : 'ays_display_none'; ?>">                                
                                        <div class="form-group row">
                                            <div class="col-sm-4">
                                                <label for="sccp_copyright_text">
                                                    <?php echo esc_html__('Copyright text','secure-copy-content-protection')?>
                                                    <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_attr__('Type in the copyright text that will be added to the copied text.','secure-copy-content-protection')?>">
                                                        <i class="ays_fa ays_fa_info_circle"></i>
                                                    </a>
                                                </label>
                                            </div>
                                            <div class="col-sm-8">
                                                <input type="text" class="ays-text-input" id="sccp_copyright_text"
                                                    name="sccp_copyright_text"
                                                    value="<?php echo $copyright_text; ?>"/>
                                            </div>
                                        </div>
                                        <hr/>
                                        <div class="form-group row">
                                            <div class="col-sm-4">
                                                <label class="form-check-label" for="sccp_copyright_include_url">
                                                    <?php echo esc_html__('Include URL link', 'secure-copy-content-protection'); ?>
                                                    <a class="ays_help" data-toggle="tooltip"
                                                    title="<?php echo esc_attr__('Tick the checkbox if you want to include your URL link at the end of the copyright text.', 'secure-copy-content-protection'); ?>">
                                                        <i class="ays_fa ays_fa_info_circle"></i>
                                                    </a>
                                                </label>
                                            </div>
                                            <div class="col-sm-8">
                                                <input type="checkbox" class="" id="sccp_copyright_include_url" name="sccp_copyright_include_url" value="on" <?php echo $copyright_include_url == "on" ? 'checked' : ''; ?>>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="copy_protection_container form-group row ays_toggle_parent">
                                    <div class="col-sm-3">
                                        <label for="ays_sccp_enable_copyright_word">
                                            <?php echo esc_html__('Enable pasting custom text','secure-copy-content-protection'); ?>
                                            <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_attr__('Activate this option, and provided custom text will be replaced with the copied text.','secure-copy-content-protection'); ?>">
                                                <i class="ays_fa ays_fa_info_circle"></i>
                                            </a>
                                        </label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="checkbox" class="ays-enable-timer1 ays_toggle_checkbox" id="ays_sccp_enable_copyright_word"
                                               name="ays_sccp_enable_copyright_word"
                                               value="on" <?php echo $sccp_enable_copyright_word; ?>/>
                                    </div>
                                    <div class="col-sm-6 ays_toggle_target ays_divider_left <?php echo $sccp_enable_copyright_word != '' ? '' : 'ays_display_none'; ?>">                                
                                        <div class="form-group row">
                                            <div class="col-sm-4">
                                                <label for="ays_sccp_copyright_word">
                                                    <?php echo esc_html__('Custom text','secure-copy-content-protection')?>
                                                    <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_attr__('Type in the custom text.','secure-copy-content-protection')?>">
                                                        <i class="ays_fa ays_fa_info_circle"></i>
                                                    </a>
                                                </label>
                                            </div>
                                            <div class="col-sm-8">
                                                <input type="text" class="ays-text-input" id="ays_sccp_copyright_word"
                                                    name="ays_sccp_copyright_word"
                                                    value="<?php echo $sccp_copyright_word; ?>"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr/>
                                <div class="sccp_pro only_pro" title="<?php echo  esc_attr__('This feature will available in PRO version', 'secure-copy-content-protection'); ?>">
                                    <div class="pro_features sccp_general_pro">
                                        <div>                                    
                                            <a href="https://ays-pro.com/wordpress/secure-copy-content-protection/" target="_blank" class="ays-sccp-new-upgrade-button-link">
                                                <div class="ays-sccp-new-upgrade-button-box">
                                                    <div>
                                                        <img src="<?php echo SCCP_ADMIN_URL.'/images/icons/sccp_locked_24x24.svg'?>">
                                                        <img src="<?php echo SCCP_ADMIN_URL.'/images/icons/sccp_unlocked_24x24.svg'?>" class="ays-sccp-new-upgrade-button-hover">
                                                    </div>
                                                    <div class="ays-sccp-new-upgrade-button"><?php echo esc_html__("Upgrade", 'secure-copy-content-protection'); ?></div>
                                                </div>
                                            </a>
                                            <div class="ays-sccp-center-big-main-button-box ays-sccp-new-big-button-flex">
                                                <div class="ays-sccp-center-big-upgrade-button-box">
                                                    <a href="https://ays-pro.com/wordpress/secure-copy-content-protection/" target="_blank" class="ays-sccp-new-upgrade-button-link">
                                                        <div class="ays-sccp-center-new-big-upgrade-button">
                                                            <img src="<?php echo SCCP_ADMIN_URL.'/images/icons/sccp_locked_24x24.svg'?>" class="ays-sccp-new-button-img-hide">
                                                            <img src="<?php echo SCCP_ADMIN_URL.'/images/icons/sccp_unlocked_24x24.svg'?>" class="ays-sccp-new-upgrade-button-hover">  
                                                            <?php echo esc_html__("Upgrade", 'secure-copy-content-protection'); ?>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="copy_protection_container form-group row">
                                        <div class="col-sm-3">
                                            <label for="sccp_enable_watermark"><?php echo  esc_html__("Enable Images Watermark", 'secure-copy-content-protection'); ?></label>
                                            <a class="ays_help" data-toggle="tooltip"
                                               title="<?php echo  esc_attr__('Enable watermark with notification text on all site images', 'secure-copy-content-protection') ?>">
                                                <i class="ays_fa ays_fa_info_circle"></i>
                                            </a>
                                        </div>
                                        <div class="col-sm-2">
                                            <input type="checkbox" class="watermark"
                                                   id="sccp_enable_watermark" value="true">
                                            <label for="sccp_enable_watermark"></label>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="copy_protection_container form-group row">
                                        <div class="col-sm-3">
                                            <label for="sccp_enable_f12"><?php echo  esc_html__("Disable REST API", 'secure-copy-content-protection'); ?>
                                                <span class="sccp_not_rec"><?php echo  esc_html__("( not recommended )", 'secure-copy-content-protection'); ?></span>
                                            </label>
                                            <a class="ays_help" data-toggle="tooltip"
                                               title="<?php echo  esc_attr__('Disable REST API', 'secure-copy-content-protection') ?>">
                                                <i class="ays_fa ays_fa_info_circle"></i>
                                            </a>
                                        </div>
                                        <div class="col-sm-2">
                                            <input type="checkbox" class="rest_api"
                                                   id="sccp_enable_rest_api" value="true">
                                            <label for="sccp_enable_rest_api"></label>
                                        </div>
                                    </div>
                                </div>                        
                            </div>
                        </div>

                        <div class="ays-sccp-accordion-options-main-container" data-collapsed="false">
                            <div class="ays-sccp-accordion-container">
                                <?php echo $sccp_accordion_svg_html; ?>
                                <p class="ays-subtitle" style="margin-top:0;"><?php echo esc_html__( 'Block content options', 'secure-copy-content-protection' ); ?></p>
                            </div>
                            <hr class="ays-sccp-bolder-hr"/>
                            <div class="ays-sccp-accordion-options-box">
                                <div class="copy_protection_container form-group row">
                                    <div class="col-sm-3">
                                        <label for="sccp_bc_header_text"><?php echo  esc_html__("Block content header text", 'secure-copy-content-protection'); ?></label>
                                        <a class="ays_help" data-toggle="tooltip"
                                           title="<?php echo  esc_attr__('The header text for block content', 'secure-copy-content-protection') ?>">
                                            <i class="ays_fa ays_fa_info_circle"></i>
                                        </a>
                                    </div>
                                    <div class="col-sm-9 ays_wp_editor_pos">
                                        <?php
                                        $content   = wpautop(stripslashes($bc_header_text));
                                        $editor_id = 'sccp_bc_header_text';
                                        $settings = array('editor_height' => $sccp_wp_editor_height,'textarea_name' => 'sccp_bc_header_text');
                                        wp_editor($content, $editor_id, $settings);
                                        ?>
                                    </div>
                                </div>
                                <hr>
                                <div class="copy_protection_container form-group row">
                                    <div class="col-sm-3">
                                        <label for="sccp_bc_button_position"><?php echo  esc_html__("Block content button position", 'secure-copy-content-protection'); ?></label>
                                        <a class="ays_help" data-toggle="tooltip"
                                           title="<?php echo  esc_attr__('The button position for block content', 'secure-copy-content-protection') ?>">
                                            <i class="ays_fa ays_fa_info_circle"></i>
                                        </a>
                                    </div>
                                    <div class="col-sm-3 sccp_bc_btn_position_select_div" >
                                        <select id="sccp_bc_button_position" name="sccp_bc_button_position" class="ays-text-input-short">
                                            <option <?php echo ($bc_button_position == 'next-to') ? 'selected' : ''; ?> value="next-to"><?php echo esc_html__('Next to the input', 'secure-copy-content-protection'); ?></option>
                                            <option <?php echo ($bc_button_position == 'under') ? 'selected' : ''; ?> value="under"><?php echo esc_attr__('Under the input', 'secure-copy-content-protection'); ?></option>
                                        </select>
                                        
                                    </div>
                                    <div class="col-sm-6"></div>
                                </div>
                            </div>
                        </div>

                        <div class="ays-sccp-accordion-options-main-container" data-collapsed="false">
                            <div class="ays-sccp-accordion-container">
                                <?php echo $sccp_accordion_svg_html; ?>
                                <p class="ays-subtitle" style="margin-top:0;"><?php echo esc_html__( 'Subscribe to view options', 'secure-copy-content-protection' ); ?></p>
                            </div>
                            <hr class="ays-sccp-bolder-hr"/>
                            <div class="ays-sccp-accordion-options-box">                                                     
                                <div class="copy_protection_container form-group row">
                                    <div class="col-sm-3">
                                        <label for="sccp_subscribe_block_header_text"><?php echo  esc_html__("Subscribe to view header text", 'secure-copy-content-protection'); ?></label>
                                        <a class="ays_help" data-toggle="tooltip"
                                           title="<?php echo  esc_attr__('The header text for subscribe to view', 'secure-copy-content-protection') ?>">
                                            <i class="ays_fa ays_fa_info_circle"></i>
                                        </a>
                                    </div>
                                    <div class="col-sm-9 ays_wp_editor_pos">
                                        <?php
                                        $content   = wpautop(stripslashes($subs_to_view_header_text));
                                        $editor_id = 'sccp_subscribe_block_header_text';
                                        $settings = array('editor_height' => $sccp_wp_editor_height,'textarea_name' => 'sccp_subscribe_block_header_text');
                                        wp_editor($content, $editor_id, $settings);
                                        ?>
                                    </div>
                                </div>
                                <hr>                                
                                <div class="copy_protection_container form-group row">
                                    <div class="col-sm-3">
                                        <label for="sccp_sub_block_button_position"><?php echo  esc_html__("Subscribe to view button position", 'secure-copy-content-protection'); ?></label>
                                        <a class="ays_help" data-toggle="tooltip"
                                           title="<?php echo  esc_attr__('The button position for subscribe to view', 'secure-copy-content-protection') ?>">
                                            <i class="ays_fa ays_fa_info_circle"></i>
                                        </a>
                                    </div>
                                    <div class="col-sm-3 sccp_bc_btn_position_select_div" >
                                        <select id="sccp_sub_block_button_position" name="sccp_sub_block_button_position" class="ays-text-input-short">
                                            <option <?php echo ($sub_block_button_position == 'next-to') ? 'selected' : ''; ?> value="next-to"><?php echo esc_html__('Next to the input', 'secure-copy-content-protection'); ?></option>
                                            <option <?php echo ($sub_block_button_position == 'under') ? 'selected' : ''; ?> value="under"><?php echo esc_html__('Under the input', 'secure-copy-content-protection'); ?></option>
                                        </select>
                                        
                                    </div>
                                    <div class="col-sm-6"></div>
                                </div>
                            </div>
                        </div>
                    </div>                    
                    <div id="tab3" class="nav-tab-content only_pro <?php echo  ($sccp_tab == 'tab3') ? 'nav-tab-content-active' : ''; ?>">
                        <div class="ays-sccp-accordion-options-main-container" data-collapsed="false">
                            <div class="ays-sccp-accordion-container">
                                <?php echo $sccp_accordion_svg_html; ?>
                                <p class="ays-subtitle" style="margin-top:0;"><?php echo esc_html__( 'Block IPs', 'secure-copy-content-protection' ); ?></p>
                            </div>
                            <hr class="ays-sccp-bolder-hr"/>
                            <div class="ays-sccp-accordion-options-box">
                                <div class="pro_features">
                                    <div>
                                        <a href="https://ays-pro.com/wordpress/secure-copy-content-protection/" target="_blank" class="ays-sccp-new-upgrade-button-link">
                                            <div class="ays-sccp-new-upgrade-button-box">
                                                <div>
                                                    <img src="<?php echo SCCP_ADMIN_URL.'/images/icons/sccp_locked_24x24.svg'?>">
                                                    <img src="<?php echo SCCP_ADMIN_URL.'/images/icons/sccp_unlocked_24x24.svg'?>" class="ays-sccp-new-upgrade-button-hover">
                                                </div>
                                                <div class="ays-sccp-new-upgrade-button"><?php echo esc_html__("Upgrade", 'secure-copy-content-protection'); ?></div>
                                            </div>
                                        </a>
                                        <div class="ays-sccp-center-big-main-button-box ays-sccp-new-big-button-flex">
                                            <div class="ays-sccp-center-big-upgrade-button-box">
                                                <a href="https://ays-pro.com/wordpress/secure-copy-content-protection/" target="_blank" class="ays-sccp-new-upgrade-button-link">
                                                    <div class="ays-sccp-center-new-big-upgrade-button">
                                                        <img src="<?php echo SCCP_ADMIN_URL.'/images/icons/sccp_locked_24x24.svg'?>" class="ays-sccp-new-button-img-hide">
                                                        <img src="<?php echo SCCP_ADMIN_URL.'/images/icons/sccp_unlocked_24x24.svg'?>" class="ays-sccp-new-upgrade-button-hover">  
                                                        <?php echo esc_html__("Upgrade", 'secure-copy-content-protection'); ?>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="pro_features_img">
                                    <img src="<?php echo SCCP_ADMIN_URL . '/images/features/block_ip.png'; ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="tab4" class="nav-tab-content only_pro <?php echo  ($sccp_tab == 'tab4') ? 'nav-tab-content-active' : ''; ?>">
                        <div class="ays-sccp-accordion-options-main-container" data-collapsed="false">
                            <div class="ays-sccp-accordion-container">
                                <?php echo $sccp_accordion_svg_html; ?>
                                <p class="ays-subtitle" style="margin-top:0;"><?php echo esc_html__( 'Block Country', 'secure-copy-content-protection' ); ?></p>
                            </div>
                            <hr class="ays-sccp-bolder-hr"/>
                            <div class="ays-sccp-accordion-options-box">
                                <div class="pro_features">
                                    <div>
                                        <a href="https://ays-pro.com/wordpress/secure-copy-content-protection/" target="_blank" class="ays-sccp-new-upgrade-button-link">
                                            <div class="ays-sccp-new-upgrade-button-box">
                                                <div>
                                                    <img src="<?php echo SCCP_ADMIN_URL.'/images/icons/sccp_locked_24x24.svg'?>">
                                                    <img src="<?php echo SCCP_ADMIN_URL.'/images/icons/sccp_unlocked_24x24.svg'?>" class="ays-sccp-new-upgrade-button-hover">
                                                </div>
                                                <div class="ays-sccp-new-upgrade-button"><?php echo esc_html__("Upgrade", 'secure-copy-content-protection'); ?></div>
                                            </div>
                                        </a>
                                        <div class="ays-sccp-center-big-main-button-box ays-sccp-new-big-button-flex">
                                            <div class="ays-sccp-center-big-upgrade-button-box">
                                                <a href="https://ays-pro.com/wordpress/secure-copy-content-protection/" target="_blank" class="ays-sccp-new-upgrade-button-link">
                                                    <div class="ays-sccp-center-new-big-upgrade-button">
                                                        <img src="<?php echo SCCP_ADMIN_URL.'/images/icons/sccp_locked_24x24.svg'?>" class="ays-sccp-new-button-img-hide">
                                                        <img src="<?php echo SCCP_ADMIN_URL.'/images/icons/sccp_unlocked_24x24.svg'?>" class="ays-sccp-new-upgrade-button-hover">  
                                                        <?php echo esc_html__("Upgrade", 'secure-copy-content-protection'); ?>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="pro_features_img">
                                    <img src="<?php echo SCCP_ADMIN_URL . '/images/features/block_country.png'; ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="tab5" class="nav-tab-content container-fluid <?php echo  ($sccp_tab == 'tab5') ? 'nav-tab-content-active' : ''; ?>">
                        <div class="ays-sccp-accordion-options-main-container" data-collapsed="false">
                            <div class="ays-sccp-accordion-container">
                                <?php echo $sccp_accordion_svg_html; ?>
                                <p class="ays-subtitle" style="margin-top:0;"><?php echo esc_html__( 'Styles', 'secure-copy-content-protection' ); ?></p>
                            </div>
                            <hr class="ays-sccp-bolder-hr"/>
                            <div class="ays-sccp-accordion-options-box">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="copy_protection_container form-group row">
                                            <div class="col-sm-6">
                                                <label for="tooltip_position"><?php echo  esc_html__('Tooltip position', 'secure-copy-content-protection'); ?></label>
                                                <a class="ays_help" data-toggle="tooltip"
                                                   title="<?php echo  esc_attr__('Position of tooltip on window', 'secure-copy-content-protection') ?>">
                                                    <i class="ays_fa ays_fa_info_circle"></i>
                                                </a>
                                            </div>
                                            <div class="col-sm-6 ays_divider_left">
                                                <select id="tooltip_position" class="form-control" name="tooltip_position">
                                                    <?php
                                                    $tpositions = array(
                                                        "mouse"         => __("Mouse current position", 'secure-copy-content-protection'),
                                                        "mouse_first_pos"     => __("Mouse first position", 'secure-copy-content-protection'),
                                                        "center_center" => __("Center center", 'secure-copy-content-protection'),
                                                        "left_top"      => __("Left top", 'secure-copy-content-protection'),
                                                        "left_bottom"   => __("Left bottom", 'secure-copy-content-protection'),
                                                        "right_top"     => __("Right top", 'secure-copy-content-protection'),
                                                        "right_bottom"  => __("Right bottom", 'secure-copy-content-protection'),
                                                    );
                                                    foreach ( $tpositions as $value => $text ) {
                                                        $selected = (isset($data["styles"]["tooltip_position"]) && $data["styles"]["tooltip_position"] == $value) ? "selected" : "";
                                                        echo "<option value='{$value}' {$selected}>{$text}</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <hr/>
                                        <div class="copy_protection_container form-group row">
                                            <div class="col-sm-6">
                                                <label for="sscp_timeout"><?php echo  esc_html__('Notification text display duration', 'secure-copy-content-protection'); ?></label>
                                                <a class="ays_help" data-toggle="tooltip"
                                                   title="<?php echo  esc_attr__('Notification text display duration in milliseconds. 1000ms is default value.', 'secure-copy-content-protection') ?>">
                                                    <i class="ays_fa ays_fa_info_circle"></i>
                                                </a>
                                            </div>
                                            <div class="col-sm-6 ays_divider_left ays_sccp_display_flex">
                                                <div>
                                                   <input type="number" id="sscp_timeout" name="sscp_timeout"
                                                       value="<?php echo  isset($data["options"]["timeout"]) ? $data["options"]["timeout"] : 1000 ?>"/>
                                                </div>
                                                <div class="ays_sccp_dropdown_max_width">
                                                    <input type="text" value="ms" class="ays-sccp-form-hint-for-size" disabled="">
                                                </div>
                                            </div>
                                        </div>
                                        <hr/>
                                        <div class="copy_protection_container form-group row">
                                            <div class="col-sm-6">
                                                <label for="bg_color"><?php echo  esc_html__('Tooltip background color', 'secure-copy-content-protection'); ?></label>
                                                <a class="ays_help" data-toggle="tooltip"
                                                   title="<?php echo  esc_attr__('Filler color of tooltip', 'secure-copy-content-protection') ?>">
                                                    <i class="ays_fa ays_fa_info_circle"></i>
                                                </a>
                                            </div>
                                            <div class="col-sm-6 ays_divider_left">
                                                <input type="text" id="bg_color" data-alpha="true" name="bg_color"
                                                       value="<?php echo  stripslashes( esc_attr( $data["styles"]["bg_color"] ) ); ?>"/>
                                            </div>
                                        </div>
                                        <hr>
                                        <!-- SCCP background gradient start-->
                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <label for="ays_sccp_enable_background_gradient">
                                                    <?php echo esc_html__('Tooltip background gradient','secure-copy-content-protection')?>
                                                    <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_attr__('Color gradient of the tooltip background','secure-copy-content-protection')?>">
                                                        <i class="ays_fa ays_fa_info_circle"></i>
                                                    </a>
                                                </label>
                                            </div>
                                            <div class="col-sm-6 ays_divider_left">
                                                <input type="checkbox" class="ays_toggle ays_toggle_slide" id="ays_sccp_enable_background_gradient" name="ays_sccp_enable_background_gradient" <?php echo ($enable_background_gradient) ? 'checked' : ''; ?>/>
                                                <label for="ays_sccp_enable_background_gradient" class="ays_switch_toggle">Toggle</label>

                                                <div class="row ays_toggle_target" style="margin: 10px 0 0 0; padding-top: 10px; <?php echo ($enable_background_gradient) ? '' : 'display:none;' ?>">
                                                    <div class="col-sm-12 ays_divider_top" style="margin-top: 10px; padding-top: 10px;">
                                                        <label for='ays-sccp-background-gradient-color-1'>
                                                            <?php echo esc_html__('Color 1', 'secure-copy-content-protection'); ?>
                                                            <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_attr__('Color 1 of the tooltip background gradient','secure-copy-content-protection')?>">
                                                                <i class="ays_fa ays_fa_info_circle"></i>
                                                            </a>
                                                        </label>
                                                        <input type="text" class="ays-text-input" id='ays-sccp-background-gradient-color-1' name='ays_sccp_background_gradient_color_1' data-alpha="true" value="<?php echo $background_gradient_color_1; ?>"/>
                                                    </div>
                                                    <div class="col-sm-12 ays_divider_top" style="margin-top: 10px; padding-top: 10px;">
                                                        <label for='ays-sccp-background-gradient-color-2'>
                                                            <?php echo esc_html__('Color 2', 'secure-copy-content-protection'); ?>
                                                            <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_attr__('Color 2 of the tooltip background gradient','secure-copy-content-protection')?>">
                                                                <i class="ays_fa ays_fa_info_circle"></i>
                                                            </a>
                                                        </label>
                                                        <input type="text" class="ays-text-input" id='ays-sccp-background-gradient-color-2' name='ays_sccp_background_gradient_color_2' data-alpha="true" value="<?php echo $background_gradient_color_2; ?>"/>
                                                    </div>
                                                    <div class="col-sm-12 ays_divider_top" style="margin-top: 10px; padding-top: 10px;">
                                                        <label for="ays_sccp_gradient_direction">
                                                            <?php echo esc_html__('Gradient direction','secure-copy-content-protection')?>
                                                            <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_attr__('The direction of the color gradient.','secure-copy-content-protection')?>">
                                                                <i class="ays_fa ays_fa_info_circle"></i>
                                                            </a>
                                                        </label>
                                                        <select id="ays_sccp_gradient_direction" name="ays_sccp_gradient_direction" class="ays-text-input">
                                                            <option <?php echo ($sccp_gradient_direction == 'vertical') ? 'selected' : ''; ?> value="vertical"><?php echo esc_html__( 'Vertical', 'secure-copy-content-protection'); ?></option>
                                                            <option <?php echo ($sccp_gradient_direction == 'horizontal') ? 'selected' : ''; ?> value="horizontal"><?php echo esc_html__( 'Horizontal', 'secure-copy-content-protection'); ?></option>
                                                            <option <?php echo ($sccp_gradient_direction == 'diagonal_left_to_right') ? 'selected' : ''; ?> value="diagonal_left_to_right"><?php echo esc_html__( 'Diagonal left to right', 'secure-copy-content-protection'); ?></option>
                                                            <option <?php echo ($sccp_gradient_direction == 'diagonal_right_to_left') ? 'selected' : ''; ?> value="diagonal_right_to_left"><?php echo esc_html__( 'Diagonal right to left', 'secure-copy-content-protection'); ?></option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> 
                                        <!-- SCCP background gradient end-->
                                        <hr/>
                                        <!-- AV BG Image -->
                                        <div class="copy_protection_container form-group row">
                                            <div class="col-sm-6">
                                                <label>
                                                    <?php echo esc_html__('Tooltip background image','secure-copy-content-protection')?>
                                                    <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_attr__('Background image for of the tooltip','secure-copy-content-protection')?>">
                                                        <i class="ays_fa ays_fa_info_circle"></i>
                                                    </a>
                                                </label>
                                            </div>                                    
                                            <div class="col-sm-6 ays_divider_left">
                                                <a href="javascript:void(0)" id="sccp_bg_image" style="<?php echo !isset($data["styles"]["bg_image"]) || empty($data["styles"]["bg_image"]) ? 'display:inline-block;' : 'display:none;'; ?>" class="add-sccp-bg-image"><?php echo $bg_image_text; ?></a>
                                                <input type="hidden" id="ays_sccp_bg_image" name="ays_sccp_bg_image"
                                                       value="<?php echo $sccp_bg_image; ?>"/>
                                                <div id="sccp_bg_image_container" class="ays-sccp-bg-image-container" style="<?php echo !isset($data["styles"]["bg_image"]) || empty($data["styles"]["bg_image"]) ? 'display:none' : 'display:block'; ?>">
                                                    <span class="ays-edit-sccp-bg-img">
                                                        <i class="ays_fa ays_fa_pencil_square_o"></i>
                                                    </span>
                                                    <span class="ays-remove-sccp-bg-img"></span>
                                                    <img src="<?php echo $sccp_bg_image; ?>" id="ays-sccp-bg-img"/>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- AV BG Image End -->
                                        <hr/>
                                        <!-- Tooltip BG Image Position Start -->
                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <label for="ays_sccp_tooltip_bg_image_position">
                                                    <?php echo esc_html__( "Tooltip background image position", 'secure-copy-content-protection' ); ?>
                                                    <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_attr__('The position of background image of the tooltip','secure-copy-content-protection')?>">
                                                        <i class="ays_fa ays_fa_info_circle"></i>
                                                    </a>
                                                </label>
                                            </div>
                                            <div class="col-sm-6 ays_divider_left">
                                                <select id="ays_sccp_tooltip_bg_image_position" name="ays_sccp_tooltip_bg_image_position" class="ays-text-input" style="display:inline-block;">
                                                    <option value="left top" <?php echo $tooltip_bg_image_position == "left top" ? "selected" : ""; ?>><?php echo esc_html__( "Left Top", 'secure-copy-content-protection' ); ?></option>
                                                    <option value="left center" <?php echo $tooltip_bg_image_position == "left center" ? "selected" : ""; ?>><?php echo esc_html__( "Left Center", 'secure-copy-content-protection' ); ?></option>
                                                    <option value="left bottom" <?php echo $tooltip_bg_image_position == "left bottom" ? "selected" : ""; ?>><?php echo esc_html__( "Left Bottom", 'secure-copy-content-protection' ); ?></option>
                                                    <option value="center top" <?php echo $tooltip_bg_image_position == "center top" ? "selected" : ""; ?>><?php echo esc_html__( "Center Top", 'secure-copy-content-protection' ); ?></option>
                                                    <option value="center center" <?php echo $tooltip_bg_image_position == "center center" ? "selected" : ""; ?>><?php echo esc_html__( "Center Center", 'secure-copy-content-protection' ); ?></option>
                                                    <option value="center bottom" <?php echo $tooltip_bg_image_position == "center bottom" ? "selected" : ""; ?>><?php echo esc_html__( "Center Bottom", 'secure-copy-content-protection' ); ?></option>
                                                    <option value="right top" <?php echo $tooltip_bg_image_position == "right top" ? "selected" : ""; ?>><?php echo esc_html__( "Right Top", 'secure-copy-content-protection' ); ?></option>
                                                    <option value="right center" <?php echo $tooltip_bg_image_position == "right center" ? "selected" : ""; ?>><?php echo esc_html__( "Right Center", 'secure-copy-content-protection' ); ?></option>
                                                    <option value="right bottom" <?php echo $tooltip_bg_image_position == "right bottom" ? "selected" : ""; ?>><?php echo esc_html__( "Right Bottom", 'secure-copy-content-protection' ); ?></option>
                                                </select>
                                            </div>
                                        </div>
                                        <!-- Tooltip BG Image Position End -->
                                        <hr>
                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <label for="ays_sccp_tooltip_bg_image_object_fit">
                                                    <?php echo esc_html__( "Tooltip background image object-fit", 'secure-copy-content-protection' ); ?>
                                                    <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_attr__('Specify how a sccp tooltip image should be resized to fit its container.','secure-copy-content-protection')?>">
                                                        <i class="ays_fa ays_fa_info_circle"></i>
                                                    </a>
                                                </label>
                                            </div>
                                            <div class="col-sm-6 ays_divider_left">
                                                <select name="ays_sccp_tooltip_bg_image_object_fit" id="ays_sccp_tooltip_bg_image_object_fit" class="ays-text-input" >
                                                <?php
                                                    foreach ($sccp_image_object_fit_arr as $sccp_image_object_fit_key => $sccp_image_object_fit_value):
                                                        if ( $tooltip_bg_image_object_fit == $sccp_image_object_fit_key ) {
                                                            $selected = 'selected';
                                                        }else{
                                                            $selected = '';
                                                        }
                                                ?>
                                                    <option value="<?php echo $sccp_image_object_fit_key;?>" <?php echo $selected; ?>>
                                                        <?php echo $sccp_image_object_fit_value; ?>
                                                    </option>
                                                <?php
                                                    endforeach;
                                                ?>
                                                </select>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <label for="ays_sccp_tooltip_text_transformation">
                                                    <?php echo esc_html__('Tooltip text transformation', 'secure-copy-content-protection' ); ?>
                                                    <a class="ays_help" data-toggle="tooltip" data-html="true" data-placement="top" title="<?php
                                                        echo esc_attr__("Specify how to capitalize a title text of your tooltip.", 'secure-copy-content-protection') .
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
                                            <div class="col-sm-6 ays_divider_left">
                                                <select name="ays_sccp_tooltip_text_transformation" id="ays_sccp_tooltip_text_transformation" class="ays-text-input" style="display:block;">
                                                    <option value="none" <?php echo $tooltip_text_transformation == 'none' ? 'selected' : ''; ?>><?php echo esc_html__( "None", 'secure-copy-content-protection' ); ?></option>
                                                    <option value="uppercase" <?php echo $tooltip_text_transformation == 'uppercase' ? 'selected' : ''; ?>><?php echo esc_html__( "Uppercase", 'secure-copy-content-protection' ); ?></option>
                                                    <option value="lowercase" <?php echo $tooltip_text_transformation == 'lowercase' ? 'selected' : ''; ?>><?php echo esc_html__( "Lowercase", 'secure-copy-content-protection' ); ?></option>
                                                    <option value="capitalize" <?php echo $tooltip_text_transformation == 'capitalize' ? 'selected' : ''; ?>><?php echo esc_html__( "Capitalize", 'secure-copy-content-protection' ); ?></option>
                                                </select>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="copy_protection_container form-group row">
                                            <div class="col-sm-6">
                                                <label for="tooltip_letter_spacing"><?php echo  esc_html__('Tooltip letter spacing', 'secure-copy-content-protection'); ?></label>
                                                <a class="ays_help" data-toggle="tooltip"
                                                   title="<?php echo  esc_attr__('Define the space between the letters of the tooltip text in pixels. Note: The default value for this option is 0.', 'secure-copy-content-protection') ?>">
                                                    <i class="ays_fa ays_fa_info_circle"></i>
                                                </a>
                                            </div>
                                            <div class="col-sm-6 ays_divider_left ays_sccp_display_flex">
                                                <div>
                                                   <input type="number" id="tooltip_letter_spacing" name="tooltip_letter_spacing" class="form-control"
                                                       value="<?php echo $tooltip_letter_spacing; ?>"/>
                                                </div>
                                                <div class="ays_sccp_dropdown_max_width">
                                                    <input type="text" value="px" class="ays-sccp-form-hint-for-size" disabled="">
                                                </div>
                                            </div>                                    
                                        </div>
                                        <hr>
                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <label for="sccp_tooltip_bg_blur">
                                                    <?php echo esc_html__( "Tooltip Background Blur", 'secure-copy-content-protection' ); ?>
                                                    <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_attr__('The background blur of the tooltip.','secure-copy-content-protection')?>">
                                                        <i class="ays_fa ays_fa_info_circle"></i>
                                                    </a>
                                                </label>
                                            </div>
                                            <div class="col-sm-6 ays_divider_left">
                                                <input class="sccp_bg_blur" id="sccp_tooltip_bg_blur" name="ays_sccp_tooltip_bg_blur" type="range" min="0" max="20" step="1" value="<?php echo $tooltip_bg_blur; ?>">
                                            </div>
                                        </div>
                                        <hr/>
                                        <div class="copy_protection_container form-group row">
                                            <div class="col-sm-6">
                                                <label for="sccp_tooltip_opacity">
                                                    <?php echo esc_html__("Tooltip opacity", 'secure-copy-content-protection');?>
                                                    <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_attr__("The opacity degree of the tooltip", 'secure-copy-content-protection');?>">
                                                       <i class="ays_fa ays_fa_info_circle"></i>
                                                    </a>
                                                </label>
                                            </div>                                
                                            <div class="col-sm-6 ays_divider_left">
                                                <div class="ays_opacity_demo">
                                                    <input class="sccp_opacity_demo_val" id="sccp_tooltip_opacity" name="ays_sccp_tooltip_opacity" type="range" min="0" max="1" step="0.01" value="<?php echo isset($data["styles"]['tooltip_opacity']) ? $data["styles"]['tooltip_opacity'] : '1'; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <hr/>
                                        <div class="copy_protection_container form-group row">
                                            <div class="col-sm-6">
                                                <label for="text_color"><?php echo  esc_html__('Tooltip text color', 'secure-copy-content-protection'); ?></label>
                                                <a class="ays_help" data-toggle="tooltip"
                                                   title="<?php echo  esc_attr__('Color of tooltip text', 'secure-copy-content-protection') ?>">
                                                    <i class="ays_fa ays_fa_info_circle"></i>
                                                </a>
                                            </div>
                                            <div class="col-sm-6 ays_divider_left">
                                                <input type="text" id="text_color" data-alpha="true" name="text_color"
                                                       value="<?php echo  stripslashes( esc_attr(  $data["styles"]["text_color"] ) ); ?>"/>
                                            </div>
                                        </div>
                                        <hr/>
                                        <div class="copy_protection_container form-group row">
                                            <div class="col-sm-6">
                                                <label for="font_size"><?php echo  esc_html__('Tooltip Font size', 'secure-copy-content-protection'); ?>
                                                    <a class="ays_help" data-toggle="tooltip"
                                                       title="<?php echo  esc_attr__('Size of tooltip text', 'secure-copy-content-protection') ?>">
                                                        <i class="ays_fa ays_fa_info_circle"></i>
                                                    </a>
                                                </label>
                                            </div>                                        
                                            <div class="col-sm-6 ays_divider_left">
                                                <div class="row">
                                                    <div class="col-sm-5">
                                                        <label for='font_size'>
                                                            <?php echo esc_html__('On PC', 'secure-copy-content-protection'); ?>
                                                            <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_attr__('Define the font size for PC devices.','secure-copy-content-protection'); ?>">
                                                                <i class="ays_fa ays_fa_info_circle"></i>
                                                            </a>
                                                        </label>
                                                    </div>
                                                    <div class="col-sm-7 ays_divider_left ays_sccp_display_flex">
                                                        <div>
                                                           <input type="number" id="font_size" name="font_size" class="ays-text-input ays-text-input-short" value="<?php echo $font_size; ?>"/>
                                                        </div>
                                                        <div class="ays_sccp_dropdown_max_width">
                                                            <input type="text" value="px" class="ays-sccp-form-hint-for-size" disabled="">
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-sm-5">
                                                        <label for='mobile_font_size'>
                                                            <?php echo esc_html__('On mobile', 'secure-copy-content-protection'); ?>
                                                            <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_attr__('Define the font size for mobile devices.','secure-copy-content-protection'); ?>">
                                                                <i class="ays_fa ays_fa_info_circle"></i>
                                                            </a>
                                                        </label>
                                                    </div>
                                                    <div class="col-sm-7 ays_divider_left ays_sccp_display_flex">
                                                        <div>
                                                           <input type="number" class="ays-text-input ays-text-input-short" id='mobile_font_size' name='mobile_font_size' value="<?php echo $mobile_font_size; ?>"/>
                                                        </div>
                                                        <div class="ays_sccp_dropdown_max_width">
                                                            <input type="text" value="px" class="ays-sccp-form-hint-for-size" disabled="">
                                                        </div>
                                                    </div>                                            
                                                </div>
                                               
                                            </div> <!-- font size -->                                   
                                        </div>
                                        <hr/>
                                        <div class="copy_protection_container form-group row">
                                            <div class="col-sm-6">
                                                <label for="ays_tooltip_padding_top_bottom"><?php echo  esc_html__('Tooltip padding', 'secure-copy-content-protection'); ?></label>
                                                <a class="ays_help" data-toggle="tooltip"
                                                   title="<?php echo  esc_attr__('Tooltip padding in pixels.', 'secure-copy-content-protection') ?>">
                                                    <i class="ays_fa ays_fa_info_circle"></i>
                                                </a>
                                            </div>
                                            <div class="col-sm-6 ays_divider_left ays_sccp_display_flex">
                                                <div class="col-sm-6 ays_sccp_display_flex" style="align-items: flex-end;">
                                                    <div>
                                                        <span class="ays_sccp_small_hint_text">Top / Bottom</span>
                                                       <input type="number" id="ays_tooltip_padding_top_bottom" name="ays_tooltip_padding_top_bottom" class="form-control" value="<?php echo $tooltip_padding_top_bottom; ?>"/>
                                                    </div>
                                                    <div class="ays_sccp_dropdown_max_width">
                                                        <input type="text" value="px" class="ays-sccp-form-hint-for-size" disabled="">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 ays_divider_left ays_sccp_display_flex" style="align-items: flex-end;">
                                                    <div>
                                                        <span class="ays_sccp_small_hint_text">Left / Right</span>
                                                       <input type="number" id="ays_tooltip_padding_left_right" name="ays_tooltip_padding_left_right" class="form-control"
                                                           value="<?php echo $tooltip_padding_left_right; ?>"/>
                                                    </div>
                                                    <div class="ays_sccp_dropdown_max_width">
                                                        <input type="text" value="px" class="ays-sccp-form-hint-for-size" disabled="">
                                                    </div>
                                                </div>
                                            </div>                                    
                                        </div>
                                        <hr/>
                                        <div class="copy_protection_container form-group row">
                                            <div class="col-sm-6">
                                                <label for="boxshadow_color"><?php echo  esc_html__('Tooltip box shadow', 'secure-copy-content-protection'); ?></label>
                                                <a class="ays_help" data-toggle="tooltip"
                                                   title="<?php echo  esc_attr__('Box-shadow color for tooltip', 'secure-copy-content-protection'); ?>">
                                                    <i class="ays_fa ays_fa_info_circle"></i>
                                                </a>
                                            </div>
                                            <div class="col-sm-6 ays_divider_left">
                                                <div class="col-sm-6">
                                                    <input type="text" id="boxshadow_color" data-alpha="true" name="boxshadow_color"
                                                           value="<?php echo  $boxshadow_color; ?>"/>
                                                </div>
                                                <hr>
                                                <div class="col-sm-12">
                                                    <div>
                                                        <span class="ays_sccp_small_hint_text"><?php echo esc_html__('X', 'secure-copy-content-protection'); ?></span>
                                                        <input type="number" class="ays-text-input ays-text-input-80-width" id='ays_sccp_box_shadow_x_offset' name='ays_sccp_box_shadow_x_offset' value="<?php echo $sccp_box_shadow_x_offset; ?>" />
                                                    </div>
                                                    <div style="margin-top: 5px;">
                                                        <span class="ays_sccp_small_hint_text"><?php echo esc_html__('Y', 'secure-copy-content-protection'); ?></span>
                                                        <input type="number" class="ays-text-input ays-text-input-80-width" id='ays_sccp_box_shadow_y_offset' name='ays_sccp_box_shadow_y_offset' value="<?php echo $sccp_box_shadow_y_offset; ?>" />
                                                    </div>
                                                    <div style="margin-top: 5px;">
                                                        <span class="ays_sccp_small_hint_text"><?php echo esc_html__('Z', 'secure-copy-content-protection'); ?></span>
                                                        <input type="number" class="ays-text-input ays-text-input-80-width" id='ays_sccp_box_shadow_z_offset' name='ays_sccp_box_shadow_z_offset' value="<?php echo $sccp_box_shadow_z_offset; ?>" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr/>
                                        <div class="copy_protection_container form-group row">
                                            <div class="col-sm-6">
                                                <label for="border_color"><?php echo  esc_html__('Tooltip border color', 'secure-copy-content-protection'); ?></label>
                                                <a class="ays_help" data-toggle="tooltip"
                                                   title="<?php echo  esc_attr__('Color of tooltip border', 'secure-copy-content-protection') ?>">
                                                    <i class="ays_fa ays_fa_info_circle"></i>
                                                </a>
                                            </div>
                                            <div class="col-sm-6 ays_divider_left">
                                                <input type="text" id="border_color" data-alpha="true" name="border_color"
                                                       value="<?php echo  stripslashes( esc_attr($data["styles"]["border_color"]) ); ?>"/>
                                            </div>
                                        </div>                                
                                        <hr/>
                                        <div class="copy_protection_container form-group row">
                                            <div class="col-sm-6">
                                                <label for="border_width"><?php echo  esc_html__('Tooltip border width', 'secure-copy-content-protection'); ?></label>
                                                <a class="ays_help" data-toggle="tooltip"
                                                   title="<?php echo  esc_attr__('This shows the thickness of the border in pixels', 'secure-copy-content-protection') ?>">
                                                    <i class="ays_fa ays_fa_info_circle"></i>
                                                </a>
                                            </div>
                                            <div class="col-sm-6 ays_divider_left ays_sccp_display_flex">
                                                <div>
                                                   <input type="number" id="border_width" name="border_width" class="form-control"
                                                       value="<?php echo  $data["styles"]["border_width"]; ?>"/>
                                                </div>
                                                <div class="ays_sccp_dropdown_max_width">
                                                    <input type="text" value="px" class="ays-sccp-form-hint-for-size" disabled="">
                                                </div>
                                            </div>                                    
                                        </div>
                                        <hr/>                                
                                        <div class="copy_protection_container form-group row">
                                            <div class="col-sm-6">
                                                <label for="border_radius"><?php echo  esc_html__('Tooltip border radius', 'secure-copy-content-protection'); ?></label>
                                                <a class="ays_help" data-toggle="tooltip"
                                                   title="<?php echo  esc_attr__('This shows if the border has curvature', 'secure-copy-content-protection') ?>">
                                                    <i class="ays_fa ays_fa_info_circle"></i>
                                                </a>
                                            </div>
                                            <div class="col-sm-6 ays_divider_left ays_sccp_display_flex">
                                                <div>
                                                   <input type="number" id="border_radius" name="border_radius"
                                                       class="form-control"
                                                       value="<?php echo  $data["styles"]["border_radius"]; ?>"/>
                                                </div>
                                                <div class="ays_sccp_dropdown_max_width">
                                                    <input type="text" value="px" class="ays-sccp-form-hint-for-size" disabled="">
                                                </div>
                                            </div>
                                        </div>
                                        <hr/>
                                        <div class="copy_protection_container form-group row">
                                            <div class="col-sm-6">
                                                <label for="border_style"><?php echo  esc_html__('Tooltip border style', 'secure-copy-content-protection'); ?></label>
                                                <a class="ays_help" data-toggle="tooltip"
                                                   title="<?php echo  esc_attr__('This shows if the border is highlighted with style', 'secure-copy-content-protection') ?>">
                                                    <i class="ays_fa ays_fa_info_circle"></i>
                                                </a>
                                            </div>
                                            <div class="col-sm-6 ays_divider_left">
                                                <select id="border_style" class="ays-text-input ays-text-input-short" name="border_style">
                                                    <?php
                                                    $bstyles      = array("none", "solid", "double", "dotted", "dashed", "groove", "ridge", "inset", "outset");
                                                    $bstyles_text = array(
                                                        __("None", 'secure-copy-content-protection'),
                                                        __("Solid", 'secure-copy-content-protection'),
                                                        __("Double", 'secure-copy-content-protection'),
                                                        __("Dotted", 'secure-copy-content-protection'),
                                                        __("Dashed", 'secure-copy-content-protection'),
                                                        __("Groove", 'secure-copy-content-protection'),
                                                        __("Ridge", 'secure-copy-content-protection'),
                                                        __("Inset", 'secure-copy-content-protection'),
                                                        __("Outset", 'secure-copy-content-protection')
                                                    );
                                                    foreach ( $bstyles as $key => $bstyle ) {
                                                        $selected = ($data["styles"]["border_style"] == $bstyle) ? "selected" : "";
                                                        echo "<option value='{$bstyle}' {$selected}>" . $bstyles_text[$key] . "</option>";
                                                    }
                                                    ?>
                                                </select>                                        
                                            </div>
                                        </div>
                                        <hr/>
                                        <!-- title text shadow start -->
                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <label for="ays_sccp_enable_title_text_shadow">
                                                    <?php echo esc_html__('Tooltip title text shadow','secure-copy-content-protection')?>
                                                    <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_attr__('Add text shadow for the tooltip title.','secure-copy-content-protection')?>">
                                                        <i class="ays_fa ays_fa_info_circle"></i>
                                                    </a>
                                                </label>
                                            </div>
                                            <div class="col-sm-6 ays_divider_left">
                                                <input type="checkbox" class="ays_toggle ays_toggle_slide" id="ays_sccp_enable_title_text_shadow" name="ays_sccp_enable_title_text_shadow" <?php echo ($enable_sccp_title_text_shadow) ? 'checked' : ''; ?>/>
                                                <label for="ays_sccp_enable_title_text_shadow" class="ays_switch_toggle">Toggle</label>
                                                <div class="row ays_toggle_target" style="margin: 10px 0 0 0; padding-top: 10px; <?php echo ($enable_sccp_title_text_shadow) ? '' : 'display:none;' ?>">
                                                    <div class="col-sm-12 ays_divider_top" style="margin-top: 10px; padding-top: 10px;">
                                                        <label for='ays_sccp_tooltip_title_text_shadow_color'>
                                                            <?php echo esc_html__('Color', 'secure-copy-content-protection'); ?>
                                                            <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_attr__('Specify text shadow color.','secure-copy-content-protection')?>">
                                                                <i class="ays_fa ays_fa_info_circle"></i>
                                                            </a>
                                                        </label>
                                                        <input type="text" class="ays-text-input" id='ays_sccp_tooltip_title_text_shadow_color' data-alpha="true" name='ays_sccp_tooltip_title_text_shadow_color' value="<?php echo $sccp_title_text_shadow; ?>"/>
                                                    </div>
                                                </div>
                                                <hr class="ays_toggle_target" style="<?php echo ($enable_sccp_title_text_shadow) ? '' : 'display:none;' ?>">
                                                <div class="col-sm-12 ays_toggle_target" style="<?php echo ($enable_sccp_title_text_shadow) ? '' : 'display:none;' ?>">
                                                    <div>
                                                        <span class="ays_sccp_small_hint_text"><?php echo esc_html__('X', 'secure-copy-content-protection'); ?></span>
                                                        <input type="number" class="ays-text-input ays-text-input-80-width" id='ays_sccp_text_shadow_x_offset' name='ays_sccp_text_shadow_x_offset' value="<?php echo $sccp_text_shadow_x_offset; ?>" />
                                                    </div>
                                                    <div style="margin-top: 5px;">
                                                        <span class="ays_sccp_small_hint_text"><?php echo esc_html__('Y', 'secure-copy-content-protection'); ?></span>
                                                        <input type="number" class="ays-text-input ays-text-input-80-width" id='ays_sccp_text_shadow_y_offset' name='ays_sccp_text_shadow_y_offset' value="<?php echo $sccp_text_shadow_y_offset; ?>" />
                                                    </div>
                                                    <div style="margin-top: 5px;">
                                                        <span class="ays_sccp_small_hint_text"><?php echo esc_html__('Z', 'secure-copy-content-protection'); ?></span>
                                                        <input type="number" class="ays-text-input ays-text-input-80-width" id='ays_sccp_text_shadow_z_offset' name='ays_sccp_text_shadow_z_offset' value="<?php echo $sccp_text_shadow_z_offset; ?>" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- title text shadow end -->
                                        <hr/>
                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <label for="ays_sccp_custom_class">
                                                    <?php echo esc_html__('Custom class for tooltip container','secure-copy-content-protection')?>
                                                    <a class="ays_help" data-toggle="tooltip" title="<?php echo esc_attr__('Custom HTML class for tooltip container. You can use your class for adding your custom styles for tooltip container.','secure-copy-content-protection')?>">
                                                        <i class="ays_fa ays_fa_info_circle"></i>
                                                    </a>
                                                </label>
                                            </div>
                                            <div class="col-sm-6 ays_divider_left">
                                                <input type="text" class="ays-text-input" name="ays_sccp_custom_class" id="ays_sccp_custom_class" placeholder="myClass myAnotherClass..." value="<?php echo $custom_class; ?>">
                                            </div>
                                        </div>                                
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="copy_protection_container ays_tooltip_container">
                                            <div id="ays_tooltip" class="ays-tooltip-live-container">
                                                <div id="ays_tooltip_block">
                                                    <?php echo  isset($data['protection_text']) ? $data['protection_text'] : 'You cannot copy content of this page' ?>
                                                </div>
                                            </div>
                                            <style>
                                                #ays_tooltip {
                                                    width: fit-content;
                                                    width: -moz-fit-content;
                                                    background-color:<?php echo  isset($data["styles"]["bg_color"]) ? stripslashes( esc_attr( $data["styles"]["bg_color"] ) ) : '#ffffff' ?>;
                                                    background-image: url(' <?php echo  isset($data["styles"]["bg_image"]) ? $data["styles"]["bg_image"] : '' ?>');
                                                    background-repeat: no-repeat;
                                                    background-position: <?php echo $tooltip_bg_image_position ?>;
                                                    background-size: <?php echo $tooltip_bg_image_object_fit ?>;
                                                    border-color: <?php echo  isset($data["styles"]["border_color"]) ? stripslashes( esc_attr($data["styles"]["border_color"] ) ) : '#b7b7b7' ?>;
                                                    box-shadow: <?php echo  isset($data["styles"]["boxshadow_color"]) ? stripslashes( esc_attr(  $data["styles"]["boxshadow_color"] ) ). ' ' . $box_shadow_offsets .' 1px' : 'rgba(0,0,0,0)' ?>;
                                                    letter-spacing: <?php echo  isset($data["styles"]["letter_spacing"]) ? $data["styles"]["letter_spacing"].'px' : '0' ?>;
                                                    border-width: <?php echo  isset($data["styles"]["border_width"]) ? $data["styles"]["border_width"].'px' : '1px' ?>;
                                                    border-radius: <?php echo  isset($data["styles"]["border_radius"]) ? $data["styles"]["border_radius"].'px' : '3px' ?>;
                                                    border-style: <?php echo  isset($data["styles"]["border_style"]) ? $data["styles"]["border_style"] : 'solid' ?>;
                                                    color: <?php echo  !empty($data["styles"]["text_color"]) ? stripslashes( esc_attr( $data["styles"]["text_color"] ) ) : '#ff0000' ?>;
                                                    padding: <?php echo $tooltip_padding_top_bottom; ?>px <?php echo $tooltip_padding_left_right; ?>px;
                                                    opacity:<?php echo isset($data["styles"]['tooltip_opacity']) ? $data["styles"]['tooltip_opacity'] : '1'; ?> ;
                                                    box-sizing: border-box;
                                                    margin: 50px auto;
                                                    <?php echo $tooltip_title_shadow; ?>;
                                                }

                                                #ays_tooltip > * {
                                                    color: <?php echo  !empty($data["styles"]["text_color"]) ? stripslashes(esc_attr( $data["styles"]["text_color"] ) ) : '#ff0000' ?>;
                                                }

                                                #ays_tooltip_block > * {
                                                    font-size: <?php echo  !empty($data["styles"]["font_size"]) ? $data["styles"]["font_size"] : "12"?>px;
                                                }
                                                #ays_tooltip_block {
                                                    font-size: <?php echo  !empty($data["styles"]["font_size"]) ? $data["styles"]["font_size"] : "12"?>px;
                                                    backdrop-filter: blur(<?php echo  $tooltip_bg_blur; ?>px);
                                                }
                                            </style>
                                            <style id="ays-sccp-custom-styles">
                                                <?php echo  isset($data["styles"]["custom_css"]) ? stripslashes ( esc_attr( $data["styles"]["custom_css"] ) ) : '' ?>
                                            </style>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                            </div>
                        </div>
                        <div class="copy_protection_container form-group row">
                            <div class="col-sm-3">
                                <label for="sccp_custom_css">
                                    <?php echo  esc_html__('Custom CSS', 'secure-copy-content-protection') ?>
                                    <a class="ays_help" data-toggle="tooltip"
                                       title="<?php echo  esc_attr__('Field for entering your own CSS code', 'secure-copy-content-protection') ?>">
                                        <i class="ays_fa ays_fa_info_circle"></i>
                                    </a>
                                </label>
                            </div>
                            <div class="col-sm-9 ays_divider_left">
                                <textarea class="ays-textarea" id="sccp_custom_css" name="custom_css" cols="33" rows="7"><?php echo  isset($data["styles"]["custom_css"]) ? stripslashes ( esc_attr( $data["styles"]["custom_css"] ) ): '' ?></textarea>
                            </div>
                        </div>
                        <hr/>
                        <div class="copy_protection_container form-group row">
                            <div class="col-sm-3">
                                <label for="reset_to_default">
                                    <?php echo esc_html__('Reset styles', 'secure-copy-content-protection') ?>
                                    <a class="ays_help" data-toggle="tooltip"
                                       title="<?php echo esc_attr__('Reset tooltip styles to default values', 'secure-copy-content-protection') ?>">
                                        <i class="ays_fa ays_fa_info_circle"></i>
                                    </a>
                                </label>
                            </div>
                            <div class="col-sm-9 ays_divider_left">
                                <button type="button" class="ays-button button-secondary"
                                        id="reset_to_default"><?php echo  esc_html__("Reset", 'secure-copy-content-protection') ?>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div id="tab6" class="nav-tab-content only_pro <?php echo  ($sccp_tab == 'tab6') ? 'nav-tab-content-active' : ''; ?>">
                        <div class="ays-sccp-accordion-options-main-container" data-collapsed="false">
                            <div class="ays-sccp-accordion-container">
                                <?php echo $sccp_accordion_svg_html; ?>
                                <p class="ays-subtitle" style="margin-top:0;"><?php echo esc_html__( 'Page Blocker', 'secure-copy-content-protection' ); ?></p>
                            </div>
                            <hr class="ays-sccp-bolder-hr"/>
                            <div class="ays-sccp-accordion-options-box">
                                <div class="pro_features">
                                    <div>
                                        <a href="https://ays-pro.com/wordpress/secure-copy-content-protection/" target="_blank" class="ays-sccp-new-upgrade-button-link">
                                            <div class="ays-sccp-new-upgrade-button-box">
                                                <div>
                                                    <img src="<?php echo SCCP_ADMIN_URL.'/images/icons/sccp_locked_24x24.svg'?>">
                                                    <img src="<?php echo SCCP_ADMIN_URL.'/images/icons/sccp_unlocked_24x24.svg'?>" class="ays-sccp-new-upgrade-button-hover">
                                                </div>
                                                <div class="ays-sccp-new-upgrade-button"><?php echo esc_html__("Upgrade", 'secure-copy-content-protection'); ?></div>
                                            </div>
                                        </a>
                                        <div class="ays-sccp-center-big-main-button-box ays-sccp-new-big-button-flex">
                                            <div class="ays-sccp-center-big-upgrade-button-box">
                                                <a href="https://ays-pro.com/wordpress/secure-copy-content-protection/" target="_blank" class="ays-sccp-new-upgrade-button-link">
                                                    <div class="ays-sccp-center-new-big-upgrade-button">
                                                        <img src="<?php echo SCCP_ADMIN_URL.'/images/icons/sccp_locked_24x24.svg'?>" class="ays-sccp-new-button-img-hide">
                                                        <img src="<?php echo SCCP_ADMIN_URL.'/images/icons/sccp_unlocked_24x24.svg'?>" class="ays-sccp-new-upgrade-button-hover">  
                                                        <?php echo esc_html__("Upgrade", 'secure-copy-content-protection'); ?>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>                                
                                <div class="pro_features_img">
                                    <img src="<?php echo SCCP_ADMIN_URL . '/images/features/page_blocker.png'; ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="tab7" class="nav-tab-content only_pro <?php echo  ($sccp_tab == 'tab7') ? 'nav-tab-content-active' : ''; ?>">
                        <div class="ays-sccp-accordion-options-main-container" data-collapsed="false">
                            <div class="ays-sccp-accordion-container">
                                <?php echo $sccp_accordion_svg_html; ?>
                                <p class="ays-subtitle" style="margin-top:0;"><?php echo esc_html__( 'PayPal', 'secure-copy-content-protection' ); ?></p>
                            </div>
                            <hr class="ays-sccp-bolder-hr"/>
                            <div class="ays-sccp-accordion-options-box">
                                <div class="pro_features">
                                    <div>
                                        <a href="https://ays-pro.com/wordpress/secure-copy-content-protection/" target="_blank" class="ays-sccp-new-upgrade-button-link">
                                            <div class="ays-sccp-new-upgrade-button-box">
                                                <div>
                                                    <img src="<?php echo SCCP_ADMIN_URL.'/images/icons/sccp_locked_24x24.svg'?>">
                                                    <img src="<?php echo SCCP_ADMIN_URL.'/images/icons/sccp_unlocked_24x24.svg'?>" class="ays-sccp-new-upgrade-button-hover">
                                                </div>
                                                <div class="ays-sccp-new-upgrade-button"><?php echo esc_html__("Upgrade", 'secure-copy-content-protection'); ?></div>
                                            </div>
                                        </a>
                                        <div class="ays-sccp-center-big-main-button-box ays-sccp-new-big-button-flex">
                                            <div class="ays-sccp-center-big-upgrade-button-box">
                                                <a href="https://ays-pro.com/wordpress/secure-copy-content-protection/" target="_blank" class="ays-sccp-new-upgrade-button-link">
                                                    <div class="ays-sccp-center-new-big-upgrade-button">
                                                        <img src="<?php echo SCCP_ADMIN_URL.'/images/icons/sccp_locked_24x24.svg'?>" class="ays-sccp-new-button-img-hide">
                                                        <img src="<?php echo SCCP_ADMIN_URL.'/images/icons/sccp_unlocked_24x24.svg'?>" class="ays-sccp-new-upgrade-button-hover">  
                                                        <?php echo esc_html__("Upgrade", 'secure-copy-content-protection'); ?>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>                                
                                <div class="pro_features_img">
                                    <img src="<?php echo SCCP_ADMIN_URL . '/images/features/pay_pal.png'; ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="tab8" class="nav-tab-content container-fluid <?php echo  ($sccp_tab == 'tab8') ? 'nav-tab-content-active' : ''; ?>">
                        <div class="ays-sccp-accordion-options-main-container" data-collapsed="false">
                            <div class="ays-sccp-accordion-container">
                                <?php echo $sccp_accordion_svg_html; ?>
                                <p class="ays-subtitle" style="margin-top:0;"><?php echo esc_html__( 'Block Content', 'secure-copy-content-protection' ); ?></p>
                            </div>
                            <hr class="ays-sccp-bolder-hr"/>
                            <div class="ays-sccp-accordion-options-box">                      
                                <button type="button" class="button add_new_block_content"
                                        style="margin-bottom: 20px"><?php echo  esc_html__('Add new', 'secure-copy-content-protection'); ?></button>
                                <div class="all_block_contents" data-last-id="<?php echo $bc_last_id; ?>">
                                    <?php
                                     foreach ( $block_content_data as $key => $blocont ) { 
                                        $block_id = isset($blocont['id']) ? $blocont['id'] : $bc_last_id;
                                        $block_password = isset($blocont['password']) ? $blocont['password'] : '';
                                        $bc_options = json_decode($blocont['options'], true);
                                        $block_password_count = isset($bc_options['pass_count']) ? $bc_options['pass_count'] : '0';
                                        $block_password_limit = isset($bc_options['pass_limit']) && !empty($bc_options['pass_limit']) ? $bc_options['pass_limit'] : '';
                                        $block_user_role_count = isset($bc_options['user_role_count']) ? $bc_options['user_role_count'] : '0';
                                        $bc_schedule_from = isset($bc_options['bc_schedule_from']) ? $bc_options['bc_schedule_from'] : '';
                                        $bc_schedule_to = isset($bc_options['bc_schedule_to']) ? $bc_options['bc_schedule_to'] : '';

                                        $is_expired = false;
                                        $startDate = strtotime($bc_schedule_from);
                                        $endDate   = strtotime($bc_schedule_to);

                                        $current_time = strtotime(current_time( "Y:m:d H:i:s" ));

                                        if (($startDate > $current_time && $startDate != '') || ($endDate < $current_time && $endDate != '')) {
                                            $is_expired = true;
                                        }

                                        if ($is_expired || ($block_password_count > 0 && $block_password_count == $block_password_limit)) {
                                            $bc_schedule_notice_color = '#ff2222';
                                            $bc_schedule_notice = 'expired';
                                        }else{
                                            $bc_schedule_notice_color = '#89cf38';
                                            $bc_schedule_notice = 'active';
                                        }
                                    ?>
                                        <div class="blockcont_one" id="blocont<?php echo $block_id; ?>">
                                            <div class="copy_protection_container form-group row ays_bc_row">
                                                <div class="col">
                                                    <label for="sccp_blockcont_shortcode" class="sccp_bc_label"><?php echo  esc_html__('Shortcode', 'secure-copy-content-protection'); ?></label>
                                                    <input type="text" name="sccp_blockcont_shortcode[]"
                                                           class="ays-text-input sccp_blockcont_shortcode select2_style"
                                                           value="[ays_block id='<?php echo $block_id; ?>'] Content [/ays_block]"
                                                           readonly>
                                                    <input type="hidden" name="sccp_blockcont_id[]" value="<?php echo $block_id; ?>">
                                                </div>
                                                <div class="col">
                                                    <div class="input-group bc_count_limit">
                                                        <div class="bc_count">
                                                            <label for="sccp_blockcont_pass" class="sccp_bc_label"><?php echo  esc_html__('Password', 'secure-copy-content-protection'); ?><a class="ays_help password_count" data-toggle="tooltip"
                                                   title="<?php echo  esc_attr__('Shows how many times have used a password', 'secure-copy-content-protection') ?>">
                                                                    <?php echo $block_password_count; ?>
                                                                </a></label>
                                                            <input type="hidden" name="bc_pass_count_<?php echo $block_id; ?>" value="<?php echo $block_password_count; ?>">        
                                                        </div>
                                                        <div class="bc_limit">
                                                            <label for="sccp_blockcont_limit_<?php echo $block_id; ?>" class="sccp_bc_limit"><?php echo  esc_html__('Limit', 'secure-copy-content-protection'); ?><a class="ays_help" data-toggle="tooltip"
                                                           title="<?php echo  esc_attr__('Choose the maximum amount of the usage of the password', 'secure-copy-content-protection') ?>">
                                                            <i class="ays_fa ays_fa_info_circle"></i>
                                                        </a></label>
                                                            <input type="number" id="sccp_blockcont_limit_<?php echo $block_id; ?>" name="bc_pass_limit_<?php echo $block_id; ?>" value="<?php echo $block_password_limit; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="input-group bc_pass">
                                                        <input type="password" name="sccp_blockcont_pass[]"
                                                           class="ays-text-input select2_style form-control"
                                                           value="<?php echo $block_password; ?>">
                                                        <div class="input-group-append ays_inp-group">
                                                            <span class="input-group-text show_password">
                                                                <i class="ays_fa fa-eye" aria-hidden="true"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div>
                                                    <p style="margin-top:60px;"><?php echo  esc_html__('OR', 'secure-copy-content-protection') ?></p>
                                                </div>
                                                <div class="col">
                                                    <label for="sccp_blockcont_roles" class="sccp_bc_label"><?php echo  esc_html__('Except', 'secure-copy-content-protection'); ?><a class="ays_help user_role_count" data-toggle="tooltip"
                                           title="<?php echo  esc_attr__('Shows how many times have used a user role', 'secure-copy-content-protection') ?>">
                                                            <?php echo $block_user_role_count; ?>
                                                        </a></label>
                                                        <input type="hidden" name="bc_user_role_count_<?php echo $block_id; ?>" value="<?php echo $block_user_role_count; ?>">
                                                    <div class="input-group">
                                                        <select name="ays_users_roles_<?php echo $block_id; ?>[]" 
                                                                id="ays_users_roles_<?php echo $block_id; ?>"
                                                                class="ays_bc_users_roles" 
                                                                multiple>
                                                            <?php

                                                            foreach ($ays_users_roles as $key => $user_role) {
                                                                $selected_role = "";
                                                                if(isset($bc_options['user_role'])){
                                                                    if(is_array($bc_options['user_role'])){
                                                                        if(in_array($key, $bc_options['user_role'])){
                                                                            $selected_role = 'selected';
                                                                        }else{
                                                                            $selected_role = '';
                                                                        }
                                                                    }else{
                                                                        if($bc_options['user_role'] == $key){
                                                                            $selected_role = 'selected';
                                                                        }else{
                                                                            $selected_role = '';
                                                                        }
                                                                    }
                                                                }
                                                                echo "<option value='" . $key . "' " . $selected_role . ">" . $user_role['name'] . "</option>";
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <label for="sccp_blockcont_schedule" style="margin-left: 35px;"><?php echo  esc_html__('Schedule', 'secure-copy-content-protection'); ?><a class="ays_help schedule_notice" style="background: <?php echo $bc_schedule_notice_color; ?>" data-toggle="tooltip" title="<?php echo  esc_attr__('Block content status', 'secure-copy-content-protection') ?>">
                                                            <?php echo $bc_schedule_notice; ?>
                                                        </a></label>
                                                    <div class="input-group">
                                                        <label style="display: flex;" class="ays_actDect">
                                                            <span style="font-size:small;margin-right: 4px;">From</span>
                                                            <input type="text" id="ays-sccp-date-from-<?php echo $block_id; ?>" data-id="<?php echo $block_id; ?>" class="ays-text-input ays-text-input-short sccp_schedule_date" name="bc_schedule_from_<?php echo $block_id; ?>" value="<?php echo $bc_schedule_from; ?>">
                                                            <div class="input-group-append">
                                                                <label for="ays-sccp-date-from-<?php echo $block_id; ?>" style="height: 34px; padding: 5px 10px;" class="input-group-text">
                                                                    <span><i class="ays_fa ays_fa_calendar"></i></span>
                                                                </label>
                                                            </div>
                                                        </label>
                                                        <label style="display: flex;" class="ays_actDect">
                                                            <span style="font-size:small;margin-right: 21px;">To</span>
                                                            <input type="text" id="ays-sccp-date-to-<?php echo $block_id; ?>" class="ays-text-input ays-text-input-short sccp_schedule_date" data-id="<?php echo $block_id; ?>" name="bc_schedule_to_<?php echo $block_id; ?>" value="<?php echo $bc_schedule_to; ?>">
                                                            <div class="input-group-append">
                                                                <label for="ays-sccp-date-to-<?php echo $block_id; ?>" style="height: 34px; padding: 5px 10px;" class="input-group-text">
                                                                    <span><i class="ays_fa ays_fa_calendar"></i></span>
                                                                </label>
                                                            </div>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div>
                                                    <br>
                                                    <p class="blockcont_delete_icon"><i class="ays_fa fa-trash-o" aria-hidden="true"></i>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <input type="hidden" class="deleted_ids" value="" name="deleted_ids">
                                </div>
                                <button type="button" class="button add_new_block_content"
                                        style="margin-top: 20px"><?php echo  esc_html__('Add new', 'secure-copy-content-protection'); ?></button>          
                            </div>
                        </div>
                    </div>
                    <div id="tab9" class="nav-tab-content <?php echo  ($sccp_tab == 'tab9') ? 'nav-tab-content-active' : ''; ?>">
                        <div class="ays-sccp-accordion-options-main-container" data-collapsed="false">
                            <div class="ays-sccp-accordion-container">
                                <?php echo $sccp_accordion_svg_html; ?>
                                <p class="ays-subtitle" style="margin-top:0;"><?php echo __( 'Integrations', 'secure-copy-content-protection' ); ?></p>
                            </div>
                            <hr class="ays-sccp-bolder-hr"/>
                            <div class="ays-sccp-accordion-options-box">
                                <fieldset class="ays_sccp_settings_integration_container">
                                    <legend>
                                        <img class="ays_integration_logo" src="<?php echo SCCP_ADMIN_URL; ?>/images/integrations/mailchimp_logo.png" alt="">
                                        <h5><?php echo esc_html__('MailChimp Settings','secure-copy-content-protection')?></h5>
                                    </legend>
                                    <?php
                                        if(count($mailchimp) > 0):
                                    ?>
                                        <?php
                                            if($mailchimp_username == "" || $mailchimp_api_key == ""):
                                        ?>                                       
                                        <blockquote class="blockquote_error_message error_message">
                                            <?php
                                                echo wp_kses_post( sprintf(
                                                    /* translators: 1: HTML opening <a> tag 2: HTML closing </a> tag */
                                                    __( 'For enabling this option, please go to %1$s this %2$s page and fill all options.', 'secure-copy-content-protection' ),
                                                    "<a href='?page=$this->plugin_name-settings&ays_sccp_tab=tab2'>",
                                                    "</a>"
                                                ) );
                                            ?>
                                        </blockquote>
                                        <?php
                                            else:
                                        ?>
                                        <div class="form-group row">
                                            <div class="col-sm-4">
                                                <label for="ays_enable_mailchimp">
                                                    <?php echo esc_html__('Enable MailChimp','secure-copy-content-protection')?>
                                                </label>
                                            </div>
                                            <div class="col-sm-1">
                                                <input type="checkbox" class="ays-enable-timer1" id="ays_enable_mailchimp"
                                                       name="ays_enable_mailchimp"
                                                       value="on"
                                                       <?php
                                                            if($mailchimp_username == "" || $mailchimp_api_key == ""){
                                                                echo "disabled";
                                                            }else{
                                                                echo ($enable_mailchimp == 'on') ? 'checked' : '';
                                                            }
                                                       ?>/>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="form-group row">
                                            <div class="col-sm-4">
                                                <label for="ays_mailchimp_list">
                                                    <?php echo esc_html__('MailChimp list','secure-copy-content-protection')?>
                                                </label>
                                            </div>
                                            <div class="col-sm-8">
                                                <?php if(is_array($mailchimp_select)): ?>
                                                    <select name="ays_mailchimp_list" id="ays_mailchimp_list"
                                                       <?php
                                                            if($mailchimp_username == "" || $mailchimp_api_key == ""){
                                                                echo 'disabled';
                                                            }
                                                        ?>>
                                                        <option value="" disabled selected>Select list</option>
                                                    <?php foreach($mailchimp_select as $mlist): ?>
                                                        <option <?php echo ($mailchimp_list == $mlist['listId']) ? 'selected' : ''; ?>
                                                            value="<?php echo $mlist['listId']; ?>"><?php echo $mlist['listName']; ?></option>
                                                    <?php endforeach; ?>
                                                    </select>
                                                <?php else: ?>
                                                    <span><?php echo $mailchimp_select; ?></span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="form-group row">
                                            <div class="col-sm-4">
                                                <label for="ays_sccp_enable_double_opt_in">
                                                    <?php echo esc_html__('Enable double opt-in','secure-copy-content-protection')?>
                                                </label>
                                            </div>
                                            <div class="col-sm-8">
                                                <input type="checkbox" class="ays-enable-timer1" id="ays_sccp_enable_double_opt_in"
                                                    name="ays_sccp_enable_double_opt_in"
                                                    value="on"
                                                    <?php
                                                            if($mailchimp_username == "" || $mailchimp_api_key == ""){
                                                                echo "disabled";
                                                            }else{
                                                                echo $sccp_mailchimp_optin;
                                                            }
                                                    ?>/>
                                                <span class="ays_option_description"><?php echo esc_html__( 'Send contacts an opt-in confirmation email when their email address added to the list.', 'secure-copy-content-protection' ); ?></span>
                                            </div>
                                        </div>
                                        <?php
                                            endif;
                                        ?>
                                    <?php
                                        else:
                                    ?>                                        
                                        <blockquote class="blockquote_error_message error_message">
                                            <?php
                                                echo wp_kses_post( sprintf(
                                                    /* translators: 1: HTML opening <a> tag 2: HTML closing </a> tag */
                                                    __( 'For enabling this option, please go to %1$s this %2$s page and fill all options.', 'secure-copy-content-protection' ),
                                                    "<a href='?page=$this->plugin_name-settings&ays_sccp_tab=tab2'>",
                                                    "</a>"
                                                ) );
                                            ?>
                                        </blockquote>
                                    <?php
                                        endif;
                                    ?>
                                </fieldset> <!-- MailChimp Settings -->
                            </div>
                        </div>
                    </div>
                    
                    <div class="ays-sccp-save-button">
                    <?php
                    $save_bottom_attributes = array(
                        'id' => 'ays-button',
                        'title' => 'Ctrl + s',
                        'data-toggle' => 'tooltip',
                        'data-delay'=> '{"show":"1000"}'
                    );
                    submit_button(__('Save changes', 'secure-copy-content-protection'), 'primary ays-button ays-sccp-save-comp', 'ays_submit', false, $save_bottom_attributes);
                    echo $loader_iamge;
                    ?>
                    </div>

                    <?php if( !$if_dismiss_cookie_exists && !$if_fox_lms_plugin_exists && !$if_fox_lms_plugin_installed_flag ): ?>
                        <!-- SCCP and Fox LMS integration main page 2025 | Start -->
                        <div id="ays-sccp-fox-lms-all-pages-popup" class="bounceInRight_2022" style="display: none;">
                            <div id="ays-sccp-fox-lms-all-pages-popup-main">
                                <div class="ays-sccp-fox-lms-all-pages-popup-layer">
                                    <div id="ays-sccp-fox-lms-all-pages-popup-close-main">
                                        <div id="ays-sccp-fox-lms-all-pages-popup-close"><div>&times;</div></div>
                                    </div>
                                    <div id="ays-sccp-fox-lms-all-pages-popup-heading-title">
                                        <div class="ays-sccp-fox-lms-all-pages-popup-heading-center">
                                            <a href="https://bit.ly/43MyeyB" target="_blank">
                                                <?php echo esc_html__("WordPress LMS Plugin", 'secure-copy-content-protection'); ?>
                                            </a>    
                                        </div>
                                    </div>
                                    <div id="ays-sccp-fox-lms-all-pages-popup-heading">
                                        <div class="ays-sccp-fox-lms-all-pages-popup-heading-center">
                                            <a href="https://bit.ly/43MyeyB" target="_blank">
                                                <img loading="lazy" src="<?php echo SCCP_ADMIN_URL; ?>/images/ays-sccp-and-lms-popup-logo.svg">
                                                <img loading="lazy" class="ays-sccp-fox-lms-all-pages-icon" src="<?php echo SCCP_ADMIN_URL; ?>/images/ays-sccp-and-lms-popup-icon.svg">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="ays-sccp-fox-lms-all-pages-popup-footer">
                                        <div id="ays-sccp-fox-lms-all-pages-popup-button" class="ays-sccp-fox-lms-all-pages-popup-st">
                                            <div class="ays-sccp-fox-lms-all-pages-popup-btn">
                                                <a href="https://bit.ly/43MyeyB" id="ays-pages-submit-popup" class="ays-sccp-fox-lms-all-pages-popup-fields ays-sccp-fox-lms-all-pages-popup-fields-submit" target="_blank"><?php echo esc_html__("Download FREE version", 'secure-copy-content-protection'); ?></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="ays-sccp-fox-lms-all-pages-popup-content">
                                        <div class="ays-sccp-fox-lms-all-pages-popup-content-description"><?php echo esc_html__("Get Learning Management System and online course solution in WordPress now.", 'secure-copy-content-protection'); ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <!-- SCCP and Fox LMS integration main page 2025 | End -->
                <?php endif; ?>

                </form>
            </div>
        </div>
        <div class="modal fade" id="add_ip_modal" tabindex="-1" role="dialog" aria-labelledby="add_ip_modalLabel"
             aria-hidden="true">
            <div class="modal-dialog  modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"
                            id="add_ip_modalLabel"><?php echo  esc_html__("Blacklist modal", 'secure-copy-content-protection'); ?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="copy_protection_container form-group row">
                            <div class="col-sm-12">
                                <label><?php echo  esc_html__("Add IP parts", 'secure-copy-content-protection'); ?></label>
                            </div>
                            <div class="col-sm-12">
                                <table style="width: 100%">
                                    <tr>
                                        <td><input type="number" maxlength="255" id="ip_first"/></td>
                                        <td><input type="number" maxlength="255" id="ip_second"/></td>
                                        <td><input type="number" maxlength="255" id="ip_third"/></td>
                                        <td><input type="number" maxlength="255" id="ip_fourth"/></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="button button-secondary"
                                data-dismiss="modal"><?php echo  esc_html__("Close", 'secure-copy-content-protection'); ?></button>
                        <button type="button"
                                class="button button-primary"><?php echo  esc_html__("Add IP", 'secure-copy-content-protection'); ?></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>