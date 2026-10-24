<?php
/**
 * Plugin Name:       Northstar Renovation Site Core
 * Plugin URI:        https://northstar-renovation.local/plugins/northstar-site-core
 * Description:       Core functionality, custom post types, taxonomies, and server-side form processing for Northstar Renovation.
 * Version:           1.0.0
 * Requires at least: 6.0
 * Requires PHP:      8.0
 * Author:            work25cn@gmail.com
 * Author URI:        https://t.me/Slava_Dev_bot
 * License:           GPL-2.0-or-later
 * Text Domain:       northstar-site-core
 * Domain Path:       /languages
 *
 * @package NorthstarSiteCore
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'NORTHSTAR_CORE_VERSION', '1.0.0' );
define( 'NORTHSTAR_CORE_PATH', plugin_dir_path( __FILE__ ) );
define( 'NORTHSTAR_CORE_URL', plugin_dir_url( __FILE__ ) );

// Load Custom Post Types & Taxonomies.
require_once NORTHSTAR_CORE_PATH . 'includes/post-types.php';

/**
 * Plugin activation hook.
 */
function northstar_core_activate() {
	northstar_core_register_post_types();
	northstar_core_register_taxonomies();
	flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'northstar_core_activate' );

/**
 * Plugin deactivation hook.
 */
function northstar_core_deactivate() {
	flush_rewrite_rules();
}
register_deactivation_hook( __FILE__, 'northstar_core_deactivate' );

/**
 * Handle Quote Request / Contact Form Submission (Standard POST & AJAX).
 */
function northstar_core_handle_contact_submission() {
	// 1. Verify CSRF Nonce.
	if ( ! isset( $_POST['northstar_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['northstar_nonce'] ) ), 'northstar_quote_action' ) ) {
		northstar_core_respond_error( 'security_failed', __( 'Security verification failed. Please refresh the page and try again.', 'northstar-site-core' ) );
		return;
	}

	// 2. Anti-spam Honeypot Check (field should be empty).
	if ( ! empty( $_POST['ns_website_verify'] ) ) {
		// Silent exit for automated spambots.
		wp_safe_redirect( home_url( '/contact/?contact_status=success#contact-form' ) );
		exit;
	}

	// 3. Sanitize and Validate Inputs.
	$full_name     = isset( $_POST['full_name'] ) ? sanitize_text_field( wp_unslash( $_POST['full_name'] ) ) : '';
	$email         = isset( $_POST['email'] ) ? sanitize_email( wp_unslash( $_POST['email'] ) ) : '';
	$phone         = isset( $_POST['phone'] ) ? sanitize_text_field( wp_unslash( $_POST['phone'] ) ) : '';
	$service       = isset( $_POST['service'] ) ? sanitize_text_field( wp_unslash( $_POST['service'] ) ) : '';
	$budget_tier   = isset( $_POST['budget_tier'] ) ? sanitize_text_field( wp_unslash( $_POST['budget_tier'] ) ) : '';
	$timeline      = isset( $_POST['timeline'] ) ? sanitize_text_field( wp_unslash( $_POST['timeline'] ) ) : '';
	$project_scope = isset( $_POST['project_scope'] ) ? sanitize_textarea_field( wp_unslash( $_POST['project_scope'] ) ) : '';
	$privacy_agreed= isset( $_POST['privacy_consent'] ) && '1' === $_POST['privacy_consent'];

	$errors = array();

	if ( empty( $full_name ) || strlen( $full_name ) < 2 ) {
		$errors['full_name'] = __( 'Please enter your full name.', 'northstar-site-core' );
	}

	if ( empty( $email ) || ! is_email( $email ) ) {
		$errors['email'] = __( 'Please enter a valid email address.', 'northstar-site-core' );
	}

	$allowed_services = array(
		'kitchen-renovation',
		'bathroom-remodeling',
		'whole-home-renovation',
		'interior-remodeling',
		'flooring-finishing',
		'architectural-consultation',
		'other',
	);

	if ( empty( $service ) || ! in_array( $service, $allowed_services, true ) ) {
		$errors['service'] = __( 'Please select a renovation service.', 'northstar-site-core' );
	}

	if ( empty( $project_scope ) || strlen( $project_scope ) < 15 ) {
		$errors['project_scope'] = __( 'Please describe your project (minimum 15 characters).', 'northstar-site-core' );
	}

	if ( ! $privacy_agreed ) {
		$errors['privacy_consent'] = __( 'Please agree to the privacy statement to proceed.', 'northstar-site-core' );
	}

	if ( ! empty( $errors ) ) {
		northstar_core_respond_error( 'validation_failed', $errors );
		return;
	}

	// 4. Construct Notification Email.
	$admin_email = get_option( 'admin_email', 'work25cn@gmail.com' );
	$recipient   = apply_filters( 'northstar_consultation_recipient', $admin_email );

	$subject = sprintf(
		/* translators: 1: Service name, 2: Client name */
		__( '[New Consultation Request] %1$s — %2$s', 'northstar-site-core' ),
		ucwords( str_replace( '-', ' ', $service ) ),
		$full_name
	);

	$message_body  = "New Consultation Request submitted via Northstar Renovation Website:\n\n";
	$message_body .= "Client Name: " . $full_name . "\n";
	$message_body .= "Email: " . $email . "\n";
	$message_body .= "Telephone: " . ( ! empty( $phone ) ? $phone : 'Not provided' ) . "\n";
	$message_body .= "Requested Service: " . ucwords( str_replace( '-', ' ', $service ) ) . "\n";
	$message_body .= "Budget Tier: " . ( ! empty( $budget_tier ) ? $budget_tier : 'To be discussed' ) . "\n";
	$message_body .= "Target Timeline: " . ( ! empty( $timeline ) ? $timeline : 'Flexible' ) . "\n\n";
	$message_body .= "Project Scope & Architectural Details:\n";
	$message_body .= "--------------------------------------------------\n";
	$message_body .= $project_scope . "\n";
	$message_body .= "--------------------------------------------------\n\n";
	$message_body .= "Submitted At: " . current_time( 'mysql' ) . "\n";
	$message_body .= "Client IP: " . ( isset( $_SERVER['REMOTE_ADDR'] ) ? sanitize_text_field( wp_unslash( $_SERVER['REMOTE_ADDR'] ) ) : 'Unknown' ) . "\n";
	$message_body .= "Privacy Consent: Acknowledged\n";

	$headers = array(
		'From: Northstar Renovation <no-reply@' . wp_parse_url( home_url(), PHP_URL_HOST ) . '>',
		'Reply-To: ' . $full_name . ' <' . $email . '>',
		'Content-Type: text/plain; charset=UTF-8',
	);

	$mail_sent = wp_mail( $recipient, $subject, $message_body, $headers );

	// 5. Respond with Success.
	if ( wp_doing_ajax() ) {
		wp_send_json_success( array(
			'message'   => __( 'Thank you! Your consultation request has been received. Our team will review your project details and respond within one business day.', 'northstar-site-core' ),
			'mail_sent' => (bool) $mail_sent,
		) );
	} else {
		$redirect_url = wp_get_referer() ? wp_get_referer() : home_url( '/contact/' );
		$redirect_url = add_query_arg( 'contact_status', 'success', $redirect_url );
		$redirect_url = remove_query_arg( array( 'err_code', 'err_field' ), $redirect_url );
		wp_safe_redirect( $redirect_url . '#contact-feedback' );
		exit;
	}
}
add_action( 'admin_post_nopriv_northstar_submit_quote', 'northstar_core_handle_contact_submission' );
add_action( 'admin_post_northstar_submit_quote', 'northstar_core_handle_contact_submission' );
add_action( 'wp_ajax_nopriv_northstar_submit_quote', 'northstar_core_handle_contact_submission' );
add_action( 'wp_ajax_northstar_submit_quote', 'northstar_core_handle_contact_submission' );

/**
 * Helper to handle errors gracefully across AJAX and standard POST.
 *
 * @param string       $error_code Error identifier.
 * @param string|array $error_data Human-readable error message or array of field errors.
 */
function northstar_core_respond_error( $error_code, $error_data ) {
	if ( wp_doing_ajax() ) {
		wp_send_json_error( array(
			'code'   => $error_code,
			'errors' => is_array( $error_data ) ? $error_data : array( 'general' => $error_data ),
		) );
	} else {
		$redirect_url = wp_get_referer() ? wp_get_referer() : home_url( '/contact/' );
		$redirect_url = add_query_arg( array(
			'contact_status' => 'error',
			'err_code'       => sanitize_key( $error_code ),
		), $redirect_url );

		if ( is_array( $error_data ) ) {
			$first_field = array_key_first( $error_data );
			$redirect_url = add_query_arg( 'err_field', sanitize_key( $first_field ), $redirect_url );
		}

		wp_safe_redirect( $redirect_url . '#contact-feedback' );
		exit;
	}
}
