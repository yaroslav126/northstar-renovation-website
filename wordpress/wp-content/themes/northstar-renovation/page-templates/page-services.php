<?php
/**
 * Template Name: Services
 *
 * Comprehensive architectural services overview.
 *
 * @package NorthstarRenovation
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

$services = function_exists( 'northstar_get_demo_services' ) ? northstar_get_demo_services() : array();
?>

<!-- Services Page Banner -->
<section class="ns-section ns-section-dark" style="padding-top: var(--ns-space-16); padding-bottom: var(--ns-space-16);">
	<div class="ns-container text-center" style="max-width: 840px; margin-left: auto; margin-right: auto; text-align: center;">
		<span class="ns-section-eyebrow" style="color: var(--ns-color-stone);">
			<?php esc_html_e( 'Architectural Disciplines', 'northstar-renovation' ); ?>
		</span>
		<h1 style="color: var(--ns-color-ivory); margin-bottom: var(--ns-space-4);">
			<?php esc_html_e( 'Bespoke Residential Renovation Services', 'northstar-renovation' ); ?>
		</h1>
		<p style="color: var(--ns-color-stone); font-size: 1.15rem; margin-left: auto; margin-right: auto;">
			<?php esc_html_e( 'Every project is managed with fixed-price accountability, dedicated on-site leadership, and uncompromising attention to architectural detail.', 'northstar-renovation' ); ?>
		</p>
	</div>
</section>

<!-- Detailed Service Sections -->
<section class="ns-section" aria-label="<?php esc_attr_e( 'Detailed Services Listing', 'northstar-renovation' ); ?>">
	<div class="ns-container">
		<?php foreach ( $services as $idx => $serv ) : 
			$is_even = 0 === ( $idx % 2 );
		?>
			<div id="<?php echo esc_attr( $serv['slug'] ); ?>" class="ns-service-detail-block" style="margin-bottom: var(--ns-space-16); padding-bottom: var(--ns-space-12); border-bottom: 1px solid var(--ns-color-border);">
				<div class="ns-grid-2" style="align-items: center; <?php echo ! $is_even ? 'direction: rtl;' : ''; ?>">
					<!-- Media -->
					<div style="direction: ltr;">
						<div style="aspect-ratio: 16/10; border-radius: var(--ns-radius-sm); overflow: hidden; border: 1px solid var(--ns-color-border); box-shadow: var(--ns-shadow-card);">
							<img src="<?php echo esc_url( $serv['image'] ); ?>" alt="<?php echo esc_attr( $serv['title'] ); ?>" loading="lazy" width="800" height="500" style="width: 100%; height: 100%; object-fit: cover;">
						</div>
					</div>

					<!-- Content -->
					<div style="direction: ltr;">
						<div style="display: flex; align-items: center; gap: var(--ns-space-3); margin-bottom: var(--ns-space-3);">
							<img src="<?php echo esc_url( $serv['icon'] ); ?>" alt="" class="ns-service-icon" width="32" height="32" aria-hidden="true">
							<span style="font-size: 0.8125rem; font-weight: 700; color: var(--ns-color-terracotta); text-transform: uppercase; letter-spacing: 0.1em;">
								<?php echo esc_html( $serv['tagline'] ); ?>
							</span>
						</div>

						<h2 style="font-size: 2.2rem; margin-bottom: var(--ns-space-4);">
							<?php echo esc_html( $serv['title'] ); ?>
						</h2>

						<p class="ns-lead" style="margin-bottom: var(--ns-space-4);">
							<?php echo esc_html( $serv['description'] ); ?>
						</p>

						<h4 style="font-size: 1rem; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: var(--ns-space-3); color: var(--ns-color-forest);">
							<?php esc_html_e( 'Key Deliverables & Specifications:', 'northstar-renovation' ); ?>
						</h4>

						<ul style="list-style: none; margin-bottom: var(--ns-space-6);">
							<?php foreach ( $serv['deliverables'] as $item ) : ?>
								<li style="display: flex; align-items: baseline; gap: var(--ns-space-2); margin-bottom: var(--ns-space-2); font-size: 0.9375rem;">
									<span style="color: var(--ns-color-terracotta); font-weight: bold;">✓</span>
									<?php echo esc_html( $item ); ?>
								</li>
							<?php endforeach; ?>
						</ul>

						<div style="background-color: var(--ns-color-white); border: 1px solid var(--ns-color-border); padding: var(--ns-space-4); border-radius: var(--ns-radius-sm); margin-bottom: var(--ns-space-6); display: flex; justify-content: space-between; flex-wrap: wrap; gap: var(--ns-space-4);">
							<div>
								<span style="display: block; font-size: 0.75rem; text-transform: uppercase; color: var(--ns-color-muted);"><?php esc_html_e( 'Typical Construction Window', 'northstar-renovation' ); ?></span>
								<strong style="font-size: 0.9375rem; color: var(--ns-color-forest);"><?php echo esc_html( $serv['timeline'] ); ?></strong>
							</div>
							<div>
								<span style="display: block; font-size: 0.75rem; text-transform: uppercase; color: var(--ns-color-muted);"><?php esc_html_e( 'Investment Baseline', 'northstar-renovation' ); ?></span>
								<strong style="font-size: 0.9375rem; color: var(--ns-color-forest);"><?php echo esc_html( $serv['investment'] ); ?></strong>
							</div>
						</div>

						<a href="<?php echo esc_url( home_url( '/contact/?service=' . $serv['slug'] ) ); ?>" class="ns-btn ns-btn-primary">
							<?php printf( esc_html__( 'Inquire About %s', 'northstar-renovation' ), esc_html( $serv['title'] ) ); ?> &rarr;
						</a>
					</div>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
</section>

<?php
get_template_part( 'template-parts/cta-section' );
get_footer();
