<?php
/**
 * Template Name: Portfolio
 *
 * Project Portfolio with accessible client-side category filtering.
 *
 * @package NorthstarRenovation
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

$projects = function_exists( 'northstar_get_demo_projects' ) ? northstar_get_demo_projects() : array();
?>

<!-- Portfolio Page Banner -->
<section class="ns-section ns-section-dark" style="padding-top: var(--ns-space-16); padding-bottom: var(--ns-space-16);">
	<div class="ns-container text-center" style="max-width: 840px; margin-left: auto; margin-right: auto; text-align: center;">
		<span class="ns-section-eyebrow" style="color: var(--ns-color-stone);">
			<?php esc_html_e( 'Architectural Case Studies', 'northstar-renovation' ); ?>
		</span>
		<h1 style="color: var(--ns-color-ivory); margin-bottom: var(--ns-space-4);">
			<?php esc_html_e( 'Residential Project Portfolio', 'northstar-renovation' ); ?>
		</h1>
		<p style="color: var(--ns-color-stone); font-size: 1.15rem; margin-left: auto; margin-right: auto; margin-bottom: var(--ns-space-6);">
			<?php esc_html_e( 'Explore recent transformations across historic villas, modern penthouses, and bespoke culinary additions.', 'northstar-renovation' ); ?>
		</p>
		<div style="display: inline-block; background-color: rgba(247, 245, 239, 0.1); border: 1px solid rgba(217, 211, 199, 0.3); padding: var(--ns-space-2) var(--ns-space-4); border-radius: var(--ns-radius-sm); font-size: 0.8125rem; color: var(--ns-color-stone);">
			<strong><?php esc_html_e( 'Demonstration Notice:', 'northstar-renovation' ); ?></strong> <?php esc_html_e( 'All featured projects represent demonstration design-build scenarios for portfolio review.', 'northstar-renovation' ); ?>
		</div>
	</div>
</section>

<!-- Portfolio Gallery & Filter -->
<section class="ns-section" aria-label="<?php esc_attr_e( 'Project Portfolio Gallery', 'northstar-renovation' ); ?>">
	<div class="ns-container">
		<!-- Accessible Category Tablist Filter -->
		<div class="ns-portfolio-filter" role="tablist" aria-label="<?php esc_attr_e( 'Filter projects by renovation category', 'northstar-renovation' ); ?>">
			<button type="button" class="ns-filter-btn is-active" role="tab" aria-selected="true" data-filter="all">
				<?php esc_html_e( 'All Case Studies', 'northstar-renovation' ); ?>
			</button>
			<button type="button" class="ns-filter-btn" role="tab" aria-selected="false" data-filter="whole-home">
				<?php esc_html_e( 'Whole-Home', 'northstar-renovation' ); ?>
			</button>
			<button type="button" class="ns-filter-btn" role="tab" aria-selected="false" data-filter="kitchen">
				<?php esc_html_e( 'Kitchens', 'northstar-renovation' ); ?>
			</button>
			<button type="button" class="ns-filter-btn" role="tab" aria-selected="false" data-filter="bathroom">
				<?php esc_html_e( 'Bathrooms', 'northstar-renovation' ); ?>
			</button>
			<button type="button" class="ns-filter-btn" role="tab" aria-selected="false" data-filter="interior">
				<?php esc_html_e( 'Interior Architecture', 'northstar-renovation' ); ?>
			</button>
			<button type="button" class="ns-filter-btn" role="tab" aria-selected="false" data-filter="flooring">
				<?php esc_html_e( 'Flooring & Millwork', 'northstar-renovation' ); ?>
			</button>
		</div>

		<!-- Project Grid (Full zero-JS accessible cards) -->
		<div class="ns-grid-3" id="portfolio-grid">
			<?php
			foreach ( $projects as $project ) {
				get_template_part( 'template-parts/project-card', null, array( 'project' => $project ) );
			}
			?>
		</div>
	</div>
</section>

<!-- Individual Project Spotlight Case Studies -->
<section class="ns-section" style="background-color: var(--ns-color-white);" aria-labelledby="spotlight-heading">
	<div class="ns-container">
		<div class="ns-section-header">
			<span class="ns-section-eyebrow"><?php esc_html_e( 'Deep-Dive Case Study', 'northstar-renovation' ); ?></span>
			<h2 id="spotlight-heading"><?php esc_html_e( 'Inside The Kensington Heritage Villa', 'northstar-renovation' ); ?></h2>
			<p style="color: var(--ns-color-muted); font-size: 1.1rem; max-width: 65ch;">
				<?php esc_html_e( 'An in-depth look at how our integrated architecture and master-build team solved structural masonry degradation while introducing a contemporary sun-drenched culinary wing.', 'northstar-renovation' ); ?>
			</p>
		</div>

		<div class="ns-grid-2" style="align-items: center; margin-bottom: var(--ns-space-10);">
			<div>
				<div style="aspect-ratio: 16/10; border-radius: var(--ns-radius-sm); overflow: hidden; border: 1px solid var(--ns-color-border);">
					<img src="<?php echo esc_url( NORTHSTAR_URI . '/assets/images/project-1.svg' ); ?>" alt="<?php esc_attr_e( 'Kensington Heritage Villa Case Study', 'northstar-renovation' ); ?>" loading="lazy" width="800" height="500" style="width: 100%; height: 100%; object-fit: cover;">
				</div>
			</div>

			<div>
				<h3 style="font-size: 1.6rem; margin-bottom: var(--ns-space-3);"><?php esc_html_e( 'Architectural Challenge & Structural Solution', 'northstar-renovation' ); ?></h3>
				<p style="color: var(--ns-color-muted); font-size: 0.95rem; margin-bottom: var(--ns-space-4);">
					<?php esc_html_e( 'The 1912 residence suffered from multiple compartmentalized rooms and fractured load-bearing brick walls. The homeowner sought an expansive open-concept living pavilion without sacrificing the exterior heritage facade.', 'northstar-renovation' ); ?>
				</p>

				<h4 style="font-size: 1rem; color: var(--ns-color-forest); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: var(--ns-space-2);">
					<?php esc_html_e( 'Project Highlights:', 'northstar-renovation' ); ?>
				</h4>
				<ul style="list-style: none; margin-bottom: var(--ns-space-6);">
					<li style="margin-bottom: var(--ns-space-2); font-size: 0.9375rem;"><strong><?php esc_html_e( 'Structural Engineering:', 'northstar-renovation' ); ?></strong> Insertion of a 38-foot structural steel flitch beam.</li>
					<li style="margin-bottom: var(--ns-space-2); font-size: 0.9375rem;"><strong><?php esc_html_e( 'Building Envelope:', 'northstar-renovation' ); ?></strong> Continuous internal vapor-permeable insulation layer.</li>
					<li style="margin-bottom: var(--ns-space-2); font-size: 0.9375rem;"><strong><?php esc_html_e( 'Artisan Joinery:', 'northstar-renovation' ); ?></strong> Wire-brushed white oak cabinetry with integrated zero-reveal pulls.</li>
				</ul>

				<a href="<?php echo esc_url( home_url( '/contact/?project=kensington-heritage' ) ); ?>" class="ns-btn ns-btn-primary">
					<?php esc_html_e( 'Inquire About Similar Heritage Renovations', 'northstar-renovation' ); ?> &rarr;
				</a>
			</div>
		</div>
	</div>
</section>

<?php
get_template_part( 'template-parts/cta-section' );
get_footer();
