<?php
/**
 * Template Name: About
 *
 * About Northstar Renovation, architectural philosophy, and demonstration team.
 *
 * @package NorthstarRenovation
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

$team = function_exists( 'northstar_get_demo_team' ) ? northstar_get_demo_team() : array();
?>

<!-- About Page Banner -->
<section class="ns-section ns-section-dark" style="padding-top: var(--ns-space-16); padding-bottom: var(--ns-space-16);">
	<div class="ns-container text-center" style="max-width: 840px; margin-left: auto; margin-right: auto; text-align: center;">
		<span class="ns-section-eyebrow" style="color: var(--ns-color-stone);">
			<?php esc_html_e( 'Our Architectural Practice', 'northstar-renovation' ); ?>
		</span>
		<h1 style="color: var(--ns-color-ivory); margin-bottom: var(--ns-space-4);">
			<?php esc_html_e( 'Architectural Discipline Meets Fine Building Craft', 'northstar-renovation' ); ?>
		</h1>
		<p style="color: var(--ns-color-stone); font-size: 1.15rem; margin-left: auto; margin-right: auto;">
			<?php esc_html_e( 'Northstar was founded on a simple conviction: premium residential renovation requires the rigor of an architecture studio combined with the master craft of seasoned builders.', 'northstar-renovation' ); ?>
		</p>
	</div>
</section>

<!-- Company History & Renovation Philosophy -->
<section class="ns-section" aria-labelledby="philosophy-heading">
	<div class="ns-container">
		<div class="ns-grid-2" style="align-items: center; margin-bottom: var(--ns-space-16);">
			<div>
				<span class="ns-section-eyebrow"><?php esc_html_e( 'Philosophy & Values', 'northstar-renovation' ); ?></span>
				<h2 id="philosophy-heading"><?php esc_html_e( 'Built with Intention, Finished with Reverence', 'northstar-renovation' ); ?></h2>
				<p class="ns-lead">
					<?php esc_html_e( 'Traditional construction often separates the architects who design a home from the contractors who swing the hammers. That friction leads to delays, cost overruns, and compromised finishes.', 'northstar-renovation' ); ?>
				</p>
				<p style="color: var(--ns-color-muted); margin-bottom: var(--ns-space-4);">
					<?php esc_html_e( 'At Northstar, our architects and construction supervisors work under the same roof. From structural beam sizing and heating load calculations to the hand-honed oil finish on a stair tread, every detail is engineered as an integrated whole.', 'northstar-renovation' ); ?>
				</p>
				<p style="color: var(--ns-color-muted);">
					<?php esc_html_e( 'We honor honest materials: genuine lime plaster that breathes, wide-plank oak that gains character over decades, solid unlacquered brass that patinas gracefully, and natural quarried stone.', 'northstar-renovation' ); ?>
				</p>
			</div>

			<div>
				<div style="aspect-ratio: 4/3; border-radius: var(--ns-radius-sm); overflow: hidden; border: 1px solid var(--ns-color-border); box-shadow: var(--ns-shadow-card);">
					<img src="<?php echo esc_url( NORTHSTAR_URI . '/assets/images/service-interior.svg' ); ?>" alt="<?php esc_attr_e( 'Architectural interior craftsmanship and joinery', 'northstar-renovation' ); ?>" loading="lazy" width="800" height="600" style="width: 100%; height: 100%; object-fit: cover;">
				</div>
			</div>
		</div>

		<!-- Core Values Grid -->
		<div class="ns-grid-3">
			<div class="ns-diff-card">
				<h3 style="font-size: 1.35rem; margin-bottom: var(--ns-space-2);"><?php esc_html_e( 'Material Honesty', 'northstar-renovation' ); ?></h3>
				<p style="font-size: 0.9375rem; color: var(--ns-color-muted);">
					<?php esc_html_e( 'We prioritize enduring, non-toxic, authentic architectural materials over ephemeral imitation surfaces. If it looks like stone or timber, it is stone or timber.', 'northstar-renovation' ); ?>
				</p>
			</div>

			<div class="ns-diff-card">
				<h3 style="font-size: 1.35rem; margin-bottom: var(--ns-space-2);"><?php esc_html_e( 'Financial Transparency', 'northstar-renovation' ); ?></h3>
				<p style="font-size: 0.9375rem; color: var(--ns-color-muted);">
					<?php esc_html_e( 'Every square inch of your project is accounted for in a fixed-price agreement before we touch a hammer. No artificial allowances, no bait-and-switch quotes.', 'northstar-renovation' ); ?>
				</p>
			</div>

			<div class="ns-diff-card">
				<h3 style="font-size: 1.35rem; margin-bottom: var(--ns-space-2);"><?php esc_html_e( 'Single Accountability', 'northstar-renovation' ); ?></h3>
				<p style="font-size: 0.9375rem; color: var(--ns-color-muted);">
					<?php esc_html_e( 'One dedicated Project Director manages permits, architectural revisions, daily jobsite cleanliness, and trade coordination from start to final key handover.', 'northstar-renovation' ); ?>
				</p>
			</div>
		</div>
	</div>
</section>

<!-- Fictional Demonstration Team -->
<section class="ns-section" aria-labelledby="team-heading" style="background-color: var(--ns-color-white);">
	<div class="ns-container">
		<div class="ns-section-header text-center">
			<span class="ns-section-eyebrow"><?php esc_html_e( 'Studio Leadership', 'northstar-renovation' ); ?></span>
			<h2 id="team-heading"><?php esc_html_e( 'Our Architectural & Construction Directors', 'northstar-renovation' ); ?></h2>
			<p style="color: var(--ns-color-muted); font-size: 1.1rem; max-width: 60ch;">
				<?php esc_html_e( 'A collaborative leadership team uniting architectural registered design with master building craft.', 'northstar-renovation' ); ?>
			</p>
			<div style="display: inline-block; background-color: #ECEAE4; color: #6C706D; padding: 0.25rem 0.75rem; border-radius: 3px; font-size: 0.75rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em; margin-top: var(--ns-space-3);">
				<?php esc_html_e( 'Demonstration Personnel — For Portfolio Illustration', 'northstar-renovation' ); ?>
			</div>
		</div>

		<div class="ns-grid-4">
			<?php foreach ( $team as $member ) : ?>
				<div class="ns-service-card" style="text-align: center;">
					<div style="aspect-ratio: 1/1; overflow: hidden; background-color: var(--ns-color-stone-light);">
						<img src="<?php echo esc_url( $member['image'] ); ?>" alt="<?php echo esc_attr( $member['name'] ); ?>" loading="lazy" width="600" height="600" style="width: 100%; height: 100%; object-fit: cover;">
					</div>
					<div style="padding: var(--ns-space-5);">
						<h3 style="font-size: 1.25rem; margin-bottom: 0.25rem;"><?php echo esc_html( $member['name'] ); ?></h3>
						<span style="font-size: 0.8125rem; font-weight: 600; color: var(--ns-color-terracotta); display: block; margin-bottom: var(--ns-space-3);">
							<?php echo esc_html( $member['role'] ); ?>
						</span>
						<p style="font-size: 0.875rem; color: var(--ns-color-muted); margin-bottom: 0;">
							<?php echo esc_html( $member['bio'] ); ?>
						</p>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<?php
get_template_part( 'template-parts/cta-section' );
get_footer();
