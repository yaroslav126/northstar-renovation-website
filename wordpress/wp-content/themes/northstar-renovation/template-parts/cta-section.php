<?php
/**
 * Call to Action conversion section template part.
 *
 * @package NorthstarRenovation
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<section class="ns-section ns-section-dark" aria-labelledby="cta-heading">
	<div class="ns-container text-center" style="max-width: 820px; text-align: center; margin-left: auto; margin-right: auto;">
		<span class="ns-section-eyebrow" style="color: var(--ns-color-stone);">
			<?php esc_html_e( 'Begin Your Renovation Journey', 'northstar-renovation' ); ?>
		</span>

		<h2 id="cta-heading" style="color: var(--ns-color-ivory); margin-bottom: var(--ns-space-4);">
			<?php esc_html_e( 'Ready to Transform Your Living Space With Architectural Precision?', 'northstar-renovation' ); ?>
		</h2>

		<p style="color: var(--ns-color-stone); font-size: 1.15rem; margin-bottom: var(--ns-space-8); margin-left: auto; margin-right: auto;">
			<?php esc_html_e( 'Schedule an initial 90-minute site assessment with our principal design and construction directors. We will review floorplan potential, structural feasibility, and itemized investment guidelines before you commit.', 'northstar-renovation' ); ?>
		</p>

		<div style="display: flex; justify-content: center; flex-wrap: wrap; gap: var(--ns-space-4); margin-bottom: var(--ns-space-6);">
			<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="ns-btn ns-btn-terracotta">
				<?php esc_html_e( 'Schedule Your Consultation', 'northstar-renovation' ); ?> &rarr;
			</a>
			<a href="tel:+15557829400" class="ns-btn ns-btn-outline-light">
				<?php esc_html_e( 'Direct Inquiries: (555) 782-9400', 'northstar-renovation' ); ?>
			</a>
		</div>

		<p style="font-size: 0.8125rem; color: var(--ns-color-stone); opacity: 0.8;">
			<?php esc_html_e( 'Zero obligation. Transparent estimates. Demonstration contact inquiries are logged safely.', 'northstar-renovation' ); ?>
		</p>
	</div>
</section>
