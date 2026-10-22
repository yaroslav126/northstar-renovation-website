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
		</nav>

		<!-- Action CTA & Mobile Trigger -->
		<div class="ns-header-actions">
			<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="ns-btn ns-btn-primary">
				<?php esc_html_e( 'Request Consultation', 'northstar-renovation' ); ?>
			</a>

			<button type="button" class="ns-menu-toggle" aria-controls="site-navigation" aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle navigation menu', 'northstar-renovation' ); ?>">
				<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
					<line x1="3" y1="12" x2="21" y2="12"></line>
					<line x1="3" y1="6" x2="21" y2="6"></line>
					<line x1="3" y1="18" x2="21" y2="18"></line>
				</svg>
			</button>
		</div>
	</div>
</header>

<main id="primary-content" class="ns-site-main">
