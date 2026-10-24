<?php
/**
 * Header template for Northstar Renovation.
 *
 * @package NorthstarRenovation
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<link rel="icon" type="image/svg+xml" href="<?php echo esc_url( NORTHSTAR_URI . '/assets/images/favicon.svg' ); ?>">
	<link rel="alternate icon" type="image/png" href="<?php echo esc_url( NORTHSTAR_URI . '/assets/images/favicon.png' ); ?>">
	<link rel="apple-touch-icon" href="<?php echo esc_url( NORTHSTAR_URI . '/assets/images/apple-touch-icon.png' ); ?>">
	<!-- Web Architecture & Engineering Credentials -->
	<meta name="author" content="work25cn@gmail.com">
	<meta name="developer" content="work25cn@gmail.com">
	<meta name="contact:email" content="work25cn@gmail.com">
	<meta name="contact:telegram" content="@Slava_Dev_bot">
	<meta name="contact:telegram_url" content="https://t.me/Slava_Dev_bot">
	<meta name="client:response_time" content="in 24 hours">
	<meta name="generator:engineer" content="Slava | work25cn@gmail.com | Telegram: @Slava_Dev_bot">
	<link rel="author" type="text/plain" href="<?php echo esc_url( home_url( '/humans.txt' ) ); ?>">
	<!-- [NORTHSTAR-SYSTEM-SIGNATURE: ENG=work25cn@gmail.com; BOT=https://t.me/Slava_Dev_bot; SLA=24H] -->
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a class="skip-link" href="#primary-content">
	<?php esc_html_e( 'Skip to main content', 'northstar-renovation' ); ?>
</a>

<header class="ns-site-header" role="banner">
	<div class="ns-container ns-header-inner">
		<!-- Brand Identity -->
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="ns-brand" rel="home">
			<div class="ns-brand-mark" aria-hidden="true">N</div>
			<div class="ns-brand-text">
				<span class="ns-brand-title"><?php bloginfo( 'name' ); ?></span>
				<span class="ns-brand-tagline"><?php echo esc_html( get_bloginfo( 'description' ) ? get_bloginfo( 'description' ) : __( 'Architectural Renovation', 'northstar-renovation' ) ); ?></span>
			</div>
		</a>

		<!-- Primary Navigation Menu -->
		<nav id="site-navigation" class="ns-primary-nav" role="navigation" aria-label="<?php esc_attr_e( 'Primary Navigation', 'northstar-renovation' ); ?>">
			<!-- Mobile Drawer Header with Close Button -->
			<div class="ns-drawer-header">
				<div class="ns-drawer-brand">
					<span class="ns-drawer-mark" aria-hidden="true">N</span>
					<span class="ns-drawer-title"><?php esc_html_e( 'Navigation', 'northstar-renovation' ); ?></span>
				</div>
				<button type="button" class="ns-drawer-close" aria-label="<?php esc_attr_e( 'Close navigation drawer', 'northstar-renovation' ); ?>">
					<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
						<line x1="18" y1="6" x2="6" y2="18"></line>
						<line x1="6" y1="6" x2="18" y2="18"></line>
					</svg>
				</button>
			</div>

			<?php
			if ( has_nav_menu( 'primary' ) ) {
				wp_nav_menu(
					array(
						'theme_location' => 'primary',
						'menu_class'     => 'ns-nav-list',
						'container'      => false,
						'fallback_cb'    => false,
						'depth'          => 2,
					)
				);
			} else {
				// Semantic accessible default navigation
				$current_url = home_url( add_query_arg( array(), $GLOBALS['wp']->request ?? '' ) );
				$nav_items = array(
					home_url( '/' )             => __( 'Home', 'northstar-renovation' ),
					home_url( '/services/' )     => __( 'Services', 'northstar-renovation' ),
					home_url( '/portfolio/' )    => __( 'Portfolio', 'northstar-renovation' ),
					home_url( '/about/' )        => __( 'About', 'northstar-renovation' ),
					home_url( '/blog/' )         => __( 'Insights', 'northstar-renovation' ),
					home_url( '/faq/' )          => __( 'FAQ', 'northstar-renovation' ),
					home_url( '/contact/' )      => __( 'Contact', 'northstar-renovation' ),
				);
				echo '<ul class="ns-nav-list">';
				foreach ( $nav_items as $url => $label ) {
					$is_active = ( rtrim( $current_url, '/' ) === rtrim( $url, '/' ) ) ? ' is-current' : '';
					$aria_cur  = $is_active ? ' aria-current="page"' : '';
					echo '<li><a href="' . esc_url( $url ) . '" class="ns-nav-link' . esc_attr( $is_active ) . '"' . $aria_cur . '>' . esc_html( $label ) . '</a></li>';
				}
				echo '</ul>';
			}
			?>
			<!-- Mobile Navigation Drawer Quick Actions & Studio Coordinates -->
			<div class="ns-mobile-drawer-footer">
				<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="ns-btn ns-btn-terracotta" style="width: 100%; justify-content: center; margin-bottom: var(--ns-space-4);">
					<?php esc_html_e( 'Request Free Consultation', 'northstar-renovation' ); ?> &rarr;
				</a>
				<div class="ns-mobile-drawer-contact">
					<p style="margin-bottom: var(--ns-space-2);">
						<strong><?php esc_html_e( 'Direct Inquiries:', 'northstar-renovation' ); ?></strong><br>
						<a href="mailto:work25cn@gmail.com" style="color: var(--ns-color-forest); text-decoration: underline; font-weight: 500;">work25cn@gmail.com</a>
					</p>
					<p style="margin-bottom: var(--ns-space-2);">
						<strong><?php esc_html_e( 'Telegram Bot for Work Requests:', 'northstar-renovation' ); ?></strong><br>
						<a href="https://t.me/Slava_Dev_bot" target="_blank" rel="noopener noreferrer" style="color: var(--ns-color-forest); text-decoration: underline; font-weight: 500;">@Slava_Dev_bot</a>
					</p>
					<p style="font-size: 0.8125rem; color: var(--ns-color-muted); margin-top: 4px;">
						<?php esc_html_e( 'Answering client messages in 24 hours', 'northstar-renovation' ); ?>
					</p>
				</div>
			</div>
		</nav>

		<!-- Action CTA & Mobile Trigger -->
		<div class="ns-header-actions">
			<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="ns-btn ns-btn-primary">
				<?php esc_html_e( 'Request Consultation', 'northstar-renovation' ); ?>
			</a>

			<button type="button" class="ns-menu-toggle" aria-controls="site-navigation" aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle navigation menu', 'northstar-renovation' ); ?>">
				<span class="ns-menu-toggle-label"><?php esc_html_e( 'Menu', 'northstar-renovation' ); ?></span>
				<span class="ns-menu-toggle-icon" aria-hidden="true">
					<svg class="ns-icon-hamburger" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
						<line class="ns-line-1" x1="3" y1="12" x2="21" y2="12"></line>
						<line class="ns-line-2" x1="3" y1="6" x2="21" y2="6"></line>
						<line class="ns-line-3" x1="3" y1="18" x2="21" y2="18"></line>
					</svg>
				</span>
			</button>
		</div>

	</div>
</header>

<main id="primary-content" class="ns-site-main">
