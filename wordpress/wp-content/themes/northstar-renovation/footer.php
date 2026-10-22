<?php
/**
 * Footer template for Northstar Renovation.
 *
 * @package NorthstarRenovation
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
</main><!-- #primary-content -->

<footer class="ns-site-footer" role="contentinfo">
	<div class="ns-container">
		<div class="ns-footer-grid">
			<!-- Col 1: Brand & Philosophy -->
			<div class="ns-footer-col">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="ns-brand" style="margin-bottom: var(--ns-space-4);">
					<div class="ns-brand-mark" style="background-color: var(--ns-color-ivory); color: var(--ns-color-forest);">N</div>
					<div class="ns-brand-text">
						<span class="ns-brand-title" style="color: var(--ns-color-ivory);"><?php bloginfo( 'name' ); ?></span>
						<span class="ns-brand-tagline"><?php esc_html_e( 'Architectural Residential Renovation', 'northstar-renovation' ); ?></span>
					</div>
				</a>
				<p style="font-size: 0.9375rem; color: var(--ns-color-stone); margin-bottom: var(--ns-space-4);">
					<?php esc_html_e( 'Dedicated to architectural precision, fixed-cost transparency, and master-level craftsmanship across premier residential properties.', 'northstar-renovation' ); ?>
				</p>
			</div>

			<!-- Col 2: Services -->
			<div class="ns-footer-col">
				<h4><?php esc_html_e( 'Services', 'northstar-renovation' ); ?></h4>
				<ul class="ns-footer-menu">
					<li><a href="<?php echo esc_url( home_url( '/services/#kitchen-renovation' ) ); ?>"><?php esc_html_e( 'Kitchen Renovation', 'northstar-renovation' ); ?></a></li>
					<li><a href="<?php echo esc_url( home_url( '/services/#bathroom-remodeling' ) ); ?>"><?php esc_html_e( 'Bathroom Remodeling', 'northstar-renovation' ); ?></a></li>
					<li><a href="<?php echo esc_url( home_url( '/services/#whole-home-renovation' ) ); ?>"><?php esc_html_e( 'Whole-Home Renovation', 'northstar-renovation' ); ?></a></li>
					<li><a href="<?php echo esc_url( home_url( '/services/#interior-remodeling' ) ); ?>"><?php esc_html_e( 'Interior Reconfiguration', 'northstar-renovation' ); ?></a></li>
					<li><a href="<?php echo esc_url( home_url( '/services/#flooring-finishing' ) ); ?>"><?php esc_html_e( 'Flooring & Finishing', 'northstar-renovation' ); ?></a></li>
				</ul>
			</div>

			<!-- Col 3: Navigation -->
			<div class="ns-footer-col">
				<h4><?php esc_html_e( 'Practice', 'northstar-renovation' ); ?></h4>
				<ul class="ns-footer-menu">
					<li><a href="<?php echo esc_url( home_url( '/portfolio/' ) ); ?>"><?php esc_html_e( 'Portfolio Case Studies', 'northstar-renovation' ); ?></a></li>
					<li><a href="<?php echo esc_url( home_url( '/about/' ) ); ?>"><?php esc_html_e( 'About Our Studio', 'northstar-renovation' ); ?></a></li>
					<li><a href="<?php echo esc_url( home_url( '/blog/' ) ); ?>"><?php esc_html_e( 'Renovation Insights', 'northstar-renovation' ); ?></a></li>
					<li><a href="<?php echo esc_url( home_url( '/faq/' ) ); ?>"><?php esc_html_e( 'Frequently Asked Questions', 'northstar-renovation' ); ?></a></li>
					<li><a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'Request Consultation', 'northstar-renovation' ); ?></a></li>
				</ul>
			</div>

			<!-- Col 4: Studio Contact -->
			<div class="ns-footer-col">
				<h4><?php esc_html_e( 'Consultation Studio', 'northstar-renovation' ); ?></h4>
				<div class="ns-footer-contact-info">
					<p><strong><?php esc_html_e( 'Studio Office:', 'northstar-renovation' ); ?></strong><br>
					<?php esc_html_e( '450 St. Clair Avenue West, Suite 300', 'northstar-renovation' ); ?><br>
					<span style="font-size: 0.75rem; color: var(--ns-color-terracotta);"><?php esc_html_e( '(Demonstration Address)', 'northstar-renovation' ); ?></span></p>
					<p><strong><?php esc_html_e( 'Direct Inquiries:', 'northstar-renovation' ); ?></strong><br>
					<a href="tel:+15557829400">+1 (555) 782-9400</a><br>
					<a href="mailto:consultations@northstar-renovation.local">consultations@northstar-renovation.local</a></p>
					<p><strong><?php esc_html_e( 'Studio Hours:', 'northstar-renovation' ); ?></strong><br>
					<?php esc_html_e( 'Monday – Friday: 8:00 AM – 6:00 PM', 'northstar-renovation' ); ?><br>
					<?php esc_html_e( 'Saturday by appointment', 'northstar-renovation' ); ?></p>
				</div>
			</div>
		</div>

		<!-- Demonstration Content & Portfolio Notice -->
		<div class="ns-footer-disclaimer-box" role="note">
			<strong><?php esc_html_e( 'PORTFOLIO DEMONSTRATION NOTICE:', 'northstar-renovation' ); ?></strong>
			<?php esc_html_e( 'Northstar Renovation is a fictional residential construction brand created as a professional website redesign demonstration. All project case studies, client reviews, architectural photography, team credentials, and demonstrated pricing tiers are illustrative demonstration assets and do not represent verified commercial claims.', 'northstar-renovation' ); ?>
		</div>

		<!-- Footer Bottom Bar -->
		<div class="ns-footer-bottom">
			<div>
				&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?>. <?php esc_html_e( 'All demonstration rights reserved.', 'northstar-renovation' ); ?>
			</div>
			<div>
				<a href="<?php echo esc_url( home_url( '/faq/' ) ); ?>" style="color: var(--ns-color-stone); margin-right: var(--ns-space-4);"><?php esc_html_e( 'Terms & Policies', 'northstar-renovation' ); ?></a>
				<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" style="color: var(--ns-color-stone);"><?php esc_html_e( 'Privacy Policy', 'northstar-renovation' ); ?></a>
			</div>
		</div>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
