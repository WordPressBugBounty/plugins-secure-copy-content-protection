<?php
    $user_id = null;
    $user_role_key = null;
    if( isset( $_GET['orderbyuser'] ) && $_GET['orderbyuser'] != ''){
        $user_id = intval($_GET['orderbyuser']);
    }
    if( isset( $_GET['orderbyuserrole'] ) && $_GET['orderbyuserrole'] != ''){
        $user_role_key = $_GET['orderbyuserrole'];
    }
    
?>
<div class="wrap">
    <div class="ays-sccp-heading-box">
        <div class="ays-sccp-wordpress-user-manual-box">
            <a href="https://ays-pro.com/wordpress-copy-content-protection-user-manual" target="_blank" style="text-decoration: none;font-size: 13px;">
                <i class="ays_fa ays_fa_file_text"></i>
                <span style="margin-left: 3px;text-decoration: underline;"><?php echo esc_html(__("View Documentation", 'secure-copy-content-protection')); ?></span>
            </a>
        </div>
    </div>
    <h1 class="wp-heading-inline">
        <?php
            echo esc_html(get_admin_page_title());
        ?>
    </h1>
    <div class="sccp-action-butons">
        <a href="javascript:void(0)" class="ays-sccp-export-filters page-title-action" style="float: right;"><?php echo esc_html(__('Export', 'secure-copy-content-protection')); ?></a>
    </div>
    <div class="nav-tab-wrapper">
        <a href="#tab1" class="nav-tab nav-tab-active"><?php echo esc_html(__('Results', 'secure-copy-content-protection')); ?></a>
        <!-- <a href="#tab2" class="nav-tab"><?php // echo __('Statistics', 'secure-copy-content-protection'); ?></a> -->
    </div>
    <div id="tab1" class="ays-sccp-tab-content ays-sccp-tab-content-active">
        <div id="poststuff">
            <div id="post-body" class="metabox-holder">
                <div id="post-body-content">
                    <div class="meta-box-sortables ui-sortable">
                        <form method="get" id="filter-div" class="alignleft actions bulkactions">
                            <div style="display:flex;justify-content:space-between;flex-wrap: wrap;">
                                <div class="ays_shortocode_id_filter">
                                    <div>
                                        <label for="shortcode-filter-selector-top">Shortcode ID</label>
                                        <input type="hidden" name="page" value="secure-copy-content-protection-results-to-view">
                                    </div>
                                    <select name="orderbyshortcode" id="shortcode-filter-selector-top">
                                        <option value="0" selected><?php echo esc_html(__('No Filtering', 'secure-copy-content-protection'));?></option>
                                        <?php
                                            foreach ($this->results_obj->get_sccp_by_id() as $copy_content) {?>
                                            <option value="<?php echo esc_attr($copy_content['subscribe_id']); ?>" <?php echo(isset($_REQUEST['orderbyshortcode']) && $_REQUEST['orderbyshortcode'] == $copy_content['subscribe_id']) ? 'selected' : ''; ?>><?php echo esc_html( $copy_content['subscribe_id']); ?></option>
                                            <?php }
                                        ?>
                                    </select>
                                    <div>
                                        <input type="submit" class="button action" value="<?php echo esc_attr(__('Filter', 'secure-copy-content-protection')); ?>" style="width: 3.7rem;">
                                    </div>
                                </div>
                                <div class="ays_user_roles_filter">
                                    <div>
                                        <label for="user-role-filter-selector-top">User Role</label>
                                        <input type="hidden" name="page" value="secure-copy-content-protection-results-to-view">
                                    </div>
                                    <select name="orderbyuserrole" id="user-role-filter-selector-top">
                                        <option value="0" selected><?php echo esc_html(__('No Filtering', 'secure-copy-content-protection'));?></option>
                                        <?php
                                            foreach ($this->results_obj->get_user_roles_by_user_id() as $key => $roles) {?>
                                            <option value="<?php echo esc_attr($key); ?>" <?php echo $user_role_key == $key ? 'selected' : ''; ?>><?php echo esc_html($roles); ?></option>
                                            <?php }
                                        ?>
                                    </select>
                                    <div>
                                        <input type="submit" class="button action" value="<?php echo esc_attr(__('Filter', 'secure-copy-content-protection')); ?>" style="width: 3.7rem;">
                                    </div>
                                </div>
                                <div class="ays-sccp-filte-by-user" style="display:flex;margin-left:10px;">
                                    <?php $nonce = wp_create_nonce('sccp-reports-user-search-nonce'); ?>
                                    <select name="orderbyuser" class="ays-sccp-search-users-select" id="bulk-action-select2-sccp" data-nonce="<?php echo esc_attr($nonce); ?>">
                                        <option value=""><?php echo esc_html(__('Select User','secure-copy-content-protection'))?></option>
                                        <?php
                                            foreach($this->results_obj->get_users_by_id() as $key => $value){
                                                $selected2 = "";
                                                if (is_array($value)) {
                                                   if($user_id === intval($value['data']['ID'])){
                                                        $selected2 = "selected";
                                                    }
                                                    echo "<option ". esc_attr( $selected2 ) ." value='". esc_attr( $value['data']['ID'] ) ."'>". esc_html( $value['data']['display_name'] ) ."</option>";
                                                }else{
                                                    if($user_id === intval($value->data->ID)){
                                                        $selected2 = "selected";
                                                    }
                                                    echo "<option ". esc_attr( $selected2 ) ." value='". esc_attr( $value->data->ID ) ."'>".esc_html(  $value->data->display_name ) ."</option>";
                                                }
                                            }
                                        ?>
                                    </select>
                                    <div style="margin-left:5px;">
                                        <input type="submit" class="button action" value="<?php echo esc_attr( __('Filter', 'secure-copy-content-protection')); ?>" style="width: 3.7rem;">
                                    </div>
                                </div>
                            </div>
                        </form>
                        <form method="post" id="ays-sccp-results-form">
                            <?php                            
                                $this->results_obj->prepare_items();
                                $search = __( "Search", 'secure-copy-content-protection' );
                                $this->results_obj->search_box($search, $this->plugin_name);
                                $this->results_obj->display();
                                // $this->results_obj->mark_as_read();
                            ?>
                        </form>
                    </div>
                </div>
            </div>
            <br class="clear">
        </div>
    </div>

    <div class="ays-modal" id="sccp_export_filters">
        <div class="ays-modal-content">
            <div class="ays-sccp-preloader">
                <img class="loader" src="<?php echo esc_attr( SCCP_ADMIN_URL ); ?>/images/loaders/3-1.svg">
            </div>
          <!-- Modal Header -->
            <div class="ays-modal-header">
                <span class="ays-close">&times;</span>
                <h2><?php echo esc_html( __('Export Filter', 'secure-copy-content-protection') )?></h2>
            </div>

          <!-- Modal body -->
            <div class="ays-modal-body">
                <form method="post" id="ays_sccp_export_filter">              
                    <div class="filter-col">
                        <label for="sccp_id-filter"><?php echo esc_html( __("Shortcode ID", 'secure-copy-content-protection') ); ?></label>
                        <button type="button" class="ays_sccpid_clear button button-small wp-picker-default"><?php echo esc_html( __("Clear", 'secure-copy-content-protection') ); ?></button>
                        <select name="sccp_id-select[]" id="sccp_id-filter" multiple="multiple"></select>
                    </div>
                    <div class="filter-block">
                        <div class="filter-block filter-col">
                            <label for="sccp_start-date-filter"><?php echo esc_html( __("Start Date from", 'secure-copy-content-protection') );?></label>
                            <input type="date" name="start-date-filter" id="sccp_start-date-filter">
                        </div>
                        <div class="filter-block filter-col">
                            <label for="sccp_end-date-filter"><?php echo esc_html( __("Start Date to", 'secure-copy-content-protection') );?></label>
                            <input type="date" name="end-date-filter" id="sccp_end-date-filter">
                        </div>
                    </div>
                </form>
            </div>

          <!-- Modal footer -->
            <div class="ays-modal-footer">
                <div class="export_results_count">
                    <p>Matched <span>0</span> results</p>
                </div>
                <span style="margin-right: 5px;"><?php echo esc_html( __('Export to', 'secure-copy-content-protection') ); ?></span>
                
                <button type="button" class="button button-primary sccp_results_export-action" data-type="csv"><?php echo esc_html( __('CSV', 'secure-copy-content-protection') );?></button>
                <button type="button" class="button button-primary sccp_results_export-action" data-type="xlsx"><?php echo esc_html( __('XLSX', 'secure-copy-content-protection') );?></button>
                <button type="button" class="button button-primary sccp_results_export-action" data-type="json"><?php echo esc_html( __('JSON', 'secure-copy-content-protection') );?></button>
                <a href="javascript:void(0)" id="download" style="display: none;">Download</a>

                <?php 
                    $sccp_ajax_export_results_nonce = wp_create_nonce( 'sccp-ajax-export-results-nonce' ); 
                ?>
                <input type="hidden" id="sccp_ajax_export_results_nonce" name="sccp_ajax_export_results_nonce" value="<?php echo $sccp_ajax_export_results_nonce; ?>">
            </div>

        </div>
    </div>
</div>
