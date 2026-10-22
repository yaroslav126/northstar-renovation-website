<?php
/**
 * Default page template for Northstar Renovation.
 *
 * @package NorthstarRenovation
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<?php while ( have_posts() ) : the_post(); ?>
	<header class="ns-section ns-section-dark" style="padding-top: var(--ns-space-16); padding-bottom: var(--ns-space-16);">
		<div class="ns-container ns-container-narrow text-center">
			<h1 style="color: var(--ns-color-ivory); margin-bottom: 0;">
				<?php the_title(); ?>
			</h1>
		</div>
	</header>

	<div class="ns-section">
		<div class="ns-container ns-container-narrow">
			<?php if ( has_post_thumbnail() ) : ?>
				<div style="aspect-ratio: 16/9; overflow: hidden; border-radius: var(--ns-radius-sm); margin-bottom: var(--ns-space-8); border: 1px solid var(--ns-color-border);">
					<?php the_post_thumbnail( 'ns-hero', array( 'style' => 'width: 100%; height: 100%; object-fit: cover;' ) ); ?>
				</div>
			<?php endif; ?>

			<div class="ns-page-content" style="font-size: 1.0625rem; line-height: 1.8;">
				<?php
				the_content();

				wp_link_pages(
					array(
						'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'northstar-renovation' ),
						'after'  => '</div>',
					)
				);
				?>
			</div>
		</div>
	</div>
<?php endwhile; ?>

<?php
get_footer();
