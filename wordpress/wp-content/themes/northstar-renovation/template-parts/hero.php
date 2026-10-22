<?php
/**
 * Hero template part for Northstar Renovation.
 *
 * @package NorthstarRenovation
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<section class="ns-hero" aria-label="<?php esc_attr_e( 'Hero Introduction', 'northstar-renovation' ); ?>">
	<img src="<?php echo esc_url( NORTHSTAR_URI . '/assets/images/hero-bg.jpg' ); ?>" alt="" class="ns-hero-bg" aria-hidden="true" width="1920" height="1080">

	<div class="ns-container">
		<div class="ns-hero-inner">
			<span class="ns-hero-eyebrow">
				<?php esc_html_e( 'Residential Architecture & Renovation', 'northstar-renovation' ); ?>
			</span>

			<h1 class="ns-hero-title">
				<?php esc_html_e( 'Architectural Precision. Master Craftsmanship. Transparent Stewardship.', 'northstar-renovation' ); ?>
			</h1>

			<p class="ns-hero-lead">
				<?php esc_html_e( 'We design and execute bespoke kitchen transformations, primary ensuite sanctuaries, and whole-home spatial renewals. Operating exclusively on fixed-price agreements with dedicated project leadership.', 'northstar-renovation' ); ?>
			</p>

			<div class="ns-hero-ctas">
				<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="ns-btn ns-btn-terracotta">
					<?php esc_html_e( 'Request a Free Consultation', 'northstar-renovation' ); ?>
					<span aria-hidden="true">&rarr;</span>
				</a>
				<a href="<?php echo esc_url( home_url( '/portfolio/' ) ); ?>" class="ns-btn ns-btn-outline-light">
					<?php esc_html_e( 'Explore Our Projects', 'northstar-renovation' ); ?>
				</a>
			</div>

			<!-- Architectural Trust & Credibility Bar -->
			<div class="ns-hero-trust-bar">
				<div class="ns-trust-item">
					<svg class="ns-trust-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
						<path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
					</svg>
					<span class="ns-trust-text"><strong><?php esc_html_e( 'Fixed-Price Pledge', 'northstar-renovation' ); ?></strong> &mdash; <?php esc_html_e( 'Zero Surprise Billing', 'northstar-renovation' ); ?></span>
				</div>

				<div class="ns-trust-item">
					<svg class="ns-trust-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
						<circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/>
					</svg>
					<span class="ns-trust-text"><strong><?php esc_html_e( 'Guaranteed Timelines', 'northstar-renovation' ); ?></strong> &mdash; <?php esc_html_e( 'Structured Milestones', 'northstar-renovation' ); ?></span>
				</div>

				<div class="ns-trust-item">
					<svg class="ns-trust-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
						<polyline points="20 6 9 17 4 12"/>
					</svg>
					<span class="ns-trust-text"><strong><?php esc_html_e( '3-Year Warranty', 'northstar-renovation' ); ?></strong> &mdash; <?php esc_html_e( 'Complete Craft Protection', 'northstar-renovation' ); ?></span>
				</div>
			</div>
		</div>
	</div>
</section>
