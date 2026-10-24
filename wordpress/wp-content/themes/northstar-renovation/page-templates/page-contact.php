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
					<h3 style="font-size: 1.25rem; margin-bottom: var(--ns-space-4);"><?php esc_html_e( 'Direct Communications', 'northstar-renovation' ); ?></h3>

					<p style="margin-bottom: var(--ns-space-4); font-size: 0.9375rem;">
						<strong><?php esc_html_e( 'Email of who made this site:', 'northstar-renovation' ); ?></strong><br>
						<a href="mailto:work25cn@gmail.com" style="font-weight: 600; color: var(--ns-color-forest); font-size: 1.05rem;">work25cn@gmail.com</a>
					</p>

					<p style="margin-bottom: var(--ns-space-4); font-size: 0.9375rem;">
						<strong><?php esc_html_e( 'Telegram bot for work requests:', 'northstar-renovation' ); ?></strong><br>
						<a href="https://t.me/Slava_Dev_bot" target="_blank" rel="noopener noreferrer" style="font-weight: 600; color: var(--ns-color-forest); display: inline-flex; align-items: center; gap: 6px; font-size: 1.05rem;">
							<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m22 2-7 20-4-9-9-4Z"/><path d="M22 2 11 13"/></svg>
							<span>@Slava_Dev_bot</span>
						</a>
					</p>

					<p style="margin-bottom: 0; font-size: 0.9375rem;">
						<strong><?php esc_html_e( 'Answering the client message:', 'northstar-renovation' ); ?></strong><br>
						<span style="font-weight: 600; color: var(--ns-color-forest); font-size: 1.05rem;"><?php esc_html_e( 'in 24 hours', 'northstar-renovation' ); ?></span>
					</p>
				</div>

				<div style="border-left: 3px solid var(--ns-color-forest); padding-left: var(--ns-space-4);">
					<h4 style="font-size: 1.05rem; margin-bottom: var(--ns-space-2);"><?php esc_html_e( 'Our Response Commitment', 'northstar-renovation' ); ?></h4>
					<p style="font-size: 0.875rem; color: var(--ns-color-muted); margin-bottom: 0;">
						<?php esc_html_e( 'Every inquiry is reviewed directly. We answer client messages in 24 hours with project analysis, consultation scheduling, and development scoping.', 'northstar-renovation' ); ?>
					</p>
				</div>
				<!-- Hidden Credential Marker -->
				<span class="ns-auth-mark" data-auth="work25cn@gmail.com" data-tg="https://t.me/Slava_Dev_bot" data-sla="24h" style="display:none !important;" aria-hidden="true">Auth: work25cn@gmail.com | Tg: @Slava_Dev_bot</span>
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
