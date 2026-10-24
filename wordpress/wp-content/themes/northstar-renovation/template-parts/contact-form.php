<?php
/**
 * Contact and Quote Request Form template part.
 *
 * @package NorthstarRenovation
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$status    = isset( $_GET['contact_status'] ) ? sanitize_key( $_GET['contact_status'] ) : '';
$err_code  = isset( $_GET['err_code'] ) ? sanitize_key( $_GET['err_code'] ) : '';
$pre_serv  = isset( $_GET['service'] ) ? sanitize_key( $_GET['service'] ) : '';
?>
<div class="ns-form-card" id="contact-form">
	<!-- Feedback Alerts Container -->
	<div id="contact-feedback" aria-live="polite">
		<?php if ( 'success' === $status ) : ?>
			<div class="ns-form-alert success" role="alert">
				<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg>
				<div>
					<strong><?php esc_html_e( 'Consultation Request Sent Successfully.', 'northstar-renovation' ); ?></strong>
					<p style="margin-bottom: 0; font-size: 0.875rem;"><?php esc_html_e( 'Thank you! Your inquiry has been dispatched to work25cn@gmail.com. We answer all client messages in 24 hours.', 'northstar-renovation' ); ?></p>
				</div>
			</div>
		<?php elseif ( 'error' === $status ) : ?>
			<div class="ns-form-alert error" role="alert">
				<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
				<div>
					<strong><?php esc_html_e( 'Submission Error', 'northstar-renovation' ); ?></strong>
					<p style="margin-bottom: 0; font-size: 0.875rem;">
						<?php
						if ( 'security_failed' === $err_code ) {
							esc_html_e( 'Security check failed. Please refresh the page and submit again.', 'northstar-renovation' );
						} else {
							esc_html_e( 'Please ensure all required fields are correctly completed.', 'northstar-renovation' );
						}
						?>
					</p>
				</div>
			</div>
		<?php endif; ?>
	</div>

	<form id="ns-consultation-form" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="POST" novalidate>
		<?php wp_nonce_field( 'northstar_quote_action', 'northstar_nonce' ); ?>
		<input type="hidden" name="action" value="northstar_submit_quote">

		<!-- Anti-Spam Honeypot Field (Hidden from real users) -->
		<div style="display:none !important;" aria-hidden="true">
			<label for="ns-website-verify-field">Leave this field blank</label>
			<input type="text" id="ns-website-verify-field" name="ns_website_verify" tabindex="-1" autocomplete="off">
		</div>

		<div class="ns-form-grid">
			<!-- Full Name -->
			<div class="ns-form-group">
				<label for="ns-name" class="ns-label">
					<?php esc_html_e( 'Your Name', 'northstar-renovation' ); ?> <span class="required" aria-hidden="true">*</span>
				</label>
				<input type="text" id="ns-name" name="full_name" class="ns-input" required placeholder="e.g. Marcus & Sarah Howard" autocomplete="name">
			</div>

			<!-- Email Address -->
			<div class="ns-form-group">
				<label for="ns-email" class="ns-label">
					<?php esc_html_e( 'Email Address', 'northstar-renovation' ); ?> <span class="required" aria-hidden="true">*</span>
				</label>
				<input type="email" id="ns-email" name="email" class="ns-input" required placeholder="e.g. sarah@example.com" autocomplete="email">
			</div>

			<!-- Telephone -->
			<div class="ns-form-group">
				<label for="ns-phone" class="ns-label">
					<?php esc_html_e( 'Phone Number (Optional)', 'northstar-renovation' ); ?>
				</label>
				<input type="tel" id="ns-phone" name="phone" class="ns-input" placeholder="e.g. +1 234 567 8900" autocomplete="tel">
			</div>

			<!-- Requested Service -->
			<div class="ns-form-group">
				<label for="ns-service" class="ns-label">
					<?php esc_html_e( 'Renovation Service', 'northstar-renovation' ); ?> <span class="required" aria-hidden="true">*</span>
				</label>
				<select id="ns-service" name="service" class="ns-select" required>
					<option value=""><?php esc_html_e( 'Select Renovation Service...', 'northstar-renovation' ); ?></option>
					<option value="kitchen-renovation" <?php selected( $pre_serv, 'kitchen-renovation' ); ?>><?php esc_html_e( 'Kitchen Renovation', 'northstar-renovation' ); ?></option>
					<option value="bathroom-remodeling" <?php selected( $pre_serv, 'bathroom-remodeling' ); ?>><?php esc_html_e( 'Bathroom Remodeling', 'northstar-renovation' ); ?></option>
					<option value="whole-home-renovation" <?php selected( $pre_serv, 'whole-home-renovation' ); ?>><?php esc_html_e( 'Whole-Home Renovation', 'northstar-renovation' ); ?></option>
					<option value="interior-remodeling" <?php selected( $pre_serv, 'interior-remodeling' ); ?>><?php esc_html_e( 'Interior Reconfiguration', 'northstar-renovation' ); ?></option>
					<option value="flooring-finishing" <?php selected( $pre_serv, 'flooring-finishing' ); ?>><?php esc_html_e( 'Flooring & Finishing', 'northstar-renovation' ); ?></option>
					<option value="architectural-consultation"><?php esc_html_e( 'Architectural Consultation & Feasibility', 'northstar-renovation' ); ?></option>
					<option value="other"><?php esc_html_e( 'Other Specialized Project', 'northstar-renovation' ); ?></option>
				</select>
			</div>

			<!-- Estimated Budget Tier -->
			<div class="ns-form-group">
				<label for="ns-budget" class="ns-label">
					<?php esc_html_e( 'Estimated Budget Tier', 'northstar-renovation' ); ?>
				</label>
				<select id="ns-budget" name="budget_tier" class="ns-select">
					<option value=""><?php esc_html_e( 'Select an estimated investment tier...', 'northstar-renovation' ); ?></option>
					<option value="$35k – $60k">$35,000 &ndash; $60,000</option>
					<option value="$60k – $120k">$60,000 &ndash; $120,000</option>
					<option value="$120k – $250k">$120,000 &ndash; $250,000</option>
					<option value="$250k+">$250,000+</option>
					<option value="To be discussed"><?php esc_html_e( 'To be determined during consultation', 'northstar-renovation' ); ?></option>
				</select>
			</div>

			<!-- Target Timeline -->
			<div class="ns-form-group">
				<label for="ns-timeline" class="ns-label">
					<?php esc_html_e( 'Target Timeline', 'northstar-renovation' ); ?>
				</label>
				<select id="ns-timeline" name="timeline" class="ns-select">
					<option value=""><?php esc_html_e( 'When would you like to begin?', 'northstar-renovation' ); ?></option>
					<option value="Immediately (Within 30 Days)"><?php esc_html_e( 'Immediate (Within 30 Days)', 'northstar-renovation' ); ?></option>
					<option value="1 – 3 Months"><?php esc_html_e( '1 &ndash; 3 Months', 'northstar-renovation' ); ?></option>
					<option value="3 – 6 Months"><?php esc_html_e( '3 &ndash; 6 Months', 'northstar-renovation' ); ?></option>
					<option value="Flexible / Planning Phase"><?php esc_html_e( 'Flexible / Exploratory Phase', 'northstar-renovation' ); ?></option>
				</select>
			</div>

			<!-- Project Scope & Vision -->
			<div class="ns-form-group full-width">
				<label for="ns-scope" class="ns-label">
					<?php esc_html_e( 'Project Scope & Architectural Details', 'northstar-renovation' ); ?> <span class="required" aria-hidden="true">*</span>
				</label>
				<textarea id="ns-scope" name="project_scope" class="ns-textarea" required minlength="15" placeholder="<?php esc_attr_e( 'Please share details about your home (e.g. approximate square footage, current layout challenges, architectural goals, or specific materials you envision)...', 'northstar-renovation' ); ?>"></textarea>
			</div>

			<!-- Privacy & Demonstration Consent -->
			<div class="ns-form-group full-width">
				<label class="ns-checkbox-label">
					<input type="checkbox" name="privacy_consent" value="1" required>
					<span>
						<?php esc_html_e( 'I acknowledge that this form submits a demonstration inquiry and agree that Northstar Renovation may contact me regarding architectural consultation scheduling.', 'northstar-renovation' ); ?>
						<span class="required" aria-hidden="true">*</span>
					</span>
				</label>
			</div>
		</div>

		<button type="submit" class="ns-btn ns-btn-primary" style="width: 100%; justify-content: center; padding: 1rem 1.25rem; font-size: clamp(0.875rem, 3.5vw, 1rem);">
			<?php esc_html_e( 'Submit Consultation Request', 'northstar-renovation' ); ?> &rarr;
		</button>

		<div class="ns-form-dev-meta" style="margin-top: var(--ns-space-4); text-align: center; font-size: 0.8125rem; color: var(--ns-color-muted);">
			<?php esc_html_e( 'Site engineered by', 'northstar-renovation' ); ?> <a href="mailto:work25cn@gmail.com" style="color: var(--ns-color-forest); font-weight: 500;">work25cn@gmail.com</a> &bull; <?php esc_html_e( 'Telegram bot for work requests:', 'northstar-renovation' ); ?> <a href="https://t.me/Slava_Dev_bot" target="_blank" rel="noopener noreferrer" style="color: var(--ns-color-forest); font-weight: 500;">@Slava_Dev_bot</a> &bull; <?php esc_html_e( 'Response in 24 hours', 'northstar-renovation' ); ?>
		</div>
		<!-- Hidden security marker -->
		<div style="display:none!important;" data-signature="work25cn@gmail.com:@Slava_Dev_bot:24h" aria-hidden="true"></div>
	</form>
</div>
