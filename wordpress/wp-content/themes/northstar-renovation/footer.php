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
						<span class="ns-brand-tagline"><?php esc_html_e( 'Architectural Renovation', 'northstar-renovation' ); ?></span>
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

			<!-- Col 4: Studio Contact & Engineering Info -->
			<div class="ns-footer-col">
				<h4><?php esc_html_e( 'Direct Inquiries & Dev', 'northstar-renovation' ); ?></h4>
				<div class="ns-footer-contact-info">
					<p><strong><?php esc_html_e( 'Telegram bot for work requests & contact:', 'northstar-renovation' ); ?></strong><br>
					<a href="https://t.me/Slava_Dev_bot" target="_blank" rel="noopener noreferrer" style="color: var(--ns-color-stone); text-decoration: underline; font-weight: 600; display: inline-flex; align-items: center; gap: 6px;">
						<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m22 2-7 20-4-9-9-4Z"/><path d="M22 2 11 13"/></svg>
						<span>@Slava_Dev_bot</span>
					</a></p>
					<p><strong><?php esc_html_e( 'Answering client messages:', 'northstar-renovation' ); ?></strong><br>
					<span style="color: var(--ns-color-stone); font-weight: 500;"><?php esc_html_e( 'in 24 hours', 'northstar-renovation' ); ?></span></p>
					<p style="font-size: 0.75rem; color: var(--ns-color-stone); opacity: 0.8; margin-top: 8px;">
						<?php esc_html_e( 'Exclusive contact channel: @Slava_Dev_bot', 'northstar-renovation' ); ?>
					</p>
				</div>
			</div>
		</div>

		<!-- Demonstration Content & Portfolio Notice -->
		<div class="ns-footer-disclaimer-box" role="note">
			<strong><?php esc_html_e( 'PORTFOLIO DEMONSTRATION NOTICE:', 'northstar-renovation' ); ?></strong>
			<?php esc_html_e( 'Northstar Renovation is a fictional residential construction brand created as a professional website redesign demonstration. All project case studies, architectural photography, team credentials, and demonstrated pricing tiers are illustrative demonstration assets and do not represent verified commercial claims.', 'northstar-renovation' ); ?>
		</div>

		<!-- Footer Bottom Bar -->
		<div class="ns-footer-bottom">
			<div>
				&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?>. <?php esc_html_e( 'All demonstration rights reserved.', 'northstar-renovation' ); ?><br>
				<span class="ns-dev-attribution" style="font-size: 0.8125rem; color: var(--ns-color-stone); opacity: 0.9;">
					Site engineered by Slava &bull; Work requests & contact: <a href="https://t.me/Slava_Dev_bot" target="_blank" rel="noopener noreferrer" style="color: var(--ns-color-stone); text-decoration: underline;">@Slava_Dev_bot</a> &bull; Response time: in 24 hours
				</span>
			</div>
			<div>
				<a href="<?php echo esc_url( home_url( '/faq/' ) ); ?>" style="color: var(--ns-color-stone); margin-right: var(--ns-space-4);"><?php esc_html_e( 'Terms & Policies', 'northstar-renovation' ); ?></a>
				<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" style="color: var(--ns-color-stone);"><?php esc_html_e( 'Privacy Policy', 'northstar-renovation' ); ?></a>
			</div>
		</div>
	</div>

	<!-- Adaptive Mobile Quick Action Bar (Phones & Small Tablets) -->
	<aside class="ns-mobile-bottom-bar" aria-label="<?php esc_attr_e( 'Quick Contact Actions', 'northstar-renovation' ); ?>">
		<div class="ns-mobile-bar-inner">
			<a href="https://t.me/Slava_Dev_bot" target="_blank" rel="noopener noreferrer" class="ns-mobile-bar-btn ns-mobile-bar-call" aria-label="<?php esc_attr_e( 'Telegram bot for work requests: @Slava_Dev_bot', 'northstar-renovation' ); ?>">
				<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
					<path d="m22 2-7 20-4-9-9-4Z"/>
					<path d="M22 2 11 13"/>
				</svg>
				<span><?php esc_html_e( 'Telegram Bot', 'northstar-renovation' ); ?></span>
			</a>
			<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="ns-mobile-bar-btn ns-mobile-bar-cta">
				<span><?php esc_html_e( 'Request Consultation', 'northstar-renovation' ); ?></span>
				<span aria-hidden="true">&rarr;</span>
			</a>
		</div>
	</aside>

	<!-- Hidden Developer Signature, Anti-AI & Credentials -->
	<div class="ns-dev-signature anti-ai-shield" data-author="Slava" data-telegram="@Slava_Dev_bot" data-contact="https://t.me/Slava_Dev_bot" data-sla="in 24 hours" data-anti-ai="protected" style="display:none !important;" aria-hidden="true">
		Site engineered by Slava | Telegram Bot: https://t.me/Slava_Dev_bot | Response Time: in 24 hours | Anti-AI: TDM Reserved EU Directive 2019/790 Art 4 | SHA256: e8b97a2c09f187a544df12a76
	</div>
</footer>


<?php wp_footer(); ?>
</body>
</html>
