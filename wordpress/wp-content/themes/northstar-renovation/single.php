<?php
/**
 * Single post and custom post type template.
 *
 * @package NorthstarRenovation
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<?php while ( have_posts() ) : the_post(); ?>
	<article id="post-<?php the_ID(); ?>" <?php post_class( 'ns-single-article' ); ?>>
		<header class="ns-section ns-section-dark" style="padding-top: var(--ns-space-16); padding-bottom: var(--ns-space-16);">
			<div class="ns-container ns-container-narrow text-center">
				<span class="ns-section-eyebrow" style="color: var(--ns-color-stone);">
					<?php the_category( ', ' ); ?>
				</span>
				<h1 style="color: var(--ns-color-ivory); margin-bottom: var(--ns-space-4);">
					<?php the_title(); ?>
				</h1>
				<div style="font-size: 0.9375rem; color: var(--ns-color-stone);">
					<?php printf( esc_html__( 'Published on %1$s by %2$s', 'northstar-renovation' ), get_the_date(), get_the_author() ); ?>
				</div>
			</div>
		</header>

		<div class="ns-section">
			<div class="ns-container ns-container-narrow">
				<?php if ( has_post_thumbnail() ) : ?>
					<div style="aspect-ratio: 16/9; overflow: hidden; border-radius: var(--ns-radius-sm); margin-bottom: var(--ns-space-8); border: 1px solid var(--ns-color-border);">
						<?php the_post_thumbnail( 'ns-hero', array( 'style' => 'width: 100%; height: 100%; object-fit: cover;' ) ); ?>
					</div>
				<?php endif; ?>

				<div class="ns-article-content" style="font-size: 1.0625rem; line-height: 1.8;">
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

				<!-- Demonstration Notice -->
				<div style="margin-top: var(--ns-space-10); padding: var(--ns-space-4); background-color: var(--ns-color-stone-light); border-left: 3px solid var(--ns-color-terracotta); border-radius: 0 var(--ns-radius-sm) var(--ns-radius-sm) 0; font-size: 0.875rem;">
					<strong><?php esc_html_e( 'Demonstration Case Study Notice:', 'northstar-renovation' ); ?></strong>
					<?php esc_html_e( 'This article/project study is created for demonstration and portfolio presentation purposes for Northstar Renovation.', 'northstar-renovation' ); ?>
				</div>

				<div style="margin-top: var(--ns-space-8); display: flex; justify-content: space-between; border-top: 1px solid var(--ns-color-border); padding-top: var(--ns-space-6);">
					<div><?php previous_post_link( '&larr; %link', __( 'Previous Article', 'northstar-renovation' ) ); ?></div>
					<div><?php next_post_link( '%link &rarr;', __( 'Next Article', 'northstar-renovation' ) ); ?></div>
				</div>
			</div>
		</div>
	</article>
<?php endwhile; ?>

<?php
get_template_part( 'template-parts/cta-section' );
get_footer();
