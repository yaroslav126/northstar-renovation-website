<?php
/**
 * Template Name: Contact & Quote Request
 *
 * Contact page with real server-side form submission handler.
 *
 * @package NorthstarRenovation
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<!-- Contact Page Banner -->
<section class="ns-section ns-section-dark" style="padding-top: var(--ns-space-16); padding-bottom: var(--ns-space-16);">
	<div class="ns-container text-center" style="max-width: 840px; margin-left: auto; margin-right: auto; text-align: center;">
		<span class="ns-section-eyebrow" style="color: var(--ns-color-stone);">
			<?php esc_html_e( 'Begin the Conversation', 'northstar-renovation' ); ?>
		</span>
		<h1 style="color: var(--ns-color-ivory); margin-bottom: var(--ns-space-4);">
			<?php esc_html_e( 'Request a Architectural Consultation', 'northstar-renovation' ); ?>
		</h1>
		<p style="color: var(--ns-color-stone); font-size: 1.15rem; margin-left: auto; margin-right: auto;">
			<?php esc_html_e( 'Tell us about your property and architectural vision. We will review your preliminary requirements and schedule an in-depth spatial assessment.', 'northstar-renovation' ); ?>
		</p>
	</div>
</section>

<!-- Contact Form & Direct Studio Information -->
<section class="ns-section" aria-label="<?php esc_attr_e( 'Consultation Request & Studio Details', 'northstar-renovation' ); ?>">
	<div class="ns-container">
		<div class="ns-grid-2" style="align-items: flex-start; gap: var(--ns-space-12);">
			<!-- Left: Direct Studio Contact & FAQ Snippet -->
			<div>
				<span class="ns-section-eyebrow"><?php esc_html_e( 'Consultation Studio', 'northstar-renovation' ); ?></span>
				<h2 style="font-size: 2.2rem; margin-bottom: var(--ns-space-4);"><?php esc_html_e( 'Direct Inquiries & Office', 'northstar-renovation' ); ?></h2>
				<p class="ns-lead" style="margin-bottom: var(--ns-space-6);">
					<?php esc_html_e( 'Whether you are ready for a full-home architectural transformation or exploring preliminary budget feasibility, we welcome the opportunity to discuss your home.', 'northstar-renovation' ); ?>
				</p>

				<div style="background-color: var(--ns-color-white); border: 1px solid var(--ns-color-border); border-radius: var(--ns-radius-sm); padding: var(--ns-space-6); margin-bottom: var(--ns-space-8);">
					<h3 style="font-size: 1.25rem; margin-bottom: var(--ns-space-4);"><?php esc_html_e( 'Studio Information', 'northstar-renovation' ); ?></h3>

					<p style="margin-bottom: var(--ns-space-3); font-size: 0.9375rem;">
						<strong><?php esc_html_e( 'Address:', 'northstar-renovation' ); ?></strong><br>
						450 St. Clair Avenue West, Suite 300<br>
						Metropolitan District, ON M5P 1N7<br>
						<span style="font-size: 0.75rem; color: var(--ns-color-terracotta);"><?php esc_html_e( '(Demonstration Office Address)', 'northstar-renovation' ); ?></span>
					</p>

					<p style="margin-bottom: var(--ns-space-3); font-size: 0.9375rem;">
						<strong><?php esc_html_e( 'Telephone:', 'northstar-renovation' ); ?></strong><br>
						<a href="tel:+15557829400" style="font-weight: 600; color: var(--ns-color-forest);">+1 (555) 782-9400</a>
					</p>

					<p style="margin-bottom: var(--ns-space-3); font-size: 0.9375rem;">
						<strong><?php esc_html_e( 'Electronic Mail:', 'northstar-renovation' ); ?></strong><br>
						<a href="mailto:consultations@northstar-renovation.local" style="font-weight: 600; color: var(--ns-color-forest);">consultations@northstar-renovation.local</a>
					</p>

					<p style="margin-bottom: 0; font-size: 0.9375rem;">
						<strong><?php esc_html_e( 'Studio Hours:', 'northstar-renovation' ); ?></strong><br>
						Monday &ndash; Friday: 8:00 AM &ndash; 6:00 PM<br>
						Saturday: By Appointment Only
					</p>
				</div>

				<div style="border-left: 3px solid var(--ns-color-forest); padding-left: var(--ns-space-4);">
					<h4 style="font-size: 1.05rem; margin-bottom: var(--ns-space-2);"><?php esc_html_e( 'Our Response Commitment', 'northstar-renovation' ); ?></h4>
					<p style="font-size: 0.875rem; color: var(--ns-color-muted); margin-bottom: 0;">
						<?php esc_html_e( 'Every inquiry is personally reviewed by our Client Experience Director. We respond within one business day with preliminary project feedback and scheduling options.', 'northstar-renovation' ); ?>
					</p>
				</div>
			</div>

			<!-- Right: Real Contact Form Component -->
			<div>
				<?php get_template_part( 'template-parts/contact-form' ); ?>
			</div>
		</div>
	</div>
</section>

<?php
get_footer();
