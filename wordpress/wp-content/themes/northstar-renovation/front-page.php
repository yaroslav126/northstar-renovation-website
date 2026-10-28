<?php
/**
 * Front Page template for Northstar Renovation.
 *
 * Implements all 15 required homepage sections with architectural precision.
 *
 * @package NorthstarRenovation
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

// Fetch Services, Projects, FAQs
$services     = function_exists( 'northstar_get_demo_services' ) ? northstar_get_demo_services() : array();
$projects     = function_exists( 'northstar_get_demo_projects' ) ? northstar_get_demo_projects() : array();
$faqs         = function_exists( 'northstar_get_demo_faqs' ) ? array_slice( northstar_get_demo_faqs(), 0, 4 ) : array();

// Section 2: Prominent Visual Hero Section (includes Primary CTA, Secondary CTA, & Trust Bar)
get_template_part( 'template-parts/hero' );
?>

<!-- Section 3 & 4: Value Proposition & Company Introduction -->
<section class="ns-section" aria-labelledby="intro-heading">
	<div class="ns-container">
		<div class="ns-grid-2" style="align-items: center;">
			<div>
				<span class="ns-section-eyebrow">
					<?php esc_html_e( 'Our Architectural Ethos', 'northstar-renovation' ); ?>
				</span>
				<h2 id="intro-heading" style="margin-bottom: var(--ns-space-6);">
					<?php esc_html_e( 'Built With Intention. Finished With Reverence.', 'northstar-renovation' ); ?>
				</h2>
				<p class="ns-lead" style="margin-bottom: var(--ns-space-4);">
					<?php esc_html_e( 'Northstar Renovation operates at the intersection of architectural discipline and fine craftsmanship. We reject chaotic job sites, vague allowances, and standard builder-grade finishes in favor of rigorous pre-construction planning.', 'northstar-renovation' ); ?>
				</p>
				<p style="color: var(--ns-color-muted); margin-bottom: var(--ns-space-6);">
					<?php esc_html_e( 'Founded by licensed architects and master builders, our integrated design-build methodology guarantees that the team drawing your structural blueprints is the very team executing your joinery on site. No finger-pointing. No surprises.', 'northstar-renovation' ); ?>
				</p>
				<div style="display: flex; gap: var(--ns-space-4); align-items: center;">
					<a href="<?php echo esc_url( home_url( '/about/' ) ); ?>" class="ns-btn ns-btn-primary">
						<?php esc_html_e( 'Learn About Our Studio', 'northstar-renovation' ); ?> &rarr;
					</a>
					<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="ns-btn ns-btn-secondary">
						<?php esc_html_e( 'Book Consultation', 'northstar-renovation' ); ?>
					</a>
				</div>
			</div>

			<div class="ns-ethos-visual">
				<div class="ns-ethos-frame">
					<img src="<?php echo esc_url( NORTHSTAR_URI . '/assets/images/service-wholehome.jpg' ); ?>" alt="<?php esc_attr_e( 'Architectural whole home renovation craftsmanship', 'northstar-renovation' ); ?>" loading="lazy" width="1376" height="768">
				</div>
				<div class="ns-ethos-badge">
					<span class="ns-ethos-badge-number">100%</span>
					<span class="ns-ethos-badge-label"><?php esc_html_e( 'Fixed-Price Accountability', 'northstar-renovation' ); ?></span>
				</div>
			</div>
		</div>

	</div>
</section>

<!-- Section 7: Services Overview -->
<section class="ns-section" aria-labelledby="services-heading" style="background-color: var(--ns-color-white);">
	<div class="ns-container">
		<div class="ns-section-header text-center">
			<span class="ns-section-eyebrow"><?php esc_html_e( 'Core Capabilities', 'northstar-renovation' ); ?></span>
			<h2 id="services-heading"><?php esc_html_e( 'Architectural Renovation Disciplines', 'northstar-renovation' ); ?></h2>
			<p style="color: var(--ns-color-muted); font-size: 1.1rem; max-width: 60ch;">
				<?php esc_html_e( 'From focal kitchen transformations to comprehensive whole-home spatial renewals, our studio executes every trade under dedicated architectural oversight.', 'northstar-renovation' ); ?>
			</p>
		</div>

		<div class="ns-grid-3">
			<?php
			foreach ( array_slice( $services, 0, 3 ) as $service ) {
				get_template_part( 'template-parts/service-card', null, array( 'service' => $service ) );
			}
			?>
		</div>

		<div style="text-align: center; margin-top: var(--ns-space-10);">
			<a href="<?php echo esc_url( home_url( '/services/' ) ); ?>" class="ns-btn ns-btn-secondary">
				<?php esc_html_e( 'View All 5 Specialized Services', 'northstar-renovation' ); ?> &rarr;
			</a>
		</div>
	</div>
</section>

<!-- Section 8: Featured Renovation Projects -->
<section class="ns-section" aria-labelledby="portfolio-heading">
	<div class="ns-container">
		<div class="ns-section-header" style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: var(--ns-space-10); flex-wrap: wrap; gap: var(--ns-space-4);">
			<div>
				<span class="ns-section-eyebrow"><?php esc_html_e( 'Selected Work', 'northstar-renovation' ); ?></span>
				<h2 id="portfolio-heading" style="margin-bottom: 0;"><?php esc_html_e( 'Recent Architectural Case Studies', 'northstar-renovation' ); ?></h2>
			</div>
			<a href="<?php echo esc_url( home_url( '/portfolio/' ) ); ?>" class="ns-btn ns-btn-primary">
				<?php esc_html_e( 'Explore All Projects', 'northstar-renovation' ); ?> &rarr;
			</a>
		</div>

		<div class="ns-grid-3">
			<?php
			foreach ( array_slice( $projects, 0, 3 ) as $project ) {
				get_template_part( 'template-parts/project-card', null, array( 'project' => $project ) );
			}
			?>
		</div>
	</div>
</section>

<!-- Section 9: Company Differentiators -->
<section class="ns-section" aria-labelledby="diff-heading" style="background-color: var(--ns-color-stone-light);">
	<div class="ns-container">
		<div class="ns-section-header text-center">
			<span class="ns-section-eyebrow"><?php esc_html_e( 'Why Northstar', 'northstar-renovation' ); ?></span>
			<h2 id="diff-heading"><?php esc_html_e( 'Four Pillars of Architectural Stewardship', 'northstar-renovation' ); ?></h2>
			<p style="color: var(--ns-color-muted); font-size: 1.1rem; max-width: 60ch;">
				<?php esc_html_e( 'We engineered our practice to eradicate the four primary pain points homeowners experience during major renovations.', 'northstar-renovation' ); ?>
			</p>
		</div>

		<div class="ns-grid-4">
			<div class="ns-diff-card">
				<svg class="ns-diff-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
					<path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/>
				</svg>
				<h3 class="ns-diff-title"><?php esc_html_e( 'Fixed-Price Contracts', 'northstar-renovation' ); ?></h3>
				<p class="ns-diff-desc">
					<?php esc_html_e( 'Detailed line-item pricing with zero hidden allowances. We lock in procurement costs prior to construction commencement.', 'northstar-renovation' ); ?>
				</p>
			</div>

			<div class="ns-diff-card">
				<svg class="ns-diff-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
					<path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>
				</svg>
				<h3 class="ns-diff-title"><?php esc_html_e( 'Dedicated Director', 'northstar-renovation' ); ?></h3>
				<p class="ns-diff-desc">
					<?php esc_html_e( 'One single experienced project director coordinates your schedule, inspections, and trade craftsman on site daily.', 'northstar-renovation' ); ?>
				</p>
			</div>

			<div class="ns-diff-card">
				<svg class="ns-diff-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
					<path d="m18 15-6-6-6 6"/>
				</svg>
				<h3 class="ns-diff-title"><?php esc_html_e( 'Master Trades Only', 'northstar-renovation' ); ?></h3>
				<p class="ns-diff-desc">
					<?php esc_html_e( 'We do not subcontract to lowest bidders. Our carpentry, tiling, and millwork teams are dedicated, vetted artisan specialists.', 'northstar-renovation' ); ?>
				</p>
			</div>

			<div class="ns-diff-card">
				<svg class="ns-diff-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
					<path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
				</svg>
				<h3 class="ns-diff-title"><?php esc_html_e( '3-Year Warranty', 'northstar-renovation' ); ?></h3>
				<p class="ns-diff-desc">
					<?php esc_html_e( 'Comprehensive 3-year craftsmanship warranty with scheduled 6-month and 12-month proactive checkups post-handover.', 'northstar-renovation' ); ?>
				</p>
			</div>
		</div>
	</div>
</section>

<!-- Section 10: Renovation Process (Sequential Stepped Sequence) -->
<section class="ns-section" aria-labelledby="process-heading">
	<div class="ns-container">
		<div class="ns-section-header text-center">
			<span class="ns-section-eyebrow"><?php esc_html_e( 'Predictable Milestones', 'northstar-renovation' ); ?></span>
			<h2 id="process-heading"><?php esc_html_e( 'Our 5-Phase Renovation Methodology', 'northstar-renovation' ); ?></h2>
			<p style="color: var(--ns-color-muted); font-size: 1.1rem; max-width: 60ch;">
				<?php esc_html_e( 'Every project advances through a disciplined architectural sequence designed to safeguard budget, schedule, and craftsmanship.', 'northstar-renovation' ); ?>
			</p>
		</div>

		<div class="ns-process-grid">
			<div class="ns-process-step">
				<div class="ns-process-num">01</div>
				<h3 class="ns-process-title"><?php esc_html_e( 'Site Consultation', 'northstar-renovation' ); ?></h3>
				<p class="ns-process-desc"><?php esc_html_e( 'In-depth 90-minute spatial assessment, structural feasibility review, and preliminary budget modeling.', 'northstar-renovation' ); ?></p>
			</div>

			<div class="ns-process-step">
				<div class="ns-process-num">02</div>
				<h3 class="ns-process-title"><?php esc_html_e( 'Design & Materials', 'northstar-renovation' ); ?></h3>
				<p class="ns-process-desc"><?php esc_html_e( 'Architectural elevations, 3D renderings, and hands-on material curation (stone, timber, metal finishes).', 'northstar-renovation' ); ?></p>
			</div>

			<div class="ns-process-step">
				<div class="ns-process-num">03</div>
				<h3 class="ns-process-title"><?php esc_html_e( 'Fixed Proposal', 'northstar-renovation' ); ?></h3>
				<p class="ns-process-desc"><?php esc_html_e( 'Binding line-item budget, detailed schedule calendar, and permit submission packages.', 'northstar-renovation' ); ?></p>
			</div>

			<div class="ns-process-step">
				<div class="ns-process-num">04</div>
				<h3 class="ns-process-title"><?php esc_html_e( 'Master Build', 'northstar-renovation' ); ?></h3>
				<p class="ns-process-desc"><?php esc_html_e( 'Clean jobsite execution, dust containment, weekly client video updates, and precision trade craft.', 'northstar-renovation' ); ?></p>
			</div>

			<div class="ns-process-step">
				<div class="ns-process-num">05</div>
				<h3 class="ns-process-title"><?php esc_html_e( 'Handover & Care', 'northstar-renovation' ); ?></h3>
				<p class="ns-process-desc"><?php esc_html_e( 'White-glove deep clean, walkthrough inspection binder, and activation of our 3-year warranty.', 'northstar-renovation' ); ?></p>
			</div>
		</div>
	</div>
</section>

<!-- Section 11: Service Area Section -->
<section class="ns-section" aria-labelledby="service-area-heading">
	<div class="ns-container">
		<div class="ns-grid-2" style="align-items: center;">
			<div>
				<span class="ns-section-eyebrow"><?php esc_html_e( 'Coverage & Heritage Homes', 'northstar-renovation' ); ?></span>
				<h2 id="service-area-heading"><?php esc_html_e( 'Dedicated Residential Service Areas', 'northstar-renovation' ); ?></h2>
				<p class="ns-lead">
					<?php esc_html_e( 'We actively serve historic and prestige neighborhoods throughout the metropolitan corridor.', 'northstar-renovation' ); ?>
				</p>
				<p style="color: var(--ns-color-muted); margin-bottom: var(--ns-space-6);">
					<?php esc_html_e( 'Our team possesses specialized experience navigating heritage conservation boards, Victorian and Edwardian masonry stabilization, and zoning approvals across premier enclaves.', 'northstar-renovation' ); ?>
				</p>

				<ul style="list-style: none; display: grid; grid-template-columns: repeat(2, 1fr); gap: var(--ns-space-3); margin-bottom: var(--ns-space-6);">
					<li style="display: flex; align-items: center; gap: var(--ns-space-2); font-weight: 600;">
						<span style="color: var(--ns-color-terracotta);">&bull;</span> Kensington Gardens
					</li>
					<li style="display: flex; align-items: center; gap: var(--ns-space-2); font-weight: 600;">
						<span style="color: var(--ns-color-terracotta);">&bull;</span> Forest Hill
					</li>
					<li style="display: flex; align-items: center; gap: var(--ns-space-2); font-weight: 600;">
						<span style="color: var(--ns-color-terracotta);">&bull;</span> Rosedale & Summerhill
					</li>
					<li style="display: flex; align-items: center; gap: var(--ns-space-2); font-weight: 600;">
						<span style="color: var(--ns-color-terracotta);">&bull;</span> St. Clair West & Wychwood
					</li>
					<li style="display: flex; align-items: center; gap: var(--ns-space-2); font-weight: 600;">
						<span style="color: var(--ns-color-terracotta);">&bull;</span> Yorkville & The Annex
					</li>
					<li style="display: flex; align-items: center; gap: var(--ns-space-2); font-weight: 600;">
						<span style="color: var(--ns-color-terracotta);">&bull;</span> Oakridge Estates
					</li>
				</ul>

				<p style="font-size: 0.875rem; color: var(--ns-color-muted);">
					<em><?php esc_html_e( 'Note: Neighborhood names represent demonstration service zones for portfolio illustration.', 'northstar-renovation' ); ?></em>
				</p>
			</div>

			<div style="background-color: var(--ns-color-forest); color: var(--ns-color-ivory); padding: var(--ns-space-8); border-radius: var(--ns-radius-sm); border: 1px solid var(--ns-color-stone);">
				<h3 style="color: var(--ns-color-ivory); margin-bottom: var(--ns-space-3);"><?php esc_html_e( 'Planning a Project in Your Area?', 'northstar-renovation' ); ?></h3>
				<p style="color: var(--ns-color-stone); font-size: 0.9375rem; margin-bottom: var(--ns-space-6);">
					<?php esc_html_e( 'We offer complimentary preliminary municipal zoning and permit feasibility reviews during our initial site walkthrough.', 'northstar-renovation' ); ?>
				</p>
				<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="ns-btn ns-btn-terracotta" style="width: 100%;">
					<?php esc_html_e( 'Check Your Neighborhood Feasibility', 'northstar-renovation' ); ?> &rarr;
				</a>
			</div>
		</div>
	</div>
</section>

<!-- Section 13: Frequently Asked Questions -->
<section class="ns-section" aria-labelledby="faq-heading" style="background-color: var(--ns-color-white);">
	<div class="ns-container ns-container-narrow">
		<div class="ns-section-header text-center">
			<span class="ns-section-eyebrow"><?php esc_html_e( 'Clarity & Transparency', 'northstar-renovation' ); ?></span>
			<h2 id="faq-heading"><?php esc_html_e( 'Frequently Asked Questions', 'northstar-renovation' ); ?></h2>
			<p style="color: var(--ns-color-muted); font-size: 1.1rem;">
				<?php esc_html_e( 'Straightforward answers regarding our contracts, timelines, and construction logistics.', 'northstar-renovation' ); ?>
			</p>
		</div>

		<div class="ns-faq-list" role="region" aria-label="<?php esc_attr_e( 'Frequently Asked Questions Accordion', 'northstar-renovation' ); ?>">
			<?php foreach ( $faqs as $index => $faq ) : ?>
				<div class="ns-accordion-item">
					<button type="button" class="ns-accordion-header" aria-expanded="<?php echo 0 === $index ? 'true' : 'false'; ?>" aria-controls="faq-ans-<?php echo esc_attr( $index ); ?>">
						<span><?php echo esc_html( $faq['question'] ); ?></span>
						<svg class="ns-accordion-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
							<polyline points="6 9 12 15 18 9"/>
						</svg>
					</button>
					<div id="faq-ans-<?php echo esc_attr( $index ); ?>" class="ns-accordion-body" <?php echo 0 === $index ? '' : 'hidden'; ?>>
						<p style="margin-bottom: 0;"><?php echo esc_html( $faq['answer'] ); ?></p>
					</div>
				</div>
			<?php endforeach; ?>
		</div>

		<div style="text-align: center; margin-top: var(--ns-space-8);">
			<a href="<?php echo esc_url( home_url( '/faq/' ) ); ?>" class="ns-btn ns-btn-secondary">
				<?php esc_html_e( 'View All FAQ Categories', 'northstar-renovation' ); ?> &rarr;
			</a>
		</div>
	</div>
</section>

<!-- Section 14: Final Conversion Section -->
<?php get_template_part( 'template-parts/cta-section' ); ?>

<?php
// Section 15: Comprehensive Footer
get_footer();
