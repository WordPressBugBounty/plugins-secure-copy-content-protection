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
                // self::ays_sccp_new_mega_bundle_message($ays_sccp_ishmar);
                self::ays_sccp_discounted_licenses_banner_message($ays_sccp_ishmar);
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

    // Fox LMS Pro Banner
    public static function ays_sccp_discounted_licenses_banner_message($ishmar){
        if($ishmar == 0 ){
            $content = array();

            $date = time() + (int) ( get_option( 'gmt_offset' ) * HOUR_IN_SECONDS);
            $now_date = date('M d, Y H:i:s', $date);

            $start_date = strtotime('2025-09-21');
            $end_date = strtotime('2025-10-21');
            $diff_end = $end_date - $date;

            $style_attr = '';
            if( $diff_end < 0 ){
                $style_attr = 'style="display:none;"';
            }

            $total_licenses = 50;
            $progression_pattern = array(3, 2, 1, 4, 2, 3, 1, 2, 4, 3, 2, 1, 3, 2, 4, 1, 3, 2, 2, 3, 1, 2);
            $days_passed = floor(($date - $start_date) / (24 * 60 * 60));
            $used_licenses = 0;

            for ($i = 0; $i < min($days_passed, count($progression_pattern)); $i++) {
                $used_licenses += $progression_pattern[$i];
            }
            $used_licenses = min($used_licenses, $total_licenses);
            $remaining_licenses = $total_licenses - $used_licenses;
            $progress_percentage = ($used_licenses / $total_licenses) * 100;

            $ays_sccp_cta_button_link = esc_url('https://ays-pro.com/wordpress/secure-copy-content-protection?utm_source=dashboard&utm_medium=sccp-free&utm_campaign=sccp-maker-license-banner-' . SCCP_NAME_VERSION);

            $content[] = '<div id="ays-sccp-progress-banner-main" class="ays-sccp-progress-banner-main ays_sccp_dicount_info ays-sccp-admin-notice notice notice-success is-dismissible" ' . $style_attr . '>';
                $content[] = '<div class="ays-sccp-progress-banner-content">';
                    $content[] = '<div class="ays-sccp-progress-banner-left">';
                        $content[] = '<div class="ays-sccp-progress-banner-icon">';
                            $content[] = '<svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M1.33325 22.6668L11.9999 13.3335L33.3333 14.6668L34.6666 36.0002L25.3333 46.6668C25.3333 46.6668 25.3346 38.6682 17.3333 30.6668C9.33192 22.6655 1.33325 22.6668 1.33325 22.6668Z" fill="#A0041E"/>
                                            <path d="M1.29739 46.6665C1.29739 46.6665 1.24939 36.0278 5.27739 31.9998C9.30539 27.9718 20.0001 28.2492 20.0001 28.2492C20.0001 28.2492 19.9987 38.6665 15.9987 42.6665C11.9987 46.6665 1.29739 46.6665 1.29739 46.6665Z" fill="#FFAC33"/>
                                            <path d="M11.9986 41.3332C14.9441 41.3332 17.3319 38.9454 17.3319 35.9998C17.3319 33.0543 14.9441 30.6665 11.9986 30.6665C9.0531 30.6665 6.66528 33.0543 6.66528 35.9998C6.66528 38.9454 9.0531 41.3332 11.9986 41.3332Z" fill="#FFCC4D"/>
                                            <path d="M47.9986 0C47.9986 0 34.6653 0 18.6653 13.3333C10.6653 20 10.6653 32 13.3319 34.6667C15.9986 37.3333 27.9986 37.3333 34.6653 29.3333C47.9986 13.3333 47.9986 0 47.9986 0Z" fill="#55ACEE"/>
                                            <path d="M35.9987 6.6665C33.8347 6.6665 31.9814 7.96117 31.144 9.81317C31.8134 9.5105 32.5507 9.33317 33.332 9.33317C36.2774 9.33317 38.6654 11.7212 38.6654 14.6665C38.6654 15.4478 38.488 16.1852 38.1867 16.8532C40.0387 16.0172 41.332 14.1638 41.332 11.9998C41.332 9.0545 38.944 6.6665 35.9987 6.6665Z" fill="black"/>
                                            <path d="M10.6667 37.3332C10.6667 37.3332 10.6667 31.9998 12.0001 30.6665C13.3334 29.3332 29.3347 16.0012 30.6667 17.3332C31.9987 18.6652 18.6654 34.6665 17.3321 35.9998C15.9987 37.3332 10.6667 37.3332 10.6667 37.3332Z" fill="#A0041E"/>
                                            </svg>';
                        $content[] = '</div>';
                        $content[] = '<div class="ays-sccp-progress-banner-text">';
                            $content[] = '<h2 class="ays-sccp-progress-banner-title">' . sprintf( __('Get the Pro Version of %s Secure Copy Content Protection%s – 20%% OFF', 'secure-copy-content-protection'), '<a href="'. $ays_sccp_cta_button_link .'" target="_blank">', '</a>' ) . '</h2>';
                            $content[] = '<p class="ays-sccp-progress-banner-subtitle">' . __('Unlock advanced features + 30 day Money Back Guarantee', 'secure-copy-content-protection') . '</p>';
                        $content[] = '</div>';
                    $content[] = '</div>';
                    
                    $content[] = '<div class="ays-sccp-progress-banner-center">';
                        $content[] = '<div class="ays-sccp-progress-banner-coupon">';
                            $content[] = '<div class="ays-sccp-progress-banner-coupon-box" onclick="copyToClipboard(\'FREE2PRO20\')" title="' . __('Click to copy', 'secure-copy-content-protection') . '">';
                                $content[] = '<span class="ays-sccp-progress-banner-coupon-text">FREE2PRO20</span>';
                                $content[] = '<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg" class="ays-sccp-progress-banner-copy-icon">';
                                    $content[] = '<path d="M13.5 2.5H6.5C5.67 2.5 5 3.17 5 4V10C5 10.83 5.67 11.5 6.5 11.5H13.5C14.33 11.5 15 10.83 15 10V4C15 3.17 14.33 2.5 13.5 2.5ZM13.5 10H6.5V4H13.5V10ZM2.5 6.5V12.5C2.5 13.33 3.17 14 4 14H10V12.5H4V6.5H2.5Z" fill="white"/>';
                                $content[] = '</svg>';
                            $content[] = '</div>';
                        $content[] = '</div>';
                        
                        $content[] = '<div class="ays-sccp-progress-banner-progress">';
                            $content[] = '<p class="ays-sccp-progress-banner-progress-text">' . __('Only', 'secure-copy-content-protection') . ' <span id="remaining-licenses">' . $remaining_licenses . '</span> ' . __('of 50 discounted licenses left', 'secure-copy-content-protection') . '</p>';
                            $content[] = '<div class="ays-sccp-progress-banner-progress-bar">';
                                $content[] = '<div class="ays-sccp-progress-banner-progress-fill" id="progress-fill" style="width: ' . $progress_percentage . '%;"></div>';
                            $content[] = '</div>';
                        $content[] = '</div>';
                    $content[] = '</div>';
                    
                    $content[] = '<div class="ays-sccp-progress-banner-right">';
                        $content[] = '<a href="'. $ays_sccp_cta_button_link .'" class="ays-sccp-progress-banner-upgrade" target="_blank">';
                        $content[] = '<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">';
                            $content[] = '<path d="M14.6392 6.956C14.5743 6.78222 14.4081 6.66667 14.2223 6.66667H8.85565L11.9512 0.648C12.0485 0.458667 11.9983 0.227111 11.8308 0.0955556C11.7499 0.0315556 11.6525 0 11.5556 0C11.4521 0 11.3485 0.0364444 11.2654 0.108L8.00009 2.928L1.48765 8.55244C1.3472 8.67378 1.29653 8.86978 1.36142 9.04356C1.42631 9.21733 1.59209 9.33333 1.77787 9.33333H7.14454L4.04898 15.352C3.95165 15.5413 4.00187 15.7729 4.16942 15.9044C4.25031 15.9684 4.34765 16 4.44453 16C4.54809 16 4.65165 15.9636 4.73476 15.892L8.00009 13.072L14.5125 7.44756C14.6534 7.32622 14.7036 7.13022 14.6392 6.956Z" fill="white"/>';
                        $content[] = '</svg>';
                         $content[] = ' ' . __('Upgrade Now', 'secure-copy-content-protection');
                        $content[] = '</a>';
                    $content[] = '</div>';
                $content[] = '</div>';
                
                if( current_user_can( 'manage_options' ) ){
                $content[] = '<div id="ays-sccp-dismiss-buttons-content">';
                    $content[] = '<form action="" method="POST" style="position: absolute; bottom: 0; right: 0; color: #fff;">';
                            $content[] = '<button class="btn btn-link ays-button" name="ays_sccp_sale_btn" style="color: darkgrey; font-size: 11px;">'. __( "Dismiss ad", 'secure-copy-content-protection' ) .'</button>';
                            $content[] = wp_nonce_field( SCCP_NAME . '-sale-banner' ,  SCCP_NAME . '-sale-banner' );
                    $content[] = '</form>';
                $content[] = '</div>';
                }
            $content[] = '</div>';

            // Fox LMS Pro Banner Styles
            $content[] = '<style id="ays-sccp-progress-banner-styles-inline-css">';
            $content[] = '
                .ays-sccp-progress-banner-main {
                    background: linear-gradient(135deg, #6344ED 0%, #8C2ABE 100%);
                    padding: 20px 30px;
                    border-radius: 16px;
                    color: white;
                    position: relative;
                    margin: 20px 0;
                    box-shadow: 0 8px 32px rgba(99, 68, 237, 0.3);
                    border: 0;
                }

                .ays-sccp-progress-banner-main .ays-sccp-progress-banner-content {
                    display: flex;
                    align-items: center;
                    justify-content: space-between;
                    gap: 30px;
                }

                .ays-sccp-progress-banner-main .ays-sccp-progress-banner-left {
                    display: flex;
                    align-items: center;
                    gap: 20px;
                    flex: 1;
                }

                .ays-sccp-progress-banner-main .ays-sccp-progress-banner-center {
                    display: flex;
                    align-items: center;
                    gap: 15px;
                    flex: 1;
                }

                .ays-sccp-progress-banner-main .ays-sccp-progress-banner-right {
                    display: flex;
                    align-items: center;
                    gap: 20px;
                    flex-shrink: 0;
                }

                .ays-sccp-progress-banner-main .ays-sccp-progress-banner-icon {
                    font-size: 32px;
                    filter: drop-shadow(0 2px 8px rgba(0, 0, 0, 0.2));
                }

                .ays-sccp-progress-banner-main .ays-sccp-progress-banner-title {
                    font-size: 21px;
                    font-weight: 700;
                    margin: 0 0 8px 0;
                    line-height: 1.2;
                    color: #fff;
                }

                .ays-sccp-progress-banner-main .ays-sccp-progress-banner-title a {
                    text-decoration: underline;
                    color: #fff;
                }

                .ays-sccp-progress-banner-main .ays-sccp-progress-banner-subtitle {
                    font-size: 16px;
                    margin: 0;
                    opacity: 0.9;
                    font-weight: 400;
                }

                .ays-sccp-progress-banner-main .ays-sccp-progress-banner-coupon {
                    margin-bottom: 5px;
                }

                .ays-sccp-progress-banner-main .ays-sccp-progress-banner-coupon-box {
                    border: 2px dotted rgba(255, 255, 255, 0.6);
                    padding: 8px 16px;
                    border-radius: 8px;
                    background: rgba(255, 255, 255, 0.1);
                    cursor: pointer;
                    transition: all 0.3s ease;
                    display: flex;
                    align-items: center;
                    gap: 8px;
                    backdrop-filter: blur(10px);
                }

                .ays-sccp-progress-banner-main .ays-sccp-progress-banner-coupon-box:hover {
                    background: rgba(255, 255, 255, 0.2);
                    border-color: rgba(255, 255, 255, 0.8);
                    transform: translateY(-1px);
                }

                .ays-sccp-progress-banner-main .ays-sccp-progress-banner-coupon-text {
                    font-size: 16px;
                    font-weight: 700;
                    letter-spacing: 1px;
                    color: #fff;
                    font-family: monospace;
                }

                .ays-sccp-progress-banner-main .ays-sccp-progress-banner-copy-icon {
                    opacity: 0.8;
                    transition: opacity 0.3s ease;
                }

                .ays-sccp-progress-banner-main .ays-sccp-progress-banner-coupon-box:hover .ays-sccp-progress-banner-copy-icon {
                    opacity: 1;
                }

                .ays-sccp-progress-banner-main .ays-sccp-progress-banner-progress {
                    text-align: center;
                    width: 100%;
                }

                .ays-sccp-progress-banner-main .ays-sccp-progress-banner-progress-text {
                    font-size: 14px;
                    margin: 0 0 10px 0;
                    opacity: 0.9;
                }

                .ays-sccp-progress-banner-main .ays-sccp-progress-banner-progress-bar {
                    width: 300px;
                    height: 10px;
                    background: rgba(255, 255, 255, 0.2);
                    border-radius: 4px;
                    overflow: hidden;
                    margin: 0 auto;
                }

                .ays-sccp-progress-banner-main .ays-sccp-progress-banner-progress-fill {
                    height: 100%;
                    background: linear-gradient(90deg, #4ADE80 0%, #22C55E 100%);
                    border-radius: 4px;
                    transition: width 0.8s ease;
                    width: 70%;
                }

                .ays-sccp-progress-banner-main .ays-sccp-progress-banner-upgrade {
                    background: linear-gradient(135deg, #F59E0B 0%, #F97316 100%);
                    color: white;
                    border: none;
                    padding: 12px 24px;
                    border-radius: 8px;
                    font-size: 16px;
                    font-weight: 600;
                    cursor: pointer;
                    transition: all 0.3s ease;
                    box-shadow: 0 4px 16px rgba(245, 158, 11, 0.4);
                    text-decoration: none;
                    display: inline-flex;
                    align-items: center;
                    gap: 8px;
                }

                .ays-sccp-progress-banner-main .ays-sccp-progress-banner-upgrade:hover {
                    transform: translateY(-2px);
                    box-shadow: 0 6px 20px rgba(245, 158, 11, 0.6);
                    text-decoration: none;
                    color: white;
                }

                .ays-sccp-progress-banner-main .notice-dismiss:before {
                    color: #fff;
                }

                /* Copy notification */
                .ays-sccp-copy-notification {
                    position: fixed;
                    top: 50%;
                    left: 50%;
                    transform: translate(-50%, -50%);
                    background: rgba(0, 0, 0, 0.8);
                    color: white;
                    padding: 12px 24px;
                    border-radius: 8px;
                    font-size: 14px;
                    z-index: 10000;
                    opacity: 0;
                    transition: opacity 0.3s ease;
                }

                .ays-sccp-copy-notification.show {
                    opacity: 1;
                }

                @media (max-width: 1400px) {
                    .ays-sccp-progress-banner-main .ays-sccp-progress-banner-center {
                        flex-direction: column;
                    }
                }

                @media (max-width: 1200px) {
                    .ays-sccp-progress-banner-main .ays-sccp-progress-banner-content {
                        flex-direction: column;
                        gap: 20px;
                    }

                    .ays-sccp-progress-banner-main .ays-sccp-progress-banner-left {
                        width: 100%;
                        justify-content: center;
                        text-align: center;
                        flex-direction: column;
                    }

                    .ays-sccp-progress-banner-main .ays-sccp-progress-banner-center {
                        width: 100%;
                    }

                    .ays-sccp-progress-banner-main .ays-sccp-progress-banner-right {
                        width: 100%;
                        justify-content: center;
                    }
                }

                @media (max-width: 768px) {
                    #ays-sccp-progress-banner-main {
                        display: none !important;
                    }

                    .ays-sccp-progress-banner-main {
                        padding: 15px 20px;
                        margin: 15px 0;
                    }
                    
                    .ays-sccp-progress-banner-main .ays-sccp-progress-banner-title {
                        font-size: 18px;
                    }
                    
                    .ays-sccp-progress-banner-main .ays-sccp-progress-banner-subtitle {
                        font-size: 14px;
                    }
                    
                    .ays-sccp-progress-banner-main .ays-sccp-progress-banner-progress-bar {
                        width: 100%;
                        max-width: 280px;
                    }
                    
                    .ays-sccp-progress-banner-main .ays-sccp-progress-banner-upgrade {
                        padding: 10px 20px;
                        font-size: 14px;
                    }
                }

                @media (max-width: 480px) {
                    .ays-sccp-progress-banner-main {
                        padding: 12px 15px;
                    }
                    
                    .ays-sccp-progress-banner-main .ays-sccp-progress-banner-coupon-text {
                        font-size: 14px;
                    }
                    
                    .ays-sccp-progress-banner-main .ays-sccp-progress-banner-progress-bar {
                        max-width: 250px;
                    }
                }
            ';

            $content[] = '</style>';

            $content = implode( '', $content );
            echo ($content);
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
