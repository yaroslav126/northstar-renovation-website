<?php
/**
 * 404 Error Template for Northstar Renovation.
 *
 * @package NorthstarRenovation
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<section class="ns-section ns-section-dark" style="padding-top: var(--ns-space-20); padding-bottom: var(--ns-space-20);">
	<div class="ns-container text-center" style="max-width: 760px; margin-left: auto; margin-right: auto; text-align: center;">
		<span class="ns-section-eyebrow" style="color: var(--ns-color-terracotta);">
			<?php esc_html_e( 'Error 404 &bull; Missing Specification', 'northstar-renovation' ); ?>
		</span>

		<h1 style="color: var(--ns-color-ivory); font-size: clamp(2.5rem, 6vw, 4rem); margin-bottom: var(--ns-space-4);">
			<?php esc_html_e( 'The Blueprint Could Not Be Located', 'northstar-renovation' ); ?>
		</h1>

		<p style="color: var(--ns-color-stone); font-size: 1.15rem; margin-bottom: var(--ns-space-8); margin-left: auto; margin-right: auto;">
			<?php esc_html_e( 'The architectural page or resource you requested may have been relocated, re-indexed, or removed during our site transformation.', 'northstar-renovation' ); ?>
		</p>

		<div style="display: flex; justify-content: center; flex-wrap: wrap; gap: var(--ns-space-4); margin-bottom: var(--ns-space-12);">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="ns-btn ns-btn-terracotta">
				<?php esc_html_e( 'Return to Homepage', 'northstar-renovation' ); ?> &rarr;
			</a>
			<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="ns-btn ns-btn-outline-light">
				<?php esc_html_e( 'Contact Our Studio', 'northstar-renovation' ); ?>
			</a>
		</div>

		<!-- Helpful Navigation Hub -->
		<div style="background-color: rgba(22, 40, 34, 0.7); border: 1px solid rgba(217, 211, 199, 0.2); border-radius: var(--ns-radius-sm); padding: var(--ns-space-6); text-align: left;">
			<h2 style="color: var(--ns-color-ivory); font-size: 1.25rem; margin-bottom: var(--ns-space-4);">
				<?php esc_html_e( 'Explore Important Project Sections:', 'northstar-renovation' ); ?>
			</h2>

			<ul style="list-style: none; display: grid; grid-template-columns: repeat(2, 1fr); gap: var(--ns-space-3);">
				<li><a href="<?php echo esc_url( home_url( '/services/' ) ); ?>" style="color: var(--ns-color-stone);">&rarr; <?php esc_html_e( 'Architectural Services', 'northstar-renovation' ); ?></a></li>
				<li><a href="<?php echo esc_url( home_url( '/portfolio/' ) ); ?>" style="color: var(--ns-color-stone);">&rarr; <?php esc_html_e( 'Project Portfolio', 'northstar-renovation' ); ?></a></li>
				<li><a href="<?php echo esc_url( home_url( '/about/' ) ); ?>" style="color: var(--ns-color-stone);">&rarr; <?php esc_html_e( 'About Our Practice', 'northstar-renovation' ); ?></a></li>
				<li><a href="<?php echo esc_url( home_url( '/faq/' ) ); ?>" style="color: var(--ns-color-stone);">&rarr; <?php esc_html_e( 'Frequently Asked Questions', 'northstar-renovation' ); ?></a></li>
			</ul>
		</div>
	</div>
</section>

<?php
get_footer();
