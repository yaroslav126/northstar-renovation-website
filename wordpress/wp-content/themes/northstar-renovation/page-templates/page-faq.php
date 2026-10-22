<?php
/**
 * Template Name: FAQ
 *
 * Frequently Asked Questions with accessible accordion categories.
 *
 * @package NorthstarRenovation
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

$all_faqs = function_exists( 'northstar_get_demo_faqs' ) ? northstar_get_demo_faqs() : array();
?>

<!-- FAQ Page Banner -->
<section class="ns-section ns-section-dark" style="padding-top: var(--ns-space-16); padding-bottom: var(--ns-space-16);">
	<div class="ns-container text-center" style="max-width: 840px; margin-left: auto; margin-right: auto; text-align: center;">
		<span class="ns-section-eyebrow" style="color: var(--ns-color-stone);">
			<?php esc_html_e( 'Transparency & Stewardship', 'northstar-renovation' ); ?>
		</span>
		<h1 style="color: var(--ns-color-ivory); margin-bottom: var(--ns-space-4);">
			<?php esc_html_e( 'Frequently Asked Questions', 'northstar-renovation' ); ?>
		</h1>
		<p style="color: var(--ns-color-stone); font-size: 1.15rem; margin-left: auto; margin-right: auto;">
			<?php esc_html_e( 'Everything you need to know about our architectural design process, contracts, budgets, site dust containment, and warranties.', 'northstar-renovation' ); ?>
		</p>
	</div>
</section>

<!-- FAQ Accordion Listing -->
<section class="ns-section" aria-label="<?php esc_attr_e( 'FAQ Accordion Categories', 'northstar-renovation' ); ?>">
	<div class="ns-container ns-container-narrow">
		<div style="background-color: var(--ns-color-stone-light); border: 1px solid var(--ns-color-border); padding: var(--ns-space-4); border-radius: var(--ns-radius-sm); margin-bottom: var(--ns-space-8); font-size: 0.875rem;">
			<strong><?php esc_html_e( 'Demonstration Content Notice:', 'northstar-renovation' ); ?></strong>
			<?php esc_html_e( 'The policies, contract models, and warranty terms below represent demonstration guidelines for this portfolio site. All operational policies must be finalized by the individual business operator.', 'northstar-renovation' ); ?>
		</div>

		<div class="ns-faq-list" role="region" aria-label="<?php esc_attr_e( 'Interactive FAQ Accordions', 'northstar-renovation' ); ?>">
			<?php foreach ( $all_faqs as $index => $faq ) : ?>
				<div class="ns-accordion-item">
					<button type="button" class="ns-accordion-header" aria-expanded="<?php echo 0 === $index ? 'true' : 'false'; ?>" aria-controls="faq-item-<?php echo esc_attr( $index ); ?>">
						<div>
							<span style="display: block; font-size: 0.75rem; text-transform: uppercase; color: var(--ns-color-terracotta); font-family: var(--ns-font-sans); letter-spacing: 0.08em; margin-bottom: 2px;">
								<?php echo esc_html( $faq['category'] ); ?>
							</span>
							<span><?php echo esc_html( $faq['question'] ); ?></span>
						</div>
						<svg class="ns-accordion-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
							<polyline points="6 9 12 15 18 9"/>
						</svg>
					</button>
					<div id="faq-item-<?php echo esc_attr( $index ); ?>" class="ns-accordion-body" <?php echo 0 === $index ? '' : 'hidden'; ?>>
						<p style="margin-bottom: 0;"><?php echo esc_html( $faq['answer'] ); ?></p>
					</div>
				</div>
			<?php endforeach; ?>
		</div>

		<!-- Still have questions block -->
		<div style="text-align: center; margin-top: var(--ns-space-12); padding: var(--ns-space-8); background-color: var(--ns-color-white); border: 1px solid var(--ns-color-border); border-radius: var(--ns-radius-sm);">
			<h3 style="font-size: 1.4rem; margin-bottom: var(--ns-space-3);"><?php esc_html_e( 'Have a Specific Project Question?', 'northstar-renovation' ); ?></h3>
			<p style="color: var(--ns-color-muted); font-size: 0.9375rem; max-width: 50ch; margin-left: auto; margin-right: auto; margin-bottom: var(--ns-space-4);">
				<?php esc_html_e( 'Every residence possesses unique architectural constraints. Contact our studio for direct answers regarding your property.', 'northstar-renovation' ); ?>
			</p>
			<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="ns-btn ns-btn-primary">
				<?php esc_html_e( 'Contact Our Architectural Team', 'northstar-renovation' ); ?> &rarr;
			</a>
		</div>
	</div>
</section>

<?php
get_footer();
