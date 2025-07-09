<?php

class Ays_Sccp_Data {
    /*
    ==========================================
        Sale Banner | Start
    ==========================================
    */

    public static function ays_sccp_sale_baner(){

        if(isset($_POST['ays_sccp_sale_btn']) && (isset( $_POST['secure-copy-content-protection-sale-banner'] ) && wp_verify_nonce( $_POST['secure-copy-content-protection-sale-banner'], 'secure-copy-content-protection-sale-banner' )) &&
              current_user_can( 'manage_options' )){

            update_option('ays_sccp_sale_btn', 1);
            update_option('ays_sccp_sale_date', current_time( 'mysql' ));
        }      

        if(isset($_POST['ays_sccp_sale_btn_for_two_months'])){
            update_option('ays_sccp_sale_btn_for_two_months', 1);
            update_option('ays_sccp_sale_date', current_time( 'mysql' ));
        }

        $ays_sccp_sale_date = get_option('ays_sccp_sale_date');
        $ays_sccp_sale_two_months = get_option('ays_sccp_sale_btn_for_two_months');

        $val = 60*60*24*5;
        if($ays_sccp_sale_two_months == 1){
            $val = 60*60*24*61;
        }

        $current_date = current_time( 'mysql' );
        $date_diff = strtotime($current_date) -  intval(strtotime($ays_sccp_sale_date)) ;
        // $val = 60*60*24*5;
        $days_diff = $date_diff / $val;

        if(intval($days_diff) > 0 ){
            update_option('ays_sccp_sale_btn', 0);
            update_option('ays_sccp_sale_btn_for_two_months', 0);
        }

        $ays_sccp_ishmar = intval(get_option('ays_sccp_sale_btn'));
        $ays_sccp_ishmar += intval(get_option('ays_sccp_sale_btn_for_two_months'));
        if($ays_sccp_ishmar == 0 ){
            if (isset($_GET['page']) && strpos($_GET['page'], SCCP_NAME) !== false) {
                
                // self::ays_sccp_sale_message2($ays_sccp_ishmar);
                // self::ays_sccp_helloween_message($ays_sccp_ishmar);
                // self::ays_sccp_black_friday_message($ays_sccp_ishmar);
                // self::ays_sccp_new_mega_bundle_message_2024( $ays_sccp_ishmar );
                // self::ays_sccp_black_friday_message_2024($ays_sccp_ishmar);
                // self::ays_sccp_christmas_top_message_2024($ays_sccp_ishmar);
                // self::ays_sccp_new_banner_message_2025($ays_sccp_ishmar);
                self::ays_sccp_new_mega_bundle_message($ays_sccp_ishmar);
            }
        }
    } 

    // Chart Builder
    public static function ays_sccp_chart_banner($ishmar){
        if($ishmar == 0 ){
            $content = array();

            $content[] = '<div id="ays-sccp-dicount-month-main" class="notice notice-success is-dismissible ays_sccp_dicount_info ays_sccp_chart_bulider_container">';
                $content[] = '<div id="ays-sccp-dicount-month" class="ays_sccp_dicount_month ays_sccp_chart_bulider_box">';
                    $content[] = '<a href="https://wordpress.org/plugins/chart-builder/" target="_blank" class="ays-sccp-sale-banner-link"></a>';

                    $content[] = '<div class="ays-sccp-dicount-wrap-box">';

                        $content[] = '<strong style="font-weight: bold;">';
                            $content[] = __( "<span><a href='https://wordpress.org/plugins/chart-builder/' target='_blank' style='color:#98FBA6; text-decoration: underline;'>Chart Builder</a></span> Plugin is launched", 'secure-copy-content-protection' );
                        $content[] = '</strong>';
                        $content[] = '<br>';
                        $content[] = __( "Chartify plugin allows you to create beautiful charts and graphs easily and quickly.", 'secure-copy-content-protection' );

                        $content[] = '<br>';

                        $content[] = '<div style="position: absolute;right: 10px;bottom: 1px;" class="ays-sccp-dismiss-buttons-container-for-form">';

                            $content[] = '<form action="" method="POST">';
                                $content[] = '<div id="ays-sccp-dismiss-buttons-content">';
                                    $content[] = '<button class="btn btn-link ays-button" name="ays_sccp_sale_btn" style="height: 32px; margin-left: 0;padding-left: 0;">Dismiss ad</button>';
                                $content[] = '</div>';
                            $content[] = '</form>';
                            
                        $content[] = '</div>';

                    $content[] = '</div>';

                    $content[] = '<a href="https://wordpress.org/plugins/chart-builder/" class="button button-primary ays-button" id="ays-button-top-buy-now" target="_blank" >' . __( 'Install Now !', 'secure-copy-content-protection' ) . '</a>';
                $content[] = '</div>';
            $content[] = '</div>';

            $content = implode( '', $content );
            echo wp_kses_post($content);
        }
    }

    // Black Friday 2024
    public static function ays_sccp_black_friday_message_2024($ishmar){
        if($ishmar == 0 ){
            $content = array();

            $content[] = '<div id="ays-sccp-black-friday-bundle-dicount-month-main" class="notice notice-success is-dismissible ays_sccp_dicount_info">';
                $content[] = '<div id="ays-sccp-dicount-month" class="ays_sccp_dicount_month">';

                    $content[] = '<div class="ays-sccp-dicount-wrap-box ays-sccp-dicount-wrap-countdown-box">';

                        $content[] = '<div id="ays-sccp-countdown-main-container">';
                            $content[] = '<div class="ays-sccp-countdown-container">';

                                $content[] = '<div id="ays-sccp-countdown">';

                                    $content[] = '<div>';
                                        $content[] = __( "Offer ends in:", 'secure-copy-content-protection' );
                                    $content[] = '</div>';

                                    $content[] = '<ul>';
                                        $content[] = '<li><span id="ays-sccp-countdown-days"></span>'. __( "Days", 'secure-copy-content-protection' ) .'</li>';
                                        $content[] = '<li><span id="ays-sccp-countdown-hours"></span>'. __( "Hours", 'secure-copy-content-protection' ) .'</li>';
                                        $content[] = '<li><span id="ays-sccp-countdown-minutes"></span>'. __( "Minutes", 'secure-copy-content-protection' ) .'</li>';
                                        $content[] = '<li><span id="ays-sccp-countdown-seconds"></span>'. __( "Seconds", 'secure-copy-content-protection' ) .'</li>';
                                    $content[] = '</ul>';
                                $content[] = '</div>';

                                $content[] = '<div id="ays-sccp-countdown-content" class="emoji">';
                                    $content[] = '<span></span>';
                                    $content[] = '<span></span>';
                                    $content[] = '<span></span>';
                                    $content[] = '<span></span>';
                                $content[] = '</div>';

                            $content[] = '</div>';
                        $content[] = '</div>';
                            
                    $content[] = '</div>';

                    $content[] = '<div class="ays-sccp-dicount-wrap-box ays-sccp-dicount-wrap-text-box">';
                        $content[] = '<div>';

                            $content[] = '<span class="ays-sccp-black-friday-bundle-title">';
                                $content[] = __( "<span><a href='https://ays-pro.com/school-bundle?utm_source=dashboard&utm_medium=sccp-free&utm_campaign=black-friday-mega-bundle-sale-banner' class='ays-sccp-black-friday-bundle-title-link' target='_blank'>Black Friday Sale</a></span>", 'secure-copy-content-protection' );
                            $content[] = '</span>';

                            $content[] = '</br>';

                            $content[] = '<span class="ays-sccp-black-friday-bundle-desc">';
                                $content[] = '<a class="ays-sccp-black-friday-bundle-desc" href="https://ays-pro.com/school-bundle?utm_source=dashboard&utm_medium=sccp-free&utm_campaign=black-friday-mega-bundle-sale-banner" class="ays-sccp-black-friday-bundle-title-link" target="_blank">';
                                    $content[] = __( "50% OFF", 'secure-copy-content-protection' );
                                $content[] = '</a>';
                            $content[] = '</span>';
                        $content[] = '</div>';

                        $content[] = '<div style="position: absolute;right: 10px;bottom: 1px;" class="ays-sccp-dismiss-buttons-container-for-form">';

                            $content[] = '<form action="" method="POST">';
                                $content[] = '<div id="ays-sccp-dismiss-buttons-content">';
                                if( current_user_can( 'manage_options' ) ){
                                    $content[] = '<button class="btn btn-link ays-button" name="ays_sccp_sale_btn" style="height: 32px; margin-left: 0;padding-left: 0">'. __( "Dismiss ad", 'secure-copy-content-protection' ) .'</button>';
                                    $content[] = wp_nonce_field( 'secure-copy-content-protection' . '-sale-banner' ,  'secure-copy-content-protection' . '-sale-banner' );
                                }
                                $content[] = '</div>';
                            $content[] = '</form>';
                            
                        $content[] = '</div>';

                    $content[] = '</div>';                    

                    $content[] = '<div class="ays-sccp-dicount-wrap-box ays-sccp-dicount-wrap-text-box">';
                        $content[] = '<span class="ays-sccp-black-friday-bundle-title">';
                            $content[] = '<a class="ays-sccp-black-friday-bundle-title-link" href="https://ays-pro.com/school-bundle?utm_source=dashboard&utm_medium=sccp-free&utm_campaign=black-friday-mega-bundle-sale-banner" target="_blank">';
                                $content[] = __( 'School Bundle', 'secure-copy-content-protection' );
                            $content[] = '</a>';
                        $content[] = '</span>';
                    $content[] = '</div>';

                    $content[] = '<div class="ays-sccp-dicount-wrap-box ays-sccp-dicount-wrap-button-box">';
                        $content[] = '<a href="https://ays-pro.com/school-bundle?utm_source=dashboard&utm_medium=sccp-free&utm_campaign=black-friday-mega-bundle-sale-banner" class="button button-primary ays-button" id="ays-button-top-buy-now" target="_blank">' . __( 'Get Your Deal', 'secure-copy-content-protection' ) . '</a>';
                        $content[] = '<span class="ays-sccp-dicount-one-time-text">';
                            $content[] = __( "One-time payment", 'secure-copy-content-protection' );
                        $content[] = '</span>';
                    $content[] = '</div>';
                $content[] = '</div>';
            $content[] = '</div>';

            $content = implode( '', $content );
            echo wp_kses_post($content);
        }
    }

    // Christmas Top Banner 2024
    public static function ays_sccp_christmas_top_message_2024( $ishmar ){
        if($ishmar == 0 ){
            $content = array();

            $sccp_cta_button_link = esc_url( 'https://ays-pro.com/wordpress/secure-copy-content-protection?utm_source=dashboard&utm_medium=sccp-free&utm_campaign=christmas-sale-banner' . SCCP_NAME_VERSION );

            $content[] = '<div id="ays-sccp-christmas-top-bundle-dicount-month-main" class="notice notice-success is-dismissible ays_sccp_dicount_info">';
                $content[] = '<div id="ays-sccp-dicount-month" class="ays_sccp_dicount_month">';

                    $content[] = '<div class="ays-sccp-dicount-wrap-box ays-sccp-dicount-wrap-countdown-box">';

                        $content[] = '<div id="ays-sccp-countdown-main-container">';
                            $content[] = '<div class="ays-sccp-countdown-container">';

                                $content[] = '<div id="ays-sccp-countdown">';

                                    $content[] = '<div>';
                                        $content[] = __( "Offer ends in:", 'secure-copy-content-protection' );
                                    $content[] = '</div>';

                                    $content[] = '<ul>';
                                        $content[] = '<li><span id="ays-sccp-countdown-days"></span>'. __( "Days", 'secure-copy-content-protection' ) .'</li>';
                                        $content[] = '<li><span id="ays-sccp-countdown-hours"></span>'. __( "Hours", 'secure-copy-content-protection' ) .'</li>';
                                        $content[] = '<li><span id="ays-sccp-countdown-minutes"></span>'. __( "Minutes", 'secure-copy-content-protection' ) .'</li>';
                                        $content[] = '<li><span id="ays-sccp-countdown-seconds"></span>'. __( "Seconds", 'secure-copy-content-protection' ) .'</li>';
                                    $content[] = '</ul>';
                                $content[] = '</div>';

                                $content[] = '<div id="ays-sccp-countdown-content" class="emoji">';
                                    $content[] = '<span>🚀</span>';
                                    $content[] = '<span>⌛</span>';
                                    $content[] = '<span>🔥</span>';
                                    $content[] = '<span>💣</span>';
                                $content[] = '</div>';

                            $content[] = '</div>';
                        $content[] = '</div>';
                            
                    $content[] = '</div>';

                    $content[] = '<div class="ays-sccp-dicount-wrap-box ays-sccp-dicount-wrap-text-box">';
                        $content[] = '<div>';

                            $content[] = '<span class="ays-sccp-christmas-top-bundle-title">';

                                $content[] = '<span><a href="'. $sccp_cta_button_link .'" class="ays-sccp-christmas-top-bundle-title-link" target="_blank">';
                                    $content[] = __( 'Christmas Sale', 'secure-copy-content-protection' );
                                $content[] = '</a></span>';
                                
                            $content[] = '</span>';

                            $content[] = '</br>';

                            $content[] = '<span class="ays-sccp-christmas-top-bundle-desc">';
                                $content[] = '<a class="ays-sccp-christmas-top-bundle-desc" href="https://ays-pro.com/wordpress/secure-copy-content-protection?utm_source=dashboard&utm_medium=sccp-free&utm_campaign=christmas-sale-banner'.SCCP_NAME_VERSION.'" class="ays-sccp-christmas-top-bundle-title-link" target="_blank">';
                                    $content[] = __( "20% Extra OFF", 'secure-copy-content-protection' );
                                $content[] = '</a>';
                            $content[] = '</span>';
                        $content[] = '</div>';

                        $content[] = '<div style="position: absolute;right: 10px;bottom: 1px;" class="ays-sccp-dismiss-buttons-container-for-form">';

                            $content[] = '<form action="" method="POST">';
                                $content[] = '<div id="ays-sccp-dismiss-buttons-content">';
                                if( current_user_can( 'manage_options' ) ){
                                    $content[] = '<button class="btn btn-link ays-button" name="ays_sccp_sale_btn" style="height: 32px; margin-left: 0;padding-left: 0">'. __( "Dismiss ad", 'secure-copy-content-protection' ) .'</button>';
                                    $content[] = wp_nonce_field( SCCP_NAME . '-sale-banner' ,  SCCP_NAME . '-sale-banner' );
                                }
                                $content[] = '</div>';
                            $content[] = '</form>';
                            
                        $content[] = '</div>';

                    $content[] = '</div>';

                    $content[] = '<div class="ays-sccp-dicount-wrap-box ays-sccp-christmas-top-bundle-coupon-text-box">';
                        $content[] = '<div class="ays-sccp-christmas-top-bundle-coupon-row">';
                            $content[] = 'xmas20off';
                        $content[] = '</div>';

                        $content[] = '<div class="ays-sccp-christmas-top-bundle-text-row">';
                            $content[] = __( '20% Extra Discount Coupon', 'secure-copy-content-protection' );
                        $content[] = '</div>';
                    $content[] = '</div>';

                    $content[] = '<div class="ays-sccp-dicount-wrap-box ays-sccp-dicount-wrap-button-box">';
                        $content[] = '<a href="https://ays-pro.com/wordpress/secure-copy-content-protection?utm_source=dashboard&utm_medium=sccp-free&utm_campaign=christmas-sale-banner'.SCCP_NAME_VERSION.'" class="button button-primary ays-button" id="ays-button-top-buy-now" target="_blank">' . __( 'Get Your Deal', 'secure-copy-content-protection' ) . '</a>';
                        $content[] = '<span class="ays-sccp-dicount-one-time-text">';
                            $content[] = __( "One-time payment", 'secure-copy-content-protection' );
                        $content[] = '</span>';
                    $content[] = '</div>';
                $content[] = '</div>';
            $content[] = '</div>';

            $content = implode( '', $content );
            echo wp_kses_post($content);
        }
    }

    // New Banner 2025
    public static function ays_sccp_new_banner_message_2025($ishmar){
        if($ishmar == 0 ){
            $content = array();

            $sccp_cta_button_link = esc_url( 'https://ays-pro.com/photography-bundle?utm_source=dashboard&utm_medium=sccp-free&utm_campaign=photography-bundle-2025-sale-banner-' . SCCP_NAME_VERSION );

            $content[] = '<div id="ays-sccp-new-mega-bundle-2025-dicount-month-main" class="notice notice-success is-dismissible ays_sccp_dicount_info">';
                $content[] = '<div id="ays-sccp-dicount-month" class="ays_sccp_dicount_month">';

                    $content[] = '<div class="ays-sccp-dicount-wrap-box ays-sccp-dicount-wrap-text-box">';
                        $content[] = '<div>';

                            $content[] = '<span class="ays-sccp-new-mega-bundle-2025-title">';
                                $content[] = __( "<span><a href='". $sccp_cta_button_link ."' target='_blank' style='color:#ffffff; text-decoration: underline;'>Photography Bundle</a></span>", 'secure-copy-content-protection' );
                            $content[] = '</span>';

                            $content[] = '</br>';

                            $content[] = '<span class="ays-sccp-new-mega-bundle-2025-desc">';
                                $content[] = __( "30 Day Money Back Guarantee", 'secure-copy-content-protection' );
                            $content[] = '</span>';
                        $content[] = '</div>';

                        $content[] = '<div>';
                                $content[] = '<img class="ays-sccp-new-mega-bundle-guaranteeicon" src="' . SCCP_ADMIN_URL . '/images/ays-sccp-mega-bundle-2025-discount.svg" style="width: 80px;">';
                        $content[] = '</div>';

                        $content[] = '<div style="position: absolute;right: 10px;bottom: 1px;" class="ays-sccp-dismiss-buttons-container-for-form">';

                            $content[] = '<form action="" method="POST">';
                                $content[] = '<div id="ays-sccp-dismiss-buttons-content">';
                                if( current_user_can( 'manage_options' ) ){
                                    $content[] = '<button class="btn btn-link ays-button" name="ays_sccp_sale_btn" style="height: 32px; margin-left: 0;padding-left: 0">'. __( "Dismiss ad", 'secure-copy-content-protection' ) .'</button>';
                                    $content[] = wp_nonce_field( SCCP_NAME . '-sale-banner' ,  SCCP_NAME . '-sale-banner' );
                                }
                                $content[] = '</div>';
                            $content[] = '</form>';
                            
                        $content[] = '</div>';

                    $content[] = '</div>';

                    $content[] = '<div class="ays-sccp-dicount-wrap-box ays-sccp-dicount-wrap-countdown-box">';

                        $content[] = '<div id="ays-sccp-countdown-main-container">';
                            $content[] = '<div class="ays-sccp-countdown-container">';

                                $content[] = '<div id="ays-sccp-countdown">';

                                    $content[] = '<ul>';
                                        $content[] = '<li><span id="ays-sccp-countdown-days"></span>'. __( "Days", 'secure-copy-content-protection' ) .'</li>';
                                        $content[] = '<li><span id="ays-sccp-countdown-hours"></span>'. __( "Hours", 'secure-copy-content-protection' ) .'</li>';
                                        $content[] = '<li><span id="ays-sccp-countdown-minutes"></span>'. __( "Minutes", 'secure-copy-content-protection' ) .'</li>';
                                        $content[] = '<li><span id="ays-sccp-countdown-seconds"></span>'. __( "Seconds", 'secure-copy-content-protection' ) .'</li>';
                                    $content[] = '</ul>';
                                $content[] = '</div>';

                                $content[] = '<div id="ays-sccp-countdown-content" class="emoji">';
                                    $content[] = '<span></span>';
                                    $content[] = '<span></span>';
                                    $content[] = '<span></span>';
                                    $content[] = '<span></span>';
                                $content[] = '</div>';

                            $content[] = '</div>';
                        $content[] = '</div>';
                            
                    $content[] = '</div>';

                    /*$content[] = '<div class="ays-sccp-dicount-wrap-box ays-sccp-dicount-top-bundle-coupon-text-box">';
                            $content[] = '<span>freetopro10off</span>';
                            $content[] = '<strong>10% extra coupon</strong>';
                    $content[] = '</div>';*/

                    $content[] = '<div class="ays-sccp-dicount-wrap-box ays-sccp-dicount-wrap-button-box">';
                        $content[] = '<a href="'. $sccp_cta_button_link .'" class="button button-primary ays-button" id="ays-button-top-buy-now" target="_blank">' . __( 'Buy Now', 'secure-copy-content-protection' ) . '</a>';
                        $content[] = '<span class="ays-sccp-dicount-one-time-text">';
                            $content[] = __( "One-time payment", 'secure-copy-content-protection' );
                        $content[] = '</span>';
                    $content[] = '</div>';
                $content[] = '</div>';
            $content[] = '</div>';

            $content = implode( '', $content );
            echo wp_kses_post($content);
        }
    }

    // New Mega Bundle 2024
    public static function ays_sccp_new_mega_bundle_message_2024( $ishmar ){
        if($ishmar == 0 ){
            $content = array();
            $content[] = '<div id="ays-sccp-new-mega-bundle-dicount-month-main-2024" class="notice notice-success is-dismissible ays_sccp_dicount_info">';
                $content[] = '<div id="ays-sccp-dicount-month" class="ays_sccp_dicount_month">';

                    $content[] = '<div class="ays-sccp-discount-box-sale-image"></div>';
                    $content[] = '<div class="ays-sccp-dicount-wrap-box ays-sccp-dicount-wrap-text-box">';

                        $content[] = '<div class="ays-sccp-dicount-wrap-text-box-texts">';
                            $content[] = '<div>
                                            <a href="https://ays-pro.com/wordpress/secure-copy-content-protection?utm_source=dashboard-sccp&utm_medium=free-sccp&utm_campaign=sale-banner-sccp" target="_blank" style="color:#30499B;">
                                            <span class="ays-sccp-new-mega-bundle-limited-text">Limited</span> Offer for </a> <br> 
                                            
                                            <span style="font-size: 19px;">Secure Copy Content Protection</span>
                                          </div>';
                        $content[] = '</div>';

                        $content[] = '<div style="font-size: 17px;">';
                            $content[] = '<img style="width: 24px;height: 24px;" src="' . esc_attr(SCCP_ADMIN_URL) . '/images/icons/guarantee-new.png">';
                            $content[] = '<span style="padding-left: 4px; font-size: 14px; font-weight: 600;"> 30 Day Money Back Guarantee</span>';
                            
                        $content[] = '</div>';

                       

                        $content[] = '<div style="position: absolute;right: 10px;bottom: 1px;" class="ays-sccp-dismiss-buttons-container-for-form">';

                            $content[] = '<form action="" method="POST">';
                                $content[] = '<div id="ays-sccp-dismiss-buttons-content">';
                                    if( current_user_can( 'manage_options' ) ){
                                        $content[] = '<button class="btn btn-link ays-button" name="ays_sccp_sale_btn" style="height: 32px; margin-left: 0;padding-left: 0; color: #30499B;
                                        ">Dismiss ad</button>';
                                        $content[] = wp_nonce_field( SCCP_NAME . '-sale-banner' , SCCP_NAME . '-sale-banner' );
                                    }
                                $content[] = '</div>';
                            $content[] = '</form>';
                            
                        $content[] = '</div>';

                    $content[] = '</div>';

                    $content[] = '<div class="ays-sccp-dicount-wrap-box ays-sccp-dicount-wrap-countdown-box">';

                        $content[] = '<div id="ays-sccp-countdown-main-container">';
                            $content[] = '<div class="ays-sccp-countdown-container">';

                                $content[] = '<div id="ays-sccp-countdown">';

                                    $content[] = '<div style="font-weight: 500;">';
                                        $content[] = __( "Offer ends in:", 'secure-copy-content-protection' );
                                    $content[] = '</div>';

                                    $content[] = '<ul>';
                                        $content[] = '<li><span id="ays-sccp-countdown-days"></span>days</li>';
                                        $content[] = '<li><span id="ays-sccp-countdown-hours"></span>Hours</li>';
                                        $content[] = '<li><span id="ays-sccp-countdown-minutes"></span>Minutes</li>';
                                        $content[] = '<li><span id="ays-sccp-countdown-seconds"></span>Seconds</li>';
                                    $content[] = '</ul>';
                                $content[] = '</div>';

                                $content[] = '<div id="ays-sccp-countdown-content" class="emoji">';
                                    $content[] = '<span>🚀</span>';
                                    $content[] = '<span>⌛</span>';
                                    $content[] = '<span>🔥</span>';
                                    $content[] = '<span>💣</span>';
                                $content[] = '</div>';

                            $content[] = '</div>';
                        $content[] = '</div>';
                            
                    $content[] = '</div>';

                    $content[] = '<div class="ays-sccp-dicount-wrap-box ays-sccp-dicount-wrap-button-box">';
                        $content[] = '<a href="https://ays-pro.com/wordpress/secure-copy-content-protection?utm_source=dashboard-sccp&utm_medium=free-sccp&utm_campaign=sale-banner-sccp" class="button button-primary ays-button" id="ays-button-top-buy-now" target="_blank">' . __( 'Buy Now !', 'secure-copy-content-protection' ) . '</a>';
                        $content[] = '<span >' . __( 'One-time payment', 'secure-copy-content-protection' ) . '</span>';
                    $content[] = '</div>';
                $content[] = '</div>';
            $content[] = '</div>';

            $content = implode( '', $content );
            echo wp_kses_post( $content );
        }        
    }

    // New Mega Bundle
    public static function ays_sccp_new_mega_bundle_message($ishmar){
        if($ishmar == 0 ){
            $content = array();            

            $sccp_cta_button_link = esc_url( 'https://ays-pro.com/photography-bundle?utm_source=dashboard&utm_medium=sccp-free&utm_campaign=photography-bundle-2025-sale-banner-' . SCCP_NAME_VERSION );

            $content[] = '<div id="ays-sccp-new-mega-bundle-dicount-month-main" class="ays-sccp-admin-notice notice notice-success is-dismissible ays_sccp_dicount_info">';
                $content[] = '<div id="ays-sccp-dicount-month" class="ays_sccp_dicount_month">';
                    $content[] = '<div class="ays-sccp-dicount-wrap-box ays-sccp-dicount-wrap-text-box">';
                        $content[] = '<div class="ays-sccp-dicount-wrap-box ays-sccp-dicount-wrap-text-boxes">';
                        $content[] = '<div>';
                            $content[] = '<span class="ays-sccp-new-mega-bundle-title">';
                                $content[] = "<span><a href='". $sccp_cta_button_link ."' target='_blank' style='color:#ffffff; text-decoration: underline;'>Photography Bundle</a></span>";
                            $content[] = '</span>';                                
                        $content[] = '</div>';
                        $content[] = '<div>';
                            $content[] = '<img src="' . SCCP_ADMIN_URL . '/images/ays-sccp-banner-50.svg" style="width: 70px;">';
                        $content[] = '</div>';
                        
                        $content[] = '</div>'; 
                        $content[] = '<div>';
                                $content[] = '<img class="ays-sccp-new-mega-bundle-guaranteeicon" src="' . SCCP_ADMIN_URL . '/images/sccp-guaranteeicon.webp" style="width: 30px;">';
                                $content[] = '<span class="ays-sccp-new-mega-bundle-desc">';
                                    $content[] = __( "30 Days Money Back Guarantee", 'secure-copy-content-protection' );
                                $content[] = '</span>';
                            $content[] = '</div>';                     

                        $content[] = '<div style="position: absolute;right: 10px;bottom: 1px;" class="ays-sccp-dismiss-buttons-container-for-form">';

                            $content[] = '<form action="" method="POST">';
                                $content[] = '<div id="ays-sccp-dismiss-buttons-content">';
                                if( current_user_can( 'manage_options' ) ){
                                    $content[] = '<button class="btn btn-link ays-button" name="ays_sccp_sale_btn" style="height: 32px; margin-left: 0;padding-left: 0">Dismiss ad</button>';
                                    $content[] = wp_nonce_field( 'secure-copy-content-protection-sale-banner' ,  'secure-copy-content-protection-sale-banner' );
                                }
                                $content[] = '</div>';
                            $content[] = '</form>';
                            
                        $content[] = '</div>';

                    $content[] = '</div>';

                    $content[] = '<div class="ays-sccp-dicount-wrap-box ays-sccp-dicount-wrap-countdown-box">';

                        $content[] = '<div id="ays-sccp-countdown-main-container">';
                            $content[] = '<div class="ays-sccp-countdown-container">';

                                $content[] = '<div id="ays-sccp-countdown">';

                                    $content[] = '<ul>';
                                        $content[] = '<li><span id="ays-sccp-countdown-days"></span>days</li>';
                                        $content[] = '<li><span id="ays-sccp-countdown-hours"></span>Hours</li>';
                                        $content[] = '<li><span id="ays-sccp-countdown-minutes"></span>Minutes</li>';
                                        $content[] = '<li><span id="ays-sccp-countdown-seconds"></span>Seconds</li>';
                                    $content[] = '</ul>';
                                $content[] = '</div>';

                                $content[] = '<div id="ays-sccp-countdown-content" class="emoji">';
                                    $content[] = '<span>🚀</span>';
                                    $content[] = '<span>⌛</span>';
                                    $content[] = '<span>🔥</span>';
                                    $content[] = '<span>💣</span>';
                                $content[] = '</div>';

                            $content[] = '</div>';
                        $content[] = '</div>';
                            
                    $content[] = '</div>';                   

                    $content[] = '<div class="ays-sccp-dicount-wrap-box ays-sccp-dicount-wrap-button-box">';
                        $content[] = '<a href="'. $sccp_cta_button_link .'" class="button button-primary ays-button" id="ays-button-top-buy-now" target="_blank">' . __( 'Buy Now', 'secure-copy-content-protection' ) . '</a>';
                        $content[] = '<span class="ays-sccp-dicount-one-time-text">';
                            $content[] = __( "One-time payment", 'secure-copy-content-protection' );
                        $content[] = '</span>';
                    $content[] = '</div>';
                $content[] = '</div>';
            $content[] = '</div>';

            // /* New Mega Bundle Banner Sccp | Start */
            $content[] = '<style id="ays-sccp-mega-bundle-styles-inline-css">';
            $content[] = 'div#ays-sccp-new-mega-bundle-dicount-month-main{border:0;background:#fff;border-radius:20px;box-shadow:unset;position:relative;z-index:1;min-height:80px}div#ays-sccp-new-mega-bundle-dicount-month-main.ays_sccp_dicount_info button{display:flex;align-items:center}div#ays-sccp-new-mega-bundle-dicount-month-main div#ays-sccp-dicount-month a.ays-sccp-sale-banner-link:focus{outline:0;box-shadow:0}div#ays-sccp-new-mega-bundle-dicount-month-main .btn-link{color:#007bff;background-color:transparent;display:inline-block;font-weight:400;text-align:center;white-space:nowrap;vertical-align:middle;-webkit-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none;border:1px solid transparent;padding:.375rem .75rem;font-size:1rem;line-height:1.5;border-radius:.25rem}div#ays-sccp-new-mega-bundle-dicount-month-main.ays_sccp_dicount_info{background-image:url("' . esc_attr( SCCP_ADMIN_URL ) . '/images/ays-sccp-banner-background-50.svg");background-position:center right;background-repeat:no-repeat;background-size:cover;background-color:unset}#ays-sccp-new-mega-bundle-dicount-month-main .ays_sccp_dicount_month{display:flex;align-items:center;justify-content:space-between;color:#fff}#ays-sccp-new-mega-bundle-dicount-month-main .ays_sccp_dicount_month img{width:80px}#ays-sccp-new-mega-bundle-dicount-month-main .ays-sccp-sale-banner-link{display:flex;justify-content:center;align-items:center;width:200px}#ays-sccp-new-mega-bundle-dicount-month-main .ays-sccp-dicount-wrap-box{font-size:14px;padding:12px;text-align:center}#ays-sccp-new-mega-bundle-dicount-month-main .ays-sccp-dicount-wrap-box.ays-sccp-dicount-wrap-text-box{text-align:left}.ays-sccp-dicount-wrap-box.ays-sccp-dicount-wrap-text-boxes{display:flex}#ays-sccp-new-mega-bundle-dicount-month-main .ays-sccp-dicount-wrap-box.ays-sccp-dicount-wrap-countdown-box{width:30%;display:flex;justify-content:flex-start;align-items:center}#ays-sccp-new-mega-bundle-dicount-month-main .ays-sccp-dicount-wrap-box.ays-sccp-dicount-wrap-button-box{width:20%;display:flex;justify-content:center;align-items:center;flex-direction:column}#ays-sccp-new-mega-bundle-dicount-month-main .ays-sccp-dicount-wrap-box.ays-sccp-dicount-wrap-text-box .ays-sccp-new-mega-bundle-title{color:#fdfdfd;font-size:16.8px;font-style:normal;font-weight:600;line-height:normal}#ays-sccp-new-mega-bundle-dicount-month-main .ays-sccp-dicount-wrap-box.ays-sccp-dicount-wrap-text-box .ays-sccp-new-mega-bundle-desc{color:#fff;font-size:15px;font-style:normal;font-weight:400;line-height:normal}#ays-sccp-new-mega-bundle-dicount-month-main .ays-sccp-dicount-wrap-box strong{font-size:17px;font-weight:700;letter-spacing:.8px}#ays-sccp-new-mega-bundle-dicount-month-main .ays-sccp-dicount-wrap-color{color:#971821}#ays-sccp-new-mega-bundle-dicount-month-main .ays-sccp-dicount-wrap-text-decoration{text-decoration:underline}#ays-sccp-new-mega-bundle-dicount-month-main .ays-sccp-dicount-wrap-box.ays-buy-now-button-box{display:flex;justify-content:flex-end;align-items:center;width:30%}#ays-sccp-new-mega-bundle-dicount-month-main .ays-sccp-dicount-wrap-box .ays-button,#ays-sccp-new-mega-bundle-dicount-month-main .ays-sccp-dicount-wrap-box .ays-buy-now-button{align-items:center;font-weight:500}#ays-sccp-new-mega-bundle-dicount-month-main .ays-sccp-dicount-wrap-box .ays-buy-now-button{background:#971821;border-color:#fff;display:flex;justify-content:center;align-items:center;padding:5px 15px;font-size:16px;border-radius:5px}#ays-sccp-new-mega-bundle-dicount-month-main .ays-sccp-dicount-wrap-box .ays-buy-now-button:hover{background:#7d161d;border-color:#971821}#ays-sccp-new-mega-bundle-dicount-month-main #ays-sccp-dismiss-buttons-content{display:flex;justify-content:center}#ays-sccp-new-mega-bundle-dicount-month-main #ays-sccp-dismiss-buttons-content .ays-button{margin:0!important;font-size:13px;color:#fff}#ays-sccp-new-mega-bundle-dicount-month-main .ays-sccp-dicount-wrap-opacity-box{width:19%}#ays-sccp-new-mega-bundle-dicount-month-main .ays-buy-now-opacity-button{padding:40px 15px;display:flex;justify-content:center;align-items:center;opacity:0}#ays-sccp-countdown-main-container .ays-sccp-countdown-container{margin:0 auto;text-align:center}#ays-sccp-countdown-main-container #ays-sccp-countdown-headline{letter-spacing:.125rem;text-transform:uppercase;font-size:18px;font-weight:400;margin:0;padding:9px 0 4px;line-height:1.3}#ays-sccp-countdown-main-container li,#ays-sccp-countdown-main-container ul{margin:0}#ays-sccp-countdown-main-container li{display:inline-block;font-size:14px;list-style-type:none;padding:14px;text-transform:uppercase}#ays-sccp-countdown-main-container li span{display:flex;justify-content:center;align-items:center;font-size:40px;min-height:62px;min-width:62px;border-radius:4.273px;border:.534px solid #f4f4f4;background:#9896ed}#ays-sccp-countdown-main-container .emoji{display:none;padding:1rem}#ays-sccp-countdown-main-container .emoji span{font-size:30px;padding:0 .5rem}#ays-sccp-new-mega-bundle-dicount-month-main .ays-sccp-dicount-wrap-box li{position:relative}#ays-sccp-new-mega-bundle-dicount-month-main .ays-sccp-dicount-wrap-box li span:after{content:":";color:#fff;position:absolute;top:10px;right:-5px;font-size:40px}#ays-sccp-new-mega-bundle-dicount-month-main .ays-sccp-dicount-wrap-box li span#ays-sccp-countdown-seconds:after{content:unset}#ays-sccp-new-mega-bundle-dicount-month-main #ays-button-top-buy-now{display:flex;align-items:center;border-radius:6.409px;background:#f66123;padding:12px 32px;color:#fff;font-size:12.818px;font-style:normal;font-weight:800;line-height:normal;margin:0!important}div#ays-sccp-new-mega-bundle-dicount-month-main button.notice-dismiss:before{color:#fff;content:"\f00d";font-family:fontawesome;font-size:22px}#ays-sccp-new-mega-bundle-dicount-month-main .ays-sccp-new-mega-bundle-guaranteeicon{width:30px;margin-right:5px}#ays-sccp-new-mega-bundle-dicount-month-main .ays-sccp-dicount-one-time-text{color:#fff;font-size:12px;font-style:normal;font-weight:600;line-height:normal}@media all and (max-width:768px){div#ays-sccp-new-mega-bundle-dicount-month-main{padding-right:0;padding-left:0}#ays-sccp-countdown-main-container li{font-size:12px;padding:12px}.ays-sccp-dicount-wrap-box.ays-sccp-dicount-wrap-text-boxes{flex-direction:column}#ays-sccp-countdown-main-container li span{font-size:26px;min-height:50px;min-width:50px}div#ays-sccp-new-mega-bundle-dicount-month-main .ays_sccp_dicount_month{display:flex;align-items:center;justify-content:space-between;align-content:center;flex-wrap:wrap;flex-direction:column;padding:10px 0}div#ays-sccp-new-mega-bundle-dicount-month-main .ays-sccp-dicount-wrap-box{width:100%!important;text-align:center}#ays-sccp-countdown-main-container #ays-sccp-countdown-headline{font-size:15px;font-weight:600}#ays-sccp-countdown-main-container ul{font-weight:500}div#ays-sccp-new-mega-bundle-dicount-month-main .ays-sccp-dicount-wrap-box.ays-sccp-dicount-wrap-text-box{width:100%!important;text-align:center;flex-direction:column;margin-top:20px;justify-content:center;align-items:center}div#ays-sccp-new-mega-bundle-dicount-month-main .ays-sccp-dicount-wrap-box li span:after{top:unset}div#ays-sccp-new-mega-bundle-dicount-month-main .ays-sccp-dicount-wrap-box.ays-sccp-dicount-wrap-countdown-box{width:100%;display:flex;justify-content:center;align-items:center}#ays-sccp-new-mega-bundle-dicount-month-main .ays-button{margin:0 auto!important}div#ays-sccp-new-mega-bundle-dicount-month-main.ays_sccp_dicount_info.notice{background-position:-20px center;background-repeat:no-repeat;background-size:cover}#ays-sccp-new-mega-bundle-dicount-month-main #ays-sccp-dismiss-buttons-content .ays-button{padding-left:unset!important}div#ays-sccp-new-mega-bundle-dicount-month-main .ays-sccp-dicount-wrap-box.ays-buy-now-button-box{justify-content:center}div#ays-sccp-new-mega-bundle-dicount-month-main .ays-sccp-dicount-wrap-box .ays-buy-now-button{font-size:14px;padding:5px 10px}div#ays-sccp-new-mega-bundle-dicount-month-main .ays-buy-now-opacity-button{display:none}#ays-sccp-new-mega-bundle-dicount-month-main .ays-sccp-dismiss-buttons-container-for-form{position:static!important}.comparison .product img{width:70px}.ays-sccp-features-wrap .comparison a.price-buy{padding:8px 5px;font-size:11px}}@media screen and (max-width:1305px) and (min-width:768px){div#ays-sccp-new-mega-bundle-dicount-month-main.ays_sccp_dicount_info.notice{background-position:bottom right;background-repeat:no-repeat;background-size:cover}div#ays-sccp-new-mega-bundle-dicount-month-main .ays-sccp-dicount-wrap-box strong{font-size:15px}#ays-sccp-countdown-main-container li{font-size:11px}div#ays-sccp-new-mega-bundle-dicount-month-main .ays-sccp-dicount-wrap-opacity-box{display:none}}@media screen and (max-width:1400px) and (min-width:1200px){div#ays-sccp-new-mega-bundle-dicount-month-main .ays-sccp-dicount-wrap-box.ays-sccp-dicount-wrap-countdown-box{width:35%}div#ays-sccp-new-mega-bundle-dicount-month-main .ays-sccp-dicount-wrap-box.ays-sccp-dicount-wrap-text-box{width:40%}div#ays-sccp-countdown-main-container li span{font-size:30px;min-height:50px;min-width:50px}}@media screen and (max-width:1680px) and (min-width:1551px){div#ays-sccp-new-mega-bundle-dicount-month-main .ays-sccp-dicount-wrap-box.ays-sccp-dicount-wrap-text-box{width:29%}div#ays-sccp-new-mega-bundle-dicount-month-main .ays-sccp-dicount-wrap-box.ays-sccp-dicount-wrap-countdown-box{width:31%}}@media screen and (max-width:1550px) and (min-width:1400px){div#ays-sccp-new-mega-bundle-dicount-month-main .ays-sccp-dicount-wrap-box.ays-sccp-dicount-wrap-text-box{width:31%}div#ays-sccp-new-mega-bundle-dicount-month-main .ays-sccp-dicount-wrap-box.ays-sccp-dicount-wrap-countdown-box{width:35%}}@media screen and (max-width:1274px){div#ays-sccp-countdown-main-container li span{font-size:25px;min-height:40px;min-width:40px}#ays-sccp-new-mega-bundle-dicount-month-main .ays-sccp-dicount-wrap-box.ays-sccp-dicount-wrap-text-box .ays-sccp-new-mega-bundle-title{font-size:15px}}@media screen and (max-width:1200px){#ays-sccp-new-mega-bundle-dicount-month-main .ays-sccp-dicount-wrap-box.ays-sccp-dicount-wrap-button-box{margin-bottom:16px}#ays-sccp-countdown-main-container ul{padding-left:0}#ays-sccp-new-mega-bundle-dicount-month-main .ays-sccp-coupon-row{width:120px;font-size:18px}#ays-sccp-new-mega-bundle-dicount-month-main #ays-button-top-buy-now{padding:12px 20px}#ays-sccp-new-mega-bundle-dicount-month-main .ays-sccp-dicount-wrap-box{font-size:12px}#ays-sccp-new-mega-bundle-dicount-month-main .ays-sccp-dicount-wrap-box.ays-sccp-dicount-wrap-text-box .ays-sccp-new-mega-bundle-desc{font-size:13px}}@media screen and (max-width:1076px) and (min-width:769px){#ays-sccp-countdown-main-container li{padding:10px}#ays-sccp-new-mega-bundle-dicount-month-main .ays-sccp-coupon-row{width:100px;font-size:16px}#ays-sccp-new-mega-bundle-dicount-month-main .ays-sccp-dicount-wrap-box.ays-sccp-dicount-wrap-button-box{margin-bottom:16px}#ays-sccp-new-mega-bundle-dicount-month-main #ays-button-top-buy-now{padding:12px 15px}#ays-sccp-new-mega-bundle-dicount-month-main .ays-sccp-dicount-wrap-box{font-size:11px;padding:12px 0}}@media screen and (max-width:1250px) and (min-width:769px){div#ays-sccp-new-mega-bundle-dicount-month-main .ays-sccp-dicount-wrap-box.ays-sccp-dicount-wrap-countdown-box{width:45%}div#ays-sccp-new-mega-bundle-dicount-month-main .ays-sccp-dicount-wrap-box.ays-sccp-dicount-wrap-text-box{width:35%}div#ays-sccp-maker-countdown-main-container li span{font-size:30px;min-height:50px;min-width:50px}}';
            $content[] = '</style>';
            // /* New Mega Bundle Banner Sccp | End */

            $content = implode( '', $content );
            echo ($content);
            // echo wp_kses_post($content);
        }
    }

    public static function ays_sccp_sale_message2($ishmar){
        if($ishmar == 0 ){
            $content = array();

            $content[] = '<div id="ays-sccp-dicount-month-main" class="notice notice-success is-dismissible ays_sccp_dicount_info">';
                $content[] = '<div id="ays-sccp-dicount-month" class="ays_sccp_dicount_month">';
                    $content[] = '<a href="https://ays-pro.com/school-bundle?utm_source=dashboard-school&utm_medium=free-school&utm_campaign=sccp-school" target="_blank" class="ays-sccp-sale-banner-link"><img src="' . SCCP_ADMIN_URL . '/images/school_bundle.png"></a>';

                    $content[] = '<div class="ays-sccp-dicount-wrap-box">';

                        $content[] = '<strong style="font-weight: bold;">';
                            $content[] = __( "Limited Time <span class='ays-sccp-dicount-wrap-color'>50%</span> SALE on <br><span><a href='https://ays-pro.com/school-bundle?utm_source=dashboard-school&utm_medium=free-school&utm_campaign=sccp-school' target='_blank' class='ays-sccp-dicount-wrap-color ays-sccp-dicount-wrap-text-decoration' style='display:block;'>School Bundle</a></span> (Quiz + Copy + Poll + Personal Dictionary)!", 'secure-copy-content-protection' );
                        $content[] = '</strong>';
                        $content[] = '<br>';
                        $content[] = '<strong>';
                                $content[] = __( "Hurry up! <a href='https://ays-pro.com/school-bundle?utm_source=dashboard-school&utm_medium=free-school&utm_campaign=sccp-school' target='_blank'>Check it out!</a>", 'secure-copy-content-protection' );
                        $content[] = '</strong>';
                            
                    $content[] = '</div>';

                    $content[] = '<div class="ays-sccp-dicount-wrap-box">';

                        $content[] = '<div id="ays-sccp-countdown-main-container">';
                            $content[] = '<div class="ays-sccp-countdown-container">';

                                $content[] = '<div id="ays-sccp-countdown">';
                                    $content[] = '<ul>';
                                        $content[] = '<li><span id="ays-sccp-countdown-days"></span>days</li>';
                                        $content[] = '<li><span id="ays-sccp-countdown-hours"></span>Hours</li>';
                                        $content[] = '<li><span id="ays-sccp-countdown-minutes"></span>Minutes</li>';
                                        $content[] = '<li><span id="ays-sccp-countdown-seconds"></span>Seconds</li>';
                                    $content[] = '</ul>';
                                $content[] = '</div>';

                                $content[] = '<div id="ays-sccp-countdown-content" class="emoji">';
                                    $content[] = '<span>🚀</span>';
                                    $content[] = '<span>⌛</span>';
                                    $content[] = '<span>🔥</span>';
                                    $content[] = '<span>💣</span>';
                                $content[] = '</div>';

                            $content[] = '</div>';

                        $content[] = '</div>';
                            
                    $content[] = '</div>';

                    $content[] = '<div class="ays-sccp-dicount-wrap-box ays-buy-now-button-box">';
                        $content[] = '<a href="https://ays-pro.com/school-bundle?utm_source=dashboard-school&utm_medium=free-school&utm_campaign=sccp-school" class="button button-primary ays-buy-now-button" id="ays-button-top-buy-now" target="_blank" style="" >' . __( 'Buy Now !', 'secure-copy-content-protection' ) . '</a>';
                    $content[] = '</div>';

                $content[] = '</div>';

                $content[] = '<div style="position: absolute;right: 10px;bottom: 1px;" class="ays-sccp-dismiss-buttons-container-for-form">';
                    $content[] = '<form action="" method="POST">';
                        $content[] = '<div id="ays-sccp-dismiss-buttons-content">';
                            $content[] = '<button class="btn btn-link ays-button" name="ays_sccp_sale_btn" style="height: 32px; margin-left: 0;padding-left: 0">Dismiss ad</button>';                            
                        $content[] = '</div>';
                    $content[] = '</form>';
                $content[] = '</div>';

            $content[] = '</div>';

            $content = implode( '', $content );
            echo wp_kses_post($content);
        }
    }

    public static function ays_sccp_spring_bundle_message($ishmar){
        if($ishmar == 0 ){
            $content = array();         

            $content[] = '<div id="ays-sccp-dicount-month-main" class="notice notice-success is-dismissible ays_sccp_dicount_info">';
                $content[] = '<div id="ays-sccp-dicount-month" class="ays_sccp_dicount_month">';
                    $content[] = '<a href="https://ays-pro.com/spring-bundle" target="_blank" class="ays-sccp-sale-banner-link"><img src="' . SCCP_ADMIN_URL . '/images/spring_bundle_logo_box.png"></a>';

                    $content[] = '<div class="ays-sccp-dicount-wrap-box">';
                        $content[] = '<p>';
                            $content[] = '<strong>';
                                $content[] = __( "Spring is here! <span class='ays-sccp-dicount-wrap-color'>50%</span> SALE on <span><a href='https://ays-pro.com/spring-bundle' target='_blank' class='ays-sccp-dicount-wrap-color ays-sccp-dicount-wrap-text-decoration'>Spring Bundle</a></span><span style='display: block;'>Quiz + Popup + Copy</span>", 'secure-copy-content-protection' );
                            $content[] = '</strong>';
                        $content[] = '</p>';
                    $content[] = '</div>';

                    $content[] = '<div class="ays-sccp-dicount-wrap-box">';

                        $content[] = '<div id="ays-sccp-countdown-main-container">';

                            $content[] = '<form action="" method="POST" class="ays-sccp-btn-form">';
                                $content[] = '<button class="btn btn-link ays-button" name="ays_sccp_sale_spring_btn" style="height: 32px; margin-left: 0;padding-left: 0">Dismiss ad</button>';
                                $content[] = '<button class="btn btn-link ays-button" name="ays_sccp_sale_spring_btn_for_two_months" style="height: 32px; padding-left: 0">Dismiss ad for 2 months</button>';
                            $content[] = '</form>';

                        $content[] = '</div>';
                            
                    $content[] = '</div>';

                    $content[] = '<a href="https://ays-pro.com/spring-bundle" class="button button-primary ays-button" id="ays-button-top-buy-now" target="_blank">' . __( 'Buy Now !', 'secure-copy-content-protection' ) . '</a>';
                $content[] = '</div>';
            $content[] = '</div>';

            $content = implode( '', $content );
            echo wp_kses_post($content);
        }
    }

    public static function ays_sccp_sale_message($ishmar){
        if($ishmar == 0 ){
            $content = array();

            $content[] = '<div id="ays-sccp-dicount-month-main" class="notice notice-success is-dismissible ays_sccp_dicount_info">';
                $content[] = '<div id="ays-sccp-dicount-month" class="ays_sccp_dicount_month">';                    
                    $content[] = '<a href="https://ays-pro.com/huge-bundle/" target="_blank" class="ays-sccp-sale-banner-link"><img src="' . SCCP_ADMIN_URL . '/images/huge_bundle_logo_box.png"></a>';
                    $content[] = '<div class="ays-sccp-dicount-wrap-box">';

                        $content[] = '<strong style="font-weight: bold;">';
                            $content[] = __( "Limited Time <span class='ays-sccp-dicount-wrap-color'>60%</span> SALE on <br><span><a href='https://ays-pro.com/huge-bundle/' target='_blank' class='ays-sccp-dicount-wrap-color ays-sccp-dicount-wrap-text-decoration'>Huge Bundle</a></span> (All Plugins)", 'secure-copy-content-protection' );
                        $content[] = '</strong>';

                        $content[] = '<br>';

                        $content[] = '<strong>';
                                $content[] = __( "Hurry up! <a href='https://ays-pro.com/huge-bundle/' target='_blank'>Check it out!</a>", 'secure-copy-content-protection' );
                        $content[] = '</strong>';
                            
                    $content[] = '</div>';

                    $content[] = '<div class="ays-sccp-dicount-wrap-box">';

                        $content[] = '<div id="ays-sccp-countdown-main-container">';
                            $content[] = '<div class="ays-sccp-countdown-container">';

                                $content[] = '<div id="ays-sccp-countdown">';
                                    $content[] = '<ul>';
                                        $content[] = '<li><span id="ays-sccp-countdown-days"></span>days</li>';
                                        $content[] = '<li><span id="ays-sccp-countdown-hours"></span>Hours</li>';
                                        $content[] = '<li><span id="ays-sccp-countdown-minutes"></span>Minutes</li>';
                                        $content[] = '<li><span id="ays-sccp-countdown-seconds"></span>Seconds</li>';
                                    $content[] = '</ul>';
                                $content[] = '</div>';

                                $content[] = '<div id="ays-sccp-countdown-content" class="emoji">';
                                    $content[] = '<span>🚀</span>';
                                    $content[] = '<span>⌛</span>';
                                    $content[] = '<span>🔥</span>';
                                    $content[] = '<span>💣</span>';
                                $content[] = '</div>';

                            $content[] = '</div>';                           

                        $content[] = '</div>';
                            
                    $content[] = '</div>';

                    $content[] = '<div class="ays-sccp-dicount-wrap-box ays-buy-now-button-box">';
                        $content[] = '<a href="https://ays-pro.com/huge-bundle/" class="button button-primary ays-buy-now-button" id="ays-button-top-buy-now" target="_blank" style="" >' . __( 'Buy Now !', 'secure-copy-content-protection' ) . '</a>';
                    $content[] = '</div>';              

                $content[] = '</div>';

                $content[] = '<div style="position: absolute;right: 0;bottom: 1px;" class="ays-sccp-dismiss-buttons-container-for-form">';
                    $content[] = '<form action="" method="POST">';
                        $content[] = '<div id="ays-sccp-dismiss-buttons-content">';                         
                            $content[] = '<button class="btn btn-link ays-button" name="ays_sccp_sale_btn" style="height: 32px; margin-left: 0;padding-left: 0; color: #979797;">Dismiss ad</button>';
                        $content[] = '</div>';
                    $content[] = '</form>';
                $content[] = '</div>';

            $content[] = '</div>';

            $content = implode( '', $content );
            echo wp_kses_post($content);
        }
    }

    public static function ays_sccp_helloween_message($ishmar){
        if($ishmar == 0 ){
            $content = array();

            $content[] = '<div id="ays-sccp-dicount-month-main-helloween" class="notice notice-success is-dismissible ays_sccp_dicount_info">';
                $content[] = '<div id="ays-sccp-dicount-month-helloween" class="ays_sccp_dicount_month_helloween">';
                    $content[] = '<div class="ays-sccp-dicount-wrap-box-helloween-limited">';

                        $content[] = '<p>';
                            $content[] = __( "Limited Time 
                            <span class='ays-sccp-dicount-wrap-color-helloween' style='color:#b2ff00;'>20%</span> 
                            <span>
                                SALE on
                            </span> 
                            <br>
                            <span style='' class='ays-sccp-helloween-bundle'>
                                <a href='https://ays-pro.com/wordpress/secure-copy-content-protection?utm_source=dashboard-sccp&utm_medium=free-sccp&utm_campaign=sale-banner-sccp' target='_blank' class='ays-sccp-dicount-wrap-color-helloween ays-sccp-dicount-wrap-text-decoration-helloween' style='display:block; color:#b2ff00;margin-right:6px;'>
                                    Secure Copy Content Protection
                                </a>
                            </span>", 'secure-copy-content-protection' );
                        $content[] = '</p>';
                        $content[] = '<p>';
                                $content[] = __( "Hurry up! 
                                                <a href='https://ays-pro.com/wordpress/secure-copy-content-protection?utm_source=dashboard-sccp&utm_medium=free-sccp&utm_campaign=sale-banner-sccp' target='_blank' style='color:#ffc700;'>
                                                    Check it out!
                                                </a>", 'secure-copy-content-protection' );
                        $content[] = '</p>';
                            
                    $content[] = '</div>';

                    
                    $content[] = '<div class="ays-sccp-helloween-bundle-buy-now-timer">';
                        $content[] = '<div class="ays-sccp-dicount-wrap-box-helloween-timer">';
                            $content[] = '<div id="ays-sccp-countdown-main-container" class="ays-sccp-countdown-main-container-helloween">';
                                $content[] = '<div class="ays-sccp-countdown-container-helloween">';
                                    $content[] = '<div id="ays-sccp-countdown">';
                                        $content[] = '<ul>';
                                            $content[] = '<li><p><span id="ays-sccp-countdown-days"></span><span>days</span></p></li>';
                                            $content[] = '<li><p><span id="ays-sccp-countdown-hours"></span><span>Hours</span></p></li>';
                                            $content[] = '<li><p><span id="ays-sccp-countdown-minutes"></span><span>Mins</span></p></li>';
                                            $content[] = '<li><p><span id="ays-sccp-countdown-seconds"></span><span>Secs</span></p></li>';
                                        $content[] = '</ul>';
                                    $content[] = '</div>';

                                    $content[] = '<div id="ays-sccp-countdown-content" class="emoji">';
                                        $content[] = '<span>🚀</span>';
                                        $content[] = '<span>⌛</span>';
                                        $content[] = '<span>🔥</span>';
                                        $content[] = '<span>💣</span>';
                                    $content[] = '</div>';

                                $content[] = '</div>';

                            $content[] = '</div>';
                                
                        $content[] = '</div>';
                        $content[] = '<div class="ays-sccp-dicount-wrap-box ays-buy-now-button-box-helloween">';
                            $content[] = '<a href="https://ays-pro.com/wordpress/secure-copy-content-protection?utm_source=dashboard-sccp&utm_medium=free-sccp&utm_campaign=sale-banner-sccp" class="button button-primary ays-buy-now-button-helloween" id="ays-button-top-buy-now-helloween" target="_blank" style="" >' . __( 'Buy Now !', 'secure-copy-content-protection' ) . '</a>';
                        $content[] = '</div>';
                    $content[] = '</div>';

                $content[] = '</div>';

                $content[] = '<div style="position: absolute;right: 0;bottom: 1px;"  class="ays-sccp-dismiss-buttons-container-for-form-helloween">';
                    $content[] = '<form action="" method="POST">';
                        $content[] = '<div id="ays-sccp-dismiss-buttons-content-helloween">';
                            if( current_user_can( 'manage_options' ) ){
                                $content[] = '<button class="btn btn-link ays-button-helloween" name="ays_sccp_sale_btn" style="">Dismiss ad</button>';
                                $content[] = wp_nonce_field( 'secure-copy-content-protection-sale-banner' ,  'secure-copy-content-protection-sale-banner' );
                            }                            
                        $content[] = '</div>';
                    $content[] = '</form>';
                $content[] = '</div>';
            $content[] = '</div>';

            $content = implode( '', $content );

            echo wp_kses_post($content);
        }
    }

    // Black Friday
    public static function ays_sccp_black_friday_message($ishmar){
        if($ishmar == 0 ){
            $content = array();

            $content[] = '<div id="ays-sccp-dicount-black-friday-month-main" class="notice notice-success is-dismissible ays_sccp_dicount_info">';
                $content[] = '<div id="ays-sccp-dicount-black-friday-month" class="ays_sccp_dicount_month">';
                    $content[] = '<div class="ays-sccp-dicount-black-friday-box">';
                        $content[] = '<div class="ays-sccp-dicount-black-friday-wrap-box ays-sccp-dicount-black-friday-wrap-box-80" style="width: 70%;">';
                            $content[] = '<div class="ays-sccp-dicount-black-friday-title-row">' . __( 'Limited Time', 'secure-copy-content-protection' ) .' '. '<a href="https://ays-pro.com/wordpress/secure-copy-content-protection?utm_source=dashboard&utm_medium=sccp-free&utm_campaign=black-friday-sale-banner" class="ays-sccp-dicount-black-friday-button-sale" target="_blank">' . __( 'Sale', 'secure-copy-content-protection' ) . '</a>' . '</div>';
                            $content[] = '<div class="ays-sccp-dicount-black-friday-title-row">' . __( 'Secure Copy Content Protection', 'secure-copy-content-protection' ) . '</div>';
                        $content[] = '</div>';

                        $content[] = '<div class="ays-sccp-dicount-black-friday-wrap-box ays-sccp-dicount-black-friday-wrap-text-box">';
                            $content[] = '<div class="ays-sccp-dicount-black-friday-text-row">' . __( '20% off', 'secure-copy-content-protection' ) . '</div>';
                        $content[] = '</div>';

                        $content[] = '<div class="ays-sccp-dicount-black-friday-wrap-box" style="width: 25%;">';
                            $content[] = '<div id="ays-sccp-countdown-main-container">';
                                $content[] = '<div class="ays-sccp-countdown-container">';
                                    $content[] = '<div id="ays-sccp-countdown" style="display: block;">';
                                        $content[] = '<ul>';
                                            $content[] = '<li><span id="ays-sccp-countdown-days">0</span>' . __( 'Days', 'secure-copy-content-protection' ) . '</li>';
                                            $content[] = '<li><span id="ays-sccp-countdown-hours">0</span>' . __( 'Hours', 'secure-copy-content-protection' ) . '</li>';
                                            $content[] = '<li><span id="ays-sccp-countdown-minutes">0</span>' . __( 'Minutes', 'secure-copy-content-protection' ) . '</li>';
                                            $content[] = '<li><span id="ays-sccp-countdown-seconds">0</span>' . __( 'Seconds', 'secure-copy-content-protection' ) . '</li>';
                                        $content[] = '</ul>';
                                    $content[] = '</div>';
                                    $content[] = '<div id="ays-sccp-countdown-content" class="emoji" style="display: none;">';
                                        $content[] = '<span>🚀</span>';
                                        $content[] = '<span>⌛</span>';
                                        $content[] = '<span>🔥</span>';
                                        $content[] = '<span>💣</span>';
                                    $content[] = '</div>';
                                $content[] = '</div>';
                            $content[] = '</div>';
                        $content[] = '</div>';

                        $content[] = '<div class="ays-sccp-dicount-black-friday-wrap-box" style="width: 25%;">';
                            $content[] = '<a href="https://ays-pro.com/wordpress/secure-copy-content-protection?utm_source=dashboard&utm_medium=sccp-free&utm_campaign=black-friday-sale-banner" class="ays-sccp-dicount-black-friday-button-buy-now" target="_blank">' . __( 'Get Your Deal', 'secure-copy-content-protection' ) . '</a>';
                        $content[] = '</div>';
                    $content[] = '</div>';
                $content[] = '</div>';

                $content[] = '<div style="position: absolute;right: 0;bottom: 1px;"  class="ays-sccp-dismiss-buttons-container-for-form-black-friday">';
                    $content[] = '<form action="" method="POST">';
                        $content[] = '<div id="ays-sccp-dismiss-buttons-content-black-friday">';
                            if( current_user_can( 'manage_options' ) ){
                                $content[] = '<button class="btn btn-link ays-button-black-friday" name="ays_sccp_sale_btn" style="">Dismiss ad</button>';
                                $content[] = wp_nonce_field( 'secure-copy-content-protection-sale-banner' ,  'secure-copy-content-protection-sale-banner' );
                            }                            
                        $content[] = '</div>';
                    $content[] = '</form>';
                $content[] = '</div>'; 
            $content[] = '</div>';

            $content = implode( '', $content );

            echo wp_kses_post($content);
        }
    }

     // Christmas banner
    public static function ays_sccp_christmas_message($ishmar){
        if($ishmar == 0 ){
            $content = array();

            $content[] = '<div id="ays-sccp-dicount-christmas-month-main" class="notice notice-success is-dismissible ays_sccp_dicount_info">';
                $content[] = '<div id="ays-sccp-dicount-christmas-month" class="ays_sccp_dicount_month">';
                    $content[] = '<div class="ays-sccp-dicount-christmas-box">';
                        $content[] = '<div class="ays-sccp-dicount-christmas-wrap-box ays-sccp-dicount-christmas-wrap-box-80">';
                            $content[] = '<div class="ays-sccp-dicount-christmas-title-row">' . __( 'Limited Time', 'secure-copy-content-protection' ) .' '. '<a href="https://ays-pro.com/wordpress/secure-copy-content-protection" class="ays-sccp-dicount-christmas-button-sale" target="_blank">' . __( '20%', 'secure-copy-content-protection' ) . '</a>' . ' SALE</div>';
                            $content[] = '<div class="ays-sccp-dicount-christmas-title-row">' . __( 'Secure Copy Content Protection', 'secure-copy-content-protection' ) . '</div>';
                        $content[] = '</div>';

                        $content[] = '<div class="ays-sccp-dicount-christmas-wrap-box" style="width: 25%;">';
                            $content[] = '<div id="ays-sccp-countdown-main-container">';
                                $content[] = '<div class="ays-sccp-countdown-container">';
                                    $content[] = '<div id="ays-sccp-countdown" style="display: block;">';
                                        $content[] = '<ul>';
                                            $content[] = '<li><span id="ays-sccp-countdown-days"></span>' . __( 'Days', 'secure-copy-content-protection' ) . '</li>';
                                            $content[] = '<li><span id="ays-sccp-countdown-hours"></span>' . __( 'Hours', 'secure-copy-content-protection' ) . '</li>';
                                            $content[] = '<li><span id="ays-sccp-countdown-minutes"></span>' . __( 'Minutes', 'secure-copy-content-protection' ) . '</li>';
                                            $content[] = '<li><span id="ays-sccp-countdown-seconds"></span>' . __( 'Seconds', 'secure-copy-content-protection' ) . '</li>';
                                        $content[] = '</ul>';
                                    $content[] = '</div>';
                                    $content[] = '<div id="ays-sccp-countdown-content" class="emoji" style="display: none;">';
                                        $content[] = '<span>🚀</span>';
                                        $content[] = '<span>⌛</span>';
                                        $content[] = '<span>🔥</span>';
                                        $content[] = '<span>💣</span>';
                                    $content[] = '</div>';
                                $content[] = '</div>';
                            $content[] = '</div>';
                        $content[] = '</div>';

                        $content[] = '<div class="ays-sccp-dicount-christmas-wrap-box" style="width: 25%;">';
                            $content[] = '<a href="https://ays-pro.com/wordpress/secure-copy-content-protection" class="ays-sccp-dicount-christmas-button-buy-now" target="_blank">' . __( 'BUY NOW!', 'secure-copy-content-protection' ) . '</a>';
                        $content[] = '</div>';
                    $content[] = '</div>';
                $content[] = '</div>';

                $content[] = '<div style="position: absolute;right: 0;bottom: 1px;"  class="ays-sccp-dismiss-buttons-container-for-form-christmas">';
                    $content[] = '<form action="" method="POST">';
                        $content[] = '<div id="ays-sccp-dismiss-buttons-content-christmas">';
                            $content[] = '<button class="btn btn-link ays-button-christmas" name="ays_sccp_sale_btn" style="">' . __( 'Dismiss ad', 'secure-copy-content-protection' ) . '</button>';
                        $content[] = '</div>';
                    $content[] = '</form>';
                $content[] = '</div>';
            $content[] = '</div>';

            $content = implode( '', $content );

            echo wp_kses_post($content);
        }
    }

    /*
    ==========================================
        Sale Banner | End
    ==========================================
    */
}
