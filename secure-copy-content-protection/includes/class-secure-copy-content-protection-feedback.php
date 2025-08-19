<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Secure_Copy_Content_Protection_Feedback {

	/**
	 * API feedback URL.
	 *
	 * Holds the URL of the feedback API.
	 *
	 * @access private
	 * @static
	 *
	 * @var string API feedback URL.
	 */
	private static $api_feedback_url = 'https://poll-plugin.com/sccp/feedback/';

	/**
	 * @since 1.0.0
	 * @access public
	 */
	public function __construct() {
		add_action( 'current_screen', function () {
			if ( ! $this->is_plugins_screen() ) {
				return;
			}

			add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_feedback_dialog_scripts' ) );
		} );

		// Ajax.
		add_action( 'wp_ajax_ays_sccp_deactivate_feedback', array( $this, 'ays_sccp_deactivate_feedback' ) );
	}

	/**
	 * Get module name.
	 *
	 * Retrieve the module name.
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 * @return string Module name.
	 */
	public function get_name() {
		return 'feedback';
	}

	/**
	 * Enqueue feedback dialog scripts.
	 *
	 * Registers the feedback dialog scripts and enqueues them.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function enqueue_feedback_dialog_scripts() {
		add_action( 'admin_footer', array( $this, 'print_deactivate_feedback_dialog' ) );
	}

	/**
	 * Print deactivate feedback dialog.
	 *
	 * Display a dialog box to ask the user why he deactivated Secure Copy Content Protection.
	 *
	 * Fired by `admin_footer` filter.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function print_deactivate_feedback_dialog() {
		$deactivate_reasons = array(
			'no_longer_needed' => array(
				'title' => esc_html__( 'I no longer need the plugin', 'secure-copy-content-protection' ),
				'input_placeholder' => '',
			),
			'found_a_better_plugin' => array(
				'title' => esc_html__( 'I found a better alternative', 'secure-copy-content-protection' ),
				'input_placeholder' => esc_html__( 'Other', 'secure-copy-content-protection' ),
				'sub_reason' => array(
					'wp_content_copy' 	        => esc_html__( 'WP Content Copy Protection & No Right Click', 'secure-copy-content-protection' ),
					'wp_content_color_design'   => esc_html__( 'WP Content Copy Protection with Color Design', 'secure-copy-content-protection' ),
					'wp_copyright_protection' 	=> esc_html__( 'WP-Copyright-Protection', 'secure-copy-content-protection' ),
					'disabled_right_click' 		=> esc_html__( 'Disabled Right Click and Content Protection', 'secure-copy-content-protection' ),
				),
			),
			'couldnt_get_the_plugin_to_work' => array(
				'title' => esc_html__( "The plugin didn’t work as expected", 'secure-copy-content-protection' ),
				'input_placeholder' => '',
			),
			'missing_features' => array(
				'title' => esc_html__( 'Missing essential features', 'secure-copy-content-protection' ),
				'input_placeholder' => esc_html__( 'Please share which features', 'secure-copy-content-protection' ),
			),
			'temporary_deactivation' => array(
				'title' => esc_html__( "I only needed it temporarily", 'secure-copy-content-protection' ),
				'input_placeholder' => '',
			),
			'plugin_or_theme_conflict' => array(
				'title' => esc_html__( "Conflicts with other plugins or themes", 'secure-copy-content-protection' ),
				// 'input_placeholder' => esc_html__( 'Please share which plugin or theme', 'secure-copy-content-protection' ),
				'input_placeholder' => '',
				'alert' => sprintf( __("Contact our %s support team %s to find and fix the issue.", 'secure-copy-content-protection'),
                                    "<a href='https://ays-pro.com/contact' target='_blank'>",
                                    "</a>"
                                ),
			),
			'sccp_pro' => array(
				'title' => esc_html__( 'I’m using the premium version now', 'secure-copy-content-protection' ),
				'input_placeholder' => '',
				// 'alert' => esc_html__( "Wait! Don't deactivate Secure Copy Content Protection. You have to activate both Secure Copy Content Protection and Secure Copy Content Protection Pro in order for the plugin to work.", 'secure-copy-content-protection' ),
			),
			'other' => array(
				'title' => esc_html__( 'Other', 'secure-copy-content-protection' ),
				'input_placeholder' => esc_html__( 'Please share the reason', 'secure-copy-content-protection' ),
			),
		);

		$sccp_deactivate_feedback_nonce = wp_create_nonce( 'ays_sccp_deactivate_feedback_nonce' );

		?>
		<div class="ays-sccp-dialog-widget ays-sccp-dialog-lightbox-widget ays-sccp-dialog-type-buttons ays-sccp-dialog-type-lightbox" id="ays-sccp-deactivate-feedback-modal" aria-modal="true" role="document" tabindex="0" style="display: none;">
		    <div class="ays-sccp-dialog-widget-content ays-sccp-dialog-lightbox-widget-content">
		        <div class="ays-sccp-dialog-header ays-sccp-dialog-lightbox-header">
		            <div id="ays-sccp-deactivate-feedback-dialog-header">
						<img class="ays-sccp-dialog-logo" src="<?php echo esc_url( SCCP_ADMIN_URL . '/images/sccp.png' ); ?>" alt="<?php echo esc_attr( __( "Secure Copy Content Protection", 'secure-copy-content-protection' ) ); ?>" title="<?php echo esc_attr( __( "Secure Copy Content Protection", 'secure-copy-content-protection' ) ); ?>" width="20" height="20"/>
						<span id="ays-sccp-deactivate-feedback-dialog-header-title"><?php echo esc_html__( 'Quick Feedback', 'secure-copy-content-protection' ); ?></span>
					</div>
		        </div>
		        <div class="ays-sccp-dialog-message ays-sccp-dialog-lightbox-message">
					<form id="ays-sccp-deactivate-feedback-dialog-form" method="post">
						<input type="hidden" id="ays_sccp_deactivate_feedback_nonce" name="ays_sccp_deactivate_feedback_nonce" value="<?php echo esc_attr($sccp_deactivate_feedback_nonce) ; ?>">
						<input type="hidden" name="action" value="ays_sccp_deactivate_feedback" />

						<div id="ays-sccp-deactivate-feedback-dialog-form-caption"><?php echo esc_html__( 'If you have a moment, please share why you are deactivating Secure Copy Content Protection:', 'secure-copy-content-protection' ); ?></div>
						<div id="ays-sccp-deactivate-feedback-dialog-form-body">
							<?php foreach ( $deactivate_reasons as $reason_key => $reason ) : ?>
								<div class="ays-sccp-deactivate-feedback-dialog-input-wrapper">
									<input id="ays-sccp-deactivate-feedback-<?php echo esc_attr( $reason_key ); ?>" class="ays-sccp-deactivate-feedback-dialog-input" type="radio" name="ays_sccp_reason_key" value="<?php echo esc_attr( $reason_key ); ?>" />
									<label for="ays-sccp-deactivate-feedback-<?php echo esc_attr( $reason_key ); ?>" class="ays-sccp-deactivate-feedback-dialog-label"><?php echo esc_html( $reason['title'] ); ?>
									<?php if ( ! empty( $reason['input_placeholder'] ) && empty( $reason['sub_reason'] ) ) : ?>
										<input class="ays-sccp-feedback-text" type="text" name="ays_sccp_reason_<?php echo esc_attr( $reason_key ); ?>" placeholder="<?php echo esc_attr( $reason['input_placeholder'] ); ?>" />
									<?php endif; ?>
									<?php if ( ! empty( $reason['alert'] ) ) : ?>
										<div class="ays-sccp-feedback-text ays-sccp-feedback-text-color"><?php echo wp_kses_post( $reason['alert'] ); ?></div>
									<?php endif; ?>
									<?php if ( ! empty( $reason['sub_reason'] ) && is_array($reason['sub_reason']) ) : ?>
										<div class="ays-sccp-deactivate-feedback-sub-dialog-input-wrapper">
										<?php foreach ( $reason['sub_reason'] as $sub_reason_key => $sub_reason ) : ?>
											<div class="ays-sccp-deactivate-feedback-dialog-input-wrapper">
												<input id="ays-sccp-deactivate-feedback-sub-<?php echo esc_attr( $sub_reason_key ); ?>" class="ays-sccp-deactivate-feedback-dialog-input" type="radio" name="ays_sccp_sub_reason_key" value="<?php echo esc_attr( $sub_reason_key ); ?>" />
												<label for="ays-sccp-deactivate-feedback-sub-<?php echo esc_attr( $sub_reason_key ); ?>" class="ays-sccp-deactivate-feedback-dialog-label"><?php echo esc_html( $sub_reason ); ?>
												</label>
											</div>
										<?php endforeach; ?>
										</div>
										<?php if ( ! empty( $reason['input_placeholder'] ) ) : ?>
											<input class="ays-sccp-feedback-text" type="text" name="ays_sccp_reason_<?php echo esc_attr( $reason_key ); ?>" placeholder="<?php echo esc_attr( $reason['input_placeholder'] ); ?>" />
										<?php endif; ?>
									<?php endif; ?>
									</label>
								</div>
							<?php endforeach; ?>
						</div>
					</form>
		        </div>
		        <div class="ays-sccp-dialog-buttons-wrapper ays-sccp-dialog-lightbox-buttons-wrapper">
		            <button class="ays-sccp-dialog-button ays-sccp-dialog-skip ays-sccp-dialog-lightbox-skip" data-type="skip"><?php echo esc_html__( 'Skip &amp; Deactivate', 'secure-copy-content-protection' ); ?></button>
		            <button class="ays-sccp-dialog-button ays-sccp-dialog-submit ays-sccp-dialog-lightbox-submit" data-type="submit"><?php echo esc_html__( 'Submit &amp; Deactivate', 'secure-copy-content-protection' ); ?></button>
		        </div>
    		</div>
		</div>
		<?php
	}

	/**
	 * Ajax Secure Copy Content Protection deactivate feedback.
	 *
	 * Send the user feedback when Secure Copy Content Protection is deactivated.
	 *
	 * Fired by `wp_ajax_ays_sccp_deactivate_feedback` action.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function ays_sccp_deactivate_feedback() {

		if ( empty($_REQUEST['ays_sccp_deactivate_feedback_nonce']) ) {
			wp_send_json_error();
		}

		// Run a security check.
        check_ajax_referer( 'ays_sccp_deactivate_feedback_nonce', sanitize_key( $_REQUEST['_ajax_nonce'] ) );

		if ( ! current_user_can( 'activate_plugins' ) ) {
			wp_send_json_error( 'Permission denied' );
		}

		if (empty($_REQUEST['action']) || (isset($_REQUEST['action']) && $_REQUEST['action'] != 'ays_sccp_deactivate_feedback')) {
			wp_send_json_error( 'Action error' );
		}

		$reason_key = !empty($_REQUEST['ays_sccp_reason_key']) ? sanitize_text_field($_REQUEST['ays_sccp_reason_key']) : "";
		$sub_reason_key = !empty($_REQUEST['ays_sccp_sub_reason_key']) ? sanitize_text_field($_REQUEST['ays_sccp_sub_reason_key']) : "";
		$reason_text = !empty($_REQUEST["ays_sccp_reason_{$reason_key}"]) ? sanitize_text_field($_REQUEST["ays_sccp_reason_{$reason_key}"]) : "";
		$type = !empty($_REQUEST["type"]) ? sanitize_text_field($_REQUEST["type"]) : "";

		self::send_feedback( $reason_key, $sub_reason_key, $reason_text, $type );

		wp_send_json_success();
	}

	/**
	 * @since 1.0.0
	 * @access private
	 */
	private function is_plugins_screen() {
		return in_array( get_current_screen()->id, array( 'plugins', 'plugins-network' ) );
	}

	/**
	 * Send Feedback.
	 *
	 * Fires a request to Secure Copy Content Protection server with the feedback data.
	 *
	 * @since 1.0.0
	 * @access public
	 * @static
	 *
	 * @param string $feedback_key  Feedback key.
	 * @param string $feedback_text Feedback text.
	 *
	 * @return array The response of the request.
	 */
	public static function send_feedback( $feedback_key, $sub_feedback_key, $feedback_text, $type ) {
		return wp_remote_post( self::$api_feedback_url, array(
			'timeout' => 30,
			'body' => wp_json_encode(array(
				'type' 				=> 'sccp',
				'version' 			=> SCCP_NAME_VERSION,
				'site_lang' 		=> get_bloginfo( 'language' ),
				'button' 			=> $type,
				'feedback_key' 		=> $feedback_key,
				'sub_feedback_key' 	=> $sub_feedback_key,
				'feedback' 			=> $feedback_text,
			)),
		) );
	}
}
new Secure_Copy_Content_Protection_Feedback();
